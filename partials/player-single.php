<?php if (have_posts()) : while (have_posts()) : the_post();

	$player_name = get_the_title();
	$player_slug = $post->post_name;
	$player_school = get_post_meta( get_the_ID(), '_school', true );
	$player_position = get_post_meta( get_the_ID(), '_position', true );
	$player_height = get_post_meta( get_the_ID(), '_height', true );
	$player_weight = get_post_meta( get_the_ID(), '_weight', true );
	$player_dash = get_post_meta( get_the_ID(), '_dash', true );
	if ( $player_dash == null ) {
		$player_dash = "---";
	}
	$player_draft_class = get_post_meta( get_the_ID(), '_draft_class', true );
	$player_school_class = get_post_meta( get_the_ID(), '_school_class', true );
	$player_jersey = get_post_meta( get_the_ID(), '_jersey', true );
	$player_allstar = get_post_meta( get_the_ID(), '_allstar', true);
	if ( $player_allstar == null ) {
		$player_allstar = "---";
	}
	$player_report = apply_filters( 'the_content', get_the_content( get_the_ID() ) );;
	$vid_num = get_post_meta( get_the_ID(), '_number_videos', true);
	$mockdraftable = get_post_meta( get_the_ID(), '_mockdraftable', true);


endwhile; endif; ?>

	<div class="row">
		<div class="col-sm-2 player-photo-col">
			<?php the_post_thumbnail('thumbnail', array('class' => 'player-thumb')); ?>
		</div>
		<div class="col-sm-10">
			<h1 class="player-title"><?php echo $player_name; ?></h1>
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
			<tr>
					<td class="criteria">All-Star</td>
					<td><?php echo $player_allstar; ?></td>
					<td class="criteria">40 Time</td>
					<td class="mockdraftable_popover_parent"><a id="mockdraftable_trigger" title="Click for in-depth measurables" href="#"><?php echo $player_dash; ?></a></td>
				</tr>
			</table>
				
			<div class="row player-tabs" style="text-align: center;">
  				<div class="col-xs-4" style="padding-top: 6px;" >
  					<a class="player-links" href="#player-report" data-target="#player-report" data-toggle="tab">Scouting Report</a>
  				</div>
  				<div class="col-xs-4" style="padding-top: 6px;" >
  					<a class="player-links" href="#player-vids" data-target="#player-vids" data-toggle="tab">Videos <span class="badge badge-danger"><?php echo $vid_num; ?></span></a>
  				</div>
  				<div class="col-xs-1" style="padding-left: 20px;">
	  				
  				</div>
  			</div>
		</div>
	</div>

	<hr>

	<div class="row">

		<div class="tab-content">

	   		<div class="tab-pane active" id="player-vids">
		   		<?php get_template_part('partials/player', 'videos'); ?>
			</div>

			<div class="tab-pane" id="player-report">

				<?php 

					if ( empty($player_report) ) {
						echo 'Coming soon!';
					}

					else {
						echo $player_report;
					}

				 ?>

			</div>

		</div>

		
	</div>
	<div id="mockdraftable_content" style="display: none;">
		<?php if ( $mockdraftable == null ) {
			echo "<p>Measurables coming soon!</p>";
		}
		else {
			echo '<iframe src="http://mockdraftable.com/player_embed/'.$mockdraftable.'/" width="500" height="620" frameborder="0" scrolling="no"></iframe>';
		}
		?>
	</div>