<?php
/**
 * Featured Posts Customizer
 */

/**
 * Register the customizer.
 */
function velove_featured_posts_customize_register( $wp_customize ) {

	// Register new section: Featured Posts
	$wp_customize->add_section( 'velove_featured_posts' , array(
		'title'       => esc_html__( 'Featured Posts', 'velove' ),
		'description'    => sprintf( __( 'Use a <a href="%1$s">tag</a> to feature your posts. If no posts match the tag, <a href="%2$s">sticky posts</a> will be displayed instead.', 'velove' ),
				esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'velove' ), admin_url( 'edit.php' ) ) ),
				admin_url( 'edit.php?show_sticky=1' )
			),
		'panel'       => 'velove_options',
		'priority'    => 11
	) );

	// Register enable featured posts setting
	$wp_customize->add_setting( 'velove_featured_posts_enable', array(
		'default'           => 1,
		'sanitize_callback' => 'velove_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'velove_featured_posts_enable', array(
		'label'             => esc_html__( 'Show featured posts', 'velove' ),
		'section'           => 'velove_featured_posts',
		'priority'          => 1,
		'type'              => 'checkbox'
	) );

	// Register title setting
	$wp_customize->add_setting( 'velove_featured_posts_title', array(
		'default'           => esc_html__( 'Featured', 'velove' ),
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'velove_featured_posts_title', array(
		'label'             => esc_html__( 'Title', 'velove' ),
		'section'           => 'velove_featured_posts',
		'priority'          => 3,
		'type'              => 'text'
	) );
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'velove_featured_posts_title', array(
			'selector'         => '.featured-title',
			'settings'         => array( 'velove_featured_posts_title' ),
			'render_callback'  => 'velove_customize_partial_featured_title'
		) );
	}

	// Register query setting
	$wp_customize->add_setting( 'velove_featured_posts_tag', array(
		'default'           => 'featured',
		'sanitize_callback' => 'esc_attr',
	) );
	$wp_customize->add_control( 'velove_featured_posts_tag', array(
		'label'             => esc_html__( 'Tag Name', 'velove' ),
		'section'           => 'velove_featured_posts',
		'priority'          => 5,
		'type'              => 'text'
	) );

}
add_action( 'customize_register', 'velove_featured_posts_customize_register' );

/**
 * Title callback
 */
function velove_customize_partial_featured_title() {
	return esc_attr( get_theme_mod( 'velove_featured_posts_title' ) );
}
