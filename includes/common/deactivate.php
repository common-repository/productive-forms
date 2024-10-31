<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}


/**
 * Method productive_forms_deactivate ''.
 */
function productive_forms_deactivate() {
    productive_forms_deactivate_actions();
    productive_forms_flush_rewrite_rule();
}

/**
 * Method productive_forms_deactivate_actions ''.
 */
function productive_forms_deactivate_actions() {
    delete_option( PRODUCTIVE_FORMS_APL_NAME );
    delete_option( PRODUCTIVE_FORMS_OPTION_EXTRAS_KEY );
    delete_option( PRODUCTIVE_FORMS_OPTION_EXTRAS_LAST_UPDATE_TIME );
    delete_option('_transient_productive_forms');
    delete_option('_transient_timeout_productive_forms');
}

/**
 * Method productive_forms_flush_rewrite_rule ''.
 */
function productive_forms_flush_rewrite_rule() {
    flush_rewrite_rules();
    delete_option( PRODUCTIVE_FORMS_IS_REWRITE_RULE_FLUSHED_KEY );
}
