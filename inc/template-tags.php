<?php
/**
 * Presentation helpers.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function three_columns_reading_time( $post_id = 0 ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();
	if ( post_password_required( $post_id ) ) {
		return 0;
	}

	$content = wp_strip_all_tags( (string) get_post_field( 'post_content', $post_id ) );
	if ( '' === trim( $content ) ) {
		return 1;
	}
	preg_match_all( '/[\p{Han}\p{Hiragana}\p{Katakana}\p{Hangul}]|[\p{L}\p{N}]+/u', $content, $matches );
	$units = count( $matches[0] );
	return max( 1, (int) ceil( $units / 250 ) );
}

function three_columns_explicit_deck( $post_id = 0 ) {
	$post_id = $post_id ? absint( $post_id ) : get_the_ID();
	return has_excerpt( $post_id ) ? get_the_excerpt( $post_id ) : '';
}

function three_columns_primary_category( $post_id = 0 ) {
	$post_id    = $post_id ? absint( $post_id ) : get_the_ID();
	$categories = get_the_category( $post_id );
	return ! empty( $categories ) ? $categories[0] : null;
}

function three_columns_post_meta() {
	$category                   = three_columns_primary_category();
	$three_columns_reading_time = three_columns_reading_time();
	?>
	<div class="article-meta">
		<span><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
		<?php if ( $three_columns_reading_time ) : ?>
			<span><?php echo esc_html( sprintf( _n( '%s min read', '%s min read', $three_columns_reading_time, 'three-columns' ), number_format_i18n( $three_columns_reading_time ) ) ); ?></span>
		<?php endif; ?>
		<?php if ( $category ) : ?>
			<span><a href="<?php echo esc_url( get_category_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a></span>
		<?php endif; ?>
		<span><?php echo esc_html( get_the_author() ); ?></span>
	</div>
	<?php
}


/**
 * Return a layout-aware responsive-image sizes hint.
 *
 * @param string $context Visual image context.
 * @return string Sizes attribute value.
 */
function three_columns_image_sizes( $context = 'entry' ) {
	$sizes = array(
		'hero'        => '(max-width: 639px) calc(100vw - 32px), (max-width: 767px) 90vw, (max-width: 1023px) calc(100vw - 60px), (max-width: 1079px) calc(100vw - 320px), 760px',
		'feature'     => '(max-width: 639px) calc(100vw - 32px), 280px',
		'entry'       => '(max-width: 384px) 46vw, (max-width: 639px) 177px, 180px',
		'series'      => '(max-width: 639px) calc(50vw - 24px), (max-width: 1023px) calc((100vw - 76px) / 2), (max-width: 1079px) calc((100vw - 336px) / 2), 372px',
		'related'     => '(max-width: 767px) 132px, 220px',
		'publication' => '(max-width: 639px) calc(50vw - 34px), 150px',
		'article'     => '(max-width: 639px) calc(100vw - 32px), (max-width: 767px) calc(100vw - 40px), (max-width: 1023px) calc(100vw - 60px), (max-width: 1079px) calc(100vw - 320px), 760px',
		'attachment'  => '(max-width: 639px) calc(100vw - 32px), (max-width: 767px) calc(100vw - 40px), 680px',
	);

	return isset( $sizes[ $context ] ) ? $sizes[ $context ] : $sizes['entry'];
}

/**
 * Select a stable visual treatment for generated media placeholders.
 *
 * These are deliberately theme-owned SVGs rather than fake featured images.
 * They keep the approved media proportions visible while a publication is
 * still being assembled, and disappear automatically when a real thumbnail
 * is assigned.
 *
 * @return string
 */
function three_columns_placeholder_variant() {
	$category = three_columns_primary_category();
	return $category ? sanitize_html_class( $category->slug ) : 'default';
}

/**
 * Render an inline SVG placeholder in the visual language of the reference.
 *
 * @param string $orientation Landscape or portrait.
 * @return string
 */
function three_columns_placeholder_svg( $orientation = 'landscape' ) {
	$orientation = 'portrait' === $orientation ? 'portrait' : 'landscape';
	$variant     = three_columns_placeholder_variant();
	$palettes    = array(
		'default'       => array( '#eef3f7', '#cbd0d1', '#496558' ),
		'essays'        => array( '#eaf2f8', '#b8cddd', '#607f91' ),
		'reviews'       => array( '#f3f5f4', '#dfe6e2', '#8aa091' ),
		'series'        => array( '#edf0ee', '#b5aa98', '#30363a' ),
		'notes'         => array( '#f5f1e8', '#e4bc62', '#79633b' ),
		'publications'  => array( '#f0efeb', '#d0cec7', '#6e7476' ),
		'releases'      => array( '#eaf1ff', '#b9cdf5', '#1467ff' ),
		'uncategorized' => array( '#eef3f7', '#cbd0d1', '#496558' ),
	);
	$palette     = isset( $palettes[ $variant ] ) ? $palettes[ $variant ] : $palettes['default'];
	$class       = 'entry-thumbnail-placeholder entry-thumbnail-placeholder--' . $orientation . ' entry-thumbnail-placeholder--' . $variant;

	if ( 'portrait' === $orientation ) {
		return sprintf(
			'<svg class="%1$s" viewBox="0 0 500 800" role="presentation" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg"><rect width="500" height="800" fill="%2$s"/><rect x="42" y="42" width="416" height="716" fill="#fafaf7" stroke="%3$s"/><path d="M250 665V185M250 310l-82-106M250 370l105-126M250 468l-122-96M250 526l122-76" fill="none" stroke="%4$s" stroke-width="8"/><circle cx="250" cy="185" r="18" fill="%4$s" opacity=".82"/><path d="M128 640h244" stroke="%3$s" stroke-width="3"/></svg>',
			esc_attr( $class ),
			esc_attr( $palette[0] ),
			esc_attr( $palette[1] ),
			esc_attr( $palette[2] )
		);
	}

	return sprintf(
		'<svg class="%1$s" viewBox="0 0 600 400" role="presentation" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg"><rect width="600" height="400" fill="%2$s"/><rect x="330" width="270" height="400" fill="%3$s" opacity=".62"/><path d="M0 300l132-94 106 51 128-132 118 104 116-68v239H0Z" fill="%3$s"/><path d="M0 340c112-23 216 16 328-4 96-17 177-3 272 10" fill="none" stroke="#fff" stroke-opacity=".72" stroke-width="4"/><circle cx="452" cy="116" r="10" fill="%4$s"/><circle cx="516" cy="184" r="12" fill="%4$s" opacity=".76"/></svg>',
		esc_attr( $class ),
		esc_attr( $palette[0] ),
		esc_attr( $palette[1] ),
		esc_attr( $palette[2] )
	);
}

function three_columns_thumbnail( $size = 'large', $class = 'media media--landscape' ) {
	if ( has_post_thumbnail() ) {
		printf(
			'<div class="%1$s">%2$s</div>',
			esc_attr( $class ),
			get_the_post_thumbnail( get_the_ID(), $size, array( 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'entry' ) ) )
		);
	} else {
		$orientation = false !== strpos( $class, 'portrait' ) ? 'portrait' : 'landscape';
		printf( '<div class="%s" aria-hidden="true">%s</div>', esc_attr( $class ), three_columns_placeholder_svg( $orientation ) );
	}
}
