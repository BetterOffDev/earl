<div class="author-box col-md-12">
	
	<h2 class="single"><?php the_author_meta('display_name', $author_id); ?></h2>
	

	<div class="row">
		<div class="col-md-2 aligncenter">
			<?php 

				$twitter_img_url = get_twitter_avatar( get_the_author_meta('twitter', $author_id) );
				
			?>
			<img class="author-photo" src="<?php echo $twitter_img_url;?>" />
		</div>
		<div class="col-md-10">
		    <p><?php the_author_meta('description'); ?></p>
		    <div class="row">
		    	<div class="col-md-6 aligncenter">
		     		<a href="https://twitter.com/<?php the_author_meta('twitter', $author_id); ?>" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @<?php the_author_meta('twitter', $author_id); ?></a>
		     		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		     	</div>
		     	<div class="col-md-6 aligncenter">
		     		<a href="<?php bloginfo('url'); ?>/members/<?php the_author_meta('user_nicename', $author_id); ?>"><h4 class="see-all">See all posts by <?php the_author_meta('display_name', $author_id); ?></h4></a>
		     	</div>
		    </div>
		</div>
	</div>

	
	<h3 class="author-continued">Recent posts by <?php the_author_meta('display_name', $author_id); ?></h3>
	<hr>

	<div class="row author-posts">
		<?php $author_name = get_the_author_meta('user_nicename', $author_id); ?>

		<?php $args = array('post_type' => array('post', 'video', 'mockdrafts', 'memberarticles'),
							'author_name' => $author_name,
							'posts_per_page' => 3 );

			$other = new WP_Query($args);

			if ($other->have_posts()) : while ($other->have_posts()) : $other->the_post(); ?>

		<div class="col-md-4">
			<h4 class="single"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></h4>
			<p><?php 
				if ( has_post_thumbnail() ) { 
					the_post_thumbnail('thumbnail'); 
					echo '</a>';
				} 
				elseif ( get_post_type() == 'video' ) {
					$video_id = get_post_meta( get_the_ID(), '_video_id', true);
					$video_host = get_post_meta( get_the_ID(), '_video_host', true);

					$img_src = get_video_thumb( 'medium' );
					?>
					<img src="<?php echo $img_src; ?>" class="img-responsive" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
					<?php
				}
				else {
					echo wsdev_main_image('default-img-md img-responsive');
				}
				?>
			</p>
		</div>

	<?php endwhile; endif; ?>

	</div>
</div>