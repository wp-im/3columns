<?php
/**
 * Image-left editorial entry row.
 *
 * @package Three_Columns
 */
$three_columns_excerpt = get_the_excerpt();
?>
<article <?php post_class( 'entry-row' ); ?>>
	<a class="media media--landscape" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'entry' ) ) ); ?>
		<?php else : ?>
			<?php echo three_columns_placeholder_svg( 'landscape' ); ?>
		<?php endif; ?>
	</a>
	<div class="entry-copy">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="date"><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></div>
		<?php if ( $three_columns_excerpt ) : ?><p><?php echo esc_html( wp_strip_all_tags( $three_columns_excerpt ) ); ?></p><?php endif; ?>
		<div class="entry-foot"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'READ MORE →', 'three-columns' ); ?></a></div>
	</div>
</article>
