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
/* ******************** */
/* ***** SETTINGS ***** */
$bc_02_total = 3;
$bc_02_max_columns = 3; // Set from 1-5
/* ******************** */

// TODO - Add query function.
$bunchy_template_data = bunchy_get_template_part_data();
$bunchy_elements   = $bunchy_template_data['elements'];



$temp_query = $wp_query;
//$snax_post_types = snax_get_post_supported_post_types();


$bc_query_args = array(
	//'post_type' => $snax_post_types,
	// add category children
	'cat' => $wp_query->query_vars['cat'],
	//'category_name' => $wp_query->query['category_name'],
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
	//'posts_per_page' => $bc_02_total,
	//'posts_per_archive_page' => $bc_01_total,
	'ignore_sticky_posts' => true,
	'order' => 'DESC',
	'order_by' => 'date',
	
);







$term = get_term( $cat );
$cat_children = get_term_children( $cat, $term->taxonomy );

$cat_num_of_posts = array();



/////////////////////////////////////

foreach ( $cat_children as $key => $value ) {
	$cat_term = get_term( $value );
	$bc_query_args['cat'] = $value;
	$cat_count = count( get_posts( $bc_query_args ) );
	if ( 0 < $cat_count ) {
		$cat_num_of_posts[ $cat_term->term_id ] = $cat_count;
	}
	
}

uksort($cat_num_of_posts, function($x, $y) use ($cat_num_of_posts)
{
   if( $cat_num_of_posts[$x] === $cat_num_of_posts[$y] )
   {
      return $x < $y ? -1 : $x != $y;
   }
   return $cat_num_of_posts[$y] - $cat_num_of_posts[$x];
});

//$cat_children = array_flip( $cat_num_of_posts );
/////////////////////////////////////////////





$snax_post_types = snax_get_post_supported_post_types();

$bc_query_args = array(
	'post_type' => $snax_post_types,
	'cat' => $wp_query->query_vars['cat'],
	//'category_name' => $wp_query->query['category_name'],
	/*'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => array( 'feature' ),
			'include_children' => true,
		),
	),*/
	
	'posts_per_page' => $bc_02_total,
	//'posts_per_archive_page' => $bc_01_total,
	
);

//$bc_query_args = wp_parse_args( $bc_query_args, $wp_query->query );

$wp_query = new WP_Query( $bc_query_args );

/*
 * OR Change to a function to set query and header message.
 */
?>
<?php  ?>
<?php if ( !empty( $cat_num_of_posts ) ) : ?>
	<div class="respon_row respon_group snax bc-02-row">
		<h1 style="display: table-row; height: 45px;">More Pages to Vote</h1>
		<?php foreach( $cat_num_of_posts as $key => $value ) : ?>
			<?php 
			if ( count( $cat_num_of_posts ) < $bc_02_max_columns ) {
				$bc_02_max_columns = count( $cat_num_of_posts );
			}
			$bc_query_args['cat'] = $key;
			$wp_query = new WP_Query( $bc_query_args );
			?>
			<div class="respon_col span_1_of_<?php echo $bc_02_max_columns; ?>">
				<?php get_template_part( 'template-parts/content', 'bc-02' ); ?>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
<?php

$wp_query = $temp_query; 
bunchy_reset_template_part_data();
wp_reset_postdata();

