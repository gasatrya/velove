<section class="no-results error-404 not-found">

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<h3><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'velove' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></h3>

		<?php elseif ( is_search() ) : ?>

			<h3><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'velove' ); ?></h3>
			<p><?php esc_html_e( 'You may have typed the keyword incorrectly. Plesase try to search again.', 'velove' ) ?></p>
			<div class="search-area">
				<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Type a keyword &hellip;', 'placeholder', 'velove' ) ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>">
					<button type="submit" id="search-submit"><?php esc_html_e( 'Search', 'velove' ); ?></button>
				</form>
			</div>

		<?php else : ?>

			<h3><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'velove' ); ?></h3>
			<div class="search-area">
				<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Type a keyword &hellip;', 'placeholder', 'velove' ) ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>">
					<button type="submit" id="search-submit"><?php esc_html_e( 'Search', 'velove' ); ?></button>
				</form>
			</div>

		<?php endif; ?>
	</div><!-- .page-content -->

</section><!-- .no-results -->
