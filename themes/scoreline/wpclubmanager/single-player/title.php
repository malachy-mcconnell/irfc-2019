<?php
/**
 * Single Player - Title
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$natl = get_post_meta( $post->ID, 'wpcm_natl', true );

if ( get_option( 'wpcm_player_profile_show_number' ) == 'yes') {
	$squadnumber = '<span class="cp-player-number">#' . get_post_meta( $post->ID, 'wpcm_number', true ) . '</span>';
} else {
	$squadnumber = '';
}

if ( get_option( 'wpcm_player_profile_show_position' ) == 'yes') {

	$positions = get_the_terms( $post->ID, 'wpcm_position' );

	if ( is_array( $positions ) ) {

		$player_positions = array();

		foreach ( $positions as $position ) {
			
			$player_positions[] = $position->name;
		}

		$position = '<span class="cp-player-position">' . implode( ', ', $player_positions ) . '</span>';

	}
} else {
	$position = '';
}

if ( get_option( 'wpcm_player_profile_show_hometown' ) == 'yes') {

	$flag = '<img class="cp-profile-flag" src="'. get_template_directory_uri() .'/img/flags/small/'. $natl .'.jpg"/>';
} else {

	$flag = '';
} ?>

<div class="cp-player-title group">
	<h1><?php the_title(); ?></h1>
	<p class="cp-player-title-meta"><?php echo $squadnumber; ?> <?php echo $position; ?> <?php echo $flag; ?></p>
</div>