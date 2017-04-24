<article id="post-<?php the_ID(); ?>" data-file="<?php the_permalink(); ?>" data-target="article" <?php post_class(); ?>>

	<time class="entry-date published vertical-text-wrapper" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><a class="vertical-text" href="<?php the_permalink(); ?>"><span class="vertical-text-inner"><?php echo esc_html( get_the_date() ); ?></span></a></time>

	<div class="content">

		<?php velove_post_thumbnail(); ?>

		<div class="content-text">

			<div class="entry-meta"><?php velove_entry_meta(); ?></div>

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>

			<span class="more-link-wrapper">
				<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Read More', 'velove' ); ?></a>
			</span>

		</div>

	</div>

</article><!-- #post-## -->
