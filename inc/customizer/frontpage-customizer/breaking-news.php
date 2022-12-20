<?php
/**
 * Adore Themes Customizer
 *
 * @package Collective News
 *
 * Breaking News Section
 */

$wp_customize->add_section(
	'collective_news_breaking_news_section',
	array(
		'title' => esc_html__( 'Breaking News Section', 'collective-news' ),
		'panel' => 'collective_news_frontpage_panel',
	)
);

// Breaking News section enable settings.
$wp_customize->add_setting(
	'collective_news_breaking_news_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_breaking_news_section_enable',
		array(
			'label'    => esc_html__( 'Enable Breaking News Section', 'collective-news' ),
			'type'     => 'checkbox',
			'settings' => 'collective_news_breaking_news_section_enable',
			'section'  => 'collective_news_breaking_news_section',
		)
	)
);

// Breaking News title settings.
$wp_customize->add_setting(
	'collective_news_breaking_news_title',
	array(
		'default'           => __( 'Breaking News', 'collective-news' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'collective_news_breaking_news_title',
	array(
		'label'           => esc_html__( 'Title', 'collective-news' ),
		'section'         => 'collective_news_breaking_news_section',
		'active_callback' => 'collective_news_if_breaking_news_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'collective_news_breaking_news_title',
		array(
			'selector'            => '.news-ticker-section .theme-wrapper',
			'settings'            => 'collective_news_breaking_news_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'collective_news_breaking_news_title_text_partial',
		)
	);
}

// breaking_news content type settings.
$wp_customize->add_setting(
	'collective_news_breaking_news_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'collective_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'collective_news_breaking_news_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'collective-news' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'collective-news' ),
		'section'         => 'collective_news_breaking_news_section',
		'type'            => 'select',
		'active_callback' => 'collective_news_if_breaking_news_enabled',
		'choices'         => array(
			'post' => esc_html__( 'Post', 'collective-news' ),
			'page' => esc_html__( 'Page', 'collective-news' ),
		),
	)
);

for ( $i = 1; $i <= 5; $i++ ) {
	// breaking_news post setting.
	$wp_customize->add_setting(
		'collective_news_breaking_news_post_' . $i,
		array(
			'sanitize_callback' => 'collective_news_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'collective_news_breaking_news_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'collective-news' ), $i ),
			'section'         => 'collective_news_breaking_news_section',
			'type'            => 'select',
			'choices'         => collective_news_get_post_choices(),
			'active_callback' => 'collective_news_breaking_news_section_content_type_post_enabled',
		)
	);

	// breaking_news page setting.
	$wp_customize->add_setting(
		'collective_news_breaking_news_page_' . $i,
		array(
			'default'           => 0,
			'sanitize_callback' => 'collective_news_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'collective_news_breaking_news_page_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Page %d', 'collective-news' ), $i ),
			'section'         => 'collective_news_breaking_news_section',
			'type'            => 'dropdown-pages',
			'choices'         => collective_news_get_page_choices(),
			'active_callback' => 'collective_news_breaking_news_section_content_type_page_enabled',
		)
	);
}

/*========================Active Callback==============================*/
function collective_news_if_breaking_news_enabled( $control ) {
	return $control->manager->get_setting( 'collective_news_breaking_news_section_enable' )->value();
}
function collective_news_breaking_news_section_content_type_page_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'collective_news_breaking_news_content_type' )->value();
	return collective_news_if_breaking_news_enabled( $control ) && ( 'page' === $content_type );
}
function collective_news_breaking_news_section_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'collective_news_breaking_news_content_type' )->value();
	return collective_news_if_breaking_news_enabled( $control ) && ( 'post' === $content_type );
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'collective_news_breaking_news_title_text_partial' ) ) :
	// Title.
	function collective_news_breaking_news_title_text_partial() {
		return esc_html( get_theme_mod( 'collective_news_breaking_news_title' ) );
	}
endif;
