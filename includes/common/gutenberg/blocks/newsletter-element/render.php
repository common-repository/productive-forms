<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_forms_register_blocks_init_action_newsletter_element() {
    productive_forms_register_block_init_newsletter_element();
}
add_action( 'init', 'productive_forms_register_blocks_init_action_newsletter_element' );


function productive_forms_register_block_init_newsletter_element() {
    
    global $productive_forms_plugin_version;
    
    $asset_file = include( PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/newsletter-element/build/index.asset.php');
    
    wp_register_script(
        'productive-forms-newsletter-element-script',
        PRODUCTIVE_FORMS_PLUGIN_URI . 'includes/common/gutenberg/blocks/newsletter-element/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-forms-newsletter-element-style',
        PRODUCTIVE_FORMS_PLUGIN_URI . 'includes/common/gutenberg/blocks/newsletter-element/build/style-index.css',
        array(),
        $productive_forms_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/newsletter-element/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_forms_plugin_version,
        'render_callback' => 'productive_forms_register_block_render_callback_newsletter_element',
        'editor_script' => 'productive-forms-newsletter-element-script',
        'style' => 'productive-forms-newsletter-element-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_forms_register_block_render_callback_newsletter_element( $attributes, $content ) {
    
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
        'productive_forms_newsletter_form_style'                => $attributes['productive_forms_newsletter_form_style'],
        'productive_forms_form_submit_text'                     => $attributes['productive_forms_form_submit_text'],
        'productive_forms_form_footnote_text'                   => $attributes['productive_forms_form_footnote_text'],
        'display_email_field_only'                              => $attributes['display_email_field_only'],
        'display_contact_form_label'                            => $attributes['display_contact_form_label'],
        'newsletter_how_to_display_contact_name_field'          => $attributes['newsletter_how_to_display_contact_name_field'],
        'request_data_privacy_consent'                          => $attributes['request_data_privacy_consent'],
        'submission_verify_type'                                => $attributes['submission_verify_type'],
        'section_title'                                         => $attributes['section_title'],
        'section_title_html_tag'                                => $attributes['section_title_html_tag'],
        'section_intro'                                         => $attributes['section_intro'],
        'section_header_alignment'                              => $attributes['section_header_alignment'],
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
    $section_content_items_css_classes = ' ' . $section_content_show_url_button_shape . ' ' . $section_content_show_url_button_width;
    
    ob_start();
    
    do_action( 'display_content_wrapper_full_full_top', $section_bg_color_scheme );
        do_action( 'display_content_wrapper_full_top', $section_content_items_css_classes );
            productive_forms_render_newsletter_element( $cpt_section_args );
        do_action('display_content_wrapper_full_bottom');
    do_action('display_content_wrapper_full_full_bottom');
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
