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
		<div class="col-sm-12">
			<a style="float: right;" href="<?php bloginfo('url'); ?>/video">See All <i class="fa fa-plus-square-o"></i></a>
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

	<div class="row featured">
		<div class="col-sm-12">
			<h1 class="home-section-title">Featured Content</h1>
		</div>
		<?php get_template_part('partials/content', 'featured'); ?>
	</div>
	
	<div class="row">&nbsp;</div>

	<div class="row sub-featured">
		<div class="col-sm-12">
			<h1 class="home-section-title">Spotlight</h1>
		</div>
		<?php get_template_part('partials/content', 'sub-featured'); ?>
		<?php //echo do_shortcode('[ajax_load_more post_type="post, mockdrafts, memberarticles" offset="6" posts_per_page="6" transition="fade" button_label="Scroll for more"]'); ?>
	</div>

	<!--<div class="col-sm-12 visible-sm visible-md visible-lg ad ad-lh">
		<div id="taboola-below-article-thumbnails"></div>
		<script type="text/javascript">
		  window._taboola = window._taboola || [];
		  _taboola.push({
		    mode: 'thumbnails-a',
		    container: 'taboola-below-article-thumbnails',
		    placement: 'Below Article Thumbnails',
		    target_type: 'mix'
		  });
		</script>
	</div>

	<div class="col-sm-12 visible-xs ad ad-sq">
		<div id="taboola-mid-article-thumbnails"></div>
		<script type="text/javascript">
		  window._taboola = window._taboola || [];
		  _taboola.push({
		    mode: 'thumbnails-b',
		    container: 'taboola-mid-article-thumbnails',
		    placement: 'Mid-Article Thumbnails',
		    target_type: 'mix'
		  });
		</script>
	</div>-->
	<div class="col-sm-12 ad">
		<div id="taboola-below-article-thumbnails"></div>
		<script type="text/javascript">
		  window._taboola = window._taboola || [];
		  _taboola.push({
		    mode: 'thumbnails-a',
		    container: 'taboola-below-article-thumbnails',
		    placement: 'Below Article Thumbnails',
		    target_type: 'mix'
		  });
		</script>
	</div>

	
	
	
<?php get_footer(); ?>
