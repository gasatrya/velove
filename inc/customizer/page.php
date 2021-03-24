<?php

/**
 * Page Customizer
 */

/**
 * Register the customizer.
 */
function velove_page_customize_register($wp_customize) {

    // Register new section: Page
    $wp_customize->add_section('velove_page', array(
        'title'       => esc_html__('Pages', 'velove'),
        'description' => esc_html__('These options is used for customizing the single page.', 'velove'),
        'panel'       => 'velove_options',
        'priority'    => 7
    ));

    // Register page thumbnail setting
    $wp_customize->add_setting('velove_page_thumbnail', array(
        'default'           => 0,
        'sanitize_callback' => 'velove_sanitize_checkbox',
    ));
    $wp_customize->add_control('velove_page_thumbnail', array(
        'label'             => esc_html__('Show page thumbnail', 'velove'),
        'section'           => 'velove_page',
        'priority'          => 3,
        'type'              => 'checkbox'
    ));

    // Register page comment manager setting
    $wp_customize->add_setting('velove_page_comment', array(
        'default'           => 1,
        'sanitize_callback' => 'velove_sanitize_checkbox',
    ));
    $wp_customize->add_control('velove_page_comment', array(
        'label'             => esc_html__('Enable comment on Pages', 'velove'),
        'section'           => 'velove_page',
        'priority'          => 5,
        'type'              => 'checkbox'
    ));
}
add_action('customize_register', 'velove_page_customize_register');
