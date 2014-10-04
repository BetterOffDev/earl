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
require get_template_directory() . '/lib/inc/init.php';

/**
 * Custom theme functions
 */
require get_template_directory() . '/lib/inc/theme-functions.php';

/**
 * Admin area functions
 */
require get_template_directory() . '/lib/inc/admin-functions.php';

/**
 * Util functions
 */
require get_template_directory() . '/lib/inc/util.php';

/**
 * Template tags
 */
require get_template_directory() . '/lib/inc/template-tags.php';

/**
 * Member functions
 */
require get_template_directory() . '/lib/inc/members.php';

/**
 * Custom post types
 */
require get_template_directory() . '/lib/inc/cpt/video.php';
require get_template_directory() . '/lib/inc/cpt/memberarticle.php';
require get_template_directory() . '/lib/inc/cpt/mockdraft.php';
require get_template_directory() . '/lib/inc/cpt/scoutingnote.php';

/**
 * API functions
 */
require get_template_directory() . '/lib/inc/api/video-services.php';

/**
 * Plugin customization functions
 */
require get_template_directory() . '/lib/inc/plugin-custom.php';





// Twitter API functions

// short codes & template tags

// ad implementation!!!!

