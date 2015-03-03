<?php 

	$original_id = get_the_ID();
	$original_post = $post;

	$args = array(
				'post_type' => 'video',
				'posts_per_page' => -1,
				'meta_query' => array(
							array(
								'key' => '_video_prospect',
								'value' => $original_id,
								),
							),
				'meta_key' => '_video_year',
				'orderby' => 'meta_value_num'
			);

	$year = null;

	$videos = new WP_Query($args); 
?>

<div class="row related-videos">

	<?php

	if ( $videos->have_posts()) : while ( $videos->have_posts()) : $videos->the_post();

	$related_video_id = get_post_meta( get_the_ID(), '_video_id', true);
	$video_host = get_post_meta( get_the_ID(), '_video_host', true);

	$related_video_id = get_post_meta( get_the_ID(), '_video_id', true);
	$img_src = get_video_thumb( 'medium' );
	
	if ( $year != get_post_meta( get_the_ID(), '_video_year', true ) ) {
		echo '</div><div class="row related-videos"><h4 class="year-divider">'.get_post_meta( get_the_ID(), '_video_year', true ).'</h4></div><div class="row related-videos">';
	}


		?>

		<div class="col-xs-6 col-md-2">
			<a class="video-thumb-container" href="<?php the_permalink(); ?>">
				<?php 
				$img_src = get_video_thumb( 'medium' ); ?>
				<img src="<?php echo $img_src; ?>" class="img-responsive" />
				<h4 class="video-thumb-title">vs <?php echo get_post_meta( get_the_ID(), '_video_opponent', true ); ?> <?php if ( strtotime($post->post_date) > strtotime('-7 days')) { echo '<p><span class="label label-danger">New!</span></p>'; } ?></h4>

			</a>
		</div>
	
	<?php

		$year = get_post_meta( get_the_ID(), '_video_year', true );

		endwhile; endif; 
	?>

</div>
<p style="font-size: 10px; font-style: italic;">The videos posted here at Draft Breakdown are not hosted on this server and the original video content is not considered the property of Draft Breakdown. The videos are considered to be used under the "Fair Use Doctrine" of United States Copyright Law, Title 17 U.S. Code Sections 107-118. Videos are used on this site for editorial and educational purposes only and Draft Breakdown and it's staff do not claim ownership of any original video content. Draft Breakdown and it's staff do not use said video clips in advertisements, marketing or for direct financial gain. All video content in each clip is considered owned by the individual broadcast companies.
			</p>