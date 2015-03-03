<?php
/**
 * page-article-editor.php
 *
 * @package Earl
 */

date_default_timezone_set('America/New_York');

$logged_in = is_user_logged_in();

if ( isset($_POST['delete']) ) {

  if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "article_deleted") {

      if (wp_verify_nonce($_POST['article_deleted'], 'memberArticle')) {

         // Do some minor form validation to make sure there is content
         if (isset($_POST['submit'])) {

          $current_user = wp_get_current_user();

          if ( $current_user->ID != get_post_field( 'post_author', $_POST['delete'] ) ) {
            wp_redirect( get_permalink($post->ID) );
          }

          else {
            wp_delete_post($_POST['delete']);
            wp_redirect(get_bloginfo("url").'/members/'.$current_user->user_login);
          }

        }

      }

    }

}

if ( isset($_GET['post']) ) {
   // if this is set, we're editing an existing article
   $query = new WP_Query(array('post_type' => 'memberarticles', 'p' => $_GET['post'] ) );

   if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

      if(isset($_GET['post'])) {

         $current_user = wp_get_current_user();

         if ( $current_user->ID != get_post_field( 'post_author', $_GET['post'] ) ) {
            wp_redirect( get_permalink($post->ID) );
         }

         if ($_GET['post'] == $post->ID) {
            $current_post = $post->ID;
            $headline = get_the_title();
            $articleContent = get_the_content();

         }
      }

   endwhile; endif;
   wp_reset_query();

   global $current_post;

   if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "article_posted") {

      if (wp_verify_nonce($_POST['article_posted'], 'memberArticle')) {

         // Do some minor form validation to make sure there is content
         if (isset($_POST['submit'])) {

            $current_user = wp_get_current_user();  
            
            //Check to make sure that the headline field is not empty
            if ($_POST['headline'] === '') {
               $headlineError = 'You forgot to enter a headline.';
               $hasError = true;    
            }

            else {
               $headline = $_POST['headline'];
            }

            //Check to make sure content was entered
            if ($_POST['articleContent'] === '') {
               $introError = 'You forgot to enter your content.';
               $hasError = true;
            }

            else {
               $articleContent = $_POST['articleContent'];
            }

            if (!isset($hasError)) {

               // Add the form input to $updated_post array
               if (empty($error)) {

                  $updated_post = array(
                     'ID' => $current_post,
                     'post_title'  =>  wp_strip_all_tags( $_POST['headline'] ),
                     'post_content'    =>  $_POST[ 'articleContent' ],
                     'post_author' => $current_user->ID,
                     'post_name' => sanitize_title( $_POST['headline'] ),
                     'post_date' => date('Y-m-d H:i:s'),
                     'post_date_gmt' => date('Y-m-d H:i:s', strtotime('+4 hours')),
                     'post_status' =>  'publish',  // Choose: publish, preview, future, draft, etc.
                     'post_type'      =>   'memberarticles'  //'post','page' or CPT
                  );

               }
            }
         }
      }

      else {
         $nonceError = 'Invalid nonce.';
         $hasError = true;
      }

      $post_id = wp_update_post($updated_post);

      if ($post_id) {
        $author = get_post_field( 'post_author', $post_id );
        $author_name = get_the_author_meta('user_login', $author);
        wp_redirect( get_permalink($post_id) );
      }

   }
}

