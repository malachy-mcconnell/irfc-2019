<?php
/**
 * Players
 *
 * @author 		Clubpress
 * @package 	WPClubManager/Templates
 * @version     1.3.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$default = array(
	'limit' => -1,
	'season' => null,
	'team' => null,
	'position' => null,
	'orderby' => 'number',
	'order' => 'ASC',
	'linktext' => __( 'View all players', 'scoreline' ),
	'linkpage' => null,
	'stats' => 'flag,number,name,position,age,height,weight',
	'title' => __( 'Players', 'scoreline' )
);

extract( $default, EXTR_SKIP );

$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();

$player_stats_labels = array_merge( array( 'appearances' => __( '<a title="Games Played">GP</a>', 'scoreline' ) ), $wpcm_player_stats_labels );

$stats_labels = array_merge(
	array(
		'flag' => '&nbsp;',
		'number' => '&nbsp;',
		'name' => __( 'Name', 'scoreline' ),
		'thumb' => '&nbsp',
		'position' => __( 'Position', 'scoreline' ),
		'age' => __( 'Age', 'scoreline' ),
		'height' => __( 'Height', 'scoreline' ),
		'weight' => __( 'Weight', 'scoreline' ),
		'team' => __( 'Team', 'scoreline' ),
		'season' => __( 'Season', 'scoreline' ),
		'dob' => __( 'Date of Birth', 'scoreline' ),
		'hometown' => __( 'Hometown', 'scoreline' ),
		'joined' => __( 'Joined', 'scoreline' )
	),
	$player_stats_labels
);

if ( $limit == 0 )
	$limit = -1;
if ( $team <= 0 )
	$team = null;

$stats = explode( ',', $stats );

foreach( $stats as $key => $value ) {
	$stats[$key] = strtolower( trim( $value ) );
	if ( !array_key_exists( $stats[$key], $stats_labels ) )
		unset( $stats[$key] );
}

$numposts = $limit;

if ( array_intersect_key( array_flip( $stats ), $player_stats_labels ) )
$numposts = -1;
$orderby = strtolower( $orderby );	
$order = strtoupper( $order );
$output = '';
$args = array(
	'post_type' => 'wpcm_player',
	'tax_query' => array(),
	'numposts' => $numposts,
	'posts_per_page' => $numposts,
	'orderby' => 'meta_value_num',
	'meta_key' => 'wpcm_number',
	'order' => $order,
	'suppress_filters' => 0
);

if ( $orderby == 'menu_order' ) {
    $args['orderby'] = 'menu_order';
}

if ( $orderby == 'name' ) {
    $args['orderby'] = 'name';
}

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
	if( $title ) {
		$title = '<caption>' . $title . '</caption>';
	} else{
		$title = '';
	}
	$output .= '<div class="cp-table-wrap">
		<table class="cp-table cp-table-full">
			' . $title . '
			<thead>
				<tr>';
				foreach( $stats as $stat ) {
					$output .= '<th class="cp-stats '. $stat . '">' . $stats_labels[$stat] .'</th>';
				}
				$output .= '</tr>
			</thead>
			<tbody>';

	$player_details = array();

	foreach( $players as $player ) {

		$player_details[$player->ID] = array();
		$count++;

		if ( array_intersect_key( array_flip( $stats ), $player_stats_labels ) )
			$player_stats = get_wpcm_player_stats_from_post( $player->ID );
			$number = get_post_meta( $player->ID, 'wpcm_number', true );
			$name = $player->post_title;
			$positions = get_the_terms( $player->ID, 'wpcm_position' );

		if ( has_post_thumbnail( $player->ID ) ) {
			$thumb = get_the_post_thumbnail( $player->ID, 'player-thumb' );
		} else {
			$thumb = '<img src="' . get_template_directory_uri() . '/img/player-thumb.png" alt="' . $name . '"/>';
		}

		if ( is_array( $positions ) ) {
			$position = reset($positions);
			$position = $position->name;

		} else {

			$position = __( 'None', 'scoreline' );

		}

		$dob = get_post_meta( $player->ID, 'wpcm_dob', true );
		$height = get_post_meta( $player->ID, 'wpcm_height', true );
		$weight = get_post_meta( $player->ID, 'wpcm_weight', true );
		$natl = get_post_meta( $player->ID, 'wpcm_natl', true );
		$hometown = get_post_meta( $player->ID, 'wpcm_hometown', true );

		foreach( $stats as $stat ) {

			if ( array_key_exists( $stat, $player_stats_labels ) )  {
				if ( $season ) {
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= $player_stats[0][ $season ]['total'][$stat];
				} else {
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= $player_stats[0][0]['total'][$stat];
				}
			} else {
				switch ( $stat ) {
				case 'thumb':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= '<a href="' . get_permalink( $player->ID ) . '">' . $thumb . '</a>';
					break;
				case 'flag':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= '<img class="flag" src="'. get_template_directory_uri() .'/img/flags/small/'. $natl .'.jpg" />';
					break;
				case 'number':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= $number;
					break;
				case 'name':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= '<a href="' . get_permalink( $player->ID ) . '">' . $name . '</a>';
					break;
				case 'position':
					$player_details[$player->ID][$stat] = '';
					$positions = get_the_terms( $player->ID, 'wpcm_position' );
					if ( is_array( $positions ) ) {
						$player_positions = array();
						foreach ( $positions as $position ) {
							$player_positions[] = $position->name;
						}
						$player_details[$player->ID][$stat] .= implode( ', ', $player_positions );
					}
					break;
				case 'team':
					$player_details[$player->ID][$stat] = '';
					$teams = get_the_terms( $player->ID, 'wpcm_team' );
					if ( is_array( $teams ) ) {
						$player_teams = array();
						foreach ( $teams as $team ) {
							$player_teams[] = $team->name;
						}
						$player_details[$player->ID][$stat] .= implode( ', ', $player_teams );
					}
					break;
				case 'season':
					$player_details[$player->ID][$stat] = '';
					$seasons = get_the_terms( $player->ID, 'wpcm_season' );
					if ( is_array( $seasons ) ) {
						$player_seasons = array();
						foreach ( $seasons as $season ) {
							$player_seasons[] = $season->name;
						}
						$player_details[$player->ID][$stat] .= implode( ', ', $player_seasons );
					}
					break;
				case 'age':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= get_age( get_post_meta( $player->ID, 'wpcm_dob', true ) );
					break;
				case 'dob':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= date_i18n( get_option( 'date_format' ), strtotime( get_post_meta( $player->ID, 'wpcm_dob', true ) ) );
					break;
				case 'height':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= $height;
					break;
				case 'weight':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= $weight;
					break;
				case 'hometown':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] .= '<img class="flag" src="'. WPCM_URL .'assets/images/flags/' . $natl . '.png" /> ' . $hometown;
					break;
				case 'joined':
					$player_details[$player->ID][$stat] = '';
					$player_details[$player->ID][$stat] = date_i18n( get_option( 'date_format' ), strtotime( $player->post_date ) );
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

		$output .=
		'<tr>';
		foreach( $stats as $stat ) {
			$output .= '<td class="cp-stats '. $stat . '">';
			if ( $stat == 'rating' ) {
				if ( $player_detail['rating'] > 0 ) {
					if ( $season ) {
						$player_details[$player->ID]['appearances'] = '';
						$player_details[$player->ID]['appearances'] = $player_stats[0][ $season ]['total']['appearances'];
					} else {
						$player_details[$player->ID]['appearances'] = '';
						$player_details[$player->ID]['appearances'] = $player_stats[0][0]['total']['appearances'];
					}
					$r = $player_detail['rating'];
					$a = $player_detail['appearances'];
					$avrating = wpcm_divide( $r, $a );
					$output .= sprintf( "%01.2f", round($avrating, 2) );
				} else {
					$output .= '0';
				}
			} else {
				$output .= $player_detail[$stat];
			}
			$output .= '</td>';
		}
		$output .= '</tr>';
	}
	$output .= '</tbody></table>';
	
	$output .= '</div>';

	if ( isset( $linkpage ) && $linkpage ) $output .= '<a href="' . get_page_link( $linkpage ) . '" class="wpcm-view-link">' . $linktext . '</a>';

	wp_reset_postdata();

} else {

	$output = '';
}

echo $output;