<?php $meta = get_post_custom($post->ID); ?>

<?php if ( has_post_format( 'gallery' ) ): // Gallery ?>
	
	<div class="post-format">
		<?php $images = cp_post_images(); if ( !empty($images) ): ?>
		<script type="text/javascript">
			// Check if first slider image is loaded, and load flexslider on document ready
			jQuery(document).ready(function(){
			 var firstImage = jQuery('#flexslider-<?php echo the_ID(); ?>').find('img').filter(':first'),
				checkforloaded = setInterval(function() {
					var image = firstImage.get(0);
					if (image.complete || image.readyState == 'complete' || image.readyState == 4) {
						clearInterval(checkforloaded);
						jQuery('#flexslider-<?php echo the_ID(); ?>').flexslider({
							animation: "fade",
							slideshow: true,
							directionNav: true,
							controlNav: true,
							pauseOnHover: true,
							slideshowSpeed: 7000,
							animationSpeed: 600,
							smoothHeight: true,
							touch: false
						});
					}
				}, 20);
			});
		</script>
		<div class="flex-container">
			<div class="flexslider" id="flexslider-<?php the_ID(); ?>">
				<ul class="slides">
					<?php foreach ( $images as $image ): ?>
						<li>
							<?php $imageid = wp_get_attachment_image_src($image->ID,'large'); ?>
							<img src="<?php echo $imageid[0]; ?>" alt="<?php echo $image->post_title; ?>">
							
							<?php if ( $image->post_excerpt ): ?>
								<div class="image-caption"><?php echo $image->post_excerpt; ?></div>
							<?php endif; ?>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'image' ) ): // Image ?>

	<div class="post-format">
		<div class="image-container">
			<?php if ( has_post_thumbnail() ) {	
				the_post_thumbnail('thumb-large'); 
				$caption = get_post(get_post_thumbnail_id())->post_excerpt;
				if ( isset($caption) && $caption ) echo '<div class="image-caption">'.$caption.'</div>';
			} ?>
		</div>
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'video' ) ): // Video ?>

	<div class="post-format">	
		<?php 
			if ( isset($meta['_video_url'][0]) && !empty($meta['_video_url'][0]) ) {
				global $wp_embed;
				$video = $wp_embed->run_shortcode('[embed]'.$meta['_video_url'][0].'[/embed]');
				echo $video;
			} elseif ( isset($meta['_video_embed_code'][0]) && !empty($meta['_video_embed_code'][0]) ) {
				echo '<div class="video-container">';
				echo $meta['_video_embed_code'][0];
				echo '</div>';
			}
		?>	
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'quote' ) ): // Quote ?>

	<div class="post-format">
		<div class="format-container pad">
			<i class="fa fa-quote-right"></i>
			<blockquote><?php echo isset($meta['_quote'][0])?wpautop($meta['_quote'][0]):''; ?></blockquote>
			<p class="quote-author"><?php echo (isset($meta['_quote_author'][0])?'&mdash; '.$meta['_quote_author'][0]:''); ?></p>
		</div>
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'chat' ) ): // Chat ?>

	<div class="post-format">
		<div class="format-container pad">
			<i class="fa fa-comments-o"></i>
			<blockquote>
				<?php echo (isset($meta['_chat'][0])?wpautop($meta['_chat'][0]):''); ?>
			</blockquote>
		</div>
	</div>
	
<?php endif; ?>

<?php if ( has_post_format( 'link' ) ): // Link ?>

	<div class="post-format">
		<div class="format-container pad">
			<p><a href="<?php echo (isset($meta['_link_url'][0])?$meta['_link_url'][0]:'#'); ?>">
				<i class="fa fa-link"></i>
				<?php echo (isset($meta['_link_title'][0])?$meta['_link_title'][0]:get_the_title()); ?> &rarr;
			</a></p>
		</div>
	</div>
	
<?php endif; ?>
