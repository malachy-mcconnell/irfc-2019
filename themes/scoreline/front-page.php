<?php get_header(); ?>

<section class="content">

	<?php get_template_part('inc/page-title'); ?>

	<?php get_template_part('inc/featured'); ?>
	
	<div class="pad group">

		<?php // home widgets
			$total = 4;
			if ( ot_get_option( 'home-widgets' ) != '' ) {
				
				$total = ot_get_option( 'home-widgets' );
				if( $total == 1) $class = 'one-full';
				if( $total == 2) $class = 'one-half';
				if( $total == 3) $class = 'one-third';
				if( $total == 4) $class = 'one-fourth';
				}

				if ( ( is_active_sidebar( 'home-1' ) ||
					   is_active_sidebar( 'home-2' ) ||
					   is_active_sidebar( 'home-3' ) ||
					   is_active_sidebar( 'home-4' ) ) && $total > 0 ) 
		{ ?>		
		<div id="home-widgets" class="group">

			<?php $i = 0; while ( $i < $total ) { $i++; ?>
				<?php if ( is_active_sidebar( 'home-' . $i ) ) { ?>
			
			<div class="home-widget-<?php echo $i; ?> grid <?php echo $class; ?> <?php if ( $i == $total ) { echo 'last'; } ?>">
				<?php dynamic_sidebar( 'home-' . $i ); ?>
			</div>
			
				<?php } ?>
			<?php } ?>
		</div><!--/#home-widgets-->	
		<?php } ?>
		
		<?php while ( have_posts() ): the_post(); ?>
		
			<article <?php post_class('group'); ?>>
				
				<?php get_template_part('inc/page-image'); ?>
				
				<div class="entry cp-form">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div><!--/.entry-->
				
			</article>
			
		<?php endwhile; ?>
		
	</div><!--/.pad-->
	
</section><!--/.content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>