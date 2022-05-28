<?php


if ( ! function_exists( 'flora_ndb_support' ) ) :
	function flora_ndb_support() {

		// Alignwide and alignfull classes in the block editor.
		add_theme_support( 'align-wide' );

		// Add support for experimental link color control.
		add_theme_support( 'experimental-link-color' );

		// Add support for responsive embedded content.
		// https://github.com/WordPress/gutenberg/issues/26901
		add_theme_support( 'responsive-embeds' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for post thumbnails.
		add_theme_support( 'post-thumbnails' );

		// Declare that there are no <title> tags and allow WordPress to provide them
		add_theme_support( 'title-tag' );

		// Experimental support for adding blocks inside nav menus
		add_theme_support( 'block-nav-menus' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );

		remove_theme_support( 'core-block-patterns' );
		add_theme_support( 'wp-block-styles' );

		add_theme_support(
			'html5',
			array(
				'comment-list',
				'comment-form',
				'search-form',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Register two nav menus
		register_nav_menus(
			array(
				'primary' => __( 'Primary Navigation', 'flora_ndb' ),
				'social'  => __( 'Social Navigation', 'flora_ndb' ),
			)
		);

		// Add support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 90,
				'width'       => 90,
				'flex-width'  => true,
				'flex-height' => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'flora_ndb_support', 9 );


/**
 * Custom Post Types
 */

require get_template_directory() . '/inc/custom-types/cpt-produto.php';


function flora_ndb_child_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Area for Widgets', 'twenty-fifteen-child' ),
    'id'            => 'sidebar-area',
    'description'   => __( 'Add widgets here to appear in your footer area.', 'flora_ndb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'flora_ndb_child_widgets_init' );

/**
 *
 * Enqueue scripts and styles.
 */
function flora_ndb_scripts() {
	wp_enqueue_style( 'flora_ndb-style', get_template_directory_uri() . '/assets/css/theme.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script( 'flora_ndb-script', get_template_directory_uri() . '/assets/js/theme.js', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'flora_ndb_scripts' );

/**
 * Styles on Block Editor
 */
function flora_ndb_block_editor_styles() {
	wp_enqueue_style( 'flora_ndb-editor-font', get_template_directory_uri() . '/assets/css/editor.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'flora_ndb-theme-style', get_template_directory_uri() . '/assets/css/theme.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'enqueue_block_editor_assets', 'flora_ndb_block_editor_styles' );
/**
 * Disable the fallback for the core/navigation block.
 */
function flora_ndb_core_navigation_render_fallback() {
	return null;
}
add_filter( 'block_core_navigation_render_fallback', 'flora_ndb_core_navigation_render_fallback' );


/**
 * Remove Emojis 😵
 */
function flora_ndb_disable_wp_emojicons() {
	// all actions related to emojis
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	// filter to remove TinyMCE emojis
	add_filter( 'tiny_mce_plugins', 'flora_ndb_disable_emojicons_tinymce' );
}

function flora_ndb_disable_emojicons_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

add_action( 'init', 'flora_ndb_disable_wp_emojicons' );


