<?php
// Display gallery
function wpcm_players_gallery($atts, $content = null) {
	extract(shortcode_atts(array(
		'type' => 'wpcm_player',
		'season' => null,
		'team' => null,
		'position' => null,
		'jobs' => null,
		'orderby' => 'name',
		'order' => 'ASC',
		'title' => __( 'Players', 'wpcm_pg' ),
		'columns' => '3'
	), $atts));

	$args = array(
		'post_type' => $type,
		'tax_query' => array(),
		'numposts' => -1,
		'posts_per_page' => -1,
		'orderby' => 'name',
		'order' => $order
	);
	if ( $orderby == 'number' ) {
	    $args['orderby'] = 'meta_value_num';
	    $args['meta_key'] = 'wpcm_number';
	}
	if ( $orderby == 'menu_order' ) {
	    $args['orderby'] = 'menu_order';
	}
	if ( $season ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'wpcm_season',
			'terms' => $season,
			'field' => 'term_id'
		);
	}
	if ( $team ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'wpcm_team',
			'terms' => $team,
			'field' => 'term_id'
		);
	}
	if( $type == 'wpcm_player' ) {
		if ( $position ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'wpcm_position',
				'terms' => $position,
				'field' => 'term_id'
			);
		}
	}
	if( $type == 'wpcm_staff' ) {
		if ( $jobs ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'wpcm_jobs',
				'terms' => $jobs,
				'field' => 'term_id'
			);
		}
	}

	$players = new WP_Query( $args ); ?>

	<div id="wpcm-players-gallery">

		<h3><?php echo $title; ?></h3>

		<ul class="small-block-grid-2 medium-block-grid-<?php echo $columns; ?>">
			<?php	
			if ( $players->have_posts() ) :
				while ( $players->have_posts() ) : $players->the_post(); 

				$number = get_post_meta( get_the_ID(), 'wpcm_number', true ); ?>
            
                <li class="wpcm-players-gallery-li">
                	<div>
                		<?php
                		if( has_post_thumbnail( get_the_ID() ) ) { ?>
	                    	<a href="<?php the_permalink(); ?>">
	                    		<?php echo get_the_post_thumbnail( get_the_ID(), 'player-medium' ); ?>
	                    	</a>
	                    <?php } else { ?>
	                    	<a href="<?php the_permalink(); ?>">
	                    		<?php echo wpcm_placeholder_img( 'player_medium' ); ?>
	                    	</a>
	                    <?php } ?>
                    </div>
                    <h4>
                		<a href="<?php the_permalink(); ?>">
                			<?php if( $number ) : ?>
                				<span><?php echo $number; ?>.</span>
                			<?php endif; ?>
                			<?php the_title(); ?>
                		</a>
                	</h4>
                </li>
        
                <?php
                endwhile;
				
			endif; 
			
			wp_reset_query(); ?>

		</ul>
	</div>
<?php
}
add_shortcode('players_gallery', 'wpcm_players_gallery');

// Frontend styles
function wpcm_pg_get_styles() {
	return apply_filters( 'wpcm_pg_enqueue_styles', array(
		'wpcm-pg-style' => array(
			'src'     => str_replace( array( 'http:', 'https:' ), '', plugins_url( 'includes/wpcm-players-gallery.css',  WPCM_PG_PLUGIN_FILE ) ),
			'deps'    => '',
			'version' => WPCM_PG_PLUGIN_FILE,
			'media'   => 'all'
		),
	) );
}
function wpcm_pg_load_scripts() {
	global $post, $wp;
	$enqueue_styles = wpcm_pg_get_styles();
	if ( $enqueue_styles ) :
		foreach ( $enqueue_styles as $handle => $args ) :
			wp_enqueue_style( $handle, $args['src'], $args['deps'], $args['media'] );
		endforeach;
	endif;
	
}
add_action( 'wp_enqueue_scripts', 'wpcm_pg_load_scripts' );

// Shortcode buttons
add_action( 'admin_init', 'wpcm_pg_add_shortcode_button' );
add_filter( 'tiny_mce_version', 'wpcm_pg_refresh_mce' );
function wpcm_pg_add_shortcode_button() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) return;

	if ( get_user_option('rich_editing') == 'true' ) :
		add_filter( 'mce_external_plugins', 'wpcm_pg_add_shortcode_tinymce_plugin' );
		add_filter( 'mce_buttons_3', 'wpcm_pg_register_shortcode_button' );
	endif;
}
function wpcm_pg_register_shortcode_button($buttons) {
	array_push( $buttons, "players_gallery" );

	return $buttons;
}
function wpcm_pg_add_shortcode_tinymce_plugin($plugin_array) {
	$plugin_array['players_gallery']   = WPCM_PG_PLUGIN_URL . '/editor/editor-plugin.js';

	return $plugin_array;
}
function wpcm_pg_refresh_mce( $ver ) {	
	$ver += 3;
	return $ver;
}

// Admin styles
function wpcm_pg_admin_styles() {
	wp_enqueue_style( 'wpcm_pg_admin_styles', WPCM_PG_PLUGIN_URL . '/editor/editor.css', array(), WPCM_PG_VERSION );
}
add_action( 'admin_enqueue_scripts', 'wpcm_pg_admin_styles' );

