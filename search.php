<?php
/**
 * search.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<h1>Search Results for <em>"<?php the_search_query(); ?>"</em></h1>
			<hr>
			<?php get_template_part('partials/listing', 'search'); ?>
			<div class="row" style="margin: 20px 0; padding: 10px 0; text-align: center;">
				<?php if(function_exists('wp_pagenavi')) 
								wp_pagenavi(); 
				?>
			</div>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>