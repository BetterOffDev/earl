<?php
/**
 * bootstrapped theme init setup
 * functions defined in theme-functions.php
 *
 * @package bootstrapped
 */

if ( ! function_exists( 'wsdev_bootstrapped_setup' ) ) :

function wsdev_bootstrapped_setup() {


	// Clean up the head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Prevent File Modifications
	if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
		define( 'DISALLOW_FILE_EDIT', true );
	}

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Add Image Sizes
	// add_image_size( $name, $width = 0, $height = 0, $crop = false );

	// Remove Dashboard Meta Boxes
	// Function location: /lib/theme-functions.php
	add_action( 'wp_dashboard_setup', 'wsdev_remove_dashboard_widgets' );

	// Change Admin Menu Order
	// Function location: /lib/theme-functions.php
	add_filter( 'custom_menu_order', '__return_true' );
	add_filter( 'menu_order', 'wsdev_custom_menu_order' );

	// Hide Admin Areas that are not used
	// Function location: /lib/theme-functions.php
	add_action( 'admin_menu', 'wsdev_remove_menu_pages' );

	// Remove default link for images
	// Function location: /lib/theme-functions.php
	add_action( 'admin_init', 'wsdev_imagelink_setup', 10 );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Enqueue scripts
	// Function location: /lib/theme-functions.php
	add_action( 'wp_enqueue_scripts', 'wsdev_scripts' );

	// Remove Query Strings From Static Resources
	// Function location: /lib/theme-functions.php
	add_filter( 'script_loader_src', 'wsdev_remove_script_version', 15, 1 );
	add_filter( 'style_loader_src', 'wsdev_remove_script_version', 15, 1 );

	// Remove Read More Jump
	// Function location: /lib/theme-functions.php
	add_filter( 'the_content_more_link', 'wsdev_remove_more_jump_link' );

}
endif; // wsdev_bootstrapped_setup

add_action( 'after_setup_theme', 'wsdev_bootstrapped_setup' );
