<article id="post-<?php the_ID(); ?>" data-file="<?php the_permalink(); ?>" data-target="article" <?php post_class( 'most' ); ?>>

	<time class="entry-date published vertical-text-wrapper" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><a class="vertical-text" href="<?php the_permalink(); ?>"><span class="vertical-text-inner"><?php echo esc_html( get_the_date() ); ?></span></a></time>

	<div class="content">

		<?php if ( has_post_thumbnail() ) : ?>
			<a class="thumbnail-link" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'velove-most', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
			</a>
		<?php endif; ?>

		<div class="center-align">
			<?php the_title( sprintf( '<h2 class="entry-title"><span><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></span></h2>' ); ?>
			<div class="entry-meta"><?php velove_entry_meta(); ?></div>
		</div>

	</div>

	<div class="content-text center-align">

		<div class="entry-summary">
			<p><?php echo apply_filters( 'velove_most_content_excerpt', esc_attr( wp_trim_words( get_the_excerpt(), 20 ) ) ); ?></p>
		</div>

		<span class="more-link-wrapper">
			<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Read More', 'velove' ); ?></a>
		</span>

	</div>

</article><!-- #post-## -->
