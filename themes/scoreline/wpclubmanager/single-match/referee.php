<?php
/**
 * Single Match - Referee
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpclubmanager, $post;

$referee = get_post_meta( $post->ID, 'wpcm_referee', true );
$show_referee = get_option( 'wpcm_results_show_referee' );

if ( $referee && $show_referee == 'yes' ) { ?>

	<div class="cp-match-referee">

		<?php echo _e( 'Referee' , 'scoreline' ); ?>: <?php echo $referee; ?>

	</div>

<?php }