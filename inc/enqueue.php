<?php
/**
 * Front-end assets.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function three_columns_assets() {
	$parent_theme   = wp_get_theme( get_template() );
	$parent_version = $parent_theme->get( 'Version' );
	$script         = get_template_directory() . '/assets/js/theme.js';

	wp_enqueue_style(
		'three-columns-style',
		get_template_directory_uri() . '/style.css',
		array(),
		$parent_version
	);

	if ( is_child_theme() ) {
		$child_theme = wp_get_theme();
		wp_enqueue_style(
			'three-columns-child-style',
			get_stylesheet_uri(),
			array( 'three-columns-style' ),
			$child_theme->get( 'Version' )
		);
	}

	wp_enqueue_script(
		'three-columns-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		file_exists( $script ) ? (string) filemtime( $script ) : $parent_version,
		true
	);
	wp_script_add_data( 'three-columns-theme', 'strategy', 'defer' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'three_columns_assets' );
