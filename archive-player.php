<?php 
/**
 * archive-player.php
 *
 * @package Earl
 */

	get_header();

	get_template_part('partials/players-filtering'); 

?>
<div class="row">
	<div class="col-sm-8 main-col">
		<div class="row-fluid" style="padding-top: 10px;">
			<div class="col-sm-6">
				<h1 class="listing-page"><?php echo $title; ?></h1>
			</div>
			<div class="col-sm-6" style="text-align: right;">
				
				<form id="class_form" action="<?php bloginfo('url'); ?>/players/" method="GET">

					<select class="form-control" id="class_select" name="draft_class" style="margin-top: 5px; width: 85px; float: right;">
						<option value="2013"<?php if ($draft_class == '2013') echo "selected='selected'"; ?>>2013</option>
						<option value="2014"<?php if ($draft_class == '2014') echo "selected='selected'"; ?>>2014</option>
						<option value="2015"<?php if ($draft_class == '2015') echo "selected='selected'"; ?>>2015</option>
						<option value="2016"<?php if ($draft_class == '2016') echo "selected='selected'"; ?>>2016</option>
					</select>
					<span style="margin-right: 10px; margin-top: 10px; float: right;">Class: </span>
					<input type="hidden" name="position" value="<?php echo $position; ?>" />
				</form>
			</div>
		</div>
		<hr style="margin-top: 0;">

		<div class="pagination text-center">
		    <ul>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=QB">QB</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=RB">RB</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=FB">FB</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=WR">WR</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=TE">TE</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=OT">OT</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=OG">OG</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=C">C</a></li>
			    <?php if ( $draft_class >= 2015 ) {
			    	?> <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=DL">DL</a></li>
			    	<?php
			    } ?>
			    <?php if ( $draft_class >= 2015 ) {
			    	?> <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=EDGE">EDGE</a></li>
			    	<?php
			    } ?>
			    <?php if ( $draft_class < 2015 ) {
			    	?>
			    	<li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=DE">DE</a></li>
			    	<?php
			    } ?>
			    <?php if ( $draft_class < 2015 ) {
			    	?>
			    	<li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=DT">DT</a></li>
			    	<?php
			    } ?>
			    <?php if ( $draft_class >= 2015 ) {
			    	?>
			    	<li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=LB">LB</a></li>
			    	<?php
			    } ?>
			    <?php if ( $draft_class < 2015 ) {
			    	?>
			    	<li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=ILB">ILB</a></li>
			    	<?php
			    } ?>
			    <?php if ( $draft_class < 2015 ) {
			    	?>
			    	<li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=OLB">OLB</a></li>
			    	<?php
			    } ?>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=CB">CB</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=S">S</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=K">K</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>&position=P">P</a></li>
			    <li><a href="<?php bloginfo('url'); ?>/players/?draft_class=<?php echo $draft_class; ?>">All</a></li>
		    </ul>
	    </div>

	    <?php get_template_part('partials/players-listing-table'); ?>

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