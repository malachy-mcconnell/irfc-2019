<?php
/**
 * The template for displaying product content in the single-staff.php template
 *
 * Override this template by copying it to yourtheme/wpclubmanager/content-single-staff.php
 *
 * @author 		ClubPress
 * @package 	WPClubManager/Templates
 * @version     1.1.2
 */

$natl = get_post_meta( $post->ID, 'wpcm_natl', true );
$jobs = get_the_terms( $post->ID, 'wpcm_jobs' );
$seasons = get_the_terms( $post->ID, 'wpcm_season' );
$teams = get_the_terms( $post->ID, 'wpcm_team' );
$jobs = get_the_terms( $post->ID, 'wpcm_jobs' ); ?>

<?php get_template_part('inc/page-title'); ?>
	
<div class="pad group">

	<article id="post-<?php the_ID(); ?>" <?php post_class('post group'); ?>>

		<?php 
		if ( get_option( 'wpcm_staff_profile_show_jobs' ) == 'yes') {

			if ( is_array( $jobs ) ) {

				$player_jobs = array();

				foreach ( $jobs as $job ) {
					
					$player_jobs[] = $job->name;
				}

				$job = '<span class="cp-player-position">' . implode( ', ', $player_jobs ) . '</span>';

			}
		} else {
			$job = '';
		}

		if ( get_option( 'wpcm_staff_profile_show_nationality' ) == 'yes') {

			$flag = '<img class="cp-profile-flag" src="'. get_template_directory_uri() .'/img/flags/small/'. $natl .'.jpg"/>';
		} else {

			$flag = '';
		} ?>

		<div class="cp-player-title group">
			<h1><?php the_title(); ?></h1>
			<p class="cp-player-title-meta"><?php echo $job; ?> <?php echo $flag; ?></p>
		</div>

	    <div class="cp-player-info group">

		    <div class="cp-profile-image">
			
				<?php if ( has_post_thumbnail() ) {
						
					echo the_post_thumbnail( 'player-large' );
					
				} else { ?>
								
					<img src="<?php echo get_template_directory_uri(); ?>/img/player-medium.png" alt="<?php the_title(); ?>" />
							
				<?php } ?>

			</div>

			<div class="cp-profile-meta">

				<table class="cp-table-full">

					<caption><?php _e('Staff details', 'scoreline'); ?></caption>
							
					<tbody>

						<?php

						if ( get_option( 'wpcm_staff_profile_show_dob' ) == 'yes') { ?>

							<tr>
								<th>
									<?php _e( 'Birthday', 'scoreline' ); ?>
								</th>
								<td>
									<?php echo date_i18n( get_option( 'date_format' ), strtotime( get_post_meta( $post->ID, 'wpcm_dob', true ) ) ); ?>
								</td>
							</tr>
						<?php }

						if ( get_option( 'wpcm_staff_profile_show_age' ) == 'yes') { ?>

							<tr>
								<th>
									<?php _e( 'Age', 'scoreline' ); ?>
								</th>
								<td>
									<?php echo get_age( get_post_meta( $post->ID, 'wpcm_dob', true ) ); ?>
								</td>
							</tr>
						<?php }

						if ( get_option( 'wpcm_staff_profile_show_season' ) == 'yes') {

							if ( is_array( $seasons ) ) {

								$player_seasons = array();

								foreach ( $seasons as $value ) {

									$player_seasons[] = $value->name;
								} ?>

								<tr>
									<th>
										<?php _e( 'Season', 'scoreline' ); ?>
									</th>
									<td>
										<?php echo implode( ', ', $player_seasons ); ?>
									</td>
								</tr>
							<?php
							}
						}

						if ( get_option( 'wpcm_staff_profile_show_team' ) == 'yes') {

							if ( is_array( $teams ) ) {
										
								$player_teams = array();

								foreach ( $teams as $team ) {
									
									$player_teams[] = $team->name;
								} ?>

								<tr>
									<th>
										<?php _e( 'Team', 'scoreline' ); ?>
									</th>
									<td>
										<?php echo implode( ', ', $player_teams ); ?>
									</td>
								</tr>
							<?php
							}
						}

						if ( get_option( 'wpcm_show_staff_email' ) == 'yes') {

							$email = get_post_meta( $post->ID, '_wpcm_staff_email', true ); ?>

							<tr>
								<th>
									<?php _e( 'Email', 'scoreline' ); ?>
								</th>
								<td>
									<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
								</td>
							</tr>
						<?php
						}

						if ( get_option( 'wpcm_show_staff_phone' ) == 'yes') {

							$phone = get_post_meta( $post->ID, '_wpcm_staff_phone', true ); ?>

							<tr>
								<th>
									<?php _e( 'Phone', 'scoreline' ); ?>
								</th>
								<td>
									<?php echo $phone; ?>
								</td>
							</tr>
						<?php
						}

						if ( get_option( 'wpcm_staff_profile_show_joined' ) == 'yes') { ?>

							<tr>
								<th>
									<?php _e( 'Joined', 'scoreline' ); ?>
								</th>
								<td>
									<?php echo date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ); ?>
								</td>
							</tr>
						<?php
						} ?>

					</tbody>
							
				</table>

			</div>

		</div>

		<div class="cp-profile-bio group">

			<?php if ( get_the_content() ) { ?>

				<div class="entry">

					<?php the_content(); ?>

				</div>

			<?php } ?>

		</div>

		<?php if ( ot_get_option('player-sharrre') != 'off' ) { get_template_part('inc/sharrre'); } ?>

	</article>

	<div class="clear"></div>

	<?php if ( ot_get_option( 'player-post-nav' ) != 'off') { get_template_part('inc/post-nav'); } ?>

</div>