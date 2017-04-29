<?php
/**
 * The default template for displaying single post content (with sidebar).
 * This is a template part. It must be used within The Loop.
 *
 * @package Bunchy_Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
$bc_02_total = 3;






global $wp_query;
$temp_query = $wp_query;
$snax_post_types = snax_get_post_supported_post_types();


$bc_query_args = array(
	//'post_type' => $snax_post_types,
	'category_name' => $wp_query->query['category_name'],
	/*'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => array( 'feature' ),
			'include_children' => true,
		),
	),*/
	'meta_query'     => array(
		array(
			
			//'key' => '_snax_post_submission',
			//'key' => '_snax_post_submission_start_date',
			//'key' => '_snax_post_submission_end_date',
			'key' => '_snax_post_voting',
			//'key' => '_snax_post_voting_start_date',
			//'key' => '_snax_post_voting_end_date',
			//'key' => '_snax_post_items_per_page',

			//'key'     => '_snax_format',
			'compare' => 'EXISTS',
		),
	),
	'posts_per_page' => $bc_02_total,
	//'posts_per_archive_page' => $bc_01_total,
	'ignore_sticky_posts' => true,
	'order' => 'DESC',
	'order_by' => 'date',
	
);

$bc_query_args = wp_parse_args( $bc_query_args, $wp_query->query );

$bc_query = new WP_Query( $bc_query_args );
//$bc_post_id = $bc_query->post->ID;

$i_post = 0;
// TODO - Check if there are 3 category children, or fill in with random.
?>
<?php  ?>
<?php if ( $bc_query->have_posts() ) : $bc_query->the_post();?>
	<header class="bc-tax-02-header">
		<div class="bc-02-header-thumb">
			<?php the_post_thumbnail( 'large' ) ?>
		</div>
		<h2 class="bc-02-header-title">Test Header</h2>
	</header>
	<div class="bc-tax-02-post-0<?php echo $i_post; ?>">
		<article id="post-<?php $bc_query->post->ID; ?>" <?php post_class( 'bc-02-post' ); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
			<div class="bc-02-thumb">
				<?php the_post_thumbnail( 'thumbnail' ) ?>
			</div>
			<div class="bc-02-content">
				<?php // FIXME echo snax_capture_item_position( array('prefix' => '', 'suffix' => '' ) ); ?>
				<?php the_title('<h3 class="entry-title g1-delta bc-02-title" itemprop="headline">', '</h3>'); ?>
				<?php the_subtitle( '<h4 class="entry-subtitle g1-epsilon g1-epsilon-2nd">', '</h4>' ); ?>

			</div>
		</article>
	</div>
	<?php $i_post++; ?>
	<?php while ( $bc_query->have_posts() ) : $bc_query->the_post(); ?>
		<div class="bc-tax-02-post-0<?php echo $i_post; ?>">
			<article id="post-<?php $bc_query->post->ID; ?>" <?php post_class( 'bc-02-post' ); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
				<div class="bc-02-thumb">
					<?php the_post_thumbnail( 'thumbnail' ) ?>
				</div>
				<div class="bc-02-content">
					<?php // FIXME echo snax_capture_item_position( array('prefix' => '', 'suffix' => '' ) ); ?>
					<?php the_title('<h3 class="entry-title g1-delta bc-02-title" itemprop="headline">', '</h3>'); ?>
					<?php the_subtitle( '<h4 class="entry-subtitle g1-epsilon g1-epsilon-2nd">', '</h4>' ); ?>
				</div>
			</article>
		</div>
		<?php $i_post++; ?>
	<?php endwhile; ?>
<?php endif; ?>
	
	
<?php 
$wp_query = $temp_query;
bunchy_reset_template_part_data();
wp_reset_postdata();
?>
