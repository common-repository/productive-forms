<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_forms_register_blocks_init_action_contact_page() {
    productive_forms_register_block_init_contact_page();
}
add_action( 'init', 'productive_forms_register_blocks_init_action_contact_page' );


function productive_forms_register_block_init_contact_page() {
    
    global $productive_forms_plugin_version;
    
    $asset_file = include( PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/contact-page/build/index.asset.php');
    
    wp_register_script(
        'productive-forms-contact-page-script',
        PRODUCTIVE_FORMS_PLUGIN_URI . 'includes/common/gutenberg/blocks/contact-page/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-forms-contact-page-style',
        PRODUCTIVE_FORMS_PLUGIN_URI . 'includes/common/gutenberg/blocks/contact-page/build/style-index.css',
        array(),
        $productive_forms_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/contact-page/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_forms_plugin_version,
        'render_callback' => 'productive_forms_register_block_render_callback_contact_page',
        'editor_script' => 'productive-forms-contact-page-script',
        'style' => 'productive-forms-contact-page-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_forms_register_block_render_callback_contact_page( $attributes, $content ) {
    
    foreach ($attributes as $key => $attribute) {
        if( 'true' == $attribute ) {
            $attributes[$key] = '1';
        } else if( 'false' == $attribute ) {
            $attributes[$key] = '0';
        } else if( 'align' == $key && 'full' == $attribute ) {
            $attributes[$key] = 'alignfull';
        } else if( 'align' == $key && 'wide' == $attribute ) {
            $attributes[$key] = 'alignwide';
        }
    }
    
    $section_gtbg_align = '';
    if( isset($attributes['align']) ) {
        $section_gtbg_align = $attributes['align'];
    }
    
    $cpt_section_args = array(
        'section_initiator'                                     => 'std gtbg',
        'productive_forms_contact_side'                         => $attributes['productive_forms_contact_side'],
        'is_formonly'                                           => $attributes['is_formonly'],
        'display_contact_form_label'                            => $attributes['display_contact_form_label'],
        'contact_how_to_display_contact_name_field'             => $attributes['contact_how_to_display_contact_name_field'],
        'contact_ask_for_visitor_phone'                         => $attributes['contact_ask_for_visitor_phone'],
        'request_data_privacy_consent'                          => $attributes['request_data_privacy_consent'],
        'submission_verify_type'                                => $attributes['submission_verify_type'],
        'section_title'                                         => $attributes['section_title'],
        'section_title_html_tag'                                => $attributes['section_title_html_tag'],
        'section_intro'                                         => $attributes['section_intro'],
        'section_header_alignment'                              => $attributes['section_header_alignment'],
        'display_contact_email_address'                         => $attributes['display_contact_email_address'],
        'display_contact_phone_number'                          => $attributes['display_contact_phone_number'],
        'display_contact_whatsapp_number'                       => $attributes['display_contact_whatsapp_number'],
        'display_contact_location'                              => $attributes['display_contact_location'],
        'display_contact_opening_hours'                         => $attributes['display_contact_opening_hours'],
        'display_contact_social_media_icons'                    => $attributes['display_contact_social_media_icons'],
        'display_contact_social_media_icons_title'              => $attributes['display_contact_social_media_icons_title'],
        'productive_forms_form_submit_text'                     => $attributes['productive_forms_form_submit_text'],
        'section_gtbg_align'                                    => '',
        'slider_swiper_css_class_from_elementor'                => 'via_std via_gutenberg',
    );
    
    $section_bg_color_scheme        = 'productive-paddable-section page_main_section_container ' . $section_gtbg_align 
        . ' ' . $attributes['section_bg_color_scheme'] . ' ' . $attributes['section_block_max_width'] . ' ' . $attributes['section_block_spacing'];
    
    $section_content_show_url_button_shape = '';
    if( isset($attributes['section_content_show_url_button_shape']) ) {
        $section_content_show_url_button_shape = $attributes['section_content_show_url_button_shape'];
    }
    $section_content_show_url_button_width = '';
    if( isset($attributes['section_content_show_url_button_width']) ) {
        $section_content_show_url_button_width = $attributes['section_content_show_url_button_width'];
    }
    $display_contact_social_media_icons_style = '';
    if( isset($attributes['display_contact_social_media_icons_style']) ) {
        $display_contact_social_media_icons_style = $attributes['display_contact_social_media_icons_style'];
    }
    $section_content_items_css_classes = ' ' . $section_content_show_url_button_shape . ' ' . 
        $display_contact_social_media_icons_style . ' ' . $section_content_show_url_button_width;
    
    ob_start();
    
    do_action( 'display_content_wrapper_full_full_top', $section_bg_color_scheme );
        do_action( 'display_content_wrapper_full_top', $section_content_items_css_classes );
            productive_forms_render_contact_us_page( $cpt_section_args );
        do_action('display_content_wrapper_full_bottom');
    do_action('display_content_wrapper_full_full_bottom');
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
