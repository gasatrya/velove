<?php

/**
 * Fonts Customizer
 */

/**
 * Register the customizer.
 */
function velove_fonts_customize_register($wp_customize) {

    // Register new section: Fonts
    $wp_customize->add_section('velove_fonts', array(
        'title'       => esc_html__('Fonts', 'velove'),
        'description' => esc_html__('These options is used for customizing the fonts. The Google Fonts can be found here: https://fonts.google.com/.', 'velove'),
        'panel'       => 'velove_appearance',
        'priority'    => 1
    ));

    // Register heading custom text.
    $wp_customize->add_setting('velove_heading_font_title', array(
        'sanitize_callback' => 'esc_attr'
    ));
    $wp_customize->add_control(new Velove_Group_Title_Control($wp_customize, 'velove_heading_font_title', array(
        'label'             => esc_html__('Heading', 'velove'),
        'section'           => 'velove_fonts',
        'priority'          => 2
    )));

    // Register heading font setting.
    $wp_customize->add_setting('velove_heading_font', array(
        'default'           => 'Playfair+Display:700,900',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('velove_heading_font', array(
        'description'       => esc_html__('Font name/style/sets', 'velove'),
        'section'           => 'velove_fonts',
        'priority'          => 3,
        'type'              => 'text'
    ));

    // Register heading font family setting.
    $wp_customize->add_setting('velove_heading_font_family', array(
        'default'           => '\'Playfair Display\', serif',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('velove_heading_font_family', array(
        'description'       => esc_html__('Font family', 'velove'),
        'section'           => 'velove_fonts',
        'priority'          => 4,
        'type'              => 'text'
    ));

    // Register heading custom text.
    $wp_customize->add_setting('velove_body_font_title', array(
        'sanitize_callback' => 'esc_attr'
    ));
    $wp_customize->add_control(new Velove_Group_Title_Control($wp_customize, 'velove_body_font_title', array(
        'label'             => esc_html__('Body', 'velove'),
        'section'           => 'velove_fonts',
        'priority'          => 5
    )));

    // Register body font setting.
    $wp_customize->add_setting('velove_body_font', array(
        'default'           => 'Source+Sans+Pro:400,400i,600,700,700i,900',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('velove_body_font', array(
        'description'       => esc_html__('Font name/style/sets', 'velove'),
        'section'           => 'velove_fonts',
        'priority'          => 6,
        'type'              => 'text'
    ));

    // Register body font family setting.
    $wp_customize->add_setting('velove_body_font_family', array(
        'default'           => '\'Source Sans Pro\', sans-serif',
        'sanitize_callback' => 'wp_kses_post',
    ));
    $wp_customize->add_control('velove_body_font_family', array(
        'description'       => esc_html__('Font family', 'velove'),
        'section'           => 'velove_fonts',
        'priority'          => 7,
        'type'              => 'text'
    ));
}
add_action('customize_register', 'velove_fonts_customize_register');
