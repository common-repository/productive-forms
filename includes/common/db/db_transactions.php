<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

/**
 * Method productive_forms_process_contact_delete ''.
 */
function productive_forms_process_contact_delete() {
    if ( isset( $_POST['nonce'] ) && wp_verify_nonce($_POST['nonce'], 'productive_forms_admin_scripts') ) {
        
        $p_id = sanitize_text_field( $_POST['id'] );
        $id = esc_attr( wp_unslash( $p_id ) );

        global $wpdb;
        $response = array();

        $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;

         if ( $id > 0 ) {
            $where = array(
                    'id' => $id,
            );
            $where_format = array( '%d' );
            $result = $wpdb->delete( $table, $where, $where_format );
            
            if ( $result == 1 ) {
                // Success
                $response['code'] = 1;
            } else {
                // Error deleting
                $response['code'] = 4;
            }
        } else {
            // Invalid request
        $response['code'] = 100;
        }
    } else {
        // Invalid request
        $response['code'] = 100;
    }

    $g_recaptcha_response_verify = productive_forms_process_contact_delete_result($response);
    //$g_recaptcha_response_verify['result'] = $sql;
    wp_send_json_success($g_recaptcha_response_verify);        
    wp_die();
}
add_action( 'wp_ajax_productive_forms_process_contact_delete', 'productive_forms_process_contact_delete' );
add_action( 'wp_ajax_nopriv_productive_forms_process_contact_delete', 'productive_forms_process_contact_delete' );

/**
 * Method productive_forms_process_contact_get_item .
 */
function productive_forms_process_contact_get_item($id) {
    global $wpdb;
    $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
    
    $sql = 'SELECT * FROM ' . $table;
    $sql .= ' WHERE id = %1d' ;
    $items = $wpdb->get_results( $wpdb->prepare($sql, $id), ARRAY_A );
    
    return $items[0];
}

/**
 * Process Bulk Mark as Read
 */
function productive_forms_process_contact_set_item_as_read( $id ) {

    global $wpdb;
    $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;

    $message = '';
    $data = array(
        'id' => $id,
        'status' => __( 'Read', 'productive-forms' ),
    );
    $where = array( 'id' => $id );
    $result = $wpdb->update( $table, $data, $where );
    if ( $result || $result == 1 ) {
        $message = esc_html__( 'Item successful marked as Read', 'productive-forms' );
    } else {
        $message = esc_html__( 'Item could not be marked as Read', 'productive-forms' );
    }

    return $message;
}

/**
 * Process Save Contact to database
 */
function productive_forms_process_contact_message_save_submission( $name, $last_name, $email, $phone, $message, $consented, $type, $source = '' ) {
    
    global $wpdb;
    $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
    
    if ( $phone === 'unused' ) {
        $phone = esc_html__( 'n/a', 'productive-forms' );
    }
    
    if ( $last_name === '' || $last_name === 'unused' ) {
        $last_name = esc_html__( 'n/a', 'productive-forms' );
    }
    
    $consented_agreed = '';
    if ( $consented === 'checked' ) {
        $consented_agreed = esc_html__( 'Yes', 'productive-forms' );
    } else {
        $consented_agreed = esc_html__( 'No', 'productive-forms' );
    }
    
    if ( get_current_user_id() ) {
        $user_id = get_current_user_id();
    } else {
        $user_id = 0;
    }
    
    // s = genre status
    $data = array(
        'user_id' => $user_id,
        'name' => $name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $phone,
        'content' => $message,
        'data_consent' => $consented_agreed,
        'type' => 'contact',
        'source' => $source,
    );
    
    $format = array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
    );
    
    $result = $wpdb->insert( $table, $data, $format );
    
    return $result;
}

/**
 * Process Save Contact to database
 */
