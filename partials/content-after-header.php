<div class="after-header-inner">

	<?php if ( is_404() ) : ?>
		<div class="small-text"><?php esc_html_e( 'Sorry!', 'velove' ); ?></div>
		<div class="large-text"><?php esc_html_e( 'Error 404: Not Found', 'velove' ); ?></div>

	<?php elseif ( is_category() ) : ?>
		<div class="small-text"><?php esc_html_e( 'Browsing Category:', 'velove' ); ?></div>
		<div class="large-text"><?php the_archive_title(); ?></div>

	<?php elseif ( is_tag() ) : ?>
		<div class="small-text"><?php esc_html_e( 'Browsing Tag:', 'velove' ); ?></div>
		<div class="large-text"><?php the_archive_title(); ?></div>

	<?php elseif ( is_search() ) : ?>
		<div class="small-text"><?php esc_html_e( 'Search result for:', 'velove' ); ?></div>
		<div class="large-text"><?php echo get_search_query(); ?></div>

	<?php elseif ( is_author() ) : ?>
		<div class="bio">

			<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'velove_author_page_bio_avatar_size', 85 ), '', strip_tags( get_the_author() ) ); ?>

			<div class="description">
				<h3 class="bio-name">
					<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo strip_tags( get_the_author() ); ?></a>
				</h3>
				<p class="bio-text"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>
			</div>
		</div><!-- .author-bio -->

	<?php elseif ( is_attachment() ) : ?>
		<div class="small-text"><?php esc_html_e( 'Browsing Attachment:', 'velove' ); ?></div>
		<div class="large-text"><?php the_title(); ?></div>

	<?php elseif ( is_singular() ) : ?>
		<div class="page-header">
			<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			<?php if ( function_exists( 'the_subtitle' ) ) { the_subtitle( '<p class="page-subtitle">', '</p>' ); } ?>
		</div>


	<?php endif; ?>

</div>
