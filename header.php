<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Collective News
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site adore-boxed-wrapper">
		<a class="skip-link screen-reader-text" href="#primary-content"><?php esc_html_e( 'Skip to content', 'collective-news' ); ?></a>

		<div id="loader">
			<div class="loader-container">
				<div id="preloader">
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/loader.gif' ); ?>">
				</div>
			</div>
		</div><!-- #loader -->

		<header id="masthead" class="site-header">
			<?php if ( get_theme_mod( 'collective_news_enable_topbar', true ) === true ) : ?>
				<div class="top-header">
					<div class="theme-wrapper">
						<div class="top-header-wrap">
							<div class="left-side">
								<div class="top-info">
									<?php echo esc_html( date( 'l, F j, Y' ) ); ?>
								</div>
							</div>
							<div class="right-side">
								<div class="social-icons">
									<?php
									if ( has_nav_menu( 'social' ) ) {
										wp_nav_menu(
											array(
												'menu_class'  => 'menu social-links',
												'link_before' => '<span class="screen-reader-text">',
												'link_after'  => '</span>',
												'theme_location' => 'social',
											)
										);
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="middle-header <?php echo esc_attr( ! empty( get_header_image() ) ? 'adore-header-image' : '' ); ?>" style="background-image: url('<?php echo esc_url( get_header_image() ); ?>')">
				<div class="theme-wrapper">
					<?php
					$advertisement_image = get_theme_mod( 'collective_news_advertisement_image', '' );
					?>
					<div class="middle-header-wrap <?php echo esc_attr( $advertisement_image ? '' : 'no-advertisement_image' ); ?>">

						<div class="site-branding">
							<?php

							if ( has_custom_logo() ) {
								?>
								<div class="site-logo">
									<?php the_custom_logo(); ?>
								</div>
								<?php
							}

							if ( get_theme_mod( 'collective_news_header_text_display', true ) === true ) {
								?>

								<div class="site-identity">
									<?php
									if ( is_front_page() && is_home() ) :
										?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php
								else :
									?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
									<?php
								endif;

								$collective_news_description = get_bloginfo( 'description', 'display' );
								if ( $collective_news_description || is_customize_preview() ) :
									?>
									<p class="site-description"><?php echo $collective_news_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
									<?php
								endif;
								?>
							</div>

								<?php
							}
							?>
					</div><!-- .site-branding -->

					<?php
					$advertisement_image = get_theme_mod( 'collective_news_advertisement_image', '' );
					$advertisement_url   = get_theme_mod( 'collective_news_advertisement_url', '#' );
					if ( ! empty( $advertisement_image ) ) {
						?>
						<div class="adore-adver">

							<div class="adore-adver-outer">
								<a href="<?php echo esc_url( $advertisement_url ); ?>">
									<img src="<?php echo esc_url( $advertisement_image ); ?>" alt="<?php esc_attr_e( 'Advertisment Image', 'collective-news' ); ?>">
								</a>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="header-outer-wrapper">
			<div class="adore-header">
				<div class="theme-wrapper">
					<div class="header-wrapper">

						<div class="header-nav-search">
							<div class="header-navigation">
								<nav id="site-navigation" class="main-navigation">
									<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
										<span></span>
										<span></span>
										<span></span>
									</button>
									<?php

									if ( has_nav_menu( 'primary' ) ) {

										wp_nav_menu(
											array(
												'theme_location' => 'primary',
												'menu_id' => 'primary-menu',
											)
										);

									}

									?>
								</nav><!-- #site-navigation -->
							</div>
							<div class="header-end">
								<div class="navigation-search">
									<div class="navigation-search-wrap">
										<a href="#" title="Search" class="navigation-search-icon">
											<i class="fa fa-search"></i>
										</a>
										<div class="navigation-search-form">
											<?php get_search_form(); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="primary-content" class="primary-content">

		<?php
		if ( ! is_front_page() || is_home() ) {

			if ( is_front_page() ) {

				$sorted_sections = array( 'breaking-news', 'below-banner-widgets-area', 'recent-posts', 'main-widgets-area', 'above-footer-widgets-area' );

				foreach ( $sorted_sections as $sorted_section ) {
					require get_template_directory() . '/inc/frontpage-sections/' . $sorted_section . '.php';
				}
			}

			?>

			<div id="content" class="site-content theme-wrapper">
				<div class="theme-wrap">

				<?php } ?>
