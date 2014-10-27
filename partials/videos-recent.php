<?php
	$args = array('posts_per_page' => 6,
                  'post_type' => 'video');
    $recent = new WP_Query($args);
    while ($recent->have_posts()) : $recent->the_post();
?>
	<?php 
		?>
		<div class="col-xs-6 col-md-2">
			<a class="video-thumb-container" href="<?php the_permalink(); ?>">
				<?php 
				$img_src = get_video_thumb( 'medium' ); ?>
				<img src="<?php echo $img_src; ?>" class="img-responsive" />
				<h4 class="video-thumb-title"><?php the_title(); ?></h4>
			</a>
		</div>
		<?php
		
endwhile; 
wp_reset_query();
?>
