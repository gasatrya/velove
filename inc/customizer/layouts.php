<?php
/**
 * Layouts Customizer
 */

/**
 * Register the customizer.
 */
function velove_layouts_customize_register( $wp_customize ) {

	// Register new section: Layouts
	$wp_customize->add_section( 'velove_layouts' , array(
		'title'       => esc_html__( 'Layouts', 'velove' ),
		'panel'       => 'velove_appearance',
		'priority'    => 5
	) );

	// Register blog layouts setting
	$wp_customize->add_setting( 'velove_blog_layouts', array(
		'default'           => 'default',
		'sanitize_callback' => 'velove_sanitize_blog_layouts',
	) );
	$wp_customize->add_control( 'velove_blog_layouts', array(
		'label'             => esc_html__( 'Blog Layout', 'velove' ),
		'section'           => 'velove_layouts',
		'priority'          => 1,
		'type'              => 'radio',
		'choices'           => array(
			'default'           => esc_html__( 'Standard right sidebar', 'velove' ),
			'left-sidebar'      => esc_html__( 'Standard left sidebar', 'velove' ),
			'full-width'        => esc_html__( 'Standard full width', 'velove' ),
			'full-width-narrow' => esc_html__( 'Standard full width narrow', 'velove' ),
			'grid-two'          => esc_html__( 'Grid two columns', 'velove' ),
		)
	) );

}
add_action( 'customize_register', 'velove_layouts_customize_register' );
