<?php
/**
 * Site header and mobile reveal controls.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$three_columns_site_name        = get_bloginfo( 'name' );
$three_columns_logo_id          = absint( get_theme_mod( 'custom_logo', 0 ) );
$three_columns_statement        = get_theme_mod( 'three_columns_header_statement', __( "Writing a more attentive life.\nReading · Thinking · Recording", 'three-columns' ) );
$three_columns_meta             = get_theme_mod( 'three_columns_header_meta', sprintf( __( "Tokyo / %s\nIndependent Notes", 'three-columns' ), wp_date( 'Y' ) ) );
$three_columns_has_context_rail = three_columns_has_context_rail();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to main content', 'three-columns' ); ?></a>

<header class="site-header">
	<div class="shell shell-grid header-grid">
		<a class="brand<?php echo $three_columns_logo_id ? ' brand--with-logo' : ''; ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( sprintf( __( '%s home', 'three-columns' ), $three_columns_site_name ) ); ?>">
			<?php
			if ( $three_columns_logo_id ) {
				echo wp_get_attachment_image( $three_columns_logo_id, 'thumbnail', false, array( 'class' => 'custom-logo', 'alt' => '' ) );
			}
			?>
			<span class="brand__name"><?php echo esc_html( $three_columns_site_name ); ?></span>
		</a>
		<div class="header-statement"><?php echo nl2br( esc_html( $three_columns_statement ) ); ?></div>
		<div class="header-meta"><?php echo nl2br( esc_html( $three_columns_meta ) ); ?></div>
	</div>
</header>

<div class="off-canvas-nav" aria-label="<?php esc_attr_e( 'Mobile panels', 'three-columns' ); ?>">
	<button class="menu-button" type="button" aria-expanded="false" aria-controls="leftRail"><?php esc_html_e( 'Menu', 'three-columns' ); ?></button>
	<?php if ( $three_columns_has_context_rail ) : ?>
		<button class="sidebar-button" type="button" aria-expanded="false" aria-controls="rightRail"><?php esc_html_e( 'Context', 'three-columns' ); ?></button>
	<?php endif; ?>
</div>
<button class="mask-left" type="button" aria-label="<?php esc_attr_e( 'Close navigation', 'three-columns' ); ?>"></button>
<?php if ( $three_columns_has_context_rail ) : ?>
	<button class="mask-right" type="button" aria-label="<?php esc_attr_e( 'Close context panel', 'three-columns' ); ?>"></button>
<?php endif; ?>
