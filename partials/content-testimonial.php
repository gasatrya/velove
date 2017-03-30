<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<span class="author-img">
		<?php the_post_thumbnail( 'velove-thumbnail-square' ); ?>
	</span>

	<div class="testimonial-content">
		<?php the_content(); ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</div>

</article><!-- #post-## -->
