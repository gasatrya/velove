<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 */

if ( ! function_exists( 'velove_site_branding' ) ) :
/**
 * Site branding for the site.
 *
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer page.
 */
function velove_site_branding() {

	// Get the log.
	$logo_id  = get_theme_mod( 'custom_logo' );
	$logo_url = wp_get_attachment_image_src( $logo_id , 'full' );

	// Check if logo available, then display it.
	if ( $logo_id ) :
		echo '<div class="site-branding">'. "\n";
			echo '<div class="logo">';
				echo '<a href="' . esc_url( get_home_url() ) . '" rel="home">' . "\n";
					echo '<img src="' . esc_url( $logo_url[0] ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
				echo '</a>' . "\n";
			echo '</div>' . "\n";
		echo '</div>' . "\n";

	// If not, then display the Site Title and Site Description.
	else :
		echo '<div class="site-branding">'. "\n";
			echo '<h1 class="site-title"><a href="' . esc_url( get_home_url() ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></h1>'. "\n";
			echo '<h2 class="site-description">' . esc_attr( get_bloginfo( 'description' ) ) . '</h2>'. "\n";
		echo '</div>'. "\n";
	endif;

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function velove_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'velove_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'velove_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so velove_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so velove_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in velove_categorized_blog.
 */
function velove_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'velove_categories' );
}
add_action( 'edit_category', 'velove_category_transient_flusher' );
add_action( 'save_post',     'velove_category_transient_flusher' );

if ( ! function_exists( 'velove_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 */
function velove_post_thumbnail() {

	// Get the customizer data.
	$layout = get_theme_mod( 'velove_blog_layouts', 'default' );

	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() || has_post_format() ) {
		return;
	}
?>

	<a class="thumbnail-link" href="<?php the_permalink(); ?>">
		<?php
			if ( $layout == 'full-width' ) {
				the_post_thumbnail( 'velove-post-full', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) );
			} elseif (
				$layout == 'grid-two-right-sidebar' ||
				$layout == 'grid-two-left-sidebar' ||
				$layout == 'grid-three' ||
				$layout == 'grid-four'
			) {
				the_post_thumbnail( 'velove-post-small', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) );
			} elseif (
				$layout == 'masonry-two-right-sidebar' ||
				$layout == 'masonry-two-left-sidebar' ||
				$layout == 'masonry-three' ||
				$layout == 'masonry-four'
			) {
				the_post_thumbnail( 'velove-archive', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) );
			} else {
				the_post_thumbnail( 'velove-post', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) );
			}
		?>
		<?php the_title( '<h2 class="entry-title"><span>', '</span></h2>' ); ?>
	</a>

<?php
}
endif;

if ( ! function_exists( 'velove_entry_meta' ) ) :
/**
 * Post meta
 */
function velove_entry_meta() {
	?>

	<span class="author vcard"><?php printf( esc_html__( 'by %s', 'velove' ), '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>' ); ?></span>

	<span class="seperator"></span>

	<span class="reading-time"></span> <span class="reading-text"><?php esc_html_e( 'Read', 'velove' ); ?></span>

	<span class="seperator"></span>

	<?php echo velove_do_likes(); ?>

	<?php
}
endif;

if ( ! function_exists( 'velove_after_header_content' ) ) :
/**
 * Content after header.
 */
function velove_after_header_content() {

	echo '<div class="after-header">';

		// Home page content.
		if ( is_home() || is_front_page() ) {
			get_template_part( 'partials/content', 'featured' );
		} else {
			get_template_part( 'partials/content', 'after-header' );
		}

	echo '</div>';

}
endif;

if ( ! function_exists( 'velove_before_footer_content' ) ) :
/**
 * Content before footer.
 */
function velove_before_footer_content() {

	// Get the data from Customizer
	$enable = get_theme_mod( 'velove_most_posts_enable', 1 );
	$title  = get_theme_mod( 'velove_most_posts_title', esc_html__( 'Most Loved Posts', 'velove' ) );
	$query  = get_theme_mod( 'velove_most_posts_query', 'loved' );
	$limit  = get_theme_mod( 'velove_most_posts_number', 3 );

	// Check if it enable.
	if ( !$enable ) {
		return;
	}

	// Hide on 404 page.
	if ( is_404() ) {
		return;
	}
	?>

	<div class="most-content">
		<div class="container">

			<h3 class="most-content-title"><span><?php echo wp_kses_post( $title ); ?></span></h3>

			<?php
				$args = array(
					'post_type'           => 'post',
					'posts_per_page'      => absint( $limit ),
					'ignore_sticky_posts' => 1
				);

				if ( $query == 'loved' ) {
					$args['meta_key'] = '_velove_likes';
					$args['orderby']  = 'meta_value_num';
				} elseif ( $query == 'popular' ) {
					$args['orderby']  = 'comment_count';
				} elseif ( $query == 'random' ) {
					$args['orderby']  = 'rand';
				} else {
					$args['orderby']  = 'date';
				}

				// Allow dev to filter the query.
				$posts_query = apply_filters( 'velove_most_posts_args', $args );

				$most = new WP_Query( $posts_query );

				if ( $most->have_posts() ) :
			?>

				<?php while ( $most->have_posts() ) : $most->the_post(); ?>

					<?php get_template_part( 'partials/content', 'most' ); ?>

				<?php endwhile; ?>

			<?php endif; wp_reset_postdata(); ?>

		</div>
	</div>

	<?php
}
endif;

