<?php

$bunchy_entry_data = bunchy_get_template_part_data();
$bunchy_elements   = $bunchy_entry_data['elements'];

$post_index = 0;
$category = '';//'feature';


$temp_query = $wp_query;

$wp_query->set( 'category_name', $category );

?>

<div class="bc-frontpage-01">
	<div class="bc-fp-01">
		<div class="bc-fp-01-l-top">
			<?php $post_span = 2; ?>
			<?php while ( have_posts() && 3 > $post_index ) : the_post(); ?>
				<article id="post-<?php the_ID();?>" <?php post_class( 'bc-fp-01-post-' . $post_span . ' bc-fp-01-post'); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
					<?php the_post_thumbnail( 'medium' );?>
					<?php if ( $bunchy_elements['title'] || ( $show_subtitle && bunchy_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) ) : ?>
					<header>
						<?php if ( $bunchy_elements['title'] ) : ?>
							<a href="<?php the_permalink();?>"><h2 class="bc-fp-01-title"><?php the_title(); ?></h2></a>
						<?php endif; ?>
						<?php 
						if ( $show_subtitle && bunchy_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) {
							the_subtitle( '<h4 class="entry-subtitle g1-epsilon g1-epsilon-2nd">', '</h4>' );
						}
						?>
						<?php
						bunchy_render_entry_stats( array(
							'class'         => 'bc-f-01-counts',
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
					</header>
					<?php endif; ?>
				</article>
				<?php 
				if ( $post_index === 0 ) {
					$post_span--;
				}
				$post_index++;
				?>
			<?php endwhile; ?>
		</div>
		<div class="bc-fp-01-l-bottom">
			<?php while ( have_posts() && 6 > $post_index ) : the_post(); ?>
				<article id="post-<?php the_ID();?>" <?php post_class( 'bc-fp-01-post-' . $post_span  . ' bc-fp-01-post' ); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
					<?php the_post_thumbnail( 'medium' );?>
					<?php if ( $bunchy_elements['title'] || ( $show_subtitle && bunchy_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) ) : ?>
					<header>
						<?php if ( $bunchy_elements['title'] ) : ?>
							<a href="<?php the_permalink();?>"><h2 class="bc-fp-01-title"><?php the_title(); ?></h2></a>
						<?php endif; ?>
						<?php 
						if ( $show_subtitle && bunchy_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) {
							the_subtitle( '<h4 class="entry-subtitle g1-epsilon g1-epsilon-2nd">', '</h4>' );
						}
						?>
						<?php
						bunchy_render_entry_stats( array(
							'class'         => 'bc-f-01-counts',
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
					</header>
					<?php endif; ?>
				</article>
				<?php 
				
				if ( $post_index === 4 ) {
					$post_span++;
				}
				$post_index++;
				?>
			<?php endwhile; ?>
			
			
			
			
			
		</div>
	</div>
</div>

<?php 
$wp_query = $temp_query; 
//bunchy_reset_template_part_data();
wp_reset_postdata();
