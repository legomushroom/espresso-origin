<!-- Site Footer -->
<footer class="vw-site-footer" <?php vw_itemtype('WPFooter'); ?>>

	<?php do_action( 'vw_action_before_site_footer' ); ?>

	<?php get_sidebar( 'footer' ); ?>

	<?php do_action( 'vw_action_after_site_footer' ); ?>

	<?php vw_the_site_bottom_bar(); ?>

</footer>
<!-- End Site Footer -->