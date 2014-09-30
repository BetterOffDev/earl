<?php
/**
 * Earl functions and definitions
 *
 * @package Earl
 */

/****************************************
Theme Setup
*****************************************/

/**
 * Theme initialization
 * should include any functions that need to be run right away on theme setup, including CPTs?
 */
require get_template_directory() . '/lib/init.php';

/**
 * Custom theme functions
 */
require get_template_directory() . '/lib/theme-functions.php';

/**
 * Admin area functions
 */
require get_template_directory() . '/lib/admin-functions.php';

/**
 * Util functions
 */
require get_template_directory() . '/lib/util.php';

/**
 * Member functions
 */
require get_template_directory() . '/lib/members.php';

/**
 * Custom post types
 */
require get_template_directory() . '/lib/cpt/video.php';
require get_template_directory() . '/lib/cpt/memberarticle.php';
require get_template_directory() . '/lib/cpt/mockdraft.php';
require get_template_directory() . '/lib/cpt/scoutingnote.php';

/**
 * API functions
 */
require get_template_directory() . '/lib/api/video-services.php';





// Twitter API functions

// short codes & template tags

