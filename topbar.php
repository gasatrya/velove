<?php
// Get the customizer data.
$enable = get_theme_mod( 'velove_topbar_enable', 1 );
$phone  = get_theme_mod( 'velove_topbar_tel' );
$email  = get_theme_mod( 'velove_topbar_email' );
$hours  = get_theme_mod( 'velove_topbar_hours' );

// Hide if disable.
if ( $enable === 0 ) {
	return;
}
?>

<div class="topbar">
	<div class="container">

		<?php if ( $phone || $email || $hours ) : ?>
			<div class="contact-info">
				<?php if ( $phone ) : ?>
					<span class="phone"><i class="icon-phone"></i> <?php echo sanitize_text_field( $phone ); ?></span>
				<?php endif; ?>
				<?php if ( $email ) : ?>
					<span class="email"><i class="icon-mail"></i> <?php echo is_email( $email ); ?></span>
				<?php endif; ?>
				<?php if ( $hours ) : ?>
					<span class="hours"><i class="icon-clock"></i> <?php echo sanitize_text_field( $hours ); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( has_nav_menu ( 'social' ) ) : ?>
			<?php wp_nav_menu(
				array(
					'theme_location'  => 'social',
					'depth'           => 1,
					'link_before'     => '<span class="screen-reader-text">',
					'link_after'      => '</span>',
					'container_class' => 'social-links',
				)
			); ?>
		<?php endif; ?>

	</div><!-- .container -->
</div><!-- topbar -->
