<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}


/**
 * ShortCode to form Contact
 *
 */
function productive_forms_contact_form( $atts = [], $content = null, $tag = '' ) {
    
    // normalize attribute keys to lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );
    // override the default attributes with user attributes
    $productive_atts = shortcode_atts(array( 'id' => mt_rand(1, 20) ), $atts, $tag);
    // TODO - maybe, ask users to supply id in shortcode usage
    
    $form_unique_id = $productive_atts['id'];
    
    $form_container_html_id = 'productive-form-contact-c';
    $is_formonly = 1;
    if ( isset($atts['is_formonly']) && intval(0) == $atts['is_formonly'] ) {
        $is_formonly = 0;
        $form_container_html_id = '';
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

    if ( $_POST != null && isset( $_POST['nonce'] ) && wp_verify_nonce($_POST['nonce'], 'productive_forms_contact_form') ) {
        
        $fields_submitted_contact = productive_forms_get_form_fields_contact( $_POST );
        
        $name               = $fields_submitted_contact['name'];
        $last_name          = $fields_submitted_contact['last_name'];
        $email              = $fields_submitted_contact['email'];
        $phone              = $fields_submitted_contact['phone'];
        $message            = $fields_submitted_contact['message'];
        $consented          = $fields_submitted_contact['consent'];
        $verify_is_spam    = $fields_submitted_contact['verify_is_spam'];
        
        $error_messages = productive_forms_validate_form_fields_contact( $fields_submitted_contact );
        
        if ( empty( $error_messages['is_error_exists'] ) ) {
            
            $type = 'c';
            $show_success_message = productive_forms_process_and_submit_submission_contact( $name, $last_name, $email, $phone, $message, $consented, $type );
            
            // Set confirmation message
            if ( PRODUCTIVE_FORMS_SUCCESS_CODE_GENERIC === $show_success_message ) {
                // Success
                $error_messages = array();
                $success_message = productive_forms_get_contact_success_message();
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
        if ( is_on_productive_forms_contact_show_contact_field_labels() ) {
            $labelled = ' labelled';
        }   
    ?>
    <div class="productive_forms_form_contact_container <?php echo esc_attr( $labelled ); ?>" id="<?php echo esc_attr($form_container_html_id); ?>">
        
        <?php if ( !$is_formonly && productive_forms_contact_form_show_contact_info() ) { ?>
        <div class="productiveminds_double_grid column_60_40">
            <div class="productiveminds_double_grid_content">
                <div class="productive-forms-box productiveminds-alignable-container gap-20px">
                    <div class="contact-intro-box">
                        <div>
                            <?php do_action( 'display_productive_forms_contact_intro_1'); ?>
                        </div>
                    </div>
                    <?php if ( !empty( $error_messages['is_error_exists'] ) || !empty( $success_message ) ) { ?>
                        <div class="productive_forms_form_contact_success_box_container">
                            <?php if ( !empty( $error_messages['is_error_exists'] ) ) { ?>
                            <div class="productive_forms_form_contact_success_box bordered-left-error">
                                <?php echo esc_html__('Please complete all required fields and try again', 'productive-forms'); ?>
                            </div>
                            <?php } else if ( !empty( $success_message ) ) { ?>
                                <div class="productive_forms_form_contact_success_box bordered-left-success">
                                    <?php echo esc_html( $success_message ); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/part-form-contact.php'; ?>
                </div>
            </div>
            <div class="productiveminds_double_grid_content relatived productiveminds-alignable-container align-items-flex-end align-content-flex-end">
                <?php if ( !$is_formonly && productive_forms_contact_form_show_contact_info() ) { ?>
                    <div class="contact-address-box no_margin">
                        <?php if ( is_on_productive_forms_contact_show_email_phone_address_on_contact_page() ) { ?>
                            <div class="contact-address-box-phone backgrounded-1rem-and-width-adjusted lightergrey-bg rounded-corner-5px">
                                <?php do_action( 'display_productive_forms_contact_phone_themes'); ?>
                            </div>
                            <div class="contact-address-box-email backgrounded-1rem-and-width-adjusted lightergrey-bg rounded-corner-5px">
                               <?php do_action( 'display_productive_forms_contact_email_themes' ); ?>
                            </div>
                        <?php } ?>

                        <?php if ( is_on_productive_forms_contact_show_business_hour_on_contact_page() ) { ?>
                            <div class="contact-address-opening-hours backgrounded-1rem-and-width-adjusted lightergrey-bg rounded-corner-5px">
                                <div><span class="title no_transform"><?php do_action( 'display_productive_forms_contact_business_hours_heading' ); ?></span></div>
                                <div><?php do_action( 'display_productive_forms_contact_business_hours_mon_fri' ); ?></div>
                                <div><?php do_action( 'display_productive_forms_contact_business_hours_sat' ); ?></div>
                                <div><?php do_action( 'display_productive_forms_contact_business_hours_sun' ); ?></div>
                            </div>
                        <?php } ?>
                        
                        <?php if ( is_on_productive_forms_contact_show_social_media_on_contact_page() ) { ?>
                            <div class="contact-address-box-social-media">
                                <div><?php do_action( 'display_productive_forms_social_media_block' ); ?></div>
                            </div>
                        <?php } ?>
                    </div>

                <?php } ?>
            </div>
        </div>
        <?php } else { ?>
        <div class="productive-forms-box productiveminds-alignable-container gap-20px">
            <div class="contact-intro-box">
                <div>
                    <?php do_action( 'display_productive_forms_contact_intro_1'); ?>
                </div>
            </div>
            
            <?php if ( !empty( $error_messages['is_error_exists'] ) || !empty( $success_message ) ) { ?>
                <div class="productive_forms_form_contact_success_box_container">
                    <?php if ( !empty( $error_messages['is_error_exists'] ) ) { ?>
                    <div class="productive_forms_form_contact_success_box bordered-left-error">
                        <?php echo esc_html__('Please complete all required fields and try again', 'productive-forms'); ?>
                    </div>
                    <?php } else if ( !empty( $success_message ) ) { ?>
                        <div class="productive_forms_form_contact_success_box bordered-left-success">
                            <?php echo esc_html( $success_message ); ?>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            
            <?php echo $consented; ?>
            
            <?php require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/part-form-contact.php'; ?>
        </div>
        <?php } ?>
        
        <?php if ( !$is_formonly && productive_forms_contact_form_show_contact_info() && function_exists( 'productive_forms_extra_is_active' ) ) { ?>
            
            <?php 
                if ( productive_forms_integration_ask_show_google_map() ) { 
                ?>
                <div class="contact-map-box no_margin">
                    <div class="contact-map-box-field">
                        <h2 class="contact-map-box-field-heading centered"><?php echo productive_forms_contact_location_heading(); ?></h2>
                        <div class="contact-map-box-field-address centered"><?php do_action( 'display_productive_forms_contact_full_address_textonly_all_in_one_line'); ?></div>
                        <div id="productive_g_map_content" style="width: 100%; height: 480px;"></div>
                        <?php do_action( 'display_get_productive_forms_contact_the_google_map'); ?>
                    </div>
                </div>
            <?php } ?>

        <?php } ?>
        
    </div>
<?php
}
add_shortcode('productive_contact_form', 'productive_forms_contact_form');

function productive_forms_contact_page( $atts = [], $content = null, $tag = ''  ) {
    $is_formonly = array(
        'is_formonly' => 0
    );
    productive_forms_contact_form( $is_formonly );
}
add_shortcode('productive_contact_page', 'productive_forms_contact_page');
