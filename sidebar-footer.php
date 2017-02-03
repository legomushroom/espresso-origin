<?php $columns = vw_get_theme_option( 'site_footer_layout' ); ?>
<?php if ( $columns != 'none' ) : ?>
	<?php $columns_class = str_replace( ',', '-', $columns ); ?>
<!-- Site Footer Sidebar -->
<div class="vw-site-footer-sidebars <?php echo esc_attr( 'vw-site-footer-sidebar-layout-'.$columns_class ); ?>">
	<div class="container">
		<div class="row">
			<?php

			$columns = explode( ',', $columns );
			foreach ( $columns as $i => $column_size ) {
				$column_number = $i+1;
				
				printf( '<aside class="vw-footer-sidebar vw-footer-sidebar-%s col-sm-%s">', esc_attr( $column_number ), esc_attr( $column_size ) );
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