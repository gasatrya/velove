<?php
/**
 * General Customizer
 */

/**
 * Register the customizer.
 */
function velove_general_customize_register( $wp_customize ) {

	// Register new section: General
	$wp_customize->add_section( 'velove_general' , array(
		'title'    => esc_html__( 'General', 'velove' ),
		'panel'    => 'velove_options',
		'priority' => 1
	) );

	// Register container setting
	$wp_customize->add_setting( 'velove_container_style', array(
		'default'           => 'fullwidth',
		'sanitize_callback' => 'velove_sanitize_container_style',
	) );
	$wp_customize->add_control( 'velove_container_style', array(
		'label'             => esc_html__( 'Container', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'fullwidth' => esc_html__( 'Full Width', 'velove' ),
			'boxed'     => esc_html__( 'Boxed', 'velove' ),
			'framed'    => esc_html__( 'Framed', 'velove' )
		)
	) );

	// Register pagination setting
	$wp_customize->add_setting( 'velove_posts_pagination', array(
		'default'           => 'number',
		'sanitize_callback' => 'velove_sanitize_pagination_type',
	) );
	$wp_customize->add_control( 'velove_posts_pagination', array(
		'label'             => esc_html__( 'Pagination type', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 3,
		'type'              => 'radio',
		'choices'           => array(
			'number'      => esc_html__( 'Number', 'velove' ),
			'traditional' => esc_html__( 'Older / Newer', 'velove' )
		)
	) );

	// Register custom RSS setting
	$wp_customize->add_setting( 'velove_custom_rss', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'velove_custom_rss', array(
		'label'             => esc_html__( 'Custom RSS', 'velove' ),
		'description'       => esc_html__( 'Replace the default WordPress RSS URL.', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 5,
		'type'              => 'url'
	) );

	// Register footer text setting
	$wp_customize->add_setting( 'velove_footer_text', array(
		'sanitize_callback' => 'velove_sanitize_textarea',
		'default'           => '&copy; Copyright ' . date( 'Y' ) . ' - <a href="' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a>. All Rights Reserved. <br /> Designed & Developed by <a href="https://wp.idenovasi.com/">Idenovasi</a>',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'velove_footer_text', array(
		'label'             => esc_html__( 'Footer Text', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 7,
		'type'              => 'textarea'
	) );
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'velove_footer_text', array(
			'selector'         => '.copyright',
			'settings'         => array( 'velove_footer_text' ),
			'render_callback'  => 'velove_customize_partial_footer_text'
		) );
	}

}
add_action( 'customize_register', 'velove_general_customize_register' );

/**
 * Footer text callback
 */
function velove_customize_partial_footer_text() {
	return velove_sanitize_textarea( get_theme_mod( 'velove_footer_text' ) );
}
