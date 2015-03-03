<?php
/* Template Name: Edit Notes */

if ( isset($_POST['delete']) ) {

  if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "scouting_note_deleted") {

      if (wp_verify_nonce($_POST['scouting_note_deleted'], 'scoutingNotes')) {

         // Do some minor form validation to make sure there is content
         if (isset($_POST['submit'])) {

          $current_user = wp_get_current_user();

          if ( $current_user->ID != get_post_field( 'post_author', $_POST['delete'] ) ) {
            wp_redirect( get_permalink($post->ID) );
          }

          else {
            wp_delete_post($_POST['delete']);
            echo '<script>window.opener.location.reload(true); opener.focus(); self.close();</script>';
          }

        }

      }

    }

}

$query = new WP_Query(array('post_type' => 'scoutingnotes', 'posts_per_page' =>'-1' ) );

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

	if(isset($_GET['post'])) {
		if($_GET['post'] == $post->ID) {
			$current_post = $post->ID;
			$headline = get_the_title();
			$notes = get_the_content();
		}
	}

endwhile; endif;
wp_reset_query();

global $current_post;

if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "updated_post") {

   if(wp_verify_nonce($_POST['update_notes'], 'snotes')) {

      // Do some minor form validation to make sure there is content
      if (isset($_POST['submit'])) {

         //Check to make sure that the headline field is not empty
         if($_POST['headline'] === '') {
            $headlineError = 'You forgot to enter a headline.';
            $hasError = true;
         } else {
            $headline = $_POST['headline'];
         }

         //Check to make sure notes were entered
         if($_POST['notes'] === '') {
            $notesError = 'You forgot to enter your notes.';
            $hasError = true;
         } else {
               $notes = $_POST['notes'];
            }

         //If there is no error, post
         if(!isset($hasError)) {

            // Check if note is marked for private
            $private_note = $_POST['private_note'];

            // Add the form input to $updated_post array
            if (empty($error)) {
               $updated_post = array(
                  'ID' => $current_post,
                  'post_title'	=>	wp_strip_all_tags( $_POST['headline'] ),
                  'post_content'	=>	$_POST[ 'notes' ],
                  'post_status'	=>	'publish',  // Choose: publish, preview, future, draft, etc.
                  'post_type'	   =>	'scoutingnotes'  //'post','page' or CPT
               );
            }
         }
      }
   }else{
      $nonceError = 'Invalid nonce.';
      $hasError = true;
   }

   // Update it
   $post_id = wp_update_post($updated_post);

	if($post_id)
	{
    if ( get_post_meta( $post_id, '_private_note', FALSE) ) {
      update_post_meta( $post_id, '_private_note', $private_note );
     }
     else {
        add_post_meta($post_id, '_private_note', $private_note);
     }
     
		//wp_redirect(home_url());
      echo '<script>window.opener.location.reload(true); opener.focus(); self.close();</script>';
		exit;
	}

}

get_header(); ?>
	<div class="container" style="margin-top: 50px;">

      <?php if(isset($hasError) ) { ?>
         <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>There was an error submitting your scouting notes.
         </div>
      <?php } ?>
         <form action="" id="updated_post" method="post">

            <fieldset class="control-group">
               <label for="headline" class="control-label">Headline</label>
                  <?php if($headlineError != '') { ?>
                     <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $headlineError;?></div>
                  <?php } ?>
               <div class="controls">
                  <input type="text" name="headline" id="headline" value="<?php echo $headline; ?>" class="requiredField" />
                  <a data-toggle="modal" data-target="#deleteConfirmModal" class="btn btn-small btn-danger pull-right">Delete Note</a>
               </div>
               <div class="checkbox">
                <label>
                  <input id="private_note" name="private_note" type="checkbox" value="checked"> Keep note private <em>(will not display in listings)</em>
                </label>
              </div>
            </fieldset>

            <fieldset class="control-group">
               <label for="notes" class="control-label">Your Scouting Notes</label>
                  <?php if($notesError != '') { ?>
                     <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $notesError;?></div>
                  <?php } ?>
               <div class="controls">
                  <?php 

                    // default settings - Kv_front_editor.php
                    $content = $notes;
                    $editor_id = 'notes';
                    $settings =   array(
                        'wpautop' => true, // use wpautop?
                        'media_buttons' => true, // show insert/upload button(s)
                        'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                        'textarea_rows' => 10, // rows="..."
                        'tabindex' => '',
                        'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                        // 'editor_class' => 'poppedUp', // add extra class(es) to the editor textarea
                        'teeny' => false, // output the minimal editor config used in Press This
                        'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                        'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                        'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                    );
                ?>
                <?php wp_editor( $content, $editor_id, $settings ); ?>
                  <!-- <textarea name="notes" id="notes" cols="50" rows="15" class="requiredField"><?php echo $notes; ?></textarea> -->
               </div>
               <!--<script type="text/javascript">
                  jQuery(function($) {
                     $("#notes").htmlarea({
                        toolbar: [
                           ["h1", "h2", "h3", "h4"],
                           ["bold", "italic", "underline"],
                           ["orderedList", "unorderedList", "indent", "outdent"],
                           ["link", "unlink"],
                           ["image"]
                        ],
                        css: 'http://draftbreakdown.com/wp-content/themes/DB-Delta/visual-editor.css'
                     });
                     $('.jHtmlArea iframe').attr('tabindex', '2');
                  });
               </script>-->
            </fieldset>

            <input type="submit" value="Update Notes" tabindex="3" id="submit" name="submit" class="btn btn-primary" />
            <input type="hidden" name="action" value="updated_post" />
            <?php wp_nonce_field( 'snotes', 'update_notes' ); ?>

         </form>

</div>
<script>
   jQuery(document).ready(function() {
      jQuery('#wp-notes-wrap').addClass('poppedUp');
   });

</script>

<div id="deleteConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModal" aria-hidden="true">
	<div class="modal-content">
		<div class="modal-body">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h3 id="deleteConfirmModalLabel">Confirm delete</h3>
		  </div>
		  <div class="modal-body">
		    <p>Are you sure you want to delete this scouting note? This action cannot be undone!</p>
		  </div>
		  <form action="" id="delete_scouting_note" method="post">
		    <input type="hidden" name="delete" value="<?php echo $_GET['post']; ?>" />
		    <div class="modal-footer">
		      <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		      <input type="submit" value="Delete" name="submit" class="btn btn-danger" />
		      <input type="hidden" name="action" value="scouting_note_deleted" />
		      <?php wp_nonce_field( 'scoutingNotes', 'scouting_note_deleted' ); ?>
		    </div>
		  </form>
		</div>
	</div>
</div>

<?php get_footer(); ?>