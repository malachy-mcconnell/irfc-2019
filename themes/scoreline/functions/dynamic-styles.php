<?php
/* ------------------------------------------------------------------------- *
 *  Dynamic styles
/* ------------------------------------------------------------------------- */

/*  Convert hexadecimal to rgb
/* ------------------------------------ */
if ( ! function_exists( 'cp_hex2rgb' ) ) {

	function cp_hex2rgb( $hex, $array=false ) {
		$hex = str_replace("#", "", $hex);

		if ( strlen($hex) == 3 ) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}

		$rgb = array( $r, $g, $b );
		if ( !$array ) { $rgb = implode(",", $rgb); }
		return $rgb;
	}
	
}	


/*  Google fonts
/* ------------------------------------ */
if ( ! function_exists( 'cp_google_fonts' ) ) {

	function cp_google_fonts () {
		if ( ot_get_option('dynamic-styles') != 'off' ) {
			if ( ot_get_option( 'font' ) == 'titillium-web-ext' ) { echo '<link href="//fonts.googleapis.com/css?family=Titillium+Web:400,400italic,300italic,300,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'droid-sans' ) { echo '<link href="//fonts.googleapis.com/css?family=Droid+Sans:400,400italic,700" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'source-sans-pro' ) { echo '<link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:400,300italic,300,400italic,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'lato' ) { echo '<link href="//fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'ubuntu' ) { echo '<link href="//fonts.googleapis.com/css?family=Ubuntu:400,400italic,300italic,300,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'ubuntu-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Ubuntu:400,400italic,300italic,300,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'roboto-condensed' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'roboto-condensed-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,400italic,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'open-sans' ) { echo '<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,600&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'open-sans-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,300italic,300,600&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'pt-serif' ) { echo '<link href="//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic&subset=latin,latin-ext" rel="stylesheet" type="text/css">'. "\n"; }
			if ( ot_get_option( 'font' ) == 'pt-serif-cyr' ) { echo '<link href="//fonts.googleapis.com/css?family=PT+Serif:400,700,400italic&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">'. "\n"; }
		}
	}	
	
}
add_action( 'wp_head', 'cp_google_fonts', 2 );	


/*  Dynamic css output
/* ------------------------------------ */
if ( ! function_exists( 'cp_dynamic_css' ) ) {

	function cp_dynamic_css() {
		if ( ot_get_option('dynamic-styles') != 'off' ) {
		
			// rgb values
			$color_1 = ot_get_option('color-1');
			$color_1_rgb = cp_hex2rgb($color_1);
			
			// start output
			$styles = '<style type="text/css">'."\n";
			$styles .= '/* Dynamic CSS: For no styles in head, copy and put the css below in your custom.css or child theme\'s style.css, disable dynamic styles */'."\n";		
			
			// google fonts
			if ( ot_get_option( 'font' ) == 'source-sans-pro-web' ) { $styles .= 'body { font-family: "Source Sans Pro", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'titillium-web-ext' ) { $styles .= 'body { font-family: "Titillium Web", Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'droid-sans' ) { $styles .= 'body { font-family: "Droid Sans", serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'lato' ) { $styles .= 'body { font-family: "Lato", Arial, sans-serif; }'."\n"; }
			if ( ( ot_get_option( 'font' ) == 'ubuntu' ) || ( ot_get_option( 'font' ) == 'ubuntu-cyr' ) ) { $styles .= 'body { font-family: "Ubuntu", Arial, sans-serif; }'."\n"; }	
			if ( ( ot_get_option( 'font' ) == 'roboto-condensed' ) || ( ot_get_option( 'font' ) == 'roboto-condensed-cyr' ) ) { $styles .= 'body { font-family: "Roboto Condensed", Arial, sans-serif; }'."\n"; }			
			if ( ( ot_get_option( 'font' ) == 'open-sans' ) || ( ot_get_option( 'font' ) == 'open-sans-cyr' ) )	{ $styles .= 'body { font-family: "Open Sans", Arial, sans-serif; }'."\n"; }
			if ( ( ot_get_option( 'font' ) == 'pt-serif' ) || ( ot_get_option( 'font' ) == 'pt-serif-cyr' ) ) { $styles .= 'body { font-family: "PT Serif", serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'arial' ) { $styles .= 'body { font-family: Arial, sans-serif; }'."\n"; }
			if ( ot_get_option( 'font' ) == 'georgia' ) { $styles .= 'body { font-family: Georgia, serif; }'."\n"; }
			
			// container width
			if ( ot_get_option('container-width') != '1380' ) {			
				if ( ot_get_option( 'boxed' ) ) { 
					$styles .= '.boxed #wrapper, .container-inner { max-width: '.ot_get_option('container-width').'px; }'."\n";
				}
				else {
					$styles .= '.container-inner { max-width: '.ot_get_option('container-width').'px; }'."\n";
				}
			}
			// primary color
			if ( ot_get_option('color-1') != '#3498db' ) {
				$styles .= '
::selection { background-color: '.ot_get_option('color-1').'; }
::-moz-selection { background-color: '.ot_get_option('color-1').'; }

a,
.cp-form label .required,
#flexslider-featured .flex-direction-nav .flex-next:hover,
#flexslider-featured .flex-direction-nav .flex-prev:hover,
.post-hover:hover .post-title a,
.post-title a:hover,
.post-nav li a:hover i,
.content .post-nav li a:hover i,
.s1 .widget_rss ul li a,
.s1 .widget_calendar a,
.s1 .cp-posts .post-item-category a,
.s1 .cp-posts li:hover .post-item-title a,
.comment-tabs li.active a,
.comment-awaiting-moderation,
.child-menu a:hover,
.child-menu .current_page_item > a,
.post-nav li a:hover i,
table.wpcm-ss-table thead th { color: '.ot_get_option('color-1').'; }

.s1 .sidebar-top,
.s1 .sidebar-toggle,
.widget > h3,
.flex-control-nav li a.flex-active,
.post-tags a:hover,
.widget_calendar caption,
.author-bio .bio-avatar:after,
.commentlist li.bypostauthor > .comment-body:after,
.commentlist li.comment-author-admin > .comment-body:after,
.wp-pagenavi a,
table.cp-table thead tr th.cp-stats,
table.cp-table thead tr th.cp-player-stat,
table.cp-table thead tr th.cp-match-stat,
.s1 table.cp-table thead tr th.cp-stats,
.s1 table.cp-table thead tr th.cp-player-stat,
.s1 table.cp-table thead tr th.cp-match-stat,
.cp-home-score,
.cp-away-score,
.cp-players-widget .post-comments,
.cp-score,
#wpcm-pa-season-tabs li { background-color: '.ot_get_option('color-1').'; }
table.cp-table td.pos,
.s1 table.cp-table td.pos { background-color: '.ot_get_option('color-1').' !important; }

.post-format .format-container { border-color: '.ot_get_option('color-1').'; }

.comment-tabs li.active a,
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current { border-bottom-color: '.ot_get_option('color-1').'!important; }				
				'."\n";
			}		
			// secondary color
			if ( ot_get_option('color-2') != '#ff4444' ) {
				$styles .= '
.s2 .post-nav li a:hover i,
.s2 .widget_rss ul li a,
.s2 .widget_calendar a,
.s2 .cp-tab .tab-item-category a,
.s2 .cp-posts .post-item-category a,
.s2 .cp-tab li:hover .tab-item-title a,
.s2 .cp-tab li:hover .tab-item-comment a,
.s2 .cp-posts li:hover .post-item-title a { color: '.ot_get_option('color-2').'; }

.s2 .sidebar-top,
.s2 .sidebar-toggle,
.s2 .widget > h3,
.s2 .flex-control-nav li a.flex-active,
.s2 .post-comments,
.s2 .widget_calendar caption,
.s2 .cp-match-overtime,
.s2 .cp-players-widget .post-comments,
.s2 .cp-score,
.s2 table.cp-table thead tr th.cp-player-stat,
.s2 table.cp-table thead tr th.cp-match-stat,
.s2 table.cp-table thead tr th.cp-stats { background-color: '.ot_get_option('color-2').'; }
.s2 table.cp-table td.pos { background-color: '.ot_get_option('color-2').' !important; }

.s2 .post-comments span:before { border-right-color: '.ot_get_option('color-2').'; }				
				'."\n";
			}			
			// header color
			if ( ot_get_option('color-header') != '#222' ) {
				$styles .= '
#header { background-color: '.ot_get_option('color-header').'; }			
				'."\n";
			}			
			// header logo max-height
			if ( ot_get_option('logo-max-height') != '60' ) {
				$styles .= '.site-title a img { max-height: '.ot_get_option('logo-max-height').'px; }'."\n";
			}
			// image border radius
			if ( ot_get_option('image-border-radius') != '0' ) {
				$styles .= 'img { -webkit-border-radius: '.ot_get_option('image-border-radius').'px; border-radius: '.ot_get_option('image-border-radius').'px; }'."\n";
			}
			// body background
			if ( ot_get_option('body-background') != '' ) {
				
				$body_background = ot_get_option('body-background');
				$body_color = $body_background['background-color'];
				$body_image = $body_background['background-image'];
				$body_position = $body_background['background-position'];
				$body_attachment = $body_background['background-attachment'];
				$body_repeat = $body_background['background-repeat'];
				$body_size = $body_background['background-size'];
				
				if ( $body_image && $body_size == "" ) {
					$styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; }'."\n";
				} elseif ( $body_image && $body_size != "" ) {
					$styles .= 'body { background: '.$body_color.' url('.$body_image.') '.$body_attachment.' '.$body_position.' '.$body_repeat.'; background-size: '.$body_size.'; }'."\n";
				} elseif ( $body_background['background-color'] ) {
					$styles .= 'body { background-color: '.$body_color.'; }'."\n";
				} else {
					$styles .= '';
				}
			}
			// match title backgrounds
			if ( ot_get_option('match-crest') != 'off' && is_match() ) {
				if ( get_option('wpcm_match_title_format') == '%home% vs %away%') {
					$home_club = get_post_meta( get_the_ID(), 'wpcm_home_club', true );
					$away_club = get_post_meta( get_the_ID(), 'wpcm_away_club', true );
				} else {
					$home_club = get_post_meta( get_the_ID(), 'wpcm_away_club', true );
					$away_club = get_post_meta( get_the_ID(), 'wpcm_home_club', true );
				}
				if ( has_post_thumbnail($home_club) ) {
					$home_badge = wp_get_attachment_image_src( get_post_thumbnail_id($home_club ), 'crest-match-bg' );
				} else {
					$home_badge[0] = get_template_directory_uri() . '/img/crest-large.png';
				}
				if ( has_post_thumbnail($away_club) ) {
					$away_badge = wp_get_attachment_image_src( get_post_thumbnail_id($away_club ), 'crest-match-bg' );
				} else {
					$away_badge[0] = get_template_directory_uri() . '/img/crest-large.png';
				}
				$image = get_template_directory_uri().'/img/opacity.png';
				$home = $home_badge[0];
				$away = $away_badge[0];
				$styles .= '.cp-match-title { background: url( '.$image.' ) repeat-y center left/320px auto, url( '.$home.' ) no-repeat center left/320px auto, url( '.$image.' ) repeat-y center right/320px auto, url( '.$away.' ) no-repeat center right/320px auto;}'."\n";
			}
			
			$styles .= '</style>'."\n";
			// end output
			
			echo $styles;		
		}
	}
	
}
add_action( 'wp_head', 'cp_dynamic_css', 100 );
