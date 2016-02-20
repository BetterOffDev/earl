<?php
/**
 * page-edit-class.php
 *
 * @package bootstrapped
 */

date_default_timezone_set('America/New_York');

if ( isset($_GET['class']) ) {
   
   // we're editing a new post
   if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) &&  $_POST['action'] == "class_posted") {

      if (wp_verify_nonce($_POST['class_posted'], 'classPost')) {

         // Do some minor form validation to make sure there is content
         if (isset($_POST['submit'])) {

            $current_user = wp_get_current_user();  
            
            //Check to make sure that the title field is not empty
            if ($_POST['class_title'] === '') {
               $titleError = 'You forgot to enter a title.';
               $hasError = true;    
            }

            else {
               $event_title = $_POST['class_title'];
            }

            //Check to make sure content was entered
            if ($_POST['class_description'] === '') {
               $descriptionError = 'You forgot to enter your class description.';
               $hasError = true;
            }

            else {
               $event_description = $_POST['class_description'];
            }


            //Check to make sure a city was entered
            if ($_POST['_wsdev_event_city'] === '') {
               $cityError = 'You forgot to enter a city.';
               $hasError = true;
            }

            else {
               $event_city = $_POST['_wsdev_event_city'];
            }

            //Check to make sure a state was selected
            if ($_POST['_wsdev_event_state'] === '') {
               $stateError = 'You forgot to select a state.';
               $hasError = true;
            }

            else {
               $event_state = $_POST['_wsdev_event_state'];
            }

            //Check to make sure a zipcode was entered
            if ($_POST['_wsdev_event_zip'] === '') {
               $zipError = 'You forgot to select a state.';
               $hasError = true;
            }

            else {
               $event_zip = $_POST['_wsdev_event_zip'];
            }

            //Check to make sure a website was entered
            if ($_POST['_wsdev_event_website'] === '') {
               $websiteError = 'Please enter a valid website URL, including "http://"" or "https://".';
               $hasError = true;
            }

            else {
               $event_website = $_POST['_wsdev_event_website'];
            }

            //Check to make sure a job open date was entered
            if ($_POST['_wsdev_event_date'] === '') {
               $eventDateError = 'You forgot to add a class start date.';
               $hasError = true;
            }

            else {
               $event_start_date = $_POST['_wsdev_event_date'];
            }

            //Check to make sure an event end date was entered
            if ($_POST['_wsdev_event_date_end'] === '') {
               $eventEndDateError = 'You forgot to enter a class end date.';
               $hasError = true;
            }

            else {
               $event_date_end = $_POST['_wsdev_event_date_end'];
            }

            //Check to make sure an event end date was entered
            if ($_POST['_wsdev_event_address'] === '') {
               $addressError = 'You forgot to enter a class address.';
               $hasError = true;
            }

            else {
               $event_address = $_POST['_wsdev_event_address'];
            }

            //Check to make sure an event end date was entered
            if ($_POST['_wsdev_event_cost'] === '') {
               $costError = 'You forgot to enter a class cost.';
               $hasError = true;
            }

            else {
               $event_cost = $_POST['_wsdev_event_cost'];
            }

            //Check to make sure an event topic was entered
            if ($_POST['_wsdev_event_topic'] === '') {
               $topicError = 'You forgot to select a class topic.';
               $hasError = true;
            }

            else {
               $event_topic = $_POST['_wsdev_event_topic'];
            }

            
            if ($_POST['_wsdev_event_contact_person'] === '') {
               $event_contact_person = '';
            }

            else {
               $event_contact_person = $_POST['_wsdev_event_contact_person'];
            }

            
            if ($_POST['_wsdev_event_contact_email'] === '') {
               $event_contact_email = '';
            }

            else {
               $event_contact_email = $_POST['_wsdev_event_contact_email'];
            }

            if ($_POST['_wsdev_event_contact_phone'] === '') {
               $event_contact_phone = '';
            }

            else {
               $event_contact_phone = $_POST['_wsdev_event_contact_phone'];
            }

            if (!isset($hasError)) {

               // Add the form input to $updated_post array
               if (empty($error)) {

                  $new_post = array(
                     'post_title'  =>  wp_strip_all_tags( $_POST['class_title'] ),
                     'post_content'    =>  $_POST[ 'class_description' ],
                     'post_author' => $current_user->ID,
                     'post_name' => sanitize_title( $_POST['class_title'] ),
                     'post_date' => date('Y-m-d H:i:s'),
                     'post_date_gmt' => date('Y-m-d H:i:s', strtotime('+4 hours')),
                     'post_status' =>  'publish',  // Choose: publish, preview, future, draft, etc.
                     'post_type'      =>   'event'  //'post','page' or CPT
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


      if (isset($_POST['_wsdev_event_address'])) {

      	$event_address = $_POST['_wsdev_event_address'];
      	if (get_post_meta($post_id, '_wsdev_event_address', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_address', $event_address);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_address', $event_address);
        }

      }
      
      if (isset($_POST['_wsdev_event_city'])) {

      	$event_city = $_POST['_wsdev_event_city'];
      	if (get_post_meta($post_id, '_wsdev_event_city', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_city', $event_city);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_city', $event_city);
        }

      }

      if (isset($_POST['_wsdev_event_state'])) {

      	$event_state = $_POST['_wsdev_event_state'];
      	if (get_post_meta($post_id, '_wsdev_event_state', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_state', $event_state);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_state', $event_state);
        }

      }

      if (isset($_POST['_wsdev_event_zip'])) {

      	$event_zip = $_POST['_wsdev_event_zip'];
      	$zipNumeric = preg_replace('/\D/', '', $event_zip);
      	if (get_post_meta($post_id, '_wsdev_event_zip', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_zip', $zipNumeric);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_zip', $zipNumeric);
        }

      }

      if (isset($_POST['_wsdev_event_website'])) {

      	$event_website = $_POST['_wsdev_event_website'];
      	if (get_post_meta($post_id, '_wsdev_event_website', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_website', $event_website);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_website', $event_website);
        }

      }

      if (isset($_POST['_wsdev_event_date'])) {

      	$event_date = strtotime($_POST['_wsdev_event_date']);
      	if (get_post_meta($post_id, '_wsdev_event_date', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_date', $event_date);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_date', $event_date);
        }

      }

      if (isset($_POST['_wsdev_event_date_end'])) {

      	$event_date_end = strtotime($_POST['_wsdev_event_date_end']);
      	if (get_post_meta($post_id, '_wsdev_event_date_end', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_date_end', $event_date_end);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_date_end', $event_date_end);
        }

      }

      if (isset($_POST['_wsdev_event_contact_person'])) {

      	$event_contact = $_POST['_wsdev_event_contact_person'];
      	if (get_post_meta($post_id, '_wsdev_event_contact_person', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_contact_person', $event_contact);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_contact_person', $event_contact);
        }

      }

      if (isset($_POST['_wsdev_event_contact_email'])) {

      	$event_contact_email = $_POST['_wsdev_event_contact_email'];
      	if (get_post_meta($post_id, '_wsdev_event_contact_email', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_contact_email', $event_contact_email);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_contact_email', $event_contact_email);
        }

      }

      if (isset($_POST['_wsdev_event_contact_phone'])) {

      	$event_contact_phone = $_POST['_wsdev_event_contact_phone'];
      	$phoneNumeric = preg_replace('/\D/', '', $event_contact_phone);
      	if (get_post_meta($post_id, '_wsdev_event_contact_phone', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_contact_phone', $phoneNumeric);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_contact_phone', $phoneNumeric);
        }

      }

      if (isset($_POST['_wsdev_event_cost'])) {

      	$event_cost = $_POST['_wsdev_event_cost'];
      	$costNumeric = preg_replace('/\D/', '', $event_cost);
      	if (get_post_meta($post_id, '_wsdev_event_cost', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_cost', $costNumeric);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_cost', $costNumeric);
        }

      }

      if (isset($_POST['_wsdev_event_topic'])) {

      	$event_topic = $_POST['_wsdev_event_topic'];
      	if (get_post_meta($post_id, '_wsdev_event_topic', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_topic', $event_topic);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_topic', $event_topic);
        }

      }

      if (isset($_POST['_wsdev_event_bold'])) {

      	$event_bold = $_POST['_wsdev_event_bold'];
      	if (get_post_meta($post_id, '_wsdev_event_bold', FALSE)) { 
            update_post_meta($post_id, '_wsdev_event_bold', $event_bold);
        } 
        else { 
           add_post_meta($post_id, '_wsdev_event_bold', $event_bold);
        }

      }

      // send SMS and email alerts
      wsdev_send_sms_for_event( $post_id );

      // update post listing user meta
      // $post_author_id = get_post_field( 'post_author', $post_id );
      // $available_listings = get_the_author_meta('_wsdev_listings', $post_author_id);
      // $available_listings = $available_listings - 1;
      // update_user_meta( $post_author_id, '_wsdev_listings', $available_listings);

      // update bold listing user meta
      // $bold = get_post_meta($post_id, '_wsdev_event_bold', true);
      //   if ($bold == 'on') {
      //       $available_bold_listings = get_the_author_meta('_wsdev_bold_listings', $post_author_id);
      //       $available_bold_listings = $available_bold_listings - 1;
      //       update_user_meta( $post_author_id, '_wsdev_bold_listings', $available_bold_listings);
      //   }

      if($post_id) {
        // $author = get_post_field( 'post_author', $post_id );
        // $author_name = get_the_author_meta('user_login', $author);
        wp_redirect( get_permalink($post_id) );
      }

   }
}

else {
  header('Location: ' . get_bloginfo('url'));
}

if ( !is_user_logged_in() ) {
    header('Location: ' . get_bloginfo('url'));
}

get_header(); 

  ?>
	<div class="row">
		<div class="col-md-7">
          	<?php while (have_posts()) : the_post(); ?>
	            <h1 class="page-title"><?php the_title(); ?></h1> 
	            
	            
        		<form action="" method="post">
        			<div class="form-group">
        				<?php if($titleError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $titleError;?></div>
	                  	<?php } ?>
        				<label for="class_title">Class Title <span class="required">*</span><br/><span style="font-weight: normal;">(Avoid using ALL CAPS)</span></label>
        				<input class="form-control" id="class_title" type="text" name="class_title" placeholder="" value="<?php echo $event_title; ?>" size="40">
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<?php if($descriptionError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $descriptionError;?></div>
	                  	<?php } ?>
    					<label for="class_description">Class Description <span class="required">*</span></label>
    					<textarea class="form-control" id="class_description" name="class_description" placeholder="" rows="5" cols="25"><?php echo $event_description; ?></textarea>
        				<span class="help-block"></span>
        			</div>

        			<div class="form-group">
        				<?php if($eventDateError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $eventDateError;?></div>
	                  	<?php } ?>
        				<label for="_wsdev_event_date">Class start date <span class="required">*</span></label>
        				<input id="_wsdev_event_date" type="text" class="form-control" name="_wsdev_event_date" value="<?php echo $event_start_date; ?>" size="30">
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<?php if($eventEndDateError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $eventEndDateError;?></div>
	                  	<?php } ?>
    					<label for="_wsdev_event_date_end">Class end date <span class="required">*</span></label>
    					<input id="_wsdev_event_date_end" type="text" class="form-control" name="_wsdev_event_date_end" value="<?php echo $event_date_end; ?>" size="30">
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<?php if($addressError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $addressError;?></div>
	                  	<?php } ?>
    					<label for="_wsdev_event_address">Street address <span class="required">*</span></label>
    					<input class="form-control" id="_wsdev_event_address" type="text" name="_wsdev_event_address" placeholder="" value="<?php echo $event_address; ?>" size="40">
   		 				<span class="help-block"></span>
   		 			</div>

   		 			<div class="form-group">
   		 				<?php if($cityError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $cityError;?></div>
	                  	<?php } ?>
   		 				<label for="_wsdev_event_city">City <span class="required">*</span></label>
   		 				<input class="form-control" id="_wsdev_event_city" type="text" name="_wsdev_event_city" placeholder="" value="<?php echo $event_city; ?>" size="40">
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<?php if($stateError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $stateError;?></div>
	                  	<?php } ?>
    					<label for="_wsdev_event_state">State <span class="required">*</span></label>
    					<select class="form-control" name="_wsdev_event_state">
							<option value=""> - select state -</option>
        					<option value="AL">AL</option>
                            <option value="AK">AK</option>
                            <option value="AR">AR</option>
                            <option value="AZ">AZ</option>
                            <option value="CA">CA</option>
                            <option value="CO">CO</option>
                            <option value="CT">CT</option>
                            <option value="DC">DC</option>
                            <option value="DE">DE</option>
                            <option value="FL">FL</option>
                            <option value="GA">GA</option>
                            <option value="HI">HI</option>
                            <option value="IA">IA</option>
                            <option value="ID">ID</option>
                            <option value="IL">IL</option>
                            <option value="IN">IN</option>
                            <option value="KS">KS</option>
                            <option value="KY">KY</option>
                            <option value="LA">LA</option>
                            <option value="MA">MA</option>
                            <option value="MD">MD</option>
                            <option value="ME">ME</option>
                            <option value="MI">MI</option>
                            <option value="MN">MN</option>
                            <option value="MO">MO</option>
                            <option value="MS">MS</option>
                            <option value="MT">MT</option>
                            <option value="NC">NC</option>
                            <option value="ND">ND</option>
                            <option value="NE">NE</option>
                            <option value="NH">NH</option>
                            <option value="NJ">NJ</option>
                            <option value="NM">NM</option>
                            <option value="NV">NV</option>
                            <option value="NY">NY</option>
                            <option value="OH">OH</option>
                            <option value="OK">OK</option>
                            <option value="OR">OR</option>
                            <option value="PA">PA</option>
                            <option value="RI">RI</option>
                            <option value="SC">SC</option>
                            <option value="SD">SD</option>
                            <option value="TN">TN</option>
                            <option value="TX">TX</option>
                            <option value="UT">UT</option>
                            <option value="VA">VA</option>
                            <option value="VT">VT</option>
                            <option value="WA">WA</option>
                            <option value="WI">WI</option>
                            <option value="WV">WV</option>
                            <option value="WY">WY</option>
                        </select>
						<span class="help-block"></span>
					</div>

					<div class="form-group">
						<?php if($zipError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $zipError;?></div>
	                  	<?php } ?>
						<label for="_wsdev_event_zip">Zip code <span class="required">*</span></label>
						<input class="form-control" id="_wsdev_event_zip" type="text" name="_wsdev_event_zip" placeholder="" value="<?php echo $event_zip; ?>" size="40">
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<?php if($costError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $costError;?></div>
	                  	<?php } ?>
    					<label for="_wsdev_event_cost">Class cost <span class="required">*</span></label>
    					<div class="input-group">
								<div class="input-group-addon">$</div>
    						<input class="form-control" id="_wsdev_event_cost" type="text" name="_wsdev_event_cost" placeholder="" value="<?php echo $event_cost; ?>" size="40">
    						<div class="input-group-addon">.00</div>
						</div>
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<?php if($websiteError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $websiteError;?></div>
	                  	<?php } ?>
    					<label for="_wsdev_event_website">Website <span class="required">*</span></label>
    					<input id="_wsdev_event_website" type="url" class="form-control" name="_wsdev_event_website" placeholder="" value="<?php echo $event_website; ?>" size="40">
    					<span class="help-block">Please include http:// or https://. Example: "http://www.thinbluetraining.com"</span>
    				</div>

    				<div class="form-group">
    					<label for="_wsdev_event_contact_person">Contact person</label>
    					<input class="form-control" id="_wsdev_event_contact_person" type="text" name="_wsdev_event_contact_person" placeholder="" value="<?php echo $event_contact_person; ?>" size="40">
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<label for="_wsdev_event_contact_email">Contact email</label>
    					<input class="form-control" id="_wsdev_event_contact_email" type="text" name="_wsdev_event_contact_email" placeholder="" value="<?php echo $event_contact_email; ?>" size="40">
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<label for="_wsdev_event_contact_phone">Contact phone</label>
    					<input class="form-control" id="_wsdev_event_contact_phone" type="text" name="_wsdev_event_contact_phone" placeholder="" value="<?php echo $event_contact_phone; ?>" size="40">
    					<span class="help-block"></span>
    				</div>

    				<div class="form-group">
    					<?php if($topicError != '') { ?>
	                     	<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><?php echo $topicError;?></div>
	                  	<?php } ?>
    					<label for="_wsdev_event_topic">Class topics <span class="required">*</span><br /><span style="font-weight: normal;">(Up to 5)</span></label>
    					<select class="form-control" name="_wsdev_event_topic[]">
    						<option value="">--</option>
        					<option value="Accident Investigation">Accident Investigation</option>
			                <option value="Accident Reconstruction">Accident Reconstruction</option>	
			                <option value="Active Shooter">Active Shooter</option>				                    
			                <option value="Administration">Administration</option>				                    
			                <option value="Aquatic Investigations">Aquatic Investigations</option>	
			                <option value="Ambush">Ambush</option>				                    
			                <option value="Armorer">Armorer</option>				                    
			                <option value="Arrest &amp; Control">Arrest &amp; Control</option>	
			                <option value="Arson">Arson</option>				                    
			                <option value="Asset Forfeiture">Asset Forfeiture</option>				                    
			                <option value="Assault">Assault</option>				                    
			                <option value="Autism">Autism</option>				                    
			                <option value="Auto Theft">Auto Theft</option>				                    
			                <option value="Background Investigations">Background Investigations</option>	
			                <option value="Bicycle Accidents">Bicycle Accidents</option>				                    
			                <option value="Bicycle Operations">Bicycle Operations</option>				                    
			                <option value="Body Worn Cameras">Body Worn Cameras</option>				                    
			                <option value="Breaching">Breaching</option>				                    
			                <option value="Budgeting">Budgeting</option>				                    
			                <option value="Burglary">Burglary</option>				                    
			                <option value="Cameras- Body Worn">Cameras- Body Worn</option>				                    
			                <option value="Canine">Canine</option>				                    
			                <option value="Cartel">Cartel</option>				                    
			                <option value="Case Management">Case Management</option>				                    
			                <option value="Casualty Training">Casualty Training</option>				                    
			                <option value="Cellphone Investigations">Cellphone Investigations</option>	
			                <option value="Chemical Aerosol">Chemical Aerosol</option>				                    
			                <option value="Child Abuse">Child Abuse</option>				                    
			                <option value="Child Death">Child Death</option>				                    
			                <option value="Child Exploitation">Child Exploitation</option>				                    
			                <option value="Child Porn">Child Porn</option>				                    
			                <option value="Citizen Academies">Citizen Academies</option>				                    
			                <option value="College &amp; University">College &amp; University</option>	
			                <option value="Communications">Communications</option>				                    
			                <option value="Community Policing">Community Policing</option>				                    
			                <option value="Computer Crimes">Computer Crimes</option>				                    
			                <option value="Computer Forensics">Computer Forensics</option>				                    
			                <option value="Concealment">Concealment</option>				                    
			                <option value="Conference &amp; Events">Conference &amp; Events</option>	
			                <option value="Confidential Informants">Confidential Informants</option>
			                <option value="Conflict Resolution">Conflict Resolution</option>	
			                <option value="Confrontation Avoidance">Confrontation Avoidance</option>	
			                <option value="Conservation in Law Enforcement">Conservation in Law Enforcement</option>	
			                <option value="Corrections">Corrections</option>				                    
			                <option value="Courthouse">Courthouse</option>				                    
			                <option value="Courtroom Testimony">Courtroom Testimony</option>	
			                <option value="Craigslist">Craigslist</option>				                    
			                <option value="Critical Incident Command">Critical Incident Command</option>	
			                <option value="Crime Prevention">Crime Prevention</option>				                    
			                <option value="Crime Scene Investigation">Crime Scene Investigation</option>
			                <option value="Crisis &amp; Hostage">Crisis &amp; Hostage</option>	
			                <option value="Custodial Death">Custodial Death</option>				                    
			                <option value="Cyberbullying">Cyberbullying</option>				                    
			                <option value="Deaf &amp; Hard of Hearing">Deaf &amp; Hard of Hearing</option>	
			                <option value="Deescalation">Deescalation</option>				                    
			                <option value="Defensive Tactics">Defensive Tactics</option>				                    
			                <option value="Detective Workshop">Detective Workshop</option>				                    
			                <option value="Dispatcher">Dispatcher</option>				                    
			                <option value="Disruptive Students">Disruptive Students</option>
			                <option value="Domestic Violence">Domestic Violence</option>				                    
			                <option value="Drug Diversion">Drug Diversion</option>				                    
			                <option value="Drugs">Drugs</option>				                    
			                <option value="DUI">DUI</option>				                    
			                <option value="DWI">DWI</option>				                    
			                <option value="Electronic Control Device">Electronic Control Device</option>	
			                <option value="Electronic Countermeasures">Electronic Countermeasures</option>	
			                <option value="Emergency Medicine">Emergency Medicine</option>				                    
			                <option value="EMT">EMT</option>				                    
			                <option value="Entry">Entry</option>				                    
			                <option value="Evaluation">Evaluation</option>				                    
			                <option value="Evidence">Evidence</option>				                    
			                <option value="Executive Protection">Executive Protection</option>	
			                <option value="Expandable Baton">Expandable Baton</option>				                    
			                <option value="Explosives">Explosives</option>				                    
			                <option value="Explosive Breaching">Explosive Breaching</option>
			                <option value="Facebook">Facebook</option>				                    
			                <option value="Fatality Accident Investigations">Fatality Accident Investigations</option>
			                <option value="Field Training Officer">Field Training Officer</option>		
			                <option value="Financial">Financial</option>				                    
			                <option value="Fingerprinting">Fingerprinting</option>				                    
			                <option value="Firearms">Firearms</option>				                    
			                <option value="Fitness">Fitness</option>				                    
			                <option value="Foreign Languages">Foreign Languages</option>				                    
			                <option value="Forensics">Forensics</option>				                    
			                <option value="Fraud Investigations">Fraud Investigations</option>	
			                <option value="Gaming">Gaming</option>				                    
			                <option value="Gangs">Gangs</option>				                    
			                <option value="Google">Google</option>				                    
			                <option value="GPS">GPS</option>				                    
			                <option value="Grant Writing">Grant Writing</option>				                    
			                <option value="Ground Control">Ground Control</option>				                    
			                <option value="Handcuffing">Handcuffing</option>				                    
			                <option value="Handgun">Handgun</option>				                    
			                <option value="HazMat">HazMat</option>				                    
			                <option value="High Crime Areas">High Crime Areas</option>				                    
			                <option value="High Voltage Training">High Voltage Training</option>	
			                <option value="Homicide">Homicide</option>				                    
			                <option value="Hostage Negotiation">Hostage Negotiation</option>	
			                <option value="Immigration">Immigration</option>				                    
			                <option value="Infanticide">Infanticide</option>				                    
			                <option value="Injury Prevention">Injury Prevention</option>				                    
			                <option value="In-Service Training">In-Service Training</option>	
			                <option value="Instructor">Instructor</option>				                    
			                <option value="Intelligence">Intelligence</option>				                    
			                <option value="Interdiction">Interdiction</option>				                    
			                <option value="Internal Affairs">Internal Affairs</option>				                    
			                <option value="Internet Investigations">Internet Investigations</option>	
			                <option value="Internet Protocol Cameras">Internet Protocol Cameras</option>
			                <option value="Interviews">Interviews</option>				                    
			                <option value="Investigations">Investigations</option>				                    
			                <option value="Jail Operations">Jail Operations</option>				                    
			                <option value="K-9">K-9</option>				                    
			                <option value="Knife Defense">Knife Defense</option>				                    
			                <option value="Languages">Languages</option>				                    
			                <option value="Leadership">Leadership</option>				                    
			                <option value="Legal">Legal</option>				                    
			                <option value="Less Lethal">Less Lethal</option>				                    
			                <option value="Liability Management">Liability Management</option>	
			                <option value="Light Energy Applications">Light Energy Applications</option>	
			                <option value="Lock Picking">Lock Picking</option>				                    
			                <option value="Management">Management</option>				                    
			                <option value="Marine Operations">Marine Operations</option>				                    
			                <option value="Media Relations">Media Relations</option>				                    
			                <option value="Mental Illness">Mental Illness</option>				                    
			                <option value="Mentoring">Mentoring</option>				                    
			                <option value="Minority Relations">Minority Relations</option>				                    
			                <option value="Miscellaneous">Miscellaneous</option>				                    
			                <option value="Motorcycle Gangs">Motorcycle Gangs</option>				                    
			                <option value="Motorcycle Operations">Motorcycle Operations</option>
			                <option value="Narcotics">Narcotics</option>	
			                <option value="Neighborhood Watch">Neighborhood Watch</option>				                    
			                <option value="Officer Involved Shooting">Officer Involved Shooting</option>	
			                <option value="Officer Survival">Officer Survival</option>				                    
			                <option value="Open Source Investigations">Open Source Investigations</option>	
			                <option value="Organized Crime">Organized Crime</option>				                    
			                <option value="Pathology">Pathology</option>				                    
			                <option value="Patrol">Patrol</option>				                    
			                <option value="Patrol Rifle">Patrol Rifle</option>				                    
			                <option value="Pawn Shops">Pawn Shops</option>				                    
			                <option value="Peer Support">Peer Support</option>				                    
			                <option value="Pharmaceutical Investigations">Pharmaceutical Investigations</option>	
			                <option value="Photography">Photography</option>				                    
			                <option value="Pinterest">Pinterest</option>				                    
			                <option value="Pistol">Pistol</option>				                    
			                <option value="Policy &amp; Procedure">Policy &amp; Procedure</option>
			                <option value="Polygraph">Polygraph</option>				                    
			                <option value="Powerpoint">Powerpoint</option>				                    
			                <option value="Precursors">Precursors</option>				                    
			                <option value="Promotional Testing">Promotional Testing</option>
			                <option value="Property Room">Property Room</option>				                    
			                <option value="Public Information Officer">Public Information Officer</option>				 
			                <option value="Public Speaking">Public Speaking</option>				                    
			                <option value="Recruitment">Recruitment</option>				                    
			                <option value="Redman">Redman</option>				                    
			                <option value="Report Writing">Report Writing</option>				                    
			                <option value="Rifle">Rifle</option>				                    
			                <option value="Riot Control">Riot Control</option>				                    
			                <option value="Robbery">Robbery</option>				                    
			                <option value="School Resource">School Resource</option>				                    
			                <option value="SCUBA">SCUBA</option>				                    
			                <option value="Search &amp; Seizure">Search &amp; Seizure</option>	
			                <option value="Sex Crimes">Sex Crimes</option>				                    
			                <option value="Sex Trafficking">Sex Trafficking</option>				                    
			                <option value="Shoothouse">Shoothouse</option>				                    
			                <option value="Shotgun">Shotgun</option>				                    
			                <option value="Sign Language">Sign Language</option>				                    
			                <option value="Sniper">Sniper</option>				                    
			                <option value="Social Media">Social Media</option>				                    
			                <option value="Sovereign Citizens">Sovereign Citizens</option>				                    
			                <option value="Specialized Entry Techniques">Specialized Entry Techniques</option>
			                <option value="Special Operations">Special Operations</option>				                    
			                <option value="Street Crimes">Street Crimes</option>				                    
			                <option value="Street Survival">Street Survival</option>				                    
			                <option value="Subversive Groups">Subversive Groups</option>				                    
			                <option value="Supervision">Supervision</option>				                    
			                <option value="Suicide">Suicide</option>				                    
			                <option value="Suicide Prevention">Suicide Prevention</option>				                    
			                <option value="Surveillance">Surveillance</option>				                    
			                <option value="SWAT">SWAT</option>				                    
			                <option value="Tactical Medicine">Tactical Medicine</option>				                    
			                <option value="Tactics">Tactics</option>				                    
			                <option value="Technical Operations">Technical Operations</option>	
			                <option value="Terrorism">Terrorism</option>				                    
			                <option value="Threat Assessment">Threat Assessment</option>				                    
			                <option value="Tracking">Tracking</option>				                    
			                <option value="Traffic">Traffic</option>				                    
			                <option value="Train the Trainer">Train the Trainer</option>				                    
			                <option value="Twitter">Twitter</option>				                    
			                <option value="Undercover">Undercover</option>				                    
			                <option value="Use of Force">Use of Force</option>				                    
			                <option value="Vehicular Operations">Vehicular Operations</option>		
			                <option value="Verbal Conflict">Verbal Conflict</option>				                    
			                <option value="Vice">Vice</option>				                    
			                <option value="Victimology">Victimology</option>				                    
			                <option value="Violent Crimes">Violent Crimes</option>				                    
			                <option value="VIP Protection">VIP Protection</option>				                    
			                <option value="Warrant Service">Warrant Service</option>				                    
			                <option value="Water Survival">Water Survival</option>				                    
			                <option value="Women in Law Enforcement">Women in Law Enforcement</option>
			            </select>
			            <br />
			            <select class="form-control" name="_wsdev_event_topic[]">
    						<option value="">--</option>
        					<option value="Accident Investigation">Accident Investigation</option>
			                <option value="Accident Reconstruction">Accident Reconstruction</option>	
			                <option value="Active Shooter">Active Shooter</option>				                    
			                <option value="Administration">Administration</option>				                    
			                <option value="Aquatic Investigations">Aquatic Investigations</option>	
			                <option value="Ambush">Ambush</option>				                    
			                <option value="Armorer">Armorer</option>				                    
			                <option value="Arrest &amp; Control">Arrest &amp; Control</option>	
			                <option value="Arson">Arson</option>				                    
			                <option value="Asset Forfeiture">Asset Forfeiture</option>				                    
			                <option value="Assault">Assault</option>				                    
			                <option value="Autism">Autism</option>				                    
			                <option value="Auto Theft">Auto Theft</option>				                    
			                <option value="Background Investigations">Background Investigations</option>	
			                <option value="Bicycle Accidents">Bicycle Accidents</option>				                    
			                <option value="Bicycle Operations">Bicycle Operations</option>				                    
			                <option value="Body Worn Cameras">Body Worn Cameras</option>				                    
			                <option value="Breaching">Breaching</option>				                    
			                <option value="Budgeting">Budgeting</option>				                    
			                <option value="Burglary">Burglary</option>				                    
			                <option value="Cameras- Body Worn">Cameras- Body Worn</option>				                    
			                <option value="Canine">Canine</option>				                    
			                <option value="Cartel">Cartel</option>				                    
			                <option value="Case Management">Case Management</option>				                    
			                <option value="Casualty Training">Casualty Training</option>				                    
			                <option value="Cellphone Investigations">Cellphone Investigations</option>	
			                <option value="Chemical Aerosol">Chemical Aerosol</option>				                    
			                <option value="Child Abuse">Child Abuse</option>				                    
			                <option value="Child Death">Child Death</option>				                    
			                <option value="Child Exploitation">Child Exploitation</option>				                    
			                <option value="Child Porn">Child Porn</option>				                    
			                <option value="Citizen Academies">Citizen Academies</option>				                    
			                <option value="College &amp; University">College &amp; University</option>	
			                <option value="Communications">Communications</option>				                    
			                <option value="Community Policing">Community Policing</option>				                    
			                <option value="Computer Crimes">Computer Crimes</option>				                    
			                <option value="Computer Forensics">Computer Forensics</option>				                    
			                <option value="Concealment">Concealment</option>				                    
			                <option value="Conference &amp; Events">Conference &amp; Events</option>	
			                <option value="Confidential Informants">Confidential Informants</option>
			                <option value="Conflict Resolution">Conflict Resolution</option>	
			                <option value="Confrontation Avoidance">Confrontation Avoidance</option>	
			                <option value="Conservation in Law Enforcement">Conservation in Law Enforcement</option>	
			                <option value="Corrections">Corrections</option>				                    
			                <option value="Courthouse">Courthouse</option>				                    
			                <option value="Courtroom Testimony">Courtroom Testimony</option>	
			                <option value="Craigslist">Craigslist</option>				                    
			                <option value="Critical Incident Command">Critical Incident Command</option>	
			                <option value="Crime Prevention">Crime Prevention</option>				                    
			                <option value="Crime Scene Investigation">Crime Scene Investigation</option>
			                <option value="Crisis &amp; Hostage">Crisis &amp; Hostage</option>	
			                <option value="Custodial Death">Custodial Death</option>				                    
			                <option value="Cyberbullying">Cyberbullying</option>				                    
			                <option value="Deaf &amp; Hard of Hearing">Deaf &amp; Hard of Hearing</option>	
			                <option value="Deescalation">Deescalation</option>				                    
			                <option value="Defensive Tactics">Defensive Tactics</option>				                    
			                <option value="Detective Workshop">Detective Workshop</option>				                    
			                <option value="Dispatcher">Dispatcher</option>				                    
			                <option value="Disruptive Students">Disruptive Students</option>
			                <option value="Domestic Violence">Domestic Violence</option>				                    
			                <option value="Drug Diversion">Drug Diversion</option>				                    
			                <option value="Drugs">Drugs</option>				                    
			                <option value="DUI">DUI</option>				                    
			                <option value="DWI">DWI</option>				                    
			                <option value="Electronic Control Device">Electronic Control Device</option>	
			                <option value="Electronic Countermeasures">Electronic Countermeasures</option>	
			                <option value="Emergency Medicine">Emergency Medicine</option>				                    
			                <option value="EMT">EMT</option>				                    
			                <option value="Entry">Entry</option>				                    
			                <option value="Evaluation">Evaluation</option>				                    
			                <option value="Evidence">Evidence</option>				                    
			                <option value="Executive Protection">Executive Protection</option>	
			                <option value="Expandable Baton">Expandable Baton</option>				                    
			                <option value="Explosives">Explosives</option>				                    
			                <option value="Explosive Breaching">Explosive Breaching</option>
			                <option value="Facebook">Facebook</option>				                    
			                <option value="Fatality Accident Investigations">Fatality Accident Investigations</option>
			                <option value="Field Training Officer">Field Training Officer</option>		
			                <option value="Financial">Financial</option>				                    
			                <option value="Fingerprinting">Fingerprinting</option>				                    
			                <option value="Firearms">Firearms</option>				                    
			                <option value="Fitness">Fitness</option>				                    
			                <option value="Foreign Languages">Foreign Languages</option>				                    
			                <option value="Forensics">Forensics</option>				                    
			                <option value="Fraud Investigations">Fraud Investigations</option>	
			                <option value="Gaming">Gaming</option>				                    
			                <option value="Gangs">Gangs</option>				                    
			                <option value="Google">Google</option>				                    
			                <option value="GPS">GPS</option>				                    
			                <option value="Grant Writing">Grant Writing</option>				                    
			                <option value="Ground Control">Ground Control</option>				                    
			                <option value="Handcuffing">Handcuffing</option>				                    
			                <option value="Handgun">Handgun</option>				                    
			                <option value="HazMat">HazMat</option>				                    
			                <option value="High Crime Areas">High Crime Areas</option>				                    
			                <option value="High Voltage Training">High Voltage Training</option>	
			                <option value="Homicide">Homicide</option>				                    
			                <option value="Hostage Negotiation">Hostage Negotiation</option>	
			                <option value="Immigration">Immigration</option>				                    
			                <option value="Infanticide">Infanticide</option>				                    
			                <option value="Injury Prevention">Injury Prevention</option>				                    
			                <option value="In-Service Training">In-Service Training</option>	
			                <option value="Instructor">Instructor</option>				                    
			                <option value="Intelligence">Intelligence</option>				                    
			                <option value="Interdiction">Interdiction</option>				                    
			                <option value="Internal Affairs">Internal Affairs</option>				                    
			                <option value="Internet Investigations">Internet Investigations</option>	
			                <option value="Internet Protocol Cameras">Internet Protocol Cameras</option>
			                <option value="Interviews">Interviews</option>				                    
			                <option value="Investigations">Investigations</option>				                    
			                <option value="Jail Operations">Jail Operations</option>				                    
			                <option value="K-9">K-9</option>				                    
			                <option value="Knife Defense">Knife Defense</option>				                    
			                <option value="Languages">Languages</option>				                    
			                <option value="Leadership">Leadership</option>				                    
			                <option value="Legal">Legal</option>				                    
			                <option value="Less Lethal">Less Lethal</option>				                    
			                <option value="Liability Management">Liability Management</option>	
			                <option value="Light Energy Applications">Light Energy Applications</option>	
			                <option value="Lock Picking">Lock Picking</option>				                    
			                <option value="Management">Management</option>				                    
			                <option value="Marine Operations">Marine Operations</option>				                    
			                <option value="Media Relations">Media Relations</option>				                    
			                <option value="Mental Illness">Mental Illness</option>				                    
			                <option value="Mentoring">Mentoring</option>				                    
			                <option value="Minority Relations">Minority Relations</option>				                    
			                <option value="Miscellaneous">Miscellaneous</option>				                    
			                <option value="Motorcycle Gangs">Motorcycle Gangs</option>				                    
			                <option value="Motorcycle Operations">Motorcycle Operations</option>	
			                <option value="Neighborhood Watch">Neighborhood Watch</option>				                    
			                <option value="Officer Involved Shooting">Officer Involved Shooting</option>	
			                <option value="Officer Survival">Officer Survival</option>				                    
			                <option value="Open Source Investigations">Open Source Investigations</option>	
			                <option value="Organized Crime">Organized Crime</option>				                    
			                <option value="Pathology">Pathology</option>				                    
			                <option value="Patrol">Patrol</option>				                    
			                <option value="Patrol Rifle">Patrol Rifle</option>				                    
			                <option value="Pawn Shops">Pawn Shops</option>				                    
			                <option value="Peer Support">Peer Support</option>				                    
			                <option value="Pharmaceutical Investigations">Pharmaceutical Investigations</option>	
			                <option value="Photography">Photography</option>				                    
			                <option value="Pinterest">Pinterest</option>				                    
			                <option value="Pistol">Pistol</option>				                    
			                <option value="Policy &amp; Procedure">Policy &amp; Procedure</option>
			                <option value="Polygraph">Polygraph</option>				                    
			                <option value="Powerpoint">Powerpoint</option>				                    
			                <option value="Precursors">Precursors</option>				                    
			                <option value="Promotional Testing">Promotional Testing</option>
			                <option value="Property Room">Property Room</option>				                    
			                <option value="Public Information Officer">Public Information Officer</option>				 
			                <option value="Public Speaking">Public Speaking</option>				                    
			                <option value="Recruitment">Recruitment</option>				                    
			                <option value="Redman">Redman</option>				                    
			                <option value="Report Writing">Report Writing</option>				                    
			                <option value="Rifle">Rifle</option>				                    
			                <option value="Riot Control">Riot Control</option>				                    
			                <option value="Robbery">Robbery</option>				                    
			                <option value="School Resource">School Resource</option>				                    
			                <option value="SCUBA">SCUBA</option>				                    
			                <option value="Search &amp; Seizure">Search &amp; Seizure</option>	
			                <option value="Sex Crimes">Sex Crimes</option>				                    
			                <option value="Sex Trafficking">Sex Trafficking</option>				                    
			                <option value="Shoothouse">Shoothouse</option>				                    
			                <option value="Shotgun">Shotgun</option>				                    
			                <option value="Sign Language">Sign Language</option>				                    
			                <option value="Sniper">Sniper</option>				                    
			                <option value="Social Media">Social Media</option>				                    
			                <option value="Sovereign Citizens">Sovereign Citizens</option>				                    
			                <option value="Specialized Entry Techniques">Specialized Entry Techniques</option>
			                <option value="Special Operations">Special Operations</option>				                    
			                <option value="Street Crimes">Street Crimes</option>				                    
			                <option value="Street Survival">Street Survival</option>				                    
			                <option value="Subversive Groups">Subversive Groups</option>				                    
			                <option value="Supervision">Supervision</option>				                    
			                <option value="Suicide">Suicide</option>				                    
			                <option value="Suicide Prevention">Suicide Prevention</option>				                    
			                <option value="Surveillance">Surveillance</option>				                    
			                <option value="SWAT">SWAT</option>				                    
			                <option value="Tactical Medicine">Tactical Medicine</option>				                    
			                <option value="Tactics">Tactics</option>				                    
			                <option value="Technical Operations">Technical Operations</option>	
			                <option value="Terrorism">Terrorism</option>				                    
			                <option value="Threat Assessment">Threat Assessment</option>				                    
			                <option value="Tracking">Tracking</option>				                    
			                <option value="Traffic">Traffic</option>				                    
			                <option value="Train the Trainer">Train the Trainer</option>				                    
			                <option value="Twitter">Twitter</option>				                    
			                <option value="Undercover">Undercover</option>				                    
			                <option value="Use of Force">Use of Force</option>				                    
			                <option value="Vehicular Operations">Vehicular Operations</option>		
			                <option value="Verbal Conflict">Verbal Conflict</option>				                    
			                <option value="Vice">Vice</option>				                    
			                <option value="Victimology">Victimology</option>				                    
			                <option value="Violent Crimes">Violent Crimes</option>				                    
			                <option value="VIP Protection">VIP Protection</option>				                    
			                <option value="Warrant Service">Warrant Service</option>				                    
			                <option value="Water Survival">Water Survival</option>				                    
			                <option value="Women in Law Enforcement">Women in Law Enforcement</option>	
			            </select>			 
			            <br />
			            <select class="form-control" name="_wsdev_event_topic[]">
    						<option value="">--</option>
        					<option value="Accident Investigation">Accident Investigation</option>
			                <option value="Accident Reconstruction">Accident Reconstruction</option>	
			                <option value="Active Shooter">Active Shooter</option>				                    
			                <option value="Administration">Administration</option>				                    
			                <option value="Aquatic Investigations">Aquatic Investigations</option>	
			                <option value="Ambush">Ambush</option>				                    
			                <option value="Armorer">Armorer</option>				                    
			                <option value="Arrest &amp; Control">Arrest &amp; Control</option>	
			                <option value="Arson">Arson</option>				                    
			                <option value="Asset Forfeiture">Asset Forfeiture</option>				                    
			                <option value="Assault">Assault</option>				                    
			                <option value="Autism">Autism</option>				                    
			                <option value="Auto Theft">Auto Theft</option>				                    
			                <option value="Background Investigations">Background Investigations</option>	
			                <option value="Bicycle Accidents">Bicycle Accidents</option>				                    
			                <option value="Bicycle Operations">Bicycle Operations</option>				                    
			                <option value="Body Worn Cameras">Body Worn Cameras</option>				                    
			                <option value="Breaching">Breaching</option>				                    
			                <option value="Budgeting">Budgeting</option>				                    
			                <option value="Burglary">Burglary</option>				                    
			                <option value="Cameras- Body Worn">Cameras- Body Worn</option>				                    
			                <option value="Canine">Canine</option>				                    
			                <option value="Cartel">Cartel</option>				                    
			                <option value="Case Management">Case Management</option>				                    
			                <option value="Casualty Training">Casualty Training</option>				                    
			                <option value="Cellphone Investigations">Cellphone Investigations</option>	
			                <option value="Chemical Aerosol">Chemical Aerosol</option>				                    
			                <option value="Child Abuse">Child Abuse</option>				                    
			                <option value="Child Death">Child Death</option>				                    
			                <option value="Child Exploitation">Child Exploitation</option>				                    
			                <option value="Child Porn">Child Porn</option>				                    
			                <option value="Citizen Academies">Citizen Academies</option>				                    
			                <option value="College &amp; University">College &amp; University</option>	
			                <option value="Communications">Communications</option>				                    
			                <option value="Community Policing">Community Policing</option>				                    
			                <option value="Computer Crimes">Computer Crimes</option>				                    
			                <option value="Computer Forensics">Computer Forensics</option>				                    
			                <option value="Concealment">Concealment</option>				                    
			                <option value="Conference &amp; Events">Conference &amp; Events</option>	
			                <option value="Confidential Informants">Confidential Informants</option>
			                <option value="Conflict Resolution">Conflict Resolution</option>	
			                <option value="Confrontation Avoidance">Confrontation Avoidance</option>	
			                <option value="Conservation in Law Enforcement">Conservation in Law Enforcement</option>	
			                <option value="Corrections">Corrections</option>				                    
			                <option value="Courthouse">Courthouse</option>				                    
			                <option value="Courtroom Testimony">Courtroom Testimony</option>	
			                <option value="Craigslist">Craigslist</option>				                    
			                <option value="Critical Incident Command">Critical Incident Command</option>	
			                <option value="Crime Prevention">Crime Prevention</option>				                    
			                <option value="Crime Scene Investigation">Crime Scene Investigation</option>
			                <option value="Crisis &amp; Hostage">Crisis &amp; Hostage</option>	
			                <option value="Custodial Death">Custodial Death</option>				                    
			                <option value="Cyberbullying">Cyberbullying</option>				                    
			                <option value="Deaf &amp; Hard of Hearing">Deaf &amp; Hard of Hearing</option>	
			                <option value="Deescalation">Deescalation</option>				                    
			                <option value="Defensive Tactics">Defensive Tactics</option>				                    
			                <option value="Detective Workshop">Detective Workshop</option>				                    
			                <option value="Dispatcher">Dispatcher</option>				                    
			                <option value="Disruptive Students">Disruptive Students</option>
			                <option value="Domestic Violence">Domestic Violence</option>				                    
			                <option value="Drug Diversion">Drug Diversion</option>				                    
			                <option value="Drugs">Drugs</option>				                    
			                <option value="DUI">DUI</option>				                    
			                <option value="DWI">DWI</option>				                    
			                <option value="Electronic Control Device">Electronic Control Device</option>	
			                <option value="Electronic Countermeasures">Electronic Countermeasures</option>	
			                <option value="Emergency Medicine">Emergency Medicine</option>				                    
			                <option value="EMT">EMT</option>				                    
			                <option value="Entry">Entry</option>				                    
			                <option value="Evaluation">Evaluation</option>				                    
			                <option value="Evidence">Evidence</option>				                    
			                <option value="Executive Protection">Executive Protection</option>	
			                <option value="Expandable Baton">Expandable Baton</option>				                    
			                <option value="Explosives">Explosives</option>				                    
			                <option value="Explosive Breaching">Explosive Breaching</option>
			                <option value="Facebook">Facebook</option>				                    
			                <option value="Fatality Accident Investigations">Fatality Accident Investigations</option>
			                <option value="Field Training Officer">Field Training Officer</option>		
			                <option value="Financial">Financial</option>				                    
			                <option value="Fingerprinting">Fingerprinting</option>				                    
			                <option value="Firearms">Firearms</option>				                    
			                <option value="Fitness">Fitness</option>				                    
			                <option value="Foreign Languages">Foreign Languages</option>				                    
			                <option value="Forensics">Forensics</option>				                    
			                <option value="Fraud Investigations">Fraud Investigations</option>	
			                <option value="Gaming">Gaming</option>				                    
			                <option value="Gangs">Gangs</option>				                    
			                <option value="Google">Google</option>				                    
			                <option value="GPS">GPS</option>				                    
			                <option value="Grant Writing">Grant Writing</option>				                    
			                <option value="Ground Control">Ground Control</option>				                    
			                <option value="Handcuffing">Handcuffing</option>				                    
			                <option value="Handgun">Handgun</option>				                    
			                <option value="HazMat">HazMat</option>				                    
			                <option value="High Crime Areas">High Crime Areas</option>				                    
			                <option value="High Voltage Training">High Voltage Training</option>	
			                <option value="Homicide">Homicide</option>				                    
			                <option value="Hostage Negotiation">Hostage Negotiation</option>	
			                <option value="Immigration">Immigration</option>				                    
			                <option value="Infanticide">Infanticide</option>				                    
			                <option value="Injury Prevention">Injury Prevention</option>				                    
			                <option value="In-Service Training">In-Service Training</option>	
			                <option value="Instructor">Instructor</option>				                    
			                <option value="Intelligence">Intelligence</option>				                    
			                <option value="Interdiction">Interdiction</option>				                    
			                <option value="Internal Affairs">Internal Affairs</option>				                    
			                <option value="Internet Investigations">Internet Investigations</option>	
			                <option value="Internet Protocol Cameras">Internet Protocol Cameras</option>
			                <option value="Interviews">Interviews</option>				                    
			                <option value="Investigations">Investigations</option>				                    
			                <option value="Jail Operations">Jail Operations</option>				                    
			                <option value="K-9">K-9</option>				                    
			                <option value="Knife Defense">Knife Defense</option>				                    
			                <option value="Languages">Languages</option>				                    
			                <option value="Leadership">Leadership</option>				                    
			                <option value="Legal">Legal</option>				                    
			                <option value="Less Lethal">Less Lethal</option>				                    
			                <option value="Liability Management">Liability Management</option>	
			                <option value="Light Energy Applications">Light Energy Applications</option>	
			                <option value="Lock Picking">Lock Picking</option>				                    
			                <option value="Management">Management</option>				                    
			                <option value="Marine Operations">Marine Operations</option>				                    
			                <option value="Media Relations">Media Relations</option>				                    
			                <option value="Mental Illness">Mental Illness</option>				                    
			                <option value="Mentoring">Mentoring</option>				                    
			                <option value="Minority Relations">Minority Relations</option>				                    
			                <option value="Miscellaneous">Miscellaneous</option>				                    
			                <option value="Motorcycle Gangs">Motorcycle Gangs</option>				                    
			                <option value="Motorcycle Operations">Motorcycle Operations</option>	
			                <option value="Neighborhood Watch">Neighborhood Watch</option>				                    
			                <option value="Officer Involved Shooting">Officer Involved Shooting</option>	
			                <option value="Officer Survival">Officer Survival</option>				                    
			                <option value="Open Source Investigations">Open Source Investigations</option>	
			                <option value="Organized Crime">Organized Crime</option>				                    
			                <option value="Pathology">Pathology</option>				                    
			                <option value="Patrol">Patrol</option>				                    
			                <option value="Patrol Rifle">Patrol Rifle</option>				                    
			                <option value="Pawn Shops">Pawn Shops</option>				                    
			                <option value="Peer Support">Peer Support</option>				                    
			                <option value="Pharmaceutical Investigations">Pharmaceutical Investigations</option>	
			                <option value="Photography">Photography</option>				                    
			                <option value="Pinterest">Pinterest</option>				                    
			                <option value="Pistol">Pistol</option>				                    
			                <option value="Policy &amp; Procedure">Policy &amp; Procedure</option>
			                <option value="Polygraph">Polygraph</option>				                    
			                <option value="Powerpoint">Powerpoint</option>				                    
			                <option value="Precursors">Precursors</option>				                    
			                <option value="Promotional Testing">Promotional Testing</option>
			                <option value="Property Room">Property Room</option>				                    
			                <option value="Public Information Officer">Public Information Officer</option>				 
			                <option value="Public Speaking">Public Speaking</option>				                    
			                <option value="Recruitment">Recruitment</option>				                    
			                <option value="Redman">Redman</option>				                    
			                <option value="Report Writing">Report Writing</option>				                    
			                <option value="Rifle">Rifle</option>				                    
			                <option value="Riot Control">Riot Control</option>				                    
			                <option value="Robbery">Robbery</option>				                    
			                <option value="School Resource">School Resource</option>				                    
			                <option value="SCUBA">SCUBA</option>				                    
			                <option value="Search &amp; Seizure">Search &amp; Seizure</option>	
			                <option value="Sex Crimes">Sex Crimes</option>				                    
			                <option value="Sex Trafficking">Sex Trafficking</option>				                    
			                <option value="Shoothouse">Shoothouse</option>				                    
			                <option value="Shotgun">Shotgun</option>				                    
			                <option value="Sign Language">Sign Language</option>				                    
			                <option value="Sniper">Sniper</option>				                    
			                <option value="Social Media">Social Media</option>				                    
			                <option value="Sovereign Citizens">Sovereign Citizens</option>				                    
			                <option value="Specialized Entry Techniques">Specialized Entry Techniques</option>
			                <option value="Special Operations">Special Operations</option>				                    
			                <option value="Street Crimes">Street Crimes</option>				                    
			                <option value="Street Survival">Street Survival</option>				                    
			                <option value="Subversive Groups">Subversive Groups</option>				                    
			                <option value="Supervision">Supervision</option>				                    
			                <option value="Suicide">Suicide</option>				                    
			                <option value="Suicide Prevention">Suicide Prevention</option>				                    
			                <option value="Surveillance">Surveillance</option>				                    
			                <option value="SWAT">SWAT</option>				                    
			                <option value="Tactical Medicine">Tactical Medicine</option>				                    
			                <option value="Tactics">Tactics</option>				                    
			                <option value="Technical Operations">Technical Operations</option>	
			                <option value="Terrorism">Terrorism</option>				                    
			                <option value="Threat Assessment">Threat Assessment</option>				                    
			                <option value="Tracking">Tracking</option>				                    
			                <option value="Traffic">Traffic</option>				                    
			                <option value="Train the Trainer">Train the Trainer</option>				                    
			                <option value="Twitter">Twitter</option>				                    
			                <option value="Undercover">Undercover</option>				                    
			                <option value="Use of Force">Use of Force</option>				                    
			                <option value="Vehicular Operations">Vehicular Operations</option>		
			                <option value="Verbal Conflict">Verbal Conflict</option>				                    
			                <option value="Vice">Vice</option>				                    
			                <option value="Victimology">Victimology</option>				                    
			                <option value="Violent Crimes">Violent Crimes</option>				                    
			                <option value="VIP Protection">VIP Protection</option>				                    
			                <option value="Warrant Service">Warrant Service</option>				                    
			                <option value="Water Survival">Water Survival</option>				                    
			                <option value="Women in Law Enforcement">Women in Law Enforcement</option>	
			            </select>	
			            <br />

			            <select class="form-control" name="_wsdev_event_topic[]">
    						<option value="">--</option>
        					<option value="Accident Investigation">Accident Investigation</option>
			                <option value="Accident Reconstruction">Accident Reconstruction</option>	
			                <option value="Active Shooter">Active Shooter</option>				                    
			                <option value="Administration">Administration</option>				                    
			                <option value="Aquatic Investigations">Aquatic Investigations</option>	
			                <option value="Ambush">Ambush</option>				                    
			                <option value="Armorer">Armorer</option>				                    
			                <option value="Arrest &amp; Control">Arrest &amp; Control</option>	
			                <option value="Arson">Arson</option>				                    
			                <option value="Asset Forfeiture">Asset Forfeiture</option>				                    
			                <option value="Assault">Assault</option>				                    
			                <option value="Autism">Autism</option>				                    
			                <option value="Auto Theft">Auto Theft</option>				                    
			                <option value="Background Investigations">Background Investigations</option>	
			                <option value="Bicycle Accidents">Bicycle Accidents</option>				                    
			                <option value="Bicycle Operations">Bicycle Operations</option>				                    
			                <option value="Body Worn Cameras">Body Worn Cameras</option>				                    
			                <option value="Breaching">Breaching</option>				                    
			                <option value="Budgeting">Budgeting</option>				                    
			                <option value="Burglary">Burglary</option>				                    
			                <option value="Cameras- Body Worn">Cameras- Body Worn</option>				                    
			                <option value="Canine">Canine</option>				                    
			                <option value="Cartel">Cartel</option>				                    
			                <option value="Case Management">Case Management</option>				                    
			                <option value="Casualty Training">Casualty Training</option>				                    
			                <option value="Cellphone Investigations">Cellphone Investigations</option>	
			                <option value="Chemical Aerosol">Chemical Aerosol</option>				                    
			                <option value="Child Abuse">Child Abuse</option>				                    
			                <option value="Child Death">Child Death</option>				                    
			                <option value="Child Exploitation">Child Exploitation</option>				                    
			                <option value="Child Porn">Child Porn</option>				                    
			                <option value="Citizen Academies">Citizen Academies</option>				                    
			                <option value="College &amp; University">College &amp; University</option>	
			                <option value="Communications">Communications</option>				                    
			                <option value="Community Policing">Community Policing</option>				                    
			                <option value="Computer Crimes">Computer Crimes</option>				                    
			                <option value="Computer Forensics">Computer Forensics</option>				                    
			                <option value="Concealment">Concealment</option>				                    
			                <option value="Conference &amp; Events">Conference &amp; Events</option>	
			                <option value="Confidential Informants">Confidential Informants</option>
			                <option value="Conflict Resolution">Conflict Resolution</option>	
			                <option value="Confrontation Avoidance">Confrontation Avoidance</option>	
			                <option value="Conservation in Law Enforcement">Conservation in Law Enforcement</option>	
			                <option value="Corrections">Corrections</option>				                    
			                <option value="Courthouse">Courthouse</option>				                    
			                <option value="Courtroom Testimony">Courtroom Testimony</option>	
			                <option value="Craigslist">Craigslist</option>				                    
			                <option value="Critical Incident Command">Critical Incident Command</option>	
			                <option value="Crime Prevention">Crime Prevention</option>				                    
			                <option value="Crime Scene Investigation">Crime Scene Investigation</option>
			                <option value="Crisis &amp; Hostage">Crisis &amp; Hostage</option>	
			                <option value="Custodial Death">Custodial Death</option>				                    
			                <option value="Cyberbullying">Cyberbullying</option>				                    
			                <option value="Deaf &amp; Hard of Hearing">Deaf &amp; Hard of Hearing</option>	
			                <option value="Deescalation">Deescalation</option>				                    
			                <option value="Defensive Tactics">Defensive Tactics</option>				                    
			                <option value="Detective Workshop">Detective Workshop</option>				                    
			                <option value="Dispatcher">Dispatcher</option>				                    
			                <option value="Disruptive Students">Disruptive Students</option>
			                <option value="Domestic Violence">Domestic Violence</option>				                    
			                <option value="Drug Diversion">Drug Diversion</option>				                    
			                <option value="Drugs">Drugs</option>				                    
			                <option value="DUI">DUI</option>				                    
			                <option value="DWI">DWI</option>				                    
			                <option value="Electronic Control Device">Electronic Control Device</option>	
			                <option value="Electronic Countermeasures">Electronic Countermeasures</option>	
			                <option value="Emergency Medicine">Emergency Medicine</option>				                    
			                <option value="EMT">EMT</option>				                    
			                <option value="Entry">Entry</option>				                    
			                <option value="Evaluation">Evaluation</option>				                    
			                <option value="Evidence">Evidence</option>				                    
			                <option value="Executive Protection">Executive Protection</option>	
			                <option value="Expandable Baton">Expandable Baton</option>				                    
			                <option value="Explosives">Explosives</option>				                    
			                <option value="Explosive Breaching">Explosive Breaching</option>
			                <option value="Facebook">Facebook</option>				                    
			                <option value="Fatality Accident Investigations">Fatality Accident Investigations</option>
			                <option value="Field Training Officer">Field Training Officer</option>		
			                <option value="Financial">Financial</option>				                    
			                <option value="Fingerprinting">Fingerprinting</option>				                    
			                <option value="Firearms">Firearms</option>				                    
			                <option value="Fitness">Fitness</option>				                    
			                <option value="Foreign Languages">Foreign Languages</option>				                    
			                <option value="Forensics">Forensics</option>				                    
			                <option value="Fraud Investigations">Fraud Investigations</option>	
			                <option value="Gaming">Gaming</option>				                    
			                <option value="Gangs">Gangs</option>				                    
			                <option value="Google">Google</option>				                    
			                <option value="GPS">GPS</option>				                    
			                <option value="Grant Writing">Grant Writing</option>				                    
			                <option value="Ground Control">Ground Control</option>				                    
			                <option value="Handcuffing">Handcuffing</option>				                    
			                <option value="Handgun">Handgun</option>				                    
			                <option value="HazMat">HazMat</option>				                    
			                <option value="High Crime Areas">High Crime Areas</option>				                    
			                <option value="High Voltage Training">High Voltage Training</option>	
			                <option value="Homicide">Homicide</option>				                    
			                <option value="Hostage Negotiation">Hostage Negotiation</option>	
			                <option value="Immigration">Immigration</option>				                    
			                <option value="Infanticide">Infanticide</option>				                    
			                <option value="Injury Prevention">Injury Prevention</option>				                    
			                <option value="In-Service Training">In-Service Training</option>	
			                <option value="Instructor">Instructor</option>				                    
			                <option value="Intelligence">Intelligence</option>				                    
			                <option value="Interdiction">Interdiction</option>				                    
			                <option value="Internal Affairs">Internal Affairs</option>				                    
			                <option value="Internet Investigations">Internet Investigations</option>	
			                <option value="Internet Protocol Cameras">Internet Protocol Cameras</option>
			                <option value="Interviews">Interviews</option>				                    
			                <option value="Investigations">Investigations</option>				                    
			                <option value="Jail Operations">Jail Operations</option>				                    
			                <option value="K-9">K-9</option>				                    
			                <option value="Knife Defense">Knife Defense</option>				                    
			                <option value="Languages">Languages</option>				                    
			                <option value="Leadership">Leadership</option>				                    
			                <option value="Legal">Legal</option>				                    
			                <option value="Less Lethal">Less Lethal</option>				                    
			                <option value="Liability Management">Liability Management</option>	
			                <option value="Light Energy Applications">Light Energy Applications</option>	
			                <option value="Lock Picking">Lock Picking</option>				                    
			                <option value="Management">Management</option>				                    
			                <option value="Marine Operations">Marine Operations</option>				                    
			                <option value="Media Relations">Media Relations</option>				                    
			                <option value="Mental Illness">Mental Illness</option>				                    
			                <option value="Mentoring">Mentoring</option>				                    
			                <option value="Minority Relations">Minority Relations</option>				                    
			                <option value="Miscellaneous">Miscellaneous</option>				                    
			                <option value="Motorcycle Gangs">Motorcycle Gangs</option>				                    
			                <option value="Motorcycle Operations">Motorcycle Operations</option>	
			                <option value="Neighborhood Watch">Neighborhood Watch</option>				                    
			                <option value="Officer Involved Shooting">Officer Involved Shooting</option>	
			                <option value="Officer Survival">Officer Survival</option>				                    
			                <option value="Open Source Investigations">Open Source Investigations</option>	
			                <option value="Organized Crime">Organized Crime</option>				                    
			                <option value="Pathology">Pathology</option>				                    
			                <option value="Patrol">Patrol</option>				                    
			                <option value="Patrol Rifle">Patrol Rifle</option>				                    
			                <option value="Pawn Shops">Pawn Shops</option>				                    
			                <option value="Peer Support">Peer Support</option>				                    
			                <option value="Pharmaceutical Investigations">Pharmaceutical Investigations</option>	
			                <option value="Photography">Photography</option>				                    
			                <option value="Pinterest">Pinterest</option>				                    
			                <option value="Pistol">Pistol</option>				                    
			                <option value="Policy &amp; Procedure">Policy &amp; Procedure</option>
			                <option value="Polygraph">Polygraph</option>				                    
			                <option value="Powerpoint">Powerpoint</option>				                    
			                <option value="Precursors">Precursors</option>				                    
			                <option value="Promotional Testing">Promotional Testing</option>
			                <option value="Property Room">Property Room</option>				                    
			                <option value="Public Information Officer">Public Information Officer</option>				 
			                <option value="Public Speaking">Public Speaking</option>				                    
			                <option value="Recruitment">Recruitment</option>				                    
			                <option value="Redman">Redman</option>				                    
			                <option value="Report Writing">Report Writing</option>				                    
			                <option value="Rifle">Rifle</option>				                    
			                <option value="Riot Control">Riot Control</option>				                    
			                <option value="Robbery">Robbery</option>				                    
			                <option value="School Resource">School Resource</option>				                    
			                <option value="SCUBA">SCUBA</option>				                    
			                <option value="Search &amp; Seizure">Search &amp; Seizure</option>	
			                <option value="Sex Crimes">Sex Crimes</option>				                    
			                <option value="Sex Trafficking">Sex Trafficking</option>				                    
			                <option value="Shoothouse">Shoothouse</option>				                    
			                <option value="Shotgun">Shotgun</option>				                    
			                <option value="Sign Language">Sign Language</option>				                    
			                <option value="Sniper">Sniper</option>				                    
			                <option value="Social Media">Social Media</option>				                    
			                <option value="Sovereign Citizens">Sovereign Citizens</option>				                    
			                <option value="Specialized Entry Techniques">Specialized Entry Techniques</option>
			                <option value="Special Operations">Special Operations</option>				                    
			                <option value="Street Crimes">Street Crimes</option>				                    
			                <option value="Street Survival">Street Survival</option>				                    
			                <option value="Subversive Groups">Subversive Groups</option>				                    
			                <option value="Supervision">Supervision</option>				                    
			                <option value="Suicide">Suicide</option>				                    
			                <option value="Suicide Prevention">Suicide Prevention</option>				                    
			                <option value="Surveillance">Surveillance</option>				                    
			                <option value="SWAT">SWAT</option>				                    
			                <option value="Tactical Medicine">Tactical Medicine</option>				                    
			                <option value="Tactics">Tactics</option>				                    
			                <option value="Technical Operations">Technical Operations</option>	
			                <option value="Terrorism">Terrorism</option>				                    
			                <option value="Threat Assessment">Threat Assessment</option>				                    
			                <option value="Tracking">Tracking</option>				                    
			                <option value="Traffic">Traffic</option>				                    
			                <option value="Train the Trainer">Train the Trainer</option>				                    
			                <option value="Twitter">Twitter</option>				                    
			                <option value="Undercover">Undercover</option>				                    
			                <option value="Use of Force">Use of Force</option>				                    
			                <option value="Vehicular Operations">Vehicular Operations</option>		
			                <option value="Verbal Conflict">Verbal Conflict</option>				                    
			                <option value="Vice">Vice</option>				                    
			                <option value="Victimology">Victimology</option>				                    
			                <option value="Violent Crimes">Violent Crimes</option>				                    
			                <option value="VIP Protection">VIP Protection</option>				                    
			                <option value="Warrant Service">Warrant Service</option>				                    
			                <option value="Water Survival">Water Survival</option>				                    
			                <option value="Women in Law Enforcement">Women in Law Enforcement</option>	
			            </select>	
			            <br />
			            <select class="form-control" name="_wsdev_event_topic[]">
    						<option value="">--</option>
        					<option value="Accident Investigation">Accident Investigation</option>
			                <option value="Accident Reconstruction">Accident Reconstruction</option>	
			                <option value="Active Shooter">Active Shooter</option>				                    
			                <option value="Administration">Administration</option>				                    
			                <option value="Aquatic Investigations">Aquatic Investigations</option>	
			                <option value="Ambush">Ambush</option>				                    
			                <option value="Armorer">Armorer</option>				                    
			                <option value="Arrest &amp; Control">Arrest &amp; Control</option>	
			                <option value="Arson">Arson</option>				                    
			                <option value="Asset Forfeiture">Asset Forfeiture</option>				                    
			                <option value="Assault">Assault</option>				                    
			                <option value="Autism">Autism</option>				                    
			                <option value="Auto Theft">Auto Theft</option>				                    
			                <option value="Background Investigations">Background Investigations</option>	
			                <option value="Bicycle Accidents">Bicycle Accidents</option>				                    
			                <option value="Bicycle Operations">Bicycle Operations</option>				                    
			                <option value="Body Worn Cameras">Body Worn Cameras</option>				                    
			                <option value="Breaching">Breaching</option>				                    
			                <option value="Budgeting">Budgeting</option>				                    
			                <option value="Burglary">Burglary</option>				                    
			                <option value="Cameras- Body Worn">Cameras- Body Worn</option>				                    
			                <option value="Canine">Canine</option>				                    
			                <option value="Cartel">Cartel</option>				                    
			                <option value="Case Management">Case Management</option>				                    
			                <option value="Casualty Training">Casualty Training</option>				                    
			                <option value="Cellphone Investigations">Cellphone Investigations</option>	
			                <option value="Chemical Aerosol">Chemical Aerosol</option>				                    
			                <option value="Child Abuse">Child Abuse</option>				                    
			                <option value="Child Death">Child Death</option>				                    
			                <option value="Child Exploitation">Child Exploitation</option>				                    
			                <option value="Child Porn">Child Porn</option>				                    
			                <option value="Citizen Academies">Citizen Academies</option>				                    
			                <option value="College &amp; University">College &amp; University</option>	
			                <option value="Communications">Communications</option>				                    
			                <option value="Community Policing">Community Policing</option>				                    
			                <option value="Computer Crimes">Computer Crimes</option>				                    
			                <option value="Computer Forensics">Computer Forensics</option>				                    
			                <option value="Concealment">Concealment</option>				                    
			                <option value="Conference &amp; Events">Conference &amp; Events</option>	
			                <option value="Confidential Informants">Confidential Informants</option>
			                <option value="Conflict Resolution">Conflict Resolution</option>	
			                <option value="Confrontation Avoidance">Confrontation Avoidance</option>	
			                <option value="Conservation in Law Enforcement">Conservation in Law Enforcement</option>	
			                <option value="Corrections">Corrections</option>				                    
			                <option value="Courthouse">Courthouse</option>				                    
			                <option value="Courtroom Testimony">Courtroom Testimony</option>	
			                <option value="Craigslist">Craigslist</option>				                    
			                <option value="Critical Incident Command">Critical Incident Command</option>	
			                <option value="Crime Prevention">Crime Prevention</option>				                    
			                <option value="Crime Scene Investigation">Crime Scene Investigation</option>
			                <option value="Crisis &amp; Hostage">Crisis &amp; Hostage</option>	
			                <option value="Custodial Death">Custodial Death</option>				                    
			                <option value="Cyberbullying">Cyberbullying</option>				                    
			                <option value="Deaf &amp; Hard of Hearing">Deaf &amp; Hard of Hearing</option>	
			                <option value="Deescalation">Deescalation</option>				                    
			                <option value="Defensive Tactics">Defensive Tactics</option>				                    
			                <option value="Detective Workshop">Detective Workshop</option>				                    
			                <option value="Dispatcher">Dispatcher</option>				                    
			                <option value="Disruptive Students">Disruptive Students</option>
			                <option value="Domestic Violence">Domestic Violence</option>				                    
			                <option value="Drug Diversion">Drug Diversion</option>				                    
			                <option value="Drugs">Drugs</option>				                    
			                <option value="DUI">DUI</option>				                    
			                <option value="DWI">DWI</option>				                    
			                <option value="Electronic Control Device">Electronic Control Device</option>	
			                <option value="Electronic Countermeasures">Electronic Countermeasures</option>	
			                <option value="Emergency Medicine">Emergency Medicine</option>				                    
			                <option value="EMT">EMT</option>				                    
			                <option value="Entry">Entry</option>				                    
			                <option value="Evaluation">Evaluation</option>				                    
			                <option value="Evidence">Evidence</option>				                    
			                <option value="Executive Protection">Executive Protection</option>	
			                <option value="Expandable Baton">Expandable Baton</option>				                    
			                <option value="Explosives">Explosives</option>				                    
			                <option value="Explosive Breaching">Explosive Breaching</option>
			                <option value="Facebook">Facebook</option>				                    
			                <option value="Fatality Accident Investigations">Fatality Accident Investigations</option>
			                <option value="Field Training Officer">Field Training Officer</option>		
			                <option value="Financial">Financial</option>				                    
			                <option value="Fingerprinting">Fingerprinting</option>				                    
			                <option value="Firearms">Firearms</option>				                    
			                <option value="Fitness">Fitness</option>				                    
			                <option value="Foreign Languages">Foreign Languages</option>				                    
			                <option value="Forensics">Forensics</option>				                    
			                <option value="Fraud Investigations">Fraud Investigations</option>	
			                <option value="Gaming">Gaming</option>				                    
			                <option value="Gangs">Gangs</option>				                    
			                <option value="Google">Google</option>				                    
			                <option value="GPS">GPS</option>				                    
			                <option value="Grant Writing">Grant Writing</option>				                    
			                <option value="Ground Control">Ground Control</option>				                    
			                <option value="Handcuffing">Handcuffing</option>				                    
			                <option value="Handgun">Handgun</option>				                    
			                <option value="HazMat">HazMat</option>				                    
			                <option value="High Crime Areas">High Crime Areas</option>				                    
			                <option value="High Voltage Training">High Voltage Training</option>	
			                <option value="Homicide">Homicide</option>				                    
			                <option value="Hostage Negotiation">Hostage Negotiation</option>	
			                <option value="Immigration">Immigration</option>				                    
			                <option value="Infanticide">Infanticide</option>				                    
			                <option value="Injury Prevention">Injury Prevention</option>				                    
			                <option value="In-Service Training">In-Service Training</option>	
			                <option value="Instructor">Instructor</option>				                    
			                <option value="Intelligence">Intelligence</option>				                    
			                <option value="Interdiction">Interdiction</option>				                    
			                <option value="Internal Affairs">Internal Affairs</option>				                    
			                <option value="Internet Investigations">Internet Investigations</option>	
			                <option value="Internet Protocol Cameras">Internet Protocol Cameras</option>
			                <option value="Interviews">Interviews</option>				                    
			                <option value="Investigations">Investigations</option>				                    
			                <option value="Jail Operations">Jail Operations</option>				                    
			                <option value="K-9">K-9</option>				                    
			                <option value="Knife Defense">Knife Defense</option>				                    
			                <option value="Languages">Languages</option>				                    
			                <option value="Leadership">Leadership</option>				                    
			                <option value="Legal">Legal</option>				                    
			                <option value="Less Lethal">Less Lethal</option>				                    
			                <option value="Liability Management">Liability Management</option>	
			                <option value="Light Energy Applications">Light Energy Applications</option>	
			                <option value="Lock Picking">Lock Picking</option>				                    
			                <option value="Management">Management</option>				                    
			                <option value="Marine Operations">Marine Operations</option>				                    
			                <option value="Media Relations">Media Relations</option>				                    
			                <option value="Mental Illness">Mental Illness</option>				                    
			                <option value="Mentoring">Mentoring</option>				                    
			                <option value="Minority Relations">Minority Relations</option>				                    
			                <option value="Miscellaneous">Miscellaneous</option>				                    
			                <option value="Motorcycle Gangs">Motorcycle Gangs</option>				                    
			                <option value="Motorcycle Operations">Motorcycle Operations</option>	
			                <option value="Neighborhood Watch">Neighborhood Watch</option>				                    
			                <option value="Officer Involved Shooting">Officer Involved Shooting</option>	
			                <option value="Officer Survival">Officer Survival</option>				                    
			                <option value="Open Source Investigations">Open Source Investigations</option>	
			                <option value="Organized Crime">Organized Crime</option>				                    
			                <option value="Pathology">Pathology</option>				                    
			                <option value="Patrol">Patrol</option>				                    
			                <option value="Patrol Rifle">Patrol Rifle</option>				                    
			                <option value="Pawn Shops">Pawn Shops</option>				                    
			                <option value="Peer Support">Peer Support</option>				                    
			                <option value="Pharmaceutical Investigations">Pharmaceutical Investigations</option>	
			                <option value="Photography">Photography</option>				                    
			                <option value="Pinterest">Pinterest</option>				                    
			                <option value="Pistol">Pistol</option>				                    
			                <option value="Policy &amp; Procedure">Policy &amp; Procedure</option>
			                <option value="Polygraph">Polygraph</option>				                    
			                <option value="Powerpoint">Powerpoint</option>				                    
			                <option value="Precursors">Precursors</option>				                    
			                <option value="Promotional Testing">Promotional Testing</option>
			                <option value="Property Room">Property Room</option>				                    
			                <option value="Public Information Officer">Public Information Officer</option>				 
			                <option value="Public Speaking">Public Speaking</option>				                    
			                <option value="Recruitment">Recruitment</option>				                    
			                <option value="Redman">Redman</option>				                    
			                <option value="Report Writing">Report Writing</option>				                    
			                <option value="Rifle">Rifle</option>				                    
			                <option value="Riot Control">Riot Control</option>				                    
			                <option value="Robbery">Robbery</option>				                    
			                <option value="School Resource">School Resource</option>				                    
			                <option value="SCUBA">SCUBA</option>				                    
			                <option value="Search &amp; Seizure">Search &amp; Seizure</option>	
			                <option value="Sex Crimes">Sex Crimes</option>				                    
			                <option value="Sex Trafficking">Sex Trafficking</option>				                    
			                <option value="Shoothouse">Shoothouse</option>				                    
			                <option value="Shotgun">Shotgun</option>				                    
			                <option value="Sign Language">Sign Language</option>				                    
			                <option value="Sniper">Sniper</option>				                    
			                <option value="Social Media">Social Media</option>				                    
			                <option value="Sovereign Citizens">Sovereign Citizens</option>				                    
			                <option value="Specialized Entry Techniques">Specialized Entry Techniques</option>
			                <option value="Special Operations">Special Operations</option>				                    
			                <option value="Street Crimes">Street Crimes</option>				                    
			                <option value="Street Survival">Street Survival</option>				                    
			                <option value="Subversive Groups">Subversive Groups</option>				                    
			                <option value="Supervision">Supervision</option>				                    
			                <option value="Suicide">Suicide</option>				                    
			                <option value="Suicide Prevention">Suicide Prevention</option>				                    
			                <option value="Surveillance">Surveillance</option>				                    
			                <option value="SWAT">SWAT</option>				                    
			                <option value="Tactical Medicine">Tactical Medicine</option>				                    
			                <option value="Tactics">Tactics</option>				                    
			                <option value="Technical Operations">Technical Operations</option>	
			                <option value="Terrorism">Terrorism</option>				                    
			                <option value="Threat Assessment">Threat Assessment</option>				                    
			                <option value="Tracking">Tracking</option>				                    
			                <option value="Traffic">Traffic</option>				                    
			                <option value="Train the Trainer">Train the Trainer</option>				                    
			                <option value="Twitter">Twitter</option>				                    
			                <option value="Undercover">Undercover</option>				                    
			                <option value="Use of Force">Use of Force</option>				                    
			                <option value="Vehicular Operations">Vehicular Operations</option>		
			                <option value="Verbal Conflict">Verbal Conflict</option>				                    
			                <option value="Vice">Vice</option>				                    
			                <option value="Victimology">Victimology</option>				                    
			                <option value="Violent Crimes">Violent Crimes</option>				                    
			                <option value="VIP Protection">VIP Protection</option>				                    
			                <option value="Warrant Service">Warrant Service</option>				                    
			                <option value="Water Survival">Water Survival</option>				                    
			                <option value="Women in Law Enforcement">Women in Law Enforcement</option>	
			            </select>	                   
			            
			            <span class="help-block"></span>
				        
				    </div>

	                <input type="hidden" name="action" value="class_posted" />
        			<?php wp_nonce_field( 'classPost', 'class_posted' ); ?>

	                <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Post Class">

	            </form>

	            <?php endwhile; ?>
        </div>

        <?php get_sidebar(); ?>
	</div>


<?php get_footer(); ?>