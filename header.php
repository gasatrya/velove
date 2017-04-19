<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<header id="masthead" class="site-header">
		<div class="container">

			<div class="site-navigation">
				<?php get_search_form(); // Loads the searchform.php ?>

				<?php if ( has_nav_menu ( 'primary' ) ) : ?>
					<nav class="main-navigation" id="site-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'velove' ); ?></button>
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'primary',
								'menu_id'         => 'menu-primary-items',
								'menu_class'      => 'menu-primary-items'
							)
						); ?>
					</nav>
				<?php endif; ?>
			</div><!-- .navigation -->

			<?php velove_site_branding(); ?>

		</div><!-- .container -->
	</header><!-- #masthead -->

	<?php velove_after_header_content(); ?>

	<div id="content" class="site-content">
