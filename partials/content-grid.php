<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php velove_post_thumbnail(); ?>

	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>

	<span class="more-link-wrapper">
		<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Read More', 'velove' ); ?></a>
	</span>

</article><!-- #post-## -->
