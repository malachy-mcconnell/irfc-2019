<div class="page-title pad group">
	
	<?php if ( is_front_page() ) : ?>
		<h2><?php echo cp_home_title(); ?></h2>

	<?php elseif ( is_home() ) : ?>
		<h2><?php echo cp_blog_title(); ?></h2>

	<?php elseif ( is_single() && !is_player() && !is_staff() && !is_club() && !is_match() && !is_sponsor() ): ?>
		<ul class="meta-single group">
			<li class="category"><?php the_category(' <span>&middot;</span> '); ?></li>
			<?php if ( comments_open() && ( ot_get_option( 'comment-count' ) != 'off' ) ): ?>
			<li class="comments"><a href="<?php comments_link(); ?>"><i class="fa fa-comments-o"></i><?php comments_number( '0', '1', '%' ); ?></a></li>
			<?php endif; ?>
		</ul>

	<?php elseif ( is_player() ): ?>
		<h2><?php _e('Player Profile', 'scoreline'); ?></h2>
		<div class="cp-player-select"><?php do_action( 'wpclubmanager_after_single_player_bio' ); ?></div>

	<?php elseif ( is_staff() ): ?>
		<h2><?php _e('Staff Profile', 'scoreline'); ?></h2>
		<div class="cp-player-select"><?php do_action( 'wpclubmanager_after_single_staff_bio' ); ?></div>

	<?php elseif ( is_club() ): ?>
		<h2><?php _e('Club Profile', 'scoreline'); ?></h2>

	<?php elseif ( is_match() ): ?>
		<h2><?php _e('Match Details', 'scoreline'); ?></h2>

	<?php elseif ( is_sponsor() ): ?>
		<h2><?php _e('Sponsors', 'scoreline'); ?></h2>

	<?php elseif ( is_page() ): ?>
		<h2><?php echo cp_page_title(); ?></h2>

	<?php elseif ( is_search() ): ?>
		<h1>
			<?php if ( have_posts() ): ?><i class="fa fa-search"></i><?php endif; ?>
			<?php if ( !have_posts() ): ?><i class="fa fa-exclamation-circle"></i><?php endif; ?>
			<?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> <?php _e('Search results','scoreline'); ?></h1>
		
	<?php elseif ( is_404() ): ?>
		<h1><i class="fa fa-exclamation-circle"></i><?php _e('Error 404.','scoreline'); ?> <span><?php _e('Page not found!','scoreline'); ?></span></h1>
		
	<?php elseif ( is_author() ): ?>
		<?php $author = get_userdata( get_query_var('author') );?>
		<h1><i class="fa fa-user"></i><?php _e('Author:','scoreline'); ?> <span><?php echo $author->display_name;?></span></h1>
		
	<?php elseif ( is_category() ): ?>
		<h1><i class="fa fa-folder-open"></i><?php _e('Category:','scoreline'); ?> <span><?php echo single_cat_title('', false); ?></span></h1>

	<?php elseif ( is_tag() ): ?>
		<h1><i class="fa fa-tags"></i><?php _e('Tagged:','scoreline'); ?> <span><?php echo single_tag_title('', false); ?></span></h1>
		
	<?php elseif ( is_day() ): ?>
		<h1><i class="fa fa-calendar"></i><?php _e('Daily Archive:','scoreline'); ?> <span><?php echo get_the_time('F j, Y'); ?></span></h1>
		
	<?php elseif ( is_month() ): ?>
		<h1><i class="fa fa-calendar"></i><?php _e('Monthly Archive:','scoreline'); ?> <span><?php echo get_the_time('F Y'); ?></span></h1>
			
	<?php elseif ( is_year() ): ?>
		<h1><i class="fa fa-calendar"></i><?php _e('Yearly Archive:','scoreline'); ?> <span><?php echo get_the_time('Y'); ?></span></h1>
	
	<?php else: ?>
		<h2><?php the_title(); ?></h2>
	
	<?php endif; ?>

</div><!--/.page-title-->