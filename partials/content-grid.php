<article id="post-<?php the_ID(); ?>" data-file="<?php the_permalink(); ?>" data-target="article" <?php post_class(); ?>>

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
