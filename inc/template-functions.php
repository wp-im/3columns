<?php
/**
 * Small template filters.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function three_columns_body_classes( $classes ) {
	$classes[] = 'three-columns-site';
	if ( is_singular( 'post' ) ) {
		$classes[] = 'three-columns-single';
	}
	if ( has_nav_menu( 'primary' ) ) {
		$classes[] = 'has-header-navigation';
	}
	return $classes;
}
add_filter( 'body_class', 'three_columns_body_classes' );

/**
 * Whether the current request has meaningful right-rail content.
 *
 * @return bool
 */
function three_columns_has_context_rail() {
	return is_singular( 'post' ) || is_active_sidebar( 'right-sidebar' );
}

function three_columns_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'three_columns_pingback_header' );
