<?php
/**
 * Single Player - Stats Table
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $wpclubmanager;

$teams = get_the_terms( $post->ID, 'wpcm_team' );
$stats = get_wpcm_player_stats_from_post( $post->ID );
$seasons = get_the_terms( $post->ID, 'wpcm_season' );
$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();
$stats_labels = array_merge( array( 'appearances' => __( 'Apps', 'wpclubmanager' ) ), $wpcm_player_stats_labels );

if( is_array( $teams ) ) {

	foreach( $teams as $team ) {

		$rand = rand(1,99999);
		$name = $team->name;

		if ( $team->parent ) {
			$parent_team = get_term( $team->parent, 'wpcm_team');
			$name .= ' (' . $parent_team->name . ')';
		} ?>

		<div class="cp-table-wrap">
			<table class="cp-table cp-player-stats-table">
				<caption><?php echo $name; ?></caption>
				<thead>
					<tr>
						<th></th>
						<?php cp_profile_stats_th(); ?>
					</tr>
				</thead>
				<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>
					<tbody>
						<tr>
							<th><?php echo $season->name; ?></th>
							<?php cp_profile_stats_td( $stats, $team->term_id, $season->term_id ); ?>
						</tr>
					</tbody>
				<?php endforeach; endif; ?>
				</tbody>
				<tfoot>
					<tr>
						<th><?php printf( __( 'All %s', 'scoreline' ), __( 'seasons', 'scoreline' ) ); ?></th>
						<?php cp_profile_stats_td( $stats, $team->term_id, 0 ); ?>
					</tr>
				</tfoot>
			</table>
		</div>

	<?php
	}
} else { ?>

	<div class="cp-table-wrap">
		<table class="cp-table cp-player-stats-table">
			<caption><?php _e('Player stats', 'scoreline'); ?></caption>
			<thead>
				<tr>
					<th></th>
					<?php cp_profile_stats_th(); ?>
				</tr>
			</thead>
			<?php if( is_array( $seasons ) ): foreach( $seasons as $season ): ?>
				<tbody>
					<tr>
						<th><?php echo $season->name; ?></th>
						<?php cp_profile_stats_td( $stats, 0, $season->term_id ); ?>
					</tr>
				</tbody>
			<?php endforeach; endif; ?>
			</tbody>
			<tfoot>
				<tr>
					<th><?php printf( __( 'All %s', 'scoreline' ), __( 'seasons', 'scoreline' ) ); ?></th>
					<?php cp_profile_stats_td( $stats, 0, 0 ); ?>
				</tr>
			</tfoot>
		</table>
	</div>

<?php } ?>