<?php
/**
 * page-test.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			
			<?php

				// update scouting notes to use post meta instead of post parent
				//
				//
				// $args = array('post_type' => 'scoutingnotes',
				// 				'posts_per_page' => -1 );
				// $test = new WP_Query($args);

				// while ( $test->have_posts() ) : $test->the_post();

				// $parent = wp_get_post_parent_id( get_the_ID() );
				// $notes_video = $parent;

				// if ( get_post_meta( get_the_ID(), '_notes_video', FALSE) ) {
				//       update_post_meta( get_the_ID(), '_notes_video', $notes_video );
				//    }
				//    else {
				//       add_post_meta(get_the_ID(), '_notes_video', $notes_video);
				//    }

				// echo '<h3>'.get_the_title().'</h3>';
				// echo $parent;
				// echo '<br />';
				// echo get_post_meta( get_the_ID(), '_notes_video', true);
				// echo '<br />';
				// echo get_the_permalink();
				// echo '<br />';
				// echo basename(get_permalink());
				
				// echo "<br />";

				// $updated_post = array(
    //                  'ID' => get_the_ID(),
    //                  'post_parent' => ''
    //               );

				// $post_id = wp_update_post($updated_post);
				// echo 'Updated<br />';
				// echo get_the_permalink();

				// endwhile;




				// update created mockdrafts CPT to have mockdraft category selected
				//
				//
				// $args = array('post_type' => 'mockdrafts', 'posts_per_page' => -1);
				// $mocks = new WP_Query($args);
				// while ( $mocks->have_posts() ) : $mocks->the_post();

				// global $wpdb;
				// if(!has_term('','category',get_the_ID())){
				// 	$cat = array(21);
				// 	wp_set_object_terms(get_the_ID(), $cat, 'category');
				// }

				// if(has_term('featured','category',get_the_ID())){
				// 	$cat = array(21, 4);
				// 	wp_set_object_terms(get_the_ID(), $cat, 'category');
				// }

				// if(has_term('articles','category',get_the_ID())){
				// 	$cat = array(21, 6);
				// 	wp_set_object_terms(get_the_ID(), $cat, 'category');
				// }

				// echo get_the_title();
				// echo '&nbsp;=&nbsp;';
				// echo get_the_category_list();

				// endwhile;



				// video embed test
				//
				//
				?>
				<!-- <iframe width="675" height="550" src="http://dev.draftbreakdown.com/video-embed/?clip=253750&size=large" frameborder="0" scrolling="no"></iframe> -->
				<?php


				// gif embed test
				//
				//
				?>
				<!-- <iframe width="675" height="550" src="http://dev.draftbreakdown.com/gif-embed/?clip=253736&gif=MiserlyIdioticJavalina" frameborder="0" scrolling="no"></iframe> -->
				<?php


				// author query testing
				//
				//
				//
				?>
				<!--<?php 

						$author_name = get_the_author_meta('user_nicename', bp_displayed_user_id() );

						$notes_args = array(
									'post_type' => 'scoutingnotes',
									'posts_per_page' => 10,
								);
						$notes = new WP_Query($notes_args);

						if ( $notes->have_posts() ) : while ( $notes->have_posts() ) : $notes->the_post(); 

						print_r($post);

						echo '<div class="member-post-listing">';
						echo '<p class="member-post-listing-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
						echo '<p class="member-post-listing-date">'.the_author().'</p>';
						echo '</div>';

						endwhile; ?>
						<br />
						<a href="#">>> See All Scouting Notes</a>

						<?php else : ?>
						<p><?php bp_displayed_user_fullname(); ?> has no scouting notes at this time.<p>
						<?php

						endif;

						wp_reset_query();
					?>-->
				<?php

				// testing video thumbnail weirdness
				//
				//
				// $id = 'ME45GlxM7Lw';
				// $api_key = 'AIzaSyBs95KqXpmAJc4uv1O39QCqOgZm9-fvzw8';

				// $file = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=7lCDEYXw3mM&key=".$api_key."&part=snippet");
				// $images = json_decode($file, true);
				
				// print_r($images);
			    
			 //    if ($images) {
			 //        $images = $images['entry']['media$group']['media$thumbnail'];
			 //        $image  = $images[count($images)-4]['url'];

			 //        $mqurl = "http://i.ytimg.com/vi/".$id."/mqdefault.jpg";
			 //        $maxurl = "http://i.ytimg.com/vi/".$id."/maxresdefault.jpg";
			 //        $max    = get_headers($maxurl);

			 //        if (substr($max[0], 9, 3) !== '404') {
			 //            $image = $maxurl;   
			 //        }

			 //        else {
			 //            $image = $mqurl;
			 //        }
			 //    }

			 //    else {
			 //        // $image = 'http://fillmurray.com/300/200';
			 //        $image = 'http://www.draftbreakdown.com/wp-content/themes/Earl/dist/img/video-default.png';
			 //    }
				

				// echo $image;


				// update scouting notes to have private field

				// $args = array(
		  //    	'post_type' => 'scoutingnotes',
		  //    	'posts_per_page' => -1
		     	
		  //   	);

		  //   	$notes = new WP_Query($args);

		    	//if ($notes->have_posts()) : while ($notes->have_posts()) : $notes->the_post(); ?>

		    	<!--<?php the_title(); ?>
		    	Private? <?php echo get_post_meta( get_the_ID(), '_private_note', true ); ?>
		    	<br />
		    	<?php
		    		$private_note = get_post_meta( get_the_ID(), '_private_note', true); 
		    		if ( get_post_meta( get_the_ID(), '_private_note', FALSE) ) {
				      update_post_meta( get_the_ID(), '_private_note', $private_note );
				   }
				   else {
				      add_post_meta(get_the_ID(), '_private_note', $private_note);
				   }
				?>

		    <?php //endwhile; endif; ?>-->

		    <?php

		    	// test run of listing mocks that aren't from members

		  //   	$user_query = new WP_User_Query( array( 'role' => 'Member' ) );
		  //   	$members = array();
		  //   	if ( ! empty( $user_query->results ) ) {
				// 	foreach ( $user_query->results as $user ) {
				// 		array_push($members, $user->ID);
				// 	}
				// } 
				
				// $args = array(
			 //     	'post_type' => array( 'post', 'mockdrafts' ),
			 //     	'cat' => 21,
			 //     	'posts_per_page' => 10,
			 //     	'paged' => get_query_var('paged'),
			 //     	'author__not_in' => $members
			 //    );

			 //    $mocks = new WP_Query($args);

		  //   	if ($mocks->have_posts()) : while ($mocks->have_posts()) : $mocks->the_post();

		  //   	the_title();

		  //   	endwhile; endif;

		    ?>

		    <style>
			  	#sortable { margin: 25px; padding: 0; width: 75%; }
			  	#sortable li { margin: 0 3px 3px 3px; padding: 2px; padding-left: 15px; height: 25px; cursor: move; }
			  	#sortable li span { float: left; margin-left: -15px; }
			</style>
			<article>
				<h2>Drag and drop player rankings test</h2>
			    <?php

			    	// let's test out some drag and drop for player rankings!
			    	$args = array('post_type' => 'player', 'posts_per_page' => -1, 'meta_key' => '_position', 'meta_value' => 'QB',
			    				'meta_query' => array( array( 'key' => '_draft_class', 'value' => 2015, 'compare' => '=')));

			    	$players = new WP_Query($args);

			    	echo '<ol id="sortable">';

			    	while ($players->have_posts()) : $players->the_post();

			    	echo '<li class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>'.get_the_title().' - '.get_post_meta(get_the_ID(), '_school', true).'</li>';

			    	endwhile;
			    	echo '</ol>';


			    ?>
		    </article>

		    <!-- jquery ui script -->
		    <script>

		    	jQuery( "#sortable" ).sortable({
		    		cursor: 'move'
		    	});
    			jQuery( "#sortable" ).disableSelection();

		    </script>
		
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>