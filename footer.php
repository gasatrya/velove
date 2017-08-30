		</div><!-- #content -->

		<?php velove_related_posts(); ?>

		<?php velove_before_footer_content(); ?>

		<footer id="colophon" class="site-footer">

			<?php if ( has_nav_menu ( 'social' ) ) : ?>
				<div class="social-links">
					<div class="container">
							<?php wp_nav_menu(
								array(
									'theme_location'  => 'social',
									'link_before'     => '<span class="social-name">',
									'link_after'      => '</span>',
									'depth'           => 1,
									'container'       => '',
								)
							); ?>
					</div>
				</div>
			<?php endif; ?>

			<?php dynamic_sidebar( 'instagram' ); ?>

			<div class="site-info">
				<div class="container">

					<div class="info-left">
						<?php velove_footer_text(); ?>
					</div>

					<div class="info-right">
						<a class="to-top" href="#page"><?php esc_html_e( 'Back to top', 'velove' ); ?><i class="icon-up-open"></i></a>
					</div>

				</div>
			</div><!-- .site-info -->

		</footer><!-- #colophon -->

	</div><!-- .page-wrapper -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
