<?php 
/**
 * Results Widget
 *
 * @author 		Clubpress
 * @package 	WPClubManager/Templates
 * @version     1.3.1
 */

global $post;

$postid = get_the_ID();
$format = get_match_title_format();
$home_club = get_post_meta( $postid, 'wpcm_home_club', true );
$away_club = get_post_meta( $postid, 'wpcm_away_club', true );
$home_goals = get_post_meta( $postid, 'wpcm_home_goals', true );
$away_goals = get_post_meta( $postid, 'wpcm_away_goals', true );
$played = get_post_meta( $postid, 'wpcm_played', true );
$comps = get_the_terms( $postid, 'wpcm_comp' );
$comp_status = get_post_meta( $postid, 'wpcm_comp_status', true );
$teams = get_the_terms( $postid, 'wpcm_team' );
$sport = get_option('wpcm_sport');
if( $sport == 'gaelic' ) {
	$home_gaa_goals = get_post_meta( $postid, 'wpcm_home_gaa_goals', true );
	$home_gaa_points = get_post_meta( $postid, 'wpcm_home_gaa_points', true );
	$away_gaa_goals = get_post_meta( $postid, 'wpcm_away_gaa_goals', true );
	$away_gaa_points = get_post_meta( $postid, 'wpcm_away_gaa_points', true );
}
$teams = get_the_terms( $postid, 'wpcm_team' );
if( $format == '%home% vs %away%' ) :
	$side1 = $home_club;
	$side2 = $away_club;
	if ( $sport == 'gaelic' ) {
		$goals1 = $gaa_goals_home . '-' . $gaa_points_home;
		$goals2 = $gaa_goals_away . '-' . $gaa_points_away;
	} else {
		$goals1 = $home_goals;
		$goals2 = $away_goals;
	}
else :
	$side1 = $away_club;
	$side2 = $home_club;
	if ( $sport == 'gaelic' ) {
		$goals1 = $gaa_goals_away . '-' . $gaa_points_away;
		$goals2 = $gaa_goals_home . '-' . $gaa_points_home;
	} else {
		$goals1 = $away_goals;
		$goals2 = $home_goals;
	}
endif;
if( has_post_thumbnail( $side1 ) ) :
	$crest1 = get_the_post_thumbnail( $side1, 'crest-medium', array( 'title' => wpcm_get_team_name( $side1, $postid ) ) );
else :
	$crest1 = wpcm_crest_placeholder_img( 'crest-medium' );
endif;
if( has_post_thumbnail( $side2 ) ) :
	$crest2 = get_the_post_thumbnail( $side2, 'crest-medium', array( 'title' => wpcm_get_team_name( $side2, $postid ) ) );
else :
	$crest2 = wpcm_crest_placeholder_img( 'crest-medium' );
endif;

echo '<li class="cp-results-widget">';
	
	echo '<div class="post-meta group">';
		if ( $show_comp && is_array( $comps ) ):
			echo '<p class="post-category">';
			$i = 0;
			$len = count($comps);
			foreach ( $comps as $comp ):
				if ($i == 0) {
					echo $comp->name . '&nbsp;' . $comp_status;
				} else {
					echo ' / ' . $comp->name . '&nbsp;' . $comp_status;
				}
			endforeach;
			echo '</p>';
		endif;
		echo '<p class="post-date">';
			echo '<a href="' . get_permalink( $postid ) . '">';
				if ( $show_date ) {
					echo the_date('D j M');
				}
				if ( $show_time ) {
					echo ' &middot ';
					echo '<time>' . the_time() . '</time>';
				}
			echo '</a>';
		echo '</p>';		
	echo '</div>';

	echo '<a href="' . get_permalink( $postid ) . '">';
		echo '<div class="cp-club cp-club-home">';
			echo '<div class="cp-fixture-badge">' . $crest1 . '</div>';
			echo '<h4>' . wpcm_get_team_name( $side1, $postid );
				echo '<div class="cp-score">' . ( $played ? $goals1 : '' ) . '</div>';
			echo  '</h4>';
		echo '</div>';
		echo '<div class="cp-club">';
			echo '<div class="cp-fixture-badge">' . $crest2 . '</div>';
			echo '<h4>' . wpcm_get_team_name( $side2, $postid );
				echo '<div class="cp-score">' . ( $played ? $goals2 : '' ) . '</div>';
			echo  '</h4>';
		echo '</div>';
	echo '</a>';

	echo '<div class="post-meta">';

	echo '</div>';

echo '</li>';