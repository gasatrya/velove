<?php
/**
 * Enqueue scripts and styles.
 */

/**
 * Loads the theme styles & scripts.
 */
function velove_enqueue() {

	// Load plugins stylesheet
	wp_enqueue_style( 'velove-plugins-style', trailingslashit( get_template_directory_uri() ) . 'assets/css/plugins.min.css' );

	// Fonts
	wp_enqueue_style( 'velove-fonts', velove_fonts_url() );

	// if WP_DEBUG and/or SCRIPT_DEBUG turned on, load the unminified styles & script.
	if ( ! is_child_theme() && WP_DEBUG || SCRIPT_DEBUG ) {

		// Load main stylesheet
		wp_enqueue_style( 'velove-style', get_stylesheet_uri() );

		// Load custom js plugins.
		wp_enqueue_script( 'velove-plugins', trailingslashit( get_template_directory_uri() ) . 'assets/js/plugins.min.js', array( 'jquery' ), null, true );

		// Load custom js methods.
		wp_enqueue_script( 'velove-main', trailingslashit( get_template_directory_uri() ) . 'assets/js/main.js', array( 'jquery' ), null, true );

	} else {

		// Load main stylesheet
		wp_enqueue_style( 'velove-style', trailingslashit( get_template_directory_uri() ) . 'style.min.css' );

		// Load custom js plugins.
		wp_enqueue_script( 'velove-scripts', trailingslashit( get_template_directory_uri() ) . 'assets/js/velove.min.js', array( 'jquery' ), null, true );

	}

	/**
	 * js / no-js script.
	 *
	 * @copyright http://www.paulirish.com/2009/avoiding-the-fouc-v3/
	 */
	wp_add_inline_script( $script_handle, "document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/,'js');" );

	// If child theme is active, load the stylesheet.
	if ( is_child_theme() ) {
		wp_enqueue_style( 'velove-child-style', get_stylesheet_uri() );
	}

	// Load comment-reply script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Loads HTML5 Shiv
	wp_enqueue_script( 'velove-html5', trailingslashit( get_template_directory_uri() ) . 'assets/js/html5shiv.min.js', array( 'jquery' ), null, false );
	wp_script_add_data( 'velove-html5', 'conditional', 'lte IE 9' );

	// Fontello for IE7
	wp_enqueue_style( 'velove-fontello', trailingslashit( get_template_directory_uri() ) . 'assets/css/fontello-ie7.css' );
	wp_style_add_data( 'velove-fontello', 'conditional', 'IE 7' );

}
add_action( 'wp_enqueue_scripts', 'velove_enqueue' );
