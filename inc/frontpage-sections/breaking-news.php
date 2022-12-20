<?php
/**
 * Template part for displaying front page introduction.
 *
 * @package Collective News
 */

// Breaking News Section.
$breaking_news_section = get_theme_mod( 'collective_news_breaking_news_section_enable', false );

if ( false === $breaking_news_section ) {
	return;
}

$content_ids = array();

$breaking_news_content_type = get_theme_mod( 'collective_news_breaking_news_content_type', 'post' );

for ( $i = 1; $i <= 5; $i++ ) {
	$content_ids[] = get_theme_mod( 'collective_news_breaking_news_' . $breaking_news_content_type . '_' . $i );
}

$args = array(
	'post_type'           => $breaking_news_content_type,
	'post__in'            => array_filter( $content_ids ),
	'orderby'             => 'post__in',
	'posts_per_page'      => absint( 5 ),
	'ignore_sticky_posts' => true,
);

$query = new WP_Query( $args );
if ( $query->have_posts() ) {
	$section_title = get_theme_mod( 'collective_news_breaking_news_title', __( 'Breaking News', 'collective-news' ) );
	?>

	<section id="collective_news_breaking_news_section" class="frontpage news-ticker-section">
		<div class="theme-wrapper">
			<div class="news-ticker-section-wrapper">
				<?php if ( ! empty( $section_title ) ) : ?>
					<div class="acme-news-ticker-label breaking-news-btn">
						<?php echo esc_html( $section_title ); ?>
					</div>
				<?php endif; ?>
				<div class="marquee-part">	
					<ul id="newstick" class="newsticker">
						<?php
						while ( $query->have_posts() ) :
							$query->the_post();
							?>
							<li>
								<div class="newsticker-outer">
									<span class="newsticker-image">
										<?php the_post_thumbnail(); ?>
									</span>
									<span class="newsticker-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</span>
								</div>
							</li>
							<?php
						endwhile;
						wp_reset_postdata();
						?>
					</ul>
				</div>
			</div>   
		</div>
	</section>

	<?php
}
