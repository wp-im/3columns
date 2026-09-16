<?php
/**
 * Empty-results state.
 *
 * @package Three_Columns
 */
?>
<section class="no-results not-found">
	<h1 class="page-title"><?php esc_html_e( 'Nothing found', 'three-columns' ); ?></h1>
	<p><?php esc_html_e( 'There is no published content matching this view yet.', 'three-columns' ); ?></p>
	<?php get_search_form(); ?>
</section>
