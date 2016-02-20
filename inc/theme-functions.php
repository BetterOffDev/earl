<?php
/**
 * Earl theme functions 
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */


/**
 * Remove the admin bar
 */

function wsdev_remove_admin_bar() {
	
	  show_admin_bar(false);
}

/**
 * Remove default link for images
 */
function wsdev_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	if ( $image_set !== 'none' ) {
		update_option( 'image_default_link_type', 'none' );
	}
}

/**
 * Enqueue scripts
 */
function wsdev_scripts() {
	//wp_enqueue_style( 'wsdev-base', get_stylesheet_uri() );

	wp_enqueue_style( 'db-styles', get_template_directory_uri() . '/dist/styles/style.min.css' );

	wp_enqueue_script( 'db-scripts', get_template_directory_uri() . '/dist/js/main.min.js', array('jquery'), NULL, true );

	// if ( !is_admin() ) {
	// 	wp_enqueue_script( 'jquery' );
	// 	wp_enqueue_script( 'customplugins', get_template_directory_uri() . '/assets/js/plugins.min.js', array('jquery'), NULL, true );
	// 	wp_enqueue_script( 'customscripts', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), NULL, true );
	// }
}

/**
 * Remove Query Strings From Static Resources
 */
function wsdev_remove_script_version( $src ){
	$parts = explode( '?ver', $src );
	return $parts[0];
}

/**
 * Remove Read More Jump
 */
function wsdev_remove_more_jump_link( $link ) {
	$offset = strpos( $link, '#more-' );
	if ($offset) {
		$end = strpos( $link, '"',$offset );
	}
	if ($end) {
		$link = substr_replace( $link, '', $offset, $end-$offset );
	}
	return $link;
}

/**
 * Search form
 */
function wsdev_search_form( $form ) {

    $form = '<form class="form-search" role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
      <div class="input-group">
      <input type="text" class="form-control" placeholder="Search..."value="' . get_search_query() . '" name="s" />
      <span class="input-group-btn">
        <button style="height: 34px" class="btn btn-default" id="searchsubmit" type="submit"><i class="fa fa-search"></i></button>
      </span>
    </div></form>';

    return $form;
}

/**
 * Add custom fields to user profile pages
 */
function wsdev_extra_user_profile_fields( $user ) { 
	?>
	<h3><?php _e("Extra profile information", "blank"); ?></h3>
	 
	<table class="form-table">
		<tr>
			<th><label for="twitter"><?php _e("Twitter username"); ?></label></th>
			<td>
			<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e("Please enter your Twitter username."); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="facebook"><?php _e("Facebook URL"); ?></label></th>
			<td>
			<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e("Please enter your Facebook URL."); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="google"><?php _e("Google+ URL"); ?></label></th>
			<td>
			<input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e("Please enter your Google+ URL."); ?></span>
			</td>
		</tr>
		<tr>
			<th><label for="youtube"><?php _e("YouTube username"); ?></label></th>
			<td>
			<input type="text" name="youtube" id="youtube" value="<?php echo esc_attr( get_the_author_meta( 'youtube', $user->ID ) ); ?>" class="regular-text" /><br />
			<span class="description"><?php _e("Please enter your YouTube username."); ?></span>
			</td>
		</tr>

	</table>
	<?php 
}
 
function wsdev_save_extra_user_profile_fields( $user_id ) {
 
	if ( !current_user_can( 'edit_user', $user_id ) ) { 
		return false; 
	}
 
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'google', $_POST['google'] );
	update_user_meta( $user_id, 'youtube', $_POST['youtube'] );

}

/**
 * Author page issues
 */
function wsdev_custom_post_author_archive( &$query ) {
	if ( $query->is_author )
		$query->set( 'post_type', array( 'post', 'video', 'scoutingnotes', 'memberarticles', 'mockdrafts' ));
	remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}


/**
 * Custom Query Variables
 */
function wsdev_add_query_vars_filter( $vars ){
	$vars[] = "clip";
	$vars[] = "start";
	$vars[] = "end";
	$vars[] = "size";
	$vars[] = "noteId";
	return $vars;
}


/**
 * Full page template (no sidebar)
 */
function wsdev_get_custom_cat_template($single_template) {
    global $post;
 
    if ( in_category( 'no-sidebar' )) {
        // $single_template = dirname( __FILE__ ) . '/no-sidebar-template.php';
        $single_template = get_stylesheet_directory() . '/no-sidebar-template.php';
    }
    
    return $single_template;
}

/**
 * Featured Slider Caption
 */

// Featured Caption metabox
function wsdev_add_featured_caption_metabox() {
    add_meta_box('wsdev_featured_caption_metabox', 'Featured Caption', 'wsdev_featured_caption_metabox', 'post', 'normal', 'high');
    
}

function wsdev_featured_caption_metabox() {
    global $post;
 
    wp_nonce_field( plugin_basename(__FILE__), 'featured_caption_meta_noncename' );
 
    $caption = get_post_meta($post->ID, '_featured_caption', true);

    ?>
    <h4>Featured Caption</h4>
    <textarea name="_featured_caption" rows="5" columns="30" maxlength="200" class="widefat"><?php echo $caption; ?></textarea>
    <?php
 
}

