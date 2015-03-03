<?php
/**
 * page-embed-test.php
 *
 * @package Earl
 */

get_header(); ?>
	<div class="row">
		<div class="col-sm-8 main-col">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
					
					<h1><?php the_title(); ?></h1>
					
					<?php the_content(); ?>

					<?php $video_id = 'SmMZ6gJeoMI'; ?>
					<?php $video_permalink = "http://draftbreakdown.com/video/khalil-mack-vs-ohio-state-2013/"; ?>

					        
					        <!-- <iframe width="595" height="500" src="http://www.draftbreakdown.com/video-embed/?clip=245682&size=medium" frameborder="0" scrolling="no"></iframe> -->
					        <iframe width="700" height="550" src="http://www.draftbreakdown.com/gif-embed/?clip=251131&gif=QualifiedCharmingGoldenretriever" frameborder="0" scrolling="no"></iframe>
					        <br />
					        <br />
					        <br />
					        <button class="btn btn-danger" id="embed_generator">Share Video or Create GIF</button>
					        <div id="embed_container" style="display: none; width: 99%; border: 1px solid gray; padding: 5px; font-size: 12px; background-color: #FFFFFF;">
					        	<ul class="nav nav-tabs">
									<li class="active"><a href="#embed" data-toggle="tab">Embed Video</a></li>
									<li><a href="#gfy" data-toggle="tab">Create GIF&nbsp;&nbsp;<span class="label label-important">BETA</span></a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="embed">
										<div id="embed_times" class="container-fluid">
							        		<h5 style="color: #9B0214;">Embed Options</h5>
							        		<div class="row-fluid">
							        			<div class="span3" style="max-width: 120px;">
							        				<strong>Start:</strong> <input id="start_time" type="number" class="input-mini" type="text" placeholder="seconds" style="width: 70px;">
							        			</div>
							        			<div class="span3" style="max-width: 120px;">
							        				<strong>End:</strong> <input id="end_time" type="number" class="input-mini" type="text" placeholder="seconds" style="width: 70px;">
							        			</div>
							        			<div class="span4" style="max-width: 190px;">
							        				<strong>Video Size:</strong> <select id="video_size" style="width: 105px;">
																						<option value="xlarge">853 x 505</option>
																						<option value="large">640 x 385</option>
																						<option value="medium">560 x 340</option>
																						<option value="small" selected>416 x 265</option>
																					</select>
							        			</div>
							        			<div class="span2" style="max-width: 115px; padding-top: 2px; text-align: center;">
							        				<button id="add_options" class="btn btn-small btn-danger">Add Options</button>
							        			</div>
							        		</div>
							        		<span><em>Note: Embed frame is slightly larger than video player size</em></span>
							        		<hr>
							        		<div id="embed_code" class="row-fluid">
								        		<div class="span12">
									        		<h4>Copy and paste code to embed this video on your site</h4>
									        		<input type="hidden" id="video_id_code" name="video_id_code" value="<?php echo $video_id; ?>" />
									        		<pre>&lt;iframe width=&quot;450&quot; height=&quot;420&quot; src=&quot;http://www.draftbreakdown.com/video-embed/?clip=<?php echo $video_id; ?>&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot;&gt;&lt;&#47;iframe&gt;</pre>
									        		<h4>Link directly to this video</h4>
									        		<pre>http://www.draftbreakdown.com/video-embed/?clip=<?php echo $video_id; ?></pre>
									        	</div>
							        		</div>

							        	</div>
									</div>
									<div class="tab-pane" id="gfy">
										<div id="embed_times" class="container-fluid">
											<p>Create a GIF to highlight a specific play from within our videos. Then choose to embed the GIF on your website or link to the GIF directly! GIF creation is a Beta version and we're working to make this process as seamless as possible!</p>
							        		<h5 style="color: #9B0214;">GIF Options</h5>
							        		<div class="row-fluid">
							        			<div class="span3" style="max-width: 120px;">
							        				<strong>Start Minutes:</strong> <select id="start_min" style="width: 105px;">
																						<option value="0" selected>0</option>
																						<option value="1">1</option>
																						<option value="2">2</option>
																						<option value="3">3</option>
																						<option value="4">4</option>
																						<option value="5">5</option>
																						<option value="6">6</option>
																						<option value="7">7</option>
																						<option value="8">8</option>
																						<option value="9">9</option>
																						<option value="10">10</option>
																						<option value="11">11</option>
																						<option value="12">12</option>
																						<option value="13">13</option>
																						<option value="14">14</option>
																						<option value="15">15</option>
																					</select>
							        			</div>
							        			<div class="span3" style="max-width: 120px;">
							        				<strong>Start Seconds:</strong> <select id="start_sec" style="width: 105px;">
																						<option value="0" selected>0</option>
																						<?php
																							for ($i=1; $i <60; $i++) {
																								echo '<option value="'.$i.'">'.$i.'</option>';
																							}
																						?>
																					</select>
							        			</div>
							        			<div class="span3" style="max-width: 120px;">
							        				<strong>Length Seconds:</strong> <select id="gfy_length" style="width: 105px;">
																						<option value="1">1</option>
																						<option value="2">2</option>
																						<option value="3">3</option>
																						<option value="4" selected>4</option>
																						<option value="5">5</option>
																						<option value="6">6</option>
																						<option value="7">7</option>
																						<option value="8">8</option>
																						<option value="9">9</option>
																						<option value="10">10</option>
																						<option value="11">11</option>
																						<option value="12">12</option>
																						<option value="13">13</option>
																						<option value="14">14</option>
																						<option value="15">15</option>
																					</select>
							        			</div>
							        			<div class="span3" style="max-width: 115px; padding-top: 2px; text-align: center;">
							        				<button id="createGfyButton" class="btn btn-small btn-danger" onClick="gfyCreate()"><span id="createGfyText">Create GIF!</span><span id="loadingText" style="display: none;">Loading...</span><span id="getGfyCodeText" style="display: none;">Get GIF Code</span></button>
							        			</div>
							        		</div>
							        		<span id="loadingInfoText" style="display: none;"><em>Please wait while your GIF is created. It can take up to 1-2 minutes depending on requested length and server traffic.</em><br /></span>
							        		<span id="gfyNote"><em>Note: GIFs created via <a href="http://www.gfycat.com" target="_blank">Gfycat</a>. Max-length of each GIF is 15 seconds. Please wait at least 30 seconds between creating additional GIFs. <strong>The Create button will reappear once enough time has elapsed.</strong></em></span>
							        		<hr>
							        		<div id="gfy_code" class="row-fluid">
								        		<div class="span12">
								        			<h4 id="embed_gif_title" style="display: none;">Embed GIF</h4>
									        		<pre id="gfy_json" style="display: none;"></pre>
									        		<h4 id="link_gif_title" style="display: none;">Direct Link</h4>
									        		<pre id="gfy_direct_link" style="display: none;"></pre>
									        		<div id="gfy_preview" style="text-align: center;"></div>
									        		<h4 id="processing_title" style="display: none;">Processing...</h4>
									        		<pre id="processing_message" style="display: none;"></pre>
									        	</div>
							        		</div>

							        	</div>
									</div>
								</div>
					        	

					        </div>
						
					<?php endwhile; else: ?>
						
						<p>Sorry, no posts matched your criteria.</p>
						
				<?php endif; ?>
			<div class="col-sm-12 visible-sm visible-md visible-lg ad ad-lh">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- Horizontal leaderboard -->
				<ins class="adsbygoogle"
				     style="display:inline-block;width:728px;height:90px"
				     data-ad-client="ca-pub-7021861911581046"
				     data-ad-slot="9568559232"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			
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

		<div class="col-sm-4 sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>

	<script type="text/javascript">

	jQuery(window).load(function() {
		
		jQuery('#embed_generator').click(function() {

			jQuery('#embed_generator').hide();
			
			jQuery('#embed_container').show();


		});
		function onlyNumbers(evt) {
		    var arrayExceptions = [8, 9];
		    if ((evt.keyCode < 48 || evt.keyCode > 57) &&
		            (evt.keyCode < 96 || evt.keyCode > 106) && // NUMPAD
		            jQuery.inArray(evt.keyCode, arrayExceptions) === -1) {
		        return false;
		    }
		}

		jQuery('#start_time').on('keydown', onlyNumbers);
		jQuery('#end_time').on('keydown', onlyNumbers);
		jQuery('#link_start_time').on('keydown', onlyNumbers);
		jQuery('#link_end_time').on('keydown', onlyNumbers);

		jQuery('#add_options').click(function() {

			
			var embed_code = jQuery('#embed_code pre').html();
			var video_id_code = jQuery('#video_id_code').val();

			var start_time = jQuery('#start_time').val();
			var end_time = jQuery('#end_time').val();
			var vid_size = jQuery('#video_size').val();

			var start_string = '';
			var end_string = '';
			var frame_width = 450;
			var frame_height = 420;
			var size_string = '';

			if ( start_time != "" ) {

				var start_string = "&start=" + start_time;
  	
			}

			if ( end_time != "" ) {

				var end_string = "&end=" + end_time;
				
			}

			if ( vid_size != null ) {

				switch( vid_size ) {

					case 'xlarge':
						frame_width = 888;
						frame_height = 665;
						size_string = "&size=xlarge";
						break;

					case 'large':
						frame_width = 675;
						frame_height = 550;
						size_string = "&size=large";
						break;

					case 'medium':
						frame_width = 595;
						frame_height = 500;
						size_string = "&size=medium";
						break;

					case 'small':
						frame_width = 450;
						frame_height = 420;
						size_string = "";
						break;

					default:
						frame_width = 450;
						frame_height = 420;
						size_string = "";
						break;

				}

			}

			embed_code = "&lt;iframe width=&quot;" + frame_width + "&quot; height=&quot;" + frame_height + "&quot; src=&quot;http://www.draftbreakdown.com/video-embed/?clip=<?php echo $video_id; ?>" + start_string + end_string + size_string + "&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot;&gt;&lt;&#47;iframe&gt;";

			jQuery('#embed_code pre').html(embed_code);

		});

		jQuery('#add_link_options').click(function() {

			
			var link_code = jQuery('#link_code pre').html();
			var video_permalink = jQuery('#video_permalink').val();
			
			var link_start_time = jQuery('#link_start_time').val();
			var link_end_time = jQuery('#link_end_time').val();
			
			var link_start_string = '';
			var link_end_string = '';
			var autoplay_string = '';

			if ( link_start_time != "" ) {

				var link_start_string = "&start=" + link_start_time;
  	
			}

			if ( link_end_time != "" ) {

				var link_end_string = "&end=" + link_end_time;
				
			}

			if ( jQuery('#autoplay').is(':checked') ) {
				var autoplay_string = "&autoplay=1";
			}

			link_code = video_permalink + "?" + link_start_string + link_end_string + autoplay_string;

			jQuery('#link_code pre').html(link_code);

		});

	});

	var gfyCreate = function() {

		var fetchMin = jQuery('#start_min').val();
		var fetchSec = jQuery('#start_sec').val();
		var fetchLength = jQuery('#gfy_length').val();
		var youTubeVidId = jQuery('#video_id_code').val();
		var vidClip = '245682';
		var gfyNameString = null;
		var fetchResult = null;


		jQuery('#createGfyText').hide();
		jQuery('#getGfyCodeText').hide();
		jQuery('#loadingText').show();
		jQuery('#loadingInfoText').show();
		jQuery('#gfyNote').hide();
		jQuery('#createGfyButton').css('opacity','0.6');

		jQuery.ajax({
			type: 'GET',
			url: 'http://www.draftbreakdown.com/wp-content/themes/DB-Delta/gfyFetch.php',
			data: "youTubeId="+youTubeVidId+"&gfyMin="+fetchMin+"&gfySec="+fetchSec+"&gfyLength="+fetchLength+"&clip="+vidClip,
			success: function(fetchResult) {

				if ( fetchResult == "encoding" ) {
					jQuery('#processing_message').show();
					jQuery('#processing_title').show();
					jQuery('#processing_message').html('Your request is still processing due to file size or server traffic. Click the "Get GIF code" button when available to finish.');
					jQuery('#loadingText').hide();
					jQuery('#gfy_direct_link').html('');
					jQuery('#gfy_direct_link').hide();
					jQuery('#gfy_preview').html('');
					jQuery('#link_gif_title').hide();
					jQuery('#embed_gif_title').hide();
					jQuery('#gfy_json').hide();
					getGifCode();

					//jQuery('#createGfyButton').hide();
					// jQuery('#createGfyText').show();
					// jQuery('#createGfyButton').css('opacity','1');
					// setTimeout( "jQuery('#createGfyButton').show();",15000 );
					//getGfyStatus();
				}

				else {
					jQuery('#gfy_json').show();
				  	jQuery('#gfy_json').html('&lt;iframe width=&quot;675&quot; height=&quot;550&quot; src=&quot;http://www.draftbreakdown.com/gif-embed/?clip='+vidClip+'&gif='+fetchResult+'&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot;&gt;&lt;&#47;iframe&gt');	

				  	gfyDisplay(fetchResult, vidClip);
				}
				
			},
			error: function() {
				alert('fetch failed');
			}
		});
		
	};

