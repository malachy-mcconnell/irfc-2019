<div class="sharrre-container">
	<span><?php _e('Share','scoreline'); ?></span>
	<div id="twitter" data-url="<?php echo the_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="Tweet"></div>
	<div id="facebook" data-url="<?php echo the_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="Like"></div>
	<div id="googleplus" data-url="<?php echo the_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="+1"></div>
</div><!--/.sharrre-container-->

<script type="text/javascript">
	// Sharrre
	jQuery(document).ready(function(){
		jQuery('#twitter').sharrre({
			share: {
				twitter: true
			},
			template: '<a class="box" href="#"><div class="share">Twitter</div><div class="count" href="#">{total}</div></a>',
			enableHover: false,
			enableTracking: true,
			buttons: { twitter: {via: '<?php echo ot_get_option('twitter-username'); ?>'}},
			click: function(api, options){
				api.simulateClick();
				api.openPopup('twitter');
			}
		});
		jQuery('#facebook').sharrre({
			share: {
				facebook: true
			},
			template: '<a class="box" href="#"><div class="share">Facebook</div><div class="count" href="#">{total}</div></a>',
			enableHover: false,
			enableTracking: true,
			click: function(api, options){
				api.simulateClick();
				api.openPopup('facebook');
			}
		});
		jQuery('#googleplus').sharrre({
			share: {
				googlePlus: true
			},
			template: '<a class="box" href="#"><div class="share">Google+</div><div class="count" href="#">{total}</div></a>',
			enableHover: false,
			enableTracking: true,
			urlCurl: '<?php echo get_template_directory_uri() .'/js/sharrre.php'; ?>',
			click: function(api, options){
				api.simulateClick();
				api.openPopup('googlePlus');
			}
		});
	});
</script>