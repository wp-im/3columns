<?php
/**
 * Right context rail.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! three_columns_has_context_rail() ) {
	return;
}
?>
<aside class="right-rail off-canvas-right" id="rightRail" aria-label="<?php esc_attr_e( 'Context and secondary information', 'three-columns' ); ?>">
	<div class="rail-sticky">
		<?php if ( is_front_page() || is_home() ) : ?>
			<?php
			$three_columns_current_query = new WP_Query(
				array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'posts_per_page'      => 1,
					'no_found_rows'       => true,
					'ignore_sticky_posts' => false,
				)
			);
			?>
			<?php if ( $three_columns_current_query->have_posts() ) : ?>
				<?php while ( $three_columns_current_query->have_posts() ) : $three_columns_current_query->the_post(); ?>
					<section class="context-block">
						<h2 class="context-title"><?php esc_html_e( 'CURRENT', 'three-columns' ); ?></h2>
						<?php three_columns_thumbnail( 'medium', 'media media--portrait current-cover' ); ?>
						<h3 class="current-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php $three_columns_current_excerpt = get_the_excerpt(); ?>
						<?php if ( $three_columns_current_excerpt ) : ?><p class="current-copy"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $three_columns_current_excerpt ), 28, '…' ) ); ?></p><?php endif; ?>
						<div class="current-date"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></div>
					</section>
				<?php endwhile; ?>
			<?php endif; wp_reset_postdata(); ?>

			<?php
			$three_columns_series_category = three_columns_source_category( 'series' );
			$three_columns_series_term     = $three_columns_series_category ? get_category( $three_columns_series_category ) : get_category_by_slug( 'series' );
			if ( $three_columns_series_term && ! is_wp_error( $three_columns_series_term ) ) :
				$three_columns_series_url = get_category_link( $three_columns_series_term->term_id );
				?>
				<section class="context-block">
					<h2 class="context-title"><?php esc_html_e( 'SERIES', 'three-columns' ); ?><?php if ( ! is_wp_error( $three_columns_series_url ) ) : ?> <a href="<?php echo esc_url( $three_columns_series_url ); ?>"><?php esc_html_e( 'View all →', 'three-columns' ); ?></a><?php endif; ?></h2>
					<ul class="context-list">
						<li><span><?php echo esc_html( $three_columns_series_term->name ); ?></span><span><?php echo esc_html( number_format_i18n( $three_columns_series_term->count ) ); ?></span></li>
					</ul>
				</section>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( is_singular( 'post' ) ) : ?>
			<?php $three_columns_reading_time = three_columns_reading_time(); ?>
			<section class="context-block">
				<h2 class="context-title"><?php esc_html_e( 'CURRENT ARTICLE', 'three-columns' ); ?></h2>
				<?php three_columns_thumbnail( 'medium', 'media media--portrait current-cover' ); ?>
				<h3 class="current-title"><?php the_title(); ?></h3>
				<p class="single-context-intro">
					<?php
					$three_columns_category = three_columns_primary_category();
					if ( $three_columns_category ) {
						echo esc_html( $three_columns_category->name ) . '<br>';
					}
					echo esc_html( get_the_date() );
					if ( $three_columns_reading_time ) {
						echo ' · ' . esc_html( sprintf( __( '%s min read', 'three-columns' ), number_format_i18n( $three_columns_reading_time ) ) );
					}
					?>
				</p>
			</section>
			<section class="context-block toc-block" data-toc hidden>
				<h2 class="context-title"><?php esc_html_e( 'ON THIS PAGE', 'three-columns' ); ?></h2>
			</section>
			<?php
			$three_columns_series_term = get_category_by_slug( 'series' );
			if ( $three_columns_series_term && has_category( $three_columns_series_term->term_id ) ) :
				$three_columns_series_url = get_category_link( $three_columns_series_term->term_id );
				?>
				<section class="context-block">
					<h2 class="context-title"><?php esc_html_e( 'SERIES', 'three-columns' ); ?><?php if ( ! is_wp_error( $three_columns_series_url ) ) : ?> <a href="<?php echo esc_url( $three_columns_series_url ); ?>"><?php esc_html_e( 'View all →', 'three-columns' ); ?></a><?php endif; ?></h2>
					<a class="single-series-card" href="<?php echo esc_url( $three_columns_series_url ); ?>">
						<span class="media media--landscape">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'medium', array( 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'related' ) ) ); ?>
							<?php else : ?>
								<?php echo three_columns_placeholder_svg( 'landscape' ); ?>
							<?php endif; ?>
						</span>
						<span><strong><?php echo esc_html( $three_columns_series_term->name ); ?></strong><br><span><?php echo esc_html( sprintf( _n( '%s published post', '%s published posts', $three_columns_series_term->count, 'three-columns' ), number_format_i18n( $three_columns_series_term->count ) ) ); ?></span></span>
					</a>
				</section>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'right-sidebar' ) ) : ?>
			<div class="right-widgets">
				<?php dynamic_sidebar( 'right-sidebar' ); ?>
			</div>
		<?php endif; ?>
	</div>
</aside>
