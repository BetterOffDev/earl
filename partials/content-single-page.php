<?php
	while (have_posts()) : the_post(); ?>
 	
 	
	<?php 
		$class = get_body_class();
		if ( !in_array('buddypress', $class) ) {
			if ( !is_page(253655) ) {
				echo '<h1>'.get_the_title().'</h1>';
			}
		} 
	
 		the_content(); 
 	?>
 	

<?php 	
	endwhile;
?>
