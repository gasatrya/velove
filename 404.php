<?php get_header(); ?>

	<div class="container">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

				<section class="error-404 not-found">

					<div class="page-content">

						<h3><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'velove' ); ?></h3>
						<p><?php esc_html_e( 'You may have typed the address incorrectly or you may have used an outdated link. Try search our site.', 'velove' ) ?></p>

						<div class="search-area">
							<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="search" name="s" id="s" placeholder="<?php echo esc_attr_x( 'Type a keyword &hellip;', 'placeholder', 'velove' ) ?>" autocomplete="off" value="<?php echo esc_attr( get_search_query() ); ?>">
								<button type="submit" id="search-submit"><?php esc_html_e( 'Search', 'velove' ); ?></button>
							</form>
						</div>

					</div><!-- .page-content -->

				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- #primary -->

	</div><!-- .container -->

<?php get_footer(); ?>
