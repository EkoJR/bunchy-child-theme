<?php
/**
 * Template for displaying single item media
 *
 * @package snax
 * @subpackage Theme
 */

// Prevent direct script access.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct script access allowed' );
}
?>
<?php



/**
 * Fires before the display of the item media
 */
// TODO - Change the layout for single items
do_action( 'snax_before_item_media' );
?>

<div class="snax-item-media respon_row respon_group">
	<div class="snax-item-media-container respon_col span_2_of_5">
		<?php switch ( snax_get_item_format() ) {
			case 'image': ?>
				<a class="snax-item-media-link snax-item-media-link" href="<?php echo esc_url( get_permalink() ); ?>">
					<?php the_post_thumbnail( snax_get_item_image_size() ); ?>
				</a>
				<div class="snax-mod-item-rank">
					<?php echo snax_mod_render_rank(); ?>
				</div>
				<?php if ( snax_item_has_source() ) : ?>
				<p class="snax-item-media-meta">
					<a href="<?php echo esc_url( snax_get_item_source() ); ?>" target="_blank"
					   rel="nofollow"><?php esc_html_e( 'Source', 'snax' ); ?></a>
				</p>
				<?php endif; ?>
				<?php break;
			case 'embed': ?>
				<div class="<?php echo implode( ' ', array_map( 'sanitize_html_class', snax_get_item_embed_code_classes() ) ); ?>">
					<?php snax_render_item_embed_code(); ?>
				</div>
				<?php
				break;
		} ?>
	</div>
	<div class="respon_col span_3_of_5">
		<header class="snax-item-header">
			<?php snax_render_item_title(); ?>
			<?php get_template_part( 'template-parts/snax-bar-item' ); ?>
		</header>
		<div style="height: 27px;">
			<?php snax_render_item_date(); ?>
			<?php snax_mod_render_item_action_links(); ?>
		</div>
		<?php if ( snax_show_item_media_description() ) : ?>
			<div class="snax-item-media-desc">
				<?php snax_mod_item_description(); ?>
			</div>
		<?php endif; ?>
		<div>
			<?php snax_render_item_share(); ?>
		</div>
	</div>
</div><!-- .snax-item-media -->

<?php
/**
 * Fires after the display of the item media
 */
do_action( 'snax_after_item_media' );
?>