// Shortcode ajax
add_action( 'wp_ajax_players_gallery_shortcode', 'players_gallery_shortcode_ajax' );
function players_gallery_shortcode_ajax() {
	$defaults = array(
		'type' => 'wpcm_player',
		'season' => null,
		'team' => null,
		'position' => null,
		'jobs' => null,
		'orderby' => 'name',
		'order' => 'ASC',
		'title' => __( 'Players', 'wpcm_pg' ),
		'columns' => '3'
	);
	$args = array_merge( $defaults, $_GET );
	?>
		<div id="players_gallery-form">
			<table id="players_gallery-table" class="form-table">
				<tr>
					<?php $field = 'type'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Type', 'wpcm_pg' ); ?></label></th>
					<td>
						<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
							<option id="wpcm_player" value="wpcm_player"<?php if ( $args[$field] == 'wpcm-player' ) echo ' selected'; ?>><?php _e( 'Players', 'wpcm_pg' ); ?></option>
							<option id="wpcm_staff" value="wpcm_staff"<?php if ( $args[$field] == 'wpcm_staff' ) echo ' selected'; ?>><?php _e( 'Staff' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<?php $field = 'title'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Title', 'wpcm_pg' ); ?></label></th>
					<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" class="widefat" /></td>
				</tr>
				<tr>
					<?php $field = 'columns'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Columns', 'wpcm_pg' ); ?></label></th>
					<td>
						<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
							<option id="2" value="2"<?php if ( $args[$field] == '2' ) echo ' selected'; ?>><?php _e( '2', 'wpcm_pg' ); ?></option>
							<option id="3" value="3"<?php if ( $args[$field] == '3' ) echo ' selected'; ?>><?php _e( '3' ); ?></option>
							<option id="4" value="4"<?php if ( $args[$field] == '4' ) echo ' selected'; ?>><?php _e( '4' ); ?></option>
							<option id="5" value="5"<?php if ( $args[$field] == '5' ) echo ' selected'; ?>><?php _e( '5' ); ?></option>
							<option id="6" value="6"<?php if ( $args[$field] == '6' ) echo ' selected'; ?>><?php _e( '6' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<?php $field = 'season'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Season', 'wpcm_pg' ); ?></label></th>
					<td>
						<?php
						wp_dropdown_categories(array(
							'show_option_none' => __( 'All' ),
							'hide_empty' => 0,
							'orderby' => 'title',
							'taxonomy' => 'wpcm_season',
							'selected' => $args[$field],
							'name' => $field,
							'id' => 'option-' . $field
						));
						?>
					</td>
				</tr>
				<tr>
					<?php $field = 'team'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Team', 'wpcm_pg' ); ?></label></th>
					<td>
						<?php
						wp_dropdown_categories( array(
							'show_option_none' => __( 'All' ),
							'hide_empty' => 0,
							'orderby' => 'title',
							'taxonomy' => 'wpcm_team',
							'selected' => $args[$field],
							'name' => $field,
							'id' => 'option-' . $field
						) );
						?>
					</td>
				</tr>
				<tr>
					<?php $field = 'position'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Position', 'wpcm_pg' ); ?></label></th>
					<td>
						<?php
						wp_dropdown_categories( array(
							'show_option_none' => __( 'All' ),
							'hide_empty' => 0,
							'orderby' => 'title',
							'taxonomy' => 'wpcm_position',
							'selected' => $args[$field],
							'name' => $field,
							'id' => 'option-' . $field
						) );
						?>
					</td>
				</tr>
				<tr>
					<?php $field = 'jobs'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Jobs', 'wpcm_pg' ); ?></label></th>
					<td>
						<?php
						wp_dropdown_categories( array(
							'show_option_none' => __( 'All' ),
							'hide_empty' => 0,
							'orderby' => 'title',
							'taxonomy' => 'wpcm_jobs',
							'selected' => $args[$field],
							'name' => $field,
							'id' => 'option-' . $field
						) );
						?>
					</td>
				</tr>
				<tr>
					<?php $field = 'orderby'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order by', 'wpcm_pg' ); ?></label></th>
					<td>
						<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
							<option id="alphabetical" value="alphabetical"<?php if ( $args[$field] == 'alphabetical' ) echo ' selected'; ?>><?php _e( 'Alphabetical' ); ?></option>
							<option id="number" value="number"<?php if ( $args[$field] == 'number' ) echo ' selected'; ?>><?php _e( 'Number', 'wpcm_pg' ); ?></option>
							<option id="menu_order" value="menu_order"<?php if ( $args[$field] == 'menu_order' ) echo ' selected'; ?>><?php _e( 'Page order' ); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<?php $field = 'order'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order', 'wpcm_pg' ); ?></label></th>
					<td>
						<?php
						$wpcm_order_options = array(
							'ASC' => __( 'Lowest to highest', 'wpcm_pg' ),
							'DESC' => __( 'Highest to lowest', 'wpcm_pg' )
						);
						?>
						<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
							<?php foreach ( $wpcm_order_options as $key => $val ) { ?>
								<option id="<?php echo $key; ?>" value="<?php echo $key; ?>"<?php if ( $args[$field] == $key ) echo ' selected'; ?>><?php echo $val; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'wpcm_pg' ), __( 'Players', 'wpcm_pg' ) ); ?>" name="submit" />
			</p>
		</div>	
	<?php
	die();
}