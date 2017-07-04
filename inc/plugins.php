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
			'name'     => 'Beautimour Kit',
			'slug'     => 'beautimour-kit',
			'source'   => 'https://beautimour.com/wp-content/uploads/2017/07/beautimour-kit.zip',
			'required' => false,
		),

		array(
			'name'     => 'Subtitles',
			'slug'     => 'subtitles',
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
