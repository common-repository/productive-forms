<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

/**
 * 
 * @param type $name
 * @param type $last_email
 * @param type $email
 * @param type $phone
 * @param type $message
 * @param type $consented
 * @param type $type
 * @return type
 */
function productive_forms_process_message_send_email($name, $last_email, $email, $phone, $message, $consented, $type) {
    
    $to_emails = array();
    
    $email_recipients_list = productive_forms_newsletter_receiver_of_newsletter_email_messages();
    if ( $type === 'c' ) {
        $email_recipients_list = productive_forms_contact_receiver_of_contact_email_messages();
    }
    
    if ( !empty( $email_recipients_list ) ) {
        $email_addresses = explode( ',', $email_recipients_list );
        foreach ( $email_addresses as $email_address ) {
            $to_emails[] = sanitize_email( $email_address );
        }
    } else {
        $e = get_option('admin_email');
        $email_option_sanitized = sanitize_option( 'admin_email', $e );
        $to_emails[] = sanitize_email( $email_option_sanitized );
    }
    
    if ( !empty( productive_forms_contact_copy_contactus_email_to_visitor() ) ) {
        $to_emails[] = sanitize_email($email);
    }
    $site_name = get_option('blogname');
    $first_email_address = $to_emails[0];
    $subject = esc_html( 'Contact us Message from ', 'productive-forms' ) . sanitize_option( 'blogname', $site_name );
    $message_body = productive_forms_generate_message_body($name, $last_email, $email, $phone, $message, $consented);
    $message_header = array( esc_html( 'From ', 'productive-forms' ) . sanitize_option( 'blogname', $site_name ) . '<' . $first_email_address . '>', 'Content-Type: text/html; charset=UTF-8');
    
    return wp_mail($to_emails, $subject, $message_body, $message_header);
}

/**
 * 
 * @param type $name
 * @param type $last_email
 * @param type $email
 * @param type $phone
 * @param type $message
 * @param type $consented
 * @return string
 */
function productive_forms_generate_message_body($name, $last_email, $email, $phone, $message, $consented) {
    
    $last_name_text = '';
    if ( !empty( $last_email )) {
        $last_name_text = '' .
        '<tr>
        <td>' . esc_html__( 'Last Name: ', 'productive-forms' ) . '</td>
        <td>'. esc_html( $last_email ) .'</td>
        </tr>';
    }
    
    $phone_number = '';
    if ( !empty( $phone )) {
        $phone_number = '' .
        '<tr>
        <td>' . esc_html__( 'Phone: ', 'productive-forms' ) . '</td>
        <td>'. esc_html( $phone ) .'</td>
        </tr>';
    }
    
    $message_txt = '';
    if ( !empty( $message )) {
        $message_txt = '' .
        '<tr>
        <td>' . esc_html__( 'Message: ', 'productive-forms' ) . '</td>
        <td>'. wp_specialchars_decode(stripslashes($message) ) .'</td>
        </tr>';
    }
    
    $consented_to_data = '';
    if ( !empty( $consented ) && $consented === 'checked' ) {
        $consented_to_data = '' .
        '<tr>
        <td>' . esc_html__( 'Consented to Data?', 'productive-forms' ) . '</td>
        <td>'. esc_html__( 'Yes, consent agreed', 'productive-forms' ) .'</td>
        </tr>';
    } else {
        $consented_to_data = '' .
        '<tr>
        <td>' . esc_html__( 'Consented to Data?', 'productive-forms' ) . '</td>
        <td>'. esc_html__( 'No, data consent was not provided', 'productive-forms' ) .'</td>
        </tr>';
    }
    
    $message_body = '
    <div style="width:100%; max-width:100%;">
        <table role="presentation" border="0" cellspacing="0" width="100%">
        <tr>
        <td>' . esc_html__( 'Name: ', 'productive-forms' ) . '</td>
        <td>'. esc_html( $name ) .'</td>
        </tr>' .
        $last_name_text .
        '<tr>
        <td>' . esc_html__( 'Email Address: ', 'productive-forms' ) . '</td>
        <td>'. esc_html( $email ) .'</td>
        </tr>' .
        $phone_number .
        $message_txt .
        $consented_to_data .
        '</table>
    </div>';
    
    return $message_body;
}

