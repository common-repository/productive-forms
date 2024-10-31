<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die(); 
}

// Plugin global variables
define( 'PRODUCTIVE_FORMS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PRODUCTIVE_FORMS_PLUGIN_URI', plugin_dir_url( __FILE__ ) );

define( 'PRODUCTIVE_FORMS_SITE_HOME_URL', home_url() );

define( 'PRODUCTIVE_FORMS_PLUGIN_NAME', 'Productive Contact & Forms' );
define( 'PRODUCTIVE_FORMS_DATABASE_NAME', 'productive_forms' );

define( 'PRODUCTIVE_FORMS_ADMIN_OVERVIEW_REQUEST_URI', 'productive_options_overview' );
define( 'PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI', 'productive_forms_options_submenu' );

define( 'PRODUCTIVE_FORMS_OPTION_VERSION_KEY', 'productive_forms_current_db_version' );
define( 'PRODUCTIVE_FORMS_OPTION_EXTRAS_KEY', 'productive_forms_extras_version' );
define( 'PRODUCTIVE_FORMS_OPTION_EXTRAS_LAST_UPDATE_TIME', 'productive_forms_extras_last_update_time' );

define( 'PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_NAME_SINGULAR', 'Contact Element' );
define( 'PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_NAME_PLURAL', 'Contact Elements' );
define( 'PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_SLUG', 'pro_contact_element' );
define( 'PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_META_KEY', '_pro_contact_element' );
define( 'PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_SINGULAR', 'Contact Element Category' );
define( 'PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_PLURAL', 'Contact Element Categories' );
define( 'PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_SLUG', 'contact-element-type' );

// Confirmation Message Codes
define( 'PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC', 1 );
define( 'PRODUCTIVE_FORMS_ERROR_CODE_GENERIC', 1000 );
define( 'PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB', 10 );
define( 'PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL', 20 );
define( 'PRODUCTIVE_FORMS_ERROR_CODE_INVALID_RECAPTCHA', 30 );

// Confirmation Message Results
define( 'PRODUCTIVE_FORMS_SUCCESS_TEXT_GENERIC', __('Success', 'productive-forms') );
define( 'PRODUCTIVE_FORMS_ERROR_TEXT_GENERIC', __('Error completing your request', 'productive-forms') );
define( 'PRODUCTIVE_FORMS_ERROR_TEXT_SAVE_TO_DB', __('Unable to save submission, check server configurations and try again.', 'productive-forms') );
define( 'PRODUCTIVE_FORMS_ERROR_TEXT_SEND_EMAIL', __('Unable to send submission email, check server configuration and try again.', 'productive-forms') );
define( 'PRODUCTIVE_FORMS_ERROR_TEXT_INVALID_RECAPTCHA', __('Unable to complete submission, invalid reCaptcha Credentials.', 'productive-forms') );

define( 'PRODUCTIVE_FORMS_OPTION_TAB_ABOUT_TITLE', __( 'About', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_OPTION_TAB_1_TITLE', __( 'Submissions', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_OPTION_TAB_1_SUB_TITLE_ALL', __( 'All', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_OPTION_TAB_1_SUB_TITLE_CONTACT', __( 'Contact Form Submissions', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_OPTION_TAB_1_SUB_TITLE_NEWSLETTER', __( 'Newsletter Subscriptions', 'productive-forms' ) );

define( 'PRODUCTIVE_FORMS_OPTION_TAB_CONTACT_TITLE', __( 'Contact Form', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_OPTION_TAB_NEWSLETTER_TITLE', __( 'Newsletter Form', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_OPTION_TAB_INTEGRATION_TITLE', __( 'General Settings', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_OPTION_TAB_PRO_TITLE', __( 'Free vs Pro', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_OPTION_TAB_LICENSE_TITLE', __( 'License', 'productive-forms' ) );

define("PRODUCTIVE_FORMS_APL_NAME", 'apl_productive_forms');

define( 'PRODUCTIVE_FORMS_CONTACT_US_PAGE_SLUG', __( 'contact-us', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_CONTACT_US_PAGE_TITLE', __( 'Contact Us', 'productive-forms' ) );
define( 'PRODUCTIVE_FORMS_CONTACT_US_PAGE_DEFAULT_SLUG_VALUE', 'productive_forms_contact_us_slug_default' );
define( 'PRODUCTIVE_FORMS_CONTACT_US_PAGE_QUERY_PARAM', 'productive-forms-contact-us-p' );

define( 'PRODUCTIVE_FORMS_IS_REWRITE_RULE_FLUSHED_KEY', 'productive_forms_is_rewrite_rule_flushed' );

define( 'PRODUCTIVE_FORMS_PLUGIN_WIDGET_TYPE_CONTACT_ELEMENT', 'contact_element' );
define( 'PRODUCTIVE_FORMS_PLUGIN_WIDGET_TYPE_SEARCH_RESULT', 'search_result' );
define( 'PRODUCTIVE_FORMS_PLUGIN_WIDGET_TYPE_NEWSLETTER_ELEMENT', 'newsletter_element' );

function productive_forms_get_wpdb_prefix() {
    global $wpdb;
    return $wpdb->prefix;
}