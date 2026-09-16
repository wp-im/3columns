<?php
/**
 * Attachment document.
 *
 * @package Three_Columns
 */

get_header();
?>
<div class="shell site-grid shell-grid">
	<?php get_sidebar( 'left' ); ?>

	<main class="main-column" id="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'attachment-document' ); ?>>
				<div class="reading-frame article-frame">
					<header class="article-header">
						<div class="article-kicker"><?php esc_html_e( 'ATTACHMENT', 'three-columns' ); ?></div>
						<h1 class="article-title"><?php the_title(); ?></h1>
						<div class="article-meta">
							<span><time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></span>
							<?php if ( wp_get_post_parent_id( get_the_ID() ) ) : ?>
								<span><a href="<?php echo esc_url( get_permalink( wp_get_post_parent_id( get_the_ID() ) ) ); ?>"><?php esc_html_e( 'View parent', 'three-columns' ); ?></a></span>
							<?php endif; ?>
						</div>
					</header>
				</div>

				<div class="reading-frame article-frame attachment-frame">
					<?php
					$three_columns_attachment_url = wp_get_attachment_url( get_the_ID() );
					$three_columns_image          = wp_attachment_is_image( get_the_ID() );
					$three_columns_caption        = wp_get_attachment_caption( get_the_ID() );
					?>

					<?php if ( $three_columns_image ) : ?>
						<figure class="attachment-media">
							<a href="<?php echo esc_url( $three_columns_attachment_url ); ?>">
								<?php echo wp_get_attachment_image( get_the_ID(), 'full', false, array( 'decoding' => 'async', 'sizes' => three_columns_image_sizes( 'attachment' ) ) ); ?>
							</a>
							<?php if ( $three_columns_caption ) : ?>
								<figcaption><?php echo wp_kses_post( $three_columns_caption ); ?></figcaption>
							<?php endif; ?>
						</figure>
					<?php elseif ( $three_columns_attachment_url ) : ?>
						<p class="attachment-download"><a href="<?php echo esc_url( $three_columns_attachment_url ); ?>"><?php esc_html_e( 'Open attached file →', 'three-columns' ); ?></a></p>
					<?php endif; ?>

					<div class="article-body">
						<?php
						the_content();
						wp_link_pages(
							array(
								'before' => '<nav class="page-links" aria-label="' . esc_attr__( 'Attachment pages', 'three-columns' ) . '">',
								'after'  => '</nav>',
							)
						);
						?>
					</div>

					<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
				</div>
			</article>
		<?php endwhile; ?>
	</main>

	<?php get_sidebar( 'right' ); ?>
</div>
<?php get_footer(); ?>
