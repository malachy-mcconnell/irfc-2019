<?php
/**
 * Fixtures Widget
 *
 * @author 		Clubpress
 * @package 	WPClubManager/Templates
 * @version     1.3.0
 */

global $post;

$postid = get_the_ID();
$format = get_match_title_format();
$home_club = get_post_meta( $postid, 'wpcm_home_club', true );
$away_club = get_post_meta( $postid, 'wpcm_away_club', true );
$comps = get_the_terms( $postid, 'wpcm_comp' );
$comp_status = get_post_meta( $postid, 'wpcm_comp_status', true );
$seasons = get_the_terms( $postid, 'wpcm_season' );
$teams = get_the_terms( $postid, 'wpcm_team' );
if( $format == '%home% vs %away%' ) :
	$side1 = $home_club;
	$side2 = $away_club;
else :
	$side1 = $away_club;
	$side2 = $home_club;
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
			
echo '<li class="cp-fixtures-widget">';
	
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
			echo '<a href="' . get_post_permalink( $postid, false, true ) . '">';
				if ( $show_date ) {
					echo the_time('D j M');
				}
				if ( $show_time ) {
					echo ' &middot ';
					echo '<time>' . the_time() . '</time>';
				}
			echo '</a>';
		echo '</p>';		
	echo '</div>';

	echo '<a href="' . get_post_permalink( $postid, false, true ) . '">';
		echo '<div class="cp-club cp-club-home">';
			echo '<div class="cp-fixture-badge">' . $crest1 . '</div>';
			echo '<h4>' . wpcm_get_team_name( $side1, $postid );
				echo '<div class="cp-blank-score"></div>';
			echo '</h4>';
		echo '</div>';
		echo '<div class="cp-club">';
			echo '<div class="cp-fixture-badge">' . $crest2 . '</div>';
			echo '<h4>' . wpcm_get_team_name( $side2, $postid );
				echo '<div class="cp-blank-score"></div>';
			echo '</h4>';
		echo '</div>';
	echo '</a>';

echo '</li>';