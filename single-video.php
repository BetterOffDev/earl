<?php
/**
 * single-video.php
 *
 * @package Earl
 */

include "partials/scoutingnotes-post.php";

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<?php get_template_part('partials/video', 'breadcrumb'); ?>
			<?php get_template_part('partials/video', 'single'); ?>
			<p style="font-size: 11px; font-style: italic;">The videos posted here at Draft Breakdown are not hosted on this server and the original video content is not considered the property of Draft Breakdown. The videos are considered to be used under the "Fair Use Doctrine" of United States Copyright Law, Title 17 U.S. Code Sections 107-118. Videos are used on this site for editorial and educational purposes only and Draft Breakdown and its staff do not claim ownership of any original video content. Draft Breakdown and its staff do not use said video clips in advertisements, marketing or for direct financial gain. All video content in each clip is considered owned by the individual broadcast companies.
			</p>
			<?php include "scouting-notes.php"; ?>
			<?php get_template_part('partials/videos', 'related'); ?>

			<div class="row" style="text-align: center;">
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
			</div>

			<?php get_template_part('partials/author', 'box'); ?>

		</div>
	
		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>