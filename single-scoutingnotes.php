<?php
/**
 * single-scoutingnotes.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<?php $categories = get_the_category(); ?>
				    <ul class="breadcrumb">
					    <li><a href="<?php bloginfo('url'); ?>">Home</a>&nbsp;<span class="divider"><i class="fa fa-double-angle-right"></i></span></li>
					    <li>Scouting Notes</li>
				    </ul>

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<?php
                  $author_id = get_the_author_meta('ID');
                  $video_id = get_post_meta( get_the_ID(), '_notes_video', true);
                  $video_host = get_post_meta($video_id, '_video_host', true);
                  $edit_link = add_query_arg('post', get_the_ID(), get_permalink( 251970 + $_POST['_wp_http_referer']));
               ?>

					<h1><?php the_title(); ?></h1>
					<div class="row author-share-row">
						<div class="col-md-6">
							<p class="written-by">Written by <?php the_author(); ?> on <?php the_time('F j, Y') ?><?php if ($post->post_author == $current_user->ID) { echo '&nbsp;&nbsp;<a href="' . $edit_link . '" class="newPopUp">(Edit)</a>'; } ?></p>
						</div>
						<div class="col-md-6 share-buttons">

							<?php 
								if ( function_exists( get_ssb() ) ) {
									get_ssb('twitter=1&fblike=2');
								}
							 ?>

						</div>
					</div>
					<hr>
					<div class="row">
                  		<div class="scoutnotes-content col-sm-12">
                     		<h3><a href="<?php echo get_permalink($video_id); ?>"><?php echo  get_the_title($video_id); ?></a></h3>
                     		<div id="video_wrapper">
                     			<?php embed_video($video_id); ?>
                     		</div>
                     		<div class="scouting-notes-content">
                     			<h4>Notes</h4>
                     			<?php the_content(); ?>
                     		</div>
                  		</div>
               		</div>
               		<div class="scoutnotes-comments">
                  		<?php comments_template( '/notes-comments.php', true ); ?>
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

			
				<div class="row" style="text-align: center;">
					<div class="col-sm-12 visible-xs ad ad-sq">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
							<!-- Mobile 300x250 -->
							<ins class="adsbygoogle"
						     style="display:inline-block;width:300px;height:250px"
						     data-ad-client="ca-pub-7021861911581046"
						     data-ad-slot="1528285636"></ins>
						<script>
							(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
					</div>
				</div>
			
				<?php get_template_part('partials/author', 'box'); ?>
			</div>

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>


<?php get_footer(); ?>