if ( ! function_exists( 'velove_post_share' ) ) :
/**
 * Social share.
 *
 * @since 1.0.0
 */
function velove_post_share() {

	// Get the data from Customizer
	$enable = get_theme_mod( 'velove_post_share', 1 );
	if ( !$enable ) {
		return;
	}

	?>
		<div class="entry-share">
			<?php echo velove_do_likes(); ?>
			<ul>
				<li class="facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><i class="icon-facebook"></i><span class="screen-reader-text">Facebook</span></a></li>
				<li class="twitter"><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( esc_attr( get_the_title( get_the_ID() ) ) ); ?>&amp;url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><i class="icon-twitter"></i><span class="screen-reader-text">Twitter</span></a></li>
				<li class="gplus"><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>" target="_blank"><i class="icon-gplus"></i><span class="screen-reader-text">Google+</span></a></li>
				<li class="linkedin"><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode( get_permalink( get_the_ID() ) ); ?>&amp;title=<?php echo urlencode( esc_attr( get_the_title( get_the_ID() ) ) ); ?>" target="_blank"><i class="icon-linkedin"></i><span class="screen-reader-text">Linkedin</span></a></li>
			</ul>
		</div>
	<?php
}
endif;

if ( ! function_exists( 'velove_post_author_box' ) ) :
/**
 * Author post informations.
 */
function velove_post_author_box() {

	// Get the data from Customizer
	$enable = get_theme_mod( 'velove_author_box', 1 );
	if ( !$enable ) {
		return;
	}

	// Bail if not on the single post.
	if ( ! is_single() ) {
		return;
	}

	// Bail if user hasn't fill the Biographical Info field.
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}

	// Get the author social information.
	$twitter   = get_the_author_meta( 'twitter' );
	$facebook  = get_the_author_meta( 'facebook' );
	$gplus     = get_the_author_meta( 'gplus' );
	$instagram = get_the_author_meta( 'instagram' );
	$pinterest = get_the_author_meta( 'pinterest' );
	$linkedin  = get_the_author_meta( 'linkedin' );
	$dribbble  = get_the_author_meta( 'dribbble' );
?>

	<div class="author-bio">
		<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'velove_author_bio_avatar_size', 100 ), '', strip_tags( get_the_author() ) ); ?>
		<div class="description">

			<h3 class="author-title name">
				<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo strip_tags( get_the_author() ); ?></a>
			</h3>

			<p class="bio"><?php echo wp_kses_post( get_the_author_meta( 'description' ) ); ?></p>

			<?php if ( $twitter || $facebook || $gplus || $instagram || $pinterest || $linkedin || $dribbble ) : ?>
				<div class="author-social-links">
					<?php if ( $twitter ) { ?>
						<a href="<?php echo esc_url( $twitter ); ?>"><i class="icon-twitter"></i></a>
					<?php } ?>
					<?php if ( $facebook ) { ?>
						<a href="<?php echo esc_url( $facebook ); ?>"><i class="icon-facebook"></i></a>
					<?php } ?>
					<?php if ( $gplus ) { ?>
						<a href="<?php echo esc_url( $gplus ); ?>"><i class="icon-gplus"></i></a>
					<?php } ?>
					<?php if ( $instagram ) { ?>
						<a href="<?php echo esc_url( $instagram ); ?>"><i class="icon-instagram"></i></a>
					<?php } ?>
					<?php if ( $pinterest ) { ?>
						<a href="<?php echo esc_url( $pinterest ); ?>"><i class="icon-pinterest"></i></a>
					<?php } ?>
					<?php if ( $linkedin ) { ?>
						<a href="<?php echo esc_url( $linkedin ); ?>"><i class="icon-linkedin"></i></a>
					<?php } ?>
					<?php if ( $dribbble ) { ?>
						<a href="<?php echo esc_url( $dribbble ); ?>"><i class="icon-dribbble"></i></a>
					<?php } ?>
				</div>
			<?php endif; ?>

		</div>
	</div><!-- .author-bio -->

<?php
}
endif;

