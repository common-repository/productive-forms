<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}


/** 
 * Method productive_forms_uninstall_db ''.
 */
function productive_forms_uninstall_db() {
    $options = get_option( 'productive_forms_section_integration_options' );
    if ( isset( $options['productive_forms_keep_plugin_data_during_uninstall'] )) {
        $productive_forms_keep_plugin_data_during_uninstall = sanitize_text_field( $options['productive_forms_keep_plugin_data_during_uninstall'] );
    } else {
        $productive_forms_keep_plugin_data_during_uninstall = '';
    }
    if ( empty( $productive_forms_keep_plugin_data_during_uninstall ) || 'checked' !== $productive_forms_keep_plugin_data_during_uninstall ) {
        global $wpdb;
        $table_dropables = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;

        $sql = "DROP TABLE IF EXISTS $table_dropables";
        $wpdb->query( $sql );
        
        delete_option( PRODUCTIVE_FORMS_OPTION_EXTRAS_LAST_UPDATE_TIME );
        delete_option('_transient_productive_forms');
        delete_option('_transient_timeout_productive_forms');
        delete_option( 'productive_forms_section_contact_options' );
        delete_option( 'productive_forms_section_newsletter_options' );
        delete_option( 'productive_forms_section_integration_options' );
    }

    // Check Multisite
    if ( is_multisite() ) {
        // Main plugin version
        delete_site_option( PRODUCTIVE_FORMS_OPTION_VERSION_KEY );
    } else {
        // Main plugin version
        delete_option( PRODUCTIVE_FORMS_OPTION_VERSION_KEY );
    }
}