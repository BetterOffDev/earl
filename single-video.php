<?php
/**
 * single-video.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8">
			<?php get_template_part('partials/video', 'breadcrumb'); ?>
			<?php get_template_part('partials/video', 'single'); ?>
			<?php get_template_part('partials/videos', 'related'); ?>

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

			<?php //get_template_part('partials/author', 'single'); ?>

		</div>
	
		<div class="col-sm-4">
			<?php get_sidebar('single-video'); ?>
		</div>
	</div>


<?php get_footer(); ?>