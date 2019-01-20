<?php
/*  Clubpress Players
/* ------------------------------------ */
function cp_players_gallery($atts, $content = null) {

	extract(shortcode_atts(array(
		'season' => null,
		'team' => null,
		'position' => null,
		'orderby' => 'number',
		'order' => 'ASC',
		'title' => __( 'Players', 'wpclubmanager' )
	), $atts)); ?>

	<div class="cp-players-gallery-shortcode group">
		<h3><?php echo $title; ?></h3>
		<ul id="cp-players-gallery" class="group">
			<?php
			
			$args = array(
				'post_type' => 'wpcm_player',
				'tax_query' => array(),
				'numposts' => -1,
				'posts_per_page' => -1,
				'orderby' => 'meta_value_num',
				'meta_key' => 'wpcm_number',
				'order' => $order
			);
			if ( $orderby == 'menu_order' ) {
			    $args['orderby'] = 'menu_order';
			}
			if ( $orderby == 'name' ) {
			    $args['orderby'] = 'name';
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
			if ( $position ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'wpcm_position',
					'terms' => $position,
					'field' => 'term_id'
				);
			}

			$players = new WP_Query( $args );
					
			if ( $players->have_posts() ) : ?>
						
				<?php while ( $players->have_posts() ) : $players->the_post(); 

				$number = get_post_meta( get_the_ID(), 'wpcm_number', true ); ?>
            
                    <li class="grid one-fourth post-hover">
                    	<div class="cp-pg-player">
	                    	<div class="post-thumbnail">
	                    		<?php
	                    		if( has_post_thumbnail( get_the_ID() ) ) { ?>
			                    	<a href="<?php the_permalink(); ?>">
			                    		<?php echo get_the_post_thumbnail( get_the_ID(), 'player-medium' ); ?>
			                    	</a>
			                    <?php } else { ?>
			                    	<a href="<?php the_permalink(); ?>">
			                    		<img src="<?php echo get_template_directory_uri(); ?>/img/player-medium.png" alt=""/>
			                    	</a>
			                    <?php } ?>
		                    </div>
		                    <div class="related-inner">
		                    	<h4 class="post-title">
		                    		<a href="<?php the_permalink(); ?>">
		                    			<?php if( $number ) : ?>
		                    				<span>#<?php echo $number; ?></span>
		                    			<?php endif; ?>
		                    			<?php the_title(); ?>
		                    		</a>
		                    	</h4>
		                    </div>
	                    </div>
                    </li>
        
                <?php endwhile; // end of the loop. ?>
				
			<?php
			
			endif; 
			
			wp_reset_query();

			?>

		</ul>
	</div>
<?php
}
add_shortcode('cp_players', 'cp_players_gallery');

/*  Columns / Grid
/* ------------------------------------ */
function cp_column_shortcode($atts,$content=NULL) {
	extract( shortcode_atts( array(
		'size'	=> 'one-third',
		'last'	=> false
	), $atts) );

	$lastclass=$last?' last':'';
	$output='<div class="grid '.strip_tags($size).$lastclass.'">'.do_shortcode($content).'</div>';
	if($last)
		$output.='<div class="clear"></div>';
	return $output;
}
add_shortcode('column','cp_column_shortcode');

/*  Hr
/* ------------------------------------ */
function cp_hr_shortcode($atts,$content=NULL) {
	$output = '<div class="hr"></div>';
	return $output;
}
add_shortcode('hr','cp_hr_shortcode');	

/*  Highlight
/* ------------------------------------ */
function cp_highlight_shortcode($atts,$content=NULL) {
	$output = '<span class="highlight">'.strip_tags($content).'</span>';
	return $output;
}
add_shortcode('highlight','cp_highlight_shortcode');
	
/*  Dropcap
/* ------------------------------------ */
function cp_dropcap_shortcode($atts,$content=NULL) {
	$output = '<span class="dropcap">'.strip_tags($content).'</span>';
	return $output;
}
add_shortcode('dropcap','cp_dropcap_shortcode');

/*  Pullquote Left
/* ------------------------------------ */
function cp_pullquote_left_shortcode($atts,$content=NULL) {
	$output = '<span class="pullquote-left">'.strip_tags($content).'</span>';
	return $output;
}
add_shortcode('pullquote-left','cp_pullquote_left_shortcode');
	
/*  Pullquote Right
/* ------------------------------------ */
function cp_pullquote_right_shortcode($atts,$content=NULL) {
	$output = '<span class="pullquote-right">'.strip_tags($content).'</span>';
	return $output;
}
add_shortcode('pullquote-right','cp_pullquote_right_shortcode');