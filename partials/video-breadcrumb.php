<?php 
	$video_prospect_id = get_post_meta( $post->ID, '_video_prospect', true);

	$args = array('post_type' => 'player',
					'p' => $video_prospect_id );

	$player = new WP_Query($args);

	if ($player->have_posts()) : while ($player->have_posts()) : $player->the_post();

	$player_draft_class = get_post_meta( get_the_ID(), '_draft_class', true );
	$player_position = get_post_meta( get_the_ID(), '_position', true );
	$player_name = get_the_title();
	$player_slug = $post->post_name;
	

	endwhile; endif;
	wp_reset_postdata();

?>

<ul class="breadcrumb">
    <li><a href="<?php bloginfo('url'); ?>/players">Players</a>&nbsp;</li>
    <li><a href="<?php bloginfo('url'); ?>/players?draft_class=<?php echo $player_draft_class; ?>"><?php echo $player_draft_class; ?></a>&nbsp;</li>
    <li><a href="<?php bloginfo('url'); ?>/players/?position=<?php echo $player_position; ?>"><?php echo $player_position; ?></a>&nbsp;</li>
    <li><a href="<?php bloginfo('url'); ?>/players/<?php echo $player_slug; ?>"><?php echo $player_name; ?></a></li>
</ul>