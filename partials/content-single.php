<?php
	while (have_posts()) : the_post(); ?>
 	
 	<?php $categories = get_the_category(); ?>
    <ul class="breadcrumb">
	    <li><a href="<?php bloginfo('url'); ?>">Home</a>&nbsp;<span class="divider"><i class="icon-double-angle-right"></i></span></li>
	    <li><a href="/category/<?php echo $categories[0]->slug; ?>"><?php echo $categories[0]->name; ?></a></li>
    </ul>
	<h1><?php the_title(); ?></h1>
	<div class="row author-share-row">
		<div class="col-md-5">
			<p class="written-by">Written by <?php the_author(get_the_ID()); ?> on <?php the_time('F j, Y') ?></p>
		</div>
		<div class="col-md-7 share-buttons">
			
			<?php 
				
				if ( function_exists( get_ssb() ) ) {
					get_ssb('twitter=1&fblike=2&googleplus=3');
				}
			?>
			
		</div>
	</div>
 	<?php the_content(); ?>
 	

<?php 	
	endwhile;
?>
