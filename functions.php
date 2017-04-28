<?php
// Prevent direct script access
if ( !defined( 'ABSPATH' ) )
	die ( 'No direct script access allowed' );

/**
* Child Theme Setup
* 
* Always use child theme if you want to make some custom modifications. 
* This way theme updates will be a lot easier.
*/
function bunchy_child_setup() {
	// NONE - However, Snax-Mod handles some of the database modifications.
}

function add_my_footer_textLink() {
	?>
	<div style="text-align: center;">
	  <a href="https://jobnewsusa.com">Find Local Jobs</a>
	</div>  
	<?php
}
add_action( 'wp_footer', 'add_my_footer_textLink' );

function bc_render_snax_items( $post_id, $format = array() ) {
	$default_format = array(
		//'before' => '',
		//'after' => '',
		'offset' => 0, // For displaying 1-5 & 6-10
	);
	$format = wp_parse_args( $format, $default_format );

	
	$args_query = array(
		'post_type'      => snax_get_item_post_type(),
		'post_parent' => $post_id,
		'orderby'        => array(
			'meta_value_num' => 'DESC',
			'menu_order'     => 'ASC',
			'post_date'      => 'ASC',
		),
		'meta_key'       => '_snax_vote_score',
		'posts_per_page' => 5,
		'offset' => $format['offset'],
	);
	
	$parent_format = 'list'; // (image | embed | gallery | list)
	$origin = 'all';
	$items_query = snax_get_items_query( $parent_format, $origin, $args_query );
	
	$item_count = 0;
	if ( $items_query->have_posts() ) {
		while ( $items_query->have_posts() ) {
			$items_query->the_post();
			?>
			<div class="bc-01-item">
				<div class="bc-01-item-vote-box">
					<?php snax_mod_render_voting_box( $items_query->post->ID , $post_id ) ?>
				</div>
				<div class="bc-01-item-thumbnail">
					<?php the_post_thumbnail( 'thumbnail' ) ?>
				</div>
				<div class="bc-01-item-container">
					<div class="bc-01-item-container-inner">
						<h4 class="g1-delta g1-delta-1st snax-item-title bc-01-item-title">
							<a href="<?php echo esc_url( the_permalink() ); ?>" id="snax-itemli-<?php echo (int) $items_query->post->ID; ?>" rel="bookmark">
								<?php
								//echo snax_capture_item_position( array('prefix' => '', 'suffix' => '' ) );
								the_title('', '');
								//snax_render_item_title();
								?>
							</a>
						</h4>
					</div>
				</div>
			</div>
			<?php
			$item_count++;
		}
	}
	while ( $item_count < 5 ) {
		?>
		<div class="bc-01-item">**EMPTY MESSAGE**</div>
		<?php
		$item_count++;
	}
	// ENDLOOP
	bunchy_reset_template_part_data();
	wp_reset_postdata();
}
