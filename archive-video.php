<?php
/**
 * archive-video.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8">
			<h1>Videos</h1>
			<?php get_template_part('partials/videos', 'all'); ?>
		</div>

		<div class="col-sm-4">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>