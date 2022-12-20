<?php
$full_width = ! is_active_sidebar( 'secondary-widgets-area' ) ? 'full-width' : '';
$classes    = implode( ' ', array( $full_width, 'secondary-right-position' ) );
if ( is_active_sidebar( 'primary-widgets-area' ) || is_active_sidebar( 'secondary-widgets-area' ) ) :
	?>
<div class="main-widget-section">
	<div class="theme-wrapper">
		<div class="main-widget-section-wrap <?php echo esc_attr( $classes ); ?>">
			<div class="primary-widgets-area">
				<?php dynamic_sidebar( 'primary-widgets-area' ); ?>
			</div>
			<div class="secondary-widgets-area">
				<?php dynamic_sidebar( 'secondary-widgets-area' ); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
