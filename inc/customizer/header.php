<?php
/**
 * Header & Menu Customizer
 */

/**
 * Register the customizer.
 */
function velove_header_customize_register( $wp_customize ) {

	// Register new section: Header
	$wp_customize->add_section( 'velove_header' , array(
		'title'       => esc_html__( 'Header', 'velove' ),
		'panel'       => 'velove_options',
		'priority'    => 7
	) );

	// Register Header Style setting
	$wp_customize->add_setting( 'velove_header_style', array(
		'default'           => 'left',
		'sanitize_callback' => 'velove_sanitize_header_style',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'velove_header_style', array(
		'label'             => esc_html__( 'Style', 'velove' ),
		'section'           => 'velove_header',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'left'   => esc_html__( 'Logo on the left', 'velove' ),
			'center' => esc_html__( 'Logo on the center', 'velove' ),
			'right'  => esc_html__( 'Logo on the right', 'velove' ),
		)
	) );

	// Register Header Background Color setting
	$wp_customize->add_setting( 'velove_header_bg', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'velove_header_bg', array(
		'label'             => esc_html__( 'Background', 'velove' ),
		'section'           => 'velove_header',
		'priority'          => 3
	) ) );

	// Register Header Site Title Color setting
	$wp_customize->add_setting( 'velove_header_title_color', array(
		'default'           => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'velove_header_title_color', array(
		'label'             => esc_html__( 'Color', 'velove' ),
		'description'       => esc_html__( 'Applied to the site title', 'velove' ),
		'section'           => 'velove_header',
		'priority'          => 5
	) ) );

	// Register Menu Color setting
	$wp_customize->add_setting( 'velove_header_menu_color', array(
		'default'           => '#5a5b5c',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'velove_header_menu_color', array(
		'label'             => esc_html__( 'Menu Color', 'velove' ),
		'section'           => 'velove_header',
		'priority'          => 7
	) ) );

	// Register Border Color setting
	$wp_customize->add_setting( 'velove_header_border_color', array(
		'default'           => '#f1f1f1',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'velove_header_border_color', array(
		'label'             => esc_html__( 'Border Color', 'velove' ),
		'section'           => 'velove_header',
		'priority'          => 9
	) ) );

}
add_action( 'customize_register', 'velove_header_customize_register' );
