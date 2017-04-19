<?php
// Get the customizer value.
$title = get_theme_mod( 'velove_page_title', 1 );
$image = get_theme_mod( 'velove_page_featured_image', 0 );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( $image ) : ?>
		<?php velove_post_thumbnail(); ?>
	<?php endif; ?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'velove' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php edit_post_link( esc_html__( 'Edit', 'velove' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>

</article><!-- #post-## -->
