<!DOCTYPE HTML>
<html lang="en" style="background-color: #FFFFFF;">
    <head>
    
	   <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
       <link rel="Shortcut Icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/dist/img/favicon.ico">

        <?php wp_head(); ?>

        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-30936458-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();

        </script>

    </head>
    <body style="background-color: transparent; padding: 8px;">
        <style>
            #shareIcon {
                float: right;
                padding-right: 15px;
                font-size: 20px; 
                cursor: pointer;
            }

            #shareIcon:hover {
                color: #9b0214;
            }

            #shareCode {
                position: relative; 
                height: 200px;
            }

            #hideCodes {
                color: #9b0214;
                display: none;
                float: right;
                padding-right: 15px;
                cursor: pointer;
                font-size: 12px;
            }

        </style>


        <?php 

            wp_reset_query();

            if (isset($_GET['clip']) ) {
                $video_post_id = $_GET['clip'];
            }

            if (isset($_GET['start']) ) {
                $video_start = $_GET['start'];
                $video_start = "&start=".$video_start;
            }

            else {
                $video_start = "";
            }
            
            if (isset($_GET['end']) ) {
                $video_end = $_GET['end'];
                $video_end = "&end=".$video_end;
            }

            else {
                $video_end = "";
            }

            if (isset($_GET['size']) ) {
                $video_size = $_GET['size'];
            }

            else {
                $video_size = "small";
            }
            

            switch( $video_size ) {

                case 'xlarge':
                    $video_width = 853;
                    $video_height = 505;
                    break;

                case 'large':
                    $video_width = 640;
                    $video_height = 385;
                    break;

                case 'medium':
                    $video_width = 560;
                    $video_height = 340;
                    break;

                case 'small':
                    $video_width = 416;
                    $video_height = 265;
                    break;

                default:
                    $video_width = 416;
                    $video_height = 265;
            }

            $video_id = get_post_meta( $video_post_id, '_video_id', true);
            $video_prospect_id = get_post_meta( $video_post_id, '_video_prospect', true);
            $video_title = get_the_title( $video_post_id );
            $video_link = get_permalink( $video_post_id );
            $video_host = get_post_meta( $video_post_id, '_video_host', true);

            //Specific Player Info
            $player_name = get_the_title( $video_prospect_id );
            $vid_num = get_post_meta( $video_prospect_id, '_number_videos', true);
            $player_link = get_permalink( $video_prospect_id );

        ?>

        <div id="external_embed_container">

            <h4><a href="<?php echo $video_link; ?>" target="_blank"><?php echo $video_title; ?></a><i id="shareIcon" title="Share This Video" class="fa fa-share"></i><span id="hideCodes"><i class="fa fa-minus-sign"></i>&nbsp;Hide Codes</span></h4>
            <div id="shareCode" style="display: none;">
                <h4 id="embed_gif_title">Embed Video</h4>
                <pre id="gfy_json">&lt;iframe width=&quot;450&quot; height=&quot;420&quot; src=&quot;http://www.draftbreakdown.com/video-embed/?clip=<?php echo $video_post_id; ?>&quot; frameborder=&quot;0&quot; scrolling=&quot;no&quot;&gt;&lt;&#47;iframe&gt;</pre>
                <h4 id="link_gif_title">Direct Link</h4>
                <pre id="gfy_direct_link">http://www.draftbreakdown.com/video-embed/?clip=<?php echo $video_post_id; ?></pre>
            </div>

            <?php

                echo '<div id="video_wrapper">';

                embed_video($video_post_id);

                echo '</div>'; /* #video_wrapper */
            ?>

            <hr style="margin-bottom: 10px;">
            <div class="container">
                <div class="row">
                    <div class="col-xs-7">
                        <p style="font-size: 13px;"><a href="<?php echo $player_link; ?>" target="_blank">View <?php echo $vid_num; ?> videos of <?php echo $player_name; ?> at Draft Breakdown</a></p>
                    </div>
                    <div class="col-xs-5" style="text-align: right;">
                        <a href="http://www.draftbreakdown.com" target="_blank"><img src="<?php bloginfo('stylesheet_directory'); ?>/dist/img/db-embed-small.png" /></a>
                    </div>
                </div>
                <div style="display: none;">
                    <div id="usmg_ad_nfl.general_football_sports_728x90_1a">
                        <script type='text/javascript'>
                            googletag.defineSlot('/7103/SMG_DraftBreakdown/728x90_1a/sports/football/nfl.general', [728,90], 'usmg_ad_nfl.general_football_sports_728x90_1a').addService(googletag.pubads());
                            googletag.enableServices();
                            googletag.display('usmg_ad_nfl.general_football_sports_728x90_1a');
                        </script>
                    </div>
                </div>
            </div>
        </div>

    <?php wp_footer(); ?>

<script type="text/javascript">

    jQuery("#shareIcon").click(function() {
        jQuery('#shareCode').show();
        jQuery('#shareIcon').hide();
        jQuery('#hideCodes').show();
    });

    jQuery('#hideCodes').click(function() {
        jQuery('#shareCode').hide();
        jQuery('#shareIcon').show();
        jQuery('#hideCodes').hide();
    });


</script>


    <!-- Begin comScore Tag -->
    <script type="text/javascript">
        document.write(unescape("%3Cscript src='" + (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js' %3E%3C/script%3E"));
    </script>

    <script type="text/javascript">
      COMSCORE.beacon({
        c1:2,
        c2:"6035210",
        c3:"",
        c4:"www.draftbreakdown.com",
        c5:"",
        c6:"",
        c15:""
      });
    </script>
    <noscript>
      <img src="http://b.scorecardresearch.com/b?c1=2&c2=6035210&c3=&c4=www.draftbreakdown.com&c5=&c6=&c15=&cv=1.3&cj=1" style="display:none" width="0" height="0" alt="" />
    </noscript>
    <!-- End comScore Tag -->   

    </body>
</html>




  	
	
	
		