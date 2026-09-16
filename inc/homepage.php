<?php
/**
 * Homepage and related-content query helpers.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function three_columns_source_category( $slot ) {
	$allowed = array( 'hero', 'essays', 'reviews', 'series', 'notes', 'publications' );
	if ( ! in_array( $slot, $allowed, true ) ) {
		return 0;
	}
	$category = absint( get_theme_mod( 'three_columns_source_' . $slot, 0 ) );
	if ( ! $category || ! term_exists( $category, 'category' ) ) {
		return 0;
	}

	return $category;
}

function three_columns_source_url( $slot ) {
	$category = three_columns_source_category( $slot );
	if ( $category ) {
		$url = get_category_link( $category );
		if ( ! is_wp_error( $url ) ) {
			return $url;
		}
	}

	$posts_page = absint( get_option( 'page_for_posts' ) );
	if ( $posts_page ) {
		return get_permalink( $posts_page );
	}

	return home_url( '/' );
}

function three_columns_home_query( $slot, $count, $exclude = array() ) {
	$count = max( 1, min( 12, absint( $count ) ) );
	$args  = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $count,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
		'post__not_in'        => array_values( array_filter( array_map( 'absint', (array) $exclude ) ) ),
	);
	$category = three_columns_source_category( $slot );
	if ( $category ) {
		$args['cat'] = $category;
	}
	return new WP_Query( $args );
}

function three_columns_featured_query( $exclude = array() ) {
	$sticky = array_values( array_diff( array_map( 'absint', get_option( 'sticky_posts', array() ) ), array_map( 'absint', (array) $exclude ) ) );
	$args   = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 1,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
		'post__not_in'        => array_map( 'absint', (array) $exclude ),
	);
	if ( $sticky ) {
		$args['post__in'] = $sticky;
		$args['orderby']  = 'post__in';
	}
	return new WP_Query( $args );
}

function three_columns_related_query( $post_id, $count = 3 ) {
	$post_id    = absint( $post_id );
	$count      = max( 1, min( 3, absint( $count ) ) );
	$categories = wp_get_post_categories( $post_id );
	$args       = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $count,
		'no_found_rows'       => true,
		'ignore_sticky_posts' => true,
		'post__not_in'        => array( $post_id ),
	);
	if ( $categories ) {
		$args['category__in'] = array_map( 'absint', $categories );
	}
	return new WP_Query( $args );
}
