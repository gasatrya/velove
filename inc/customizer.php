<?php

/**
 * Velove Theme Customizer
 */

// Loads custom control
require trailingslashit(get_template_directory()) . 'inc/customizer/controls/control-group-title.php';

// Loads the customizer settings
require trailingslashit(get_template_directory()) . 'inc/customizer/colors.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/header.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/fonts.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/layouts.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/general.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/post.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/page.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/most-posts.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/featured-posts.php';
require trailingslashit(get_template_directory()) . 'inc/customizer/retina-logo.php';

/**
 * Custom customizer functions.
 */
function velove_customize_functions($wp_customize) {

    // Register new panel: Appearance
    $wp_customize->add_panel('velove_appearance', array(
        'title'       => esc_html__('Appearance', 'velove'),
        'priority'    => 145,
    ));

    // Register new panel: Theme Options
    $wp_customize->add_panel('velove_options', array(
        'title'       => esc_html__('Theme Options', 'velove'),
        'description' => esc_html__('This panel is used for customizing the Velove theme.', 'velove'),
        'priority'    => 150,
    ));

    // Live preview of Site Title and Description
    $wp_customize->get_setting('blogname')->transport        = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    // Enable selective refresh to the Site Title
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'         => '.site-title a',
            'render_callback' => 'velove_customize_partial_blogname',
        ));
    }

    // Enable selective refresh to the Site Description
    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'         => '.site-description',
            'render_callback'  => 'velove_customize_partial_blogdescription',
        ));
    }

    // Move the Colors section.
    $wp_customize->get_section('colors')->panel    = 'velove_appearance';
    $wp_customize->get_section('colors')->priority = 1;

    // Move the Theme Layout section.
    $wp_customize->get_control('theme-layout-control')->section    = 'velove_layouts';
    $wp_customize->get_control('theme-layout-control')->priority = 3;
    $wp_customize->get_control('theme-layout-control')->active_callback = 'velove_customize_partial_layout';

    // Move the Background Image section.
    $wp_customize->get_section('background_image')->panel    = 'velove_appearance';
    $wp_customize->get_section('background_image')->priority = 7;

    // Move the Additional CSS section.
    $wp_customize->get_section('custom_css')->panel    = 'velove_appearance';
    $wp_customize->get_section('custom_css')->priority = 11;

    // Move background color to background image section.
    $wp_customize->get_section('background_image')->title = esc_html__('Background', 'velove');
    $wp_customize->get_control('background_color')->section = 'background_image';

    // Change the color section description.
    $wp_customize->get_section('colors')->description = esc_html__('If you don\'t like the predefined colors, you can choose the color you want from the color picker.', 'velove');

    // Move the header image to header section
    $wp_customize->get_control('header_image')->section  = 'velove_header';
    $wp_customize->get_control('header_image')->priority = 3;
}
add_action('customize_register', 'velove_customize_functions', 99);

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function velove_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function velove_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Show option with conditional.
 *
 * @return void
 */
