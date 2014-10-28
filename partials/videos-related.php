<div class="row-fluid related-videos">

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

		if ( get_the_ID() == $original_id ) {
			continue;
		}

		$related_video_id = get_post_meta( get_the_ID(), '_video_id', true);
		$img_src = get_video_thumb( 'medium' );
	?>
	<div class="col-xs-6 col-md-2">
		<div class="video_thumb_container">
	    
			<strong><a href="<?php the_permalink(); ?>"><img class="img-responsive" src="<?php echo $img_src; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />

			<p>vs <?php echo get_post_meta( get_the_ID(), '_video_opponent', true ); ?> (<?php echo get_post_meta( get_the_ID(), '_video_year', true); ?>)</strong></p>
			<p><?php if ( strtotime($post->post_date) > strtotime('-7 days')) { echo '&nbsp;&nbsp;<span class="badge badge-important badge-small">New!</span>'; } ?></a></p>

		</div>
	</div>

	<?php 

		endwhile;
		
		wp_reset_postdata();	

	?>
</div>
