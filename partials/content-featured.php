<?php
	$args = array('posts_per_page' => 1,
                  'category_name' => 'featured',
                  'post_type' => array('post', 'mockdrafts'),
                  'post_type' => array('any'),
                  'orderby' => 'date' );
    $featured = new WP_Query($args);
    $i = 0;
    global $featured_posts;
    $featured_posts = array();
    while ($featured->have_posts()) : $featured->the_post();
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

	array_push($featured_posts, get_the_ID() );

	endwhile;
?>

<div class="col-sm-12 col-lg-5">

	<div class="row">
		<div class="col-sm-12">
			<ul class="stay-connected">
				<li>
					<a href="http://www.twitter.com/draftbreakdown" target="_blank"><i class="fa fa-twitter-square"></i></a>
				</li>
				<li>
					<a href="http://www.facebook.com/draftbreakdown" target="_blank"><i class="fa fa-facebook-square"></i></a>
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/contact"><i class="fa fa-envelope-square"></i></a>
				</li>
				<li>
					<a href="<?php bloginfo('url'); ?>/feed"><i class="fa fa-rss-square"></i></a>
				</li>
			</ul>
		</div>
	</div>


	<div id="usmg_ad_nfl.main_football_sports_300x250_1a" style="text-align: center;">
		<script type='text/javascript'>
			googletag.defineSlot('/7103/SMG_DraftBreakdown/300x250_1a/sports/football/nfl.main', [[300,250]], 'usmg_ad_nfl.main_football_sports_300x250_1a').addService(googletag.pubads());
			googletag.enableServices();
			googletag.display('usmg_ad_nfl.main_football_sports_300x250_1a');
		</script>
	</div>
</div>
