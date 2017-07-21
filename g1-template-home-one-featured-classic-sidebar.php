<?php
/**
 * The Template for displaying the home page.
 *
 * @license For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package Bunchy_Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}

get_header();?>

<?php
$bunchy_home_settings = bunchy_get_home_settings();
bunchy_set_template_part_data( $bunchy_home_settings );
?>
<div class="g1-row g1-row-layout-page g1-row-padding-m">
	<div class="g1-row-inner">
		<div id="primary" class="g1-column g1-column-3of3">
			<h2 class="g1-delta g1-delta-2nd archive-body-title"><?php echo esc_html( bunchy_get_home_title() ); ?></h2>
			<?php if ( have_posts() ) : ?>
				<?php if ( ! $paged ) : ?>
					<div>
						<div class="g1-collection">
							<div class="g1-collection-viewport">
								<div class="g1-collection-items">
									<div class="g1-collection-item">
										<div class="respon_row respon_group bc-frontpage-02-head">
											<div class="respon_col span_1_of_1">
												<h2><a href="#">Featured Uploads</a></h2>
											</div>
										</div>
										<p style="margin: 20px;">
											We are asking a question for each list, we want you to upload items. 
											Find your pics and files, then click the upload link.
										</p>
										<?php get_template_part( 'template-parts/content-bc-front', 'collection-featured-uploads' ); ?>
									</div>
								</div>
							</div>
						</div>

						<!-- Featured Lists  -->
						<div class="g1-collection">
							<div class="g1-collection-viewport">
								<div class="g1-collection-items">
									<div class="g1-collection-item">
										<div class="respon_row respon_group bc-frontpage-02-head">
											<div class="respon_col span_1_of_1">
												<h2><a href="#">Featured Lists</a></h2>
											</div>
										</div>
										<p style="margin: 20px;">
											Click on a list or Make your own! Find out what your friends Like!
										</p>
										<?php get_template_part( 'template-parts/content-bc-front', 'collection-featured-lists' ); ?>
									</div>
								</div>
							</div>
						</div>

						<!-- Featured News & Quizzes  -->
						<div class="g1-collection">
							<div class="g1-collection-viewport">
								<div class="g1-collection-items">
									<div class="g1-collection-item">
										<div class="respon_row respon_group bc-frontpage-02-head">
											<div class="respon_col span_1_of_1">
												<h2><a href="#">News & Quizzes</a></h2>
											</div>
										</div>
										<p style="margin: 20px;">
											Catch up on the latest News! #1 anything open-ranked list website. 
											Don’t forget to "Share"
										</p>
										<?php get_template_part( 'template-parts/content-bc-front', 'collection-featured-news-quizzes' ); ?>
									</div>
								</div>
							</div>
						</div>

						<!-- Featured Votes  -->
						<div class="g1-collection">
							<div class="g1-collection-viewport">
								<div class="g1-collection-items">
									<div class="g1-collection-item">
										<?php get_template_part( 'template-parts/content-bc-front', 'collection-02' ); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="g1-collection">
					<div class="g1-collection-viewport">
						<div class="g1-collection-items">
							<?php $bunchy_post_number = 0;?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php
								$bunchy_post_number++;
								do_action( 'bunchy_home_loop_before_post', 'classic', $bunchy_post_number );
								?>
								<div class="g1-collection-item">
									<?php get_template_part( 'template-parts/content', 'list-fancy' );?>
								</div>
								<?php do_action( 'bunchy_home_loop_after_post', 'classic', $bunchy_post_number );?>
							<?php endwhile;?>
						</div>
						<?php get_template_part( 'template-parts/archive-pagination', $bunchy_home_settings['pagination'] );?>
					</div>
				</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/archive-no-results' );?>
			<?php endif; ?>
		</div><!-- .g1-column -->
		<?php get_sidebar(); ?>
	</div>
	<div class="g1-row-background"></div>
</div>

<?php
bunchy_reset_template_part_data();
get_footer();
$bc_fp_loaded = true;
