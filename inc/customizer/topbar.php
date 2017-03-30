<?php
/**
 * Top bar Customizer
 */

/**
 * Register the customizer.
 */
function velove_topbar_customize_register( $wp_customize ) {

	// Register new section: Top Bar
	$wp_customize->add_section( 'velove_topbar' , array(
		'title'       => esc_html__( 'Top Bar', 'velove' ),
		'description' => esc_html__( 'Please note, the social links are a Custom menu. Please read the documentation for more details.', 'velove' ),
		'panel'       => 'velove_options',
		'priority'    => 5
	) );

	// Register Top Bar enable/disable setting
	$wp_customize->add_setting( 'velove_topbar_enable', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_topbar_enable', array(
		'label'             => esc_html__( 'Show top bar', 'velove' ),
		'section'           => 'velove_topbar',
		'priority'          => 1,
		'type'              => 'checkbox'
	) );

	// Register Phone setting
	$wp_customize->add_setting( 'velove_topbar_tel', array(
		'default'           => '1800-222-222',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
	) );
	$wp_customize->add_control( 'velove_topbar_tel', array(
		'label'             => esc_html__( 'Phone', 'velove' ),
		'section'           => 'velove_topbar',
		'priority'          => 3,
		'type'              => 'tel'
	) );

	// Register Email setting
	$wp_customize->add_setting( 'velove_topbar_email', array(
		'default'           => 'support@domain.com',
		'sanitize_callback' => 'sanitize_email',
		'transport'         => 'postMessage'
	) );
	$wp_customize->add_control( 'velove_topbar_email', array(
		'label'             => esc_html__( 'Email', 'velove' ),
		'section'           => 'velove_topbar',
		'priority'          => 5,
		'type'              => 'email'
	) );

	// Register Hours setting
	$wp_customize->add_setting( 'velove_topbar_hours', array(
		'default'           => 'Mon - Fri : 09:00 - 17:00',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage'
	) );
	$wp_customize->add_control( 'velove_topbar_hours', array(
		'label'             => esc_html__( 'Hours', 'velove' ),
		'section'           => 'velove_topbar',
		'priority'          => 7,
		'type'              => 'text'
	) );

	// Register Style setting
	$wp_customize->add_setting( 'velove_topbar_style', array(
		'default'           => 'left_info',
		'sanitize_callback' => 'velove_sanitize_topbar_style',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'velove_topbar_style', array(
		'label'             => esc_html__( 'Style', 'velove' ),
		'section'           => 'velove_topbar',
		'priority'          => 9,
		'type'              => 'radio',
		'choices'           => array(
			'left_info'  => esc_html__( 'Left info / Right social', 'velove' ),
			'right_info' => esc_html__( 'Right info / Left social', 'velove' ),
		)
	) );

	// Register Background Color setting
	$wp_customize->add_setting( 'velove_topbar_bg', array(
		'default'           => '#fafafa',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'velove_topbar_bg', array(
		'label'             => esc_html__( 'Background', 'velove' ),
		'section'           => 'velove_topbar',
		'priority'          => 11
	) ) );

	// Register Color setting
	$wp_customize->add_setting( 'velove_topbar_color', array(
		'default'           => '#8d8e8f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'velove_topbar_color', array(
		'label'             => esc_html__( 'Color', 'velove' ),
		'section'           => 'velove_topbar',
		'priority'          => 13
	) ) );

	// Register Social Color setting
	$wp_customize->add_setting( 'velove_topbar_social_color', array(
		'default'           => '#8d8e8f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'velove_topbar_social_color', array(
		'label'             => esc_html__( 'Social Links Color', 'velove' ),
		'section'           => 'velove_topbar',
		'priority'          => 15
	) ) );

}
add_action( 'customize_register', 'velove_topbar_customize_register' );

/**
 * Enable selective refresh
 */
function velove_topbar_selective_refresh( WP_Customize_Manager $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	// Phone
	$wp_customize->selective_refresh->add_partial( 'velove_topbar_tel', array(
		'selector'            => '.phone',
		'render_callback'     => 'velove_customize_partial_topbar_tel'
	) );

	// Email
	$wp_customize->selective_refresh->add_partial( 'velove_topbar_email', array(
		'selector'            => '.email',
		'render_callback'     => 'velove_customize_partial_topbar_email'
	) );

	// Hours
	$wp_customize->selective_refresh->add_partial( 'velove_topbar_hours', array(
		'selector'            => '.hours',
		'render_callback'     => 'velove_customize_partial_topbar_hours'
	) );

}
add_action( 'customize_register', 'velove_topbar_selective_refresh' );

/**
 * Render the Phone number for the selective refresh partial.
 */
function velove_customize_partial_topbar_tel() {
	return '<i class="fa fa-phone"></i>' . sanitize_text_field( get_theme_mod( 'velove_topbar_tel' ) );
}

/**
 * Render the Email for the selective refresh partial.
 */
function velove_customize_partial_topbar_email() {
	return '<i class="fa fa-envelope"></i>' . sanitize_email( get_theme_mod( 'velove_topbar_email' ) );
}

/**
 * Render the Hours for the selective refresh partial.
 */
function velove_customize_partial_topbar_hours() {
	return '<i class="fa fa-clock-o"></i>' . sanitize_text_field( get_theme_mod( 'velove_topbar_hours' ) );
}
