<?php
     $notes = new WP_Query( array( 'posts_per_page' => -1, 'post_type' => 'scoutingnotes', 'meta_key' => '_notes_video', 'meta_value' => get_the_ID(), 'meta_query' => array( array( 'key' => '_private_note', 'value' => 'checked', 'compare' => 'NOT LIKE' ) ) ) );
     $notes_num = $notes->post_count;
     wp_reset_query();
     wp_reset_postdata();
?>
<div class="row">
  <div class="col-xs-12">
    <h3 id="DBDScoutingNotes">Scouting Tools.</h3>
    <?php if(isset($postAdded) && $postAdded == true) { ?>
         <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button> Your scouting notes were added successfully.
         </div>
    <?php } ?>
    <div id="scouting-tools-buttons" class="btn-group btn-group-justified" role="group">
         <h4 class="btn btn-danger viewnotes-toggle" type="button">View Existing Notes&nbsp;<span class="badge badge-important"><?php echo $notes_num; ?></span></h4>
         <h4 class="btn btn-danger addnotes-toggle" type="button">Add Your Notes</h4>
         <h4 class="btn btn-danger embed-generator" type="button">Share Video or Create GIF</h4>
    </div>
    <div class="visible-xs">
      <h4 class="btn btn-danger viewnotes-toggle">View Existing Notes&nbsp;<span class="badge badge-important"><?php echo $notes_num; ?></span></h4>
      <h4 class="btn btn-danger addnotes-toggle">Add Your Notes</h4>
      <h4 class="btn btn-danger embed-generator">Share Video or Create GIF</h4>
    </div>
    <?php include "partials/video-embed-tools.php"; ?>
    <div id="addnotes">
         <?php  if ( !is_user_logged_in()) { ?>
              <p>You must log in below or <a href="/join">join</a> in order to post your scouting notes.</p>
              <?php login_with_ajax(); ?>
         <?php } else { ?>
              <?php if(isset($hasError) ) { ?>
                   <div class="alert alert-danger">
                   <button type="button" class="close" data-dismiss="alert">&times;</button>There was an error submitting your scouting notes.
              </div>
         <?php } ?>
         <form id="new_post" name="new_post" method="post" action="<?php the_permalink(); ?>#DBDScoutingNotes">

              <fieldset class="control-group">
                    <h2><?php echo get_post_meta( get_the_ID(), '_notes_video', true); ?></h2>
                   <label for="headline" class="control-label">Headline</label>
                   <?php if($headlineError != '') { ?>
                        <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $headlineError;?></div>
                   <?php } ?>
                   <div class="controls">
                        <input type="text" id="headline" tabindex="1" size="20" name="headline" value="<?php if(isset($postAdded) && $postAdded == true) { echo ""; } elseif(isset($_POST['headline'])) echo $_POST['headline'];?>" class="requiredField" />
                   </div>
                   <div class="checkbox">
                    <label>
                      <input id="private_note" name="private_note" type="checkbox" value="checked"> Keep note private <em>(will not display in listings)</em>
                    </label>
                  </div>
                   <input type="hidden" id="notes_video" name="notes_video" value="<?php echo get_the_ID(); ?>" />
              </fieldset>

              <fieldset class="control-group">
                   <label for="notes" class="control-label">Your Scouting Notes</label>
                   <?php if($notesError != '') { ?>
                        <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $notesError;?></div>
                   <?php } ?>
                   <div class="controls">
                    <?php 
                      if(isset($postAdded) && $postAdded == true) {
                        $notesContent = '';
                      }
                      else {
                        $notesContent = $_POST['notes'];
                      }
                        // default settings - Kv_front_editor.php
                        $content = $notesContent;
                        $editor_id = 'notes';
                        $settings =   array(
                            'wpautop' => true, // use wpautop?
                            'media_buttons' => true, // show insert/upload button(s)
                            'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
                            'textarea_rows' => get_option('default_post_edit_rows', 20), // rows="..."
                            'tabindex' => '',
                            'editor_css' => '', //  extra styles for both visual and HTML editors buttons, 
                            // 'editor_class' => 'requiredField', // add extra class(es) to the editor textarea
                            'teeny' => false, // output the minimal editor config used in Press This
                            'dfw' => false, // replace the default fullscreen with DFW (supported on the front-end in WordPress 3.4)
                            'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
                            'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()
                        );
                    ?>
                    <?php wp_editor( $content, $editor_id, $settings ); ?>
                        <!-- <textarea id="notes" tabindex="2" name="notes" cols="100" rows="6" class="requiredField"><?php //if(isset($postAdded) && $postAdded == true) { echo ""; } elseif(isset($_POST['notes'])) { echo $_POST['notes']; } ?></textarea> -->
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

             <input type="submit" value="Post Notes" tabindex="3" id="submit" name="submit" class="btn btn-primary" />
             <input type="hidden" name="action" value="new_post" />
             <?php wp_nonce_field( 'snotes', 'submit_notes' ); ?>

         </form>
         <?php } ?>
    </div><!-- #addnotes -->

    <ul id="viewnotes">
    <?php
         global $current_user;
         get_currentuserinfo();
         $sponsornotes = new WP_Query( array( 
                                      'posts_per_page' => -1, 
                                      'post_type' => 'scoutingnotes', 
                                      'meta_key' => '_notes_video', 
                                      'meta_value' => get_the_ID(), 
                                      'meta_query' => array( 
                                          array( 
                                            'key' => 'sponsored', 
                                            'compare' => 'EXISTS' ), 
                                          array( 
                                            'key' => '_private_note', 
                                            'value' => 'checked', 
                                            'compare' => 'NOT LIKE' ) 
                                          ) 
                                      ) 
         );
         $generalnotes = new WP_Query( array( 
                                      'posts_per_page' => -1, 
                                      'post_type' => 'scoutingnotes', 
                                      'meta_key' => '_notes_video', 
                                      'meta_value' => get_the_ID(), 
                                      'meta_query' => array( 
                                        array( 
                                          'key' => 'sponsored', 
                                          'compare' => 'NOT EXISTS' ), 
                                        array( 
                                          'key' => '_private_note', 
                                          'value' => 'checked', 
                                          'compare' => 'NOT LIKE' ) 
                                        ) 
                                      ) 
         );

         while ($sponsornotes->have_posts()) : $sponsornotes->the_post(); ?>
              <li id="notes-<?php the_ID(); ?>" class="scout-notes sponsor-notes">
                   <?php $edit_link = add_query_arg('post', get_the_ID(), get_permalink(251970 + $_POST['_wp_http_referer'])); ?>
                   <?php 
                        $author_id = get_the_author_meta( 'ID' );   
                        $author_name = get_the_author_meta( 'user_nicename' );                 
                        $twitter_img_url = get_twitter_avatar( get_the_author_meta('twitter', $author_id) );

                   ?>
                   <a href="<?php bloginfo('url'); ?>/members/<?php echo $author_name; ?>"><img class="note-author-photo" src="<?php echo $twitter_img_url;?>" /></a>
                   <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                   <p class="written-by scoutnotes-meta">Submitted by <a href="<?php bloginfo('url'); ?>/members/<?php echo $author_name; ?>"><?php the_author(); ?></a> on <?php the_time('l, F jS, Y'); ?><?php if ($post->post_author == $current_user->ID) { echo '&nbsp;&nbsp;<a href="' . $edit_link . '" class="newPopUp">(Edit/Delete)</a>'; } ?></p>
                   <hr />
                   <div class="scoutnotes-content">
                        <?php the_content(); ?>
                   </div>
                   <div class="scoutnotes-comments">
                        <?php comments_template( '/notes-comments.php', true ); ?>
                   </div><!-- .scoutnotes-comments -->
              </li>
         <?php endwhile;

         while ($generalnotes->have_posts()) : $generalnotes->the_post(); ?>
              <li id="notes-<?php the_ID(); ?>" class="scout-notes">
                   <?php $edit_link = add_query_arg('post', get_the_ID(), get_permalink(251970 + $_POST['_wp_http_referer'])); ?>
                   <?php 
                               
                        $author_id = get_the_author_meta( 'ID' );  
                        $author_name = get_the_author_meta( 'user_nicename' );           
                        $twitter_img_url = get_twitter_avatar( get_the_author_meta('twitter', $author_id) );

                   ?>
                   <a href="<?php bloginfo('url'); ?>/members/<?php echo $author_name; ?>"><img class="note-author-photo" src="<?php echo $twitter_img_url;?>" /></a>
                   <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                   <p class="written-by scoutnotes-meta">Submitted by <a href="<?php bloginfo('url'); ?>/members/<?php echo $author_name; ?>"><?php the_author(); ?></a> on <?php the_time('l, F jS, Y'); ?><?php if ($post->post_author == $current_user->ID) { echo '&nbsp;&nbsp;<a href="' . $edit_link . '" class="newPopUp">(Edit/Delete)</a>'; } ?></p>
                   <hr />
                   <div class="scoutnotes-content">
                        <?php the_content(); ?>
                   </div>
                   <div class="scoutnotes-comments">
                        <?php comments_template( '/notes-comments.php', true ); ?>
                        
                   </div><!-- .scoutnotes-comments -->
              </li>
         <?php endwhile; ?>
    	<?php if ( ( $sponsornotes->have_posts() ) || ( $generalnotes->have_posts() ) ) : ?>
              <?php 
                   
                   
                   
                   comment_form( array (
                        'title_reply'  => __( 'Add Your Comment/Reply' ),
                        // remove "Text or HTML to be displayed after the set of comment fields"
                        'comment_notes_after' => '',
                   ) ); 
              ?>
         <?php else : ?>
         <p>No scouting notes have been added yet.</p>
    	    <?php endif; ?>
         <?php wp_reset_postdata(); ?>
    </ul><!-- #viewnotes -->
  </div>
</div>