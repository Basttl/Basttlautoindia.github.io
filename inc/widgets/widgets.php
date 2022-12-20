<?php

// Grid Posts Widget.
require get_template_directory() . '/inc/widgets/grid-posts-widget.php';

// List Posts Widget.
require get_template_directory() . '/inc/widgets/list-posts-widget.php';

// Express List Widget.
require get_template_directory() . '/inc/widgets/express-list-widget.php';

// Slider Widget.
require get_template_directory() . '/inc/widgets/slider-widget.php';

// Posts Tabs Widget.
require get_template_directory() . '/inc/widgets/posts-tabs-widget.php';

// Most Read Widget.
require get_template_directory() . '/inc/widgets/most-read-widget.php';

// Latest Posts Widget.
require get_template_directory() . '/inc/widgets/latest-posts-widget.php';

// Social Widget.
require get_template_directory() . '/inc/widgets/social-widget.php';

/**
 * Register Widgets
 */
function collective_news_register_widgets() {

	register_widget( 'Collective_News_Grid_Posts_Widget' );

	register_widget( 'Collective_News_List_Posts_Widget' );

	register_widget( 'Collective_News_Express_List_Widget' );

	register_widget( 'Collective_News_Slider_Widget' );

	register_widget( 'Collective_News_Posts_Tabs_Widget' );

	register_widget( 'Collective_News_Most_Read_Widget' );

	register_widget( 'Collective_News_Latest_Posts_Widget' );

	register_widget( 'Collective_News_Social_Widget' );

}
add_action( 'widgets_init', 'collective_news_register_widgets' );
