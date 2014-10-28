<?php
    while (have_posts()) : the_post();
?>
	<h1><?php the_title(); ?></h1>
	<p>Posted by <?php the_author(); ?> on <?php the_time('M d, Y'); ?></p>
<?php

	$video_host = get_post_meta( get_the_ID(), '_video_host', true );
	$video_id = get_post_meta( get_the_ID(), '_video_id', true );

	if ( function_exists( get_ssb() ) ) {
		get_ssb('twitter=1&fblike=2');
	}

	echo '<div id="video_wrapper">';

	embed_video();

	echo '</div>'; /* #video_wrapper */

endwhile; 
?>
