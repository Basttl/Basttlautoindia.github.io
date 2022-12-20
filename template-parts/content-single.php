<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Collective News
 */

$single_post_title = get_theme_mod( 'collective_news_enable_single_post_title', true );
$single_date       = get_theme_mod( 'collective_news_enable_single_date', true );
$single_author     = get_theme_mod( 'collective_news_enable_single_author', true );
$single_category   = get_theme_mod( 'collective_news_enable_single_category', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_singular() ) : ?>
		<?php if ( $single_post_title === true ) { ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
		<?php } ?>
		<?php
		if ( 'post' === get_post_type() ) :
			setup_postdata( get_post() );
			?>
			<div class="entry-meta">
				<?php
				if ( $single_date === true ) {
					collective_news_posted_on();
				}
				if ( $single_author === true ) {
					collective_news_posted_by();
				}
				?>
			</div><!-- .entry-meta -->
			<?php
		endif;
		?>
	<?php endif; ?>

	<?php collective_news_post_thumbnail(); ?>

		<div class="entry-content">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'collective-news' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'collective-news' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php
		if ( $single_category === true ) {
			collective_news_categories_list();
		}
		collective_news_entry_footer();
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
