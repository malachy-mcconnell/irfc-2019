<?php
/* ------------------------------------------------------------------------- *
 *  Custom functions
/* ------------------------------------------------------------------------- */
	
	// Use a child theme instead of placing custom functions here
	// http://codex.wordpress.org/Child_Themes


/* ------------------------------------------------------------------------- *
 *  OptionTree framework integration: Use in theme mode
/* ------------------------------------------------------------------------- */
	
	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	add_filter( 'ot_theme_mode', '__return_true' );
	load_template( get_template_directory() . '/option-tree/ot-loader.php' );


/* ------------------------------------------------------------------------- *
 *  Load theme files
/* ------------------------------------------------------------------------- */	

if ( ! function_exists( 'cp_load' ) ) {
	
	function cp_load() {
		// Load theme languages
		load_theme_textdomain( 'scoreline', get_template_directory().'/languages' );
		$locale = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );
		
		// Load theme options and meta boxes
		load_template( get_template_directory() . '/functions/theme-options.php' );
		load_template( get_template_directory() . '/functions/meta-boxes.php' );
		
		// Load custom widgets
		load_template( get_template_directory() . '/functions/widgets/cp-posts.php' );
		load_template( get_template_directory() . '/functions/widgets/cp-players.php' );
		
		// Load custom shortcodes
		load_template( get_template_directory() . '/functions/shortcodes.php' );

		// Load dynamic styles
		load_template( get_template_directory() . '/functions/dynamic-styles.php' );
		
		// Load TGM plugin activation
		load_template( get_template_directory() . '/functions/class-tgm-plugin-activation.php' );

		// Load shortcode buttons
		load_template( get_template_directory() . '/functions/editor/editor.php' );

		if ( defined('DOING_AJAX') ) {
			// Load shortcode buttons ajax
			load_template( get_template_directory() . '/functions/editor/editor-ajax.php' );
		}
	}
	
}
add_action( 'after_setup_theme', 'cp_load' );	


/* ------------------------------------------------------------------------- *
 *  Base functionality
/* ------------------------------------------------------------------------- */
	
	// Content width
	if ( !isset( $content_width ) ) { $content_width = 720; }


