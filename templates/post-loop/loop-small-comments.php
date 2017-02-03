<div class="vw-post-loop vw-post-loop-small-comments clearfix">

	<?php foreach ( $comments as $comment ) : 

		$template_file = 'templates/post-loop/post-small-comment.php';
		include( locate_template( $template_file, false, false ) );
		
	endforeach; ?>

</div>