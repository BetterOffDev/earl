<?php
/**
 * page-comment-editor.php
 *
 * @package Earl
 */

$logged_in = is_user_logged_in();

if ( isset($_GET['comment_ID']) ) {
    $comment_ID = $_GET['comment_ID'];

    $comment = get_comment($comment_ID);

    $current_user = wp_get_current_user();

    if ( $current_user->ID != $comment->user_id ) {
        $article_link = get_permalink($comment->comment_post_id);
        wp_redirect( $article_link );
    }

    else {
        $commentContent = $comment->comment_content;
    }
}
   

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "comment_updated") {

   if(wp_verify_nonce($_POST['comment_updated'], 'memberArticleComment')) {

      // Do some minor form validation to make sure there is content
      if (isset($_POST['submit'])) {

        $current_user = wp_get_current_user();

        if (isset($_POST['comment_ID'])) {
            $comment_ID = $_POST['comment_ID'];
        }

         //Check to make sure comments were entered
         if($_POST['commentContent'] === '') {
            $commentError = 'You forgot to enter your comment.';
            $hasError = true;
         } else {
               $commentContent = $_POST['commentContent'];
            }

         //If there is no error, post
         if(!isset($hasError)) {

            // Add the form input to to update the comment
            if (empty($error)) {
                $commentarr = array();
                $commentarr['comment_ID'] = $comment_ID;
                $commentarr['comment_content'] = $commentContent;
                $update_success = wp_update_comment($commentarr);

                if ($update_success == 1) {
                    $comment = get_comment($comment_ID);

                    $article_link = get_permalink($comment->comment_post_ID);

                    wp_redirect( $article_link );

                }

                else {
                    $commentError = 'Something went wrong while updating your comment.';
                    $hasError = true;
                }
                
                
            }
         }
      }
   }else{
      $nonceError = 'Invalid nonce.';
      $hasError = true;
   }

}

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			
			<?php if (isset($_GET['comment_ID'])) {
                        echo '<h1>Edit Comment</h1>';
                    }
                    else {
                        echo '<h1>No comment to edit...';
                    }
                ?>

                <?php  if ( !$logged_in ) { ?>
                    <h1>Nothing to see here...</h1>
                <?php } else { ?>

                    <?php if(isset($hasError) ) { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>There was an error updating your comment.
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="" id="member_article_comment_update" method="post">

                                <fieldset class="control-group">
                                      <?php if($commentError != '') { ?>
                                         <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $commentError;?></div>
                                      <?php } ?>
                                   <div class="controls">
                                        <textarea name="commentContent" rows="10" style="width: 98%;"><?php echo $commentContent; ?></textarea>
                                   </div>
                                </fieldset>

                                <input type="submit" value="Update Comment" tabindex="3" id="submit" name="submit" class="btn btn-primary alignright" />
                                <input type="hidden" name="action" value="comment_updated" />
                                <input type="hidden" name="comment_ID" value="<?php echo $comment_ID; ?>" />
                                <?php wp_nonce_field( 'memberArticleComment', 'comment_updated' ); ?>

                            </form>
                        </div>
                    </div>
                <?php } //end else for logged_in ?>
        <div class="row" style="text-align: center;">
          <div class="col-sm-12 visible-sm visible-md visible-lg ad ad-lh">
  					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  					<!-- Horizontal leaderboard -->
  					<ins class="adsbygoogle"
  					     style="display:inline-block;width:728px;height:90px"
  					     data-ad-client="ca-pub-7021861911581046"
  					     data-ad-slot="9568559232"></ins>
  					<script>
  					(adsbygoogle = window.adsbygoogle || []).push({});
  					</script>
  				</div>
  				
  				<div class="col-sm-12 visible-xs ad ad-sq">
  					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  						<!-- Mobile 300x250 -->
  						<ins class="adsbygoogle"
  					     style="display:inline-block;width:300px;height:250px"
  					     data-ad-client="ca-pub-7021861911581046"
  					     data-ad-slot="1528285636"></ins>
  					<script>
  						(adsbygoogle = window.adsbygoogle || []).push({});
  					</script>
  				</div>
        </div>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>