if ( ! function_exists( 'velove_next_prev_post' ) ) :
/**
 * Custom next post link
 *
 * @since 1.0.0
 */
function velove_next_prev_post() {

	// Get the data set in customizer
	$enable = get_theme_mod( 'velove_next_prev_post', 1 );
	if ( !$enable ) {
		return;
	}

	// Display on single post page.
	if ( ! is_single() ) {
		return;
	}

	// Get the next and previous post id.
	$next = get_adjacent_post( false, '', false );
	$prev = get_adjacent_post( false, '', true );

	if ( $next || $prev ) :
?>
	<div class="post-pagination">

		<?php if ( $prev ) : ?>
			<div class="prev-post">

				<span class="prev-label"><?php esc_html_e( 'Previous Post', 'velove' ); ?></span>
				<?php if ( has_post_thumbnail( $prev->ID ) ) : ?>
					<a class="thumbnail-link" href="<?php echo esc_url( get_permalink( $prev->ID ) ); ?>">
						<?php echo get_the_post_thumbnail( $prev->ID, 'velove-post-small', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title( $prev->ID ) ) ) ) ?>
						<?php the_title( '<div class="post-title"><span>', '</span></div>' ); ?>
					</a>
				<?php endif; ?>

			</div>
		<?php endif; ?>

		<?php if ( $next ) : ?>
			<div class="next-post">

				<span class="next-label"><?php esc_html_e( 'Next Post', 'velove' ); ?></span>
				<?php if ( has_post_thumbnail( $next->ID ) ) : ?>
					<a class="thumbnail-link" href="<?php echo esc_url( get_permalink( $next->ID ) ); ?>">
						<?php echo get_the_post_thumbnail( $next->ID, 'velove-post-small', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title( $next->ID ) ) ) ) ?>
						<?php the_title( '<div class="post-title"><span>', '</span></div>' ); ?>
					</a>
				<?php endif; ?>

			</div>
		<?php endif; ?>

	</div>
<?php
	endif;
}
endif;

if ( ! function_exists( 'velove_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function velove_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">
			<p><?php esc_html_e( 'Pingback:', 'velove' ); ?> <span><?php comment_author_link(); ?></span> <?php edit_comment_link( esc_html__( '(Edit)', 'velove' ), '<span class="edit-link">', '</span>' ); ?></p>
		</article>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">

			<div class="comment-avatar">
				<?php echo get_avatar( $comment, apply_filters( 'velove_comment_avatar_size', 90 ) ); ?>
			</div>

			<div class="comment-body">
				<div class="comment-wrapper">

					<div class="comment-head">
						<span class="name"><?php echo get_comment_author_link(); ?></span>
						<?php
							$edit_comment_link = '';
							if ( get_edit_comment_link() )
								$edit_comment_link = sprintf( esc_html__( '&middot; %1$sEdit%2$s', 'velove' ), '<a href="' . get_edit_comment_link() . '" title="' . esc_attr__( 'Edit Comment', 'velove' ) . '">', '</a>' );

							printf( '<span class="date"><a href="%1$s"><time datetime="%2$s">%3$s</time></a> %4$s</span>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( esc_html__( '%1$s at %2$s', 'velove' ), get_comment_date(), get_comment_time() ),
								$edit_comment_link
							);
						?>
					</div><!-- comment-head -->

					<div class="comment-content comment-entry">
						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'velove' ); ?></p>
						<?php endif; ?>
						<?php comment_text(); ?>
						<span class="reply">
							<?php echo velove_comment_author_badge(); ?>
							<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<i class="fa fa-reply"></i> Reply', 'velove' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</span><!-- .reply -->
					</div><!-- .comment-content -->

				</div>
			</div>

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'velove_comment_author_badge' ) ) :
/**
 * Custom badge for post author comment
 */
function velove_comment_author_badge() {

	// Set up empty variable
	$output = '';

	// Get comment classes
	$classes = get_comment_class();

	if ( in_array( 'bypostauthor', $classes ) ) {
		$output = '<span class="author-badge">' . esc_html__( 'Author', 'velove' ) . '</span>';
	}

	// Display the badge
	return apply_filters( 'velove_comment_author_badge', $output );
}
endif;

if ( ! function_exists( 'velove_footer_text' ) ) :
/**
 * Footer Text
 */
function velove_footer_text() {

	// Get the customizer data
	$default = '&copy; Copyright ' . date( 'Y' ) . ' - <a href="' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a>. All Rights Reserved. <br /> Designed & Developed by <a href="https://beautimour.com/">Beautimour</a>';
	$footer_text = get_theme_mod( 'velove_footer_text', $default );

	// Display the data
	echo '<p class="copyright">' . wp_kses_post( $footer_text ) . '</p>';

}
endif;
