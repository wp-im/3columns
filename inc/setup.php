<?php
/**
 * Theme setup.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function three_columns_setup() {
	load_theme_textdomain( 'three-columns', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'editor-style.css' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 72,
			'width'       => 72,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'three-columns' ),
		)
	);
}
add_action( 'after_setup_theme', 'three_columns_setup' );

function three_columns_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'three_columns_content_width', 680 );
}
add_action( 'after_setup_theme', 'three_columns_content_width', 0 );
