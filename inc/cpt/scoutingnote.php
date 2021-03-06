<?php
/**
 * Scoutingnote custom post type functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */

/**
 * Scoutingnote CPT
 */
function wsdev_scoutingnotes_cpt() {
 
	$labels = array(
		'name' => 'Scouting Notes',
		'singular_name' => 'Scouting Notes',
		'menu_name' => 'Scouting Notes',
		'parent_item_colon' => 'Parent Note:',
		'all_items' => 'All Scouting Notes',
		'view_item' => 'View Scouting Notes',
		'add_new_item' => 'Add New Scouting Notes',
		'add_new' => 'New Scouting Notes',
		'edit_item' => 'Edit Scouting Notes',
		'update_item' => 'Update Scouting Notes',
		'search_items' => 'Search Scouting Notes',
		'not_found' => 'No scouting notes found',
		'not_found_in_trash' => 'No scouting notes found in Trash',
		);
	$args = array(
		'label' => 'scoutingnotes',
		'description' => 'Scouting notes on individual players',
		'labels' => $labels,
		'supports' => array('title', 'editor', 'author', 'thumbnail', 'comments', 'custom-fields'),
		'hierarchical' => 'false',
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_admin_bar' => false,
		'menu_position' => 9,
		'can_export' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		);


	register_post_type('scoutingnotes', $args);

	flush_rewrite_rules(false);
}

/**
 * Scoutingnotes comments
 */
function custom_notes_comments($comment, $args, $depth) {
    $isByAuthor = false;
    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }
    $twitter_img_url = get_twitter_avatar( get_the_author_meta('twitter', $author_id) );
   $GLOBALS['comment'] = $comment; ?>

   <li <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" <?php if($isByAuthor){ echo 'class="author"';}?>>
         <div class="pull-right media-object">
            <img class="author-photo-comment" src="<?php echo $twitter_img_url;?>" />
            <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="fa fa-share" title="Reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?><?php edit_comment_link(__('<i class="fa fa-edit" title="Edit"></i>'),'  ','') ?>
         </div>
         <div class="media-body">
            <div class="comment-meta">
               <span class="comment-author vcard media-heading"><?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?> </span> &bull; <?php printf(__('%1$s, at %2$s'), get_comment_date(),  get_comment_time()) ?>
            </div>
            <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Your comment is awaiting moderation.') ?></em>
            <br />
            <?php endif; ?>
            <?php comment_text() ?>
         </div>
     </div><!-- #comment-ID -->
    </li>
	<?php
}
