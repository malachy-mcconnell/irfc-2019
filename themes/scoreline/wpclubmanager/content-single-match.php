<?php
/**
 * The template for displaying match details in the single-match.php template
 *
 * Override this template by copying it to yourtheme/wpclubmanager/content-single-match.php
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$played = get_post_meta( $post->ID, 'wpcm_played', true ); ?>

<?php get_template_part('inc/page-title'); ?>
	
<div class="pad group">

	<article id="post-<?php the_ID(); ?>" <?php post_class('post group'); ?>>

	    <div class="cp-match-details group">

			<?php
				/**
				 * wpclubmanager_single_match_report hook
				 *
				 * @hooked wpclubmanager_template_single_match_report - 5
				 */
				do_action( 'wpclubmanager_single_match_report' );
			?>

			<?php
				/**
				 * wpclubmanager_single_match_details hook
				 *
				 * @hooked wpclubmanager_template_single_match_lineup - 5
				 * @hooked wpclubmanager_template_single_match_venue_info - 10
				 */
				do_action( 'wpclubmanager_single_match_details' );
			?>

	    </div>

	    <?php if ( ot_get_option('match-sharrre') != 'off' ) { get_template_part('inc/sharrre'); } ?>

	</article>

	<div class="clear"></div>

	<?php if ( ot_get_option( 'match-post-nav' ) != 'off') { get_template_part('inc/post-nav'); } ?>

</div>