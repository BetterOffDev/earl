<?php
/**
 * page-test-video.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<div class="video-embed-wrapper">
				<iframe title="YouTube video player" width="640" height="360" src="http://www.youtube.com/embed/4mJ0EQY3lnc?rel=0&modestbranding=0&showinfo=0&origin=draftbreakdown.com&start=30&end=35&autoplay=1" frameborder="0"></iframe>
			</div>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>