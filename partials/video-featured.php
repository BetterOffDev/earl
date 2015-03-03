<?php 

	$args = array(
				'post_type' => 'video',
				'posts_per_page' => 1,
				'orderby' => 'rand'
			);
	add_filter( 'posts_where', 'wsdev_filter_where' );

	$videos = new WP_Query($args);
	
	remove_filter( 'posts_where', 'wsdev_filter_where' );

	if ( $videos->have_posts()) : while ( $videos->have_posts()) : $videos->the_post();

	$video_id = get_post_meta( get_the_ID(), '_video_id', true);
	$video_host = get_post_meta( get_the_ID(), '_video_host', true);
	$img_src = get_video_thumb( 'large' );
	?>

<div class="featured-vid-wrapper">
	<a href="<?php the_permalink(); ?>">
		<img class="img-responsive" src="<?php echo $img_src; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />    
		<h5 class="home-vid-title"><?php the_title(); ?></h5>
	</a>
</div>

<?php endwhile; endif; ?>