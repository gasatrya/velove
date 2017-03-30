<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php velove_post_thumbnail(); ?>

	<div class="entry-left">
		<?php if ( 'post' == get_post_type() ) : ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( esc_html__( ', ', 'velove' ) );
				if ( $categories_list && velove_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( esc_html__( 'in %s', 'velove' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>
		<?php endif; ?>

		<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php printf( esc_html__( 'on %s', 'velove' ), '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_date() ). '</a>' ); ?></time>

		<span class="entry-author">
			<?php printf( esc_html__( 'by %s', 'velove' ), '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><span>' . esc_html( get_the_author() ) . '</span></a>' ) ?>
		</span>
	</div>

	<div class="entry-right">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div>

		<span class="more-link-wrapper">
			<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Continue Reading', 'velove' ); ?></a>
		</span>
	</div>

</article><!-- #post-## -->
