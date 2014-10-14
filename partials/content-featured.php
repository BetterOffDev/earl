<?php
	$args = array('posts_per_page' => 3,
                  'category_name' => 'featured',
                  'post_type' => array('post', 'memberarticles', 'mockdrafts', 'videos') );
    $featured = new WP_Query($args);
    $i = 0;
    global $featured_posts;
    $featured_posts = array();
    while ($featured->have_posts()) : $featured->the_post();
?>
	<?php 
		if ( $i == 0 ) {
			?>
			<div class="col-sm-12 col-lg-7">
				<div class="featured-img-container">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
						<h1 class="featured-title"><?php the_title(); ?></h1>
					</a>
				</div>
			</div>
			<?php
		}
		
		else {
			?>
			<div class="col-xs-6 col-sm-12 col-lg-5">
				<div class="thumbnail">
					<div class="featured-img-container home-small">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
						</a>
					</div>
					<div class="caption">
						<a href="<?php the_permalink(); ?>">
							<h2 class="featured-title-small"><?php the_title(); ?></h2>
						</a>
					</div>
				</div>
			</div>
			<?php
		}
	
		array_push($featured_posts, get_the_ID() );
		$i++; 
	?>


<?php endwhile;?>
