<?php
/**
 * Colors Customizer
 */

/**
 * Register the customizer.
 */
function velove_colors_customize_register( $wp_customize ) {

	// Register predefined colors setting
	$wp_customize->add_setting( 'velove_predefined_colors', array(
		'default'           => 'default',
		'sanitize_callback' => 'velove_sanitize_predefined_colors',
	) );
	$wp_customize->add_control( 'velove_predefined_colors', array(
		'label'             => esc_html__( 'Predefined Colors', 'velove' ),
		'section'           => 'colors',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'default' => esc_html__( 'Default', 'velove' ),
			'pink'    => esc_html__( 'Pink Lava', 'velove' ),
			'purple'  => esc_html__( 'Purple Tart', 'velove' ),
			'blue'    => esc_html__( 'Baby Blue', 'velove' ),
			'green'   => esc_html__( 'Fresh Green', 'velove' ),
		)
	) );

	// Register accent color setting
	$wp_customize->add_setting( 'velove_accent_color', array(
		'default'           => '#fbf1eb',
		'sanitize_callback' => 'sanitize_hex_color'
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'velove_accent_color', array(
		'label'             => esc_html__( 'Accent Color', 'velove' ),
		'description'       => esc_html__( 'To get this color picker working, please set the Predefined Colors to &quot;Default&quot;', 'velove' ),
		'section'           => 'colors',
		'priority'          => 3
	) ) );

}
add_action( 'customize_register', 'velove_colors_customize_register' );
