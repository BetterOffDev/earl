<?php
	global $featured_posts;
	$args = array('posts_per_page' => 6,
                  'category_name' => 'featured',
                  'post_type' => array('post', 'memberarticles', 'mockdrafts'),
                  'post__not_in' => $featured_posts );
    $featured = new WP_Query($args);
    $i = 0;
    while ($featured->have_posts()) : $featured->the_post();
?>
	
	<div class="col-xs-12 col-sm-6">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-5 col-sm-4">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?></a>
				</div>
				<div class="col-xs-7 col-sm-8">
					<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
				</div>
			</div>
		</div>
	</div>
		
	


<?php endwhile; ?>
