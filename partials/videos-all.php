<?php
	global $member;

	if ( isset($_GET['position']) ) {

		

		$position = $_GET['position'];

		if ($member) {
			query_posts( array(
					'post_type' => 'video',
					'meta_key' => '_video_position',
					'meta_value' => $position,
					'posts_per_page' => 42,
					'paged' => get_query_var('paged'),
					'author_name' => $member
					) );
		}

		else {

			query_posts( array(
						'post_type' => 'video',
						'meta_key' => '_video_position',
						'meta_value' => $position,
						'posts_per_page' => 42,
						'paged' => get_query_var('paged'),
						'author_name' => $member
						) );
		}
		
	}
	else {

		if ($member) {
			query_posts( array(
					'post_type' => 'video',
					'posts_per_page' => 42,
					'paged' => get_query_var('paged'),
					'author_name' => $member
					) );
		}

		else {
			query_posts( array(
					'post_type' => 'video',
					'posts_per_page' => 42,
					'paged' => get_query_var('paged')
					) );
		}
		
	}
	
    //$videos = new WP_Query($args);
    $i = 0;
    echo '<div class="row">';
    if(have_posts()) : while (have_posts()) : the_post();
?>
	<?php 
		?>
		<div class="col-xs-6 col-md-2">
			<a class="video-thumb-container" href="<?php the_permalink(); ?>">
				<?php 
				$img_src = get_video_thumb( 'medium' ); ?>
				<img src="<?php echo $img_src; ?>" class="img-responsive" />
				<h4 class="video-thumb-title"><?php the_title(); ?> <?php if ( strtotime($post->post_date) > strtotime('-7 days')) { echo '<p><span class="label label-danger">New!</span></p>'; } ?></h4>

			</a>
		</div>
	<?php
	$i++;
	if ( $i == 6 ) {
		echo '</div><div class="row">';
		$i = 0;
	}

endwhile; endif;

?>
	<div class="row" style="padding: 10px 0; text-align: center;">
		<?php if(function_exists('wp_pagenavi')) 
				wp_pagenavi(); 
		?>
	</div>
<?php
//wp_reset_query();
	echo '</div>';
?>
