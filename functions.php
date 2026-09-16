<?php
/**
 * Three Columns theme bootstrap.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$three_columns_includes = array(
	'inc/setup.php',
	'inc/enqueue.php',
	'inc/widgets.php',
	'inc/customizer.php',
	'inc/template-tags.php',
	'inc/template-functions.php',
	'inc/homepage.php',
);

foreach ( $three_columns_includes as $three_columns_file ) {
	require_once get_template_directory() . '/' . $three_columns_file;
}
