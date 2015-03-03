<?php
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "new_post") {

   if(wp_verify_nonce($_POST['submit_notes'], 'snotes')) {

      // Do some minor form validation to make sure there is content
      if (isset($_POST['submit'])) {

         // Check to make sure that the headline field is not empty
         if($_POST['headline'] === '') {
            $headlineError = 'You forgot to enter a headline.';
            $hasError = true;
         } else {
            $headline = $_POST['headline'];
         }

         // Check to make sure notes were entered
         if($_POST['notes'] === '') {
            $notesError = 'You forgot to enter your notes.';
            $hasError = true;
         } else {
               $notes = $_POST['notes'];
            }

         // If there is no error, post
         if(!isset($hasError)) {
            // Get video for note
            $notes_video = $_POST['notes_video'];
            // Check if note is marked for private
            $private_note = $_POST['private_note'];

            // Add the form input to $new_post array
            if (empty($error)) {
               $new_post = array(
                  'post_title'	=>	wp_strip_all_tags( $_POST['headline'] ),
                  'post_content'	=>	$_POST[ 'notes' ],
                  'post_status'	=>	'publish',  // publish, preview, future, draft, etc.
                  'post_type'	   =>	'scoutingnotes'  // 'post','page' or CPT
               );
            }
            $postAdded = true;
         }
      }
   }else{
      $nonceError = 'Invalid nonce.';
      $hasError = true;
   }

   // Post it
   $post_id = wp_insert_post($new_post);

   if ( $post_id == 'revision' ) return;

   if ( get_post_meta( $post_id, '_notes_video', FALSE) ) {
      update_post_meta( $post_id, '_notes_video', $notes_video );
   }
   else {
      add_post_meta($post_id, '_notes_video', $notes_video);
   }

   if ( get_post_meta( $post_id, '_private_note', FALSE) ) {
      update_post_meta( $post_id, '_private_note', $private_note );
   }
   else {
      add_post_meta($post_id, '_private_note', $private_note);
   }

}
?>