<form method="get" class="searchform cp-form" action="<?php echo home_url('/'); ?>">
	<div>
		<input type="text" class="search" name="s" onblur="if(this.value=='')this.value='<?php _e('To search type and hit enter','scoreline'); ?>';" onfocus="if(this.value=='<?php _e('To search type and hit enter','scoreline'); ?>')this.value='';" value="<?php _e('To search type and hit enter','scoreline'); ?>" />
	</div>
</form>