<?php
/**
 * Related-post card.
 *
 * @package Three_Columns
 */
$three_columns_category     = three_columns_primary_category();
$three_columns_reading_time = three_columns_reading_time();
?>
<a class="related-card" href="<?php the_permalink(); ?>">
	<span class="media media--landscape">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'medium_large', array( 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'related' ) ) ); ?>
		<?php else : ?>
			<?php echo three_columns_placeholder_svg( 'landscape' ); ?>
		<?php endif; ?>
	</span>
	<div>
		<h3><?php the_title(); ?></h3>
		<?php if ( $three_columns_category || $three_columns_reading_time ) : ?>
			<p><?php echo esc_html( $three_columns_category ? $three_columns_category->name : '' ); ?><?php if ( $three_columns_category && $three_columns_reading_time ) : ?> · <?php endif; ?><?php if ( $three_columns_reading_time ) : echo esc_html( sprintf( __( '%s min', 'three-columns' ), number_format_i18n( $three_columns_reading_time ) ) ); endif; ?></p>
		<?php endif; ?>
	</div>
</a>
