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
    
    $asset_file = include( PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/standard/gutenberg/blocks/contact-page/build/index.asset.php');
    
    wp_register_script(
        'productive-forms-contact-page-script',
        PRODUCTIVE_FORMS_PLUGIN_URI . 'includes/standard/gutenberg/blocks/contact-page/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-forms-contact-page-style',
        PRODUCTIVE_FORMS_PLUGIN_URI . 'includes/standard/gutenberg/blocks/contact-page/build/style-index.css',
        array(),
        $productive_forms_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/standard/gutenberg/blocks/contact-page/build';
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
        'is_formonly'                                           => intval( $attributes['is_formonly'] ),
        'section_gtbg_align'                                    => '',
        'slider_swiper_css_class_from_elementor'                => 'via_std via_gutenberg',
    );
    
    $section_bg_color_scheme        = 'productive-paddable-section page_main_section_container ' . $section_gtbg_align;
    
    ob_start();
    
    do_action( 'display_content_wrapper_full_full_top', $section_bg_color_scheme );
        do_action('display_content_wrapper_full_top');
            productive_forms_contact_form( $cpt_section_args );
        do_action('display_content_wrapper_full_bottom');
    do_action('display_content_wrapper_full_full_bottom');
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
