<?php
/**
 * Not found.
 *
 * @package Three_Columns
 */
get_header();
?>
<div class="shell site-grid shell-grid">
	<?php get_sidebar( 'left' ); ?>
	<main class="main-column" id="main">
		<div class="reading-frame">
			<section class="no-results error-404 not-found">
				<div class="kicker">404</div>
				<h1 class="page-title"><?php esc_html_e( 'Page not found', 'three-columns' ); ?></h1>
				<p><?php esc_html_e( 'The address may have changed, or the page may no longer be published. Search the archive instead.', 'three-columns' ); ?></p>
				<?php get_search_form(); ?>
			</section>
		</div>
	</main>
	<?php get_sidebar( 'right' ); ?>
</div>
<?php get_footer(); ?>