/*  Theme setup
/* ------------------------------------ */
if ( ! function_exists( 'cp_setup' ) ) {
	
	function cp_setup() {		
		// Enable automatic feed links
		add_theme_support( 'automatic-feed-links' );
		
		// Enable featured image
		add_theme_support( 'post-thumbnails' );
		
		// Enable post format support
		add_theme_support( 'post-formats', array( 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
		
		// Declare WP Club Manager support
		add_theme_support( 'wpclubmanager' );

		// Declare WooCommerce support
		add_theme_support( 'woocommerce' );
		
		// Thumbnail sizes
		add_image_size( 'thumb-small', 160, 160, true );
		add_image_size( 'thumb-medium', 520, 245, true );
		add_image_size( 'thumb-large', 720, 340, true );
		add_image_size( 'player-thumb', 40, 40, true);
		add_image_size( 'player-small', 135, 180, true);
		add_image_size( 'player-medium', 300, 400, true);
		add_image_size( 'crest-thumb', 99, 38, false);
		add_image_size( 'crest-match', 999, 100, false);
		add_image_size( 'crest-match-bg', 320, 999, false);

		// Custom menu areas
		register_nav_menus( array(
			'topbar' => 'Topbar',
			'header' => 'Header',
			'footer' => 'Footer',
		) );
	}
	
}
add_action( 'after_setup_theme', 'cp_setup' );


/*  Register sidebars
/* ------------------------------------ */	
if ( ! function_exists( 'cp_sidebars' ) ) {

	function cp_sidebars()	{
		register_sidebar(array( 'name' => 'Primary','id' => 'primary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		register_sidebar(array( 'name' => 'Secondary','id' => 'secondary','description' => "Normal full width sidebar", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
		if ( ot_get_option('home-widgets') >= '1' ) { register_sidebar(array( 'name' => 'Home 1','id' => 'home-1', 'description' => "Widetized home", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('home-widgets') >= '2' ) { register_sidebar(array( 'name' => 'Home 2','id' => 'home-2', 'description' => "Widetized home", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('home-widgets') >= '3' ) { register_sidebar(array( 'name' => 'Home 3','id' => 'home-3', 'description' => "Widetized home", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('home-widgets') >= '4' ) { register_sidebar(array( 'name' => 'Home 4','id' => 'home-4', 'description' => "Widetized home", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-widgets') >= '1' ) { register_sidebar(array( 'name' => 'Footer 1','id' => 'footer-1', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-widgets') >= '2' ) { register_sidebar(array( 'name' => 'Footer 2','id' => 'footer-2', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-widgets') >= '3' ) { register_sidebar(array( 'name' => 'Footer 3','id' => 'footer-3', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
		if ( ot_get_option('footer-widgets') >= '4' ) { register_sidebar(array( 'name' => 'Footer 4','id' => 'footer-4', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>')); }
	}
	
}
add_action( 'widgets_init', 'cp_sidebars' );


/*  Enqueue javascript
/* ------------------------------------ */	
if ( ! function_exists( 'cp_scripts' ) ) {
	
	function cp_scripts() {
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.min.js', array( 'jquery' ),'', false );
		wp_enqueue_script('imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', null, false, true);
		wp_enqueue_script('qtip', get_template_directory_uri() . '/js/jquery.qtip.min.js', array('jquery', 'imagesloaded'), false, true);
		wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ),'', true );
		if ( is_singular() ) { wp_enqueue_script( 'sharrre', get_template_directory_uri() . '/js/jquery.sharrre.min.js', array( 'jquery' ),'', true ); }
		if ( is_singular() && get_option( 'thread_comments' ) )	{ wp_enqueue_script( 'comment-reply' ); }
	}  
	
}
add_action( 'wp_enqueue_scripts', 'cp_scripts' ); 


/*  Enqueue css
/* ------------------------------------ */	
if ( ! function_exists( 'cp_styles' ) ) {
	
	function cp_styles() {
		wp_enqueue_style( 'style', get_stylesheet_uri() );
		if ( ot_get_option('responsive') != 'off' ) { wp_enqueue_style( 'responsive', get_template_directory_uri().'/responsive.css' ); }
		if ( ot_get_option('custom') == 'on' ) { wp_enqueue_style( 'custom', get_template_directory_uri().'/custom.css' ); }
		wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/fonts/font-awesome.min.css' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'cp_styles' );


/*  Register custom sidebars
/* ------------------------------------ */
if ( ! function_exists( 'cp_custom_sidebars' ) ) {

	function cp_custom_sidebars() {
		if ( !ot_get_option('sidebar-areas') =='' ) {
			
			$sidebars = ot_get_option('sidebar-areas', array());
			
			if ( !empty( $sidebars ) ) {
				foreach( $sidebars as $sidebar ) {
					if ( isset($sidebar['title']) && !empty($sidebar['title']) && isset($sidebar['id']) && !empty($sidebar['id']) && ($sidebar['id'] !='sidebar-') ) {
						register_sidebar(array('name' => ''.$sidebar['title'].'','id' => ''.strtolower($sidebar['id']).'','before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
					}
				}
			}
		}
	}
	
}
add_action( 'widgets_init', 'cp_custom_sidebars' );


/* ------------------------------------------------------------------------- *
 *  Template functions
/* ------------------------------------------------------------------------- */	

/*  Layout class
/* ------------------------------------ */
if ( ! function_exists( 'cp_layout_class' ) ) {
	
	function cp_layout_class() {

		// Default layout
		$layout = 'col-3cm';
		$default = 'col-3cm';

		// Check for page/post specific layout
		if ( is_page() || is_single() || is_player() || is_match() || is_front_page() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_layout',true);
			// Get if set and not set to inherit
			if ( isset($meta) && !empty($meta) && $meta != 'inherit' ) { $layout = $meta; }
			// Else check for page-global / single-global
			elseif ( is_single() && ( ot_get_option('layout-single') !='inherit' ) ) $layout = ot_get_option('layout-single',''.$default.'');
			elseif ( is_player() && ( ot_get_option('layout-player') !='inherit' ) ) $layout = ot_get_option('layout-player',''.$default.'');
			elseif ( is_match() && ( ot_get_option('layout-match') !='inherit' ) ) $layout = ot_get_option('layout-match',''.$default.'');
			elseif ( is_front_page() && ( ot_get_option('layout-home') !='inherit' ) ) $layout = ot_get_option('layout-home',''.$default.'');
			elseif ( is_page() && ( ot_get_option('layout-page') !='inherit' ) ) $layout = ot_get_option('layout-page',''.$default.'');
			// Else get global option
			else $layout = ot_get_option('layout-global',''.$default.'');
		}
		
		// Set layout based on page
		elseif ( is_home() && ( ot_get_option('layout-blog') !='inherit' ) ) $layout = ot_get_option('layout-blog',''.$default.'');
		elseif ( is_category() && ( ot_get_option('layout-archive-category') !='inherit' ) ) $layout = ot_get_option('layout-archive-category',''.$default.'');
		elseif ( is_archive() && ( ot_get_option('layout-archive') !='inherit' ) ) $layout = ot_get_option('layout-archive',''.$default.'');
		elseif ( is_search() && ( ot_get_option('layout-search') !='inherit' ) ) $layout = ot_get_option('layout-search',''.$default.'');
		elseif ( is_404() && ( ot_get_option('layout-404') !='inherit' ) ) $layout = ot_get_option('layout-404',''.$default.'');
		
		// Global option
		else $layout = ot_get_option('layout-global',''.$default.'');
		
		// Return layout class
		return $layout;
	}
	
}


/*  Dynamic sidebar primary
/* ------------------------------------ */
if ( ! function_exists( 'cp_sidebar_primary' ) ) {
	
	function cp_sidebar_primary() {
		// Default sidebar
		$sidebar = 'primary';

		// Set sidebar based on page
		if ( is_front_page() && ot_get_option('s1-home') ) $sidebar = ot_get_option('s1-home');
		if ( is_home() && ot_get_option('s1-blog') ) $sidebar = ot_get_option('s1-blog');
		if ( is_single() && ot_get_option('s1-single') ) $sidebar = ot_get_option('s1-single');
		if ( is_player() && ot_get_option('s1-player') ) $sidebar = ot_get_option('s1-player');
		if ( is_match() && ot_get_option('s1-match') ) $sidebar = ot_get_option('s1-match');
		if ( is_archive() && ot_get_option('s1-archive') ) $sidebar = ot_get_option('s1-archive');
		if ( is_category() && ot_get_option('s1-archive-category') ) $sidebar = ot_get_option('s1-archive-category');
		if ( is_search() && ot_get_option('s1-search') ) $sidebar = ot_get_option('s1-search');
		if ( is_404() && ot_get_option('s1-404') ) $sidebar = ot_get_option('s1-404');
		if ( is_page() && ot_get_option('s1-page') ) $sidebar = ot_get_option('s1-page');

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_sidebar_primary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}
	
}


/*  Dynamic sidebar secondary
/* ------------------------------------ */
if ( ! function_exists( 'cp_sidebar_secondary' ) ) {

	function cp_sidebar_secondary() {
		// Default sidebar
		$sidebar = 'secondary';

		// Set sidebar based on page
		if ( is_front_page() && ot_get_option('s2-home') ) $sidebar = ot_get_option('s2-home');
		if ( is_home() && ot_get_option('s2-blog') ) $sidebar = ot_get_option('s2-blog');
		if ( is_single() && ot_get_option('s2-single') ) $sidebar = ot_get_option('s2-single');
		if ( is_player() && ot_get_option('s2-player') ) $sidebar = ot_get_option('s2-player');
		if ( is_match() && ot_get_option('s2-match') ) $sidebar = ot_get_option('s2-match');
		if ( is_archive() && ot_get_option('s2-archive') ) $sidebar = ot_get_option('s2-archive');
		if ( is_category() && ot_get_option('s2-archive-category') ) $sidebar = ot_get_option('s2-archive-category');
		if ( is_search() && ot_get_option('s2-search') ) $sidebar = ot_get_option('s2-search');
		if ( is_404() && ot_get_option('s2-404') ) $sidebar = ot_get_option('s2-404');
		if ( is_page() && ot_get_option('s2-page') ) $sidebar = ot_get_option('s2-page');

		// Check for page/post specific sidebar
		if ( is_page() || is_single() ) {
			// Reset post data
			wp_reset_postdata();
			global $post;
			// Get meta
			$meta = get_post_meta($post->ID,'_sidebar_secondary',true);
			if ( $meta ) { $sidebar = $meta; }
		}

		// Return sidebar
		return $sidebar;
	}
	
}


/*  Social links
/* ------------------------------------ */
if ( ! function_exists( 'cp_social_links' ) ) {

	function cp_social_links() {
		if ( !ot_get_option('social-links') =='' ) {
			$links = ot_get_option('social-links', array());
			if ( !empty( $links ) ) {
				echo '<ul class="social-links">';	
				foreach( $links as $item ) {
					
					// Build each separate html-section only if set
					if ( isset($item['social-link']) && !empty($item['social-link']) ) 
						{ $link = 'href="' .$item['social-link']. '"'; } else $link = '';
					if ( isset($item['social-icon']) && !empty($item['social-icon']) ) 
						{ $icon = 'class="fa ' .$item['social-icon']. '"'; } else $icon = '';
					if ( isset($item['social-color']) && !empty($item['social-color']) ) 
						{ $color = 'style="background: ' .$item['social-color']. ';border: 4px solid ' .$item['social-color']. ';"'; } else $color = '';
					
					// Put them together
					if ( isset($item['title']) && !empty($item['title']) && isset($item['social-icon']) && !empty($item['social-icon']) && ($item['social-icon'] !='fa-') ) {
						echo '<li><a rel="nofollow" class="social-tooltip" '.$link.' target="_blank"><i '.$icon.' '.$color.'></i></a></li>';
					}
				}
				echo '</ul>';
			}
		}
	}
	
}


/*  Site name/logo
/* ------------------------------------ */
if ( ! function_exists( 'cp_site_title' ) ) {

	function cp_site_title() {
	
		// Text or image?
		if ( ot_get_option('custom-logo') ) {
			$logo = '<img src="'.ot_get_option('custom-logo').'" alt="'.get_bloginfo('name').'"/>';
		} else {
			$logo = '';
		}
		if ( ot_get_option('site-description') != 'off' ) {
			$description = '<p class="site-description">'.get_bloginfo( 'description' ).'</p>';
		} else {
			$description = '';
		}
		
		if ( is_front_page() || is_home() ) {
			$link = '<a href="'.home_url('/').'" rel="home">'.$logo.'<h1 class="site-name">'.get_bloginfo('name').'</h1>'.$description.'</a>';
		} else {
			$link = '<a href="'.home_url('/').'" rel="home">'.$logo.'<p class="site-name">'.get_bloginfo('name').'</p>'.$description.'</a>';
		}
		
		$sitename = '<div class="site-title">'.$link.'</div>'."\n";
		
		return $sitename;
	}
	
}


/*  Page title
/* ------------------------------------ */
if ( ! function_exists( 'cp_page_title' ) ) {

	function cp_page_title() {
		global $post;

		$heading = get_post_meta($post->ID,'_heading',true);
		$subheading = get_post_meta($post->ID,'_subheading',true);
		$title = $heading?$heading:the_title();
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		return $title;
	}
	
}

/*  Home title
/* ------------------------------------ */
if ( ! function_exists( 'cp_home_title' ) ) {

	function cp_home_title() {
		global $post;
		$heading = ot_get_option('home-heading');
		$subheading = ot_get_option('home-subheading');
		if($heading) { 
			$title = $heading;
		} else {
			$title = get_bloginfo('name');
		}
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		return $title;
	}
	
}


/*  Blog title
/* ------------------------------------ */
if ( ! function_exists( 'cp_blog_title' ) ) {

	function cp_blog_title() {
		global $post;
		$heading = ot_get_option('blog-heading');
		$subheading = ot_get_option('blog-subheading');
		if($heading) { 
			$title = $heading;
		} else {
			$title = get_bloginfo('name');
		}
		if($subheading) {
			$title = $title.' <span>'.$subheading.'</span>';
		}

		return $title;
	}
	
}


/*  Related posts
/* ------------------------------------ */
if ( ! function_exists( 'cp_related_posts' ) ) {

	function cp_related_posts() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> 3
		);
		// Related by categories
		if ( ot_get_option('related-posts') == 'categories' ) {
			
			$cats = get_post_meta($post->ID, 'related-cat', true);
			
			if ( !$cats ) {
				$cats = wp_get_post_categories($post->ID, array('fields'=>'ids'));
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( ot_get_option('related-posts') == 'tags' ) {
		
			$tags = get_post_meta($post->ID, 'related-tag', true);
			
			if ( !$tags ) {
				$tags = wp_get_post_tags($post->ID, array('fields'=>'ids'));
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode(',', $tags);
			}
			if ( !$tags ) { $break = true; }
		}
		
		$query = !isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}
	
}


/*  Get images attached to post
/* ------------------------------------ */
if ( ! function_exists( 'cp_post_images' ) ) {

	function cp_post_images( $args=array() ) {
		global $post;

		$defaults = array(
			'numberposts'		=> -1,
			'order'				=> 'ASC',
			'orderby'			=> 'menu_order',
			'post_mime_type'	=> 'image',
			'post_parent'		=>  $post->ID,
			'post_type'			=> 'attachment',
		);

		$args = wp_parse_args( $args, $defaults );

		return get_posts( $args );
	}
	
}


/*  Get featured post ids
/* ------------------------------------ */
if ( ! function_exists( 'cp_get_featured_post_ids' ) ) {

	function cp_get_featured_post_ids() {
		$args = array(
			'category'		=> ot_get_option('featured-category'),
			'numberposts'	=> ot_get_option('featured-posts-count')
		);
		$posts = get_posts($args);
		if ( !$posts ) return false;
		foreach ( $posts as $post )
			$ids[] = $post->ID;
		return $ids;
	}
	
}


/* ------------------------------------------------------------------------- *
 *  Admin panel functions
/* ------------------------------------------------------------------------- */		

/*  Post formats script
/* ------------------------------------ */
if ( ! function_exists( 'cp_post_formats_script' ) ) {

	function cp_post_formats_script( $hook ) {
		// Only load on posts, pages
		if ( !in_array($hook, array('post.php','post-new.php')) ) {
			wp_enqueue_script('post-formats', get_template_directory_uri() . '/functions/js/post-formats.js', array( 'jquery' ));
		}

		wp_enqueue_style( 'cp-players', get_template_directory_uri() . '/functions/editor/editor.css' );
	}
	
}
add_action( 'admin_enqueue_scripts', 'cp_post_formats_script');


/* ------------------------------------------------------------------------- *
 *  Filters
/* ------------------------------------------------------------------------- */

/*  Body class
/* ------------------------------------ */
if ( ! function_exists( 'cp_body_class' ) ) {

	function cp_body_class( $classes ) {
		$classes[] = cp_layout_class();
		if ( ot_get_option( 'boxed' ) != 'on' ) { $classes[] = 'full-width'; }
		if ( ot_get_option( 'boxed' ) == 'on' ) { $classes[] = 'boxed'; }
		if ( has_nav_menu('topbar') ) {	$classes[] = 'topbar-enabled'; }
		if ( ot_get_option( 'mobile-sidebar-hide' ) == 's1' ) { $classes[] = 'mobile-sidebar-hide-s1'; }
		if ( ot_get_option( 'mobile-sidebar-hide' ) == 's2' ) { $classes[] = 'mobile-sidebar-hide-s2'; }
		if ( ot_get_option( 'mobile-sidebar-hide' ) == 's1-s2' ) { $classes[] = 'mobile-sidebar-hide'; }
		return $classes;
	}
	
}
add_filter( 'body_class', 'cp_body_class' );


/*  Site title
/* ------------------------------------ */
if ( ! function_exists( 'cp_wp_title' ) ) {

	function cp_wp_title( $title ) {
		// Do not filter for RSS feed / if SEO plugin installed
		if ( is_feed() || class_exists('All_in_One_SEO_Pack') || class_exists('HeadSpace_Plugin') || class_exists('Platinum_SEO_Pack') || class_exists('wpSEO') || defined('WPSEO_VERSION') )
			return $title;
		if ( is_front_page() ) { 
			$title = bloginfo('name'); echo ' - '; bloginfo('description'); 
		}
		if ( !is_front_page() ) { 
			$title.= ''.' - '.''.get_bloginfo('name'); 
		}
		return $title;
	}
	
}
add_filter( 'wp_title', 'cp_wp_title' );


/*  Custom favicon
/* ------------------------------------ */
if ( ! function_exists( 'cp_favicon' ) ) {

	function cp_favicon() {
		if ( ot_get_option('favicon') ) {
			echo '<link rel="shortcut icon" href="'.ot_get_option('favicon').'" />'."\n";
		}
	}
	
}
add_filter( 'wp_head', 'cp_favicon' );


/*  Excerpt ending
/* ------------------------------------ */
if ( ! function_exists( 'cp_excerpt_more' ) ) {

	function cp_excerpt_more( $more ) {
		return '&#46;&#46;&#46;';
	}
	
}
add_filter( 'excerpt_more', 'cp_excerpt_more' );


/*  Excerpt length
/* ------------------------------------ */
if ( ! function_exists( 'cp_excerpt_length' ) ) {

	function cp_excerpt_length( $length ) {
		return ot_get_option('excerpt-length',$length);
	}
	
}
add_filter( 'excerpt_length', 'cp_excerpt_length', 999 );


/*  Add wmode transparent to media embeds
/* ------------------------------------ */
if ( ! function_exists( 'cp_embed_wmode_transparent' ) ) {
	
	function cp_embed_wmode_transparent( $html, $url, $attr ) {
		if ( strpos( $html, "<embed src=" ) !== false )
		   { return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); }
		elseif ( strpos ( $html, 'feature=oembed' ) !== false )
		   { return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); }
		else
		   { return $html; }
	}
	
}
add_filter( 'embed_oembed_html', 'cp_embed_wmode_transparent', 10, 3 );


/*  Add responsive container to embeds
/* ------------------------------------ */	
if ( ! function_exists( 'cp_embed_html' ) ) {

	function cp_embed_html( $html ) {
		return '<div class="video-container">' . $html . '</div>';
	}

}
add_filter( 'embed_oembed_html', 'cp_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'cp_embed_html' ); // Jetpack


/*  Upscale cropped thumbnails
/* ------------------------------------ */
if ( ! function_exists( 'cp_thumbnail_upscale' ) ) {

	function cp_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
		if ( !$crop ) return null; // let the wordpress default function handle this

		$aspect_ratio = $orig_w / $orig_h;
		$size_ratio = max($new_w / $orig_w, $new_h / $orig_h);

		$crop_w = round($new_w / $size_ratio);
		$crop_h = round($new_h / $size_ratio);

		$s_x = floor( ($orig_w - $crop_w) / 2 );
		$s_y = floor( ($orig_h - $crop_h) / 2 );

		return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
	}
	
}
add_filter( 'image_resize_dimensions', 'cp_thumbnail_upscale', 10, 6 );


/*  Add shortcode support to text widget
/* ------------------------------------ */
add_filter( 'widget_text', 'do_shortcode' );


/*  Browser detection body_class() output
/* ------------------------------------ */
if ( ! function_exists( 'cp_browser_body_class' ) ) {

	function cp_browser_body_class( $classes ) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE) {
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$browser = substr( "$browser", 25, 8);
			if ($browser == "MSIE 7.0"  ) {
				$classes[] = 'ie7';
				$classes[] = 'ie';
			} elseif ($browser == "MSIE 6.0" ) {
				$classes[] = 'ie6';
				$classes[] = 'ie';
			} elseif ($browser == "MSIE 8.0" ) {
				$classes[] = 'ie8';
				$classes[] = 'ie';
			} elseif ($browser == "MSIE 9.0" ) {
				$classes[] = 'ie9';
				$classes[] = 'ie';
			} else {
				$classes[] = 'ie';
			}
		}
		else $classes[] = 'unknown';

		if( $is_iphone ) $classes[] = 'iphone';

		return $classes;
	}
	
}
add_filter( 'body_class', 'cp_browser_body_class' );


/*  Script for no-js / js class
/* ------------------------------------ */
if ( ! function_exists( 'cp_html_js_class' ) ) {

	function cp_html_js_class () {
		echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
	}
	
}
add_action( 'wp_head', 'cp_html_js_class', 1 );


/*  IE js header
/* ------------------------------------ */
if ( ! function_exists( 'cp_ie_js_header' ) ) {

	function cp_ie_js_header () {
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/html5.js' ) . '"></script>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/selectivizr.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";
	}
	
}
add_action( 'wp_head', 'cp_ie_js_header' );


/*  IE js footer
/* ------------------------------------ */
if ( ! function_exists( 'cp_ie_js_footer' ) ) {

	function cp_ie_js_footer () {
		echo '<!--[if lt IE 9]>'. "\n";
		echo '<script src="' . esc_url( get_template_directory_uri() . '/js/ie/respond.js' ) . '"></script>'. "\n";
		echo '<![endif]-->'. "\n";
	}
	
}
add_action( 'wp_footer', 'cp_ie_js_footer', 20 );	


/*  TGM plugin activation
/* ------------------------------------ */
if ( ! function_exists( 'cp_plugins' ) ) {
	
	function cp_plugins() {
		
		// Add the following plugins
		$plugins = array(
			array(
				'name' 				=> 'WP Club Manager',
				'slug' 				=> 'wp-club-manager',
				'required'			=> true,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'Regenerate Thumbnails',
				'slug' 				=> 'regenerate-thumbnails',
				'required'			=> false,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'WP-PageNavi',
				'slug' 				=> 'wp-pagenavi',
				'required'			=> false,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'Responsive Lightbox',
				'slug' 				=> 'light',
				'source'			=> get_template_directory() . '/functions/plugins/light.zip',
				'required'			=> false,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			),
			array(
				'name' 				=> 'Contact Form 7',
				'slug' 				=> 'contact-form-7',
				'required'			=> false,
				'force_activation' 	=> false,
				'force_deactivation'=> false,
			)
		);	
		tgmpa( $plugins );
	}
	
}
add_action( 'tgmpa_register', 'cp_plugins' );


/*  WP-PageNavi support - @devinsays (via GitHub)
/* ------------------------------------ */
function cp_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
	wp_deregister_style( 'wpclubmanager-general' );
}
add_action( 'wp_print_styles', 'cp_deregister_styles', 100 );


/*  WP Club Manager support
/* ------------------------------------ */
function cp_wrapper_start() {
	echo '<section class="content">';
	echo '';
}
function cp_wrapper_end() {
	echo '';
	echo '</section>';
}
// remove wrappers actions
remove_action( 'wpclubmanager_before_main_content', 'wpclubmanager_output_content_wrapper', 10);
remove_action( 'wpclubmanager_after_main_content', 'wpclubmanager_output_content_wrapper_end', 10);
// add custom wrapper actions
add_action('wpclubmanager_before_main_content', 'cp_wrapper_start', 10);
add_action('wpclubmanager_after_main_content', 'cp_wrapper_end', 10);
// remove template actions
remove_action( 'wpclubmanager_single_match_fixture', 'wpclubmanager_template_single_match_score', 10);
remove_action( 'wpclubmanager_single_match_meta', 'wpclubmanager_template_single_match_team', 10);
remove_action( 'wpclubmanager_single_match_info', 'wpclubmanager_template_single_match_home_club_badge', 5);
remove_action( 'wpclubmanager_single_match_info', 'wpclubmanager_template_single_match_date', 10);
remove_action( 'wpclubmanager_single_match_info', 'wpclubmanager_template_single_match_comp', 20);
remove_action( 'wpclubmanager_single_match_info', 'wpclubmanager_template_single_match_away_club_badge', 30);
remove_action( 'wpclubmanager_single_match_venue', 'wpclubmanager_template_single_match_attendance', 10);


/*  Profile stats table data
/* ------------------------------------ */
if ( ! function_exists( 'cp_profile_stats_td' ) ) {

	function cp_profile_stats_td( $stats = array(), $team = 0, $season = 0 ) {

		if ( array_key_exists( $team, $stats ) ):

			if ( array_key_exists( $season, $stats[$team] ) ):

				$stats = $stats[$team][$season];
			endif;
		endif;

		$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();

		$stats_labels = array( 'appearances' => '<a title="' . __('Games Played', 'scoreline') . '">' . __( 'GP', 'scoreline' ) . '</a>' );
		$stats_labels = array_merge( $stats_labels, $wpcm_player_stats_labels ); ?>

		<?php foreach( $stats_labels as $key => $val ) {

			if( $key == 'rating' ) {

				$rating = get_wpcm_stats_value( $stats, 'total', 'rating' );
				$apps = get_wpcm_stats_value( $stats, 'total', 'appearances' );
				$avrating = wpcm_divide( $rating, $apps );

				if( get_option( 'wpcm_show_stats_rating' ) == 'yes' ) : ?>
						
					<td class="cp-player-stat rating"><span data-index="rating"><?php echo sprintf( "%01.2f", round($avrating, 2) ); ?></span></td>
				<?php endif;

			} else { 

				if( get_option( 'wpcm_show_stats_' . $key ) == 'yes' ) { ?>

					<td class="cp-player-stat <?php $key ?>"><span data-index="<?php echo $key; ?>"><?php wpcm_stats_value( $stats, 'total', $key ); ?></span></td>
				<?php
				}
			}
		}
	}

}


/*  Profile stats table header
/* ------------------------------------ */
if ( ! function_exists( 'cp_profile_stats_th' ) ) {

	function cp_profile_stats_th() {
		$wpcm_player_stats_labels = wpcm_get_sports_stats_labels();

		$stats_labels = array( 'appearances' => '<a title="' . __('Games Played', 'scoreline') . '">' . __( 'GP', 'scoreline' ) . '</a>' );
		$stats_labels = array_merge( $stats_labels, $wpcm_player_stats_labels );

		foreach( $stats_labels as $key => $val ) { 

			if( get_option( 'wpcm_show_stats_' . $key ) == 'yes' ) { ?>

				<th class="cp-player-stat <?php $val ?>"><?php echo $val; ?></th>
			<?php
			}

		}
			
	}

}


/*  Related players
/* ------------------------------------ */
if ( ! function_exists( 'cp_related_players' ) ) {

	function cp_related_players() {
		wp_reset_postdata();
		global $post;

		$post_terms = wp_get_object_terms($post->ID, 'wpcm_position', array('fields'=>'ids'));

		// Define shared post arguments
		$args = array(
			'post_type'					=> 'wpcm_player',
			'tax_query' 				=> array(
		        array(
		            'taxonomy' 				=> 'wpcm_position',
		            'field' 				=> 'id',
		            'terms' 				=> $post_terms
		        )
		    ),
			'no_found_rows'				=> true,
			'update_post_meta_cache'	=> false,
			'update_post_term_cache'	=> false,
			'ignore_sticky_posts'		=> 1,
			'orderby'					=> 'rand',
			'post__not_in'				=> array($post->ID),
			'posts_per_page'			=> 4
		);
		
		$query = !isset($break)?new WP_Query($args):new WP_Query;
		return $query;
	}
	
}


/*  Match post nav
/* ------------------------------------ */
if ( ! function_exists( 'cp_match_post_nav' ) ) {

	function cp_match_post_nav() {
		wp_reset_postdata();

		$id = get_the_id();
	    $pages = array();
	    $default_club = get_option('wpcm_default_club');
	    
	    $args = array(
	        'post_type' => 'wpcm_match',
	        'post_status' => 'publish,future',
	        'orderby' => 'date',
	        'order' => 'DESC',
	        'posts_per_page' => -1
	    );
	    $args['meta_query'] = array(
	    	'relation' => 'OR',
			array(
				'key' => 'wpcm_home_club',
	    		'value' => $default_club,
	    	),
	    	array(
	    		'key' => 'wpcm_away_club',
	    		'value' => $default_club,
	    	)
		);
	    $nav_posts = get_posts($args);

	    foreach($nav_posts as $nav_post) {
	        $pages[] += $nav_post->ID;
	    }

	    $current = array_search($id, $pages);
	    $prevID = $pages[$current - 1];
	    $nextID = $pages[$current + 1];

	    $total = count($pages);
	    foreach ($pages as $mykey => $myval) {
	        if ($myval== $id) {
	            $key = ($mykey + 1);
	        }
	    }
	    $title = '';
	    if (!empty($prevID)) { ?>
	        <li class="next">
	        	<a href="<?php echo get_permalink($prevID); ?>">
	        		<i class="fa fa-chevron-right"></i>
	        		<strong>Next Match</strong>
	        		<span><?php echo match_title( $title, $prevID ); ?></span>
	        	</a>
	        </li>
	    <?php }
		
	    if (!empty($nextID)) { ?>
	        <li class="previous">
	        	<a href="<?php echo get_permalink($nextID); ?>">
	        		<i class="fa fa-chevron-left"></i>
	        		<strong>Previous Match</strong>
	        		<span><?php echo match_title( $title, $nextID); ?></span>
	        	</a>
	        </li>
	    <?php }

	    wp_reset_query();

	}

}

/* ------------------------------------------------------------------------- *
 *  Theme update functions  DO NOT EDIT!!!!!! 
/* ------------------------------------------------------------------------- */
define( 'CP_STORE_URL', 'http://wpclubmanager.com' );
 
define( 'CP_THEME_NAME', 'Scoreline' );

if ( !class_exists( 'CP_Theme_Updater' ) ) {
	// Load our custom theme updater
	include( get_template_directory() . '/functions/CP_Theme_Updater.php' );
}

function cp_scoreline_updater() {

	$test_license = trim( get_option( 'cp_scoreline_license_key' ) );

	$edd_updater = new CP_Theme_Updater( array(
			'remote_api_url' 	=> CP_STORE_URL, 	// Our store URL that is running EDD
			'version' 			=> '1.1.1', 				// The current theme version we are running
			'license' 			=> $test_license, 		// The license key (used get_option above to retrieve from DB)
			'item_name' 		=> CP_THEME_NAME,	// The name of this theme
			'author'			=> 'Clubpress'	// The author's name
		)
	);
}
add_action( 'admin_init', 'cp_scoreline_updater' );

function cp_scoreline_license_menu() {
	add_theme_page( 'Theme License', 'Theme License', 'manage_options', 'scoreline-license', 'cp_scoreline_license_page' );
}
add_action('admin_menu', 'cp_scoreline_license_menu');


function cp_scoreline_license_page() {
	$license 	= get_option( 'cp_scoreline_license_key' );
	$status 	= get_option( 'cp_scoreline_license_key_status' );
	?>
	<div class="wrap">
		<h2><?php _e('Theme License Options'); ?></h2>
		<form method="post" action="options.php">

			<?php settings_fields('cp_scoreline_license'); ?>

			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('License Key'); ?>
						</th>
						<td>
							<input id="cp_scoreline_license_key" name="cp_scoreline_license_key" type="text" class="regular-text" value="<?php echo esc_attr( $license ); ?>" />
							<label class="description" for="cp_scoreline_license_key"><?php _e('Enter your license key'); ?></label>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Activate License'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<span style="color:green;"><?php _e('active'); ?></span>
									<?php wp_nonce_field( 'cp_sample_nonce', 'cp_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="cp_theme_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
								<?php } else {
									wp_nonce_field( 'cp_sample_nonce', 'cp_sample_nonce' ); ?>
									<input type="submit" class="button-secondary" name="cp_theme_license_activate" value="<?php _e('Activate License'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>

		</form>
	<?php
}

function cp_scoreline_register_option() {
	// creates our settings in the options table
	register_setting('cp_scoreline_license', 'cp_scoreline_license_key', 'cp_theme_sanitize_license' );
}
add_action('admin_init', 'cp_scoreline_register_option');

function cp_theme_sanitize_license( $new ) {
	$old = get_option( 'cp_scoreline_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'cp_scoreline_license_key_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

function cp_scoreline_activate_license() {

	if( isset( $_POST['cp_theme_license_activate'] ) ) {
	 	if( ! check_admin_referer( 'cp_sample_nonce', 'cp_sample_nonce' ) )
			return; // get out if we didn't click the Activate button

		global $wp_version;

		$license = trim( get_option( 'cp_scoreline_license_key' ) );

		$api_params = array(
			'edd_action' => 'activate_license',
			'license' => $license,
			'item_name' => urlencode( CP_THEME_NAME )
		);

		$response = wp_remote_get( add_query_arg( $api_params, CP_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "active" or "inactive"

		update_option( 'cp_scoreline_license_key_status', $license_data->license );

	}
}
add_action('admin_init', 'cp_scoreline_activate_license');

function cp_scoreline_deactivate_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['cp_theme_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'cp_sample_nonce', 'cp_sample_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'cp_scoreline_license_key' ) );


		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( CP_THEME_NAME ) // the name of our product in EDD
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, CP_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' )
			delete_option( 'cp_scoreline_license_key_status' );

	}
}
add_action('admin_init', 'cp_scoreline_deactivate_license');

function cp_scoreline_check_license() {

	global $wp_version;

	$license = trim( get_option( 'cp_scoreline_license_key' ) );

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( CP_THEME_NAME )
	);

	$response = wp_remote_get( add_query_arg( $api_params, CP_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

	if ( is_wp_error( $response ) )
		return false;

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	if( $license_data->license == 'valid' ) {
		echo 'valid'; exit;
		// this license is still valid
	} else {
		echo 'invalid'; exit;
		// this license is no longer valid
	}
}