function wsdev_save_featured_caption_meta($post_ID, $post) {

    if ( ! isset( $_POST['featured_caption_meta_noncename'] ) || ! wp_verify_nonce( $_POST['featured_caption_meta_noncename'], plugin_basename( __FILE__ ) ) )
      	return;
    
    if ( !current_user_can( 'edit_post', $post->ID ))
        return;
  
    $meta['_featured_caption'] = $_POST['_featured_caption'];
 
    foreach ($meta as $key => $value) { 
        if( $post->post_type == 'revision' ) return; 
        $value = implode(',', (array)$value); 
        if(get_post_meta($post->ID, $key, FALSE)) { 
            update_post_meta($post->ID, $key, $value);
        } else { 
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); 
    }

}
 
/***************** NOT CURRENTLY IN USE *************************/
/**
 * Featured Image setting
 * If no featured image, make first image in post featured. If no image, use a default image
 */
function wsdev_main_image($class = '') {

  		$post_type = get_post_type( get_the_ID() );
  		$author = get_the_author_meta( 'ID' );
  		$author_data = get_userdata( $author );
  		$author_role = implode(', ', $author_data->roles);

  		switch($post_type) {

  			case 'mockdrafts':
  				if ( $author_role == 'member' ) {
  					echo '<img src="'.get_bloginfo('template_directory').'/dist/img/member-mock-default.png" alt="'.get_the_title().'" class="'.$class.'"/>';
  				}
  				else {
  					$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image&order=desc');
				  	if ($files) {
					    $keys = array_reverse(array_keys($files));
					    $j = 0;
					    $num = $keys[$j];
					    $image = wp_get_attachment_image($num, 'large', true);
					    $imagepieces = explode('"', $image);
					    $imagepath = $imagepieces[1];
					    $main = wp_get_attachment_url($num);
						$template = get_template_directory();
						$the_title = get_the_title();
						
						echo "<img src='$main' alt='$the_title' class='frame' />";
				  	}
				  	else {
	  					echo '<img src="'.get_bloginfo('template_directory').'/dist/img/default_thumb.png" alt="'.get_the_title().'" class="'.$class.'"/>';
	  				}
  				}
  				break;

  			case 'scoutingnotes':
  				if ( $author_role == 'member' ) {
  					echo '<img src="'.get_bloginfo('template_directory').'/dist/img/member-scouting-note-default.png" alt="'.get_the_title().'" class="'.$class.'"/>';
  				}
  				else {
  					$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image&order=desc');
				  	if ($files) {
					    $keys = array_reverse(array_keys($files));
					    $j = 0;
					    $num = $keys[$j];
					    $image = wp_get_attachment_image($num, 'large', true);
					    $imagepieces = explode('"', $image);
					    $imagepath = $imagepieces[1];
					    $main = wp_get_attachment_url($num);
						$template = get_template_directory();
						$the_title = get_the_title();
						
						echo "<img src='$main' alt='$the_title' class='frame' />";
				  	}
				  	else {
	  					echo '<img src="'.get_bloginfo('template_directory').'/dist/img/staff-scouting-note-default.png" alt="'.get_the_title().'" class="'.$class.'"/>';
	  				}
  				}
  				break;

  			case 'memberarticles':
  				if ( $author_role == 'member' ) {
  					echo '<img src="'.get_bloginfo('template_directory').'/dist/img/nfl-draft.jpg" alt="'.get_the_title().'" class="'.$class.'"/>';
  				}
  				else {
  					$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image&order=desc');
				  	if ($files) {
					    $keys = array_reverse(array_keys($files));
					    $j = 0;
					    $num = $keys[$j];
					    $image = wp_get_attachment_image($num, 'large', true);
					    $imagepieces = explode('"', $image);
					    $imagepath = $imagepieces[1];
					    $main = wp_get_attachment_url($num);
						$template = get_template_directory();
						$the_title = get_the_title();
						
						echo "<img src='$main' alt='$the_title' class='frame' />";
				  	}
				  	else {
	  					echo '<img src="'.get_bloginfo('template_directory').'/dist/img/default_thumb.png" alt="'.get_the_title().'" class="'.$class.'"/>';
	  				}
  				}
  				break;

  			default:
  				$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image&order=desc');
			  	if ($files) {
				    $keys = array_reverse(array_keys($files));
				    $j = 0;
				    $num = $keys[$j];
				    $image = wp_get_attachment_image($num, 'large', true);
				    $imagepieces = explode('"', $image);
				    $imagepath = $imagepieces[1];
				    $main = wp_get_attachment_url($num);
					$template = get_template_directory();
					$the_title = get_the_title();
					
					echo "<img src='$main' alt='$the_title' class='frame' />";
			  	}
			  	else {
  					echo '<img src="'.get_bloginfo('template_directory').'/dist/img/default_thumb.png" alt="'.get_the_title().'" class="'.$class.'"/>';
  				}
  				break;
  		}
  		

}

/**
 * Comment redirect
 */
function wsdev_redirect_after_comment($location) {
	return $_SERVER["HTTP_REFERER"];
}

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function wsdev_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', '_mbbasetheme' ), max( $paged, $page ) );
	}

	return $title;
}