function velove_customize_partial_layout() {
    return is_page() || is_single();
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function velove_customize_preview_js() {
    wp_enqueue_script('velove-customizer', get_template_directory_uri() . '/assets/js/customizer/customizer.js', array('customize-preview', 'jquery'));
}
add_action('customize_preview_init', 'velove_customize_preview_js');

/**
 * Custom styles.
 */
function velove_custom_css() {

    // Set up empty variable.
    $css = '';

    // Get the customizer value.
    $color        = get_theme_mod('velove_accent_color', '#fbf1eb');
    $heading_font = get_theme_mod('velove_heading_font_family', '\'Playfair Display\', serif');
    $body_font    = get_theme_mod('velove_body_font_family', '\'Source Sans Pro\', sans-serif');

    // Adjust color.
    $simple_color_adjuster = new Simple_Color_Adjuster;
    $darken_color = $simple_color_adjuster->darken($color, 15);

    if ($color != '#fbf1eb') {
        $css .= '
		a:hover,
		a:visited:hover,
		.archive .grid .entry-category a,
		.search .grid .entry-category a,
		.archive .grid .entry-meta a:hover,
		.search .grid .entry-meta a:hover,
		.social-links a:hover {
			color: ' . sanitize_hex_color($darken_color) . ';
		}

		.after-header,
		.content .thumbnail-link:hover .entry-title span,
		.widget_tag_cloud a,
		input[type="text"],
		input[type="password"],
		input[type="email"],
		input[type="url"],
		input[type="date"],
		input[type="month"],
		input[type="time"],
		input[type="datetime"],
		input[type="datetime-local"],
		input[type="week"],
		input[type="number"],
		input[type="search"],
		input[type="tel"],
		input[type="color"],
		select,
		textarea,
		.social-links,
		.instagram-widget .instagram-title span,
		.author-bio,
		.tag-links a,
		.comment-reply-link,
		.author-badge,
		.attachment .after-header {
			background-color: ' . sanitize_hex_color($color) . ';
		}

		.widget_tag_cloud a:hover,
		.tag-links a:hover {
			background-color: ' . sanitize_hex_color($darken_color) . ';
			color: #000;
		}

		.menu-primary-items a:hover {
			border-color: ' . sanitize_hex_color($darken_color) . ';
		}

		.widget::before,
		.widget::after,
		input[type="text"]:focus,
		input[type="password"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="week"]:focus,
		input[type="number"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="color"]:focus,
		select:focus,
		textarea:focus,
		.bypostauthor .comment-body .comment-wrapper {
			border-color: ' . sanitize_hex_color($color) . ';
		}
		';
    }

    if ($heading_font != '\'Playfair Display\', serif') {
        $css .= '
			h1, h2, h3, h4, h5, h6 {
				font-family: ' . wp_kses_post($heading_font) . ';
			}
		';
    }

    if ($body_font != '\'Source Sans Pro\', sans-serif') {
        $css .= '
			body, .site-branding .site-description, .featured .featured-title, .widget .widget-title, .most-content .most-content-title, .instagram-widget .instagram-title, .author-bio .name {
				font-family: ' . wp_kses_post($body_font) . ';
			}
		';
    }

    // Print the custom style
    wp_add_inline_style('velove-style', $css);
}
add_action('wp_enqueue_scripts', 'velove_custom_css');

/**
 * Custom RSS feed url.
 */
function velove_custom_rss_url($output, $feed) {

    // Get the custom rss feed url
    $url = get_theme_mod('velove_custom_rss');

    // Do not redirect comments feed
    if (strpos($output, 'comments')) {
        return $output;
    }

    // Check the settings.
    if (!empty($url)) {
        $output = esc_url($url);
    }

    return $output;
}
add_filter('feed_link', 'velove_custom_rss_url', 10, 2);

/**
 * Display theme documentation on customizer page.
 */
function velove_documentation_link() {

    // Enqueue the script
    wp_enqueue_script('velove-doc', get_template_directory_uri() . '/assets/js/customizer/doc.js', array(), '1.0.0', true);

    // Localize the script
    wp_localize_script(
        'velove-doc',
        'prefixL10n',
        array(
            'prefixURL'   => esc_url('https://wp.idenovasi.com/documentation/velove/'),
            'prefixLabel' => esc_html__('Documentation', 'velove'),
        )
    );
}
add_action('customize_controls_enqueue_scripts', 'velove_documentation_link');

/**
 * Sanitize the checkbox.
 */
function velove_sanitize_checkbox($input) {
    if (1 == $input) {
        return true;
    } else {
        return false;
    }
}

/**
 * Sanitize the footer credits value.
 */
function velove_sanitize_textarea($text) {
    if (current_user_can('unfiltered_html')) {
        $text = $text;
    } else {
        $text = wp_kses_post($text);
    }
    return $text;
}

/**
 * Sanitize the pagination type value.
 */
function velove_sanitize_pagination_type($type) {
    if (!in_array($type, array('number', 'traditional'))) {
        $type = 'number';
    }
    return $type;
}

/**
 * Sanitize the container style value.
 */
function velove_sanitize_container_style($style) {
    if (!in_array($style, array('fullwidth', 'boxed', 'framed'))) {
        $style = 'fullwidth';
    }
    return $style;
}

/**
 * Sanitize most posts query value.
 */
function velove_sanitize_most_posts_query($query) {
    if (!in_array($query, array('loved', 'recent', 'popular', 'random'))) {
        $query = 'loved';
    }
    return $query;
}

/**
 * Sanitize predefined color value.
 */
function velove_sanitize_predefined_colors($color) {
    if (!in_array(
        $color,
        array(
            'default',
            'pink',
            'purple',
            'blue',
            'green',
            'yellow',
            'natural',
            'classic-green',
        )
    )) {
        $color = 'default';
    }
    return $color;
}

/**
 * Sanitize header style value.
 */
function velove_sanitize_header_style($style) {
    if (!in_array($style, array('default', 'style_2', 'style_3'))) {
        $style = 'default';
    }
    return $style;
}

/**
 * Sanitize blog layouts value.
 */
function velove_sanitize_blog_layouts($layout) {
    if (!in_array(
        $layout,
        array(
            'default',
            'left-sidebar',
            'full-width',
            'full-width-narrow',
            'grid-two-right-sidebar',
            'grid-two-left-sidebar',
            'grid-three',
            'grid-four',
            'masonry-two-right-sidebar',
            'masonry-two-left-sidebar',
            'masonry-three',
            'masonry-four',
            'list-right-sidebar',
            'list-left-sidebar',
            'list-full-width',
            'list-full-width-narrow',
        )
    )) {
        $layout = 'default';
    }
    return $layout;
}
