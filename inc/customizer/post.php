<?php
/**
 * Post Customizer
 */

/**
 * Register the customizer.
 */
function velove_post_customize_register( $wp_customize ) {

	// Register new section: Post
	$wp_customize->add_section( 'velove_post' , array(
		'title'       => esc_html__( 'Posts', 'velove' ),
		'description' => esc_html__( 'These options is used for customizing the single post.', 'velove' ),
		'panel'       => 'velove_options',
		'priority'    => 5
	) );

	// Register post thumbnail setting
	$wp_customize->add_setting( 'velove_post_thumbnail', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_post_thumbnail', array(
		'label'             => esc_html__( 'Show post thumbnail', 'velove' ),
		'section'           => 'velove_post',
		'priority'          => 1,
		'type'              => 'checkbox'
	) );

	// Register post meta setting
	$wp_customize->add_setting( 'velove_post_meta', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'velove_post_meta', array(
		'label'             => esc_html__( 'Show post meta', 'velove' ),
		'section'           => 'velove_post',
		'priority'          => 3,
		'type'              => 'checkbox'
	) );

	// Register post tags setting
	$wp_customize->add_setting( 'velove_post_tags', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_post_tags', array(
		'label'             => esc_html__( 'Show post tags', 'velove' ),
		'section'           => 'velove_post',
		'priority'          => 5,
		'type'              => 'checkbox'
	) );

	// Register author box setting
	$wp_customize->add_setting( 'velove_author_box', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_author_box', array(
		'label'             => esc_html__( 'Show author box', 'velove' ),
		'section'           => 'velove_post',
		'priority'          => 7,
		'type'              => 'checkbox'
	) );

	// Register next & prev post setting
	$wp_customize->add_setting( 'velove_next_prev_post', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_next_prev_post', array(
		'label'             => esc_html__( 'Show next & prev post', 'velove' ),
		'section'           => 'velove_post',
		'priority'          => 9,
		'type'              => 'checkbox'
	) );

	// Register post comment manager setting
	$wp_customize->add_setting( 'velove_post_comment', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_post_comment', array(
		'label'             => esc_html__( 'Enable comment on Posts', 'velove' ),
		'section'           => 'velove_post',
		'priority'          => 11,
		'type'              => 'checkbox'
	) );

}
add_action( 'customize_register', 'velove_post_customize_register' );
