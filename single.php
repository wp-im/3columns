<?php
/**
 * Single post publication document.
 *
 * @package Three_Columns
 */

get_header();
?>
<div class="shell site-grid shell-grid">
	<?php get_sidebar( 'left' ); ?>

	<main class="main-column" id="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
				<div class="reading-frame article-frame">
					<header class="article-header">
						<div class="article-kicker"><?php echo wp_kses_post( get_the_category_list( ' · ' ) ); ?></div>
						<h1 class="article-title"><?php the_title(); ?></h1>
						<?php $three_columns_deck = three_columns_explicit_deck(); ?>
						<?php if ( $three_columns_deck ) : ?><p class="article-deck"><?php echo esc_html( wp_strip_all_tags( $three_columns_deck ) ); ?></p><?php endif; ?>
						<?php three_columns_post_meta(); ?>
					</header>
				</div>

				<div class="media media--landscape article-hero">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'full', array( 'decoding' => 'async', 'fetchpriority' => 'high', 'sizes' => three_columns_image_sizes( 'article' ) ) ); ?>
					<?php else : ?>
						<?php echo three_columns_placeholder_svg( 'landscape' ); ?>
					<?php endif; ?>
				</div>

				<div class="reading-frame article-frame">
					<?php
					$three_columns_caption = has_post_thumbnail() ? wp_get_attachment_caption( get_post_thumbnail_id() ) : '';
					if ( $three_columns_caption ) :
						?>
						<div class="article-hero-caption"><?php echo wp_kses_post( $three_columns_caption ); ?></div>
					<?php endif; ?>

					<div class="article-body">
						<?php
						the_content();
						wp_link_pages(
							array(
								'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Post pages', 'three-columns' ) . '">',
								'after'  => '</nav>',
							)
						);
						?>
					</div>

					<footer class="article-footer">
						<?php $three_columns_categories = get_the_category_list( ' · ' ); ?>
						<?php if ( $three_columns_categories ) : ?>
							<div class="article-footer-row"><span class="article-footer-label"><?php esc_html_e( 'Filed under', 'three-columns' ); ?></span><span><?php echo wp_kses_post( $three_columns_categories ); ?></span></div>
						<?php endif; ?>
						<?php $three_columns_tags = get_the_tag_list( '', ' ', '' ); ?>
						<?php if ( $three_columns_tags ) : ?>
							<div class="article-footer-row"><span class="article-footer-label"><?php esc_html_e( 'Tags', 'three-columns' ); ?></span><span class="article-tags"><?php echo wp_kses_post( $three_columns_tags ); ?></span></div>
						<?php endif; ?>
					</footer>

					<?php
					$three_columns_previous = get_previous_post();
					$three_columns_next     = get_next_post();
					if ( $three_columns_previous || $three_columns_next ) :
						?>
						<nav class="post-navigation" aria-label="<?php esc_attr_e( 'Previous and next posts', 'three-columns' ); ?>">
							<?php if ( $three_columns_previous ) : ?>
								<a class="post-nav-link" href="<?php echo esc_url( get_permalink( $three_columns_previous ) ); ?>"><span class="post-nav-label"><span class="post-nav-arrow">←</span> <?php esc_html_e( 'PREVIOUS', 'three-columns' ); ?></span><span class="post-nav-title"><?php echo esc_html( get_the_title( $three_columns_previous ) ); ?></span></a>
							<?php else : ?><span class="post-nav-link" aria-hidden="true"></span><?php endif; ?>
							<?php if ( $three_columns_next ) : ?>
								<a class="post-nav-link" href="<?php echo esc_url( get_permalink( $three_columns_next ) ); ?>"><span class="post-nav-label"><?php esc_html_e( 'NEXT', 'three-columns' ); ?> <span class="post-nav-arrow">→</span></span><span class="post-nav-title"><?php echo esc_html( get_the_title( $three_columns_next ) ); ?></span></a>
							<?php else : ?><span class="post-nav-link" aria-hidden="true"></span><?php endif; ?>
						</nav>
					<?php endif; ?>

					<?php $three_columns_related = three_columns_related_query( get_the_ID(), 3 ); ?>
					<?php if ( $three_columns_related->have_posts() ) : ?>
						<section class="related-section" aria-labelledby="related-title">
							<?php get_template_part( 'template-parts/section-heading', null, array( 'id' => 'related-title', 'title' => __( 'RELATED ARTICLES / 相關文章', 'three-columns' ) ) ); ?>
							<div class="related-grid">
								<?php while ( $three_columns_related->have_posts() ) : $three_columns_related->the_post(); get_template_part( 'template-parts/related-card' ); endwhile; ?>
							</div>
						</section>
					<?php endif; wp_reset_postdata(); ?>

					<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
				</div>
			</article>
		<?php endwhile; ?>
	</main>

	<?php get_sidebar( 'right' ); ?>
</div>
<?php get_footer(); ?>
