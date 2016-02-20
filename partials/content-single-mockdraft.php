<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	

	<?php 
		$current_user = wp_get_current_user();

        if ( $current_user->ID == get_the_author_meta('ID') ) {
            $edit = true;
        }
	?>

	<?php $author_id = get_the_author_meta('ID'); ?>


	<h1><?php the_title(); ?><?php if ($edit) { echo '&nbsp;&nbsp;<a href="'.get_bloginfo('url').'/mockdraft-editor/?post='.get_the_ID().'"><i class="fa fa-edit" style="font-size: 20px;" title="Edit"></i></a>'; } ?></h1>
	<div class="row-fluid author-share-row">
		<div class="span6">
			<p class="written-by">Written by <?php the_author(); ?> on <?php the_time('F j, Y') ?> </p>
		</div>
		<div class="span6 share-buttons">
			
			<?php 
				
				if ( function_exists( get_ssb() ) ) {
					get_ssb('twitter=1&fblike=2');
				}
			?>
			
		</div>
	</div>
	<hr>

	<?php the_content(); ?>

	<?php
		$mock = get_post_meta(get_the_ID(), '_mock', true);

	?>
	<table class="table table-striped table-bordered mockdraft">
		<thead class="mock-head">
			<tr>
				<th colspan="3">
					<div>
						<div></div>
						<div style="font-size: 20px;">
							<?php the_title(); ?>
						</div>
					</div>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if ($mock) {
					foreach ( $mock as $round ) {
						$i = 1;
						if ($round) {
							foreach ( $round as $selection ) {
								// skip pick 32 temporarily
								if ($i == 32) {
									continue;
								}
								echo '<tr><td class="mock-number" width="60px">';
								echo $i;
								echo '</td><td class="mock-team" width="60px">';
								echo '<img src="'.get_team_logo($selection['team']).'" height="45px" width="45px" />';
								echo '</td><td class="mock-pick">';
								echo '<a style="font-weight: bold;" href="'.get_permalink( $selection['player'] ).'">'.get_the_title( $selection['player'] ).'</a> - '.get_post_meta( $selection['player'], '_position', true ).' - '.get_post_meta( $selection['player'], '_school', true );
								echo '<div style="font-size: 14px;">';
								if ( get_latest_player_video($selection['player']) ) {
									echo '<a href="https://www.youtube.com/watch?v='.get_latest_player_video($selection['player']).'" rel="wp-video-lightbox">Latest Video</a>&nbsp;&nbsp;&nbsp;';
								}
								if ( $selection['analysis'] != '' ) {
									echo '<a class="show-analysis">&nbsp;Show Pick Analysis</a>';
									echo '<a class="hide-analysis" style="display: none;">&nbsp;Hide Analysis</a>';
									echo '<br />';
									echo '<p class="analysis" style="font-size: 15px; line-height: 1.3; display: none;">'.$selection['analysis'].'</p>';
								}
								if ( $selection['analysis'] == '' || !isset($selection['analysis']) ) {
									echo '<a href="'.get_permalink($selection['player']).'">Player Page</a>';
								}
								echo '</div>';
								echo '</td></tr>';
								$i++;
							}
						}
					}
				}

			?>

		</tbody>
	</table>

	<div class="scoutnotes-comments">
  		<?php comments_template( '/mockdraft-comments.php', true ); ?>
		</div><!-- .scoutnotes-comments -->
		<?php if ('open' == $post->comment_status) : ?>
  		<?php comment_form( array (
     		'title_reply'  => __( 'Add Your Comment/Reply' ),
     		// remove "Text or HTML to be displayed after the set of comment fields"
     		'comment_notes_after' => '',
  		) ); ?>
		
	<?php endif; endwhile; else: ?>
		
		<p>Sorry, no posts matched your criteria.</p>
		
<?php endif; ?>