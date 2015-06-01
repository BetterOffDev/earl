<div id="item-header-avatar">

	<?php 
		$current_user = wp_get_current_user();
		if ( is_user_logged_in() && $current_user->ID == bp_displayed_user_id() ) {

			if ( get_the_author_meta('twitter', bp_displayed_user_id() ) == "" ) {
				echo '<div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>Don\'t forget to add your Twitter profile in the member settings!
                    </div>';
			}

			if ( get_the_author_meta('description', bp_displayed_user_id() ) == "" ) {
				echo '<div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>Don\'t forget to add your bio in the member settings!
                    </div>';
			}
		?>
		<div class="btn-group" style="float: right;">
	  		<button class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#">Tools&nbsp;<span class="caret"></span></button>
	  		<ul class="dropdown-menu" style="margin-left: -92px; text-align: left;">
	    		<li><a href="<?php bloginfo('url'); ?>/article-editor">Add New Article</a></li>
	    		<li><a href="<?php bloginfo('url'); ?>/mockdraft-editor">Add New Mock Draft</a></li>
	    		<li><a href="<?php bloginfo('url'); ?>/member-settings/?username=<?php echo $current_user->user_login; ?>">Member Settings</a></li>
	  		</ul>
		</div>
		<?php 
	} ?>
	
	
	<?php 

		$twitter_img_url = get_twitter_avatar( get_the_author_meta('twitter', bp_displayed_user_id()) );

	?>
	<?php if ( is_user_logged_in() && $current_user->ID == bp_displayed_user_id() ) {
			?>
			<div class="member-avatar-wrapper">
				<img class="thumbnail" style="height: 150px;" src="<?php echo $twitter_img_url;?>" />
			</div>
			<?php 
		}
		else {
			?>
			<div class="member-avatar-wrapper">
				<img class="thumbnail" style="height: 150px;" src="<?php echo $twitter_img_url;?>" />
			</div>
			<?php
		}
		?>
	
	
	<h2><?php bp_displayed_user_fullname(); ?></h2>

	<p class="member-bio"><?php the_author_meta('description', bp_displayed_user_id() ); ?></p>

	<p>
		<?php if ( get_the_author_meta( 'twitter', bp_displayed_user_id() ) ) {
			?>
			<a href="https://twitter.com/<?php the_author_meta('twitter', bp_displayed_user_id() ); ?>" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @<?php the_author_meta('twitter', bp_displayed_user_id() ); ?></a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
		<?php } ?>
		<?php if (get_the_author_meta('facebook', bp_displayed_user_id() ) ) {
			?>
			<a class="btn btn-default btn-sm" style="color: #395497;" href="<?php echo get_the_author_meta('facebook', bp_displayed_user_id() );?>" target="_blank">
				<i class="fa fa-facebook" style="font-size: 14px;"></i>&nbsp;&nbsp;Facebook
			</a>
			<?php
		} ?>
		<?php if (get_the_author_meta('youtube', bp_displayed_user_id() ) ) {
			?>
			<a class="btn btn-default btn-sm" href="<?php echo get_the_author_meta('youtube', bp_displayed_user_id() );?>" target="_blank">
				<i class="fa fa-youtube" style="font-size: 14px; color: #c82020;"></i>&nbsp;&nbsp;YouTube
			</a>
			<?php
		} ?>
		<?php if (get_the_author_meta('user_url', bp_displayed_user_id() ) ) {
			?>
			<a class="btn btn-default btn-sm" href="<?php echo get_the_author_meta('user_url', bp_displayed_user_id() );?>" target="_blank">
				Website
			</a>
			<?php
		} ?>
	</p>

	

	
		<div class="col-md-12" style="background-color: white; border: 1px solid #000; padding: 10px;">
			<?php 
				$author_data = get_userdata( bp_displayed_user_id() );
				$author_role = implode(', ', $author_data->roles);
				if ( $author_role != 'member' ) {
					$show_video_tab = true;
				}
				else {
					$show_video_tab = false;
				}
			?>

			<ul class="nav nav-tabs" id="myTab">
		  		<li class="active"><a href="#articles" data-target="#articles" data-toggle="tab">Articles</a></li>
		  		<li><a href="#mockdrafts" data-target="#mockdrafts" data-toggle="tab">Mock Drafts</a></li>
		  		<li><a href="#snotes" data-target="#snotes" data-toggle="tab">Scouting Notes</a></li>
		  		<?php 
		  			if ( $show_video_tab ) {
		  				?>
		  				<li><a href="#videos" data-target="#videos" data-toggle="tab">Videos</a></li>
		  				<?php
		  			}
		  		?>
			</ul>
		 
			<div class="tab-content">
				<?php 
					
					if ( $show_video_tab ) {
						?>
						<div class="tab-pane" id="videos">
				  			<h4>Videos</h4>
							<hr>
							<?php 
								
								$args = array(
											'post_type' => 'video',
											'posts_per_page' => 12,
											'author' => bp_displayed_user_id()
										);
								$videos = new WP_Query($args);

								$i = 0;
    							echo '<div class="row">';

								if ( $videos->have_posts() ) : while ( $videos->have_posts() ) : $videos->the_post(); 

								$player_id = get_post_meta( get_the_ID(), '_video_prospect', true);
								$related_video_id = get_post_meta( get_the_ID(), '_video_id', true);
								?>

								<div class="col-xs-6 col-md-2">
									<a class="video-thumb-container" href="<?php the_permalink(); ?>">
										<?php 
										$img_src = get_video_thumb( 'medium' ); ?>
										<img src="<?php echo $img_src; ?>" class="img-responsive" />
										<h4 class="video-thumb-title"><?php the_title(); ?> <?php if ( strtotime($post->post_date) > strtotime('-7 days')) { echo '&nbsp;&nbsp;<span class="badge badge-danger badge-small">New!</span>'; } ?></h4>

									</a>
								</div>
								<?php
									$i++;
									if ( $i == 6 ) {
										echo '</div><div class="row">';
										$i = 0;
									}
								?>

						    	<?php

								endwhile; ?>

								<br />
								<a href="<?php bloginfo('url'); ?>/video/?member=<?php echo get_the_author_meta('nicename', bp_displayed_user_id() ) ?>">>> See All Videos</a>

								<?php else : ?>
								<p><?php bp_displayed_user_fullname(); ?> has no videos at this time.<p>
								<?php

								endif;
								echo '</div>';
								wp_reset_query();
							?>
							
				  		</div>
				  		<?php
					}
				?>
		  		<div class="tab-pane active" id="articles">
		  			<h4>Articles</h4>
					<hr>
					<?php 

						$author_name = get_the_author_meta('user_nicename', bp_displayed_user_id() );
						
						$article_args = array(
									'post_type' => array('post', 'memberarticles'),
									'author_name' => $author_name,
									'cat' => 6,
									'category__not_in' => 21,
									'posts_per_page' => 10,
								);
						$articles = new WP_Query($article_args);

						if ( $articles->have_posts() ) : while ( $articles->have_posts() ) : $articles->the_post(); 

						echo '<div class="member-post-listing">';
						echo '<p class="member-post-listing-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
						echo '<p class="member-post-listing-date">'.get_the_date().'</p>';
						echo '</div>';

						endwhile; ?>

						<br />
						<a href="<?php bloginfo('url'); ?>/memberarticles/?member=<?php echo get_the_author_meta('nicename', bp_displayed_user_id() ) ?>">>> See All Articles</a>

						<?php else : ?>
						<p><?php bp_displayed_user_fullname(); ?> has no articles at this time.<p>
						<?php

						endif;


					?>
					
		  		</div>
		  		<div class="tab-pane" id="mockdrafts">
		  			<h4>Mock Drafts</h4>
					<hr>
					<?php 

						$author_name = get_the_author_meta('user_nicename', bp_displayed_user_id() );

						$mock_args = array(
									'post_type' => array( 'post', 'mockdrafts' ),
									'author_name' => $author_name,
		     						'cat' => 21,
									'posts_per_page' => 10,
								);
						$mocks = new WP_Query($mock_args);

						if ( $mocks->have_posts() ) : while ( $mocks->have_posts() ) : $mocks->the_post(); 
					
							if ( get_post_type() == 'post' && !in_category(21) ) {
								continue;
							} 

						echo '<div class="member-post-listing">';
						echo '<p class="member-post-listing-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
						echo '<p class="member-post-listing-date">'.get_the_date().'</p>';
						echo '</div>';

						endwhile; ?>

						<br />
						<a href="<?php bloginfo('url'); ?>/mockdrafts/?member=<?php echo get_the_author_meta('nicename', bp_displayed_user_id() ) ?>">>> See All Mock Drafts</a>

						<?php else : ?>
						<p><?php bp_displayed_user_fullname(); ?> has no mock drafts at this time.<p>
						<?php

						endif;

						wp_reset_query();
					?>
					

		  		</div>
		  		<div class="tab-pane" id="snotes">
		  			<h4>Scouting Notes</h4>
					<hr>
					<?php 

						$author_name = get_the_author_meta('user_nicename', bp_displayed_user_id() );

						$current_user = wp_get_current_user();

						$current_user2 = get_userdata( $current_user->ID );

						$current_user_nicename = $current_user2->user_nicename;

						if ( $current_user_nicename == $author_name ) {
							
							$notes_args = array(
								'post_type' => 'scoutingnotes',
								'author_name' => $author_name,
								'posts_per_page' => 10,
							);

						}

						else {
							
							$notes_args = array(
								'post_type' => 'scoutingnotes',
								'author_name' => $author_name,
								'posts_per_page' => 10,
								'meta_query' => array( 
						     		array( 'key' => '_private_note', 'value' => 'checked', 'compare' => 'NOT LIKE' ) 
						     	)
							);

						}

						
						$notes = new WP_Query($notes_args);

						if ( $notes->have_posts() ) : while ( $notes->have_posts() ) : $notes->the_post(); 

						echo '<div class="member-post-listing">';
						echo '<p class="member-post-listing-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></p>';
						echo '<p class="member-post-listing-date">'.get_the_date().'</p>';
						echo '</div>';

						endwhile; ?>
						<br />
						<a href="<?php bloginfo('url'); ?>/scoutingnotes/?member=<?php echo $author_name; ?>">>> See All Scouting Notes</a>

						<?php else : ?>
						<p><?php bp_displayed_user_fullname(); ?> has no scouting notes at this time.<p>
						<?php

						endif;

						wp_reset_query();
					?>
					

		  		</div>
			</div>
		</div>
	
 
</div><!--#item-header-avatar-->		


