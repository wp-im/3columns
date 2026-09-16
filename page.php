<?php
/**
 * Pages.
 *
 * @package Three_Columns
 */
get_header();
?>
<div class="shell site-grid shell-grid">
	<?php get_sidebar( 'left' ); ?>
	<main class="main-column" id="main">
		<div class="reading-frame">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
			<?php endwhile; ?>
		</div>
	</main>
	<?php get_sidebar( 'right' ); ?>
</div>
<?php get_footer(); ?>
