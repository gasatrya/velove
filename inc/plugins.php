<?php
/**
 * TGM Plugin Lists
 */

// Include the TGM_Plugin_Activation class.
require trailingslashit( get_template_directory() ) . 'inc/extensions/tgmpa.php';

/**
 * Register required and recommended plugins.
 */
function velove_register_plugins() {

	$plugins = array(

		array(
			'name'     => 'One Click Demo Import',
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),

		array(
			'name'     => 'Velove Kit',
			'slug'     => 'velove-kit',
			'source'   => trailingslashit( get_template_directory() ) . 'inc/plugins/velove-kit.zip',
			'required' => true,
		),

		array(
			'name'     => 'Zilla Likes',
			'slug'     => 'zilla-likes',
			'source'   => trailingslashit( get_template_directory() ) . 'inc/plugins/zilla-likes.zip',
			'required' => false,
		),

		array(
			'name'     => 'WP Subtitle',
			'slug'     => 'wp-subtitle',
			'required' => false,
		),

		array(
			'name'     => 'MailChimp for WordPress',
			'slug'     => 'mailchimp-for-wp',
			'required' => false,
		),

		array(
			'name'     => 'WP Instagram widget',
			'slug'     => 'wp-instagram-widget',
			'required' => false,
		),

		array(
			'name'     => 'Scroll Top',
			'slug'     => 'scroll-top',
			'required' => false,
		),

		array(
			'name'     => 'Comments Widget Plus',
			'slug'     => 'comments-widget-plus',
			'required' => false,
		),

		array(
			'name'     => 'Smart Recent Posts Widget',
			'slug'     => 'smart-recent-posts-widget',
			'required' => false,
		),

	);

	$config = array(
		'id'           => 'tgmpa',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'velove_register_plugins' );
