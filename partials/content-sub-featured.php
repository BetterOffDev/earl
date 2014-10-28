<?php
	global $featured_posts;
	$args = array('posts_per_page' => 6,
				  'offset' => 6,
                  'post_type' => array('post', 'memberarticles', 'mockdrafts', 'video'),
                  'post__not_in' => $featured_posts );
    $featured = new WP_Query($args);
    $i = 0;
    while ($featured->have_posts()) : $featured->the_post();
?>
	
	<div class="col-xs-12 col-sm-6">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-5 col-sm-4">
					<a href="<?php the_permalink(); ?>">
						<?php 
							if ( get_post_type() == 'video' ) {
								$img_src = get_video_thumb( 'large' );
								echo '<img src="'.$img_src.'" class="img-responsive" />';
							}
							else {
								the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); 
							}
							
						?>
					</a>
				</div>
				<div class="col-xs-7 col-sm-8">
					<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
				</div>
			</div>
		</div>
	</div>
	

<?php endwhile; ?>

	<div class="col-sm-12 visible-sm visible-md visible-lg ad ad-lh">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Horizontal leaderboard -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:728px;height:90px"
		     data-ad-client="ca-pub-7021861911581046"
		     data-ad-slot="9568559232"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>


	<div class="col-sm-12 visible-xs ad ad-sq">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- Mobile 300x250 -->
			<ins class="adsbygoogle"
		     style="display:inline-block;width:300px;height:250px"
		     data-ad-client="ca-pub-7021861911581046"
		     data-ad-slot="1528285636"></ins>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
