<?php $author = vw_get_current_author(); ?>
<div class="vw-about-author clearfix" <?php vw_itemprop('author'); vw_itemtype('Person'); ?>>

	<h3 class="vw-about-author-title"><span><?php _e( 'The Author', 'envirra' ); ?></span></h3>

	<?php vw_the_author_avatar( $author, VW_CONST_AVATAR_SIZE_LARGE ); ?>

	<div class="vw-about-author-info">
		<h3 class="vw-author-name" <?php vw_itemprop('name'); ?>><?php echo $author->display_name; ?></h3>
		<p class="vw-author-bio" <?php vw_itemprop('description'); ?>><?php echo nl2br( $author->user_description ); ?></p>

		<div class="vw-author-socials">
			<?php vw_the_user_social_links(); ?>
		</div>
	</div>
	<div class="clearfix"></div>
</div>