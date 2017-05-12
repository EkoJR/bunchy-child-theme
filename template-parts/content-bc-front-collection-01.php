<?php

$bunchy_entry_data = bunchy_get_template_part_data();
$bunchy_elements   = $bunchy_entry_data['elements'];

$total_columns = 4;


$category = '';//'feature';


$temp_query = $wp_query;

$wp_query->set( 'category_name', $category );

?>

<div class="bc-frontpage-01">
	<div class="bc-fp-01">
		<div class="respon_row respon_group bc-fp-01-l-top">
			<?php $post_index = 0; ?>
			<?php $post_span = 2; ?>
			<?php $total_column = $total_columns; ?>
			<?php while ( have_posts() && ( $total_columns - 1 ) > $post_index ) : ?>
			<div class="respon_col span_1_of_2">
						<div class="respon_row respon_group">
				<?php while ( 0 < ( $total_column - $post_span ) || ( 1 === $total_column && $post_span === $total_column ) ) : the_post(); ?>
					
							<div class="bc-fp-01-post-container respon_col span_<?php echo $post_span; ?>_of_2">

								<article id="post-<?php the_ID();?>" <?php post_class( 'bc-fp-01-post'); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
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
											'class'         => 'bc-fp-01-counts',
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
							</div>
						
			
			
					<?php 
					$total_column -= $post_span;
					$post_index++;
					?>
				<?php endwhile; ?>
			</div>
					</div>
				<?php 
				if ( 0 >= ( $total_column - $post_span ) ) {
					$post_span = 1;
				}
				?>
			<?php endwhile; ?>
		</div>
		<div class="respon_row respon_group bc-fp-01-l-bottom">
			<?php $post_index = 0; ?>
			<?php $post_span = 1; ?>
			<?php $total_column = $total_columns; ?>
			<?php while ( have_posts() && ( $total_columns - 1 ) > $post_index ) : ?>
				<div class="respon_col span_1_of_2">
					<div class="respon_row respon_group">
				<?php while ( 0 < ( $total_column - ( $post_span + 1 ) ) || ( 2 === $total_column && $post_span === $total_column ) ) : the_post(); ?>
					
							<div class="bc-fp-01-post-container respon_col span_<?php echo $post_span; ?>_of_2">

								<article id="post-<?php the_ID();?>" <?php post_class( 'bc-fp-01-post'); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
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
											'class'         => 'bc-fp-01-counts',
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
							</div>
						
			
			
					<?php 
					$total_column -= $post_span;
					$post_index++;
					?>
				<?php endwhile; ?>
					</div>
			</div>
				
				<?php 
				if ( 0 >= ( $total_column - 2 ) ) {
					$post_span = 2;
				}
				?>
			<?php endwhile; ?>
				
		</div>
	</div>
</div>
<br style="clear: both;">
<?php 
$wp_query = $temp_query; 
//bunchy_reset_template_part_data();
wp_reset_postdata();
