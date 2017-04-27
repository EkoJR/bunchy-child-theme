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

//Custom Set Variables
$show_snax_bar = false;
$show_snax_tab = true;
$show_subtitle = true;



$bunchy_template_data = bunchy_get_template_part_data();
$bunchy_elements   = $bunchy_template_data['elements'];

//echo var_dump( $bunchy_template_data );
/* themes\bunchy-child-theme\template-parts\content-bs-collection-01.php:19:
array (size=4)
  'template' => string 'three-featured-classic-sidebar' (length=30)
  'pagination' => string 'infinite-scroll' (length=15)
  'elements' => 
    array (size=10)
      'featured_media' => boolean true
      'categories' => boolean true
      'title' => boolean true
      'summary' => boolean true
      'author' => boolean true
      'avatar' => boolean true
      'date' => boolean true
      'shares' => boolean true
      'views' => boolean true
      'comments_link' => boolean true
  'featured_entries' => 
    array (size=3)
      'type' => string 'recent' (length=6)
      'time_range' => string 'all' (length=3)
      'elements' => 
        array (size=10)
          'featured_media' => boolean true
          'categories' => boolean true
          'title' => boolean true
          'summary' => boolean true
          'author' => boolean true
          'avatar' => boolean true
          'date' => boolean true
          'shares' => boolean true
          'views' => boolean true
          'comments_link' => boolean true
 */
//echo var_dump( $bunchy_elements );
/*
array (size=10)
  'featured_media' => boolean true
  'categories'     => boolean true
  'title'          => boolean true
  'summary'        => boolean true
  'author'         => boolean true
  'avatar'         => boolean true
  'date'           => boolean true
  'shares'         => boolean true
  'views'          => boolean true
  'comments_link'  => boolean true
 */

?>
<?php
// TODO - Add query.

// Prevent direct script access.


//$bunchy_template_data                      = bunchy_get_template_part_data();
//$bunchy_featured_entries                   = $bunchy_template_data['featured_entries'];
//$bunchy_featured_entries['posts_per_page'] = 1;

//$bunchy_featured_ids = bunchy_get_featured_posts_ids( $bunchy_featured_entries );

//$bunchy_query_args = array();

//if ( ! empty( $bunchy_featured_ids ) ) {
//	$bunchy_query_args['post__in']            = $bunchy_featured_ids;
//	$bunchy_query_args['orderby']             = 'post__in';
//	$bunchy_query_args['ignore_sticky_posts'] = true;
//}

/*
$bunchy_title = wp_kses_post( __( 'Latest <span>stories</span>', 'bunchy' ) );

switch ( $bunchy_featured_entries['type'] ) {
	case 'most_shared':
		$bunchy_title = wp_kses_post( __( 'Most <span>shared</span>', 'bunchy' ) );
		break;

	case 'most_viewed':
		$bunchy_title = wp_kses_post( __( 'Most <span>viewed</span>', 'bunchy' ) );
		break;
}
 */
$bs_query_args = array(
	
	/*'tax_query' => array(
		array(
			'taxonomy' => 'category',
			'field' => 'slug',
			'terms' => array( 'feature' ),
			'include_children' => true,
		),
	),*/
	
	'posts_per_page' => 1,
	'posts_per_archive_page' => 3,
	'ignore_sticky_posts' => true,
	'order' => 'ASC',
	'order_by' => 'date',
	
);
$bs_query = new WP_Query( $bs_query_args );
?>

