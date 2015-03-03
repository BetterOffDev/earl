<?php
   if ('mockdraft-comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
?>
   <h5 class="mockdraft-comments-title"><?php comments_number( 'No Comments', '1 Comment', '% Comments' ); ?><?php if ('open' == $post->comment_status) : ?> &bull; <a rel="nofollow" class="comment-reply-link" href="#respond" onclick="document.getElementById( 'comment_post_ID' ).value = '<?php the_ID(); ?>'";>Leave a Comment</a><?php endif; ?></h5>
<?php if ( have_comments() ) :
   if ( ! empty($comments_by_type['comment']) ) : ?>
      <ol class="commentlist media-list">
         <?php wp_list_comments('type=comment&callback=custom_mockdraft_comments'); ?>
      </ol>
   <?php endif; ?>
<?php endif; ?>
