<!DOCTYPE html> 
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title(''); ?></title>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="wrapper">

	<header id="header">
	
		<?php if ( has_nav_menu('topbar') ): ?>
			<nav class="nav-container group" id="nav-topbar">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"></div>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'topbar','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
				
				<div class="container">
					<div class="container-inner">		
						<div class="toggle-search"><i class="fa fa-search"></i></div>
						<div class="search-expand">
							<div class="search-expand-inner">
								<?php get_search_form(); ?>
							</div>
						</div>
					</div><!--/.container-inner-->
				</div><!--/.container-->
				
			</nav><!--/#nav-topbar-->
		<?php endif; ?>
		
		<div class="container group">
			<div class="container-inner">
				
				<?php if ( ot_get_option('header-image') == '' ): ?>
				<div class="group pad">
					<?php echo cp_site_title(); ?>
					<?php if ( ot_get_option('header-banner') ): ?>
						<div class="site-banner">
							<?php if ( ot_get_option('header-banner-url') ): ?>
								<a href="<?php echo ot_get_option('header-banner-url'); ?>">
							<?php endif; ?>
								<img src="<?php echo ot_get_option('header-banner'); ?>" alt=""/>
							<?php if ( ot_get_option('header-banner-url') ): ?>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ( ot_get_option('header-image') ): ?>
					<a href="<?php echo home_url('/'); ?>" rel="home">
						<img class="site-image" src="<?php echo ot_get_option('header-image'); ?>" alt="<?php get_bloginfo('name'); ?>">
					</a>
				<?php endif; ?>
				
			</div><!--/.container-inner-->
		</div><!--/.container-->

		<?php if ( has_nav_menu('header') ): ?>
			<nav class="nav-container group" id="nav-header">
				<div class="nav-toggle"><i class="fa fa-bars"></i></div>
				<div class="nav-text"></div>
				<div class="nav-wrap container"><?php wp_nav_menu(array('theme_location'=>'header','menu_class'=>'nav container-inner group','container'=>'','menu_id' => '','fallback_cb'=> false)); ?></div>
			</nav><!--/#nav-header-->
		<?php endif; ?>
		
	</header><!--/#header-->
	
	<div class="container" id="page">
		<div class="container-inner">

			<?php if( is_match() ) :
				get_template_part('inc/match-title');
			endif; ?>

			<div class="main">
				<div class="main-inner group">