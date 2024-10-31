<?php
/**
 *
 * @package productive-forms
 */

function productive_forms_validate_input_hex_color( $color ) {
    if ( rest_parse_hex_color($color) ) {
        return true;
    } else {
        return false;
    }
}

function productive_forms_get_validate_input_default( $value ) {
    return strip_tags( stripslashes($value) );
}

function productive_forms_get_validate_input_wpeditor( $value ) {
    return stripslashes($value);
}

function productive_forms_get_is_validate_email_addresses( $emails_string ) {
    $is_email_address_error = false;
    $email_addresses = explode(',', $emails_string );
    foreach ( $email_addresses as $email_address ) {
        if ( !is_email(trim($email_address) ) ) {
            $is_email_address_error = true;
            break;
        }
    }
    return $is_email_address_error;
}

function productive_forms_get_is_valid_phone_number( $phone, $is_required = false ) {
    // TODO, implement international dialing code
    if ( $is_required ) {
        return ( !empty( $phone ) && is_numeric(str_replace(' ', '', $phone) ) );
    } else {
        return ( empty( $phone ) || is_numeric(str_replace(' ', '', $phone) ) );
    }
    
}

function productive_forms_get_date( $date_string ) {
    $the_date_raw = strtotime($date_string);
    $the_date = date( get_option( 'date_format' ), $the_date_raw );
    return $the_date;
}
       
function productive_forms_get_is_spam_verified( $verify_is_spam ) {
    $maths_challenge_sum = productive_forms_integration_maths_challenge_options_var_1() + productive_forms_integration_maths_challenge_options_var_2();
    if( $maths_challenge_sum == intval($verify_is_spam) ) {
        return 1;
    }
    return 0;
}

/**
 * Retrieve Form Fields: Contact
 */
