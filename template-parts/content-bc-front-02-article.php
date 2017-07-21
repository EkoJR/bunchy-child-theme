<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$content_length = 200;
$bunchy_home_settings = bunchy_get_home_settings();
/*
$args = array(
	'category_name' => $bunchy_home_settings['featured_entries']['category_name'],
);
snax_mod_get_items_query( $args );
*/
?>
<div class="bc-fp-02-article">
	<article id="post-<?php the_ID();?>" <?php post_class( 'bc-fp-02-post' ); ?> itemscope="" itemtype="<?php echo esc_attr( bunchy_get_entry_microdata_itemtype() ); ?>">
		<div class="bc-fp-02-header">
			<header>
				<?php if ( $bunchy_home_settings['elements']['title'] ) : ?>
					<a href="<?php the_permalink(); ?>">
						<h3 class="bc-fp-02-title"><?php the_title(); ?></h3>
					</a>
				<?php endif; ?>
				<?php if ( isset( $show_subtitle ) && $show_subtitle && bunchy_can_use_plugin( 'wp-subtitle/wp-subtitle.php' ) ) : ?>
					<div>
						<h4 class="entry-subtitle g1-epsilon g1-epsilon-2nd"><?php the_subtitle(); ?></h4>
					</div>
				<?php endif; ?>
			</header>
		</div>
		<div class="bc-fp-02-container">
			<?php if ( $bunchy_home_settings['elements']['featured_media'] ) : ?>
				<div class="bc-fp-02-thumb">
					<?php the_post_thumbnail( 'medium' ); ?>
					<?php if ( isset( $show_snax_tab ) && $show_snax_tab && bunchy_can_use_plugin( 'snax/snax.php' ) ) : ?>
						<?php if ( snax_is_format( 'list' ) ) : ?>
							<a class="entry-badge entry-badge-open-list bc-fp-02-badge" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Open list', 'bunchy' ); ?></a>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
				<div class="bc-fp-02-details">
					<?php if ( $bunchy_home_settings['elements']['author'] || $bunchy_home_settings['elements']['date'] ) : ?>
					<p class="entry-meta entry-meta-stats"><?php
						if ( $bunchy_home_settings['elements']['author'] ) :
							//echo 'by ';
							bunchy_render_entry_author( array(
								'avatar'      => $bunchy_home_settings['elements']['avatar'],
								'avatar_size' => 18,
								'use_microdata' => true,
							) );
						endif; ?>
						<?php
						if ( $bunchy_home_settings['elements']['date'] ) :
							bunchy_render_entry_date( array(
								'use_microdata' => true,
							) );
						endif;
					?></p>
					<?php endif; ?>
					<?php
					if ( $bunchy_home_settings['elements']['categories'] ) :
						bunchy_render_entry_categories( array( 
							'class'         => 'bs-fp-02-tax-terms',
							'before'        => '<p class="entry-meta entry-meta-stats %s"><span class="entry-categories-label">' . esc_html__( 'in', 'bunchy' ). '</span> ',
							'after'         => '</p>',
							'use_microdata' => true,
						) );
					endif;
					?>
					<?php
					bunchy_render_entry_stats( array(
						'class'         => 'bs-fp-02-counts',
						'share_count'   => $bunchy_home_settings['elements']['shares'],
						'view_count'    => $bunchy_home_settings['elements']['views'],
						'comment_count' => $bunchy_home_settings['elements']['comments_link'],
					) );
					?>
				</div>
			<?php if ( $bunchy_home_settings['elements']['summary'] ) : ?>
				<?php 
				$html_excerpt = get_the_excerpt( $wp_query->post );
				$html_excerpt = preg_replace(" ([.*?])",'',$html_excerpt);
				$encoding = mb_internal_encoding();
				$html_excerpt = mb_substr( strip_tags( strip_shortcodes( $html_excerpt ) ),
										   0,
										   $content_length,
										   $encoding);
				$html_excerpt = substr( $html_excerpt, 0, strripos( $html_excerpt, " " ) );
				?>
				<p class="bc-fp-02-content"><?php echo $html_excerpt; ?></p>
			<?php endif; ?>
		</div>
		<?php get_template_part( 'snax/content-front-02', 'items' ); ?>
	</article>
</div>