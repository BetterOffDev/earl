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

	// needed global variables

	global $draft_class;
	global $position;
	
	$args = array(	'post_type' => 'player',
					'posts_per_archive_page' => -1,
					'meta_query' => array(
										array('key' => '_draft_class',
												'value' => $draft_class,
												'compare' => '='),
									),
					'meta_key' => '_number_videos',
					'orderby' => 'meta_value_num',
					'order' => 'DESC');

	$i = 0;


	$players = new WP_Query($args);

	if ($players->have_posts()) : while ($players->have_posts()) : $players->the_post(); 


		if ( isset( $_GET['position'] ) && $position != 'ALL' ) {

			if ( get_post_meta( get_the_ID(), '_position', true ) != $position ) {
				continue;
			}

		}

		$striped = 'class="bg-danger"';

		if ( $i % 2 == 0 ) {
			$striped = '';
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
		
		<?php $i++ ?>

	<?php endwhile; endif; ?>

	</tbody>
</table>