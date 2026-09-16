<?php
/**
 * Customizer options.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function three_columns_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'three_columns_identity',
		array(
			'title'       => __( 'Three Columns Identity', 'three-columns' ),
			'description' => __( 'Small identity texts used by the fixed publication header and colophon.', 'three-columns' ),
			'priority'    => 35,
		)
	);

	$text_settings = array(
		'three_columns_header_statement' => array(
			'label'    => __( 'Header statement', 'three-columns' ),
			'default'  => __( "Writing a more attentive life.\nReading · Thinking · Recording", 'three-columns' ),
			'sanitize' => 'sanitize_textarea_field',
			'type'    => 'textarea',
		),
		'three_columns_header_meta' => array(
			'label'    => __( 'Header metadata', 'three-columns' ),
			'default'  => sprintf( __( "Tokyo / %s\nIndependent Notes", 'three-columns' ), wp_date( 'Y' ) ),
			'sanitize' => 'sanitize_textarea_field',
			'type'    => 'textarea',
		),
		'three_columns_colophon' => array(
			'label'    => __( 'Footer colophon', 'three-columns' ),
			'default'  => sprintf( __( '© %1$s %2$s. All rights reserved.', 'three-columns' ), wp_date( 'Y' ), get_bloginfo( 'name' ) ),
			'sanitize' => 'sanitize_text_field',
			'type'     => 'text',
		),
	);

	foreach ( $text_settings as $id => $setting ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => $setting['sanitize'],
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $setting['label'],
				'section' => 'three_columns_identity',
				'type'    => $setting['type'],
			)
		);
	}

	$wp_customize->add_section(
		'three_columns_home_sources',
		array(
			'title'       => __( 'Homepage Sources', 'three-columns' ),
			'description' => __( 'Choose optional categories for the fixed homepage sections. Empty selections fall back to recent posts.', 'three-columns' ),
			'priority'    => 40,
		)
	);

	$categories = get_categories( array( 'hide_empty' => false ) );
	$choices    = array( 0 => __( 'Automatic / Recent Posts', 'three-columns' ) );
	foreach ( $categories as $category ) {
		$choices[ (int) $category->term_id ] = $category->name;
	}

	$sources = array(
		'hero'         => __( 'Hero category', 'three-columns' ),
		'essays'       => __( 'Recent Essays category', 'three-columns' ),
		'reviews'      => __( 'Recent Reviews category', 'three-columns' ),
		'series'       => __( 'Series category', 'three-columns' ),
		'notes'        => __( 'Selected Notes category', 'three-columns' ),
		'publications' => __( 'Selected Publications category', 'three-columns' ),
	);

	foreach ( $sources as $key => $label ) {
		$id = 'three_columns_source_' . $key;
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $label,
				'section' => 'three_columns_home_sources',
				'type'    => 'select',
				'choices' => $choices,
			)
		);
	}
}
add_action( 'customize_register', 'three_columns_customize_register' );
