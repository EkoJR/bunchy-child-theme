<?php
/* ***** CONFIGS ***** */

$category_post_total = 2;

$temp_query_fp_02 = $wp_query;
$bunchy_home_settings = bunchy_get_home_settings();

$args = array(
	'category_name' => $bunchy_home_settings['featured_entries']['category_name'],
	'ignore_sticky_posts' => true,
);

switch ( $bunchy_home_settings['featured_entries']['type'] ) {
	case 'recent':
		$args['orderby'] = 'date';
		$args['order']   = 'DESC';
		break;

	case 'most_shared':
		$args['meta_key']     = 'mashsb_shares';
		$args['orderby']      = 'meta_value_num';
		$args['order']        = 'DESC';
		$args['meta_query'][] = array(
			'key'     => 'mashsb_shares',
			'compare' => '>',
			'value'   => 0,
		);
		break;

	//case 'most_viewed':
	//	$args = wp_parse_args( bunchy_wpp_get_most_viewed_query_args( $args ), $args );
	//	break;
}
$args['posts_per_page'] = $category_post_total;

$categories = explode( ',', $bunchy_home_settings['featured_entries']['category_name'] );
$taxonomies = get_taxonomies();
$post_index = 0;
?>
<?php  ?>
<?php foreach ( $categories as $cat_key => $category_value ) : ?>
	<?php
	$query_args = $args;
	$query_args['category_name'] = $category_value;
	if ( 'most_viewed' === $bunchy_home_settings['featured_entries']['type'] ) {
		$query_args = bunchy_wpp_get_most_viewed_query_args( $args );
	}

	foreach ( $taxonomies as $tax_type_key => $taxonomy ) {
		if ( $term_obj = get_term_by( 'slug', $category_value , $taxonomy ) ) {
			break;
		}
	}
	$taxonomy_obj = get_taxonomy( $taxonomy );

	//$wp_query->query( $query_args );
	$wp_query = new WP_Query( $query_args );
	$fp_post_index = 0;
	?>
	<?php if ( have_posts() ) : ?>
		<div class="respon_row respon_group bc-frontpage-02-head">
			<div class="respon_col span_1_of_1">
				<h2><a href="<?php echo get_term_link( $term_obj ); ?>"><?php echo $term_obj->name; ?></a></h2>
			</div>
		</div>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			$a01 = $wp_query->post_count % 2;
			?>
			<?php if ( 1 < ( $wp_query->post_count - $fp_post_index ) ) : ?>
				<div class="respon_row respon_group bc-frontpage-02">
					<div class="respon_col span_1_of_2">
						<?php get_template_part( 'template-parts/content-bc-front-02', 'article' ); ?>
					</div>
					<?php the_post(); ?>
					<div class="respon_col span_1_of_2">
						<?php get_template_part( 'template-parts/content-bc-front-02', 'article' ); ?>
					</div>
				</div>
				<?php $fp_post_index += 2; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>
<?php endforeach; ?>	
<?php 
$wp_query = $temp_query_fp_02; 
wp_reset_postdata();
