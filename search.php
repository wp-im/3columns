<?php
/**
 * Search results.
 *
 * @package Three_Columns
 */
get_header();
?>
<div class="shell site-grid shell-grid">
	<?php get_sidebar( 'left' ); ?>
	<main class="main-column" id="main">
		<div class="reading-frame">
			<header class="search-header">
				<h1 class="search-title"><?php printf( esc_html__( 'Search: %s', 'three-columns' ), esc_html( get_search_query() ) ); ?></h1>
			</header>
			<?php if ( have_posts() ) : ?>
				<div class="entry-list entry-list--archive">
					<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/content' ); endwhile; ?>
				</div>
				<?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '←', 'next_text' => '→' ) ); ?>
			<?php else : get_template_part( 'template-parts/content', 'none' ); endif; ?>
		</div>
	</main>
	<?php get_sidebar( 'right' ); ?>
</div>
<?php get_footer(); ?>
