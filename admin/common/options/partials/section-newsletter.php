<?php
/**
 *
 * @package productive-forms
 */


function productive_forms_register_section_newsletter() {
    global $section_newsletter_heading;
    // Add Section
    add_settings_section(
        'productive_forms_section_newsletter',    // Section id
        $section_newsletter_heading, // Section heading
        'productive_forms_section_newsletter_description_callback', // A callback method that displays the section description
        'productive_forms_section_newsletter_options'   // The menu slug of the page that will display this section
    );
    
    // Register a new setting for "productive_forms_section_newsletter" section.
    register_setting( 
            'productive_forms_section_newsletter_options', // Option group (section)
            'productive_forms_section_newsletter_options',   // Option name (it holds a collection of values of associated field - e.g productive_forms_section_newsletter_options[field_name])
            'productive_forms_register_section_newsletter_validate'      // Validate user entry
        );    
    
    if ( false == productive_forms_get_section_newsletter_options_object() || empty( productive_forms_get_section_newsletter_options_object()) ) {
        add_option( 'productive_forms_section_newsletter_options', apply_filters( 'productive_forms_section_newsletter_options_init_fields', productive_forms_section_newsletter_options_init_fields() ) );
    }
    
    productive_forms_add_section_newsletter_fields('productive_forms_section_newsletter_options');
    
}

function productive_forms_section_newsletter_description_callback() {
    ?>
        <h2><?php echo esc_html__( 'Newsletter Form Settings', 'productive-forms' ) ?></h2>
	<p>
            <?php echo esc_html__( 'Add settings for your Newsletter forms. These settings affect how Newsletter forms are displayed.  ', 'productive-forms' ); ?>
        </p>
	<?php
}

/* ============ START Section fields ================= */
function productive_forms_add_section_newsletter_fields($productive_forms_section_newsletter_options) {
    
    $args_field_1 = array(                                  // Array of arguement that get passed to the call back (productive_demo_importer_callback_contact)
        'label_for' => 'productive_forms_newsletter_heading', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_newsletter_heading', // field id
        __( 'Newsletter Heading Text', 'productive-forms' ), // Field label
        'productive_forms_callback_newsletter_form_heading', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_forms_section_newsletter_options,   // The menu slug of the page that will display this field
        'productive_forms_section_newsletter',   // Section name
        $args_field_1
        );
    
    $args_field_2 = array(
        'label_for' => 'productive_forms_newsletter_intro', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_newsletter_intro', // field id
        __( 'Newsletter Small Heading Text', 'productive-forms' ), // Field label
        'productive_forms_callback_newsletter_form_intro', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_forms_section_newsletter_options,   // The menu slug of the page that will display this field
        'productive_forms_section_newsletter',   // Section name
        $args_field_2
        );
    
    $args_field_3 = array( 
        'label_for' => 'productive_forms_newsletter_how_to_display_newsletter_name_field', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_newsletter_how_to_display_newsletter_name_field', // field id
        __( 'Individual Name Fields or Combined?', 'productive-forms' ), // Field label
        'productive_forms_callback_newsletter_how_to_display_newsletter_name_field',
        $productive_forms_section_newsletter_options, 
        'productive_forms_section_newsletter', 
        $args_field_3
        );
    
    $args_field_4 = array(                                  // Array of arguement that get passed to the call back (productive_demo_importer_callback_contact)
        'label_for' => 'is_on_productive_forms_newsletter_show_newsletter_field_labels', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'is_on_productive_forms_newsletter_show_newsletter_field_labels', 
        __( 'Show form field Labels?', 'productive-forms' ), 
        'productive_forms_callback_newsletter_show_newsletter_field_labels',
        $productive_forms_section_newsletter_options,
        'productive_forms_section_newsletter',
        $args_field_4
        );
    
    $args_field_5 = array( 
        'label_for' => 'productive_forms_newsletter_copy_newsletter_email_to_visitor', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_newsletter_copy_newsletter_email_to_visitor', // field id
        __( 'Copy email to sender?', 'productive-forms' ), // Field label
        'productive_forms_callback_newsletter_copy_newsletter_email_to_visitor',
        $productive_forms_section_newsletter_options, 
        'productive_forms_section_newsletter', 
        $args_field_5
        );
    
    $args_field_6 = array( 
        'label_for' => 'productive_forms_newsletter_receiver_of_newsletter_email_messages', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_newsletter_receiver_of_newsletter_email_messages', // field id
        __( 'Email Address to Receive Messages', 'productive-forms' ), // Field label
        'productive_forms_callback_newsletter_receiver_of_newsletter_email_messages',
        $productive_forms_section_newsletter_options, 
        'productive_forms_section_newsletter', 
        $args_field_6
        );
    
    $args_field_7 = array(
        'label_for' => 'productive_forms_newsletter_consent_checkbox_text_newsletter', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_newsletter_consent_checkbox_text_newsletter', // field id
        __( 'Text for Consent checkbox', 'productive-forms' ), // Field label
        'productive_forms_callback_newsletter_consent_checkbox_text_newsletter',
        $productive_forms_section_newsletter_options, 
        'productive_forms_section_newsletter', 
        $args_field_7
        );
    
    $args_field_8 = array(
        'label_for' => 'productive_forms_newsletter_success_message', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_newsletter_success_message', // field id
        __( 'Text for Successful Subscription', 'productive-forms' ), // Field label
        'productive_forms_callback_newsletter_success_message',
        $productive_forms_section_newsletter_options, 
        'productive_forms_section_newsletter', 
        $args_field_8
        );
    
    $args_field_9 = array( 
        'label_for' => 'productive_forms_newsletter_how_to_process_newsletter_submissions', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_newsletter_how_to_process_newsletter_submissions', // field id
        __( 'Newsletter Submission Processing Method?', 'productive-forms' ), // Field label
        'productive_forms_callback_newsletter_how_to_process_newsletter_submissions',
        $productive_forms_section_newsletter_options, 
        'productive_forms_section_newsletter', 
        $args_field_9
        );
    
}


