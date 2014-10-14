<?php
/**
 * front-page.php
 *
 * @package Earl
 */

get_header(); ?>
	
	<div class="row recent-videos visible-lg">
		<?php get_template_part('partials/videos', 'recent'); ?>
	</div>

	<div class="row featured">
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
		<?php get_template_part('partials/content', 'sub-featured'); ?>
	</div>
	
	
<?php get_footer(); ?>
