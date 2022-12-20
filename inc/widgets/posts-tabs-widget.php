<?php
if ( ! class_exists( 'Collective_News_Posts_Tabs_Widget' ) ) {

	/**
	 * Adds Collective_News_Posts_Tabs_Widget.
	 */
	class Collective_News_Posts_Tabs_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$collective_news_posts_tabs_widget_ops = array(
				'classname'   => 'widget adore-widget posts-tabs-widget',
				'description' => __( 'Retrive Posts Tabs Widgets', 'collective-news' ),
			);
			parent::__construct(
				'collective_news_posts_tabs_widget',
				__( 'Collective News: Posts Tabs Widget', 'collective-news' ),
				$collective_news_posts_tabs_widget_ops
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}
			$tab_button_label = ( ! empty( $instance['button_label'] ) ) ? $instance['button_label'] : __( 'Read More', 'collective-news' );
			$tab_post_offset  = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : '';

			echo $args['before_widget'];
			?>
			<div class="post-tabs-wrapper">
				<div class="post-tabs-head">
					<ul class="post-tabs">
						<li><a href="#tab-1" class="latest"><i class="far fa-clock"></i><?php echo esc_html( 'Latest Posts', 'collective-news' ); ?></a></li>
						<li><a href="#tab-2" class="latest inactive"><i class="fas fa-fire"></i><?php echo esc_html( 'Trending Posts', 'collective-news' ); ?></a></li>
					</ul>
				</div>
				<div class="post-tab-content-wrapper">
					<div class="post-tab-container" id="tab-1">
						<?php
						$posts_tabs_widgets_args = array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'posts_per_page' => absint( 5 ),
							'offset'         => absint( $tab_post_offset ),
							'orderby'        => 'date',
						);
						$query                   = new WP_Query( $posts_tabs_widgets_args );
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								?>
								<div class="post-item post-list">
									<div class="post-item-image">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>							
										</a>
									</div>
									<div class="post-item-content">
										<div class="entry-cat">
											<?php the_category( '', '', get_the_ID() ); ?>									
										</div>
										<h3 class="entry-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>  
										<ul class="entry-meta">
											<li class="post-author"> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><span class="far fa-user"></span><?php echo esc_html( get_the_author() ); ?></a></li>
											<li class="post-date"> <span class="far fa-calendar-alt"></span><?php echo esc_html( get_the_date() ); ?></li>
											<li class="post-comment"> <span class="far fa-comment"></span><?php echo absint( get_comments_number( get_the_ID() ) ); ?></li>
										</ul>
										<div class="post-exerpt">
											<p><?php echo wp_kses_post( wp_trim_words( get_the_content(), 30 ) ); ?></p>
										</div>
										<?php if ( ! empty( $tab_button_label ) ) : ?>
											<div class="post-btn">
												<a href="<?php the_permalink(); ?>" class="btn-read-more"><?php echo esc_html( $tab_button_label ); ?><i></i></a>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
							endif;
						?>
					</div>

					<div class="post-tab-container" id="tab-2">
						<?php
						$posts_tabs_widgets_args = array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'posts_per_page' => absint( 5 ),
							'offset'         => absint( $tab_post_offset ),
							'orderby'        => 'comment_count',
						);
						$query                   = new WP_Query( $posts_tabs_widgets_args );
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) :
								$query->the_post();
								?>
								<div class="post-item post-list">
									<div class="post-item-image">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
									</div>
									<div class="post-item-content">
										<div class="entry-cat">
											<?php the_category( '', '', get_the_ID() ); ?>							
										</div>
										<h3 class="entry-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>  
										<ul class="entry-meta">
											<li class="post-author"> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><span class="far fa-user"></span><?php echo esc_html( get_the_author() ); ?></a></li>
											<li class="post-date"> <span class="far fa-calendar-alt"></span><?php echo esc_html( get_the_date() ); ?></li>
											<li class="post-comment"> <span class="far fa-comment"></span><?php echo absint( get_comments_number( get_the_ID() ) ); ?></li>
										</ul>
										<div class="post-exerpt">
											<p><?php echo wp_kses_post( wp_trim_words( get_the_content(), 30 ) ); ?></p>
										</div>
										<?php if ( ! empty( $tab_button_label ) ) : ?>
											<div class="post-btn">
												<a href="<?php the_permalink(); ?>" class="btn-read-more"><?php echo esc_html( $tab_button_label ); ?><i></i></a>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<?php
							endwhile;
							wp_reset_postdata();
							endif;
						?>
					</div>
				</div>
			</div>
			<?php
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$tab_button_label = isset( $instance['button_label'] ) ? $instance['button_label'] : __( 'Read More', 'collective-news' );
			$tab_post_offset  = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : '';
			?>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'button_label' ) ); ?>"><?php esc_html_e( 'Read More Button Label:', 'collective-news' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_label' ) ); ?>" type="text" value="<?php echo esc_attr( $tab_button_label ); ?>" />
	</p>
	<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>"><?php esc_html_e( 'Number of posts to displace or pass over:', 'collective-news' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'offset' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'offset' ) ); ?>" type="number" step="1" min="0" value="<?php echo absint( $tab_post_offset ); ?>" size="3" />
	</p>

			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                 = $old_instance;
			$instance['button_label'] = sanitize_text_field( $new_instance['button_label'] );
			$instance['offset']       = (int) $new_instance['offset'];
			return $instance;
		}

	}
}