function productive_forms_process_newsletter_message_save_submission( $name, $last_name, $email, $phone, $message, $consented, $type, $source = '' ) {

    global $wpdb;
    $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
    
    if ( $name === 'unused' ) {
        $name = esc_html__( 'n/a', 'productive-forms' );
    }
    
    if ( $last_name === '' || $last_name === 'unused' ) {
        $last_name = esc_html__( 'n/a', 'productive-forms' );
    }
    
    $consented_agreed = '';
    if ( $consented === 'checked' ) {
        $consented_agreed = esc_html__( 'Yes', 'productive-forms' );
    } else {
        $consented_agreed = esc_html__( 'No', 'productive-forms' );
    }
    
    if ( get_current_user_id() ) {
        $user_id = get_current_user_id();
    } else {
        $user_id = 0;
    }
    
    $data = array(
        'user_id' => $user_id,
        'name' => $name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $phone,
        'content' => $message,
        'data_consent' => $consented_agreed,
        'type' => 'newsletter',
        'source' => $source,
    );

    $format = array(
        '%d',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
        '%s',
    );
    
    $result = $wpdb->insert( $table, $data, $format );
    
    return $result;
}

function productive_forms_process_contact_delete_result($response) {
    $msg = intval( $response['code'] );
    $import_result_message = array(
        'code' => 100,
        'result' => __('Error completing your request') // Ignore spammers
    );
    
    switch ($msg) {
        case $msg == 1:
            // Success
            $import_result_message['result'] = esc_html__('Item Deleted successfully', 'productive-forms');            
            $import_result_message['code'] = 1;
            break;
        
        case $msg == 4:
            $import_result_message['result'] = esc_html__('Unable to process request, check and try again', 'productive-forms');
            $import_result_message['code'] = 4;
            break;
        
        default:
            // Any other error
            break;
    }
    return $import_result_message;
}


function productive_forms_process_g_recaptcha_v3_verify_remote( $form_g_recaptcha_v3_t, $form_g_recaptcha_v3_action ) {
    
    require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'libraries/recaptcha-master/src/autoload.php';
    
    $recaptcha_site_secret = productive_forms_integration_recaptcha_secret();
    $recaptcha_obj = new \ReCaptcha\ReCaptcha($recaptcha_site_secret);
    $site_domain = parse_url( get_site_url(), PHP_URL_HOST );
    
    $g_response = $recaptcha_obj->setExpectedHostname($site_domain)
                  ->setExpectedAction($form_g_recaptcha_v3_action)
                  ->setScoreThreshold(0.5)
                  ->verify($form_g_recaptcha_v3_t, $_SERVER['REMOTE_ADDR']);

    $import_result_message = array();
    if ( $g_response->isSuccess() ) {
        $import_result_message['code'] = true;
        $import_result_message['result'] = 'success';
    } else {
        //$g_response->getErrorCodes();
        $import_result_message['code'] = false;
        $import_result_message['result'] = 'error';
    }
    return $import_result_message['code'];
}


/**
 * Method productive_forms_process_g_recaptcha_v3_verify_ajax ''.
 */
function productive_forms_process_g_recaptcha_v3_verify_ajax() {
    
    $response = array(
        'code'          => 0,
        'result'        => __('Verification failed', 'productive-forms'),
    );
    
    if ( isset( $_POST['nonce'] ) && wp_verify_nonce($_POST['nonce'], 'productive_forms_scripts') ) {
        
        $form_g_recaptcha_v3_t = '';
        if( isset($_POST['form_g_recaptcha_v3_t']) ) {
            $form_g_recaptcha_v3_t   = sanitize_text_field( $_POST['form_g_recaptcha_v3_t'] );
        }
        $form_g_recaptcha_v3_action = '';
        if( isset($_POST['form_g_recaptcha_v3_action']) ) {
            $form_g_recaptcha_v3_action   = sanitize_text_field( $_POST['form_g_recaptcha_v3_action'] );
        }
        
        $is_productive_g_recaptcha_v3_valid = productive_forms_process_g_recaptcha_v3_verify_remote( $form_g_recaptcha_v3_t, $form_g_recaptcha_v3_action );        
        
        if( $is_productive_g_recaptcha_v3_valid ) {
            $response['code']        = 1;
            $response['result']      = __('Verified', 'productive-forms');
        }
    }
    
    wp_send_json_success( $response );
    wp_die();
}
add_action( 'wp_ajax_productive_forms_process_g_recaptcha_v3_verify_ajax', 'productive_forms_process_g_recaptcha_v3_verify_ajax' );
add_action( 'wp_ajax_nopriv_productive_forms_process_g_recaptcha_v3_verify_ajax', 'productive_forms_process_g_recaptcha_v3_verify_ajax' );


