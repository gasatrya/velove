<?php
// Get the customizer data.
$layout = get_theme_mod( 'velove_blog_layouts', 'default' );

get_header(); ?>

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>

					<?php if (
						$layout == 'masonry-two-right-sidebar' ||
						$layout == 'masonry-two-left-sidebar' ||
						$layout == 'masonry-three' ||
						$layout == 'masonry-four'
					) {
						echo '<div class="masonry-wrapper">';
					} ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<?php if (
							$layout == 'grid-two-right-sidebar' ||
							$layout == 'grid-two-left-sidebar' ||
							$layout == 'grid-three' ||
							$layout == 'grid-four' ||
							$layout == 'masonry-two-right-sidebar' ||
							$layout == 'masonry-two-left-sidebar' ||
							$layout == 'masonry-three' ||
							$layout == 'masonry-four'
						) : ?>
							<?php get_template_part( 'partials/content', 'grid' ); ?>
						<?php else : ?>
							<?php get_template_part( 'partials/content' ); ?>
						<?php endif; ?>

					<?php endwhile; ?>

					<?php if (
						$layout == 'masonry-two-right-sidebar' ||
						$layout == 'masonry-two-left-sidebar' ||
						$layout == 'masonry-three' ||
						$layout == 'masonry-four'
					) {
						echo '</div>';
					} ?>

					<?php get_template_part( 'pagination' ); // Loads the pagination.php template  ?>

				<?php else : ?>

					<?php get_template_part( 'partials/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); // Loads the sidebar.php template. ?>

	</div><!-- .container -->

<?php get_footer(); ?>
