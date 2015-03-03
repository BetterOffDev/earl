<?php
/**
 * 404.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<h1>Woops....</h1>
			<p>Something went wrong somewhere and the page you're looking for can't be found. Please use the search bar below to try again or use the navigation links above.</p>
			<p><?php get_search_form(); ?></p>

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

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>