function productive_forms_get_form_fields_contact( $post_object ) {

    $fields_contact = array(
        'name' => '',
        'last_name' => '',
        'email' => '',
        'phone' => '',
        'message' => '',
        'verify_is_spam' => '',
        'consent' => '',
        'is_consent_required' => '',
    );
    
    if ( $post_object != null && isset($post_object['nonce']) ) {
        if ( isset($post_object['productive_forms_form_contact_name']) ) { 
            $fields_contact['name']                 = sanitize_text_field( $post_object['productive_forms_form_contact_name'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_contact_last_name']) ) { 
            $fields_contact['last_name']            = sanitize_text_field( $post_object['productive_forms_form_contact_last_name'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_contact_email']) ) { 
            $fields_contact['email']                = sanitize_email( $post_object['productive_forms_form_contact_email'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_contact_phone']) ) { 
            $fields_contact['phone']                = sanitize_text_field( $post_object['productive_forms_form_contact_phone'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_contact_message']) ) { 
            $fields_contact['message']              = sanitize_textarea_field( $post_object['productive_forms_form_contact_message'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_contact_verify_is_spam']) ) { 
            $fields_contact['verify_is_spam']      = sanitize_text_field( $post_object['productive_forms_form_contact_verify_is_spam'] ); 
        }
        
        if ( isset($post_object['productive_forms_contact_consent_checkbox_text_contact']) ) { 
            $fields_contact['consent']              = sanitize_text_field( $post_object['productive_forms_contact_consent_checkbox_text_contact'] ); 
        }
        
        if ( isset($post_object['productive_forms_contact_is_consent_required']) ) { 
            $fields_contact['is_consent_required']              = sanitize_text_field( $post_object['productive_forms_contact_is_consent_required'] ); 
        }
    }
    return $fields_contact;
}

/**
 * Validate Form Fields: Contact
 */
function productive_forms_validate_form_fields_contact( $form_fields = null, $verify_human_challenge = 1 ) {
    $is_valid = array(
        'is_error_exists' => 0,
    );
    return $is_valid;
}

/**
 * Process Contact form and Submit, if valid
 */
function productive_forms_process_and_submit_submission_contact( $name, $last_name, $email, $phone, $message, $consented, $type ) {
    
    $submission_method = productive_forms_contact_how_to_process_contact_submissions();
    
    // Save into db Automatically or if set to save to db
    $data_save_result = 0;
    if ( empty( $submission_method ) ||
            $submission_method === 'save_only' || $submission_method === 'save_and_email' ) {
        $data_save_result = productive_forms_process_contact_message_save_submission($name, $last_name, $email, $phone, $message, $consented, $type);
        if ( !$data_save_result ) {
            $data_save_result = PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB;
        }
    }
    
    // Send email
    $data_email_result = 0;
    if ( !empty( $submission_method ) && ( $submission_method === 'email_only' || $submission_method === 'save_and_email' ) ) {
        $data_email_result = productive_forms_process_message_send_email($name, $last_name, $email, $phone, $message, $consented, $type);
        if ( !$data_email_result ) {
            $data_email_result = PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL;
        }
    }
    
    $show_success_message = productive_forms_get_submission_confirmation_code( $submission_method, $data_save_result, $data_email_result );
    
    return $show_success_message;
}


/**
 * Retrieve Form Fields: Newsletter
 */
function productive_forms_get_form_fields_newsletter( $post_object ) {

    $fields_newsletter = array(
        'name' => '',
        'last_name' => '',
        'email' => '',
        'phone' => '',
        'message' => '',
        'verify_is_spam' => '',
        'consent' => '',
    );
    
    if ( $post_object != null && isset($post_object['nonce']) ) {
        if ( isset($post_object['productive_forms_form_newsletter_name']) ) { 
            $fields_newsletter['name']                 = sanitize_text_field( $post_object['productive_forms_form_newsletter_name'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_newsletter_last_name']) ) { 
            $fields_newsletter['last_name']            = sanitize_text_field( $post_object['productive_forms_form_newsletter_last_name'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_newsletter_email']) ) { 
            $fields_newsletter['email']                = sanitize_email( $post_object['productive_forms_form_newsletter_email'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_newsletter_phone']) ) { 
            $fields_newsletter['phone']                = sanitize_text_field( $post_object['productive_forms_form_newsletter_phone'] ); 
        }
        
        if ( isset($post_object['productive_forms_form_newsletter_message']) ) { 
            $fields_newsletter['message']              = sanitize_textarea_field( $post_object['productive_forms_form_newsletter_message'] ); 
        }
        
        if ( isset($post_object['email']) ) {
            // Spam Bot will complete this field, 'email', which is invisible to human
            $fields_newsletter['verify_is_spam']      = sanitize_text_field( $post_object['email'] ); 
        }
        
        if ( isset($post_object['productive_forms_newsletter_consent_checkbox_text_newsletter']) ) { 
            $fields_newsletter['consent']              = sanitize_text_field( $post_object['productive_forms_newsletter_consent_checkbox_text_newsletter'] ); 
        }
        
        if ( isset($post_object['productive_forms_newsletter_is_consent_required']) ) { 
            $fields_newsletter['is_consent_required']              = sanitize_text_field( $post_object['productive_forms_newsletter_is_consent_required'] ); 
        }
    }
    return $fields_newsletter;
}


/**
 * Validate Form Fields: Contact
 */
function productive_forms_validate_form_fields_newsletter( $form_fields = null ) {
    $is_valid = array(
        'is_error_exists' => 0,
    );
    return $is_valid;
}

/**
 * Process Newsletter form and Submit, if valid
 */
function productive_forms_process_and_submit_submission_newsletter( $name, $last_name, $email, $phone, $message, $consented, $type, $source = '' ) {
    
    $submission_method = productive_forms_contact_how_to_process_contact_submissions();
    
    // Save into db Automatically or if set to save to db
    $data_save_result = 0;
    if ( empty( $submission_method ) ||
            $submission_method === 'save_only' || $submission_method === 'save_and_email' ) {
        $phone = esc_html__( 'n/a', 'productive-forms' ); // Phone not needed for Newsletter
        if( empty( $message ) ) {
            $message = esc_html__( 'Newsletter Subscription', 'productive-forms' ); // Message not needed for Newsletter
        }
        $data_save_result = productive_forms_process_newsletter_message_save_submission($name, $last_name, $email, $phone, $message, $consented, $type, $source);
        if ( !$data_save_result ) {
            $data_save_result = PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB;
        }
    }
    
    // Send email
    $data_email_result = 0;
    if ( !empty( $submission_method ) && ( $submission_method === 'email_only' || $submission_method === 'save_and_email' ) ) {
        $phone = ''; // Phone not needed for Newsletter
        $message = ''; // Message not needed for Newsletter
        $data_email_result = productive_forms_process_message_send_email($name, $last_name, $email, $phone, $message, $consented, $type);
        if ( !$data_email_result ) {
            $data_email_result = PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL;
        }
    }
    
    $show_success_message = productive_forms_get_submission_confirmation_code( $submission_method, $data_save_result, $data_email_result );
    
    return $show_success_message;
}

/**
 * Process and Return Confirmation Message
 */
function productive_forms_get_submission_confirmation_code( $submission_method, $data_save_result, $data_email_result ) {

    $show_success_message = 0;
    
    if ( $submission_method === 'save_only' && ($data_save_result) ) {
        // Save only confirmation
        $show_success_message = PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC;
    } 

    if ( $submission_method === 'email_only' && ($data_email_result) ) {
        // Email only confirmation
        $show_success_message = PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC;
    } 

    // Both Save and Send Email
    if ( $submission_method === 'save_and_email' && ($data_save_result && $data_email_result) ) {
        $show_success_message = PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC;
    }
    
    // Error saving submission
    if ( PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB === $data_save_result ) {
        $show_success_message = PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB;
    }
    
    // Error Sending Email
    if ( PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL === $data_email_result ) {
        $show_success_message = PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL;
    }
    
    return $show_success_message;
}

/**
 * Process and Return Confirmation Message
 */
function productive_forms_get_display_confirmation_message_text( $the_message_object, $success_message ) {

    $the_confirmation_object = array();
    $the_message_code = intval( $the_message_object['code'] );
    
    switch ($the_message_code) {
        case $the_message_code === PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC:
            // Success        
            $the_confirmation_object['code']         = PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC;
            $the_confirmation_object['result']       = $success_message;
            break;
        
        case $the_message_code === PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB:        
            $the_confirmation_object['code']         = PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB;
            $the_confirmation_object['result']       = PRODUCTIVE_FORMS_ERROR_TEXT_SAVE_TO_DB;
            break;
        
        case $the_message_code === PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL:        
            $the_confirmation_object['code']         = PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL;
            $the_confirmation_object['result']       = PRODUCTIVE_FORMS_ERROR_TEXT_SEND_EMAIL;
            break;
        
        case $the_message_code === PRODUCTIVE_FORMS_ERROR_CODE_INVALID_RECAPTCHA:        
            $the_confirmation_object['code']         = PRODUCTIVE_FORMS_ERROR_CODE_INVALID_RECAPTCHA;
            $the_confirmation_object['result']       = PRODUCTIVE_FORMS_ERROR_TEXT_INVALID_RECAPTCHA;
            break;
        
        default:
            // Any other error
            $the_confirmation_object['code']         = PRODUCTIVE_FORMS_ERROR_CODE_GENERIC;
            $the_confirmation_object['result']       = PRODUCTIVE_FORMS_ERROR_TEXT_GENERIC;
            break;
    }
    return $the_confirmation_object;
}
