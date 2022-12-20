<?php
/**
 * Collective News Theme Customizer
 *
 * @package Collective News
 */

// upgrade to pro.
require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-customize.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function collective_news_customize_register( $wp_customize ) {

	// Custom Controls.
	require get_template_directory() . '/inc/customizer/custom-controller.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'collective_news_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'collective_news_customize_partial_blogdescription',
			)
		);
	}

	// Header text display setting.
	$wp_customize->add_setting(
		'collective_news_header_text_display',
		array(
			'default'           => true,
			'sanitize_callback' => 'collective_news_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'collective_news_header_text_display',
		array(
			'section' => 'title_tagline',
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Display Site Title and Tagline', 'collective-news' ),
		)
	);

	// Color Customizer Setting.
	require get_template_directory() . '/inc/customizer/color.php';

	// frontpage customizer section.
	require get_template_directory() . '/inc/customizer/frontpage-customizer/customizer-sections.php';

	// theme options customizer section.
	require get_template_directory() . '/inc/customizer/theme-options/theme-options-sections.php';

}
add_action( 'customize_register', 'collective_news_customize_register' );

// Sanitize callback.
require get_template_directory() . '/inc/customizer/sanitize-callback.php';

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function collective_news_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function collective_news_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function collective_news_customize_preview_js() {
	wp_enqueue_script( 'collective-news-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), COLLECTIVE_NEWS_VERSION, true );
}
add_action( 'customize_preview_init', 'collective_news_customize_preview_js' );

/**
 * Binds JS handlers for Customizer controls.
 */
function collective_news_customize_control_js() {
	wp_enqueue_style( 'collective-news-customize-style', get_template_directory_uri() . '/assets/css/customize-controls.css', array(), '20151215' );
	wp_enqueue_script( 'collective-news-customize-control', get_template_directory_uri() . '/assets/js/customize-control.js', array( 'jquery', 'customize-controls' ), '20151215', true );
	$localized_data = array(
		'refresh_msg' => esc_html__( 'Refresh the page after Save and Publish.', 'collective-news' ),
		'reset_msg'   => esc_html__( 'Warning!!! This will reset all the settings. Refresh the page after Save and Publish to reset all.', 'collective-news' ),
	);
	wp_localize_script( 'collective-news-customize-control', 'localized_data', $localized_data );
}
add_action( 'customize_controls_enqueue_scripts', 'collective_news_customize_control_js' );
