<?php
/**
 * @package     productive-forms
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/

function productive_forms_render_contact_us_page( $cpt_section_args ) {
    
    $section_content_header_is_show_section_header = 1;
    $section_title = __('Message Us', 'productive-forms');
    $section_title_html_tag = 'h2';
    $section_intro = __('Please provide a description here. Leave both the title and description fields empty to hide the header.', 'productive-forms');
    $section_header_alignment = '';
    $section_content_settings_unique_id = 'section_content_unique_id_'. rand();
    $section_initiator = 'std';
    $section_gtbg_align = '';
    $section_content_wrap_in_small_screen = 'wrap_to_one_column_in_small_screen';
    
    if ( isset( $cpt_section_args['section_content_header_is_show_section_header'] ) ) {
        $section_content_header_is_show_section_header = $cpt_section_args['section_content_header_is_show_section_header'];
    }
    if ( isset( $cpt_section_args['section_title'] ) ) {
        $section_title = $cpt_section_args['section_title'];
    }
    if ( isset( $cpt_section_args['section_title_html_tag'] ) ) {
        $section_title_html_tag = $cpt_section_args['section_title_html_tag'];
    }
    if ( isset( $cpt_section_args['section_intro'] ) ) {
        $section_intro = $cpt_section_args['section_intro'];
    }
    if ( isset( $cpt_section_args['section_header_alignment'] ) ) {
        $section_header_alignment = $cpt_section_args['section_header_alignment'];
    }
    if ( isset( $cpt_section_args['section_content_settings_unique_id'] ) ) {
        $section_content_settings_unique_id = $cpt_section_args['section_content_settings_unique_id'];
    }
    if ( isset( $cpt_section_args['section_initiator'] ) ) {
        $section_initiator = $cpt_section_args['section_initiator'];
    }
    if ( isset( $cpt_section_args['section_gtbg_align'] ) ) {
        $section_gtbg_align = $cpt_section_args['section_gtbg_align'];
    }
    if ( isset( $cpt_section_args['section_content_wrap_in_small_screen'] ) ) {
        $section_content_wrap_in_small_screen = $cpt_section_args['section_content_wrap_in_small_screen'];
    }
    $productiveminds_section_display = 'grided';
    ?>
    <div class="productiveminds_section contact-us-page <?php echo esc_attr( $section_content_wrap_in_small_screen ); ?> <?php echo esc_attr( $productiveminds_section_display ); ?> <?php echo esc_attr( $section_initiator ); ?> <?php echo esc_attr( $section_gtbg_align ); ?>" id="<?php echo esc_attr( $section_content_settings_unique_id ); ?>">
        <div class="productiveminds_section_uno">
    <?php
    
    // Header
    if ( $section_content_header_is_show_section_header ) {
        productive_forms_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment );
    }
    
    $is_formonly = 0;
    $productive_forms_form_submit_text = __('Send', 'productive-forms');
    $productive_forms_contact_side = 'contact_form_on_left';
    $display_contact_form_label = 0;
    $section_style_content_button_hover_animation = '';
    $contact_how_to_display_contact_name_field = 'combined_field';
    $contact_ask_for_visitor_phone = 0;
    $request_data_privacy_consent = 1;
    $submission_verify_type = 'discreet';
    $display_contact_email_address = 1;
    $display_contact_phone_number = 1;
    $display_contact_whatsapp_number = 1;
    $display_contact_location = 1;
    $display_contact_opening_hours = 1;
    $display_contact_social_media_icons = 1;
    $display_contact_social_media_icons_title = __('Follow us on', 'productive-forms');
    $slider_swiper_css_class_from_elementor = 'via_std';

    if ( isset( $cpt_section_args['is_formonly'] ) ) {
        $is_formonly = intval( $cpt_section_args['is_formonly'] );
    }
    if ( isset( $cpt_section_args['productive_forms_form_submit_text'] ) ) {
        $productive_forms_form_submit_text = $cpt_section_args['productive_forms_form_submit_text'];
    }
    if ( isset( $cpt_section_args['productive_forms_contact_side'] ) ) {
        $productive_forms_contact_side = $cpt_section_args['productive_forms_contact_side'];
    }
    if ( isset( $cpt_section_args['display_contact_form_label'] ) ) {
        $display_contact_form_label = $cpt_section_args['display_contact_form_label'];
    }
    if ( isset( $cpt_section_args['section_style_content_button_hover_animation'] ) ) {
        $section_style_content_button_hover_animation = $cpt_section_args['section_style_content_button_hover_animation'];
    }
    if ( isset( $cpt_section_args['contact_how_to_display_contact_name_field'] ) ) {
        $contact_how_to_display_contact_name_field = $cpt_section_args['contact_how_to_display_contact_name_field'];
    }
    if ( isset( $cpt_section_args['contact_ask_for_visitor_phone'] ) ) {
        $contact_ask_for_visitor_phone = intval( $cpt_section_args['contact_ask_for_visitor_phone'] );
    }
    if ( isset( $cpt_section_args['request_data_privacy_consent'] ) ) {
        $request_data_privacy_consent = intval( $cpt_section_args['request_data_privacy_consent'] );
    }
    if ( isset( $cpt_section_args['submission_verify_type'] ) ) {
        $submission_verify_type = $cpt_section_args['submission_verify_type'];
    }
    if ( isset( $cpt_section_args['display_contact_email_address'] ) ) {
        $display_contact_email_address = intval( $cpt_section_args['display_contact_email_address'] );
    }
    if ( isset( $cpt_section_args['display_contact_phone_number'] ) ) {
        $display_contact_phone_number = intval( $cpt_section_args['display_contact_phone_number'] );
    }
    if ( isset( $cpt_section_args['display_contact_whatsapp_number'] ) ) {
        $display_contact_whatsapp_number = intval( $cpt_section_args['display_contact_whatsapp_number'] );
    }
    if ( isset( $cpt_section_args['display_contact_location'] ) ) {
        $display_contact_location = intval( $cpt_section_args['display_contact_location'] );
    }
    if ( isset( $cpt_section_args['display_contact_opening_hours'] ) ) {
        $display_contact_opening_hours = intval( $cpt_section_args['display_contact_opening_hours'] );
    }
    if ( isset( $cpt_section_args['display_contact_social_media_icons'] ) ) {
        $display_contact_social_media_icons = intval( $cpt_section_args['display_contact_social_media_icons'] );
    }
    if ( isset( $cpt_section_args['display_contact_social_media_icons_title'] ) ) {
        $display_contact_social_media_icons_title = $cpt_section_args['display_contact_social_media_icons_title'];
    }
    if ( isset( $cpt_section_args['slider_swiper_css_class_from_elementor'] ) ) {
        $slider_swiper_css_class_from_elementor = $cpt_section_args['slider_swiper_css_class_from_elementor'];
    }
    
    $form_unique_id = mt_rand(1, 100);
    
    $misc = array(
        'form_unique_id'                                        => $form_unique_id,
        'productive_forms_contact_side'                         => $productive_forms_contact_side,
        'productive_forms_form_submit_text'                     => $productive_forms_form_submit_text,
        'is_formonly'                                           => $is_formonly,
        'display_contact_form_label'                            => $display_contact_form_label,
        'section_style_content_button_hover_animation'          => $section_style_content_button_hover_animation,
        'contact_how_to_display_contact_name_field'             => $contact_how_to_display_contact_name_field,
        'contact_ask_for_visitor_phone'                         => $contact_ask_for_visitor_phone,
        'request_data_privacy_consent'                          => $request_data_privacy_consent,
        'submission_verify_type'                                => $submission_verify_type,
        'display_contact_email_address'                         => $display_contact_email_address,
        'display_contact_phone_number'                          => $display_contact_phone_number,
        'display_contact_whatsapp_number'                       => $display_contact_whatsapp_number,
        'display_contact_location'                              => $display_contact_location,
        'display_contact_opening_hours'                         => $display_contact_opening_hours,
        'display_contact_social_media_icons'                    => $display_contact_social_media_icons,
        'display_contact_social_media_icons_title'              => $display_contact_social_media_icons_title,
    );

    productive_forms_render_contact_us_page_content( $misc );

    ?>
        </div><!-- productiveminds_section_uno -->
    </div><!-- productiveminds_section -->
    <?php
}


function productive_forms_render_contact_form_with_shortcode() {
    $cpt_section_args = array(
        'is_formonly'       => 1,
    );
    productive_forms_render_contact_us_page( $cpt_section_args );
}
add_shortcode('productive_contact_form', 'productive_forms_render_contact_form_with_shortcode');
add_shortcode('productive_contact_form_ajax', 'productive_forms_render_contact_form_with_shortcode');

function productive_forms_render_contact_us_page_with_shortcode() {
    $cpt_section_args = array(
        'is_formonly'       => 0,
    );
    productive_forms_render_contact_us_page( $cpt_section_args );
}
add_shortcode('productive_contact_page', 'productive_forms_render_contact_us_page_with_shortcode');
add_shortcode('productive_contact_page_ajax', 'productive_forms_render_contact_us_page_with_shortcode');
