<?php
/**
 * page-all-star-rosters.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			
			<div class="row" style="padding-top: 10px;">
				<div class="col-sm-6">
					<h1 style="font-size: 24px; line-height: 16px;">2015 <?php echo $allstar; ?> Players</h1>
				</div>
				<div class="col-sm-6" style="text-align: right;">
					
					<form id="class_form" action="/all-star-rosters/" method="GET">

						<select id="class_select" name="allstar" style="margin-top: 5px; width: 200px; float: right;">
							<option value="Senior Bowl"<?php if ($allstar == 'Senior Bowl') echo "selected='selected'"; ?>>Senior Bowl</option>
							<option value="Shrine Game"<?php if ($allstar == 'Shrine Game') echo "selected='selected'"; ?>>Shrine Game</option>
							<option value="NFLPA Game"<?php if ($allstar == 'NFLPA Game') echo "selected='selected'"; ?>>NFLPA Game</option>
							<option value="Medal of Honor Bowl"<?php if ($allstar == 'Medal of Honor Bowl') echo "selected='selected'"; ?>>Medal of Honor Bowl</option>
						</select>
						<span style="margin-right: 10px; margin-top: 10px; float: right;">Game: </span>
					</form>
				</div>
			</div>
			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th class="criteria">Player</th>
							<th class="criteria">Position</th>
							<th class="criteria">School</th>
							<th class="criteria">Class</th>
							<th class="criteria" style="text-align: center;">Videos</th>
						</tr>
					</thead>
					<tbody>

			<?php 
				
				$i = 0;

				$all_star = new WP_Query(array('post_type' => 'player',
												'meta_query' => array(
																		array(
																			'key' => '_allstar',
																			'value' => $allstar,
																			'compare' => 'LIKE',
																			)
															),
												'meta_key' => '_number_videos',
												'orderby' => 'meta_value_num',
												'posts_per_page' => -1,
												) );
				if ($all_star->have_posts()) : while ($all_star->have_posts()) : $all_star->the_post();

				$striped = 'class="danger"';

						if ( $i % 2 == 0 ) {
							$striped = '';
						}

						if ( get_post_meta( get_the_ID(), '_draft_class', true ) != 2015 ) {
								continue;
							}


					?>
					
						<tr <?php echo $striped; ?>>
							<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
							<td><?php echo get_post_meta( get_the_ID(), '_position', true); ?></td>
							<td><?php echo get_post_meta( get_the_ID(), '_school', true); ?></td>
							<td><?php echo get_post_meta( get_the_ID(), '_school_class', true); ?></td>
							<td style="text-align:center;"><a href="<?php the_permalink(); ?>"><?php 
								if ( get_post_meta( get_the_ID(), '_number_videos', true ) == 0 ) {
									echo '';
								}

								else {
									echo get_post_meta( get_the_ID(), '_number_videos', true);
								}

								?>
								</a></td>
						</tr>
						
						<?php $i++; 

				endwhile; endif;
			?>
					</tbody>
				</table>
		</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>