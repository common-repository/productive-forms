<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}


function productive_forms_database_upgrade_init() {
    $current_version_in_db = get_option( PRODUCTIVE_FORMS_OPTION_VERSION_KEY );
    if ( is_multisite() ) {
        $current_version_in_db = get_site_option( PRODUCTIVE_FORMS_OPTION_VERSION_KEY );
    }
    if ( $current_version_in_db  < PRODUCTIVE_FORMS_VERSION ) {
        productive_forms_database_upgrade();
    }
}
// Enable below when there is an upgrade
add_action( 'plugins_loaded', 'productive_forms_database_upgrade_init');

/**
 * Method productive_forms_database_upgrade ''.
 */
function productive_forms_database_upgrade() {
    if ( is_multisite() ) {
        update_site_option( PRODUCTIVE_FORMS_OPTION_VERSION_KEY, PRODUCTIVE_FORMS_VERSION );
    } else {
        update_option( PRODUCTIVE_FORMS_OPTION_VERSION_KEY, PRODUCTIVE_FORMS_VERSION );
    }
    
    // Trigger rewrite rule flushing after an update
    update_option( PRODUCTIVE_FORMS_IS_REWRITE_RULE_FLUSHED_KEY, 'no' );
}

