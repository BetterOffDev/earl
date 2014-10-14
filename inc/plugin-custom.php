<?php
/**
 * Plugin customization functions
 * functions initialized with actions/filters in /lib/init.php
 *
 * @package Earl
 */

/**
 * Contact Form 7
 * custom CSS classes
 */
function wsdev_custom_form_class_attr( $class ) {
    $class .= 'form-horizontal';
    return $class;
}


/**
 * W3 Total Cache
 * Disable caching for particular pages/posts
 */
function wsdev_disable_cache() {
 	if (is_single('2014-nfl-draft-instant-reaction')) {
  		define('DONOTCDN', true);
 	}

 	if (is_single('2014-nfl-draft-instant-reaction-second-round')) {
  		define('DONOTCDN', true);
 	}

 	if (is_single('2014-nfl-draft-instant-reaction-third-round')) {
  		define('DONOTCDN', true);
 	}
}