<?php
/**
 *
 * @package productive-forms
 */

function productive_forms_register_section_contact() {
    global $section_contact_heading;
    // Add Section
    add_settings_section(
        'productive_forms_section_contact',    // Section id
        $section_contact_heading, // Section heading
        'productive_forms_section_contact_description_callback', // A callback method that displays the section heading / description
        'productive_forms_section_contact_options'   // The menu slug of the page that will display this section
    );
    
    register_setting(
            'productive_forms_section_contact_options', // Option group (section)
            'productive_forms_section_contact_options',   // Option name (it holds a collection of values of associated field - e.g productive_forms_section_contact_options[field_name])
            'productive_forms_register_section_contact_validate'      // Validate user entry
        );
    
    
    if ( false == productive_forms_get_section_contact_options_object() || empty( productive_forms_get_section_contact_options_object()) ) {
        add_option( 'productive_forms_section_contact_options', apply_filters( 'productive_forms_section_contact_options_init_fields', productive_forms_section_contact_options_init_fields() ) );
    }
    
    productive_forms_add_section_contact_fields('productive_forms_section_contact_options');
    
    $contact_us_landing_page_id = productive_forms_contact_us_page();
    if ( !is_numeric( $contact_us_landing_page_id ) || !$contact_us_landing_page_id ) {
        add_action( 'admin_notices', 'productive_forms_section_contact_us_set_page_cannot_be_located_error' );
    } else {
        $contact_us_page = get_post( $contact_us_landing_page_id );
        if( null != $contact_us_page && is_object( $contact_us_page ) ) {
            if( !$contact_us_page->ID || 'publish' != $contact_us_page->post_status ) {
                add_action( 'admin_notices', 'productive_forms_section_contact_us_set_page_cannot_be_located_error' );
            }
        } else {
            add_action( 'admin_notices', 'productive_forms_section_contact_us_set_page_cannot_be_located_error' );
        }
    }
    
}

function productive_forms_section_contact_us_set_page_cannot_be_located_error() {
    ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <?php echo PRODUCTIVE_FORMS_CURRENT_PLUGIN_NAME . __( ' plugin is unable to locate the designated Contact Us page. Please ', 'productive-forms' ); ?>
                <a href="admin.php?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_contact_options_tab#settings_section_contact_us_page"><?php echo __( 'go to the Contact Forms settings page', 'productive-forms' ); ?></a>
                <?php echo __( ' and choose your preferred option for "Contact Us Page". Then, navigate to "Settings" > "Permalinks" and Save Changes.', 'productive-forms' ); ?>
            </p>
        </div>
    <?php
}

function productive_forms_section_contact_description_callback() {
    ?>
        <h2 id="settings_section_contact_us_page"><?php echo esc_html__( 'Contact Form Page Settings and Information', 'productive-forms' ) ?></h2>
	<p>
            <?php echo esc_html__( 'Add settings and information for your contact form page. These settings affect how Contact forms are displayed.  ', 'productive-forms' ); ?>
        </p>
    <?php
}

