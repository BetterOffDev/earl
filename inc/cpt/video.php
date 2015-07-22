<?php
/**
 * Video custom post type functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */


/**
 * Define Video custom post type
 */
function wsdev_video_posttype() {
    register_post_type( 'video',
        array(
            'labels' => array(
                'name' => __( 'Prospect Video Clips' ),
                'singular_name' => __( 'Prospect Video Clip' ),
                'add_new' => __( 'Add New Prospect Video Clip' ),
                'add_new_item' => __( 'Add New Prospect Video Clip' ),
                'edit_item' => __( 'Edit Prospect Video Clip' ),
                'new_item' => __( 'Add New Prospect Video Clip' ),
                'view_item' => __( 'View Prospect Video Clip' ),
                'search_items' => __( 'Search Prospect Video Clip' ),
                'not_found' => __( 'No prospect video clips found' ),
                'not_found_in_trash' => __( 'No prospect video clips found in trash' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'thumbnail', 'author' ),
            'capability_type' => 'post', 
            'rewrite'         => array(
					'slug'		 	=> '',
					'with_front'	=> true
				),
            'menu_position' => 8,
            'register_meta_box_cb' => 'add_video_metaboxes'
        )
    );
}

/*
 * Required Video metaboxes
 */

// Add the metabox
function add_video_metaboxes() {
    add_meta_box('wsdev_video_metabox', 'Prospect Video Clip', 'wsdev_video_metabox', 'video', 'normal', 'high');
	
}

// Define the metabox
function wsdev_video_metabox() {
    global $post;
 
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="video_meta_noncename" id="video_meta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
 
    // Get the data if its already been entered
    $video_id = get_post_meta($post->ID, '_video_id', true);
	$video_opponent = get_post_meta($post->ID, '_video_opponent', true);
	$video_year = get_post_meta($post->ID, '_video_year', true);
	$video_prospect = get_post_meta($post->ID, '_video_prospect', true);
	$video_date = get_post_meta($post->ID, '_video_date', true);
	$video_position = get_post_meta($post->ID, '_video_position', true);
	$video_host = get_post_meta($post->ID, '_video_host', true);
	
	
    // Echo out the field
    
	$original_post = $post;

	?>
	<h4>Select Video Host</h4>
	<select name="_video_host">
		<option value="youtube" <?php if ( $video_host == 'youtube' || $video_host == '' ) { echo 'selected="selected"'; } ?>>YouTube</option>
		<option value="vimeo"<?php if ( $video_host == 'vimeo' ) { echo 'selected="selected"'; } ?>>Vimeo</option>
		<option value="dailymotion"<?php if ( $video_host == 'dailymotion' ) { echo 'selected="selected"'; } ?>>Daily Motion</option>
	</select>
	<h4>YouTube, Vimeo or Daily Motion Video ID</h4>
	<input type="text" name="_video_id" value="<?php echo $video_id; ?>" width="200" />
	<h4>Video Prospect</h4>

	<p><em>Click box then type first letter or players first name to skip ahead in list</em></p>
	<select name="_video_prospect"><option value="">&nbsp;</option>
	<?php
	

	$args = array(
				'post_type' => 'player',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC'
		);
	$prospects = new WP_Query($args);

	while ( $prospects->have_posts() ) : $prospects->the_post();
	
	?>

	<option value='<?php echo get_the_ID(); ?>' <?php if ( get_the_ID() == $video_prospect) echo "selected='selected'"; ?>><?php echo get_the_title(); ?> - <?php echo get_post_meta( get_the_ID(), '_position', true ); ?> - <?php echo get_post_meta( get_the_ID(), '_school', true ); ?></option>

	<?php
	endwhile; ?>
	</select> &nbsp;&nbsp; <?php echo $video_position; ?>
	<input type="hidden" name="_video_position" value="<?php echo $video_position; ?>" />

	<?php

	wp_reset_query();
	wp_reset_postdata();
	
	$post = $original_post;

	?>
	
	</select>

	<h4>Video Opponent(s)</h4>
	<p><em>If multiple opponents, enter "Opponent1, Opponent2 & Opponent3"</em></p>
	<input type="text" name="_video_opponent" value="<?php echo $video_opponent; ?>" width="300" />
	<h4>Video Year (season game takes place)</h4>
	<select name="_video_year">
			<option <?php if ( $video_year == '') echo "selected='selected'"; ?> value="">&nbsp;</option>
			<option <?php if ( $video_year == '2015') echo "selected='selected'"; ?> value="2015">2015</option>
			<option <?php if ( $video_year == '2014') echo "selected='selected'"; ?> value="2014">2014</option>
			<option <?php if ( $video_year == '2013') echo "selected='selected'"; ?> value="2013">2013</option>
			<option <?php if ( $video_year == '2012') echo "selected='selected'"; ?> value="2012">2012</option>
			<option <?php if ( $video_year == '2011') echo "selected='selected'"; ?> value="2011">2011</option>
			<option <?php if ( $video_year == '2010') echo "selected='selected'"; ?> value="2010">2010</option>
			<option <?php if ( $video_year == '2009') echo "selected='selected'"; ?> value="2009">2009</option>
			<option <?php if ( $video_year == '2008') echo "selected='selected'"; ?> value="2008">2008</option>
	</select>
	<!-- <p>To do: insert date selector....calendar style?</p> -->

	<!-- <p>Modified? <?php echo $post->post_modified; ?></p>
	<p>Date? <?php echo $post->post_date; ?></p> -->
	<?php
}

// Save the metabox data
function wsdev_save_video_meta($post_ID, $post) {
 
    
    if ( !wp_verify_nonce( $_POST['video_meta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }
 
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;

    	$video_post_id = $post->ID;
 
   
 
    $video_meta['_video_id'] = $_POST['_video_id'];
	$video_meta['_video_opponent'] = $_POST['_video_opponent'];
	$video_meta['_video_year'] = $_POST['_video_year'];
	$video_meta['_video_prospect'] = $_POST['_video_prospect'];
	$video_meta['_video_date'] = $_POST['_video_date'];
	$video_meta['_video_host'] = $_POST['_video_host'];
	$new_title = $_POST['_video_prospect']." vs ".$_POST['_video_opponent']." (".$_POST['_video_year'].")";

	$player_id = $video_meta['_video_prospect'];

	$video_meta['_video_position'] = get_post_meta( $video_meta['_video_prospect'], '_position', true );
 
   
 
    foreach ($video_meta as $key => $value) { 
        if( $post->post_type == 'revision' ) return; 
        $value = implode(',', (array)$value); 
        if(get_post_meta($post->ID, $key, FALSE)) { 
            update_post_meta($post->ID, $key, $value);
        } else { 
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); 
    }

    $number_videos = get_post_meta($player_id, '_number_videos', true);
   	$new_number = $number_videos + 1;

    if( $post->post_modified == $post->post_date )  {
    	update_post_meta($player_id, '_number_videos', $new_number );
    }
 
}
 

/*
 * Custom functions for video cpt
 */

// Update video number for player when video is deleted
function wsdev_video_post_delete($postid) {
	global $post_type;
	if ($post->post_type == 'video') {
		
		$player_id = get_post_meta( $postid, '_video_prospect', true);

		$number_videos = get_post_meta($player_id, '_number_videos', true);
   		$new_number = $number_videos - 1;

   		update_post_meta( $player_id, '_number_videos', $new_number );

	}
}


// Generate a custom video post title based on custom fields
function wsdev_video_post_title( $data , $postarr ) {

	if( $data['post_type'] == 'video' ) {
  		
		$player_name = get_the_title( $_POST['_video_prospect'] );
  		
  		$new_title = $player_name." vs ".$_POST['_video_opponent']." (".$_POST['_video_year'].")";

		$new_slug = sanitize_title_with_dashes($new_title);

  		$data['post_title'] = $new_title;
		
		$unique_slug = wp_unique_post_slug( $new_slug, $data['ID'], 'publish', 'video', '' );

		$data['post_name'] = $unique_slug;
  	}
  	
  	return $data;
}

//Remove quick edit from video posts list
function wsdev_remove_quick_edit( $actions ) {
	global $post;
    
    if ( is_admin() ) {

    	if( $post->post_type == 'video' ) {
			unset($actions['inline hide-if-no-js']);
		}

    }	

	return $actions;
}

// Add tags for the video cpt
function wsdev_add_video_taxonomy_objects() {
	register_taxonomy_for_object_type('post_tag', 'video');
} 
