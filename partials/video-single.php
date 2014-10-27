<?php
    while (have_posts()) : the_post();

	$video_host = get_post_meta( get_the_ID(), '_video_host', true );
	$video_id = get_post_meta( get_the_ID(), '_video_id', true );

	echo '<div id="video_wrapper">';

	switch ($video_host) {

		case "youtube":
			?>
			<iframe title="YouTube video player" src="http://www.youtube.com/embed/<?php echo $video_id; ?>?rel=0&modestbranding=0&showinfo=0&origin=draftbreakdown.com<?php echo $video_start; ?><?php echo $video_end; ?><?php echo $video_autoplay; ?>" frameborder="0" allowfullscreen="1"></iframe>
			<?php
			break;

		case "vimeo":
			embed_vimeo_video($video_id);
			break;

		case "dailymotion":
			embed_dailymotion_video($video_id);
			break;
		}

	echo '</div>'; /* #video_wrapper */

endwhile; 
?>
