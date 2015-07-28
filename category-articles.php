<?php
/**
 * category-articles.php
 *
 * @package Earl
 */

get_header(); 
	if (isset($_GET['member']) ) {
		$member = $_GET['member'];

		if ($member == 'all') {
			$title = 'All Articles';
		}

		else {
			$title = 'Articles';
		}
	}

	else {
		$title = 'Articles';
	}
?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<div class="col-sm-6">
				<h1><?php echo $title; ?></h1>
			</div>
			<div class="col-sm-6" style="text-align: right; padding-top: 20px;">
				
				<?php if ( !$member || $member == 'all' || $member == 'staff' ) {
					?>
					<form id="class_form" action="<?php bloginfo('url'); ?>/category/articles/" method="GET">

						<select class="form-control" id="class_select" name="member" style="margin-top: 5px; width: 155px; float: right;">
							<option value="staff"<?php if ($member == 'staff' || $member == null) echo "selected='selected'"; ?>>Staff Only</option>
							<option value="all"<?php if ($member == 'all') echo "selected='selected'"; ?>>Staff and Members</option>
						</select>
						<span style="margin-right: 10px; margin-top: 10px; float: right; font-style: italic;">View Articles From: </span>
					</form>
					<?php
						}
				?>
			</div>
			<hr>
			<?php get_template_part('partials/listing', 'articles'); ?>

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