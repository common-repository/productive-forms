<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
    die();
}


if ( !function_exists( 'productive_gutenberg_add_block_category' ) ) {
    /**
     * Register a new Gutenberg Category for listing ProductiveMinds' Gutenberg Blocks
     * @param array $categories
     * @param WP_Block_Editor_Context $block_editor_context
     */
    function productive_gutenberg_add_block_category( $categories, $block_editor_context ) {
        return array_merge(
            array(
                array(
                    'slug'  => 'productiveminds',
                    'title' => __( 'ProductiveMinds', 'productive-forms' ),
                    //'icon'  => ''
                ),
            ),
            $categories,
        );
    }
    
    if ( version_compare( get_bloginfo('version'), '5.8.0', '>=' ) ) {
        add_filter( 'block_categories_all', 'productive_gutenberg_add_block_category', 10, 2 );
    } else {
        add_filter( 'block_categories', 'productive_gutenberg_add_block_category', 10, 2 );
    }
}



require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/contact-page/render.php';
require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/newsletter-element/render.php';

if( productive_global_is_a_productive_extra_theme() ) {
    require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/gutenberg/blocks/google-map/render.php';
}
