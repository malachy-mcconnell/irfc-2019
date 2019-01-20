<?php
/**
 * Single Player - Meta
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wpclubmanager; ?>

<table class="cp-table-full">

	<caption><?php _e('Player details', 'scoreline'); ?></caption>
				
	<tbody>

		<?php
		if ( get_option( 'wpcm_player_profile_show_dob' ) == 'yes') { ?>

			<tr>
				<th>
					<?php _e( 'Birthday', 'scoreline' ); ?>
				</th>
				<td>
					<?php echo date_i18n( get_option( 'date_format' ), strtotime( get_post_meta( $post->ID, 'wpcm_dob', true ) ) ); ?>
				</td>
			</tr>
		<?php }

		if ( get_option( 'wpcm_player_profile_show_age' ) == 'yes') { ?>

			<tr>
				<th>
					<?php _e( 'Age', 'scoreline' ); ?>
				</th>
				<td>
					<?php echo get_age( get_post_meta( $post->ID, 'wpcm_dob', true ) ); ?>
				</td>
			</tr>
		<?php }

		if ( get_option( 'wpcm_player_profile_show_height' ) == 'yes') {

			$height = get_post_meta( $post->ID, 'wpcm_height', true ); ?>

			<tr>
				<th>
					<?php _e( 'Height', 'scoreline' ); ?>
				</th>
				<td>
					<?php echo $height; ?>
				</td>
			</tr>
		<?php
		}

		if ( get_option( 'wpcm_player_profile_show_weight' ) == 'yes') {

			$weight = get_post_meta( $post->ID, 'wpcm_weight', true ); ?>

			<tr>
				<th>
					<?php _e( 'Weight', 'scoreline' ); ?>
				</th>
				<td>
					<?php echo $weight; ?>
				</td>
			</tr>
		<?php
		}

		if ( get_option( 'wpcm_player_profile_show_season' ) == 'yes') {

			$seasons = get_the_terms( $post->ID, 'wpcm_season' );
					
			if ( is_array( $seasons ) ) {

				$player_seasons = array();

				foreach ( $seasons as $value ) {

					$player_seasons[] = $value->name;
				} ?>

				<tr>
					<th>
						<?php _e( 'Season', 'scoreline' ); ?>
					</th>
					<td>
						<?php echo implode( ', ', $player_seasons ); ?>
					</td>
				</tr>
			<?php
			}
		}

		if ( get_option( 'wpcm_player_profile_show_team' ) == 'yes') {

			$teams = get_the_terms( $post->ID, 'wpcm_team' );

			if ( is_array( $teams ) ) {
						
				$player_teams = array();

				foreach ( $teams as $team ) {
					
					$player_teams[] = $team->name;
				} ?>

				<tr>
					<th>
						<?php _e( 'Team', 'scoreline' ); ?>
					</th>
					<td>
						<?php echo implode( ', ', $player_teams ); ?>
					</td>
				</tr>
			<?php
			}
		}

		if ( get_option( 'wpcm_player_profile_show_hometown' ) == 'yes') {

			$hometown = get_post_meta( $post->ID, 'wpcm_hometown', true ); ?>

			<tr>
				<th>
					<?php _e( 'Birthplace', 'scoreline' ); ?>
				</th>
				<td>
					<?php echo $hometown; ?>
				</td>
			</tr>
		<?php
		}

		if ( get_option( 'wpcm_player_profile_show_joined' ) == 'yes') { ?>

			<tr>
				<th>
					<?php _e( 'Joined', 'scoreline' ); ?>
				</th>
				<td>
					<?php echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ); ?>
				</td>
			</tr>
		<?php
		}

		if ( get_option( 'wpcm_player_profile_show_exp' ) == 'yes') { ?>

			<tr>
				<th>
					<?php _e( 'Experience', 'scoreline' ); ?>
				</th>
				<td>
					<?php echo human_time_diff(get_the_time('U'), current_time('timestamp')); ?>
				</td>
			</tr>
		<?php
		}

		if ( get_option( 'wpcm_player_profile_show_prevclubs' ) == 'yes') {

			$prevclubs = get_post_meta( $post->ID, 'wpcm_prevclubs', true ); ?>

			<tr>
				<th>
					<?php _e( 'Previous Clubs', 'scoreline' ); ?>
				</th>
				<td>
					<?php
					if ( ! empty ( $prevclubs ) ) {
						echo $prevclubs;
					} else {
						_e('None', 'scoreline');
					} ?>
				</td>
			</tr>
		<?php
		} ?>

	</tbody>
			
</table>