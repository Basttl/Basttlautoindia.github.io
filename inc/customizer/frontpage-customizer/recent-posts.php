<?php
/**
 * Adore Themes Customizer
 *
 * @package Collective News
 *
 * Recent Posts Section
 */

$wp_customize->add_section(
	'collective_news_recent_posts_section',
	array(
		'title' => esc_html__( 'Recent Posts Section', 'collective-news' ),
		'panel' => 'collective_news_frontpage_panel',
	)
);

// Recent Posts section enable settings.
$wp_customize->add_setting(
	'collective_news_recent_posts_section_enable',
	array(
		'default'           => false,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_recent_posts_section_enable',
		array(
			'label'    => esc_html__( 'Enable Recent Posts Section', 'collective-news' ),
			'type'     => 'checkbox',
			'settings' => 'collective_news_recent_posts_section_enable',
			'section'  => 'collective_news_recent_posts_section',
		)
	)
);

// Recent Posts title settings.
$wp_customize->add_setting(
	'collective_news_recent_posts_title',
	array(
		'default'           => __( 'Recent Articles', 'collective-news' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'collective_news_recent_posts_title',
	array(
		'label'           => esc_html__( 'Title', 'collective-news' ),
		'section'         => 'collective_news_recent_posts_section',
		'active_callback' => 'collective_news_if_recent_posts_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'collective_news_recent_posts_title',
		array(
			'selector'            => '.recentpost h3.widget-title',
			'settings'            => 'collective_news_recent_posts_title',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'collective_news_recent_posts_title_text_partial',
		)
	);
}

// View All button label setting.
$wp_customize->add_setting(
	'collective_news_recent_posts_view_all_button_label',
	array(
		'default'           => __( 'View All', 'collective-news' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'collective_news_recent_posts_view_all_button_label',
	array(
		'label'           => esc_html__( 'View All Button Label', 'collective-news' ),
		'section'         => 'collective_news_recent_posts_section',
		'settings'        => 'collective_news_recent_posts_view_all_button_label',
		'type'            => 'text',
		'active_callback' => 'collective_news_if_recent_posts_enabled',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
	$wp_customize->selective_refresh->add_partial(
		'collective_news_recent_posts_view_all_button_label',
		array(
			'selector'            => '.recentpost .adore-view-all',
			'settings'            => 'collective_news_recent_posts_view_all_button_label',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'collective_news_recent_posts_view_all_btn_partial',
		)
	);
}

// View All button URL setting.
$wp_customize->add_setting(
	'collective_news_recent_posts_view_all_button_url',
	array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'collective_news_recent_posts_view_all_button_url',
	array(
		'label'           => esc_html__( 'View All Button Link', 'collective-news' ),
		'section'         => 'collective_news_recent_posts_section',
		'settings'        => 'collective_news_recent_posts_view_all_button_url',
		'type'            => 'url',
		'active_callback' => 'collective_news_if_recent_posts_enabled',
	)
);

// recent_posts content type settings.
$wp_customize->add_setting(
	'collective_news_recent_posts_content_type',
	array(
		'default'           => 'post',
		'sanitize_callback' => 'collective_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'collective_news_recent_posts_content_type',
	array(
		'label'           => esc_html__( 'Content type:', 'collective-news' ),
		'description'     => esc_html__( 'Choose where you want to render the content from.', 'collective-news' ),
		'section'         => 'collective_news_recent_posts_section',
		'type'            => 'select',
		'active_callback' => 'collective_news_if_recent_posts_enabled',
		'choices'         => array(
			'post'     => esc_html__( 'Post', 'collective-news' ),
			'category' => esc_html__( 'Category', 'collective-news' ),
		),
	)
);

for ( $i = 1; $i <= 3; $i++ ) {
	// recent_posts post setting.
	$wp_customize->add_setting(
		'collective_news_recent_posts_post_' . $i,
		array(
			'sanitize_callback' => 'collective_news_sanitize_dropdown_pages',
		)
	);

	$wp_customize->add_control(
		'collective_news_recent_posts_post_' . $i,
		array(
			'label'           => sprintf( esc_html__( 'Post %d', 'collective-news' ), $i ),
			'section'         => 'collective_news_recent_posts_section',
			'type'            => 'select',
			'choices'         => collective_news_get_post_choices(),
			'active_callback' => 'collective_news_recent_posts_section_content_type_post_enabled',
		)
	);

}

// recent_posts category setting.
$wp_customize->add_setting(
	'collective_news_recent_posts_category',
	array(
		'sanitize_callback' => 'collective_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'collective_news_recent_posts_category',
	array(
		'label'           => esc_html__( 'Category', 'collective-news' ),
		'section'         => 'collective_news_recent_posts_section',
		'type'            => 'select',
		'choices'         => collective_news_get_post_cat_choices(),
		'active_callback' => 'collective_news_recent_posts_section_content_type_category_enabled',
	)
);

/*========================Active Callback==============================*/
function collective_news_if_recent_posts_enabled( $control ) {
	return $control->manager->get_setting( 'collective_news_recent_posts_section_enable' )->value();
}
function collective_news_recent_posts_section_content_type_post_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'collective_news_recent_posts_content_type' )->value();
	return collective_news_if_recent_posts_enabled( $control ) && ( 'post' === $content_type );
}
function collective_news_recent_posts_section_content_type_category_enabled( $control ) {
	$content_type = $control->manager->get_setting( 'collective_news_recent_posts_content_type' )->value();
	return collective_news_if_recent_posts_enabled( $control ) && ( 'category' === $content_type );
}

/*========================Partial Refresh==============================*/
if ( ! function_exists( 'collective_news_recent_posts_title_text_partial' ) ) :
	// Title.
	function collective_news_recent_posts_title_text_partial() {
		return esc_html( get_theme_mod( 'collective_news_recent_posts_title' ) );
	}
endif;
if ( ! function_exists( 'collective_news_recent_posts_view_all_btn_partial' ) ) :
	// View All Btn.
	function collective_news_recent_posts_view_all_btn_partial() {
		return esc_html( get_theme_mod( 'collective_news_recent_posts_view_all_button_label' ) );
	}
endif;
