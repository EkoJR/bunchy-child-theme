<?php
/**
 * Single Item Content Part
 *
 * @package snax
 * @subpackage Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
$wp_post_id = $wp_query->post->ID;
$item_id = $id;
// TODO Change Vote/Item template.
//snax_mod_render_voting_box_weeks( $post = null, $wp_post_id = 0, $user_id = 0, $class = 'snax-voting-simple' );
?>
<article <?php post_class( 'entry-tpl-index entry-tpl-index-stickies' ); ?>>
	<div class="snax-item-actions entry-actions">
		<?php snax_mod_render_voting_box_weeks( $item_id, $wp_post_id ); ?>
		<?php //snax_render_item_share(); ?>
		<?php //snax_render_item_action_links(); ?>
	</div>
	

		<!-- <header class="snax-item-header">
			<?php //snax_render_item_title(); ?>
			<?php //get_template_part( 'template-parts/snax-bar-item' ); ?>
		</header> -->

		<?php 
		snax_get_template_part( 'items/post-media' ); 
		?>

		<!-- <p class="snax-item-meta">
			<?php //snax_render_item_author(); ?>
			<?php //snax_render_item_date(); ?>
		</p> -->


	
</article>
<hr>
