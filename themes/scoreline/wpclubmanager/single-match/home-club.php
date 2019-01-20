<?php
/**
 * Single Match - Home Club
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpclubmanager, $post;

if ( get_option('wpcm_match_title_format') == '%home% vs %away%') {
	$home_club = get_post_meta( $post->ID, 'wpcm_home_club', true );
	$home_goals = get_post_meta( $post->ID, 'wpcm_home_goals', true );
} else {
	$home_club = get_post_meta( $post->ID, 'wpcm_away_club', true );
	$home_goals = get_post_meta( $post->ID, 'wpcm_away_goals', true );
}
$played = get_post_meta( $post->ID, 'wpcm_played', true );
$default_club = get_default_club();
$teams = get_the_terms( $post->ID, 'wpcm_team' );
$show_team = get_option( 'wpcm_results_show_team' );
$image = get_template_directory_uri() . '/img/crest-match.png';
$sport = get_option( 'wpcm_sport' );
$gaa_goals_home = get_post_meta( $post->ID, 'wpcm_home_gaa_goals', true );
$gaa_points_home = get_post_meta( $post->ID, 'wpcm_home_gaa_points', true );
$gaa_goals_away = get_post_meta( $post->ID, 'wpcm_away_gaa_goals', true );
$gaa_points_away = get_post_meta( $post->ID, 'wpcm_away_gaa_points', true );

echo '<div class="cp-match-home-club">';

echo '<div class="cp-home-club-badge">';

if ( ot_get_option('match-crest') != 'off' ) {
	if ( has_post_thumbnail( $home_club ) ) {
		echo get_the_post_thumbnail( $home_club, 'crest-match', array( 'class' => 'home-logo' ) );
	} else {
		echo '<img src="' . $image . '" alt="" />';
	}
}

echo '</div>';

echo '<span>';

echo wpcm_get_team_name( $home_club, $post->ID );

echo '</span>';

if ( $home_club == $default_club && $show_team == 'yes' && is_array( $teams ) ) {
	foreach ( $teams as $team ) {
		echo '<i class="cp-match-title-meta">' . $team->name . '</i>';
	}
}

echo '<div class="cp-home-score">';

if ( $played ) {
	if ( $sport == 'gaelic' ) {
		echo $gaa_goals_home;
		echo '-';
		echo $gaa_points_home;
	} else {
 		echo $home_goals;
 	}
}

echo '</div></div>';