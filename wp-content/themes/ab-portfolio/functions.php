<?php

/**
 * my-portfolio functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package AB_Portfolio
 */

if (! defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function my_portfolio_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on my-portfolio, use a find and replace
		* to change 'my-portfolio' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('my-portfolio', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'my-portfolio'),
			'menu-2' => esc_html__('Header Right', 'my-portfolio'),
			'menu-3' => esc_html__('Footer Menu1', 'my-portfolio'),
			'menu-4' => esc_html__('Footer Menu2', 'my-portfolio'),
			'menu-5' => esc_html__('Footer Menu3', 'my-portfolio'),
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

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'my_portfolio_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'my_portfolio_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function my_portfolio_content_width()
{
	$GLOBALS['content_width'] = apply_filters('my_portfolio_content_width', 640);
}
add_action('after_setup_theme', 'my_portfolio_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function my_portfolio_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar One', 'my-portfolio'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'my-portfolio'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar Two', 'my-portfolio'),
			'id'            => 'sidebar-2',
			'description'   => esc_html__('Add widgets here.', 'my-portfolio'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar Three', 'my-portfolio'),
			'id'            => 'sidebar-3',
			'description'   => esc_html__('Add widgets here.', 'my-portfolio'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'my_portfolio_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function my_portfolio_scripts()
{
	wp_enqueue_style('my-portfolio-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('my-portfolio-style', 'rtl', 'replace');

	wp_enqueue_script('my-portfolio-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'my_portfolio_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Functions which includes post loops to enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/post-loop.php';

//Code for SVG support in wordpress
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
	$filetype = wp_check_filetype($filename, $mimes);
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
}
add_action('admin_head', 'fix_svg');



/**
 * Bootstrap Navwalker
 **/
function register_navwalker()
{
	if (!file_exists(get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php')) {
		// File does not exist... return an error.
		return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
	} else {
		// File exists... require it.
		require_once get_template_directory() . '/classes/class-wp-bootstrap-navwalker.php';
	}
}
add_action('after_setup_theme', 'register_navwalker');


/**
 * Comments Walker
 **/
function register_commentwalker()
{
	if (!file_exists(get_template_directory() . '/classes/class-twentytwenty-walker-comment.php')) {
		// File does not exist... return an error.
		return new WP_Error('class-twentytwenty-walker-comment-missing', __('It appears the class-twentytwenty-walker-comment.php file may be missing.', 'wp-comment-walker'));
	} else {
		// File exists... require it.
		require_once get_template_directory() . '/classes/class-twentytwenty-walker-comment.php';
	}
}
add_action('after_setup_theme', 'register_commentwalker');


function stop_self_ping(&$links)
{
	$home = get_option('home');
	foreach ($links as $l => $link) {
		if (0 === strpos($link, $home)) {
			unset($links[$l]);
		}
	}
}

add_action('pre_ping', 'stop_self_ping');

/**
 * Custom Login Logo
 */
function mp_login_logo()
{
	echo 	'<style type="text/css">
				h1 a {background-image: url(https://dev5.myvtd.site/keya-leggings/wp-content/uploads/2024/06/logo.png) !important; }
			</style>';
}
add_action('login_head', 'mp_login_logo');
