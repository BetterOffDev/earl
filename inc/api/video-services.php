<?php
/**
 * Video Service API functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */

/**
 * Universal
 */
/********************* CREATE THIS *******************/
// hook into the_post_thumbnail
// function get_video_thumbnail() {

// }
// function embed_video($id, $host) {

// }

/**
 * YouTube
 */

/******************* FIX THIS ***********************/
// Embed video
// function embed_youtube_video($video_id) {

// }

// Video thumbnail
function get_youtube_video_thumb($id) {

	$images = json_decode(file_get_contents("http://gdata.youtube.com/feeds/api/videos/".$id."?v=2&alt=json"), true);
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

	return $image;
}

/**
 * Vimeo 
 */

// Embed video
function embed_vimeo_video($id, $width, $height) {
	if ( $width == '' ) {
		$width = 640;
	}
	if ( $height == '' ) {
		$height = 380;
	}

	$embed_string = '<iframe src="//player.vimeo.com/video/'.$id.'?title=0&portrait=0&byline=0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

	echo $embed_string;
}

// Video thumbnail
function get_vimeo_video_thumb($id, $size) {
    $data = file_get_contents("http://vimeo.com/api/v2/video/$id.json");
    $data = json_decode($data);
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
    return $data[0]->$size;
}

/**
 * Daily Motion 
 */

// Embed video
function embed_dailymotion_video($id, $width, $height) {
	if ( $width == '' ) {
		$width = 640;
	}
	if ( $height == '' ) {
		$height = 380;
	}

	$embed_string = '<iframe src="http://www.dailymotion.com/embed/video/'.$id.'?html=1&info=0&logo=0&related=0&quality=720" width="'.$width.'" height="'.$height.'" frameborder="0"></iframe>';

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
    $data = json_decode($data, true);
   
    return $data[$size];
   
}
