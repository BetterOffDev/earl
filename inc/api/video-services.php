<?php
/**
 * Video Service API functions
 * functions initialized in functions.php
 *
 * @package Earl
 */

/**
 * Universal
 */

// Get the video thumbnail src
// @params $size ( small, medium, large )
function get_video_thumb($size) {
    $video_host = get_post_meta( get_the_ID(), '_video_host', true);
    $video_id = get_post_meta( get_the_ID(), '_video_id', true);
    switch($video_host) {
        case 'youtube':
            return get_youtube_video_thumb($video_id);
            break;
        case 'vimeo':
            return get_vimeo_video_thumb($video_id, $size);
            break;
        case 'dailymotion':
            return get_dailymotion_video_thumb($video_id, $size);
        default:
            return get_youtube_video_thumb($video_id);
            break;
    }
}

// Embed the video
function embed_video($video_post_id = false) {
    if ( !$video_post_id ) {
        $video_host = get_post_meta( get_the_ID(), '_video_host', true);
        $video_id = get_post_meta( get_the_ID(), '_video_id', true);
    }
    else {
        $video_host = get_post_meta( $video_post_id, '_video_host', true);
        $video_id = get_post_meta( $video_post_id, '_video_id', true);
    }
    
    switch($video_host) {
        case 'youtube':
            return embed_youtube_video($video_id);
            break;
        case 'vimeo':
            return embed_vimeo_video($video_id);
            break;
        case 'dailymotion':
            return embed_dailymotion_video($video_id);
        default:
            return embed_youtube_video($video_id);
            break;
    }
}

/**
 * YouTube
 */

// Embed video
function embed_youtube_video($video_id) {
    $embed_string = '<iframe src="http://www.youtube.com/embed/'.$video_id.'?rel=0&modestbranding=0&showinfo=0&origin=draftbreakdown.com&frameborder="0" allowfullscreen="1" width="640" height="390"></iframe>';
    echo $embed_string;
}

// Video thumbnail
function get_youtube_video_thumb($id) {

    $file = file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$id."?v=2&alt=json");
	$images = json_decode($file, true);
    
    if ($images) {
        $images = $images['entry']['media$group']['media$thumbnail'];
        $image  = $images[count($images)-4]['url'];

        $mqurl = "http://i.ytimg.com/vi/".$id."/mqdefault.jpg";
        $maxurl = "http://i.ytimg.com/vi/".$id."/maxresdefault.jpg";
        $max    = get_headers($maxurl);

        if (substr($max[0], 9, 3) !== '404') {
            $image = $maxurl;   
        }

        else {
            $image = $mqurl;
        }
    }

    else {
        // $image = 'http://fillmurray.com/300/200';
        //$image = 'http://www.draftbreakdown.com/wp-content/themes/Earl/dist/img/video-default.png';
        $image = 'http://img.youtube.com/vi/'.$id.'/default.jpg';
    }
	

	return $image;
}

/**
 * Vimeo 
 */

// Embed video
function embed_vimeo_video($id) {
	
	$embed_string = '<iframe src="//player.vimeo.com/video/'.$id.'?title=0&portrait=0&byline=0" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen width="640" height="390"></iframe>';

	echo $embed_string;
}

// Video thumbnail
function get_vimeo_video_thumb($id, $size) {
    $data = file_get_contents("http://vimeo.com/api/v2/video/$id.json");
    $data_decoded = json_decode($data);
    switch ($size) {
    	case 'large':
    		$size = 'thumbnail_large';
    		break;
    	case 'medium':
    		$size = 'thumbnail_medium';
    		break;
    	case 'small':
    		$size = 'thumbnail_small';
    		break;
    	default:
    		$size = 'thumbnail_medium';
    		break;
    }

    if ( !$data_decoded[0]->$size ) {
        // return 'http://fillmurray.com/300/200';
        return 'http://www.draftbreakdown.com/wp-content/themes/Earl/dist/img/video-default.png';
    }
    else {
        return $data_decoded[0]->$size;
    }
    
}

/**
 * Daily Motion 
 */

// Embed video
function embed_dailymotion_video($id) {

	$embed_string = '<iframe src="http://www.dailymotion.com/embed/video/'.$id.'?info=0&logo=0&related=0" frameborder="0" width="640" height="390"></iframe>';

	echo $embed_string;
}

// Video thumbnail
function get_dailymotion_video_thumb($id, $size) {
    switch ($size) {
    	case 'large':
    		$size = 'thumbnail_480_url';
    		break;
    	case 'medium':
    		$size = 'thumbnail_240_url';
    		break;
    	case 'small':
    		$size = 'thumbnail_120_url';
    		break;
    	default:
    		$size = 'thumbnail_240_url';
    		break;
    }
    $data = file_get_contents("https://api.dailymotion.com/video/$id?fields=$size");
    $data_decoded = json_decode($data, true);

    if ( !$data_decoded[$size] ) {
        // return 'http://fillmurray.com/300/200';
        return 'http://www.draftbreakdown.com/wp-content/themes/Earl/dist/img/video-default.png';
    }

    else {
        return $data_decoded[$size];
    }
   
}
