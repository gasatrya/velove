<?php
/**
 * Most Posts Customizer
 */

/**
 * Register the customizer.
 */
function velove_most_posts_customize_register( $wp_customize ) {

	// Register new section: Most Posts
	$wp_customize->add_section( 'velove_most_posts' , array(
		'title'       => esc_html__( 'Most Posts', 'velove' ),
		'description' => esc_html__( 'Most posts is a list of posts appear on the footer of your site.', 'velove' ),
		'panel'       => 'velove_options',
		'priority'    => 9
	) );

	// Register enable most posts setting
	$wp_customize->add_setting( 'velove_most_posts_enable', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_most_posts_enable', array(
		'label'             => esc_html__( 'Show most posts', 'velove' ),
		'section'           => 'velove_most_posts',
		'priority'          => 1,
		'type'              => 'checkbox'
	) );

	// Register title setting
	$wp_customize->add_setting( 'velove_most_posts_title', array(
		'default'           => esc_html__( 'Most Loved Posts', 'velove' ),
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'velove_most_posts_title', array(
		'label'             => esc_html__( 'Title', 'velove' ),
		'section'           => 'velove_most_posts',
		'priority'          => 3,
		'type'              => 'text'
	) );
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'velove_most_posts_title', array(
			'selector'         => '.most-content-title',
			'settings'         => array( 'velove_most_posts_title' ),
			'render_callback'  => function() {
				return '<span>' . esc_attr( get_theme_mod( 'velove_most_posts_title' ) ) . '</span>';
			}
		) );
	}

	// Register query setting
	$wp_customize->add_setting( 'velove_most_posts_query', array(
		'default'           => 'loved',
		'sanitize_callback' => 'velove_sanitize_most_posts_query',
		'validate_callback' => 'velove_validate_most_posts_query'
	) );
	$wp_customize->add_control( 'velove_most_posts_query', array(
		'label'             => esc_html__( 'Query', 'velove' ),
		'section'           => 'velove_most_posts',
		'priority'          => 5,
		'type'              => 'radio',
		'choices'           => array(
			'loved'   => esc_html__( 'Most loved', 'velove' ),
			'recent'  => esc_html__( 'Most recent', 'velove' ),
			'popular' => esc_html__( 'Popular by comment', 'velove' ),
			'random'  => esc_html__( 'Random', 'velove' )
		)
	) );

	// Register number setting
	$wp_customize->add_setting( 'velove_most_posts_number', array(
		'default'           => 3,
		'sanitize_callback' => 'absint',
	) );
	$wp_customize->add_control( 'velove_most_posts_number', array(
		'label'             => esc_html__( 'Number', 'velove' ),
		'section'           => 'velove_most_posts',
		'priority'          => 7,
		'type'              => 'number',
		'input_attrs'       => array(
			'min'  => 0,
			'step' => 1
		)
	) );

}
add_action( 'customize_register', 'velove_most_posts_customize_register' );
