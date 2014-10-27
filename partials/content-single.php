<?php
	while (have_posts()) : the_post();
 	
 	echo '<p>'.the_content().'</p>';

 	endwhile;
?>
