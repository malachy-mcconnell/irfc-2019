<?php


	add_action( 'wp_ajax_cp_players_shortcode', 'cp_players_shortcode_ajax' );
	

	function cp_players_shortcode_ajax() {
		$defaults = array(
			'season' => null,
			'team' => null,
			'position' => null,
			'orderby' => 'number',
			'order' => 'ASC',
			'title' => __( 'Players', 'wpclubmanager' )
		);
		$args = array_merge( $defaults, $_GET );
		?>
			<div id="cp_players-form">
				<table id="cp_players-table" class="form-table">
					<tr>
						<?php $field = 'title'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Title', 'wpclubmanager' ); ?></label></th>
						<td><input type="text" id="option-<?php echo $field; ?>" name="<?php echo $field; ?>" value="<?php echo $args[$field]; ?>" class="widefat" /></td>
					</tr>
					<tr>
						<?php $field = 'season'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Season', 'wpclubmanager' ); ?></label></th>
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
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Team', 'wpclubmanager' ); ?></label></th>
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
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Position', 'wpclubmanager' ); ?></label></th>
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
						<?php $field = 'orderby'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order by', 'wpclubmanager' ); ?></label></th>
						<td>
							<select id="option-<?php echo $field; ?>" name="<?php echo $field; ?>">
								<option id="number" value="number"<?php if ( $args[$field] == 'number' ) echo ' selected'; ?>><?php _e( 'Number', 'wpclubmanager' ); ?></option>
								<option id="menu_order" value="menu_order"<?php if ( $args[$field] == 'menu_order' ) echo ' selected'; ?>><?php _e( 'Page order' ); ?></option>
								<option id="name" value="name"<?php if ( $args[$field] == 'name' ) echo ' selected'; ?>><?php _e( 'Alphabetical' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<?php $field = 'order'; ?>
						<th><label for="option-<?php echo $field; ?>"><?php _e( 'Order', 'wpclubmanager' ); ?></label></th>
						<td>
							<?php
							$wpcm_order_options = array(
								'ASC' => __( 'Lowest to highest', 'wpclubmanager' ),
								'DESC' => __( 'Highest to lowest', 'wpclubmanager' )
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
					<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'wpclubmanager' ), __( 'Players', 'wpclubmanager' ) ); ?>" name="submit" />
				</p>
			</div>
		
		<?php die();
	}