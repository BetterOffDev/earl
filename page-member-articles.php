<?php
/**
 * page-member-articles.php
 *
 * @package Earl
 */

if ( isset($_GET['member']) ) {
		$member = $_GET['member'];
	}

	else {
		$member = '';
	}

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<?php 
					$user = get_user_by('slug', $member);
				?>
				<h1 style="margin-bottom: 20px;">Articles by <?php echo $user->display_name; ?></h1>

				<?php

					wp_reset_postdata();

					$args = array('post_type' => 'memberarticle',
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