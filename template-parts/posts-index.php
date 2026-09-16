<?php
/**
 * Posts index content shared by home.php and front-page.php when Reading Settings uses latest posts.
 *
 * @package Three_Columns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="shell site-grid shell-grid">
	<?php get_sidebar( 'left' ); ?>
	<main class="main-column" id="main">
		<div class="reading-frame">
			<header class="archive-header"><h1 class="archive-title"><?php echo esc_html( single_post_title( '', false ) ?: __( 'Latest Writing', 'three-columns' ) ); ?></h1></header>
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
