<div class="related-videos">

	<?php
		$video_prospect_id = get_post_meta( $post->ID, '_video_prospect', true);
		$player_name = get_the_title( $video_prospect_id );
		$original_id = get_the_ID();
	?>
	<h3>More clips for <?php echo $player_name; ?></h3>
	<?php
		$args = array(
						'post_type' => 'video',
						'posts_per_page' => -1,
						'meta_key' => '_video_prospect',
						'meta_value' => $video_prospect_id
					);

		$related = new WP_Query($args);

		while ( $related->have_posts() ) : $related->the_post();

		
		if ( $related->post_count <= 1 ) {
			echo '<h4>Coming soon!</h4>';
		}

		if ( get_the_ID() == $original_id ) {
			continue;
		}

		$related_video_id = get_post_meta( get_the_ID(), '_video_id', true);
		$img_src = get_video_thumb( 'medium' );

	?>
	<div class="col-xs-6 col-md-2">

		<a class="video-thumb-container" href="<?php the_permalink(); ?>">
			<?php 
			$img_src = get_video_thumb( 'medium' ); ?>
			<img src="<?php echo $img_src; ?>" class="img-responsive" />
			<h4 class="video-thumb-title">vs <?php echo get_post_meta( get_the_ID(), '_video_opponent', true ); ?> (<?php echo get_post_meta( get_the_ID(), '_video_year', true); ?>) <?php if ( strtotime($post->post_date) > strtotime('-7 days')) { echo '<p><span class="label label-danger">New!</span></p>'; } ?></h4>

		</a>
	</div>

	<?php 

		endwhile;
		
		wp_reset_postdata();	

	?>
</div>
