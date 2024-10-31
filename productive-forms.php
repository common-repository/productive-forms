<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

/**
 * Plugin Name:       Productive Forms
 * Plugin URI:        https://www.productiveminds.com/product/productive-forms
 * Description:       Effortlessly integrate contact forms, 'contact us' page, newsletter registrations, and floating contact buttons into your site with this plugin. Utilize Gutenberg blocks, shortcodes or add widgets readily available upon activation.
 * Version:           1.1.18
 * Requires at least: 5.4
 * Requires PHP:      7.0
 * Author:            productiveminds.com
 * Author URI:        https://www.productiveminds.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       productive-forms
 * Domain Path:       /languages
 */

if ( !defined('ABSPATH') ) {
    exit;
}
$productive_forms_plugin_main_file = __FILE__;
require_once plugin_dir_path( $productive_forms_plugin_main_file ) . 'includes/start.php';
