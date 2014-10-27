<?php
/**
 * Earl theme init setup
 * functions defined in noted locations
 *
 * @package Earl
 */

if ( ! function_exists( 'wsdev_earl_setup' ) ) :

function wsdev_earl_setup() {

	// Remove the admin bar
	// Function location: /lib/theme-functions.php
	add_filter( 'show_admin_bar' , 'wsdev_remove_admin_bar');

	// Clean up the head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Display a better title based on the content
	// Function location: /lib/theme-functions.php
	add_filter( 'wp_title', 'wsdev_wp_title', 10, 2 );

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
	// Function location: /lib/admin-functions.php
	add_action( 'wp_dashboard_setup', 'wsdev_remove_dashboard_widgets' );

	// Change Admin Menu Order
	// Function location: /lib/admin-functions.php
	add_filter( 'custom_menu_order', '__return_true' );
	add_filter( 'menu_order', 'wsdev_custom_menu_order' );

	// Hide Admin Areas that are not used
	// Function location: /lib/admin-functions.php
	add_action( 'admin_menu', 'wsdev_remove_menu_pages' );

	// Custom Admin Area footer text
	// Function location: /lib/admin-functions.php
	add_filter( 'admin_footer_text', 'wsdev_admin_footer_text' );

	// Custom Admin Area CSS
	// Function location: /lib/admin-functions.php
	add_action( 'admin_head', 'wsdev_register_custom_admin_css' );

	// Remove default link for images
	// Function location: /lib/theme-functions.php
	add_action( 'admin_init', 'wsdev_imagelink_setup', 10 );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
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

	// Search form
	// Function location: /lib/theme-functions.php
	add_filter( 'get_search_form', 'wsdev_search_form' );

	// Extra author profile fields
	// Function location: /lib/theme-functions.php
	add_action( 'show_user_profile', 'wsdev_extra_user_profile_fields' );
	add_action( 'edit_user_profile', 'wsdev_extra_user_profile_fields' );
	add_action( 'personal_options_update', 'wsdev_save_extra_user_profile_fields' );
	add_action( 'edit_user_profile_update', 'wsdev_save_extra_user_profile_fields' );

	// Author page issues
	// Function location: /lib/theme-functions.php
	add_action( 'pre_get_posts', 'wsdev_custom_post_author_archive' );

	// Custom query variables
	// Function location: /lib/theme-functions.php
	add_filter( 'query_vars', 'wsdev_add_query_vars_filter' );

	// Full page template
	// Function location: /lib/theme-functions.php
	add_filter( 'single_template', 'wsdev_get_custom_cat_template' );

	// Custom excerpt
	// Function location: /lib/util.php
	remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
	add_filter( 'get_the_excerpt', 'wsdev_trim_excerpt' );

	// Comment redirect
	// Function location: /lib/theme-functions.php
	add_filter( 'comment_post_redirect', 'wsdev_redirect_after_comment' );

	// Member functions
	// Function location: /lib/members.php
	add_action( 'init', 'wsdev_add_member_role' );
	add_filter( 'media_view_strings', 'wsdev_member_media_view_strings' );
	add_filter( 'media_upload_tabs', 'wsdev_member_media_view_tabs' );
	add_action( 'admin_init', 'wsdev_member_admin_prevent', 1 );

	// Featured Slider Caption
	// Function location: /lib/theme-functions.php
	add_action( 'add_meta_boxes', 'wsdev_add_featured_caption_metabox' );
	add_action( 'save_post', 'wsdev_save_featured_caption_meta', 1, 2 ); 
 
	// Add custom post types, required meta boxes and required custom functions
	//
	// PLAYER CPT
	// Function location: /lib/cpt/player.php
	add_action( 'init', 'wsdev_player_posttype', 0 );
	add_filter( 'manage_edit-player_columns', 'set_custom_edit_player_columns' );
	add_action( 'manage_player_posts_custom_column' , 'custom_player_column', 10, 2 );
	add_filter( 'manage_edit-player_sortable_columns', 'player_sort' );
	add_filter( 'request', 'school_column_orderby' );
	add_filter( 'request', 'position_column_orderby' );
	add_filter( 'request', 'number_videos_column_orderby' );
	add_filter( 'request', 'draft_class_column_orderby' );
	add_action( 'do_meta_boxes' , 'remove_player_extra_meta' );
	add_action( 'do_meta_boxes', 'player_author_box' );
	add_action( 'do_meta_boxes', 'player_image_box' );
	add_filter( 'default_hidden_meta_boxes', 'hide_meta_lock', 10, 2 );
	add_action( 'do_meta_boxes', 'wsdev_remove_comments_meta' );
	add_action( 'add_meta_boxes', 'add_scouting_report_box', 0 );
	add_action( 'add_meta_boxes', 'add_player_info_metabox' );
	add_action( 'save_post', 'save_player_meta', 1, 2 );
	add_action( 'add_meta_boxes', 'add_combine_metabox' );
	add_action( 'save_post', 'save_combine_meta', 1, 2) ;
	// VIDEO CPT
	// Function location: /lib/cpt/video.php
	add_action( 'init', 'wsdev_video_posttype', 0 );
	add_action( 'add_meta_boxes', 'add_video_metaboxes' );
	add_action( 'save_post', 'wsdev_save_video_meta', 1, 2 ); 
	add_action( 'before_delete_post', 'wsdev_video_post_delete' );
	add_filter( 'wp_insert_post_data' , 'wsdev_video_post_title' , 99, 2 );
	add_action( 'init', 'wsdev_add_video_taxonomy_objects' );
	add_filter( 'post_row_actions','wsdev_remove_quick_edit', 10, 2 );
	//
	// MOCKDRAFT CPT
	// Function location: /lib/cpt/mockdraft.php
	add_action( 'init', 'wsdev_mockdrafts_cpt', 0 );
	add_action( 'add_meta_boxes', 'wsdev_add_mockdraft_metaboxes' );
	add_action( 'save_post', 'wsdev_save_mockdraft_meta', 1, 2 ); 
	//
	// MEMBERARTICLE CPT
	// Function location: /lib/cpt/memberarticle.php
	add_action( 'init', 'wsdev_memberarticles_cpt', 0 );
	//
	// SCOUTINGNOTE CPT
	// Function location: /lib/cpt/scoutingnote.php
	add_action( 'init', 'wsdev_scoutingnotes_cpt', 0 );

	// Plugin customizations
	// Function location: /lib/plugin-custom.php
	add_filter( 'wpcf7_form_class_attr', 'wsdev_custom_form_class_attr' );
	add_action( 'init', 'wsdev_disable_cache' );
	


}
endif; // wsdev_earl_setup

add_action( 'after_setup_theme', 'wsdev_earl_setup' );


