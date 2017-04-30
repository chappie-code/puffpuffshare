<?php $columns = vw_get_theme_option( 'site_footer_layout' ); ?>
<?php if ( $columns != 'none' ) : ?>
<!-- Site Footer Sidebar -->
<div class="vw-site-footer-sidebars">
	<div class="container">
		<div class="row">
			<?php
			$columns = explode( ',', $columns );
			foreach ( $columns as $i => $column_size ) {
				$column_number = $i+1;
				
				printf( '<aside class="vw-footer-sidebar vw-footer-sidebar-%s col-md-%s">', esc_attr( $column_number ), esc_attr( $column_size ) );
				if ( is_active_sidebar( 'footer-sidebar-' . $column_number ) ) {
					dynamic_sidebar( 'footer-sidebar-' . $column_number );
				} else {
					vw_show_no_widget_warning();
				}
				echo '</aside>';
			}
			?>
		</div>
	</div>
</div>
<!-- End Site Footer Sidebar -->
<?php endif; ?>