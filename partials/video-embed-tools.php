<?php

	if ( isset($_GET['start']) ) {
		$video_start = $_GET['start'];
		$video_start = "&start=".$video_start;
	}

	else {
		$video_start = "";
	}

	if ( isset($_GET['end']) ) {
		$video_end = $_GET['end']; 
		$video_end = "&end=".$video_end;
	}

	else {
		$video_end = "";
	}
	
	if ( isset($_GET['autoplay']) ) {
		$video_autoplay = $_GET['autoplay'];
		$video_autoplay = "&autoplay=".$video_autoplay;
	}

	else {
		$video_autoplay = "";
	}
	
	// if ( $video_start != null && isset($_GET['start']) ) {
    //     $video_start = "&start=".$video_start;
    // }

    // if ( $video_end != null && isset($_GET['end']) ) {
    //     $video_end = "&end=".$video_end;
    // }

    // if ( $video_autoplay != null && isset($_GET['autoplay']) ) {
    // 	$video_autoplay = "&autoplay=".$video_autoplay;
    // }


	$original_id = get_the_ID();
	//$author_id = get_the_author_meta('ID'); 
	$author_id = $post->post_author;
	$video_id = get_post_meta( $post->ID, '_video_id', true);
	$video_prospect_id = get_post_meta( $post->ID, '_video_prospect', true);
	$opponent = get_post_meta( get_the_ID(), '_video_opponent', true);
	$vid_year = get_post_meta( get_the_ID(), '_video_year', true);
	$created_date = get_the_date('F j, Y');
	$video_host = get_post_meta( get_the_ID(), '_video_host', true);

	if ( $video_host == 'youtube' ) {
		$options = true;
	}
	else {
		$options = false;
	}
