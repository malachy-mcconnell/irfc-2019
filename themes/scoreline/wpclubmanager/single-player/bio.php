<?php
/**
 * Single Player  - Bio
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( get_the_content() ) { ?>

	<div class="entry">

		<?php the_content(); ?>

	</div>

<?php }