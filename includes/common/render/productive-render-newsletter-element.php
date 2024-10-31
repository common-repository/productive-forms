<?php
/**
 * @package     productive-forms
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/

function productive_forms_render_newsletter_element( $cpt_section_args ) {
    
    $section_content_header_is_show_section_header = 1;
    $section_title = productive_forms_newsletter_heading();
    $section_title_html_tag = 'h2';
    $section_intro = productive_forms_newsletter_intro();
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
    <div class="productiveminds_section newsletter-element <?php echo esc_attr( $section_content_wrap_in_small_screen ); ?> <?php echo esc_attr( $productiveminds_section_display ); ?> <?php echo esc_attr( $section_initiator ); ?> <?php echo esc_attr( $section_gtbg_align ); ?>" id="<?php echo esc_attr( $section_content_settings_unique_id ); ?>">
        <div class="productiveminds_section_uno">
    <?php
    
    // Header
    if ( $section_content_header_is_show_section_header ) {
        productive_forms_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment );
    }
    
    $productive_forms_form_submit_text = __('Send', 'productive-forms');
    $productive_forms_form_footnote_text = '';
    $productive_forms_newsletter_form_style = 'landscape';
    $display_email_field_only = 0;
    $display_contact_form_label = is_on_productive_forms_newsletter_show_newsletter_field_labels();
    $section_style_content_button_hover_animation = '';
    $newsletter_how_to_display_contact_name_field = productive_forms_newsletter_how_to_display_newsletter_name_field();
    $request_data_privacy_consent = 1;
    $submission_verify_type = 'discreet';
    $slider_swiper_css_class_from_elementor = 'via_std';

    if ( isset( $cpt_section_args['productive_forms_newsletter_form_style'] ) ) {
        $productive_forms_newsletter_form_style = $cpt_section_args['productive_forms_newsletter_form_style'];
    }
    if ( isset( $cpt_section_args['productive_forms_form_submit_text'] ) ) {
        $productive_forms_form_submit_text = $cpt_section_args['productive_forms_form_submit_text'];
    }
    if ( isset( $cpt_section_args['productive_forms_form_footnote_text'] ) ) {
        $productive_forms_form_footnote_text = $cpt_section_args['productive_forms_form_footnote_text'];
    }
    if ( isset( $cpt_section_args['display_email_field_only'] ) ) {
        $display_email_field_only = intval( $cpt_section_args['display_email_field_only'] );
    }
    if ( isset( $cpt_section_args['display_contact_form_label'] ) ) {
        $display_contact_form_label = intval($cpt_section_args['display_contact_form_label']);
    }
    if ( isset( $cpt_section_args['section_style_content_button_hover_animation'] ) ) {
        $section_style_content_button_hover_animation = $cpt_section_args['section_style_content_button_hover_animation'];
    }
    if ( isset( $cpt_section_args['newsletter_how_to_display_contact_name_field'] ) ) {
        $newsletter_how_to_display_contact_name_field = $cpt_section_args['newsletter_how_to_display_contact_name_field'];
    }
    if ( isset( $cpt_section_args['request_data_privacy_consent'] ) ) {
        $request_data_privacy_consent = intval( $cpt_section_args['request_data_privacy_consent'] );
    }
    if ( isset( $cpt_section_args['submission_verify_type'] ) ) {
        $submission_verify_type = $cpt_section_args['submission_verify_type'];
    }
    if ( isset( $cpt_section_args['slider_swiper_css_class_from_elementor'] ) ) {
        $slider_swiper_css_class_from_elementor = $cpt_section_args['slider_swiper_css_class_from_elementor'];
    }
    
    $form_unique_id = mt_rand(1, 100);
    
    $misc = array(
        'form_unique_id'                                        => $form_unique_id,
        'display_email_field_only'                              => $display_email_field_only,
        'display_contact_form_label'                            => $display_contact_form_label,
        'section_style_content_button_hover_animation'          => $section_style_content_button_hover_animation,
        'newsletter_how_to_display_contact_name_field'          => $newsletter_how_to_display_contact_name_field,
        'request_data_privacy_consent'                          => $request_data_privacy_consent,
        'submission_verify_type'                                => $submission_verify_type,
        'productive_forms_form_submit_text'                     => $productive_forms_form_submit_text,
        'productive_forms_form_footnote_text'                   => $productive_forms_form_footnote_text,
    );
    
    if ( $productive_forms_newsletter_form_style === 'landscape' ) {
        productive_forms_newsletter_form_in_landscape_ajax( $misc ); 
    } else if ( $productive_forms_newsletter_form_style === 'portrait') {
        productive_forms_newsletter_form_in_portrait_ajax( $misc );
    }

    ?>
        </div><!-- productiveminds_section_uno -->
    </div><!-- productiveminds_section -->
    <?php
}

function productive_forms_render_newsletter_portrait_with_shortcode() {
    $cpt_section_args = array(
        'productive_forms_newsletter_form_style'       => 'portrait',
    );
    productive_forms_render_newsletter_element( $cpt_section_args );
}
add_shortcode('productive_newsletter_form', 'productive_forms_render_newsletter_portrait_with_shortcode');
add_shortcode('productive_newsletter_form_ajax', 'productive_forms_render_newsletter_portrait_with_shortcode');

function productive_forms_render_newsletter_landscape_with_shortcode() {
    $cpt_section_args = array(
        'productive_forms_newsletter_form_style'       => 'landscape',
    );
    productive_forms_render_newsletter_element( $cpt_section_args );
}
add_shortcode('productive_newsletter_form_landscape', 'productive_forms_render_newsletter_landscape_with_shortcode');
add_shortcode('productive_newsletter_form_ajax_landscape', 'productive_forms_render_newsletter_landscape_with_shortcode');