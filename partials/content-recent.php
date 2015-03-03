<?php $args = array(
					'post_type' => 'post',
					'posts_per_page' => 5 );

	$recent = new WP_Query($args);

	while ( $recent->have_posts() ) : $recent->the_post(); ?>
	<li>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		<span class="post-date"> - <?php the_time('F j'); ?></span>
	</li>

<?php endwhile; ?>