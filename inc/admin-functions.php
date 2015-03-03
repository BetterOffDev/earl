<?php
/**
 * Admin area functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */

/**
 * Remove Dashboard Meta Boxes
 */
function wsdev_remove_dashboard_widgets() {
	global $wp_meta_boxes;
	// unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	// unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}

/**
 * Change Admin Menu Order
 */
function wsdev_custom_menu_order( $menu_ord ) {
	if ( !$menu_ord ) return true;
	return array(
		// 'index.php', // Dashboard
		// 'separator1', // First separator
		// 'edit.php?post_type=page', // Pages
		// 'edit.php', // Posts
		// 'upload.php', // Media
		// 'gf_edit_forms', // Gravity Forms
		// 'genesis', // Genesis
		// 'edit-comments.php', // Comments
		// 'separator2', // Second separator
		// 'themes.php', // Appearance
		// 'plugins.php', // Plugins
		// 'users.php', // Users
		// 'tools.php', // Tools
		// 'options-general.php', // Settings
		// 'separator-last', // Last separator
	);
}

/**
 * Hide Admin Areas that are not used
 */
function wsdev_remove_menu_pages() {
	remove_menu_page( 'link-manager.php' );
}

/**
 * Custom admin area footer text
 */
function wsdev_admin_footer_text( $default_text ) {
	return '<span id="footer-thankyou">Custom theme and all sorts of badass features by <a href="http://www.twitter.com/wspencer428">Will Spencer</a><span> | Powered by <a href="http://www.wordpress.org">WordPress</a>';
}


/******************* FIX THIS!!! **********************/
/**
 * Add bootstrap style to admin area for table display
 */
function wsdev_register_custom_admin_css() {
	wp_register_style( 'bootstrap-tables', get_template_directory_uri().'/assets/bootstrap-sass-official/assets/stylesheets/bootstrap-tables.css' );
	wp_enqueue_style( 'bootstrap-tables' );
}


