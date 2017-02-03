<div class="vw-post-box vw-post-style-small-comment clearfix <?php vw_the_post_format_class(); ?>">
	<div class="vw-post-box-inner">

		<p class="vw-post-box-comment">
			<?php echo wp_trim_words( $comment->comment_content, VW_CONST_WIDGET_COMMENT_EXCERPT_LENGTH ) ?>
		</p>

		<a class="vw-comment-author-avatar" href="<?php echo get_permalink( $comment->comment_post_ID ); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'envirra'), get_the_title( $comment->comment_post_ID ) ); ?>" rel="bookmark">
			<?php echo vw_get_avatar( $comment->comment_author_email, 40 ); ?>
		</a>

		<div class="vw-comment-meta ">

			<a class="vw-comment-author vw-header-font" href="<?php echo get_permalink( $comment->comment_post_ID ); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'envirra'), get_the_title( $comment->comment_post_ID ) ); ?>" rel="bookmark">
				<?php echo $comment->comment_author ?>
			</a>

			<div class="vw-post-box-title"><?php printf( __( 'on %s', 'envirra' ), get_the_title( $comment->comment_post_ID ) ); ?></div>

		</div>

		<div class="clearfix"></div>
		
	</div>
</div>