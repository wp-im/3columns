<?php
/**
 * Page content body.
 *
 * @package Three_Columns
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'document-page' ); ?>>
	<header class="page-header">
		<h1 class="page-title"><?php the_title(); ?></h1>
	</header>
	<div class="article-body">
		<?php
		the_content();
		wp_link_pages(
			array(
				'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'three-columns' ) . '">',
				'after'  => '</nav>',
			)
		);
		?>
	</div>
</article>
