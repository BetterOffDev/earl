<?php
/**
 * Memberarticle custom post type functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */

/**
 * Memberarticle CPT
 */
function wsdev_memberarticles_cpt() {
    register_post_type( 'memberarticles',
        array(
            'labels' => array(
                'name' => __( 'Member Articles' ),
                'singular_name' => __( 'Member Article' ),
                'add_new' => __( 'Add New Member Article' ),
                'add_new_item' => __( 'Add New Member Article' ),
                'edit_item' => __( 'Edit Member Article' ),
                'new_item' => __( 'Add New Member Article' ),
                'view_item' => __( 'View Member Article' ),
                'search_items' => __( 'Search Member Article' ),
                'not_found' => __( 'No member articles found' ),
                'not_found_in_trash' => __( 'No member articles found in trash' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'editor', 'thumbnail', 'author', 'comments', 'custom-fields', ),
            'taxonomies' => array('category'),
            'capability_type' => 'post',
            'rewrite'         => array(
                    'slug'          => '',
                    'with_front'    => true
                ),
            'menu_position' => 9
        )
    );
};

/**
 * Memberarticle comments
 */
function custom_member_article_comments($comment, $args, $depth) {
    $isByAuthor = false;
    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }
   $GLOBALS['comment'] = $comment; ?>

   <li <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>" <?php if($isByAuthor){ echo 'class="author"';}?>>
         <div class="pull-right media-object">
            <?php echo get_avatar( $comment->comment_author_email, 52 ); ?>
            <?php comment_reply_link(array_merge( $args, array('reply_text' => '<i class="icon-share" title="Reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?><a href="<?php bloginfo('url'); ?>/comment-editor/?comment_ID=<?php comment_ID(); ?>"><i class="icon-edit" title="Edit"></i></a>
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