if ( !isset($_GET['post']) && isset($_POST['submit']) ) {
   
   // we're creating a new post
   if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "article_posted") {

      if (wp_verify_nonce($_POST['article_posted'], 'memberArticle')) {

         // Do some minor form validation to make sure there is content
         if (isset($_POST['submit'])) {

            $current_user = wp_get_current_user();  
            
            //Check to make sure that the headline field is not empty
            if ($_POST['headline'] === '') {
               $headlineError = 'You forgot to enter a headline.';
               $hasError = true;    
            }

            else {
               $headline = $_POST['headline'];
            }

            //Check to make sure content was entered
            if ($_POST['articleContent'] === '') {
               $introError = 'You forgot to enter your content.';
               $hasError = true;
            }

            else {
               $articleContent = $_POST['articleContent'];
            }

            if (!isset($hasError)) {

               // Add the form input to $updated_post array
               if (empty($error)) {

                  $new_post = array(
                     'post_title'  =>  wp_strip_all_tags( $_POST['headline'] ),
                     'post_content'    =>  $_POST[ 'articleContent' ],
                     'post_author' => $current_user->ID,
                     'post_name' => sanitize_title( $_POST['headline'] ),
                     'post_date' => date('Y-m-d H:i:s'),
                     'post_date_gmt' => date('Y-m-d H:i:s', strtotime('+4 hours')),
                     'post_status' =>  'publish',  // Choose: publish, preview, future, draft, etc.
                     'post_type'      =>   'memberarticles'  //'post','page' or CPT
                  );

               }
            }
         }
      }

      else {
         $nonceError = 'Invalid nonce.';
         $hasError = true;
      }

      $post_id = wp_insert_post($new_post);

      if($post_id) {
        $author = get_post_field( 'post_author', $post_id );
        $author_name = get_the_author_meta('user_login', $author);
        wp_redirect( get_permalink($post_id) );
      }

   }
}

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			
			<?php if (isset($_GET['post'])) {
                    echo '<h1>Edit Member Article</h1>';
                }
                else {
                    echo '<h1>Add Member Article</h1>';
                }
                ?>
                <?php if ( isset($_GET['post']) ) { echo '<a data-toggle="modal" data-target="#deleteConfirmModal" class="btn btn-small btn-danger pull-right">Delete Article</a><br />'; } ?>

                <?php  if ( !$logged_in ) { ?>
                    <p>You must log in below or <a href="/join">join</a> in order to post an article.</p>
                    <?php login_with_ajax(); ?>
                <?php } else { ?>

                    <?php if(isset($hasError) ) { ?>
                    <div class="alert alert-error">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>There was an error submitting your article.
                    </div>
                    <?php } ?>

                    <?php 

                        // default settings - Kv_front_editor.php
                        $content = $articleContent;
                        $editor_id = 'articleContent';
                        $settings =   array(
                            'wpautop' => true, // use wpautop?
                            'media_buttons' => true, // show insert/upload button(s)
                            'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                            'textarea_rows' => get_option('default_post_edit_rows', 20), // rows="..."
                            'tabindex' => '',
                            'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                            'editor_class' => 'requiredField', // add extra class(es) to the editor textarea
                            'teeny' => false, // output the minimal editor config used in Press This
                            'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                            'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                            'quicktags' => true, // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                        );
                    ?>
                    <form action="" id="scouting_article_post" method="post">

                        <fieldset class="control-group">
                           <label for="headline" class="control-label">Title</label>
                              <?php if($headlineError != '') { ?>
                                 <div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $headlineError;?></div>
                              <?php } ?>
                           <div class="controls">
                              <input type="text" name="headline" id="headline" placeholder="Enter Title Here" value="<?php echo $headline; ?>" class="requiredField form-control" />
                           </div>

                        </fieldset>

                        <fieldset class="control-group">
                              <?php if($notesError != '') { ?>
                                 <div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $articleError;?></div>
                              <?php } ?>
                           <div class="controls">
                                <?php wp_editor( $content, $editor_id, $settings ); ?>
                           </div>
                        </fieldset>

                        <input type="submit" value="Post Article" tabindex="3" id="submit" name="submit" class="btn btn-primary alignright" />
                        <input type="hidden" name="action" value="article_posted" />
                        <?php wp_nonce_field( 'memberArticle', 'article_posted' ); ?>

                    </form>
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


	<div id="deleteConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
		  		<div class="modal-header">
				    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				    <h3 id="deleteConfirmModalLabel">Confirm delete</h3>
				</div>
				<div class="modal-body">
					<p>Are you sure you want to delete this article? This action cannot be undone!</p>
				</div>
				<form action="" id="delete_member_article" method="post">
				    <input type="hidden" name="delete" value="<?php echo $_GET['post']; ?>" />
				    <div class="modal-footer">
				    	<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
				    	<input type="submit" value="Delete" name="submit" class="btn btn-danger" />
				    	<input type="hidden" name="action" value="article_deleted" />
				    	<?php wp_nonce_field( 'memberArticle', 'article_deleted' ); ?>
				    </div>
				</form>
			</div>
		</div>
	</div>



<?php get_footer(); ?>