function productive_forms_callback_newsletter_form_heading( $args ) {
        $options = productive_forms_get_section_newsletter_options_object();
        $productive_forms_newsletter_heading = '';
        if (isset( $options['productive_forms_newsletter_heading']) ) {
            $productive_forms_newsletter_heading = $options['productive_forms_newsletter_heading'];
        }
    ?>
        <input type="text" name="productive_forms_section_newsletter_options[productive_forms_newsletter_heading]" value="<?php echo esc_attr( $productive_forms_newsletter_heading ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
        <p>
            <?php echo esc_html__( 'E.g Sign Up for Our Newsletter', 'productive-forms' ); ?>
        </p>
   <?php
}

function productive_forms_callback_newsletter_form_intro( $args ) {
        $options = productive_forms_get_section_newsletter_options_object();
        $productive_forms_newsletter_intro = '';
        if (isset( $options['productive_forms_newsletter_intro']) ) {
            $productive_forms_newsletter_intro = $options['productive_forms_newsletter_intro'];
        }
    ?>
        <textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" type="text" name="productive_forms_section_newsletter_options[productive_forms_newsletter_intro]" rows="5" cols="40" size="40"><?php echo esc_attr( $productive_forms_newsletter_intro ); ?></textarea>
        <p>
            <?php echo esc_html__( 'E.g Join our list today and enjoy a 25% discount on your first order!', 'productive-forms' ); ?>
        </p>
   <?php
}

function productive_forms_callback_newsletter_copy_newsletter_email_to_visitor() {
        $options = productive_forms_get_section_newsletter_options_object();
        $copy_newsletter_email_to_visitor = '';
        if (isset( $options['copy_newsletter_email_to_visitor']) ) {
            $copy_newsletter_email_to_visitor = $options['copy_newsletter_email_to_visitor'];
        }
    ?>
    <p>
        <input id="productive_forms_section_newsletter_options[copy_newsletter_email_to_visitor]" type="checkbox" name="productive_forms_section_newsletter_options[copy_newsletter_email_to_visitor]" value="checked" <?php echo checked('checked', $copy_newsletter_email_to_visitor, false ); ?> />
        <label for="productive_forms_section_newsletter_options[copy_newsletter_email_to_visitor]"><?php echo esc_html__( 'Send a copy of (Newsletter) email to website visitor?', 'productive-forms' ); ?></label>
    </p>
   <?php
}

