<?php
	while (have_posts()) : the_post(); ?>
 	
 	<?php $categories = get_the_category(); ?>
    <ul class="breadcrumb">
	    <li><a href="<?php bloginfo('url'); ?>">Home</a>&nbsp;<span class="divider"><i class="icon-double-angle-right"></i></span></li>
	    <li><a href="/memberarticles/">Member Articles</a></li>
    </ul>
    <?php 
		$current_user = wp_get_current_user();

        if ( $current_user->ID == get_the_author_meta('ID') ) {
            $edit = true;
        }
	?>
	<h1><?php the_title(); ?><?php if ($edit) { echo '&nbsp;&nbsp;<a href="'.get_bloginfo('url').'/article-editor/?post='.get_the_ID().'"><i class="fa fa-edit" style="font-size: 20px;" title="Edit"></i></a>'; } ?></h1>
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
