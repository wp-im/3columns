<?php
/**
 * Static front page / publication index.
 *
 * @package Three_Columns
 */

if ( 'posts' === get_option( 'show_on_front' ) ) {
	get_header();
	get_template_part( 'template-parts/posts-index' );
	get_footer();
	return;
}

get_header();
$three_columns_used_ids        = array();
$three_columns_home_has_posts = false;
$three_columns_front_comments = false;
?>
<div class="shell site-grid shell-grid">
	<?php get_sidebar( 'left' ); ?>

	<main class="main-column" id="main">
		<?php
		while ( have_posts() ) :
			the_post();
			$three_columns_front_content = trim( (string) get_post_field( 'post_content', get_the_ID() ) );
			$three_columns_front_comments = comments_open() || get_comments_number();
			if ( '' !== $three_columns_front_content ) :
				?>
				<section class="front-page-document reading-frame" aria-label="<?php esc_attr_e( 'Front page introduction', 'three-columns' ); ?>">
					<div class="article-body">
						<?php
						the_content();
						wp_link_pages(
							array(
								'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page sections', 'three-columns' ) . '">',
								'after'  => '</nav>',
							)
						);
						?>
					</div>
				</section>
				<?php
			endif;
		endwhile;
		?>
		<?php
		$three_columns_hero = three_columns_home_query( 'hero', 1, $three_columns_used_ids );
		if ( $three_columns_hero->have_posts() ) :
			$three_columns_home_has_posts = true;
			$three_columns_hero->the_post();
			$three_columns_used_ids[] = get_the_ID();
			$three_columns_hero_excerpt = get_the_excerpt();
			$three_columns_hero_category = three_columns_primary_category();
			?>
			<section class="hero" aria-labelledby="hero-title">
				<div class="hero-copy">
					<div class="kicker"><?php echo esc_html( $three_columns_hero_category ? $three_columns_hero_category->name : __( 'INDEX', 'three-columns' ) ); ?></div>
					<h1 id="hero-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<?php if ( $three_columns_hero_excerpt ) : ?><p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $three_columns_hero_excerpt ), 28, '…' ) ); ?></p><?php endif; ?>
					<a class="hero-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read the article', 'three-columns' ); ?> <span>→</span></a>
				</div>
				<a class="media media--landscape hero-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
					<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large', array( 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'hero' ) ) ); else : echo three_columns_placeholder_svg( 'landscape' ); endif; ?>
				</a>
			</section>
		<?php endif; wp_reset_postdata(); ?>

		<div class="reading-frame">
			<?php
			$three_columns_featured = three_columns_featured_query( $three_columns_used_ids );
			if ( $three_columns_featured->have_posts() ) :
				$three_columns_home_has_posts = true;
				$three_columns_featured->the_post();
				$three_columns_used_ids[] = get_the_ID();
				$three_columns_excerpt = get_the_excerpt();
				?>
				<section class="section-block" aria-labelledby="featured-title">
					<?php get_template_part( 'template-parts/section-heading', null, array( 'id' => 'featured-title', 'title' => __( 'FEATURED', 'three-columns' ) ) ); ?>
					<article <?php post_class( 'feature-card' ); ?>>
						<a class="media media--landscape" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
							<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large', array( 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'feature' ) ) ); else : echo three_columns_placeholder_svg( 'landscape' ); endif; ?>
						</a>
						<div class="feature-copy">
							<div class="date"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></div>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<?php if ( $three_columns_excerpt ) : ?><p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $three_columns_excerpt ), 30, '…' ) ); ?></p><?php endif; ?>
							<a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more →', 'three-columns' ); ?></a>
						</div>
					</article>
				</section>
			<?php endif; wp_reset_postdata(); ?>

			<?php $three_columns_essays = three_columns_home_query( 'essays', 3, $three_columns_used_ids ); ?>
			<?php if ( $three_columns_essays->have_posts() ) : $three_columns_home_has_posts = true; ?>
				<section class="section-block" id="recent" aria-labelledby="recent-title">
					<?php get_template_part( 'template-parts/section-heading', null, array( 'id' => 'recent-title', 'title' => __( 'RECENT ESSAYS', 'three-columns' ), 'action_url' => three_columns_source_url( 'essays' ), 'action_label' => __( 'All essays →', 'three-columns' ) ) ); ?>
					<div class="entry-list">
						<?php while ( $three_columns_essays->have_posts() ) : $three_columns_essays->the_post(); $three_columns_used_ids[] = get_the_ID(); get_template_part( 'template-parts/content', 'entry' ); endwhile; ?>
					</div>
				</section>
			<?php endif; wp_reset_postdata(); ?>

			<?php $three_columns_reviews = three_columns_home_query( 'reviews', 3, $three_columns_used_ids ); ?>
			<?php if ( $three_columns_reviews->have_posts() ) : $three_columns_home_has_posts = true; ?>
				<section class="section-block" id="reviews" aria-labelledby="reviews-title">
					<?php get_template_part( 'template-parts/section-heading', null, array( 'id' => 'reviews-title', 'title' => __( 'RECENT REVIEWS', 'three-columns' ), 'action_url' => three_columns_source_url( 'reviews' ), 'action_label' => __( 'All reviews →', 'three-columns' ) ) ); ?>
					<div class="entry-list reviews-list">
						<?php while ( $three_columns_reviews->have_posts() ) : $three_columns_reviews->the_post(); $three_columns_used_ids[] = get_the_ID(); get_template_part( 'template-parts/content', 'review' ); endwhile; ?>
					</div>
				</section>
			<?php endif; wp_reset_postdata(); ?>

			<?php $three_columns_series = three_columns_home_query( 'series', 6, $three_columns_used_ids ); ?>
			<?php if ( $three_columns_series->have_posts() ) : $three_columns_home_has_posts = true; ?>
				<section class="section-block" id="series" aria-labelledby="series-title">
					<div class="section-heading">
						<h2 class="section-title" id="series-title"><?php esc_html_e( 'SERIES / 專欄', 'three-columns' ); ?></h2>
						<div class="series-head-actions">
							<a class="section-action" href="<?php echo esc_url( three_columns_source_url( 'series' ) ); ?>"><?php esc_html_e( 'View all →', 'three-columns' ); ?></a>
							<div class="series-controls" aria-label="<?php esc_attr_e( 'Series controls', 'three-columns' ); ?>">
								<button class="series-control" type="button" data-series-prev aria-label="<?php esc_attr_e( 'Previous series', 'three-columns' ); ?>">←</button>
								<button class="series-control" type="button" data-series-next aria-label="<?php esc_attr_e( 'Next series', 'three-columns' ); ?>">→</button>
							</div>
						</div>
					</div>
					<div class="series-viewport" tabindex="0" aria-label="<?php esc_attr_e( 'Series; scroll horizontally for more', 'three-columns' ); ?>">
						<div class="series-track">
							<?php while ( $three_columns_series->have_posts() ) : $three_columns_series->the_post(); $three_columns_used_ids[] = get_the_ID(); get_template_part( 'template-parts/content', 'card' ); endwhile; ?>
						</div>
					</div>
					<div class="series-index" aria-hidden="true"><span class="series-dot is-active"></span><span class="series-dot"></span><span class="series-dot"></span></div>
				</section>
			<?php endif; wp_reset_postdata(); ?>

			<?php $three_columns_notes = three_columns_home_query( 'notes', 5, $three_columns_used_ids ); ?>
			<?php if ( $three_columns_notes->have_posts() ) : $three_columns_home_has_posts = true; ?>
				<section class="section-block" id="notes" aria-labelledby="notes-title">
					<?php get_template_part( 'template-parts/section-heading', null, array( 'id' => 'notes-title', 'title' => __( 'SELECTED NOTES / 隨筆', 'three-columns' ), 'action_url' => three_columns_source_url( 'notes' ), 'action_label' => __( 'All notes →', 'three-columns' ) ) ); ?>
					<div class="notes-list">
						<?php while ( $three_columns_notes->have_posts() ) : $three_columns_notes->the_post(); $three_columns_used_ids[] = get_the_ID(); ?>
							<a class="note-row" href="<?php the_permalink(); ?>"><span class="note-date"><?php echo esc_html( get_the_date() ); ?></span><span class="note-dash">—</span><span><?php the_title(); ?></span><span>→</span></a>
						<?php endwhile; ?>
					</div>
				</section>
			<?php endif; wp_reset_postdata(); ?>

			<?php $three_columns_publications = three_columns_home_query( 'publications', 4, $three_columns_used_ids ); ?>
			<?php if ( $three_columns_publications->have_posts() ) : $three_columns_home_has_posts = true; ?>
				<section class="section-block" id="publications" aria-labelledby="publications-title">
					<?php get_template_part( 'template-parts/section-heading', null, array( 'id' => 'publications-title', 'title' => __( 'SELECTED PUBLICATIONS / 精選出版', 'three-columns' ), 'action_url' => three_columns_source_url( 'publications' ), 'action_label' => __( 'View all books →', 'three-columns' ) ) ); ?>
							<div class="publications-grid">
						<?php while ( $three_columns_publications->have_posts() ) : $three_columns_publications->the_post(); $three_columns_used_ids[] = get_the_ID(); $three_columns_excerpt = get_the_excerpt(); ?>
							<article <?php post_class( 'publication' ); ?>>
								<a class="cover-wrap" href="<?php the_permalink(); ?>">
									<span class="media media--portrait"><?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'publication' ) ) ); else : echo three_columns_placeholder_svg( 'portrait' ); endif; ?></span>
								</a>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<?php if ( $three_columns_excerpt ) : ?><p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $three_columns_excerpt ), 12, '…' ) ); ?></p><?php endif; ?>
								<span class="year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span>
							</article>
						<?php endwhile; ?>
					</div>
				</section>
			<?php endif; wp_reset_postdata(); ?>

			<?php if ( ! $three_columns_home_has_posts ) : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
		</div>

		<?php if ( $three_columns_front_comments ) { comments_template(); } ?>
	</main>

	<?php get_sidebar( 'right' ); ?>
</div>
<?php get_footer(); ?>
