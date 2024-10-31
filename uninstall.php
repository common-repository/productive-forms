<?php
/**
 * This magic file runs automatically, so no need to call 'register_uninstall_hook'
 * 
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

// Check if WordPress has called uninstall.php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

require_once plugin_dir_path( __FILE__ ) . 'global-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/common/db/db_uninstall.php';
require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/functions-options.php';

/**
 * run the Uninstall method productive_forms_uninstall_db ''.
 */
  productive_forms_uninstall_db();
