<?php
/**
 * Search form.
 *
 * @package Three_Columns
 */
?>
<form class="rail-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-box">
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'three-columns' ); ?></span>
		<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'three-columns' ); ?>">
		<button type="submit" aria-label="<?php echo esc_attr_x( 'Search', 'submit button', 'three-columns' ); ?>">⌕</button>
	</label>
</form>
