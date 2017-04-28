<?php
/**
 * The Template for displaying archive body.
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
?>
<?php 
//global $wp_query;
//$temp_query = $wp_query;

$bunchy_template_data = bunchy_get_template_part_data();
//$bunchy_elements   = $bunchy_template_data['elements'];

?>

<?php
if ( bunchy_show_archive_featured_entries() ) :
	get_template_part( 'template-parts/featured-content-3' );
endif;
?>
<?php if ( have_posts() ) : ?>
	<div class="g1-row g1-row-layout-page archive-body">
		<div class="g1-row-inner">
			<div id="primary" class="g1-column">
				<!-- DO STUFF -->
				<div class="bs-collection-01">
					<?php get_template_part( 'template-parts/content', 'bc-collection-01' ); ?>
				</div>
				<div class="bs-collection-02">
					
				</div>
				
				<div class="bc-collection-end">
					<?php $bunchy_post_number = 0; ?>
					<?php while ( have_posts() ) : the_post();
						$bunchy_post_number ++; ?>
						<!-- Add final template -->
						<?php do_action( 'bunchy_archive_loop_before_post', 'classic', $bunchy_post_number ); ?>
						<?php get_template_part( 'template-parts/content', 'bs-collection-end' ); ?>
						<?php do_action( 'bunchy_archive_loop_after_post', 'classic', $bunchy_post_number ); ?>
					<?php endwhile; ?>
				</div>
				<div class="bs-collection-pagination">
					<?php get_template_part( 'template-parts/archive-pagination', $bunchy_template_data['pagination'] ); ?>
				</div>
				<!-- END STUFF -->
			</div><!-- .g1-column -->
		</div><!-- .g1-row-inner -->
		<div class="g1-row-background"></div>
	</div><!-- .g1-row -->
<?php else : ?>
	<?php get_template_part( 'template-parts/archive-no-results' ); ?>
<?php endif;
