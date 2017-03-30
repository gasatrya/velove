	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php get_template_part( 'sidebar', 'footer' ); // Loads the sidebar-footer.php template. ?>

		<div class="site-info">
			<div class="container">
				<?php if ( has_nav_menu ( 'footer' ) ) : ?>
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'footer',
							'container'       => 'nav',
							'container_class' => 'footer-navigation',
							'menu_id'         => 'menu-footer-items',
							'menu_class'      => 'menu-footer-items',
							'depth'           => 1
						)
					); ?>
				<?php endif; ?>
				<?php velove_footer_text(); ?>
			</div>
		</div><!-- .site-info -->

	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
