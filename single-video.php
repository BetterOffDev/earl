<?php
/**
 * single-video.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8">
			<h1><?php the_title(); ?></h1>
			<?php get_template_part('partials/video', 'single'); ?>
		</div>

		<div class="col-sm-4">
			<?php get_sidebar('single-video'); ?>
		</div>
	</div>


<?php get_footer(); ?>