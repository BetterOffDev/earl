<?php

	global $member;

	$current_user = wp_get_current_user();

	$current_user2 = get_userdata( $current_user->ID );

	$current_user_nicename = $current_user2->user_nicename;
	
	if ( $member ) {

		if ( $current_user_nicename == $member ) {
			query_posts( 
				array(
			     	'post_type' => 'scoutingnotes',
			     	'posts_per_page' => 10,
			     	'paged' => get_query_var('paged'),
			     	'author_name' => $member,
			    ) 
			);
		}

		else {
			query_posts( 
				array(
			     	'post_type' => 'scoutingnotes',
			     	'posts_per_page' => 10,
			     	'paged' => get_query_var('paged'),
			     	'author_name' => $member,
			     	'meta_query' => array( 
			     		array( 'key' => '_private_note', 'value' => 'checked', 'compare' => '!=' ) 
			     	)
			    ) 
			);
		}
	}

	else {
		query_posts( 
			array(
		     	'post_type' => 'scoutingnotes',
		     	'posts_per_page' => 10,
		     	'paged' => get_query_var('paged'),
		     	'meta_query' => array(
		     		array( 'key' => '_private_note', 'value' => 'checked', 'compare' => '!=' )
		     	)
		    ) 
		);
	}
	
	
	if (have_posts()) : while (have_posts()) : the_post(); ?>

	<div class="post">
		<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
		<small><p>Written by <?php the_author(); ?> on <?php the_time('F j, Y') ?></p></small>
		<div class="post-thumbnail alignleft">
			<?php //if ( has_post_thumbnail() ) { the_post_thumbnail(array(295,188)); } ?>
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
			  the_post_thumbnail(array(295,188));
			} else {
			   echo wsdev_main_image('default-img-md img-responsive');
			} ?>
		</div>
		<div class="entry">
			<?php the_excerpt(); ?>
		</div>
	</div>			
	<hr>
		

<?php endwhile; endif; ?>