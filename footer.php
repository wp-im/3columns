<?php
/**
 * Site footer: four WordPress widget areas mapped onto the reference three-column axis.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$three_columns_colophon = get_theme_mod(
	'three_columns_colophon',
	sprintf( __( '© %1$s %2$s. All rights reserved.', 'three-columns' ), wp_date( 'Y' ), get_bloginfo( 'name' ) )
);
?>
<footer class="site-footer" id="footer">
	<div class="shell footer-grid shell-grid">
		<div class="footer-left">
			<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="brand__name"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span></a>
			<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
				<div class="footer-widget"><?php dynamic_sidebar( 'footer-1' ); ?></div>
			<?php endif; ?>
		</div>
		<div class="footer-main">
			<div class="footer-widget">
				<?php if ( is_active_sidebar( 'footer-2' ) ) { dynamic_sidebar( 'footer-2' ); } ?>
			</div>
			<div class="footer-widget">
				<?php if ( is_active_sidebar( 'footer-3' ) ) { dynamic_sidebar( 'footer-3' ); } ?>
			</div>
		</div>
		<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
			<div class="footer-right footer-widget">
				<?php dynamic_sidebar( 'footer-4' ); ?>
			</div>
		<?php endif; ?>
	</div>
</footer>
<div class="copyright-strip" aria-label="<?php esc_attr_e( 'Copyright', 'three-columns' ); ?>">
	<div class="shell copyright-inner"><?php echo esc_html( $three_columns_colophon ); ?></div>
</div>
<?php wp_footer(); ?>
</body>
</html>