function productive_forms_callback_newsletter_how_to_display_newsletter_name_field( $args ) {        
        $options = productive_forms_get_section_newsletter_options_object();
        $how_to_display_newsletter_name_field = '';
        if( isset( $options['how_to_display_newsletter_name_field'] ) ) {
            $how_to_display_newsletter_name_field = $options['how_to_display_newsletter_name_field'];
        }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_forms_section_newsletter_options[how_to_display_newsletter_name_field]">
            <option value="combined_field" <?php echo selected( $how_to_display_newsletter_name_field, 'combined_field', false ); ?>>
               <?php echo esc_html__( 'Combined Field', 'productive-forms' ); ?>
            </option>
            <option value="individual_fields" <?php echo selected( $how_to_display_newsletter_name_field, 'individual_fields', false ); ?>>
                <?php echo esc_html__( 'Individual Fields', 'productive-forms' ); ?>
            </option>
        </select>
        <p>
            <?php echo esc_html__( 'Show individual fields for First name and Last name. Or show both fields combined.', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_forms_callback_newsletter_how_to_process_newsletter_submissions( $args ) {        
        $options = productive_forms_get_section_newsletter_options_object();
        $how_to_process_newsletter_submissions = '';
        if( isset( $options['how_to_process_newsletter_submissions'] ) ) {
            $how_to_process_newsletter_submissions = $options['how_to_process_newsletter_submissions'];
        }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_forms_section_newsletter_options[how_to_process_newsletter_submissions]">
            <option value="save_only" <?php echo selected( $how_to_process_newsletter_submissions, 'save_only', false ); ?>>
                <?php echo esc_html__( 'Save into Database Only', 'productive-forms' ); ?>
            </option>
            <option value="email_only" <?php echo selected( $how_to_process_newsletter_submissions, 'email_only', false ); ?>>
               <?php echo esc_html__( 'Email Only', 'productive-forms' ); ?>
            </option>
            <option value="save_and_email" <?php echo selected( $how_to_process_newsletter_submissions, 'save_and_email', false ); ?>>
                <?php echo esc_html__( 'Both (Save and Email)', 'productive-forms' ); ?>
            </option>
        </select>
        <p>
            <?php echo esc_html__( 'How would you like to process each newsletter subscription?', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_forms_callback_newsletter_receiver_of_newsletter_email_messages( $args ) {
        $options = productive_forms_get_section_newsletter_options_object();
        $receiver_of_newsletter_email_messages = '';
        if (isset( $options['receiver_of_newsletter_email_messages']) ) {
            $receiver_of_newsletter_email_messages = $options['receiver_of_newsletter_email_messages'];
        }
    ?>
        <input type="text" name="productive_forms_section_newsletter_options[receiver_of_newsletter_email_messages]" value="<?php echo esc_attr( $receiver_of_newsletter_email_messages ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
        <p>
            <?php echo esc_html__( 'An email address that will receive messages sent by website visitors. Leave this field empty to email the website admin.', 'productive-forms' ); ?>
        </p>
   <?php
}

function productive_forms_callback_newsletter_show_newsletter_field_labels() {
        $options = productive_forms_get_section_newsletter_options_object();
        $show_newsletter_field_labels = '';
        if (isset( $options['show_newsletter_field_labels']) ) {
            $show_newsletter_field_labels = $options['show_newsletter_field_labels'];
        }
    ?>
    <p>
        <input id="productive_forms_section_newsletter_options[show_newsletter_field_labels]" type="checkbox" name="productive_forms_section_newsletter_options[show_newsletter_field_labels]" value="checked" <?php echo checked('checked', $show_newsletter_field_labels, false ); ?> />
        <label for="productive_forms_section_newsletter_options[show_newsletter_field_labels]"><?php echo esc_html__( 'Show field labels above form fields', 'productive-forms' ); ?></label>
    </p>
   <?php
}

function productive_forms_callback_newsletter_consent_checkbox_text_newsletter( $args ) {
        $options = productive_forms_get_section_newsletter_options_object();
        $consent_checkbox_text_newsletter = '';
        if (isset( $options['consent_checkbox_text_newsletter']) ) {
            $consent_checkbox_text_newsletter = $options['consent_checkbox_text_newsletter'];
        }
    ?>
        <input type="text" name="productive_forms_section_newsletter_options[consent_checkbox_text_newsletter]" value="<?php echo esc_attr( $consent_checkbox_text_newsletter ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
        <p>
            <?php echo esc_html__( 'E.g, Kindly consent to our handling your personal data.', 'productive-forms' ); ?>
        </p>
   <?php
}

function productive_forms_callback_newsletter_success_message( $args ) {
        $options = productive_forms_get_section_newsletter_options_object();
        $newsletter_success_message = '';
        if (isset( $options['newsletter_success_message']) ) {
            $newsletter_success_message = $options['newsletter_success_message'];
        }
    ?>
        <input type="text" name="productive_forms_section_newsletter_options[newsletter_success_message]" value="<?php echo esc_attr( $newsletter_success_message ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
        <p>
            <?php echo esc_html__('E.g You are successfully subscribed to our Newsletter.', 'productive-forms'); ?>
        </p>
   <?php
}

/* ============ END Section fields ================= */




function productive_forms_get_section_newsletter_options_object() {
    return get_option( 'productive_forms_section_newsletter_options' );
}



function productive_forms_register_section_newsletter_validate( $section_inputs ) {
    
    $validated_values = array();
    
    foreach ( $section_inputs as $key => $input ) {
        if ( isset($section_inputs[$key]) ) {
            if ( !empty( $section_inputs[$key] ) && $key === 'receiver_of_newsletter_email_messages' ) {
                if (productive_forms_get_is_validate_email_addresses( $section_inputs[$key] ) ) {
                    // Invalid email address exists
                    add_settings_error( 'productive_forms_section_newsletter_options', 'invalid-email-section-3', esc_html( 'A recipient email address is invalid', 'productive-forms' ) );
                } else {
                    $validated_values[$key] = productive_forms_get_validate_input_default($input);
                }
            } else {
                $validated_values[$key] = productive_forms_get_validate_input_default($input);
            }
            
        }
    }
    
    return apply_filters('productive_forms_register_section_newsletter_validate', $validated_values, $section_inputs);
}


function productive_forms_section_newsletter_options_init_fields() {
    $default_fields_values = array(
        'productive_forms_newsletter_heading'               => esc_html( 'Sign Up for Our Newsletter', 'productive-forms' ),
        'productive_forms_newsletter_intro'                 => esc_html( 'Join our list today and enjoy a 25% discount on your first order!', 'productive-forms' ),
        'copy_newsletter_email_to_visitor'                  => '',
        'how_to_display_newsletter_name_field'              => 'individual_fields',
        'how_to_process_newsletter_submissions'             => '',
        'receiver_of_newsletter_email_messages'             => '',
        'show_newsletter_field_labels'                      => '',
        'consent_checkbox_text_newsletter'                  => esc_html( 'Consent to our handling your personal data.', 'productive-forms' ),
        'newsletter_success_message'                        => esc_html( 'You are successfully subscribed to our Newsletter.', 'productive-forms' ),
    );
    
    if ( function_exists( 'productive_forms_register_section_newsletter_extra' ) ) {
        $default_fields_values['newsletter_customer_subscription_enable_account_subscribe'] = 'checked';
        $default_fields_values['newsletter_customer_subscription_enable_checkout_subscribe'] = 'checked';
        $default_fields_values['newsletter_customer_subscription_checkout_heading'] = esc_html( 'Sign Up for Our Newsletter?', 'productive-forms' );
        $default_fields_values['newsletter_customer_subscription_checkout_desc'] = esc_html( 'Be the first to know about important product updates and new features', 'productive-forms' );
        $default_fields_values['newsletter_customer_subscription_checkout_checkbox_text'] = esc_html( 'Subscribe to our Newsletter', 'productive-forms' );
    }
    return apply_filters( 'productive_forms_section_newsletter_options_init_fields', $default_fields_values );
}
