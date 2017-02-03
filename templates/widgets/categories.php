<ul class="vw-widget-category-list">
	<?php foreach ( $categories as $category ) : ?>
	<li>
		<a class="vw-widget-category-title vw-header-font" href="<?php echo get_category_link( $category->cat_ID ); ?>" title="<?php printf( esc_attr__('View posts in %s', 'envirra'), $category->name ); ?>" rel="bookmark">
			<?php echo $category->name ?>
		</a>

		<?php if ( ! empty( $category->description ) ) : ?>
		<div class="vw-widget-category-description"><?php echo $category->description ?></div>
		<?php endif; ?>
		
		<div class="vw-widget-category-post-count"><?php printf( __( '%s Posts', 'envirra' ), $category->count ); ?></div>

		

	</li>
	<?php endforeach; ?>
</ul>