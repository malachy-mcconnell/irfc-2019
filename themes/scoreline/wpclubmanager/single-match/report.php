<?php
/**
 * Single Match - Report
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpclubmanager, $post;

$played = get_post_meta( $post->ID, 'wpcm_played', true );

if ( $played ) {
					
	if ( get_the_content() ) { ?>
					
		<div class="cp-match-report entry">

			<?php the_content(); ?>

		</div>

	<?php }
}