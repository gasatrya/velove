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

	// Register Custom RSS setting
	$wp_customize->add_setting( 'velove_custom_rss', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'velove_custom_rss', array(
		'label'             => esc_html__( 'Custom RSS', 'velove' ),
		'description'       => esc_html__( 'If you use 3rd party RSS service, place the URL here to change the default WordPress RSS URL.', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 1,
		'type'              => 'url'
	) );

	// Register Thumbnail Aspect Ratio setting
	$wp_customize->add_setting( 'velove_thumbnail_style', array(
		'default'           => 'landscape',
		'sanitize_callback' => 'velove_sanitize_thumbnail_style',
	) );
	$wp_customize->add_control( 'velove_thumbnail_style', array(
		'label'             => esc_html__( 'Thumbnail Aspect Ratio', 'velove' ),
		'description'       => esc_html__( 'Applied to front-page and grid page template.', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 3,
		'type'              => 'radio',
		'choices'           => array(
			'landscape' => esc_html__( 'Landscape (4:3)', 'velove' ),
			'square'    => esc_html__( 'Square (1:1)', 'velove' ),
		)
	) );

	// Register Page comment manager setting
	$wp_customize->add_setting( 'velove_page_comment', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_page_comment', array(
		'label'             => esc_html__( 'Pages: Enable comment on Pages', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 5,
		'type'              => 'checkbox'
	) );

	// Register Page featured image setting
	$wp_customize->add_setting( 'velove_page_featured_image', array(
		'default'           => 0,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_page_featured_image', array(
		'label'             => esc_html__( 'Pages: Show page featured image', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 9,
		'type'              => 'checkbox'
	) );

	// Register Post comment manager setting
	$wp_customize->add_setting( 'velove_post_comment', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_post_comment', array(
		'label'             => esc_html__( 'Posts: Enable comment on Posts', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 11,
		'type'              => 'checkbox'
	) );

	// Register Author Box setting
	$wp_customize->add_setting( 'velove_author_box', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_author_box', array(
		'label'             => esc_html__( 'Posts: Show author box', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 13,
		'type'              => 'checkbox'
	) );

	// Register Next & Prev post setting
	$wp_customize->add_setting( 'velove_next_prev_post', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_next_prev_post', array(
		'label'             => esc_html__( 'Posts: Show next & prev post', 'velove' ),
		'section'           => 'velove_general',
		'priority'          => 15,
		'type'              => 'checkbox'
	) );

}
add_action( 'customize_register', 'velove_general_customize_register' );
