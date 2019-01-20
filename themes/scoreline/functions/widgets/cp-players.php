<?php

class CPPlayers extends WP_Widget {

/*  Constructor
/* ------------------------------------ */
	function CPPlayers() {
		parent::__construct( false, 'ClubPress Players', array('description' => 'Display player stats in a slider.', 'classname' => 'widget_cp_players') );;	
	}
	
/*  Widget
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );
		$instance['title']?NULL:$instance['title']='';
		$title = apply_filters('widget_title',$instance['title']);
		$output = $before_widget."\n";
		if($title)
			$output .= $before_title.$title.$after_title;
		ob_start();


		if ( $instance['season'] <= 0  )
			$instance['season'] = null;
		if ( $instance['team'] <= 0  )
			$instance['team'] = null;
		if ( $instance['position'] <= 0  )
			$instance['position'] = null;

		$limit = $instance["posts_num"];
		$order = $instance["posts_order"];
		$orderby = $instance["players_orderby"];
		$season = $instance['season'];
		$team = $instance['team'];
		$position = $instance['position'];

		$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();

		$player_stats_labels = array_merge( array( 'appearances' => __( 'Apps', 'wpclubmanager' ) ), $wpcm_player_stats_labels );

		
		if ( $limit == 0 )
			$limit = -1;

		$stats = array('thumb', $orderby, 'name' );

		$numposts = $limit;

		if ( array_intersect_key( array_flip( $stats ), $player_stats_labels ) )
			$numposts = -1;
		
		$orderby = strtolower( $orderby );	
		$order = strtoupper( $order );
		
		$args = array(
			'post_type' => 'wpcm_player',
			'tax_query' => array(),
			'numposts' => $numposts,
			'posts_per_page' => $numposts,
			'orderby' => 'meta_value_num',
			'meta_key' => 'wpcm_number',
			'order' => $order
		);

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

		$players = get_posts( $args );
		
		$count = 0;	
		
		if ( sizeof( $players ) > 0 ) {

			$sliderrandomid = rand();

			$output .= '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					var firstImage = jQuery("#flexslider-players-' . $sliderrandomid . '").find("img").filter(":first"),
					checkforloaded = setInterval(function() {
						var image = firstImage.get(0);
						if (image.complete || image.readyState == "complete" || image.readyState == 4) {
							clearInterval(checkforloaded);
							
							jQuery("#flexslider-players-' . $sliderrandomid . '").flexslider({
								animation: "slide",
								useCSS: false, // Fix iPad flickering issue
								slideshow: false,
								directionNav: false,
								controlNav: true,
								pauseOnHover: true,
								slideshowSpeed: 7000,
								animationSpeed: 400,
								smoothHeight: true,
								touch: false
							});
						}
					}, 20);
				});
			</script>
			';

			$output .= '<div class="featured-players flexslider" id="flexslider-players-' . $sliderrandomid . '"><ul class="slides cp-players-widget">';

			$player_details = array();

			foreach( $players as $player ) {

				$player_details[$player->ID] = array();
				$count++;

				if ( array_intersect_key( array_flip( $stats ), $player_stats_labels ) )
					$player_stats = get_wpcm_player_stats_from_post( $player->ID );
					
					$name = $player->post_title;

				if ( has_post_thumbnail( $player->ID ) ) {
					$thumb = get_the_post_thumbnail( $player->ID, 'player-medium' );
				} else {
					$thumb = '<img src="' . get_template_directory_uri() . '/img/player-medium.png" alt=""/>';
				}

				foreach( $stats as $stat ) {
					if ( array_key_exists( $stat, $player_stats_labels ) )  {
						if ( $season ) {
							$player_details[$player->ID][$stat] = '';
							$player_details[$player->ID][$stat] = '<a class="post-comments"><span>' . $player_stats[0][$season]['total'][$stat] . '</span></a></div>';
						} else {
							$player_details[$player->ID][$stat] = '';
							$player_details[$player->ID][$stat] = '<a class="post-comments"><span>' . $player_stats[0][0]['total'][$stat] . '</span></a></div>';
						}
					} else {
						switch ( $stat ) {
						case 'thumb':
							$player_details[$player->ID][$stat] = '';
							$player_details[$player->ID][$stat] = '<div class="post-thumbnail"><a href="' . get_permalink( $player->ID ) . '">' . $thumb . '</a>';
							break;
						case 'name':
							$player_details[$player->ID][$stat] = '';
							$player_details[$player->ID][$stat] = '<div class="related-inner"><h4 class="post-title"><a href="' . get_permalink( $player->ID ) . '">' . $name . '</a></h4></div>';
							break;
						}
					}
				}
			}

			if ( array_key_exists( $orderby, $player_stats_labels ) ) {
				$player_details = subval_sort( $player_details, $orderby );
				if ( $order == 'DESC' )
					$player_details = array_reverse( $player_details );
			}

			$count = 0;
			foreach( $player_details as $player_detail ) {
				$count++;
				if ( $limit > 0 && $count > $limit )
					break;
				$output .= '<li class="post-hover">';
				foreach( $stats as $stat ) {

					$output .= $player_detail[$stat];

					// if ( $stat == 'rating' ) {
					// 	if ( $player_detail['rating'] > 0 ) {
					// 		$avrating = $player_detail['rating'] / $player_detail['appearances'];
					// 		$output .= sprintf( "%01.2f", round($avrating, 2) );
					// 	} else {
					// 		$output .= '0';
					// 	}
					// } else {
					// 	$output .= $player_detail[$stat];
					// }
				}

				$output .= '</li>';
			}

			$output .= '<ul></div>';

			wp_reset_postdata();

		} else {

			$output .= '';
		}
	
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}
	
/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = strip_tags($new['title']);
	// Posts
		$instance['posts_num'] = strip_tags($new['posts_num']);
		$instance['posts_order'] = strip_tags($new['posts_order']);
		$instance['players_orderby'] = strip_tags($new['players_orderby']);
		$instance['season'] = strip_tags($new['season']);
		$instance['team'] = strip_tags($new['team']);
		$instance['position'] = strip_tags($new['position']);
		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> '',
			'posts_num' 		=> '4',
			'posts_order' 		=> 'desc',
			'players_orderby' 	=> 'appearances',
			'season' 			=> null,
			'team' 				=> null,
			'position' 			=> null,
		);

		$sport = get_option('wpcm_sport');

		$data = wpcm_get_sport_presets();
		$wpcm_player_stats_labels = $data[$sport]['stats_labels'];

		$player_stats_labels = array_merge( array( 'appearances' => __( 'Played', 'wpclubmanager' ) ), $wpcm_player_stats_labels );

		$instance = wp_parse_args( (array) $instance, $defaults );
?>

	<style>
		.widget .widget-inside .cp-options-posts .postform { width: 100%; }
		.widget .widget-inside .cp-options-posts p { margin: 3px 0; }
	</style>
	
	<div class="cp-options-posts">
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
		</p>
		
		<p>
			<label style="width: 55%; display: inline-block;" for="<?php echo $this->get_field_id("posts_num"); ?>">Items to show</label>
			<input style="width:20%;" id="<?php echo $this->get_field_id("posts_num"); ?>" name="<?php echo $this->get_field_name("posts_num"); ?>" type="number" value="<?php echo absint($instance["posts_num"]); ?>" size='3' />
		</p>
		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("posts_order"); ?>">Order:</label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("posts_order"); ?>" name="<?php echo $this->get_field_name("posts_order"); ?>">
			  <option value="asc"<?php selected( $instance["posts_order"], "asc" ); ?>>Lowest to highest</option>
			  <option value="desc"<?php selected( $instance["posts_order"], "desc" ); ?>>Highest to lowest</option>
			</select>	
		</p>

		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id("players_orderby"); ?>">Order by:</label>
			<select style="width: 100%;" id="<?php echo $this->get_field_id("players_orderby"); ?>" name="<?php echo $this->get_field_name("players_orderby"); ?>">
			  	<?php foreach ( $player_stats_labels as $key => $value ) { ?>
					<option value="<?php echo $key; ?>"<?php selected( $instance["players_orderby"], $key ); ?>><?php echo $value; ?></option>
				<?php } ?>
			</select>	
		</p>

		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id( "season" ); ?>"><?php _e('Season', 'scoreline') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'taxonomy' => 'wpcm_season',
				'selected' => $instance["season"],
				'name' => $this->get_field_name("season"),
				'id' => $this->get_field_id("season")
			)); ?>
		</p>

		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id( "team" ); ?>"><?php _e('Team', 'scoreline') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'taxonomy' => 'wpcm_team',
				'selected' => $instance["team"],
				'name' => $this->get_field_name("team"),
				'id' => $this->get_field_id("team")
			)); ?>
		</p>

		<p style="padding-top: 0.3em;">
			<label style="width: 100%; display: inline-block;" for="<?php echo $this->get_field_id( "position" ); ?>"><?php _e('Position', 'scoreline') ?>:</label>
			<?php
			wp_dropdown_categories(array(
				'show_option_none' => __( 'All' ),
				'taxonomy' => 'wpcm_position',
				'selected' => $instance["position"],
				'name' => $this->get_field_name("position"),
				'id' => $this->get_field_id("position")
			)); ?>
		</p>

	</div>
<?php

}

}

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'cp_register_widget_players' ) ) {

	function cp_register_widget_players() { 
		register_widget( 'CPPlayers' );
	}
	
}
add_action( 'widgets_init', 'cp_register_widget_players' );
