<?php
// Get the options value
// $enable = get_theme_mod( 'velove_featured_posts_enable', 1 );
// $tag    = get_theme_mod( 'velove_featured_posts_tag' );
// $order  = get_theme_mod( 'velove_featured_posts_orderby', 'date' );

// if ( !$enable ) {
// 	return;
// }

// if ( !$tag ) {
// 	return;
// }

$query = array(
	'post_type'      => 'post',
	'posts_per_page' => 1,
	// 'orderby'        => $order,
	'post__not_in'   => get_option( 'sticky_posts' ),
	// 'tag_id'         => $tag
);

// Allow dev to filter the query.
$query = apply_filters( 'velove_featured_posts_args', $query );

$featured = new WP_Query( $query );
?>

<?php if ( $featured->have_posts() ) : ?>

	<div class="featured">
		<div class="container">

			<article id="post-<?php the_ID(); ?>" data-file="<?php the_permalink(); ?>" data-target="article" <?php post_class(); ?>>

					<h3 class="featured-title"><?php esc_html_e( 'Featured', 'velove' ); ?></h3>

					<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

						<div class="featured-details">

							<?php if ( has_post_thumbnail() ) : ?>
								<a class="thumbnail-link" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'velove-featured', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
								</a>
							<?php endif; ?>

							<div class="featured-content">

								<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

								<div class="entry-meta"><?php velove_entry_meta(); ?></div>

								<div class="featured-summary">
									<?php the_excerpt(); ?>
								</div>

								<span class="more-link-wrapper">
									<a href="<?php the_permalink(); ?>" class="more-link"><?php esc_html_e( 'Read More', 'velove' ); ?></a>
								</span>

							</div>

						</div>

					<?php endwhile; ?>

			</article>

		</div>
	</div>

<?php endif; wp_reset_postdata(); ?>
