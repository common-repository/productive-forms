<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}


/**
 * Method productive_forms_database_setup ''.
 */
function productive_forms_database_install() {

    global $wpdb;

    $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;

    $charset_collate = '';

    if ( $wpdb->has_cap( 'collation' ) ) {
        $charset_collate = $wpdb->get_charset_collate();
    }

    $sql = "CREATE TABLE $table (
      `id` int(10) NOT NULL AUTO_INCREMENT,
      `user_id` bigint(20)  NOT NULL DEFAULT 0,
      `name` varchar(255) NOT NULL DEFAULT '',
      `last_name` varchar(255) NOT NULL DEFAULT '',
      `email` varchar(255) NOT NULL DEFAULT '',
      `phone` varchar(255) NOT NULL DEFAULT '',
      `content` text,
      `data_consent` varchar(20) NOT NULL DEFAULT '',
      `status` varchar(20) NOT NULL DEFAULT 'New',
      `type` varchar(255) NOT NULL DEFAULT 'contact',
      `source` varchar(255) NOT NULL DEFAULT '',
      `ip` varchar(100) NOT NULL DEFAULT '',
      `misc` text,
      `date` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY  (`id`)
    ) $charset_collate;";


    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    maybe_create_table( $table, $sql );

    // Check Multisite
    if ( is_multisite() ) {
        // Main plugin version
        add_site_option( PRODUCTIVE_FORMS_OPTION_VERSION_KEY, PRODUCTIVE_FORMS_VERSION );
    } else {
        // Main plugin version
        add_option( PRODUCTIVE_FORMS_OPTION_VERSION_KEY, PRODUCTIVE_FORMS_VERSION );
    }

    // Trigger rewrite rule flushing after an update
    add_option( PRODUCTIVE_FORMS_IS_REWRITE_RULE_FLUSHED_KEY, 'no' );
}
