<div style="clear: both;"></div>
<div class="author-container">
	<div class="row-fluid">	
		<h2 class="single"><?php the_author_meta('display_name', $author_id); ?></h2>
	</div>
	<div class="row-fluid">
		<div class="span2"><?php 
				
				$credentials = null;
				get_template_part('creds', 'twitterapi');

				$twitter_name = get_the_author_meta('twitter', $author_id);
				
				$twitter_api = new Wp_Twitter_Api( $credentials );

				$query = 'screen_name='.$twitter_name;
				$args = array(
				  'type' => 'users/show'
				);
				$twitter_result = $twitter_api->query( $query, $args ); 
				
				$twitter_img_url = str_replace( '_normal', '', $twitter_result->profile_image_url );

			?>
			<img class="author-photo" src="<?php echo $twitter_img_url;?>" />
		</div>
		<div class="span10">
		     <p><?php the_author_meta('description', $author_id); ?>&nbsp;<!-- <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ); ?>"> --><a href="<?php bloginfo('url'); ?>/members/<?php the_author_meta('login', $author_id); ?>">See all posts by <?php the_author_meta('display_name', $author_id); ?>.</a></p>
		     <p><a href="https://twitter.com/<?php the_author_meta('twitter', $author_id); ?>" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @<?php the_author_meta('twitter', $author_id); ?></a>
		     <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></p>
		</div>
	</div>
    
	<div class="row-fluid">
		<div class="row-fluid">
			<h3 class="author-continued">Recent posts by <?php the_author_meta('display_name', $author_id); ?></h3>
		</div>
		<div class="row-fluid author-posts">

			<?php $args = array('posts_per_page' => 3,
								'author' => $author_id,
								'post_type' => array('post','video' ));

				$other = new WP_Query($args);

				if ($other->have_posts()) : while ($other->have_posts()) : $other->the_post(); 
				
				?>

			<div class="span4">
				<h4 class="single"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<p><?php 
					if ( has_post_thumbnail() ) { 
						the_post_thumbnail('thumbnail'); 
						echo '</a>';
					} 
					elseif ( get_post_type() == 'video' ) {
					$video_id = get_post_meta( get_the_ID(), '_video_id', true);
					$video_host = get_post_meta( get_the_ID(), '_video_host', true);

					if ( $video_host == 'youtube' ) {
						//$video_thumb_src = 'http://img.youtube.com/vi/'.$related_video_id.'/mqdefault.jpg';
						$video_thumb_src = get_youtube_video_thumb($video_id);
					}
					if ( $video_host == 'vimeo' ) {
						$video_thumb_src = get_vimeo_video_thumb($video_id, 'large');
					}
					?>
					<img class="video-thumbnail" src="<?php echo $video_thumb_src; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
					<?php
				}

				?></p>
			</div>

				<?php endwhile; endif; ?>
				<?php wp_reset_postdata(); ?>
		</div>
	</div>
</div>