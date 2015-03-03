<?php
/**
 * archive-video.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<h1 class="listing-page">Videos</h1>
			<hr>
			<div class="pagination text-center">
				<?php 
					if (isset($_GET['member']) ) {
						$member_get = '&member='.$_GET['member'];
					}
					else {
						$member_get = '';
					}
				?>
			    <ul>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=QB<?php echo $member_get; ?>">QB</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=RB<?php echo $member_get; ?>">RB</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=FB<?php echo $member_get; ?>">FB</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=WR<?php echo $member_get; ?>">WR</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=TE<?php echo $member_get; ?>">TE</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=OT<?php echo $member_get; ?>">OT</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=OG<?php echo $member_get; ?>">OG</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=C<?php echo $member_get; ?>">C</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=DL<?php echo $member_get; ?>">DL</a></li>
				    
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=EDGE<?php echo $member_get; ?>">EDGE</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=LB<?php echo $member_get; ?>">LB</a></li>
				    
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=CB<?php echo $member_get; ?>">CB</a></li>
				    <li><a href="<?php bloginfo('url'); ?>/video/?position=S<?php echo $member_get; ?>">S</a></li>
			    </ul>
		    </div>
			<?php get_template_part('partials/videos', 'all'); ?>
			<p style="font-size: 10px; font-style: italic;">The videos posted here at Draft Breakdown are not hosted on this server and the original video content is not considered the property of Draft Breakdown. The videos are considered to be used under the "Fair Use Doctrine" of United States Copyright Law, Title 17 U.S. Code Sections 107-118. Videos are used on this site for editorial and educational purposes only and Draft Breakdown and it's staff do not claim ownership of any original video content. Draft Breakdown and it's staff do not use said video clips in advertisements, marketing or for direct financial gain. All video content in each clip is considered owned by the individual broadcast companies.
			</p>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>