<?php
/**
 * Header Customizer
 */

/**
 * Register the customizer.
 */
function velove_header_customize_register( $wp_customize ) {

	// Register new section: Header
	$wp_customize->add_section( 'velove_header' , array(
		'title'       => esc_html__( 'Header', 'velove' ),
		'panel'       => 'velove_appearance',
		'priority'    => 7
	) );

	// Register Header Style setting
	$wp_customize->add_setting( 'velove_header_style', array(
		'default'           => 'default',
		'sanitize_callback' => 'velove_sanitize_header_style',
	) );
	$wp_customize->add_control( 'velove_header_style', array(
		'label'             => esc_html__( 'Style', 'velove' ),
		'section'           => 'velove_header',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'default' => esc_html__( 'Default', 'velove' ),
			'style_2' => esc_html__( 'Style 2', 'velove' ),
			'style_3' => esc_html__( 'Style 3', 'velove' ),
		)
	) );

}
add_action( 'customize_register', 'velove_header_customize_register' );