/**
 * Method productive_forms_process_message_contact_ajax ''.
 */
function productive_forms_process_message_contact_ajax() {
    $response = array();
    
    if ( isset( $_POST['nonce'] ) && wp_verify_nonce($_POST['nonce'], 'productive_forms_scripts') ) {
        
        $form_verify_email = '';
        if( isset($_POST['form_verify_email']) ) {
            $form_verify_email   = sanitize_text_field( $_POST['form_verify_email'] );
        }
        $form_verify_maths = '';
        if( isset($_POST['form_verify_maths']) ) {
            $form_verify_maths   = sanitize_text_field( $_POST['form_verify_maths'] );
        }
        $form_submission_verify_type = '';
        if( isset($_POST['form_submission_verify_type']) ) {
            $form_submission_verify_type   = sanitize_text_field( $_POST['form_submission_verify_type'] );
        }
        
        $verification_result_code = 0;
        $verification_result_message = '';
        $maths_challenge_verified = productive_forms_get_is_spam_verified($form_verify_maths);
        if( 'discreet' == $form_submission_verify_type && !empty($form_verify_email) ) {
            $verification_result_code = 700;
            $verification_result_message = __('Verification failed.', 'productive-forms');
        } else if( 'maths_challenge' == $form_submission_verify_type && !$maths_challenge_verified ) {
            $verification_result_code = 701;
            $verification_result_message = __('Please provide the correct answer to the math challenge, then try again.', 'productive-forms');
        }
        
        if( $verification_result_code ) {
            
            $verification_result = array(
                'code'      => $verification_result_code,
                'result'      => $verification_result_message,
            );
            wp_send_json_success( $verification_result );
            wp_die();
            
        } else {
            
            $fields_submitted_contact = productive_forms_get_form_fields_contact( $_POST );
        
            $name               = $fields_submitted_contact['name'];
            $last_name          = $fields_submitted_contact['last_name'];
            $email              = $fields_submitted_contact['email'];
            $phone              = $fields_submitted_contact['phone'];
            $message            = $fields_submitted_contact['message'];
            $consented          = $fields_submitted_contact['consent'];

            $is_valid = productive_forms_validate_form_fields_contact( $fields_submitted_contact, false );

            if ( !$is_valid['is_error_exists'] ) {

                $type                   = sanitize_textarea_field( $_POST['form_type'] );
                $show_success_message   = productive_forms_process_and_submit_submission_contact( $name, $last_name, $email, $phone, $message, $consented, $type );

                // Set confirmation message
                if ( PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC === $show_success_message ) {
                    // Success
                    $response['code']       = PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC;
                } else if ( PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB === $show_success_message ) {
                    // DB Save Error
                    $response['code']       = PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB;
                } else if ( PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL === $show_success_message ) {
                    // Email Send Error
                    $response['code']       = PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL;
                } else {
                    // Other error (Invalid request)
                    $response['code']       = PRODUCTIVE_FORMS_ERROR_CODE_GENERIC;
                }
            } else {
                // Invalid request - ignore, since errors have been processed in JS
                $response['code'] = PRODUCTIVE_FORMS_ERROR_CODE_GENERIC;
            }
        }
        
    } else {
        // Invalid request
        $response['code'] = PRODUCTIVE_FORMS_ERROR_CODE_GENERIC;
    }

    $success_message = productive_forms_get_contact_success_message();
    $form_submission_result = productive_forms_get_display_confirmation_message_text($response, $success_message);

    wp_send_json_success( $form_submission_result );
    wp_die();
}
add_action( 'wp_ajax_productive_forms_process_message_contact_ajax', 'productive_forms_process_message_contact_ajax' );
add_action( 'wp_ajax_nopriv_productive_forms_process_message_contact_ajax', 'productive_forms_process_message_contact_ajax' );


