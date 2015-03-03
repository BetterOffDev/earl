<?php 

global $query_string;

$s = $_GET['s'];

query_posts( $query_string .'&post_type=player&name='.$s );

while (have_posts()) : the_post(); 

$player_name = get_the_title();
$player_slug = $post->post_name;
$player_school = get_post_meta( get_the_ID(), '_school', true );
$player_position = get_post_meta( get_the_ID(), '_position', true );
$player_height = get_post_meta( get_the_ID(), '_height', true );
$player_weight = get_post_meta( get_the_ID(), '_weight', true );
$player_dash = get_post_meta( get_the_ID(), '_dash', true );
$player_draft_class = get_post_meta( get_the_ID(), '_draft_class', true );
$player_school_class = get_post_meta( get_the_ID(), '_school_class', true );
$player_jersey = get_post_meta( get_the_ID(), '_jersey', true );
$player_report = get_the_content( get_the_ID() );
$vid_num = get_post_meta( get_the_ID(), '_number_videos', true);

?>

<div class="post">
	<div class="row">
			<div class="col-sm-2 player-photo-col">
				<?php the_post_thumbnail('thumbnail', array('class' => 'player-thumb')); ?>
			</div>
			<div class="col-sm-10">
				<h1 class="player-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
				<table class="table table-condensed table-bordered player-stats">
					<tr>
						<td class="criteria">Position</td>
						<td><?php echo $player_position; ?></td>
						<td class="criteria">School</td>
						<td><?php echo $player_school; ?></td>
					</tr>
					<tr>
						<td class="criteria">Height</td>
						<td><?php display_player_height(); ?></td>
						<td class="criteria">Weight</td>
						<td><?php if ( get_post_meta( get_the_ID(), '_weight', true ) != '' ) { player_weight(); ?> lbs<?php } else { echo '--'; } ?></td>
					</tr>
					<tr>
						<td class="criteria">Class</td>
						<td><?php echo $player_school_class; ?></td>
						<td class="criteria">Number</td>
						<td><?php echo get_post_meta( $post->ID, '_jersey', true ); ?></td>
					</tr>
				</table>
				<div class="row" style="text-align: center;">
  				<div class="col-sm-4">
  					<a class="player-links" href="<?php the_permalink() ?>#player-report">Scouting Report</a>
  				</div>
  				<div class="col-sm-4">
  					<a class="player-links" href="<?php the_permalink() ?>#player-vids">Videos <span class="badge badge-important"><?php echo $vid_num; ?></span></a>
  				</div>
  			</div>
			</div>
		</div>
</div>			
	
	

<?php endwhile; ?>

<?php

wp_reset_query();

$s = $_GET['s'];

$args = array('posts_per_page' => 10,
				's' => $s,
				'post_type' => array('post', 'video'),
				'paged' => get_query_var('paged') );

$regular = new WP_Query($args);

if ($regular->have_posts()) : while ($regular->have_posts()) : $regular->the_post(); ?>

<div class="post">
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
	<small><p>By <?php the_author(); ?> on <?php the_time('F j, Y') ?></p></small>
	<div class="post-thumbnail">
		<?php 

			if ( has_post_thumbnail() ) { 
				the_post_thumbnail(array(295,188)); 
			}

			elseif ( !has_post_thumbnail() && get_post_type() == 'video' ) {
				
				$img_src = get_video_thumb( 'small' );

				 ?><div class="featured-vid-wrapper">
				 	<a href="<?php the_permalink(); ?>">
				 		<img class="video-search-thumb" src="<?php echo $img_src; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
				 	</a>
				 	</div>
				 <?php 
			}

			else {

				?><a href="<?php the_permalink(); ?>"><img class="video-search-thumb" src="<?php bloginfo('stylesheet_directory'); ?>/img/default_thumb.png" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a> <?php
			}


		?>
	</div>
	<div class="entry">
			<?php the_excerpt(); ?>
	</div>
</div>			
<hr>
	

	<?php endwhile; endif; ?>