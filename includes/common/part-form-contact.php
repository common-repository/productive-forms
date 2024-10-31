<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

if( null == $error_messages || empty($error_messages) ) {
    $error_messages = array(
        'name_highlight' => '',
        'last_name_highlight' => '',
        'email_highlight' => '',
        'phone_highlight' => '',
        'message_highlight' => '',
        'verify_is_spam_highlight' => '',
        'consent_highlight' => '',
    );
}

?>

<form action="<?php echo esc_url($submission_url); ?>" class="productive_forms_form_contact_form productiveminds-alignable-container gap-10px" id="productive_forms_form_contact_form_<?php echo esc_attr($form_unique_id); ?>" method="POST">

    <div class="productive-forms-box-field">
        <?php if ( !empty( productive_forms_contact_how_to_display_contact_name_field() ) && productive_forms_contact_how_to_display_contact_name_field() === 'individual_fields' ) {
            $productive_forms_form_contact_name = esc_html__( 'First Name', 'productive-forms' );
        } else {
            $productive_forms_form_contact_name = esc_html__( 'Name', 'productive-forms' );
        } ?>
        <label class="noned" for="productive_forms_form_contact_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_attr($productive_forms_form_contact_name); ?> <span class="required-field-asterik">*</span></label>
        <input class="<?php echo esc_attr( $error_messages['name_highlight'] ); ?>" name="productive_forms_form_contact_name" id="productive_forms_form_contact_name_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $name ); ?>" type="text" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_attr($productive_forms_form_contact_name); ?> *"<?php } ?>/>
    </div>

    <?php if ( !empty( productive_forms_contact_how_to_display_contact_name_field() ) && productive_forms_contact_how_to_display_contact_name_field() === 'individual_fields' ) { ?>
        <div class="productive-forms-box-field">
            <label class="noned" for="productive_forms_form_contact_last_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__( 'Last Name', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
            <input class="<?php echo esc_attr( $error_messages['last_name_highlight'] ); ?>" name="productive_forms_form_contact_last_name" id="productive_forms_form_contact_last_name_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $last_name ); ?>" type="text" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'Last Name', 'productive-forms' ) ?> *"<?php } ?>/>
        </div>
    <?php } else { ?>
        <input type="hidden" id="productive_forms_form_contact_last_name_<?php echo esc_attr($form_unique_id); ?>" name="productive_forms_form_contact_last_name" value="" />
    <?php } ?>

    <div class="productive-forms-box-field">
        <label class="noned" for="productive_forms_form_contact_email_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__('Email', 'productive-forms') ?> <span class="required-field-asterik">*</span></label>
        <input class="<?php echo esc_attr( $error_messages['email_highlight'] ); ?>" name="productive_forms_form_contact_email" id="productive_forms_form_contact_email_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $email ); ?>" type="email" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'Email', 'productive-forms' ) ?> *"<?php } ?>/>
    </div>

    <?php if ( productive_forms_contact_ask_for_visitor_phone() ) { ?>
    <div class="productive-forms-box-field">
        <label class="noned" for="productive_forms_form_contact_phone_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__('Phone', 'productive-forms') ?></label>
        <input class="<?php echo esc_attr( $error_messages['phone_highlight'] ); ?>" name="productive_forms_form_contact_phone" id="productive_forms_form_contact_phone_<?php echo esc_attr($form_unique_id); ?>" value="<?php echo esc_attr( $phone ); ?>" type="tel" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'Phone', 'productive-forms' ) ?>"<?php } ?>/>
    </div>
    <?php } ?>

    <div class="productive-forms-box-field">
        <label class="noned" for="productive_forms_form_contact_message_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__('Message', 'productive-forms') ?> <span class="required-field-asterik">*</span></label>
        <textarea class="<?php echo esc_attr( $error_messages['message_highlight'] ); ?>" name="productive_forms_form_contact_message" id="productive_forms_form_contact_message_<?php echo esc_attr($form_unique_id); ?>" rows="4" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'message', 'productive-forms' ) ?> *"<?php } ?>><?php echo esc_textarea( $message ); ?></textarea>
    </div>

    <div class="productive-forms-box-field">
        <label class="noned" for="productive_forms_form_contact_verify_is_spam_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_html__('Answer this Maths challenge?', 'productive-forms') ?> <span class="required-field-asterik">*</span> 2 + 5 = </label>
        <input class="<?php echo esc_attr( $error_messages['verify_is_spam_highlight'] ); ?>" name="productive_forms_form_contact_verify_is_spam" id="productive_forms_form_contact_verify_is_spam_<?php echo esc_attr($form_unique_id); ?>" type="text" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_html__( 'Answer this Maths challenge?', 'productive-forms' ) ?>  2 + 5 = *"<?php } ?>/>
    </div>

    <?php if ( !empty( productive_forms_get_consent_checkbox_text_contact() ) ) { ?>
    <div class="productive-forms-box-field extra-margin">
        <input class="<?php echo esc_attr( $error_messages['consent_highlight'] ); ?>" id="productive_forms_contact_consent_checkbox_text_contact_<?php echo esc_attr($form_unique_id); ?>" type="checkbox" name="productive_forms_contact_consent_checkbox_text_contact" value="checked" <?php echo checked('checked', esc_attr( $consented ), false ); ?> />
        <label for="productive_forms_contact_consent_checkbox_text_contact_<?php echo esc_attr($form_unique_id); ?>">
            <?php do_action( 'display_productive_forms_contact_consent_checkbox_text_contact'); ?>
        </label>
    </div>
    <?php } ?>

    <div class="productive-forms-box-field action">
        <button aria-label="<?php echo esc_attr('Send Form', 'productive-forms'); ?>" class="" name="productive_forms_form_contact_submit" id="productive_forms_form_contact_submit_<?php echo esc_attr($form_unique_id); ?>" >
            <?php echo esc_html__( 'Send', 'productive-forms' ) ?>
        </button>
    </div>

    <?php $form_nonce = wp_create_nonce('productive_forms_contact_form'); ?>
    <input type="hidden" name="nonce" value="<?php echo esc_attr($form_nonce); ?>" />

</form>