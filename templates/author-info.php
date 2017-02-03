<div class="vw-widget-author-info" <?php vw_itemprop('author'); vw_itemtype('Person'); ?>>

	<?php if ( ! empty( $instance['title'] ) ) : ?>
	<h3 class="vw-widget-author-title">
		<span><?php echo $instance['title']; ?></span>
	</h3>
	<?php endif; ?>

	<?php echo vw_the_author_avatar( $user, VW_CONST_AVATAR_SIZE_XLARGE ); ?>

	<h4 class="vw-widget-author-name" <?php vw_itemprop('name'); ?>>
		<?php echo nl2br( $user->display_name ); ?>
	</h4>

	<div class="vw-widget-author-bio" <?php vw_itemprop('description'); ?>>
		<?php echo nl2br( $user->user_description ); ?>
	</div>

	<div class="vw-author-socials">
		<?php vw_the_user_social_links( $user ); ?>
	</div>
	
</div>