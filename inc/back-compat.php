<?php

/**
 * Velove back compat functionality
 *
 * Prevents Velove from running on WordPress versions prior to 4.7,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.7.
 */

/**
 * Prevent switching to Velove on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Velove 1.0.0
 */
function velove_switch_theme() {
    switch_theme(WP_DEFAULT_THEME);
    unset($_GET['activated']);
    add_action('admin_notices', 'velove_upgrade_notice');
}
add_action('after_switch_theme', 'velove_switch_theme');

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Velove on WordPress versions prior to 4.7.
 *
 * @since Velove 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function velove_upgrade_notice() {
    $message = sprintf(__('Velove requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'velove'), $GLOBALS['wp_version']);
    printf('<div class="error"><p>%s</p></div>', $message);
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 4.7.
 *
 * @since Velove 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function velove_customize() {
    wp_die(
        sprintf(
            __('Velove requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'velove'),
            $GLOBALS['wp_version']
        ),
        '',
        array(
            'back_link' => true,
        )
    );
}
add_action('load-customize.php', 'velove_customize');

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 4.7.
 *
 * @since Velove 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function velove_preview() {
    if (isset($_GET['preview'])) {
        wp_die(sprintf(__('Velove requires at least WordPress version 4.7. You are running version %s. Please upgrade and try again.', 'velove'), $GLOBALS['wp_version']));
    }
}
add_action('template_redirect', 'velove_preview');
