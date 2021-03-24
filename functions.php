<?php

/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 */

/**
 * Outbuilt only works in WordPress 4.7 or later.
 */
if (version_compare($GLOBALS['wp_version'], '4.7', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function velove_theme_setup() {

    // Make the theme available for translation.
    load_theme_textdomain('velove', trailingslashit(get_template_directory()) . 'languages');

    // Add RSS feed links to <head> for posts and comments.
    add_theme_support('automatic-feed-links');

    /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails.
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1170, 9999);

    // Declare image sizes.
    add_image_size('velove-featured', 600, 480, true);
    add_image_size('velove-post', 698, 479, true);
    add_image_size('velove-post-small', 700, 500, true);
    add_image_size('velove-post-full', 1078, 479, true);
    add_image_size('velove-most', 318, 360, true);
    add_image_size('velove-archive', 700, 9999);

    // Register custom navigation menu.
    register_nav_menus(
        array(
            'primary'  => esc_html__('Primary Location', 'velove'),
            'social'   => esc_html__('Social Links', 'velove')
        )
    );

    /*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Setup the WordPress core custom background feature.
    add_theme_support('custom-background', apply_filters('velove_custom_background_args', array(
        'default-color' => 'f5f5f5'
    )));

    // Enable support for Custom Logo
    add_theme_support('custom-logo', array(
        'height'      => 150,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // This theme uses its own gallery styles.
    add_filter('use_default_gallery_style', '__return_false');

    // Indicate widget sidebars can use selective refresh in the Customizer.
    add_theme_support('customize-selective-refresh-widgets');

    // Enable layouts extensions.
    add_theme_support(
        'theme-layouts',
        array(
            'full-width'        => esc_html__('Full width', 'velove'),
            'full-width-narrow' => esc_html__('Full width narrow', 'velove'),
            'right-sidebar'     => esc_html__('Right sidebar', 'velove'),
            'left-sidebar'      => esc_html__('Left sidebar', 'velove')
        ),
        array('customize' => true, 'default' => 'right-sidebar')
    );

    // Adding support for core block visual styles.
    add_theme_support('wp-block-styles');

    // Add support for editor styles.
    add_theme_support('editor-styles');
    add_editor_style('style-editor.css');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');

    // Add support for custom color scheme.
    add_theme_support('editor-color-palette');

    // Add support for custom font sizes.
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'velove'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__('Normal', 'velove'),
            'size' => 16,
            'slug' => 'normal'
        ),
        array(
            'name' => esc_html__('Medium', 'velove'),
            'size' => 24,
            'slug' => 'medium'
        ),
        array(
            'name' => esc_html__('Large', 'velove'),
            'size' => 36,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__('Huge', 'velove'),
            'size' => 48,
            'slug' => 'huge'
        )
    ));
}
add_action('after_setup_theme', 'velove_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function velove_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('velove_content_width', 730);
}
add_action('after_setup_theme', 'velove_content_width', 0);

/**
 * Sets custom content width when current layout is full-width
 */
if (!function_exists('velove_fullwidth_content_width')) :

    function velove_fullwidth_content_width() {
        global $content_width;

        if (current_theme_supports('theme-layouts')) {
            if (in_array(get_theme_mod('theme_layout'), array('full-width'))) {
                $content_width = 1015;
            }
        }
    }

endif;
add_action('template_redirect', 'velove_fullwidth_content_width');

/**
 * Registers custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function velove_widgets_init() {

    // Register recent posts thumbnail widget.
    require trailingslashit(get_template_directory()) . 'inc/widgets/widget-recent.php';
    register_widget('Velove_Recent_Widget');

    // Register popular posts thumbnail widget.
    require trailingslashit(get_template_directory()) . 'inc/widgets/widget-popular.php';
    register_widget('Velove_Popular_Widget');

    // Register random posts thumbnail widget.
    require trailingslashit(get_template_directory()) . 'inc/widgets/widget-random.php';
    register_widget('Velove_Random_Widget');
}
add_action('widgets_init', 'velove_widgets_init');

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function velove_sidebars_init() {

    register_sidebar(
        array(
            'name'          => esc_html__('Primary', 'velove'),
            'id'            => 'primary',
            'description'   => esc_html__('Main sidebar that appears on the right.', 'velove'),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__('Instagram', 'velove'),
            'id'            => 'instagram',
            'description'   => esc_html__('Instagram section that appears on footer.', 'velove'),
            'before_widget' => '<div id="%1$s" class="instagram-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="instagram-title"><span>',
            'after_title'   => '</span></h3>',
        )
    );
}
add_action('widgets_init', 'velove_sidebars_init');

/**
 * Register Google fonts.
 */
function velove_fonts_url() {

    // Get the customizer data
    $heading_font = get_theme_mod('velove_heading_font', 'Playfair+Display:700,900');
    $body_font    = get_theme_mod('velove_body_font', 'Source+Sans+Pro:400,400i,600,700,700i,900');

    // Important variable
    $fonts_url = '';
    $fonts     = array();

    if ($heading_font) {
        $fonts[]   = esc_attr(str_replace('+', ' ', $heading_font));
    }

    if ($body_font) {
        $fonts[]   = esc_attr(str_replace('+', ' ', $body_font));
    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
        ), 'https://fonts.googleapis.com/css');
    }

    return $fonts_url;
}

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Enqueue scripts and styles.
require get_template_directory() . '/inc/scripts.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

// Require and recommended plugins list.
require get_template_directory() . '/inc/plugins.php';

// Customizer.
require get_template_directory() . '/inc/customizer.php';

// Load Jetpack compatibility file.
require get_template_directory() . '/inc/jetpack.php';

// Custom color adjuster function.
require get_template_directory() . '/inc/extensions/simple-color-adjuster.php';

// Layouts meta box.
require get_template_directory() . '/inc/extensions/layouts.php';
