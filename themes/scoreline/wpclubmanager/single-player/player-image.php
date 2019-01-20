<?php
/**
 * Single Player - Image
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.1.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpclubmanager, $post; ?>

<div class="cp-profile-image">
			
	<?php if ( has_post_thumbnail() ) {
			
		echo the_post_thumbnail( 'player-medium' );
		
	} else { ?>
					
		<img src="<?php echo get_template_directory_uri(); ?>/img/player-medium.png" alt="<?php the_title(); ?>" />
				
	<?php } ?>

</div>