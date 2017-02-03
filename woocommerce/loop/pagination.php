<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<nav class="vw-woocommerce-pagination vw-page-navigation">
	<?php
		$links = paginate_links( apply_filters( 'woocommerce_pagination_args', array(
			'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
			'format'       => '',
			'current'      => max( 1, get_query_var( 'paged' ) ),
			'total'        => $wp_query->max_num_pages,
			'prev_text' => '<i class="vw-icon icon-entypo-left"></i>',
			'next_text' => '<i class="vw-icon icon-entypo-right"></i>',
			'end_size' => VW_CONST_PAGINATE_LINKS_END_SIZE,
			'mid_size' => VW_CONST_PAGINATE_LINKS_MID_SIZE,
			'end_size'     => 3,
			'mid_size'     => 3
		) ) );
	?>

	<div class="vw-page-navigation-pagination">
		<?php echo $links; ?>
	</div><!-- .pagination -->

	<div class="vw-page-navigation-divider"></div>
</nav>