/* ============ START Section fields ================= */
function productive_forms_add_section_contact_fields($productive_forms_section_contact_options) {
    
    $args_field_001a = array( 
        'label_for' => 'productive_forms_contact_us_page', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_us_page',
        __( 'Contact Us Page', 'productive-forms' ),
        'productive_forms_callback_contact_us_page',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_001a
        );

    $args_field_1 = array(
        'label_for' => 'productive_forms_contact_intro_1', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_intro_1', // field id
        __( 'Contact page intro', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_page_intro_1', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_forms_section_contact_options,   // The menu slug of the page that will display this field
        'productive_forms_section_contact',   // Section name
        $args_field_1
        );
    
    $args_field_2 = array( 
        'label_for' => 'productive_forms_contact_how_to_display_contact_name_field', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_how_to_display_contact_name_field', // field id
        __( 'Individual Name Fields or Combined?', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_how_to_display_contact_name_field',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_2
        );
    
    $args_field_3 = array( 
        'label_for' => 'is_on_productive_forms_contact_show_contact_field_labels', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'is_on_productive_forms_contact_show_contact_field_labels', 
        __( 'Show form field Labels?', 'productive-forms' ), 
        'productive_forms_callback_contact_show_contact_field_labels',
        $productive_forms_section_contact_options,
        'productive_forms_section_contact',
        $args_field_3
        );
    
    $args_field_4 = array( 
        'label_for' => 'productive_forms_contact_ask_for_visitor_phone', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_ask_for_visitor_phone', // field id
        __( 'Collect phone number?', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_ask_for_visitor_phone',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_4
        );
    
    $args_field_5 = array( 
        'label_for' => 'productive_forms_contact_copy_contactus_email_to_visitor', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_copy_contactus_email_to_visitor', // field id
        __( 'Copy email to sender?', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_copy_contactus_email_to_visitor',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_5
        );
    
    $args_field_6 = array( 
        'label_for' => 'productive_forms_contact_receiver_of_contact_email_messages', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_receiver_of_contact_email_messages', // field id
        __( 'Recipient Email address(s)', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_receiver_of_contact_email_messages',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_6
        );
    
    $args_field_7 = array(
        'label_for' => 'productive_forms_contact_consent_checkbox_text_contact', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_consent_checkbox_text_contact', // field id
        __( 'Text for consent checkbox', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_consent_checkbox_text_contact',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_7
        );
    
    $args_field_8 = array(
        'label_for' => 'productive_forms_contact_success_message', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_success_message', // field id
        __( 'Text for successful submission', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_success_message',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_8
        );
    
    $args_field_9 = array( 
        'label_for' => 'productive_forms_contact_how_to_process_contact_submissions', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_how_to_process_contact_submissions', // field id
        __( 'Contact Forms Submission processing method?', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_how_to_process_contact_submissions',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_9
        );
    
    $args_field_10 = array( 
        'label_for' => 'productive_forms_contact_contact_divider_social_contact_into', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_contact_divider_social_contact_into', // field id
        __( '', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_divider_social_contact_into',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_10
        );
    
    $args_field_10b = array( 
        'label_for' => 'productive_forms_contact_contact_heading', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_contact_heading', // field id
        __( 'Address Heading', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_location_heading',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_10b
        );
    
    $args_field_11 = array( 
        'label_for' => 'productive_forms_contact_email', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_email', // field id
        __( 'Email address', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_email',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_11
        );
    
    $args_field_12 = array( 
        'label_for' => 'productive_forms_contact_phone', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_phone', // field id
        __( 'Phone number', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_phone',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_12
        );
    
    $args_field_12b = array( 
        'label_for' => 'productive_forms_contact_whatsapp', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_whatsapp', // field id
        __( 'WhatsApp Number', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_whatsapp',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_12b
        );
    
    $args_field_12c = array( 
        'label_for' => 'productive_forms_contact_whatsapp_usage', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_whatsapp_usage', // field id
        __( 'WhatsApp Usage', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_whatsapp_usage',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_12c
        );
    
    $args_field_13 = array( 
        'label_for' => 'productive_forms_contact_address', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_address', // field id
        __( 'Physical address', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_address',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_13
        );
    
    $args_field_13a = array( 
        'label_for' => 'productive_forms_contact_city', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_city', // field id
        __( 'Town / City', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_city',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_13a
        );
    
    $args_field_13b = array( 
        'label_for' => 'productive_forms_contact_county', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_county', // field id
        __( 'County / State', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_county',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_13b
        );
    
    $args_field_14 = array( 
        'label_for' => 'productive_forms_contact_country', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_country', // field id
        __( 'Country', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_country',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_14
        );
    
    $args_field_15 = array( 
        'label_for' => 'productive_forms_contact_postcode', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_postcode', // field id
        __( 'Postcode', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_postcode',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_15
        );
    
    $args_field_16 = array( 
        'label_for' => 'productive_forms_contact_icon_color_addressinfo', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_icon_color_addressinfo', // field id
        __( 'Phone, Email and Location Icons Colour', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_icon_color_addressinfo',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_16
        );
    
    $args_field_88_0 = array( 
        'label_for' => 'productive_forms_contact_show_email_phone_address_on_contact_page', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_show_email_phone_address_on_contact_page', // field id
        __( 'Show on Contact us page?', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_show_email_phone_address_on_contact_page',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_88_0
        );
    
    $args_field_88_1 = array( 
        'label_for' => 'productive_forms_contact_contact_divider_busienss_hours', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_contact_divider_busienss_hours', // field id
        __( '', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_divider_busienss_hours',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_88_1
        );
    
    $args_field_88_2 = array( 
        'label_for' => 'productive_forms_contact_business_hours_heading', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_business_hours_heading', // field id
        __( 'Business Hours Heading', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_business_hours_heading',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_88_2
        );
    
    $args_field_88_3 = array( 
        'label_for' => 'productive_forms_contact_business_hours_mon_fri', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_business_hours_mon_fri', // field id
        __( 'Business Hours (Mon - Fri)', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_business_hours_mon_fri',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_88_3
        );
    
    $args_field_88_4 = array( 
        'label_for' => 'productive_forms_contact_business_hours_sat', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_business_hours_sat', // field id
        __( 'Business Hours (Saturdays)', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_business_hours_sat',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_88_4
        );
    
    $args_field_88_5 = array( 
        'label_for' => 'productive_forms_contact_business_hours_sun', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_business_hours_sun', // field id
        __( 'Business Hours (Sundays)', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_business_hours_sun',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_88_5
        );
    
    $args_field_88_5b = array( 
        'label_for' => 'productive_forms_contact_show_business_hour_on_contact_page', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_show_business_hour_on_contact_page', // field id
        __( 'Show Business Hours?', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_show_business_hour_on_contact_page',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_88_5b
        );
    
    $args_field_17 = array( 
        'label_for' => 'productive_forms_contact_contact_divider_social', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_contact_divider_social', // field id
        __( '', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_divider_social',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_17
        );
    
    $args_field_18 = array( 
        'label_for' => 'productive_forms_social_facebook', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_social_facebook', // field id
        __( 'Facebook URL', 'productive-forms' ), // Field label
        'productive_forms_callback_social_facebook',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_18
        );
    
    $args_field_19 = array( 
        'label_for' => 'productive_forms_social_youtube', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_social_youtube', // field id
        __( 'YouTube URL', 'productive-forms' ), // Field label
        'productive_forms_callback_social_youtube',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_19
        );
    
    $args_field_20 = array( 
        'label_for' => 'productive_forms_social_twitter', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_social_twitter', // field id
        __( 'Twitter URL', 'productive-forms' ), // Field label
        'productive_forms_callback_social_twitter',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_20
        );
    
    $args_field_21 = array( 
        'label_for' => 'productive_forms_social_pinterest', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_social_pinterest', // field id
        __( 'Pinterest URL', 'productive-forms' ), // Field label
        'productive_forms_callback_social_pinterest',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_21
        );
    
    $args_field_22 = array( 
        'label_for' => 'productive_forms_social_instagram', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_social_instagram', // field id
        __( 'Instagram URL', 'productive-forms' ), // Field label
        'productive_forms_callback_social_instagram',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_22
        );
    
    $args_field_23 = array( 
        'label_for' => 'productive_forms_contact_icon_color_socialmedia', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_icon_color_socialmedia', // field id
        __( 'Select Social Media Icons Colour', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_icon_color_socialmedia',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_23
        );
    
    $args_field_23a = array( 
        'label_for' => 'productive_forms_contact_icon_color_use_default_socialmedia', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_icon_color_use_default_socialmedia', // field id
        __( 'Use Official Icon Colours', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_icon_color_use_default_socialmedia',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_23a
        );
    
    $args_field_23b = array( 
        'label_for' => 'productive_forms_contact_show_social_media_on_contact_page', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_show_social_media_on_contact_page', // field id
        __( 'Show Social Media?', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_show_social_media_on_contact_page',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_23b
        );
    
    /*
    $args_field_24 = array(
        'label_for' => 'productive_forms_contact_contact_divider_floating_buttons', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_contact_divider_floating_buttons', // field id
        __( '', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_divider_floating_buttons',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_24
        );
     
    $args_field_25 = array( 
        'label_for' => 'productive_forms_contact_what_to_display_in_floating_buttons', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_what_to_display_in_floating_buttons', // field id
        __( 'Icons to Show in Floating Buttons?', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_what_to_display_in_floating_buttons',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_25
        );
    
    $args_field_26 = array( 
        'label_for' => 'productive_forms_contact_floating_buttons_location_vertical', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_floating_buttons_location_vertical', // field id
        __( 'Vertical Placement of Floating Buttons', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_floating_buttons_placement_vertical',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_26
        );
    
    $args_field_27 = array( 
        'label_for' => 'productive_forms_contact_floating_buttons_location_horizontal', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_contact_floating_buttons_location_horizontal', // field id
        __( 'Horizontal Placement of Floating Buttons', 'productive-forms' ), // Field label
        'productive_forms_callback_contact_floating_buttons_placement_horizontal',
        $productive_forms_section_contact_options, 
        'productive_forms_section_contact', 
        $args_field_27
        );
    */
}



function productive_forms_callback_contact_us_page( $args ) {        
        $options = productive_forms_get_section_contact_options_object();
        wp_dropdown_pages(
            array(
                'name'              => 'productive_forms_section_contact_options[productive_forms_contact_us_page]',
                'echo'              => 1,
                'show_option_none'  => __( 'Select an Option', 'productive-forms' ),
                'option_none_value' => 'select_an_option',
                'selected'          => $options['productive_forms_contact_us_page'],
            )
        );
        ?>
        <p>
            <?php echo esc_html__( 'Select the Contact Us page. If page does not exist, create a page, then add shortcode = [productive_contact_page].', 'productive-forms' ); ?>
            <br>
            <?php echo esc_html__( 'After changing this option, please go to Settings => Permlinks. Then click "Save Changes".', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_forms_callback_contact_page_intro_1( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $page_intro_1 = '';
        if (isset( $options['page_intro_1']) ) {
            $page_intro_1 = $options['page_intro_1'];
        }
    ?>
    <p> 
        <textarea id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" type="text" name="productive_forms_section_contact_options[page_intro_1]" rows="5" cols="40" size="40"><?php echo esc_attr( $page_intro_1 ); ?></textarea>
    </p>
   <?php
}

function productive_forms_callback_contact_how_to_display_contact_name_field( $args ) {        
        $options = productive_forms_get_section_contact_options_object();
        $productive_forms_options_item_value = '';
        if (isset( $options['how_to_display_contact_name_field']) ) {
            $productive_forms_options_item_value = $options['how_to_display_contact_name_field'];
        }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_forms_section_contact_options[how_to_display_contact_name_field]">
            <option value="combined_field" <?php echo selected( $productive_forms_options_item_value, 'combined_field', false ); ?>>
               <?php echo esc_html__( 'Combined Field', 'productive-forms' ); ?>
            </option>
            <option value="individual_fields" <?php echo selected( $productive_forms_options_item_value, 'individual_fields', false ); ?>>
                <?php echo esc_html__( 'Individual Fields', 'productive-forms' ); ?>
            </option>
        </select>
        <p>
            <?php echo esc_html__( 'Show individual fields for First name and Last name. Or show both fields combined.', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_forms_callback_contact_show_contact_field_labels() {
        $options = productive_forms_get_section_contact_options_object();
        $show_contact_field_labels = '';
        if (isset( $options['show_contact_field_labels']) ) {
            $show_contact_field_labels = $options['show_contact_field_labels'];
        }
    ?>
    <p>
        <input id="productive_forms_section_contact_options[show_contact_field_labels]" type="checkbox" name="productive_forms_section_contact_options[show_contact_field_labels]" value="checked" <?php echo checked('checked', $show_contact_field_labels, false ); ?> />
        <label for="productive_forms_section_contact_options[show_contact_field_labels]"><?php echo esc_html__( 'Show field labels above form fields', 'productive-forms' ); ?></label>
    </p>
   <?php
}

function productive_forms_callback_contact_ask_for_visitor_phone() {
        $options = productive_forms_get_section_contact_options_object();
        $contact_ask_for_visitor_phone = '';
        if (isset( $options['contact_ask_for_visitor_phone']) ) {
            $contact_ask_for_visitor_phone = $options['contact_ask_for_visitor_phone'];
        }
    ?>
    <p>
        <input id="productive_forms_section_contact_options[contact_ask_for_visitor_phone]" type="checkbox" name="productive_forms_section_contact_options[contact_ask_for_visitor_phone]" value="checked" <?php echo checked('checked', $contact_ask_for_visitor_phone, false ); ?> />
        <label for="productive_forms_section_contact_options[contact_ask_for_visitor_phone]"><?php echo esc_html__( 'Ask your visitors to supply phone number in contact form?', 'productive-forms' ); ?></label>
    </p>
   <?php
}

function productive_forms_callback_contact_copy_contactus_email_to_visitor() {
        $options = productive_forms_get_section_contact_options_object();
        $copy_contactus_email_to_visitor = '';
        if (isset( $options['copy_contactus_email_to_visitor']) ) {
            $copy_contactus_email_to_visitor = $options['copy_contactus_email_to_visitor'];
        }
    ?>
    <p>
        <input id="productive_forms_section_contact_options[copy_contactus_email_to_visitor]" type="checkbox" name="productive_forms_section_contact_options[copy_contactus_email_to_visitor]" value="checked" <?php echo checked('checked', $copy_contactus_email_to_visitor, false ); ?> />
        <label for="productive_forms_section_contact_options[copy_contactus_email_to_visitor]"><?php echo esc_html__( 'Send a copy of (Contact form) email to website visitor?', 'productive-forms' ); ?></label>
    </p>
   <?php
}

function productive_forms_callback_contact_receiver_of_contact_email_messages( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $receiver_of_contact_email_messages = '';
        if (isset( $options['receiver_of_contact_email_messages']) ) {
            $receiver_of_contact_email_messages = $options['receiver_of_contact_email_messages'];
        }
    ?>
        <input type="text" name="productive_forms_section_contact_options[receiver_of_contact_email_messages]" value="<?php echo esc_attr( $receiver_of_contact_email_messages ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
        <p>
            <?php echo esc_html__( 'An email address that will receive messages sent by website visitors. Leave this field empty to email the website admin.', 'productive-forms' ); ?>
        </p>
   <?php
}

function productive_forms_callback_contact_consent_checkbox_text_contact( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $consent_checkbox_text_contact = '';
        if (isset( $options['consent_checkbox_text_contact']) ) {
            $consent_checkbox_text_contact = $options['consent_checkbox_text_contact'];
        }
    ?>
        <input type="text" name="productive_forms_section_contact_options[consent_checkbox_text_contact]" value="<?php echo esc_attr( $consent_checkbox_text_contact ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
        <p>
            <?php echo esc_html__( 'E.g, Kindly consent to our handling your personal data.', 'productive-forms' ); ?>
        </p>
   <?php
}

function productive_forms_callback_contact_success_message( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_success_message = '';
        if (isset( $options['contact_success_message']) ) {
            $contact_success_message = $options['contact_success_message'];
        }
    ?>
        <input type="text" name="productive_forms_section_contact_options[contact_success_message]" value="<?php echo esc_attr( $contact_success_message ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
        <p>
            <?php echo esc_html__('E.g Message has been successfully submitted.', 'productive-forms'); ?>
        </p>
   <?php
}

function productive_forms_callback_contact_how_to_process_contact_submissions( $args ) {        
        $options = productive_forms_get_section_contact_options_object();
        $productive_forms_options_item_value = 'save_only';
        if (isset( $options['how_to_process_contact_submissions']) ) {
            $productive_forms_options_item_value = $options['how_to_process_contact_submissions'];
        }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_forms_section_contact_options[how_to_process_contact_submissions]">
            <option value="save_only" <?php echo selected( $productive_forms_options_item_value, 'save_only', false ); ?>>
                <?php echo esc_html__( 'Save into Database Only', 'productive-forms' ); ?>
            </option>
            <option value="email_only" <?php echo selected( $productive_forms_options_item_value, 'email_only', false ); ?>>
               <?php echo esc_html__( 'Email Only', 'productive-forms' ); ?>
            </option>
            <option value="save_and_email" <?php echo selected( $productive_forms_options_item_value, 'save_and_email', false ); ?>>
                <?php echo esc_html__( 'Both (Save and Email)', 'productive-forms' ); ?>
            </option>
        </select>
        <p>
            <?php echo esc_html__( 'How would you like to process each submitted contact form?', 'productive-forms' ); ?>
        </p>
    <?php
}




/**
 * 
 * @param type $args
 */
function productive_forms_callback_contact_divider_social_contact_into( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Phone, Email and Location', 'productive-forms' ) ?></h3>
   <?php
}

function productive_forms_callback_contact_location_heading( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_location_heading = '';
        if (isset( $options['contact_location_heading']) ) {
            $contact_location_heading = $options['contact_location_heading'];
        }
    ?>
    <input type="text" name="productive_forms_section_contact_options[contact_location_heading]" value="<?php echo esc_attr( $contact_location_heading ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    <p>
        <?php echo esc_html__( 'E.g Our Address', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_forms_callback_contact_email( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_email = '';
        if (isset( $options['contact_email']) ) {
            $contact_email = $options['contact_email'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[contact_email]" value="<?php echo esc_attr( $contact_email ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_phone( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_phone = '';
        if (isset( $options['contact_phone']) ) {
            $contact_phone = $options['contact_phone'];
        }
        $contact_phone_dial_code = '';
        if (isset( $options['contact_phone_dial_code']) ) {
            $contact_phone_dial_code = $options['contact_phone_dial_code'];
        } else {
            $contact_phone_dial_code = '+44';
        }   
    ?>
    <p> 
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="width-100px <?php echo esc_attr( $args['class'] ); ?>"
                name="productive_forms_section_contact_options[contact_phone_dial_code]">
            <option value="" <?php echo selected( $contact_phone_dial_code, '', 'false' ); ?>>
                <?php echo __( 'Select an Option', 'productive-forms' ); ?>
            </option>
            <?php
            $dial_codes = productive_forms_get_country_and_dial_codes();
            foreach ( $dial_codes as $country_code_country => $country_array ) {
                $country_name               = $country_array[0];
                $country_dial_code          = $country_array[1];
                $country_flag               = $country_array[2];
                $country_option_to_display  = $country_name . ' ' . $country_dial_code;
            ?>
                <option value="<?php echo esc_attr($country_dial_code) ?>" <?php echo selected( $contact_phone_dial_code, $country_dial_code, 'false' ); ?>>
                    <?php echo esc_attr($country_option_to_display); ?>
                </option>
            <?php
            }
            ?>
        </select>
        <input type="text" name="productive_forms_section_contact_options[contact_phone]" value="<?php echo esc_attr( $contact_phone ); ?>" size="15" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_whatsapp( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_whatsapp = '';
        if (isset( $options['contact_whatsapp']) ) {
            $contact_whatsapp = $options['contact_whatsapp'];
        }
        $contact_whatsapp_dial_code = '';
        if (isset( $options['contact_whatsapp_dial_code']) ) {
            $contact_whatsapp_dial_code = $options['contact_whatsapp_dial_code'];
        } else {
            $contact_whatsapp_dial_code = '+44';
        }
    ?>
    <p>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="width-100px <?php echo esc_attr( $args['class'] ); ?>"
                name="productive_forms_section_contact_options[contact_whatsapp_dial_code]">
            <option value="" <?php echo selected( $contact_whatsapp_dial_code, '', 'false' ); ?>>
                <?php echo __( 'Select an Option', 'productive-forms' ); ?>
            </option>
            <?php
            $dial_codes = productive_forms_get_country_and_dial_codes();
            foreach ( $dial_codes as $country_code_country => $country_array ) {
                $country_name               = $country_array[0];
                $country_dial_code          = $country_array[1];
                $country_flag               = $country_array[2];
                $country_option_to_display  = $country_name . ' ' . $country_dial_code;
            ?>
                <option value="<?php echo esc_attr($country_dial_code) ?>" <?php echo selected( $contact_whatsapp_dial_code, $country_dial_code, 'false' ); ?>>
                    <?php echo esc_attr($country_option_to_display); ?>
                </option>
            <?php
            }
            ?>
        </select>
        <input type="text" name="productive_forms_section_contact_options[contact_whatsapp]" value="<?php echo esc_attr( $contact_whatsapp ); ?>" size="15" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_whatsapp_usage( $args ) {        
        $options = productive_forms_get_section_contact_options_object();
        $productive_forms_options_item_value = 'phone_and_social_media';
        if (isset( $options['contact_whatsapp_usage']) ) {
            $productive_forms_options_item_value = $options['contact_whatsapp_usage'];
        }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_forms_section_contact_options[contact_whatsapp_usage]">
            <option value="phone_only" <?php echo selected( $productive_forms_options_item_value, 'phone_only', false ); ?>>
                <?php echo esc_html__( 'Phone Only', 'productive-forms' ); ?>
            </option>
            <option value="social_media_only" <?php echo selected( $productive_forms_options_item_value, 'social_media_only', false ); ?>>
               <?php echo esc_html__( 'Social Media Only', 'productive-forms' ); ?>
            </option>
            <option value="phone_and_social_media" <?php echo selected( $productive_forms_options_item_value, 'phone_and_social_media', false ); ?>>
                <?php echo esc_html__( 'Both Phone and Social Media', 'productive-forms' ); ?>
            </option>
        </select>
        <p>
            <?php echo esc_html__( 'How do you use WhatsApp on this website?', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_forms_callback_contact_address( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_address = '';
        if (isset( $options['contact_address']) ) {
            $contact_address = $options['contact_address'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[contact_address]" value="<?php echo esc_attr( $contact_address ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_city( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_city = '';
        if (isset( $options['contact_city']) ) {
            $contact_city = $options['contact_city'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[contact_city]" value="<?php echo esc_attr( $contact_city ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_county( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_county = '';
        if (isset( $options['contact_county']) ) {
            $contact_county = $options['contact_county'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[contact_county]" value="<?php echo esc_attr( $contact_county ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_country( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_country = '';
        if (isset( $options['contact_country']) ) {
            $contact_country = $options['contact_country'];
        }
    ?>
    <p>         
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                name="productive_forms_section_contact_options[contact_country]">
            <?php
            $countries = productive_forms_get_world_countries();
            foreach ( $countries as $country_code => $country_name ) {
            ?>
                <option value="<?php echo esc_attr($country_code) ?>" <?php echo selected( $contact_country, $country_code, 'false' ); ?>>
                    <?php echo esc_attr($country_name); ?>
                </option>
            <?php
            }
            ?>
        </select>
    </p>
   <?php
}

function productive_forms_callback_contact_postcode( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_postcode = '';
        if (isset( $options['contact_postcode']) ) {
            $contact_postcode = $options['contact_postcode'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[contact_postcode]" value="<?php echo esc_attr( $contact_postcode ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_icon_color_addressinfo( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_icon_color_addressinfo = '';
        if (isset( $options['contact_icon_color_addressinfo']) ) {
            $contact_icon_color_addressinfo = $options['contact_icon_color_addressinfo'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#ae3608" class="productive_input_color_picker" type="text" name="productive_forms_section_contact_options[contact_icon_color_addressinfo]" value="<?php echo esc_attr( $contact_icon_color_addressinfo ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_show_email_phone_address_on_contact_page() {
        $options = productive_forms_get_section_contact_options_object();
        $contact_show_email_phone_address_on_contact_page = '';
        if (isset( $options['contact_show_email_phone_address_on_contact_page']) ) {
            $contact_show_email_phone_address_on_contact_page = $options['contact_show_email_phone_address_on_contact_page'];
        }
    ?>
    <p>
        <input id="productive_forms_section_contact_options[contact_show_email_phone_address_on_contact_page]" type="checkbox" name="productive_forms_section_contact_options[contact_show_email_phone_address_on_contact_page]" value="checked" <?php echo checked('checked', $contact_show_email_phone_address_on_contact_page, false ); ?> />
        <label for="productive_forms_section_contact_options[contact_show_email_phone_address_on_contact_page]"><?php echo esc_html__( 'Show Phone, Email and Location on Contact Us Page?', 'productive-forms' ); ?></label>
    </p>
   <?php
}




/**
 * 
 * @param type $args
 */
function productive_forms_callback_contact_divider_busienss_hours( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Business Hours', 'productive-forms' ) ?></h3>
   <?php
}

function productive_forms_callback_contact_business_hours_heading( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_business_hours_heading = '';
        if (isset( $options['contact_business_hours_heading']) ) {
            $contact_business_hours_heading = $options['contact_business_hours_heading'];
        }
    ?>
    <input type="text" name="productive_forms_section_contact_options[contact_business_hours_heading]" value="<?php echo esc_attr( $contact_business_hours_heading ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    <p>
        <?php echo esc_html__( 'E.g Our Opening Hours', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_forms_callback_contact_business_hours_mon_fri( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_business_hours_mon_fri = '';
        if (isset( $options['contact_business_hours_mon_fri']) ) {
            $contact_business_hours_mon_fri = $options['contact_business_hours_mon_fri'];
        }
    ?>
     <input type="text" name="productive_forms_section_contact_options[contact_business_hours_mon_fri]" value="<?php echo esc_attr( $contact_business_hours_mon_fri ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
     <p>
        <?php echo esc_html__( 'E.g 8am - 6pm, Mondays to Fridays', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_forms_callback_contact_business_hours_sat( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_business_hours_sat = '';
        if (isset( $options['contact_business_hours_sat']) ) {
            $contact_business_hours_sat = $options['contact_business_hours_sat'];
        }
    ?>
    <input type="text" name="productive_forms_section_contact_options[contact_business_hours_sat]" value="<?php echo esc_attr( $contact_business_hours_sat ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    <p>
        <?php echo esc_html__( 'E.g 10am - 6pm on Sundays', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_forms_callback_contact_business_hours_sun( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_business_hours_sun = '';
        if (isset( $options['contact_business_hours_sun']) ) {
            $contact_business_hours_sun = $options['contact_business_hours_sun'];
        }
    ?>
    <input type="text" name="productive_forms_section_contact_options[contact_business_hours_sun]" value="<?php echo esc_attr( $contact_business_hours_sun ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    <p>
        <?php echo esc_html__( 'E.g Closed on Sundays', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_forms_callback_contact_show_business_hour_on_contact_page() {
        $options = productive_forms_get_section_contact_options_object();
        $contact_show_business_hour_on_contact_page = '';
        if (isset( $options['contact_show_business_hour_on_contact_page']) ) {
            $contact_show_business_hour_on_contact_page = $options['contact_show_business_hour_on_contact_page'];
        }
    ?>
    <p>
        <input id="productive_forms_section_contact_options[contact_show_business_hour_on_contact_page]" type="checkbox" name="productive_forms_section_contact_options[contact_show_business_hour_on_contact_page]" value="checked" <?php echo checked('checked', $contact_show_business_hour_on_contact_page, false ); ?> />
        <label for="productive_forms_section_contact_options[contact_show_business_hour_on_contact_page]"><?php echo esc_html__( 'Show Business Hours on Contact Us Page?', 'productive-forms' ); ?></label>
    </p>
   <?php
}




/**
 * 
 * @param type $args
 */
function productive_forms_callback_contact_divider_social( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Social Media Sites', 'productive-forms' ) ?></h3>
   <?php
}

function productive_forms_callback_social_facebook( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $social_facebook = '';
        if (isset( $options['social_facebook']) ) {
            $social_facebook = $options['social_facebook'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[social_facebook]" placeholder="<?php echo esc_html__( 'Start with http or https', 'productive-forms' ); ?>" value="<?php echo esc_attr( $social_facebook ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_social_youtube( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $social_youtube = '';
        if (isset( $options['social_youtube']) ) {
            $social_youtube = $options['social_youtube'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[social_youtube]" placeholder="<?php echo esc_html__( 'Start with http or https', 'productive-forms' ); ?>" value="<?php echo esc_attr( $social_youtube ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_social_twitter( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $social_twitter = '';
        if (isset( $options['social_twitter']) ) {
            $social_twitter = $options['social_twitter'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[social_twitter]" placeholder="<?php echo esc_html__( 'Start with http or https', 'productive-forms' ); ?>" value="<?php echo esc_attr( $social_twitter ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_social_pinterest( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $social_pinterest = '';
        if (isset( $options['social_pinterest']) ) {
            $social_pinterest = $options['social_pinterest'];
        }
    ?>
    <p> 
        <input type="text" name="productive_forms_section_contact_options[social_pinterest]" placeholder="<?php echo esc_html__( 'Start with http or https', 'productive-forms' ); ?>" value="<?php echo esc_attr( $social_pinterest ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_social_instagram( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $social_instagram = '';
        if (isset( $options['social_instagram']) ) {
            $social_instagram = $options['social_instagram'];
        }
    ?>
    <p>
        <input type="text" name="productive_forms_section_contact_options[social_instagram]" placeholder="<?php echo esc_html__( 'Start with http or https', 'productive-forms' ); ?>" value="<?php echo esc_attr( $social_instagram ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_icon_color_socialmedia( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_icon_color_socialmedia = '';
        if (isset( $options['contact_icon_color_socialmedia']) ) {
            $contact_icon_color_socialmedia = $options['contact_icon_color_socialmedia'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#076999" class="productive_input_color_picker" type="text" name="productive_forms_section_contact_options[contact_icon_color_socialmedia]" value="<?php echo esc_attr( $contact_icon_color_socialmedia ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
   <?php
}

function productive_forms_callback_contact_icon_color_use_default_socialmedia( $args ) {
        $options = productive_forms_get_section_contact_options_object();
        $contact_icon_color_use_default_socialmedia = '';
        if (isset( $options['contact_icon_color_use_default_socialmedia']) ) {
            $contact_icon_color_use_default_socialmedia = $options['contact_icon_color_use_default_socialmedia'];
        }
    ?>
    <p>
        <input id="productive_forms_section_contact_options[contact_icon_color_use_default_socialmedia]" type="checkbox" name="productive_forms_section_contact_options[contact_icon_color_use_default_socialmedia]" value="checked" <?php echo checked('checked', $contact_icon_color_use_default_socialmedia, false ); ?> />
        <label for="productive_forms_section_contact_options[contact_icon_color_use_default_socialmedia]"><?php echo esc_html__( 'Use the official colour of social media icons.', 'productive-forms' ); ?></label>
    </p>
    <p>
        <?php echo esc_html__( 'Tick this box to to ignore the selected colour for social media icons (above) and use official colours instead.', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_forms_callback_contact_show_social_media_on_contact_page() {
        $options = productive_forms_get_section_contact_options_object();
        $contact_show_social_media_on_contact_page = '';
        if (isset( $options['contact_show_social_media_on_contact_page']) ) {
            $contact_show_social_media_on_contact_page = $options['contact_show_social_media_on_contact_page'];
        }
    ?>
    <p>
        <input id="productive_forms_section_contact_options[contact_show_social_media_on_contact_page]" type="checkbox" name="productive_forms_section_contact_options[contact_show_social_media_on_contact_page]" value="checked" <?php echo checked('checked', $contact_show_social_media_on_contact_page, false ); ?> />
        <label for="productive_forms_section_contact_options[contact_show_social_media_on_contact_page]"><?php echo esc_html__( 'Show Social Media on Contact Us Page?', 'productive-forms' ); ?></label>
    </p>
   <?php
}




/**
 * 
 * @param type $args
 */
function productive_forms_callback_contact_divider_floating_buttons( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Floating Buttons', 'productive-forms' ) ?></h3>
   <?php
}

function productive_forms_callback_contact_what_to_display_in_floating_buttons( $args ) {        
        $options = productive_forms_get_section_contact_options_object();
        $productive_forms_options_item_value = 'select_an_option';
        if (isset( $options['what_to_display_in_floating_buttons']) ) {
            $productive_forms_options_item_value = $options['what_to_display_in_floating_buttons'];
        }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_forms_section_contact_options[what_to_display_in_floating_buttons]">
            <option value="select_an_option" <?php echo selected( $productive_forms_options_item_value, 'select_an_option', false ); ?>>
                <?php echo esc_html__( 'None', 'productive-forms' ); ?>
            </option>
            <option value="email_and_phone_only" <?php echo selected( $productive_forms_options_item_value, 'email_and_phone_only', false ); ?>>
                <?php echo esc_html__( 'Email and Phone', 'productive-forms' ); ?>
            </option>
            <option value="social_media_only" <?php echo selected( $productive_forms_options_item_value, 'social_media_only', false ); ?>>
               <?php echo esc_html__( 'Social Media', 'productive-forms' ); ?>
            </option>
            <option value="contact_form_button_only" <?php echo selected( $productive_forms_options_item_value, 'contact_form_button_only', false ); ?>>
                <?php echo esc_html__( 'Contact Form', 'productive-forms' ); ?>
            </option>
            <option value="newsletter_form_button_only" <?php echo selected( $productive_forms_options_item_value, 'newsletter_form_button_only', false ); ?>>
                <?php echo esc_html__( 'Newsletter Opt In', 'productive-forms' ); ?>
            </option>
            <option value="all_buttons" <?php echo selected( $productive_forms_options_item_value, 'all_buttons', false ); ?>>
                <?php echo esc_html__( 'Show All Buttons', 'productive-forms' ); ?>
            </option>
        </select>
        <p>
            <?php echo esc_html__( 'Select which icons to show in the floating buttons. None to disable Floating Buttons.', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_forms_callback_contact_floating_buttons_placement_vertical( $args ) {        
        $options = productive_forms_get_section_contact_options_object();
        $productive_forms_options_item_value = 'select_an_option';
        if (isset( $options['floating_buttons_placement_vertical']) ) {
            $productive_forms_options_item_value = $options['floating_buttons_placement_vertical'];
        }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_forms_section_contact_options[floating_buttons_placement_vertical]">
            <option value="select_an_option" <?php echo selected( $productive_forms_options_item_value, 'select_an_option', false ); ?>>
                <?php echo esc_html__( 'Select an Option', 'productive-forms' ); ?>
            </option>
            <option value="middle" <?php echo selected( $productive_forms_options_item_value, 'middle', false ); ?>>
               <?php echo esc_html__( 'Middle', 'productive-forms' ); ?>
            </option>
            <option value="bottom" <?php echo selected( $productive_forms_options_item_value, 'bottom', false ); ?>>
                <?php echo esc_html__( 'Bottom', 'productive-forms' ); ?>
            </option>
        </select>
        <p>
            <?php echo esc_html__( 'Vertical alignment of the floating buttons on screen.', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_forms_callback_contact_floating_buttons_placement_horizontal( $args ) {        
        $options = productive_forms_get_section_contact_options_object();
        $productive_forms_options_item_value = 'select_an_option';
        if (isset( $options['floating_buttons_placement_horizontal']) ) {
            $productive_forms_options_item_value = $options['floating_buttons_placement_horizontal'];
        }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_forms_section_contact_options[floating_buttons_placement_horizontal]">
            <option value="select_an_option" <?php echo selected( $productive_forms_options_item_value, 'select_an_option', false ); ?>>
                <?php echo esc_html__( 'Select an Option', 'productive-forms' ); ?>
            </option>
            <option value="left" <?php echo selected( $productive_forms_options_item_value, 'left', false ); ?>>
               <?php echo esc_html__( 'Left', 'productive-forms' ); ?>
            </option>
            <option value="right" <?php echo selected( $productive_forms_options_item_value, 'right', false ); ?>>
                <?php echo esc_html__( 'Right', 'productive-forms' ); ?>
            </option>
        </select>
        <p>
            <?php echo esc_html__( 'Horizontal alignment of the floating buttons on screen.', 'productive-forms' ); ?>
        </p>
    <?php
}

/* ============ END Section fields ================= */


function productive_forms_get_section_contact_options_object() {
    return get_option( 'productive_forms_section_contact_options' );
}


function productive_forms_register_section_contact_validate( $section_inputs ) {
    
    $validated_values = array();
    
    foreach ( $section_inputs as $key => $input ) {
        if ( isset($section_inputs[$key]) ) {
            if ( !empty( $section_inputs[$key] ) && $key === 'contact_email' && !is_email( $section_inputs[$key] ) ) {
                // Validate email address
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-email', esc_html( 'Invalid email address', 'productive-forms' ) );
            } else if ( $key === 'contact_phone' && !productive_forms_get_is_valid_phone_number( $section_inputs[$key], false ) ) {
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-phone', esc_html( 'Invalid Phone Number', 'productive-forms' ) );
            } else if ( $key === 'contact_whatsapp' && !productive_forms_get_is_valid_phone_number( $section_inputs[$key], false ) ) {
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-whatsapp', esc_html( 'Invalid WhatsApp Number', 'productive-forms' ) );
            } else if ( $key === 'contact_icon_color_addressinfo' && !productive_forms_validate_input_hex_color( $section_inputs[$key] ) ) {
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-color-phone', esc_html( 'Invalid Colour for Phone, Email and Location', 'productive-forms' ) );
            } else if ( $key === 'contact_icon_color_socialmedia' && !productive_forms_validate_input_hex_color( $section_inputs[$key] ) ) {
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-color-social', esc_html( 'Invalid Colour for Social Media Icons', 'productive-forms' ) );
            } else if ( !empty( $section_inputs[$key] ) && $key === 'social_facebook' && filter_var($section_inputs[$key], FILTER_VALIDATE_URL) === FALSE ) {
                // Validate Url
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-facebook-url', esc_html( 'Invalid Facebook Url', 'productive-forms' ) );
            } else if ( !empty( $section_inputs[$key] ) && $key === 'social_youtube' && filter_var($section_inputs[$key], FILTER_VALIDATE_URL) === FALSE ) {
                // Validate Url
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-youtube-url', esc_html( 'Invalid Youtube Url', 'productive-forms' ) );
            } else if ( !empty( $section_inputs[$key] ) && $key === 'social_twitter' && filter_var($section_inputs[$key], FILTER_VALIDATE_URL) === FALSE ) {
                // Validate Url
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-twitter-url', esc_html( 'Invalid Twitter Url', 'productive-forms' ) );
            } else if ( !empty( $section_inputs[$key] ) && $key === 'social_pinterest' && filter_var($section_inputs[$key], FILTER_VALIDATE_URL) === FALSE ) {
                // Validate Url
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-pinterest-url', esc_html( 'Invalid Pinterest Url', 'productive-forms' ) );
            } else if ( !empty( $section_inputs[$key] ) && $key === 'social_instagram' && filter_var($section_inputs[$key], FILTER_VALIDATE_URL) === FALSE ) {
                // Validate Url
                add_settings_error( 'productive_forms_section_contact_options', 'invalid-instagram-url', esc_html( 'Invalid Instagram Url', 'productive-forms' ) );
            } else if ( !empty( $section_inputs[$key] ) && $key === 'receiver_of_contact_email_messages' ) {
                if (productive_forms_get_is_validate_email_addresses( $section_inputs[$key] ) ) {
                    // Invalid email address exists
                    add_settings_error( 'productive_forms_section_contact_options', 'invalid-email-receipient', esc_html( 'A recipient email address is invalid', 'productive-forms' ) );
                } else {
                    $validated_values[$key] = productive_forms_get_validate_input_default($input);
                }
            } else {
                $validated_values[$key] = productive_forms_get_validate_input_default($input);
            }
            
        }
    }    
    return apply_filters('productive_forms_register_section_contact_validate', $validated_values, $section_inputs);
}


function productive_forms_section_contact_options_init_fields() {
    $default_contact_us_landing_page = get_option(PRODUCTIVE_FORMS_CONTACT_US_PAGE_DEFAULT_SLUG_VALUE);
    $contact_us_page_id = 0;
    if( !empty($default_contact_us_landing_page) ) {
        $contact_us_page = get_page_by_path($default_contact_us_landing_page);
        $contact_us_page_id = $contact_us_page->ID;
    }
    $default_fields_values = array(
        'productive_forms_contact_us_page'                          => $contact_us_page_id,
        'page_intro_1'                                              => esc_html( 'Complete the form below to email us your enquiry and we will respond shortly.', 'productive-forms' ),
        'contact_ask_for_visitor_phone'                             => 'checked',
        'copy_contactus_email_to_visitor'                           => '',
        'how_to_display_contact_name_field'                         => 'individual_fields',
        'how_to_process_contact_submissions'                        => 'save_only',
        'receiver_of_contact_email_messages'                        => '',
        'show_contact_field_labels'                                 => '',
        'consent_checkbox_text_contact'                             => esc_html( 'By using this form, you agree to processing and storing your personal data.', 'productive-forms' ),
        'contact_success_message'                           => esc_html( 'Message has been successfully submitted.', 'productive-forms' ),
        'contact_location_heading'                          => 'Our Address',
        'contact_email'                                     => 'email@example.com',
        'contact_phone_dial_code'                           => '+44',
        'contact_whatsapp_dial_code'                        => '+44',
        'contact_phone'                                     => '123 456 789',
        'contact_whatsapp'                                  => '123456789',
        'contact_address'                                   => '1 Westminster Road',
        'contact_whatsapp_usage'                            => 'phone_and_social_media',
        'contact_city'                                      => 'London',
        'contact_county'                                    => 'London',
        'contact_country'                                   => '',
        'contact_postcode'                                  => 'WC1 1AA',
        'contact_icon_color_addressinfo'                    => '#109100',
        'contact_show_email_phone_address_on_contact_page'  => 'checked',
        'contact_business_hours_heading'                    => 'Our Busines Opening Hours',
        'contact_business_hours_mon_fri'                    => '8am - 6pm (Mondays to Fridays)',
        'contact_business_hours_sat'                        => '10am - 5pm (Saturdays)',
        'contact_business_hours_sun'                        => 'We are closed on Sundays',
        'contact_show_business_hour_on_contact_page'        => 'checked',
        'social_facebook'                                   => 'https://www.facebook.com',
        'social_youtube'                                    => 'https://www.youtube.com',
        'social_twitter'                                    => 'https://www.twitter.com',
        'social_pinterest'                                  => 'https://www.pinterest.com',
        'social_instagram'                                  => '',
        'contact_show_social_media_on_contact_page'         => 'checked',
        'contact_icon_color_socialmedia'                    => '#1d6add',
        'contact_icon_color_use_default_socialmedia'        => 'checked',
        'what_to_display_in_floating_buttons'               => '',
        'floating_buttons_placement_vertical'               => '',
        'floating_buttons_placement_horizontal'             => '',
    );
    return apply_filters( 'productive_forms_section_contact_options_init_fields', $default_fields_values );
}




// Gets

/**
 * Method productive_forms_contact_us_page.
 */
function productive_forms_contact_us_page() {
    $options = productive_forms_get_section_contact_options_object();
    if ( isset( $options['productive_forms_contact_us_page'] )) {
        $option_value = sanitize_text_field( $options['productive_forms_contact_us_page'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_contact_us_page_url.
 */
function productive_forms_contact_us_page_url() {
    $contact_us_page_id = productive_forms_contact_us_page(); 
    $page_id = sanitize_text_field($contact_us_page_id);
    $url = get_permalink( $page_id );
    return trim( $url, '/' );
}

/**
 * Method productive_forms_contact_us_page_slug.
 */
function productive_forms_contact_us_page_slug() {
    $contact_us_page_id = productive_forms_contact_us_page(); 
    $post_slug = '';
    if( $contact_us_page_id ) {
        $post = get_post( $contact_us_page_id );
        if( null != $post && is_object( $post ) ) {
            $post_slug = $post->post_name;
        }
    }
    return trim( $post_slug );
}
