<?php get_header(); ?>

<?php
$post_layout = vw_get_post_layout();

if ( 'full-width' == $post_layout ) {
	get_template_part( 'single_full_width' );

} elseif ( 'classic-no-featured-image' == $post_layout ) {
	get_template_part( 'single_classic_no_featured_image' );

} elseif ( 'custom-1' == $post_layout ) {
	get_template_part( 'single_custom_1' );

} elseif ( 'custom-2' == $post_layout ) {
	get_template_part( 'single_custom_2' );

} else {
	get_template_part( 'single_classic' );
}
?>

<?php get_footer(); ?>