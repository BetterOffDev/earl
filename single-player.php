<?php
/**
 * single-player.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<?php get_template_part('partials/player', 'breadcrumb'); ?>
			<?php get_template_part('partials/player', 'single'); ?>

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

		</div>
	
		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>

	<script>

		(function bootstrap_tab_bookmark (selector) { 

			if (selector == undefined) {
		    	selector = ""; 
		    }
		 
		    /* Automagically jump on good tab based on anchor */
		    jQuery(document).ready(function() {
		        url = document.location.href.split('#');
		        if(url[1] != undefined) {
		            jQuery(selector + '[href=#'+url[1]+']').tab('show');
		        }
		    });
		 
		    var update_location = function (event) {
		        document.location.hash = this.getAttribute("href");
		    }
		 
		    /* Update hash based on tab */
		    jQuery(selector + "[data-toggle=tab]").click(update_location);
		    var scrollmem = jQuery('body').scrollTop();
    		jQuery('html,body').scrollTop(scrollmem);
		})();

  </script>


<?php get_footer(); ?>