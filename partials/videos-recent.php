<?php
	$args = array('posts_per_page' => 6,
                  'post_type' => 'video');
    $recent = new WP_Query($args);
    while ($recent->have_posts()) : $recent->the_post();
?>
	<?php 
		?>
		<div class="col-md-2">
			<a class="video-thumb-container" href="<?php the_permalink(); ?>">
				<?php $img_src = get_youtube_video_thumb( get_post_meta( get_the_ID(), '_video_id', true) ); ?>
				<img src="<?php echo $img_src; ?>" class="img-responsive" />
				<h4 class="video-thumb-title"><?php the_title(); ?></h4>
			</a>
		</div>
		<?php
		
endwhile; 
wp_reset_query();
?>
