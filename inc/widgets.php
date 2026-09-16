<?php
/**
 * Widget areas.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function three_columns_widgets_init() {
	$areas = array(
		array( 'id' => 'left-sidebar', 'name' => __( 'Left Sidebar', 'three-columns' ), 'description' => __( 'Appears below the primary navigation and search in the left rail.', 'three-columns' ) ),
		array( 'id' => 'right-sidebar', 'name' => __( 'Right Sidebar', 'three-columns' ), 'description' => __( 'Context widgets in the right rail. Single-post article context appears before these widgets.', 'three-columns' ) ),
		array( 'id' => 'footer-1', 'name' => __( 'Footer 1', 'three-columns' ), 'description' => __( 'Left footer rail.', 'three-columns' ) ),
		array( 'id' => 'footer-2', 'name' => __( 'Footer 2', 'three-columns' ), 'description' => __( 'First half of the central footer column.', 'three-columns' ) ),
		array( 'id' => 'footer-3', 'name' => __( 'Footer 3', 'three-columns' ), 'description' => __( 'Second half of the central footer column.', 'three-columns' ) ),
		array( 'id' => 'footer-4', 'name' => __( 'Footer 4', 'three-columns' ), 'description' => __( 'Right footer rail.', 'three-columns' ) ),
	);

	foreach ( $areas as $area ) {
		register_sidebar(
			array(
				'name'          => $area['name'],
				'id'            => $area['id'],
				'description'   => $area['description'],
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="context-title widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'three_columns_widgets_init' );
