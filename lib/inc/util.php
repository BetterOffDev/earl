<?php
/**
 * Util functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */

/**
 * Add where clause for post filtering (date range)
 */

function wsdev_filter_where( $where = '' ) {
	// posts in the last 30 days
	$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
	return $where;
}

/**
 * Custom Excerpt
 */
function wsdev_trim_excerpt($text) {
	$raw_excerpt = $text;
	if ( '' == $text ) {
    	
    	$text = get_the_content('');
 
    	$text = strip_shortcodes( $text );
 
    	$text = apply_filters('the_content', $text);
    	$text = str_replace(']]>', ']]&gt;', $text);
		
    	$allowed_tags = '<p>,<a>,<ul>,<li>,<script>,<noscript>'; 
    	/* removed: <table>,<th>,<tr>,<td>,<tbody>, */
    	$text = strip_tags($text, $allowed_tags);
 
    	$excerpt_word_count = 150; 
    	$excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
 
    	$excerpt_end = ' <a href="'. get_permalink( get_the_ID() ) . '"><strong>(read more...)</strong></a>'; 
    	$excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end);
 
    	$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    	if ( count($words) > $excerpt_length ) {
        	array_pop($words);
        	$text = implode(' ', $words);
        	$text = $text . $excerpt_more;
    	} 
		else {
        	$text = implode(' ', $words);
    	}
	}

	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

