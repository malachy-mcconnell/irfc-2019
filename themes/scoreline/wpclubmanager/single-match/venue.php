<?php
/**
 * Single Match - Venue
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$venues = get_the_terms( $post->ID, 'wpcm_venue' );
$attendance = get_post_meta( $post->ID, 'wpcm_attendance', true );
$show_attendance = get_option( 'wpcm_results_show_attendance' );
$played = get_post_meta( $post->ID, 'wpcm_played', true );

if ( is_array( $venues ) ) {
	$venue = reset($venues);
	$t_id = $venue->term_id;
	$venue_meta = get_option( "taxonomy_term_$t_id" );
} else {
	$venue = null;
}

if ( $venue ) { ?>

	<span class="cp-match-venue">@ <?php echo $venue->name; ?></span>

<?php
}

if ( $played ) {
					
	if ( $attendance && $show_attendance == 'yes' ) { ?>

		<span class="cp-match-attendance"><?php echo _e( 'Att' , 'scoreline' ); ?>: <?php echo $attendance; ?></span>

	<?php }

}