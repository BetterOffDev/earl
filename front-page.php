<?php
/**
 * front-page.php
 *
 * @package Earl
 */

get_header(); ?>
	
	<div class="row recent-videos">
		<div class="col-sm-12">
			<h1 class="home-section-title">Recent Videos</h1>
		</div>
		<?php get_template_part('partials/videos', 'recent'); ?>
	</div>

	<div class="row featured">
		<div class="col-sm-12">
			<h1 class="home-section-title">Featured Content</h1>
		</div>
		<?php get_template_part('partials/content', 'featured'); ?>
	</div>
	<div class="row visible-sm visible-md visible-lg ad ad-lh">
		<div class="col-sm-12">
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
	</div>
	<div class="row visible-xs ad ad-sq">
		<div class="col-sm-12">
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
	</div>
	<div class="row sub-featured">
		<div class="col-sm-12">
			<h1 class="home-section-title">Spotlight</h1>
		</div>
		<?php get_template_part('partials/content', 'sub-featured'); ?>
		<?php echo do_shortcode('[ajax_load_more post_type="post, mockdrafts, memberarticles" offset="6" posts_per_page="6" transition="fade"]'); ?>
	</div>
	
	
<?php get_footer(); ?>
