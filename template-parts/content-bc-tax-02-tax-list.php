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

$bunchy_template_data = bunchy_get_template_part_data();
$bunchy_elements   = $bunchy_template_data['elements'];

$category_permalink = get_category_link( $cat );
$i_post = 0;
// TODO - Check if there are 3 category children, or fill in with random.
?>
<?php  ?>

<?php if ( have_posts() ) : the_post();?>
	<h2 class="bc-02-tax-head"><a href="<?php echo $category_permalink;?>"><?php echo ucwords( $category_name );?></a></h2>
	<header class="bc-02-tax-header">
		<?php if ( $show_snax_tab && bunchy_can_use_plugin( 'snax/snax.php' ) ) : ?>
			<?php if ( snax_is_format( 'list' ) ) : ?>
				<a class="entry-badge entry-badge-open-list bc-01-badge" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Open list', 'bunchy' ); ?></a>
			<?php endif; ?>
		<?php endif; ?>
		<div class="bc-02-header-thumb">
			<?php 
			if ( $bunchy_elements['featured_media'] ) {
				the_post_thumbnail( 'large' );
			}
			?>
		</div>
		<?php if ( $bunchy_elements['title'] ) : ?>
			<a href="<?php the_permalink(); ?>">
				<?php the_title('<h3 class="entry-title g1-delta bc-02-title-header" itemprop="headline">', '</h3>'); ?>
			</a>
		<?php endif; ?>
		<?php
		if ( $show_subtitle && bunchy_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) {
			the_subtitle( '<h4 class="entry-subtitle g1-epsilon g1-epsilon-2nd">', '</h4>' );
		}
		?>
	</header>
	<?php $i_post++; ?>
	<?php 
	while ( have_posts() ) : the_post(); 
	?>
		<div class="bc-02-tax-post-list">
			<article id="post-<?php the_ID();?>" <?php post_class( 'bc-02-post' ); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
				<div class="bc-02-thumb">
					<?php the_post_thumbnail( 'thumbnail' ) ?>
				</div>
				<div class="bc-02-content">
					<?php // FIXME echo snax_capture_item_position( array('prefix' => '', 'suffix' => '' ) ); ?>
					<?php if ( $bunchy_elements['title'] ) : ?>
						<a href="<?php the_permalink(); ?>">
							<h3 class="entry-title g1-delta bc-02-title" itemprop="headline"><?php the_title(); ?></h3>
						</a>
					<?php endif; ?>
					<?php 
					if ( $show_subtitle && bunchy_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) {
						the_subtitle( '<h4 class="entry-subtitle g1-epsilon g1-epsilon-2nd">', '</h4>' );
					}
					?>
					<div class="bc-02-details">
						<?php
						bunchy_render_entry_stats( array(
							'class'         => 'bs-02-counts',
							'share_count'   => $bunchy_elements['shares'],
							'view_count'    => $bunchy_elements['views'],
							'comment_count' => $bunchy_elements['comments_link'],

							//'class'         => '',
							//'before'        => '<p class="%s">',
							//'after'         => '</p>',
							//'share_count'   => true,
							//'view_count'    => true,
							//'comment_count' => true,
						) );
						?>
					</div>
				</div>
			</article>
		</div>
		<?php $i_post++; ?>
	<?php endwhile; ?>
<?php endif; ?>
	
	
<?php 
//$wp_query = $temp_query;
//bunchy_reset_template_part_data();
//wp_reset_postdata();
?>