?>
<div style="row">
	<!-- <button class="btn btn-danger" id="embed_generator">Share Video or Create GIF</button> -->
    <div id="embed_container">
    	<ul class="nav nav-tabs">
			<li class="active"><a href="#embed" data-toggle="tab">Embed</a></li>
			<li><a href="#gfy" data-toggle="tab">Create GIF&nbsp;&nbsp;<span class="label label-danger">BETA</span></a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="embed">
				<div id="embed_times" class="container-fluid">
	        		<h5 style="color: #9B0214;">Embed Options</h5>
	        		<div class="row">
	        			<?php 
	        				if ($options) {
		        				?>
			        			<div class="col-sm-3" style="max-width: 120px;">
			        				<div class="form-group">
		        						<label for="start_time">Start</label>
			        					<input id="start_time" type="number" class="form-control input-sm" type="text" placeholder="seconds" />
			        				</div>
			        			</div>
			        			<div class="col-sm-3" style="max-width: 120px;">
			        				<div class="form-group">
		        						<label for="end_time">End</label>
			        					<input id="end_time" type="number" class="form-control input-sm" type="text" placeholder="seconds" />
			        				</div>
			        			</div>
			        			<?php
			        		}
			        	?>
	        			<div class="col-sm-4" style="max-width: 190px;">
	        				<div class="form-group">
		        				<label for="video_size">Video Size</label>
	        					<select id="video_size" class="form-control input-sm" style="width: 105px;">
									<option value="xlarge">853 x 505</option>
									<option value="large">640 x 385</option>
									<option value="medium">560 x 340</option>
									<option value="small" selected>416 x 265</option>
								</select>
							</div>
	        			</div>
	        			<div class="col-sm-2" style="max-width: 115px; padding-top: 0; text-align: center;">
	        				<div class="form-group">
		        				<label for="add_options">&nbsp;</label>
	        					<button id="add_options" class="btn btn-sm btn-danger">Add Options</button>
	        				</div>
	        			</div>
	        		</div>
	        		<span><em>Note: Embed frame is slightly larger than video player size</em></span>
	        		<hr>
	        		<div id="embed_code" class="row">
		        		<div class="col-sm-12">
			        		<h4>Copy and paste code to embed this video on your site</h4>
			        		<input type="hidden" id="video_id_code" name="video_id_code" value="<?php echo $video_id; ?>" />
			        		<input type="hidden" id="video_post_id" name="video_post_id" value="<?php echo $original_id; ?>" />
			        		<input type="hidden" id="video_host" name="video_host" value="<?php echo get_post_meta( get_the_ID(), '_video_host', true); ?>" />
			        		<pre>&lt;iframe width=&quot;450&quot; height=&quot;420&quot; src=&quot;http://www.draftbreakdown.com/video-embed/?clip=<?php echo $original_id; ?>&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot;&gt;&lt;&#47;iframe&gt;</pre>
			        	</div>
			        	<div class="col-sm-12">
				        	<h4 id="link_vid_title">Direct Link</h4>
				        	<div id="link_code">
				        		<pre>http://www.draftbreakdown.com/video-embed/?clip=<?php echo $original_id; ?></pre>
				        	</div>
				        </div>
	        		</div>

	        	</div>
			</div>
			<div class="tab-pane" id="gfy">
				<div id="embed_times" class="container-fluid">
					<p style="margin-top: 10px;">Create a GIF to highlight a specific play from within our videos. Then choose to embed the GIF on your website or link to the GIF directly! GIF creation is a Beta version and we're working to make this process as seamless as possible!</p>
					<p><strong>Please note that having numerous GIFs embedded on one page can cause errors in older version of Google Chrome.</strong></p>
	        		<h5 style="color: #9B0214;">GIF Options</h5>
	        		<div class="row" style="margin-bottom: 5px;">
	        			<div class="col-sm-3">
	        				<div class="form-group">
		        				<label for="start_min">Start Minutes</label>
		        				<select id="start_min" class="form-control input-sm" style="width: 105px;">
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
	        			</div>
	        			<div class="col-sm-3">
	        				<div class="form-group">
		        				<label for="start_sec">Start Seconds</label>
	        					<select id="start_sec" class="form-control input-sm" style="width: 105px;">
									<option value="0" selected>0</option>
									<?php
										for ($i=1; $i <60; $i++) {
											echo '<option value="'.$i.'">'.$i.'</option>';
										}
									?>
								</select>
							</div>
	        			</div>
	        			<div class="col-sm-3">
	        				<div class="form-group">
		        				<label for="gfy_length">Length Seconds</label>
	        					<select id="gfy_length" class="form-control input-sm" style="width: 105px;">
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
	        			</div>
	        			<div class="col-sm-3" style="max-width: 115px; padding-top: 0; text-align: center;">
	        				<div class="form-group">
	        					<label for="createGfyButton">&nbsp;</label>
	        					<button id="createGfyButton" class="btn btn-sm btn-danger"><span id="createGfyText">Create GIF!</span><span id="loadingText" style="display: none;">Loading...</span><span id="getGfyCodeText" style="display: none;">Get GIF Code</span></button>
	        				</div>
	        			</div>
	        		</div>
	        		<span id="loadingInfoText" style="display: none;"><em>Please wait while your GIF is created. It can take up to 1-2 minutes depending on requested length and server traffic.</em><br /></span>
	        		<span id="gfyNote"><em>Note: GIFs created via <a href="http://www.gfycat.com" target="_blank">Gfycat</a>. Max-length of each GIF is 15 seconds. Please wait at least 30 seconds between creating additional GIFs. <strong>The Create button will reappear once enough time has elapsed.</strong></em></span>
	        		<hr>
	        		<div id="gfy_code" class="row">
		        		<div class="col-sm-12">
		        			<h4 id="embed_gif_title" style="display: none;">Embed GIF</h4>
			        		<pre id="gfy_json" style="display: none;"></pre>
			        		<h4 id="link_gif_title" style="display: none;">Direct Link</h4>
			        		<pre id="gfy_direct_link" style="display: none;"></pre>
			        		<h4 id="processing_title" style="display: none;">Processing...</h4>
			        		<div id="processing_message" style="display: none;"></div>
			        	</div>
			        	<div id="gfy_preview" class="col-sm-12" style="text-align: center;"></div>
	        		</div>

	        	</div>
			</div>
		</div>
        	

    </div>
</div>