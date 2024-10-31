<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
    die();
}


function productive_forms_register_blocks_init_action_google_map() {
    productive_forms_register_block_init_google_map();
}
add_action( 'init', 'productive_forms_register_blocks_init_action_google_map' );


function productive_forms_register_block_init_google_map() {
    
    global $productive_forms_plugin_version;
    
    $asset_file = include( PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/google-map/build/index.asset.php');
    
    wp_register_script(
        'productive-forms-google-map-script',
        PRODUCTIVE_FORMS_PLUGIN_URI . 'includes/common/gutenberg/blocks/google-map/build/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
    );
    
    wp_register_style(
        'productive-forms-google-map-style',
        PRODUCTIVE_FORMS_PLUGIN_URI . 'includes/common/gutenberg/blocks/google-map/build/style-index.css',
        array(),
        $productive_forms_plugin_version
    );
    
    $block_metadata = PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/google-map/build';
    $args = array(
        'api_version' => 3,
        'version' => $productive_forms_plugin_version,
        'render_callback' => 'productive_forms_register_block_render_callback_google_map',
        'editor_script' => 'productive-forms-google-map-script',
        'style' => 'productive-forms-google-map-style',
    );
    register_block_type( $block_metadata, $args );
}
function productive_forms_register_block_render_callback_google_map( $attributes, $content ) {
    
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
        'section_gtbg_align'                                    => '',
        'section_title'                                         => $attributes['section_title'],
        'section_title_html_tag'                                => $attributes['section_title_html_tag'],
        'section_intro'                                         => $attributes['section_intro'],
        'section_header_alignment'                              => $attributes['section_header_alignment'],
        'google_map_container_width'                            => $attributes['google_map_container_width'],
        'google_map_container_height'                           => $attributes['google_map_container_height'],
        'google_map_map_magnification'                          => $attributes['google_map_map_magnification'],
        'google_map_display_physical_address'                   => $attributes['google_map_display_physical_address'],
        'slider_swiper_css_class_from_elementor'                => 'via_std via_gutenberg',
    );
    
    $section_bg_color_scheme        = 'productive-paddable-section page_main_section_container ' . $section_gtbg_align 
        . ' ' . $attributes['section_bg_color_scheme'] . ' ' . $attributes['section_block_max_width'] . ' ' . $attributes['section_block_spacing'];
    
    ob_start();
    
    do_action( 'display_content_wrapper_full_full_top', $section_bg_color_scheme );
        do_action('display_content_wrapper_full_top');
            productive_forms_render_google_map( $cpt_section_args );
        do_action('display_content_wrapper_full_bottom');
    do_action('display_content_wrapper_full_full_bottom');
    
    $content_to_render = ob_get_clean();
    
    return $content_to_render; 
    
}
