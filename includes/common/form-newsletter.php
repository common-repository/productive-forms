<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}


/**
 * ShortCode to form Newsletter
 *
 */
function productive_forms_newsletter_form( $atts = [], $content = null, $tag = '' ) {
    
    // normalize attribute keys to lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    // override the default attributes with user attributes
    $productive_atts = shortcode_atts(array( 'id' => mt_rand(1, 40) ), $atts, $tag);
    // TODO - maybe, ask users to supply id in shortcode usage
    
    $form_unique_id = $productive_atts['id'];
    
    $form_container_html_id = 'productive-form-newsletter-c';
    $is_formonly = 0;
    if ( isset($atts['is_formonly']) && intval(1) == $atts['is_formonly'] ) {
        $is_formonly = 1;
        $form_container_html_id = '';
    }
    $display_email_field_only = 0;
    if ( isset( $atts['display_email_field_only'] ) ) {
        $display_email_field_only = $atts['display_email_field_only']; 
    }
    
    $submission_url = '#' .  $form_container_html_id;
    
    $error_messages = array(
        'name_highlight' => '',
        'last_name_highlight' => '',
        'email_highlight' => '',
        'phone_highlight' => '',
        'message_highlight' => '',
        'verify_is_spam_highlight' => '',
        'consent_highlight' => '',
    );
    $success_message = '';
    
    $name               = '';
    $last_name          = '';
    $email              = '';
    $phone              = '';
    $message            = '';
    $consented          = '';
    $verify_is_spam    = '';

    if ( $_POST != null && isset( $_POST['nonce'] ) && wp_verify_nonce($_POST['nonce'], 'productive_forms_newsletter_form') ) {
        
        $fields_submitted_contact = productive_forms_get_form_fields_newsletter( $_POST );
        
        $name               = $fields_submitted_contact['name'];
        $last_name          = $fields_submitted_contact['last_name'];
        $email              = $fields_submitted_contact['email'];
        $phone              = $fields_submitted_contact['phone'];
        $message            = $fields_submitted_contact['message'];
        $consented          = $fields_submitted_contact['consent'];
        $verify_is_spam    = $fields_submitted_contact['verify_is_spam'];
        
        $error_messages = productive_forms_validate_form_fields_newsletter( $fields_submitted_contact );
        
        if ( empty( $error_messages['is_error_exists'] ) ) {
            
            $type = 'n';
            $show_success_message = productive_forms_process_and_submit_submission_newsletter( $name, $last_name, $email, $phone, $message, $consented, $type );
            
            // Set confirmation message
            if ( PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC === $show_success_message ) {
                // Success
                $error_messages = array();
                $success_message = productive_forms_get_newsletter_success_message();
            } else if ( PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB == $show_success_message ) {
                // DB save Error
                $error_messages[] = PRODUCTIVE_FORMS_ERROR_TEXT_SAVE_TO_DB;
            } else {
                // Email send Error
                $error_messages[] = PRODUCTIVE_FORMS_ERROR_TEXT_SEND_EMAIL;
            }
        }
    } else {
        // Do nothing, message not submitted
    }
    $labelled = '';
    if (is_on_productive_forms_newsletter_show_newsletter_field_labels() ) {
        $labelled = ' labelled';
    }
    ?>
    <div class="productive_forms_form_newsletter_container <?php echo esc_attr( $labelled ); ?>" id="<?php echo esc_attr($form_container_html_id); ?>">
        
        <div class="productive-forms-box productiveminds-alignable-container gap-10px">
            <div class="newsletter-intro-box productiveminds-alignable-container gap-5px">
                <h2><?php do_action( 'display_productive_forms_newsletter_heading'); ?></h2>
                <div>
                    <?php do_action( 'display_productive_forms_newsletter_intro'); ?>
                </div>

                <?php if ( !empty( $error_messages['is_error_exists'] ) || !empty( $success_message ) ) { ?>
                    <div class="productive_forms_form_newsletter_success_box_container">
                        <?php if ( !empty( $error_messages['is_error_exists'] ) ) { ?>
                        <div class="productive_forms_form_newsletter_success_box bordered-left-error">
                            <?php echo esc_html__('Please complete all required fields and try again', 'productive-forms'); ?>
                        </div>
                        <?php } else if ( !empty( $success_message ) ) { ?>
                                <div class="productive_forms_form_newsletter_success_box bordered-left-success">
                                    <?php echo esc_html( $success_message ); ?>
                                </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            
            <form action="<?php echo esc_url($submission_url) ?>" class="productive_forms_form_newsletter_form productiveminds-alignable-container gap-10px" id="productive_forms_form_newsletter_form_<?php echo esc_attr($form_unique_id); ?>" method="POST">

                <?php if( !$display_email_field_only ) { ?>
                    <div class="productive-forms-box-field">
                        <?php if ( !empty( productive_forms_newsletter_how_to_display_newsletter_name_field() ) && productive_forms_newsletter_how_to_display_newsletter_name_field() === 'individual_fields' ) {
                            $productive_forms_form_newsletter_name = esc_html__( 'First Name', 'productive-forms' );
                        } else {
                            $productive_forms_form_newsletter_name = esc_html__( 'Name', 'productive-forms' );
                        } ?>
                        <label class="noned" for="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_attr($productive_forms_form_newsletter_name); ?> <span class="required-field-asterik">*</span></label>
                        <input class="<?php echo esc_attr( $error_messages['name_highlight'] ); ?>" name="productive_forms_form_newsletter_name" id="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $name ); ?>" type="text"  <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_attr($productive_forms_form_newsletter_name); ?> *"<?php } ?>/>
                    </div>

                    <?php if ( !empty( productive_forms_newsletter_how_to_display_newsletter_name_field() ) && productive_forms_newsletter_how_to_display_newsletter_name_field() === 'individual_fields' ) { ?>
                        <div class="productive-forms-box-field">
                            <label class="noned" for="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__( 'Last Name', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
                            <input class="<?php echo esc_attr( $error_messages['last_name_highlight'] ); ?>" name="productive_forms_form_newsletter_last_name" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $last_name ); ?>" type="text"  <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'Last Name', 'productive-forms' ) ?> *"<?php } ?>/>
                        </div>
                    <?php } else { ?>
                        <input type="hidden" id="productive_forms_form_newsletter_last_name" name="productive_forms_form_newsletter_last_name" value="" />
                    <?php } ?>
                <?php } else { ?>
                    <input type="hidden" name="productive_forms_form_newsletter_name" id="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>" value="-" />
                    <input type="hidden" name="productive_forms_form_newsletter_last_name" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" value="-" />
                <?php } ?>

                <div class="productive-forms-box-field">
                    <label class="noned" for="productive_forms_form_newsletter_email_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__('Email', 'productive-forms') ?> <span class="required-field-asterik">*</span></label>
                    <input class="<?php echo esc_attr( $error_messages['email_highlight'] ); ?>" name="productive_forms_form_newsletter_email" id="productive_forms_form_newsletter_email_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $email ); ?>" type="email"  <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'Email', 'productive-forms' ) ?> *"<?php } ?>/>
                </div>

                <?php if ( !empty( productive_forms_get_consent_checkbox_text_newsletter() ) ) { ?>
                <div class="productive-forms-box-field extra-margin">
                    <input class="<?php echo esc_attr( $error_messages['consent_highlight'] ); ?>" id="productive_forms_newsletter_consent_checkbox_text_newsletter_<?php echo esc_attr($form_unique_id); ?>" type="checkbox" name="productive_forms_newsletter_consent_checkbox_text_newsletter" value="checked" <?php echo checked('checked', esc_attr( $consented ), false ); ?> />
                    <label for="productive_forms_newsletter_consent_checkbox_text_newsletter_<?php echo esc_attr($form_unique_id); ?>">
                        <?php do_action( 'display_productive_forms_newsletter_consent_checkbox_text_newsletter'); ?>
                    </label>
                </div>
                <?php } ?>

                <div class="productive-forms-box-field action">
                    <button aria-label="<?php echo esc_attr('Send Form', 'productive-forms'); ?>" class="" name="productive_forms_form_newsletter_submit" id="productive_forms_form_newsletter_submit_<?php echo esc_attr($form_unique_id); ?>" >
                        <?php echo __( 'Send', 'productive-forms' ) ?>
                    </button>
                </div>
                
                <?php $form_nonce = wp_create_nonce('productive_forms_newsletter_form'); ?>
                    <input type="hidden" name="nonce" value="<?php echo esc_attr($form_nonce); ?>" />
                    <input name="email" id="email_<?php echo esc_attr($form_unique_id); ?>" type="hidden" value="" />

            </form>
        </div>
        
    </div>
