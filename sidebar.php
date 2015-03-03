<?php
/**
 * sidebar.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-12">
				<h3>Search for Prospects</h3>
				<hr>
				<?php get_search_form(); ?>
			</div>
		</div>

		<div class="row stay-connected-sidebar">
			<div class="col-sm-12">
				<h3>Stay Connected</h3>
				<hr>
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

		<div class="row ad ad-sq">
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

		<div class="row recent-videos-sidebar">
			<div class="col-sm-12">
				<h3>Recent Videos</h3>
				<hr>
				<h4><a href="/video/">** See All **</a></h4>
				<ul class="recent-videos">

					<?php get_template_part('partials/listing', 'recent-videos'); ?>

				</ul>
			</div>
		</div>

		<div class="row featured-video-sidebar">
			<div class="col-sm-12">
				<h3>Featured Prospect Video</h3>
				<hr>
				<?php get_template_part('partials/video', 'featured'); ?>
			</div>
		</div>

		<div class="row recent-analysis-sidebar">
			<div class="col-sm-12">
				<h3>Recent Analysis</h3>
				<hr>
				<ul class="recent-videos">
					<?php get_template_part('partials/content', 'recent'); ?>
				</ul>
			</div>
		</div>

		<div class="row ad ad-sq">
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

	</div>