/**
 * Method productive_forms_process_message_newsletter_ajax ''.
 */
function productive_forms_process_message_newsletter_ajax() {
    $response = array();
    
    if ( isset( $_POST['nonce'] ) && wp_verify_nonce($_POST['nonce'], 'productive_forms_scripts') ) {
        
        $form_verify_email = '';
        if( isset($_POST['form_verify_email']) ) {
            $form_verify_email   = sanitize_text_field( $_POST['form_verify_email'] );
        }
        $form_verify_maths = '';
        if( isset($_POST['form_verify_maths']) ) {
            $form_verify_maths   = sanitize_text_field( $_POST['form_verify_maths'] );
        }
        $form_submission_verify_type = '';
        if( isset($_POST['form_submission_verify_type']) ) {
            $form_submission_verify_type   = sanitize_text_field( $_POST['form_submission_verify_type'] );
        }
        
        $verification_result_code = 0;
        $verification_result_message = '';
        $maths_challenge_verified = productive_forms_get_is_spam_verified($form_verify_maths);
        if( 'discreet' == $form_submission_verify_type && !empty($form_verify_email) ) {
            $verification_result_code = 700;
            $verification_result_message = __('Verification failed.', 'productive-forms');
        } else if( 'maths_challenge' == $form_submission_verify_type && !$maths_challenge_verified ) {
            $verification_result_code = 701;
            $verification_result_message = __('Please provide the correct answer to the math challenge, then try again.', 'productive-forms');
        }
        
        if( $verification_result_code ) {
            
            $verification_result = array(
                'code'      => $verification_result_code,
                'result'      => $verification_result_message,
            );
            wp_send_json_success( $verification_result );
            wp_die();
            
        } else {
            
            $fields_submitted_newsletter = productive_forms_get_form_fields_newsletter( $_POST );
        
            $name               = $fields_submitted_newsletter['name'];
            $last_name          = $fields_submitted_newsletter['last_name'];
            $email              = $fields_submitted_newsletter['email'];
            $phone              = '';
            $message            = '';
            $consented          = $fields_submitted_newsletter['consent'];

            $is_valid = productive_forms_validate_form_fields_newsletter( $fields_submitted_newsletter, false );

            if ( !$is_valid['is_error_exists'] ) {

                $type                   = sanitize_textarea_field( $_POST['form_type'] );
                $show_success_message   = productive_forms_process_and_submit_submission_newsletter( $name, $last_name, $email, $phone, $message, $consented, $type );

                // Set confirmation message
                if ( PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC === $show_success_message ) {
                    // Success
                    $response['code']       = PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC;
                } else if ( PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB === $show_success_message ) {
                    // DB Save Error
                    $response['code']       = PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB;
                } else if ( PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL === $show_success_message ) {
                    // Email Send Error
                    $response['code']       = PRODUCTIVE_FORMS_ERROR_CODE_SEND_EMAIL;
                } else {
                    // Other error (Invalid request)
                    $response['code']       = PRODUCTIVE_FORMS_ERROR_CODE_GENERIC;
                }
            } else {
                // Invalid request - ignore, since errors have been processed in JS
                $response['code'] = PRODUCTIVE_FORMS_ERROR_CODE_GENERIC;
            }
        }
        
    } else {
        // Invalid request
        $response['code'] = PRODUCTIVE_FORMS_ERROR_CODE_GENERIC;
    }

    $success_message = productive_forms_get_newsletter_success_message();
    $form_submission_result = productive_forms_get_display_confirmation_message_text($response, $success_message);

    wp_send_json_success( $form_submission_result );
    wp_die();
}
add_action( 'wp_ajax_productive_forms_process_message_newsletter_ajax', 'productive_forms_process_message_newsletter_ajax' );
add_action( 'wp_ajax_nopriv_productive_forms_process_message_newsletter_ajax', 'productive_forms_process_message_newsletter_ajax' );
