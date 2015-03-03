<?php
/**
 * single-mockdraft.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<?php get_template_part('partials/content', 'single-mockdraft'); ?>

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
			
			<div class="row" style="text-align: center;">
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

	<script type="text/javascript">

	jQuery('.show-analysis').click(function() {
		var analysis = jQuery(this).siblings('.analysis');
		analysis.slideDown();
		jQuery(this).hide();
		jQuery(this).siblings('.hide-analysis').show();
	});

	jQuery('.hide-analysis').click(function() {
		var analysis = jQuery(this).siblings('.analysis');
		analysis.slideUp();
		jQuery(this).hide();
		jQuery(this).siblings('.show-analysis').show();
	});


</script>


<?php get_footer(); ?>