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
					$user = get_user_by('slug', $member);
				?>
				<h1 style="margin-bottom: 20px;">Scouting Notes by <?php echo $user->display_name; ?></h1>

				<?php

					wp_reset_postdata();

					$args = array('post_type' => 'scoutingnotes',
									'posts_per_page' => -1,
									'author' => $member,
									'paged' => get_query_var('page'),
								);

					$query = new WP_Query($args);

					if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();

					echo '<div class="member-post-listing">';
					echo '<p class="member-post-listing-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
					echo '<p class="member-post-listing-date">'.get_the_date().'</p>';
					echo '</div>';
				?>

				<?php
					if(function_exists('wp_pagenavi')) 
						wp_pagenavi(); 
				?>

				<?php
					endwhile; endif;
				?>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>