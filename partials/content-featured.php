<?php
// Get the customizer data
$enable = get_theme_mod( 'velove_featured_posts_enable', 1 );
$title  = get_theme_mod( 'velove_featured_posts_title', esc_html__( 'Featured', 'velove' ) );

// Return early if disabled
if ( !$enable ) {
	return;
}

// Get the tag id
$name = get_theme_mod( 'velove_featured_posts_tag', 'featured' );
if ( $name ) {
	$term = get_term_by( 'name', $name, 'post_tag' );
}

// Main post query
$query = array(
	'post_type'           => 'post',
	'posts_per_page'      => 1,
	'ignore_sticky_posts' => 1
);

// Get the sticky post ids
$sticky = get_option( 'sticky_posts' );

// Adds the custom arguments to the main query
if ( $term ) {
	$query['tag_id'] = $term->term_id;
} else {
	$query['post__in'] = $sticky;
}

// Allow dev to filter the query.
$query = apply_filters( 'velove_featured_posts_args', $query );

$featured = new WP_Query( $query );
?>

<?php if ( $featured->have_posts() ) : ?>

	<div class="featured">
		<div class="container">

			<article id="post-<?php the_ID(); ?>" data-file="<?php the_permalink(); ?>" data-target="article" <?php post_class(); ?>>

					<h3 class="featured-title"><?php echo wp_kses_post( $title ); ?></h3>

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
