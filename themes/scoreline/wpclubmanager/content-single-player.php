<?php
/**
 * The template for displaying product content in the single-player.php template
 *
 * Override this template by copying it to yourtheme/wpclubmanager/content-single-player.php
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_template_part('inc/page-title'); ?>
	
<div class="pad group">

	<article id="post-<?php the_ID(); ?>" <?php post_class('post group'); ?>>

		<?php wpclubmanager_template_single_player_title(); ?>

	    <div class="cp-player-info group">

		    <?php
				/**
				 * wpclubmanager_single_player_image hook
				 *
				 * @hooked wpclubmanager_template_single_player_images - 5
				 */
				do_action( 'wpclubmanager_single_player_image' );
			?>

			<div class="cp-profile-meta">

				<?php wpclubmanager_template_single_player_meta(); ?>

			</div>

		</div>

		<div class="cp-profile-stats group">

			<?php
				/**
				 * wpclubmanager_single_player_stats hook
				 *
				 * @hooked wpclubmanager_template_single_player_stats - 5
				 */
				do_action( 'wpclubmanager_single_player_stats' );
			?>

		</div>

		<div class="cp-profile-bio group">

			<?php
				/**
				 * wpclubmanager_single_player_bio hook
				 *
				 * @hooked wpclubmanager_template_single_player_bio - 5
				 */
				do_action( 'wpclubmanager_single_player_bio' );
			?>

		</div>

		<?php do_action( 'wpclubmanager_after_single_player_bio' ); ?>

		<?php if ( ot_get_option('player-sharrre') != 'off' ) { get_template_part('inc/sharrre'); } ?>

	</article>

	<div class="clear"></div>

	<?php if ( ot_get_option( 'player-post-nav' ) != 'off') { get_template_part('inc/post-nav'); } ?>

	<?php if ( ot_get_option( 'player-similar-posts' ) != 'off' ) { get_template_part('inc/related-players'); } ?>

</div>