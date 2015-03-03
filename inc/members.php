<?php
/**
 * Member related functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */

/**
 * Create new "member" role
 */
function wsdev_add_member_role() {
    add_role( 'member', 'Member', array( 
										'read' => true, 
										'edit_post' => true,
										'delete_post' => true,
										'edit_published_post' => true,
										'delete_published_post' => true,
										'publish_post' => true,
										'upload_files' => false,
										'unfiltered_html' => true
									) );
}

/**
 * Remove items from Media Uploader if current user has a Member role
 */
function wsdev_member_media_view_strings( $strings ) {
	$author_data = get_userdata( get_current_user_id() );
	$author_role = implode(', ', $author_data->roles);
	if ( $author_role == 'member' ) {
		unset( $string['uploadImagesTitle'] );
		unset( $strings['uploadFilesTitle'] );
	    unset( $strings['createGalleryTitle'] );
	}
	
	return $strings;
}

/**
 * Remove items from Media Uploader if current user has a Member role
 */
function wsdev_member_media_view_tabs($tabs) {
	$author_data = get_userdata( get_current_user_id() );
	$author_role = implode(', ', $author_data->roles);
	if ( $author_role == 'member' ) {
		unset($tabs['gallery']);
	}

	return $tabs;
	
}

/**
 * Prevent "Members" from accessing the dashboard
 */
function wsdev_member_admin_prevent() {

	$current_user = wp_get_current_user();

	$user_info = get_userdata($current_user->ID);

	if ( in_array('member', $user_info->roles) && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
		wp_redirect( site_url() ); 
		exit;
	}
}