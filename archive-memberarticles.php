<?php
/**
 * archive-memberarticles.php
 *
 * @package Earl
 */

get_header(); 

	if (isset($_GET['member']) ) {
		$member = $_GET['member'];
	}
?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<h1>Member Articles</h1>
			<hr>
			<?php get_template_part('partials/listing', 'memberarticles'); ?>

			<div class="row" style="margin: 20px 0; padding: 10px 0; text-align: center;">
				<?php if(function_exists('wp_pagenavi')) 
								wp_pagenavi(); 
				?>
			</div>

			<div class="row" style="text-align: center;">
				<!-- SMG_DraftBreakdown/728x90_1a/sports/football/nfl.general -->
				<div id="usmg_ad_nfl.general_football_sports_728x90_1a">
					<script type='text/javascript'>
						googletag.defineSlot('/7103/SMG_DraftBreakdown/728x90_1a/sports/football/nfl.general', [728,90], 'usmg_ad_nfl.general_football_sports_728x90_1a').addService(googletag.pubads());
						googletag.enableServices();
						googletag.display('usmg_ad_nfl.general_football_sports_728x90_1a');
					</script>
				</div>
			</div>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>