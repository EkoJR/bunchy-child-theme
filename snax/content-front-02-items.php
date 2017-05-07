<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$items_total = 3;

$bunchy_home_settings = bunchy_get_home_settings();
//var_dump($bunchy_home_settings);
/*
array (size=4)
  'template' => string 'one-featured-classic-sidebar' (length=28)
  'pagination' => string 'infinite-scroll-on-demand' (length=25)
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
    array (size=5)
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
      'category_name' => string 'bimber-animals,feline-friend,celebrities,cell-phones,clothing,computers' (length=71)
      'tag_slug__in' => 
        array (size=1)
          0 => string 'bunchy-home' (length=11)
 */
//$bunchy_home_settings['elements']['']



$bunchy_home_settings = bunchy_get_home_settings();
$temp_query_fp_02_items = $wp_query;
$wp_post_id = $temp_query_fp_02_items->post->ID;

$args = array(
	'post_parent' => $wp_post_id,
	'posts_per_page' => $items_total,
	//'category_name' => $bunchy_home_settings['featured_entries']['category_name'],
);
$wp_query = snax_mod_get_items_query( $args );



$snax_item_id = $wp_query->post->ID;
$item_index = 0;
?>
<div class="snax">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="snax-item bc-fp-02-item">
				<div class="snax-item-actions bc-fp-02-item-vote-box">
					<?php snax_mod_render_voting_box( $snax_item_id, $wp_post_id ) ?>
				</div>
				<div class="bc-fp-02-item-thumb">
					<?php the_post_thumbnail( 'thumbnail' ) ?>
				</div>
				<div class="bc-fp-02-item-container">
					<div class="bc-fp-02-item-container-inner">
						<h5 class="g1-delta g1-delta-1st snax-item-title bc-fp-02-item-title">
							<?php if ( $bunchy_home_settings['elements']['title'] ) : ?>
								<a href="<?php echo esc_url( the_permalink() ); ?>" id="snax-itemli-<?php echo (int) $wp_query->post->ID; ?>" rel="bookmark">
									<?php
									//echo snax_capture_item_position( array('prefix' => '', 'suffix' => '' ) );
									the_title('', '');
									?>
								</a>
							<?php endif; ?>
								
						</h5>
					</div>
				</div>
			</div>
			<?php $item_index++; ?>
		<?php endwhile; ?>
	<?php endif; ?>
	<?php while ( $item_index < $items_total ) : ?>
		<div class="bc-fp-02-item">**EMPTY MESSAGE**</div>
		<?php $item_index++; ?>
	<?php endwhile; ?>
</div>
	
<?php
$wp_query = $temp_query_fp_02_items;
wp_reset_postdata();