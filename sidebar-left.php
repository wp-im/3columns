<?php
/**
 * Left navigation rail.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<aside class="left-rail off-canvas-left" id="leftRail" aria-label="<?php esc_attr_e( 'Primary navigation', 'three-columns' ); ?>">
	<div class="rail-sticky">
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav class="primary-nav" aria-label="<?php esc_attr_e( 'Primary', 'three-columns' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'primary-menu',
						'fallback_cb'    => false,
						'depth'          => 0,
					)
				);
				?>
			</nav>
		<?php endif; ?>
		<?php get_search_form(); ?>
		<?php if ( is_active_sidebar( 'left-sidebar' ) ) : ?>
			<div class="left-widgets">
				<?php dynamic_sidebar( 'left-sidebar' ); ?>
			</div>
		<?php endif; ?>
	</div>
</aside>
