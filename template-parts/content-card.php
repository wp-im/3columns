<?php
/**
 * Compact card used by Series and other horizontal collections.
 *
 * @package Three_Columns
 */
$three_columns_excerpt      = get_the_excerpt();
$three_columns_reading_time = three_columns_reading_time();
?>
<article <?php post_class( 'series-card' ); ?>>
	<a class="media media--landscape" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'series' ) ) ); ?>
		<?php else : ?>
			<?php echo three_columns_placeholder_svg( 'landscape' ); ?>
		<?php endif; ?>
	</a>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php if ( $three_columns_excerpt || $three_columns_reading_time ) : ?>
		<p><?php echo esc_html( $three_columns_excerpt ? wp_trim_words( wp_strip_all_tags( $three_columns_excerpt ), 15, '…' ) : sprintf( __( '%s min read', 'three-columns' ), number_format_i18n( $three_columns_reading_time ) ) ); ?></p>
	<?php endif; ?>
</article>
