<?php
/**
 * page-member-settings.php
 *
 * @package Earl
 */


	$current_user = wp_get_current_user();

	if ( !$current_user ) {
		wp_redirect( home_url() );
	}

	if ( isset($_GET['username']) ) {

		$displayTools = true;

		if ( $_GET['username'] != $current_user->user_login ) {
			wp_redirect( home_url() );
		}

		else {
			$first_name = get_the_author_meta('first_name', $current_user->ID);
			$last_name = get_the_author_meta('last_name', $current_user->ID);
			$display_name = get_the_author_meta('display_name', $current_user->ID);
			$email = get_the_author_meta('user_email', $current_user->ID);
			$description = get_the_author_meta('description', $current_user->ID);
			$twitter = get_the_author_meta('twitter', $current_user->ID);
			$facebook = get_the_author_meta('facebook', $current_user->ID);
			$google = get_the_author_meta('google', $current_user->ID);
			$youtube = get_the_author_meta('youtube', $current_user->ID);
			$website = $current_user->user_url;
		}

	}

	if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "settings_posted") {

		if (wp_verify_nonce($_POST['settings_posted'], 'memberSettings')) {

			if ( isset($_POST['username']) ) {
		
				if ( $_POST['username'] != $current_user->user_login ) {
					wp_redirect( home_url() );
				}

				if ( $_POST['first_name'] === '' ) {
		            $first_nameError = 'A first name is required.';
		            $hasError = true;
		        } else {
		            $first_name = $_POST['first_name'];
		        }

		        if ( $_POST['last_name'] === '' ) {
		            $last_nameError = 'A last name is required.';
		            $hasError = true;
		        } else {
		            $last_name = $_POST['last_name'];
		        }

		        if ( $_POST['display_name'] === '' ) {
		            $display_nameError = 'A display name is required.';
		            $hasError = true;
		        } else {
		            $display_name = $_POST['display_name'];
		        }

		        if ( $_POST['user_email'] === '' ) {
		            $emailError = 'An email address is required.';
		            $hasError = true;
		        } else {
		            $user_email = $_POST['user_email'];
		        }


		        if ( isset($_POST['new_password']) && isset($_POST['password_confirm']) && !isset($_POST['current_password']) ) {

		        	$passwordError = 'You must enter your current password to change it. Please try again.';
				    $hasError = true;
		        } 

		        if ( isset($_POST['current_password']) && isset($_POST['new_password']) && !isset($_POST['password_confirm']) ) {

		        	if ($passwordError) {
	        			$passwordError = $passwordError.'<br />You must enter a new password and confirm it in the next field. Please try again.';
	        			$hasError = true;
	        		}
	        		else {
	        			$passwordError = 'You must enter a new password and confirm it in the next field. Please try again.';
			        	$hasError = true;
	        		}
		        }

		        if ( isset($_POST['current_password']) && isset($_POST['password_confirm']) && !isset($_POST['new_password']) ) {

		        	if ($passwordError) {
	        			$passwordError = $passwordError.'<br />You forgot to enter a new password. Please try again.';
	        			$hasError = true;
	        		}
	        		else {
	        			$passwordError = 'You forgot to enter a new password. Please try again.';
			        	$hasError = true;
	        		}
		        }


		        if ( $_POST['current_password'] != "" && isset($_POST['new_password']) && isset($_POST['password_confirm']) ) {

		        	
	        		// check current password first

		        	$user_info = get_userdata($current_user->ID);
      				$user_pass = $user_info->user_pass;


					$plain_password = $_POST['current_password'];

					if ( wp_check_password( $_POST['current_password'], $user_pass, $current_user->ID) ) {
					    
			        	// check the new password and confirm match
			        	if ( $_POST['new_password'] != $_POST['password_confirm'] ) {
				        	$passwordError = 'Your passwords do not match. Please try again.';
				        	$hasError = true;
				        }

				        else {
				        	$new_password = $_POST['new_password'];
				        	wp_set_password( $new_password, $current_user->ID );

				        	$passwordSavedAlert = 'Your password has successfully been updated!';
				        }

					} 
					
					else {
					    $currentPasswordError = 'Your current password was not correct. Please try again.';
			        	$hasError = true;
					}
		        

		        }

		        

		        if ( !isset($hasError) ) {
		        	wp_update_user( array( 
							'ID' => $current_user->ID, 
							'user_url' => wp_strip_all_tags($_POST['user_url']),
							'first_name' => wp_strip_all_tags($first_name),
							'last_name' => wp_strip_all_tags($last_name),
							'display_name' => wp_strip_all_tags($display_name),
							'user_email' => wp_strip_all_tags($user_email),
							'description' => wp_strip_all_tags($_POST['description'])
							) 
					);

					update_user_meta( $current_user->ID, 'twitter', wp_strip_all_tags($_POST['twitter']));
					update_user_meta( $current_user->ID, 'facebook', wp_strip_all_tags($_POST['facebook']));
					update_user_meta( $current_user->ID, 'google', wp_strip_all_tags($_POST['google']));
					update_user_meta( $current_user->ID, 'youtube', wp_strip_all_tags($_POST['youtube']));


					$first_name = get_the_author_meta('first_name', $current_user->ID);
					$last_name = get_the_author_meta('last_name', $current_user->ID);
					$display_name = get_the_author_meta('display_name', $current_user->ID);
					$email = get_the_author_meta('user_email', $current_user->ID);
					$description = get_the_author_meta('description', $current_user->ID);
					$twitter = get_the_author_meta('twitter', $current_user->ID);
					$facebook = get_the_author_meta('facebook', $current_user->ID);
					$google = get_the_author_meta('google', $current_user->ID);
					$youtube = get_the_author_meta('youtube', $current_user->ID);
					$website = $_POST['user_url'];

					$savedAlert = 'Your settings have successfully been updated!';
		        }
				
			}

		}
		else {
			$nonceError = 'Invalid nonce.';
      		$hasError = true;
		}
	}

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col" style="padding-top: 10px;">
			<?php if(isset($hasError) ) { ?>
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>There was an error updating your settings.
                    </div>
                <?php } ?>
                <?php if(isset($savedAlert) ) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $savedAlert; ?>
                    </div>
                <?php } ?>
                <?php if(isset($passwordSavedAlert) ) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $passwordSavedAlert; ?>
                    </div>
                <?php } ?>

                <?php 
					if ( $displayTools ) {
					?>
					<div class="btn-group" style="float: right;">
				  		<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Tools&nbsp;<span class="caret"></span></button>
				  		<ul class="dropdown-menu" style="margin-left: -92px; text-align: left;">
				    		<li><a href="<?php bloginfo('url'); ?>/article-editor">Add New Article</a></li>
				    		<li><a href="<?php bloginfo('url'); ?>/mockdraft-editor">Add New Mock Draft</a></li>
				    		<li><a href="<?php bloginfo('url'); ?>/members/<?php echo $current_user->user_login; ?>">View Member Page</a></li>
				  		</ul>
					</div>
					<?php 
				} ?>
				
				<form action="" method="post" class="member-settings form-horizontal">
  					<fieldset>
    					<legend>Member Settings</legend>
    					<?php 
    						if($first_nameError != '') { ?>
	                         	<div class="alert alert-danger col-sm-12"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $first_nameError;?></div>
	                      	<?php } 
	                    ?>
    					<div class="form-group <?php if($first_nameError != '') { echo 'has-error'; } ?>">
	    					<label class="col-sm-2 control-label">First Name</label>
	                      	<div class="col-sm-10">
    							<input class="form-control" type="text" placeholder="First Name" name="first_name" value="<?php echo $first_name; ?>" />
    						</div>
    					</div>
    					<?php 
    						if($last_nameError != '') { ?>
	                         	<div class="alert alert-danger col-sm-12"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $last_nameError;?></div>
	                      	<?php } 
	                    ?>
    					<div class="form-group <?php if($last_nameError != '') { echo 'has-error'; } ?>">
	    					<label class="col-sm-2 control-label">Last Name</label>
	                      	<div class="col-sm-10">
	    						<input class="form-control" type="text" placeholder="Last Name" name="last_name" value="<?php echo $last_name; ?>" />
	    					</div>
	    				</div>
	    				<?php 
	    					if($display_nameError != '') { ?>
	                         	<div class="alert alert-danger col-sm-12"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $display_nameError;?></div>
	                      	<?php } 
	                    ?>
	    				<div class="form-group <?php if($display_nameError != '') { echo 'has-error'; } ?>">
	    					<label class="col-sm-2 control-label">Display Name</label>
	                      	<div class="col-sm-10">
		    					<input class="form-control" type="text" placeholder="Display Name" name="display_name" value="<?php echo $display_name; ?>" />
		    					<span class="help-block">Chose how you want your name displayed throughout Draft Breakdown</span>
		    				</div>
	    				</div>
	    				<?php 
	    					if($currentPasswordError != '') { ?>
	                         	<div class="alert alert-danger col-sm-12"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $currentPasswordError;?></div>
	                      	<?php } 
	                    ?>
	    				<div class="form-group <?php if($currentPasswordError != '') { echo 'has-error'; } ?>">
	    					<label class="col-sm-2 control-label">Current Password</label>
	                      	<div class="col-sm-10">
	    						<input class="form-control" type="password" placeholder="Current Password" name="current_password" >
	    					</div>
	    				</div>
	    				<?php 
	    					if($passwordError != '') { ?>
	                         	<div class="alert alert-danger col-sm-12"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $passwordError;?></div>
	                      	<?php } 
	                    ?>
	    				<div class="form-group <?php if($passwordError != '') { echo 'has-error'; } ?>">
	    					<label class="col-sm-2 control-label">New Password</label>
	                      	<div class="col-sm-10">
	    						<input class="form-control" type="password" placeholder="New Password" name="new_password" >
	    					</div>
	    				</div>
	    				<div class="form-group">
	    					<label class="col-sm-2 control-label">Confirm Password</label>
	    					<div class="col-sm-10">
	    						<input class="form-control" type="password" placeholder="Confirm Password" name="password_confirm" >
	    					</div>
	    				</div>
	    				<?php 
	    					if($emailError != '') { ?>
	                         	<div class="alert alert-danger col-sm-12"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $emailError;?></div>
	                      	<?php } 
	                    ?>
	    				<div class="form-group <?php if($emailError != '') { echo 'has-error'; } ?>">
	    					<label class="col-sm-2 control-label">E-Mail</label>
	                      	<div class="col-sm-10">
	    						<input class="form-control" type="text" placeholder="E-mail" name="user_email" value="<?php echo $email; ?>" />
	    					</div>
	    				</div>
	    				<div class="form-group">
	    					<label class="col-sm-2 control-label">Biography</label>
	    					<div class="col-sm-10">
		    					<textarea class="form-control" rows="5" name="description" ><?php echo $description; ?></textarea>
		    					<span class="help-block">Let readers know a little bit about you. This will appear on your home page.</span>
		    				</div>
	    				</div>
	    				<div class="form-group">
	    					<label class="col-sm-2 control-label">Twitter username</label>
	    					<div class="col-sm-10">
	    						<input class="form-control" type="text" placeholder="Twitter username" name="twitter" value="<?php echo $twitter; ?>" />
	    					</div>
	    				</div>
	    				<div class="form-group">
	    					<label class="col-sm-2 control-label">Facebook URL</label>
	    					<div class="col-sm-10">
	    						<input class="form-control" type="text" placeholder="Facebook URL" name="facebook" value="<?php echo $facebook; ?>" />
	    					</div>
	    				</div>
	    				<div class="form-group">
	    					<label class="col-sm-2 control-label">Google+ URL</label>
	    					<div class="col-sm-10">
	    						<input class="form-control" type="text" placeholder="Google+ URL" name="google" value="<?php echo $google; ?>" />
	    					</div>
	    				</div>
	    				<div class="form-group">
	    					<label class="col-sm-2 control-label">YouTube username</label>
	    					<div class="col-sm-10">
	    						<input class="form-control" type="text" placeholder="YouTube Username" name="youtube" value="<?php echo $youtube; ?>" />
	    					</div>
	    				</div>
	    				<div class="form-group">
	    					<label class="col-sm-2 control-label">Website</label>
	    					<div class="col-sm-10">
		    					<input class="form-control" type="text" placeholder="Website" name="user_url" value="<?php echo $website; ?>" />
		    					<span class="help-block">Have your own website outside of Draft Breakdown? That's okay. List it here!</span>
		    				</div>
	    				</div>
    					
    					<input type="hidden" name="username" value="<?php echo $current_user->user_login; ?>" />
    					<input type="hidden" name="action" value="settings_posted" />
    					<?php wp_nonce_field( 'memberSettings', 'settings_posted' ); ?>

    					<div class="form-group">
    						<div class="col-sm-offset-2 col-sm-10">
    							<button type="submit" class="btn btn-primary">Update</button>
    						</div>
    					</div>
  					</fieldset>
				</form>

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