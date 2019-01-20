<?php if ( is_single() && !is_player() && !is_staff() && !is_match() ): ?>
	<ul class="post-nav group">
		<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right"></i><strong>'.__('Next story', 'scoreline').'</strong> <span>%title</span>'); ?></li>
		<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left"></i><strong>'.__('Previous story', 'scoreline').'</strong> <span>%title</span>'); ?></li>
	</ul>
<?php endif; ?>
<?php if ( is_player() ): ?>
	<ul class="post-nav group">
		<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right"></i><strong>'.__('Next player', 'scoreline').'</strong> <span>%title</span>'); ?></li>
		<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left"></i><strong>'.__('Previous player', 'scoreline').'</strong> <span>%title</span>'); ?></li>
	</ul>
<?php endif; ?>
<?php if ( is_staff() ): ?>
	<ul class="post-nav group">
		<li class="next"><?php next_post_link('%link', '<i class="fa fa-chevron-right"></i><strong>'.__('Next staff', 'scoreline').'</strong> <span>%title</span>'); ?></li>
		<li class="previous"><?php previous_post_link('%link', '<i class="fa fa-chevron-left"></i><strong>'.__('Previous staff', 'scoreline').'</strong> <span>%title</span>'); ?></li>
	</ul>
<?php endif; ?>
<?php if ( is_match() ): ?>
	<ul class="post-nav group">
		<?php cp_match_post_nav() ?>
	</ul>
<?php endif; ?>