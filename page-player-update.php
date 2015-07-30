<?php
/**
 * page.php
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
			 *   This is the script for updating video counts per player
			 *
			 *
			 *
			 *   Hopefully you rarely have to use it.
			 *
			 *
			 *
			 *   
			 *
			 *
			 */

						$args = array('post_type' => 'player',
										'posts_per_page' => -1,
										'post_status' => 'publish',
										'meta_key' => '_position',
										'meta_value' => 'S' );

						$players = new WP_Query($args);

						if ($players->have_posts()) : while ($players->have_posts()) : $players->the_post();


							$vid_num = null;
							$temp_post = $post;
							$player_id = get_the_ID();
							$args = array(
											'post_type' => 'video',
											'posts_per_page' => -1,
											'post_status' => 'publish',
											'meta_key' => '_video_prospect',
											'meta_value' => $player_id
										);

							$vid_count = new WP_Query($args);

							if ( $vid_count->have_posts()) : while ( $vid_count->have_posts()) : $vid_count->the_post();

								$vid_num = $vid_count->post_count;

								echo $player_id. ' -- ' .the_title(). ' -- '.get_the_ID(). '<br />';

							endwhile; endif;
							$post = $temp_post;

							if (get_post_meta($player_id, '_number_videos', FALSE)) { // If the custom field already has a value
					            update_post_meta($player_id, '_number_videos', $vid_num);
					        } else { // If the custom field doesn't have a value
					            add_post_meta($player_id, '_number_videos', $vid_num);
					        }

					        ?><p><?php the_title(); ?> - <?php echo get_post_meta(get_the_ID(), '_number_videos', true); ?> - Updated</p>
					    <?php


						endwhile; endif;
					?>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>