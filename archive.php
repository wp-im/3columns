<?php
/**
 * Archives.
 *
 * @package Three_Columns
 */
get_header();
?>
<div class="shell site-grid shell-grid">
	<?php get_sidebar( 'left' ); ?>
	<main class="main-column" id="main">
		<div class="reading-frame">
			<header class="archive-header">
				<h1 class="archive-title"><?php the_archive_title(); ?></h1>
				<?php $three_columns_archive_description = get_the_archive_description(); ?>
				<?php if ( $three_columns_archive_description ) : ?><div class="archive-description"><?php echo wp_kses_post( $three_columns_archive_description ); ?></div><?php endif; ?>
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
