<?php

/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 */

/**
 * Jetpack setup
 */
function velove_jetpack_setup() {

    /**
     * Add theme support for Infinite Scroll.
     * See: http://jetpack.me/support/infinite-scroll/
     */
    add_theme_support('infinite-scroll', array(
        'container'      => 'site-main',
        'footer_widgets' => array(
            'footer-1',
            'footer-2',
            'footer-3'
        ),
        'footer'         => 'page',
    ));

    /**
     * Add theme support for Responsive Videos.
     */
    add_theme_support('jetpack-responsive-videos');
}
add_action('after_setup_theme', 'velove_jetpack_setup');
