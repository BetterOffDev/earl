<?php
/**
 * page-video-update.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<?php 


			/**
			 *
			 *
			 *
			 *
			 *   THIS SCRIPT IS ONLY FOR UPDATING VIDEO TITLES
			 *
			 *
			 *
			 *   IT IS NOT FOR UPDATING VIDEO COUNTS!!!!
			 *
			 *
			 *
			 *   You will most likely not have to use this script at all. So please don't.
			 *
			 *
			 */

			

						$args = array('post_type' => 'video',
										'posts_per_page' => -1,
										'post_status' => 'publish' );

						$videos = new WP_Query($args);

						if ($videos->have_posts()) : while ($videos->have_posts()) : $videos->the_post();

							// $video_id = get_the_ID();

							// $prospect_id = get_post_meta( $video_id, '_video_prospect', true );

							// $prospect_position = get_post_meta( $prospect_id, '_position', true );

							// if ( $prospect_position != get_post_meta( $video_id, '_video_position' ) ) {
							// 	update_post_meta( $video_id, '_video_position', $prospect_position );
							// 	echo '<li>'.the_title($video_id).' - position updated to '.$prospect_position.'</li>';
							// }


							// $video_host = 'youtube';

							// if (get_post_meta($video_id, '_video_host', FALSE)) { // If the custom field already has a value
					  //           update_post_meta($video_id, '_video_host', $video_host);
					  //       } else { // If the custom field doesn't have a value
					  //           add_post_meta($video_id, '_video_host', $video_host);
					  //       }

							// Reset Video Post Titles
							//
							// make sure to disable add_filter( 'wp_insert_post_data' , 'wsdev_video_post_title' , '99', 2 ) in functions
							$video_id = get_the_ID();
							$prospect_id = get_post_meta( $video_id, '_video_prospect', true);
							$player_name = get_the_title($prospect_id);
							$opponent = get_post_meta( $video_id, '_video_opponent', true);
							$year = get_post_meta( $video_id, '_video_year', true);

							
							$new_title = "".$player_name." vs. ".$opponent." (".$year.")";

							
								$video_post = array(
										'ID' => $video_id,
										'post_content' => '',
										'post_title' => $new_title );

							
							  
							  wp_update_post($video_post);


					        ?><!-- <p><?php the_title(); ?> - <?php echo get_post_meta(get_the_ID(), '_video_host', true); ?> - Updated</p> -->
	
					        <p><?php echo $new_title; ?></p>
					    <?php


						endwhile; endif;
					?>
			</div>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>