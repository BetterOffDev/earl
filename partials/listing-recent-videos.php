<?php $args = array(
					'post_type' => 'video',
					'posts_per_page' => 10 );

	$recent = new WP_Query($args);

	while ( $recent->have_posts() ) : $recent->the_post(); ?>
	
	<li>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
	</li>

<?php endwhile; ?>