<?php if ( $bs_query->have_posts() ) : ?>
	<?php while ( $bs_query->have_posts() ) : $bs_query->the_post(); ?>
		<article id="post-<?php $bs_query->the_ID(); ?>" <?php post_class( 'entry-tpl-classic' ); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
			<div class="respon_row respon_group">
				<div class="respon_col span_2_of_5">
					<div class="bs-01-thumb-header">
						<header class="entry-header bs-01-header">
							<?php if ( $bunchy_elements['title'] ) : ?>
								<?php /* TODO Add length limit */the_title( '<h1 class="g1-mega g1-mega-1st entry-title" itemprop="headline">', '</h1>' ); ?>
							<?php endif; ?>
							
							<?php
							if ( $show_subtitle && bunchy_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) :
								the_subtitle( '<h2 class="entry-subtitle g1-gamma g1-gamma-3rd">', '</h2>' );
							endif;
							?>
							
							<?php
							if ( $bunchy_elements['author'] ) :
								bunchy_render_entry_author( array(
									'avatar'      => $bunchy_elements['avatar'],
									'avatar_size' => 18,
									'use_microdata' => true,
								) );
							endif;
							?>
							
							<?php
							if ( $bunchy_elements['date'] ) :
								bunchy_render_entry_date( array(
									'use_microdata' => true,
								) );
							endif;
							?>
						</header>
						<?php if ( $show_snax_tab && bunchy_can_use_plugin( 'snax/snax.php' ) ) : ?>
							<?php if ( snax_is_format( 'list' ) ) : ?>
								<a class="entry-badge entry-badge-open-list" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Open list', 'bunchy' ); ?></a>
							<?php endif; ?>
						<?php endif; ?>
						<div class="bc-01-featured-img">
							<?php 
							if ( $bunchy_elements['featured_media'] ) :
								bunchy_render_entry_featured_media( array(
									'size' => 'medium',
									'class' => 'bc-collection-01',
									'use_microdata' => true,
									'apply_link' => false,
									
									//'size'              => 'bunchy-grid-standard' || 'post-thumbnail',
									//'class'             => '',
									//'use_sizer'         => true,
									//'use_microdata'     => false,
									//'apply_link'        => true,
									//'background_image'  => false,
									//'force_placeholder' => false,
								) );
							endif;
							?>
						</div>
					</div>

					
					<?php if ( $show_snax_bar ) : // <hr> ?>
						<div class="bs-01-test0snax-bar">
							<?php get_template_part( 'template-parts/snax-bar-item' ); ?>
						</div>
					<?php endif; ?>
					
					<div class="bc-01-details">
						<div class="bc-01-details-left">
							<?php
							if ( $bunchy_elements['categories'] ) :
								bunchy_render_entry_categories( array( 
									'class'         => 'bs-01-categories',
									
									//'before'        => '<span class="entry-categories %s"><span class="entry-categories-inner"><span class="entry-categories-label">' . esc_html__( 'in', 'bunchy' ). '</span> ',
									//'after'         => '</span></span>',
									//'class'         => '',
									//'use_microdata' => false,
								) );
							endif;
							?>
						</div>
						<div class="bc-01-details-right">
							<?php
							bunchy_render_entry_stats( array(
								'class'         => 'bs-01-counts',
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
					<div class="bc-01-summary">
						<?php if ( $bunchy_elements['summary'] ) : ?>
							<div class="entry-summary">
								<?php 
								the_excerpt(); 
								// the_content();
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="respon_col span_3_of_5">
					
					<!-- VOTE GRID -->
					
				</div>
			</div>
			<meta itemprop="mainEntityOfPage" content="<?php echo esc_url( get_permalink() ); ?>"/>
			<meta itemprop="dateModified"
				  content="<?php echo esc_attr( get_the_modified_time( 'Y-m-d' ) . 'T' . get_the_modified_time( 'H:i:s' ) ); ?>"/>

			<span itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
				<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"/>
				<span itemprop="logo" itemscope itemtype="http://schema.org/ImageObject">
					<meta itemprop="url"
						  content="http://bunchy.bringthepixel.com/wp-content/uploads/2015/11/wow_06_v01-192x96.jpg"/>
				</span>
			</span>
		</article>
	<?php endwhile; ?>
<?php endif; 
bunchy_reset_template_part_data();
wp_reset_postdata();
?>
