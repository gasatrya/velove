<?php
/**
 * Velove Theme Customizer
 */

// Loads the customizer settings
require trailingslashit( get_template_directory() ) . 'inc/customizer/general.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/topbar.php';
require trailingslashit( get_template_directory() ) . 'inc/customizer/header.php';

/**
 * Custom customizer functions.
 */
function velove_customize_functions( $wp_customize ) {

	// Register new panel: Velove Options
	$wp_customize->add_panel( 'velove_options', array(
		'title'       => esc_html__( 'Velove Options', 'velove' ),
		'description' => esc_html__( 'This panel is used for customizing the Velove theme.', 'velove' ),
		'priority'    => 130,
	) );

	// Live preview of Site Title
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	// Enable selective refresh to the Site Title
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.site-title a',
			'container_inclusive' => false,
			'render_callback'     => 'velove_customize_partial_blogname',
		) );
	}

}
add_action( 'customize_register', 'velove_customize_functions', 99 );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function velove_customize_preview_js() {
	wp_enqueue_script( 'velove-customizer', get_template_directory_uri() . '/assets/js/customizer/customizer.js', array( 'customize-preview', 'jquery' ) );
}
add_action( 'customize_preview_init', 'velove_customize_preview_js' );

/**
 * Custom styles.
 */
function velove_custom_styles() {

	// Set up empty variable.
	$css = '';

	/**
	 * Top Bar
	 */
	$topbar_bg     = get_theme_mod( 'velove_topbar_bg', '#fafafa' );
	$topbar_color  = get_theme_mod( 'velove_topbar_color', '#8d8e8f' );
	$topbar_social = get_theme_mod( 'velove_topbar_social_color', '#8d8e8f' );

	if ( $topbar_bg !== '#fafafa' ) {
		$css = '.topbar { background-color: ' . sanitize_hex_color( $topbar_bg ) . ' }';
	}
	if ( $topbar_color !== '#8d8e8f' ) {
		$css = '.topbar { color: ' . sanitize_hex_color( $topbar_color ) . ' }';
	}
	if ( $topbar_social !== '#8d8e8f' ) {
		$css = '.social-links a { color: ' . sanitize_hex_color( $topbar_social ) . ' }';
	}

	/**
	 * Header
	 */
	$header_bg           = get_theme_mod( 'velove_header_bg', '#fff' );
	$header_color        = get_theme_mod( 'velove_header_title_color', '#000' );
	$header_menu_color   = get_theme_mod( 'velove_header_menu_color', '#5a5b5c' );
	$header_border_color = get_theme_mod( 'velove_header_border_color', '#f1f1f1' );

	if ( $header_bg !== '#fff' ) {
		$css = '.site-header { background-color: ' . sanitize_hex_color( $header_bg ) . ' }';
	}
	if ( $header_color !== '#000' ) {
		$css = '.site-header { color: ' . sanitize_hex_color( $header_color ) . ' }';
	}
	if ( $header_menu_color !== '#5a5b5c' ) {
		$css = '.menu-primary-items a, .menu-primary-items li.menu-item-has-children:after { color: ' . sanitize_hex_color( $header_menu_color ) . ' }';
	}
	if ( $header_border_color !== '#f1f1f1' ) {
		$css = '.logo-center .main-navigation { border-color: ' . sanitize_hex_color( $header_border_color ) . ' }';
	}

	// Print the custom style
	wp_add_inline_style( 'velove-style', $css );

}
add_action( 'wp_enqueue_scripts', 'velove_custom_styles' );

/**
 * Custom RSS feed url.
 */
function velove_custom_rss_url( $output, $feed ) {

	// Get the custom rss feed url
	$url = get_theme_mod( 'velove_custom_rss' );

	// Do not redirect comments feed
	if ( strpos( $output, 'comments' ) ) {
		return $output;
	}

	// Check the settings.
	if ( ! empty( $url ) ) {
		$output = esc_url( $url );
	}

	return $output;
}
add_filter( 'feed_link', 'velove_custom_rss_url', 10, 2 );

/**
 * Display theme documentation on customizer page.
 */
function velove_documentation_link() {

	// Enqueue the script
	wp_enqueue_script( 'velove-doc', get_template_directory_uri() . '/assets/js/customizer/doc.js', array(), '1.0.0', true );

	// Localize the script
	wp_localize_script( 'velove-doc', 'prefixL10n',
		array(
			'prefixURL'   => esc_url( 'http://docs.6hourcreative.com/velove/' ),
			'prefixLabel' => esc_html__( 'Documentation', 'velove' ),
		)
	);

}
add_action( 'customize_controls_enqueue_scripts', 'velove_documentation_link' );

/**
 * Render the site title for the selective refresh partial.
 *
 * Taken from Twenty Sixteen 1.2
 */
function velove_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Sanitize the checkbox.
 *
 * @param boolean $input.
 * @return boolean (true|false).
 */
function velove_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Sanitize the Footer Credits
 */
function velove_sanitize_textarea( $text ) {
	if ( current_user_can( 'unfiltered_html' ) ) {
		$text = $text;
	} else {
		$text = wp_kses_post( $text );
	}
	return $text;
}

/**
 * Sanitize the Grid Thumbnail Aspect Ratio value.
 */
function velove_sanitize_thumbnail_style( $ratio ) {
	if ( ! in_array( $ratio, array( 'landscape', 'square' ) ) ) {
		$ratio = 'landscape';
	}
	return $ratio;
}

/**
 * Sanitize the Top Bar style value.
 */
function velove_sanitize_topbar_style( $style ) {
	if ( ! in_array( $style, array( 'left_info', 'right_info' ) ) ) {
		$style = 'left_info';
	}
	return $style;
}

/**
 * Sanitize the Header style value.
 */
function velove_sanitize_header_style( $style ) {
	if ( ! in_array( $style, array( 'left', 'right', 'center' ) ) ) {
		$style = 'left';
	}
	return $style;
}
