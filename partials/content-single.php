<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a class="thumbnail-link" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'velove-featured', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
		</a>
	<?php endif; ?>

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
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-content">

			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'velove' ),
					'after'  => '</div>',
				) );
			?>

		</div>

		<footer class="entry-footer">

			<?php
				$tags = get_the_tags();
				if ( $tags ) :
			?>
				<span class="tag-links">
					<?php foreach( $tags as $tag ) : ?>
						<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_attr( $tag->name ); ?></a>
					<?php endforeach; ?>
				</span>
			<?php endif; ?>

		</footer>

		<?php if ( function_exists( 'sharing_display' ) ) : ?>
			<div class="jetpack-share-like">
				<?php sharing_display( '', true ); ?>
				<?php if ( class_exists( 'Jetpack_Likes' ) ) { $custom_likes = new Jetpack_Likes; echo $custom_likes->post_likes( '' ); } ?>
			</div>
		<?php endif; ?>
	</div>

</article><!-- #post-## -->
