<?php

/**
 * Functions of the theme
 */

define( 'SETUP_ENV', 'DEVELOPMENT' ); // DEVELOPMENT | PRODUCTION
define( 'DISABLE_JQUERY_MIGRATE', true );
define( 'DISABLE_BLOCK_STYLES', true );
define( 'DISABLE_UNUSED_CF7', true );

if ( ! function_exists( 'psdtheme_setup' ) ) :
	function psdtheme_setup() {

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		//translations
		load_theme_textdomain( 'psdtheme', get_template_directory() . '/languages' );

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 672, 372, true );

		// add_image_size( 'blog_thumb', 279, 245, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary menu', 'psdtheme' ),
			)
		);

		/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
		add_theme_support( 'title-tag' );

	}
endif;
add_action( 'after_setup_theme', 'psdtheme_setup' );
/**********************************************************************/

/**
 * Include scripts and styles
 */
function psdtheme_setup_scripts() {
	$version = wp_get_theme( get_template() )->get( 'Version' );

	$version = time();

	// Load our main stylesheet.
	if ( SETUP_ENV === 'DEVELOPMENT' ) {
		wp_enqueue_style( 'psdtheme-vendor', get_template_directory_uri() . '/assets/public/css/vendor.css', array(), $version );
		wp_enqueue_style( 'psdtheme-main', get_template_directory_uri() . '/assets/public/css/bundle.css', array( 'psdtheme-vendor' ), $version );
	} else {
		wp_enqueue_style( 'psdtheme-vendor', get_template_directory_uri() . '/assets/public/css/vendor.min.css', array(), $version );
		wp_enqueue_style( 'psdtheme-main', get_template_directory_uri() . '/assets/public/css/bundle.min.css', array( 'psdtheme-vendor' ), $version );
	}

	// Load our scripts
	wp_enqueue_script( 'psdtheme-vendor', get_template_directory_uri() . '/assets/public/js/vendor.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'psdtheme-main', get_template_directory_uri() . '/assets/public/js/app.js', array( 'jquery', 'psdtheme-vendor' ), $version, true );


	// Since we use classic editor we don't need gutenberg stuff
	if ( DISABLE_BLOCK_STYLES ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wc-block-vendors-style' );
		wp_dequeue_style( 'wc-block-style' );
	}

	// Remove CF7 styles/scripts on pages without the CF7 shortcode
	if ( defined( 'DISABLE_UNUSED_CF7' ) && DISABLE_UNUSED_CF7 && is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
		global $post; // Ensure the $post variable is available
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'contact-form-7' ) ) {
			// Your code for when CF7 is used in the post
		} else {
			wp_dequeue_style( 'contact-form-7' );
			wp_dequeue_script( 'contact-form-7' );
			wp_dequeue_script( 'google-recaptcha' ); // For CF7 5.1+
			wp_dequeue_script( 'wpcf7-recaptcha' ); // For CF7 5.1+
		}
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'psdtheme_setup_scripts' );
/**********************************************************************/

/**
 * Remove jquery migrate dependancy
 */
function dequeue_jquery_migrate( $scripts ) {
	if ( DISABLE_JQUERY_MIGRATE ) {
		if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
			$scripts->registered['jquery']->deps = array_diff(
				$scripts->registered['jquery']->deps,
				array( 'jquery-migrate' )
			);
		}
	}
}
add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function psdtheme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$content_width = isset( $GLOBALS['content_width'] )
		? (int) $GLOBALS['content_width']
		: 1200;

	$GLOBALS['content_width'] = $content_width;
}
add_action( 'after_setup_theme', 'psdtheme_content_width', 0 );
/**********************************************************************/

/**
 * Options
 */
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page();

	acf_add_options_page(array(
		'page_title' => 'Archive Settings',
		'menu_title' => 'Archive Settings',
		'menu_slug'  => 'theme-archive-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	));

}
/**********************************************************************/

/**
 * Register Sidebars
 */
function psdtheme_widgets_init() {
	// Primary Widget area
	register_sidebar(
		array(
			'name'          => 'Primary Widget Area',
			'id'            => 'primary-widget-area',
			'description'   => 'The primary widget area',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'psdtheme_widgets_init' );


// Remove update notification for custom parent theme
function remove_parent_theme_update_notification() {
	remove_action( 'load-update-core.php', 'wp_update_themes' );
	add_filter( 'pre_site_transient_update_themes', '__return_null' );
}
add_action( 'admin_init', 'remove_parent_theme_update_notification' );

function disable_cruise_archive_redirect() {
    if (is_post_type_archive('cruise')) {
        wp_redirect(home_url('/cruises/'), 301);
        exit;
    }
}
add_action('template_redirect', 'disable_cruise_archive_redirect');
/**********************************************************************/
/* Include the rest of the files here																  */
/**********************************************************************/

require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/cpt.php';
// require_once __DIR__ . '/includes/shortcodes.php';
// require_once __DIR__ . '/includes/ajax-handlers.php';
// require_once __DIR__ . '/includes/misc.php';
