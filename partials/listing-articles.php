<?php 

	// if ( isset($_GET['member']) ) {
	// 	$member = $_GET['member'];
	// 	query_posts( array(
	// 				'category_name' => 'articles',
	// 				'post_type' => array('post', 'memberarticles'),
	// 				'posts_per_page' => 10,
	// 				'paged' => get_query_var('paged'),
	// 				'author_name' => $member
	// 				) );
	// }

	// else {
	// 	query_posts( array(
	// 				'category_name' => 'articles',
	// 				'post_type' => array('post', 'memberarticles'),
	// 				'posts_per_page' => 10,
	// 				'paged' => get_query_var('paged') 
	// 				) );
	// }

	global $member;

	if ( $member ) {

		if ( $member == 'all' ) {

			query_posts( 
				array(
			     	'category_name' => 'articles',
					'post_type' => array('post', 'memberarticles'),
			     	'posts_per_page' => 10,
			     	'paged' => get_query_var('paged')
			    ) 
			);
		}

		elseif ( $member == 'staff' ) {
			// get an array of all the "members"
			$user_query = new WP_User_Query( array( 'role' => 'Member' ) );
	    	$members = array();
	    	if ( ! empty( $user_query->results ) ) {
				foreach ( $user_query->results as $user ) {
					array_push($members, $user->ID);
				}
			} 

			query_posts( 
				array(
			     	'category_name' => 'articles',
					'post_type' => array('post', 'memberarticles'),
			     	'author__not_in' => $members,
			     	'posts_per_page' => 10,
			     	'paged' => get_query_var('paged') 
			    ) 
			);
		}

		else {
			query_posts( 
				array(
			     	'category_name' => 'articles',
					'post_type' => array('post', 'memberarticles'),
			     	'posts_per_page' => 10,
			     	'paged' => get_query_var('paged'),
			     	'author_name' => $member 
			    ) 
			);
		}
	}

	else {

		query_posts( 
				array(
			     	'category_name' => 'articles',
					'post_type' => array('post'),
			     	'posts_per_page' => 10,
			     	'paged' => get_query_var('paged') 
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