var gfyDisplay = function(gfyName, vidClip) {

	var vidClip = '245682';

	jQuery('#gfy_preview').html('<iframe src="http://gfycat.com/'+gfyName+'" frameborder="0" scrolling="no" width="600" height="338"></iframe>');
	jQuery('#loadingText').hide();
	jQuery('#loadingInfoText').hide();
	jQuery('#getGfyCodeText').hide();
	jQuery('#createGfyText').show();
	jQuery('#gfyNote').show();
	jQuery('#createGfyButton').css('opacity','1');
	jQuery('#createGfyButton').hide();
	setTimeout( "jQuery('#createGfyButton').show();",30000 );
	jQuery('#embed_gif_title').show();
	jQuery('#link_gif_title').show();
	jQuery('#gfy_direct_link').show();
	jQuery('#gfy_direct_link').html('http://www.draftbreakdown.com/gif-embed/?clip='+vidClip+'&gif='+gfyName);
	jQuery('#processing_title').hide();
	jQuery('#processing_message').hide();
};

var getGifCode = function() {
	jQuery('#createGfyButton').hide();
	jQuery('#createGfyText').hide();
	jQuery('#getGfyCodeText').show();
	jQuery('#createGfyButton').css('opacity','1');
	setTimeout( "jQuery('#createGfyButton').show();",30000 );
}

// var getGfyStatus = function(gfyName) {
// 	jQuery.ajax({
// 		type: 'GET',
// 		url: 'http://www.draftbreakdown.com/wp-content/themes/DB-Delta/gfyStatus.php',
// 		data: "gfyName="+gfyName,
// 		success: function(statusResult) {
// 			jQuery('#processing_message').show();
// 			jQuery('#processing_title').show();
// 			jQuery('#processing_message').html(statusResult);
// 		},
// 		error: function() {
// 			alert('status failed');
// 		}
// 	});
// }

	

</script>

<?php get_footer(); ?>