<?php
  
}
add_action('productive_newsletter_form', 'productive_forms_newsletter_form');
add_shortcode('productive_newsletter_form', 'productive_forms_newsletter_form');




/**
 * ShortCode to form Newsletter Horizontal 
 *
 */
function productive_forms_newsletter_form_landscape( $atts = [], $content = null, $tag = '' ) {
    
    // normalize attribute keys to lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    // override the default attributes with user attributes
    $productive_atts = shortcode_atts(array( 'id' => mt_rand(41, 80) ), $atts, $tag);
    // TODO - maybe, ask users to supply id in shortcode usage
    
    $form_unique_id = $productive_atts['id'];
    
    $form_container_html_id = 'productive-form-newsletter-l-c';
    $is_formonly = 0;
    if ( isset($atts['is_formonly']) && intval(1) == $atts['is_formonly'] ) {
        $is_formonly = 1;
        $form_container_html_id = '';
    }
    $display_email_field_only = 0;
    if ( isset( $atts['display_email_field_only'] ) ) {
        $display_email_field_only = $atts['display_email_field_only']; 
    }
    
    $submission_url = '#' .  $form_container_html_id;
    
    $error_messages = array(
        'name_highlight' => '',
        'last_name_highlight' => '',
        'email_highlight' => '',
        'phone_highlight' => '',
        'message_highlight' => '',
        'verify_is_spam_highlight' => '',
        'consent_highlight' => '',
    );
    $success_message = '';
    
    $name               = '';
    $last_name          = '';
    $email              = '';
    $phone              = '';
    $message            = '';
    $consented          = '';
    $verify_is_spam    = '';

    if ( $_POST != null && isset( $_POST['nonce'] ) && wp_verify_nonce($_POST['nonce'], 'productive_forms_newsletter_form') ) {
        
        $fields_submitted_contact = productive_forms_get_form_fields_newsletter( $_POST );
        
        $name               = $fields_submitted_contact['name'];
        $last_name          = $fields_submitted_contact['last_name'];
        $email              = $fields_submitted_contact['email'];
        $phone              = $fields_submitted_contact['phone'];
        $message            = $fields_submitted_contact['message'];
        $consented          = $fields_submitted_contact['consent'];
        $verify_is_spam    = $fields_submitted_contact['verify_is_spam'];
        
        $error_messages = productive_forms_validate_form_fields_newsletter( $fields_submitted_contact );
        
        if ( empty( $error_messages['is_error_exists'] ) ) {
            
            $type = 'n';
            $show_success_message = productive_forms_process_and_submit_submission_newsletter( $name, $last_name, $email, $phone, $message, $consented, $type );
            
            // Set confirmation message
            if ( PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC === $show_success_message ) {
                // Success
                $error_messages = array();
                $success_message = productive_forms_get_newsletter_success_message();
            } else if ( PRODUCTIVE_FORMS_ERROR_CODE_SAVE_TO_DB == $show_success_message ) {
                // DB save Error
                $error_messages[] = PRODUCTIVE_FORMS_ERROR_TEXT_SAVE_TO_DB;
            } else {
                // Email send Error
                $error_messages[] = PRODUCTIVE_FORMS_ERROR_TEXT_SEND_EMAIL;
            }
        }
    } else {
        // Do nothing, message not submitted
    }
    $labelled = '';
    if (is_on_productive_forms_newsletter_show_newsletter_field_labels() ) {
        $labelled = ' labelled';
    }
    ?>
<div class="productive_forms_form_newsletter_container landscape <?php echo esc_attr( $labelled ); ?>" id="<?php echo esc_attr($form_container_html_id); ?>">
        <div class="boxed-container">
            <div class="productive-forms-box productiveminds-alignable-container gap-10px">
                
                <div class="newsletter-intro-box productiveminds-alignable-container gap-5px">
                    <h2><?php do_action( 'display_productive_forms_newsletter_heading'); ?></h2>
                    <div>
                        <?php do_action( 'display_productive_forms_newsletter_intro'); ?>
                    </div>
                    <?php if ( !empty( $error_messages['is_error_exists'] ) || !empty( $success_message ) ) { ?>
                    <div class="productive_forms_form_newsletter_success_box_container">
                        <?php if ( !empty( $error_messages['is_error_exists'] ) ) { ?>
                        <div class="productive_forms_form_newsletter_success_box bordered-left-error">
                            <?php echo esc_html__('Please complete all required fields and try again', 'productive-forms'); ?>
                        </div>
                        <?php } else if ( !empty( $success_message ) ) { ?>
                                <div class="productive_forms_form_newsletter_success_box bordered-left-success">
                                    <?php echo esc_html( $success_message ); ?>
                                </div>
                        <?php } ?>
                    </div>
                <?php } ?>
                </div>
                <form action="<?php echo esc_url($submission_url); ?>" class="productive_forms_form_newsletter_form productiveminds-alignable-container gap-10px" id="productive_forms_form_newsletter_form_<?php echo esc_attr($form_unique_id); ?>" method="POST">
                    <div class="productive-forms-box-grid productiveminds-alignable-container flexed align-items-center align-content-center column-gap-5px row-gap-5px">
                        
                        <div class="productive-forms-box-grid-inputs flexed-autoed">
                            <div class="productive-forms-box-grid-inputs-grid productiveminds-alignable-container flexed flexed-in-a-flexed align-items-center align-content-center column-gap-5px row-gap-5px">
                                
                                <?php if( !$display_email_field_only ) { ?>
                                    <div class="productive-forms-box-field flexed-autoed">
                                        <?php if ( !empty( productive_forms_newsletter_how_to_display_newsletter_name_field() ) && productive_forms_newsletter_how_to_display_newsletter_name_field() === 'individual_fields' ) {
                                            $productive_forms_form_newsletter_name = esc_html__( 'First Name', 'productive-forms' );
                                        } else {
                                            $productive_forms_form_newsletter_name = esc_html__( 'Name', 'productive-forms' );
                                        } ?>
                                        <label class="noned" for="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_attr($productive_forms_form_newsletter_name); ?> <span class="required-field-asterik">*</span></label>
                                        <input class="<?php echo esc_attr( $error_messages['name_highlight'] ); ?>" name="productive_forms_form_newsletter_name" id="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $name ); ?>" type="text" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_attr($productive_forms_form_newsletter_name); ?> *"<?php } ?>/>
                                    </div>

                                    <?php if ( !empty( productive_forms_newsletter_how_to_display_newsletter_name_field() ) && productive_forms_newsletter_how_to_display_newsletter_name_field() === 'individual_fields' ) { ?>
                                        <div class="productive-forms-box-field flexed-autoed">
                                            <label class="noned" for="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__( 'Last Name', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
                                            <input class="<?php echo esc_attr( $error_messages['last_name_highlight'] ); ?>" name="productive_forms_form_newsletter_last_name" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $last_name ); ?>" type="text" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'Last Name', 'productive-forms' ) ?> *"<?php } ?>/>
                                        </div>
                                    <?php } else { ?>
                                        <input type="hidden" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" name="productive_forms_form_newsletter_last_name" value="" />
                                    <?php } ?>
                                <?php } else { ?>
                                    <input type="hidden" name="productive_forms_form_newsletter_name" id="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>" value="-" />
                                    <input type="hidden" name="productive_forms_form_newsletter_last_name" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" value="-" />
                                <?php } ?>
                                        
                                <div class="productive-forms-box-field flexed-autoed">
                                    <label class="noned" for="productive_forms_form_newsletter_email_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__('Email', 'productive-forms') ?> <span class="required-field-asterik">*</span></label>
                                    <input class="<?php echo esc_attr( $error_messages['email_highlight'] ); ?>" name="productive_forms_form_newsletter_email" id="productive_forms_form_newsletter_email_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $email ); ?>" type="email" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'Email', 'productive-forms' ) ?> *"<?php } ?>/>
                                </div>
                            </div>
                        </div>

                        <div class="productive-forms-box-grid-button">
                            <div class="productive-forms-box-field action">
                                <button aria-label="<?php echo esc_attr('Send Form', 'productive-forms'); ?>" class="" name="productive_forms_form_newsletter_submit" id="productive_forms_form_newsletter_submit_<?php echo esc_attr($form_unique_id); ?>" >
                                    <?php echo __( 'Send', 'productive-forms' ) ?>
                                </button>
                            </div>
                        </div>
                    </div>

                    <?php if ( !empty( productive_forms_get_consent_checkbox_text_newsletter() ) ) { ?>
                    <div class="productive-forms-box-field extra-margin">
                        <input class="<?php echo esc_attr( $error_messages['consent_highlight'] ); ?>" id="productive_forms_newsletter_consent_checkbox_text_newsletter_<?php echo esc_attr($form_unique_id); ?>" type="checkbox" name="productive_forms_newsletter_consent_checkbox_text_newsletter" value="checked" <?php echo checked('checked', esc_attr( $consented ), false ); ?> />
                        <label for="productive_forms_newsletter_consent_checkbox_text_newsletter_<?php echo esc_attr($form_unique_id); ?>">
                            <?php do_action( 'display_productive_forms_newsletter_consent_checkbox_text_newsletter'); ?>
                        </label>
                    </div>
                    <?php } ?>
                    
                    <?php $form_nonce = wp_create_nonce('productive_forms_newsletter_form'); ?>
                    <input type="hidden" name="nonce" value="<?php echo esc_attr($form_nonce); ?>" />
                     <input name="email" id="email_<?php echo esc_attr($form_unique_id); ?>" type="hidden" value="" />

                </form>
            </div>
        </div>
        
    </div>
<?php
}
add_action('productive_newsletter_form_landscape', 'productive_forms_newsletter_form_landscape');
add_shortcode('productive_newsletter_form_landscape', 'productive_forms_newsletter_form_landscape');

