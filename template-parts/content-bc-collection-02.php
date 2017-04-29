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
$bc_02_total_column = 3; // Set from 1-5
$args_arr = array();
$args[] = array(
	'category_name' => $wp_query->query['category_name'],
);
// TODO - Add query function.
$bunchy_template_data = bunchy_get_template_part_data();
$bunchy_elements   = $bunchy_template_data['elements'];


/*
 * OR Change to a function to set query and header message.
 */
?>
<?php  ?>
<div class="respon_row respon_group snax bc-02-row">
	<?php for ($i = 0; $i < $bc_02_total_column; $i++) : ?>
		<div class="respon_col span_1_of_<?php echo $bc_02_total_column; ?>">
			<?php // Change to a function. ?>
			<?php get_template_part( 'template-parts/content', 'bc-02' ); ?>
		</div>
	<?php endfor; ?>
</div>


