<?php
	$args = array('posts_per_page' => 60,
                  'post_type' => 'video');
    $videos = new WP_Query($args);
    $i = 0;
    echo '<div class="row">';
    while ($videos->have_posts()) : $videos->the_post();
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
	$i++;
	if ( $i == 6 ) {
		echo '</div><div class="row">';
		$i = 0;
	}

endwhile; 
wp_reset_query();
	echo '</div>';
?>
