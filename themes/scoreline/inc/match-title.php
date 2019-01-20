<?php
$played = get_post_meta( $post->ID, 'wpcm_played', true );
$ot = get_post_meta( $post->ID, 'wpcm_overtime', true );

?>
<div class="cp-match-centre group">
	<div class="page-title pad group">
		<h2>
			<?php _e('Match Centre', 'scoreline'); ?> - 
			<?php wpclubmanager_template_single_match_date(); ?>
		</h2>
		<?php wpclubmanager_template_single_match_comp(); ?>
	</div>
	<h1 class="cp-match-title group">

    	<?php do_action( 'wpclubmanager_single_match_fixture' ); ?>

    	<?php
    	if( $ot == '1' ) { ?>
    		<div class="cp-match-overtime"><?php _e('OT', 'scoreline'); ?></div>
    	<?php } ?>

    </h1>
    <div class="cp-match-meta group">

		<?php do_action( 'wpclubmanager_single_match_venue' ); ?>

		<?php wpclubmanager_template_single_match_referee() ?>

    </div>
</div>