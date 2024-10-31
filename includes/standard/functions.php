<?php
/**
 *
 * @package productive-forms
 */

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/db/db_install.php';
require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/db/db_upgrade.php';
require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/db/db_transactions.php';
require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/activate.php';
require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/deactivate.php';

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/standard/options/settings.php'; 

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/helper/productive-email.php';

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/functions-options.php';

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/productive-plugin-customiser.php';
require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/module/header-contact-section.php';

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/render/partials/productive-render-functions-common.php';

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/render/productive-render-contact-us-page.php';
require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/render/productive-render-newsletter-element.php';

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/standard/gutenberg/productive-gutenberg.php';


/**
 * Method productive_forms_scripts.
 */
function productive_forms_scripts() {
    global $productive_forms_plugin_version;
    $productiveminds_global_localize_script_vars = array();
    
    // Swiper
    if ( !function_exists( 'productiveminds_library_swiper') ) {
        wp_enqueue_style( 'productiveminds_library_swiper_css', PRODUCTIVE_FORMS_PLUGIN_URI . 'libraries/swiper/11-0-7/swiper-bundle.min.css', array(), $productive_forms_plugin_version );
        wp_enqueue_script( 'productiveminds_library_swiper_js', PRODUCTIVE_FORMS_PLUGIN_URI . 'libraries/swiper/11-0-7/swiper-bundle.min.js', array(), $productive_forms_plugin_version, true );

        require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'libraries/swiper/productiveminds-library-swiper.php';
    }
    
    // Common assets
    if ( !function_exists( 'productiveminds_common_asset') ) {
        
        wp_enqueue_style( 'productiveminds_common_css', PRODUCTIVE_FORMS_PLUGIN_URI . 'public/css/productiveminds-common-css.min.css', array(), $productive_forms_plugin_version );
        wp_style_add_data( 'productiveminds_common_css', 'rtl', 'replace' );
        
        wp_enqueue_script( 'productiveminds_common_js_handle', PRODUCTIVE_FORMS_PLUGIN_URI . 'public/js/productiveminds-common-js.min.js', array( 'productiveminds_library_swiper_js' ), $productive_forms_plugin_version, true );
        
        productive_global_get_common_swiper_localize_script( $productiveminds_global_localize_script_vars );
        // Assign others
        productive_global_get_common_std_localize_script( $productiveminds_global_localize_script_vars );
        wp_localize_script(
            'productiveminds_common_js_handle',
            'productiveminds_common_js_name',
            $productiveminds_global_localize_script_vars
            );
        
        $custom_css_global = productive_global_apply_custom_css();
        wp_add_inline_style('productiveminds_common_css', $custom_css_global);
        
        require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/productiveminds-common-asset.php';
    }
    
    wp_enqueue_style( 'productive_forms_style', PRODUCTIVE_FORMS_PLUGIN_URI . 'public/css/style.bundle.min.css', array(), $productive_forms_plugin_version );
    wp_style_add_data( 'productive_forms_style', 'rtl', 'replace' );
    
    $custom_css = productive_forms_apply_custom_css();
    wp_add_inline_style('productive_forms_style', $custom_css);
    
    $recaptcha_site_key = '';
    if( !empty(productive_forms_integration_recaptcha_key()) && !empty(productive_forms_integration_recaptcha_secret()) ) {       
        $recaptcha_site_key = productive_forms_integration_recaptcha_key();
        wp_enqueue_script( 'productive_forms_recaptcha_js', 'https://www.google.com/recaptcha/api.js?render='.$recaptcha_site_key, array(), $productive_forms_plugin_version, true );
    }
    
    wp_enqueue_script( 'productive_forms_js_url_handle', PRODUCTIVE_FORMS_PLUGIN_URI . 'public/js/plugin.min.js', array(), $productive_forms_plugin_version, true );
    $wp_localize_script_values_std_plugin_js_handle = array(
        'ajax_admin_url'        => admin_url( 'admin-ajax.php' ),
        'nonce'                 => wp_create_nonce('productive_forms_scripts'),
        'msg_recaptcha_site_key' => $recaptcha_site_key,
        'msg_error_add_name' => __( 'Please enter your name, then try again.', 'productive-forms' ),
        'msg_error_add_first_name' => __( 'Please enter your first name, then try again.', 'productive-forms' ),
        'msg_error_add_last_name' => __( 'Please enter your last name, then try again.', 'productive-forms' ),
        'msg_error_add_email' => __( 'Please enter a valid email address, then try again.', 'productive-forms' ),
        'msg_error_add_phone' => __( 'Add a valid phone number, then try again.', 'productive-forms' ),
        'msg_error_add_message' => __( 'Add message, then try again.', 'productive-forms' ),
        'msg_error_add_consent' => __( 'Please check the box to agree to the personal data terms, and then try again.', 'productive-forms' ),
        'msg_error_add_maths_challenge' => __( 'Please provide the correct answer to the math challenge, then try again.', 'productive-forms' ),
    );
    wp_localize_script(
        'productive_forms_js_url_handle',
        'productive_forms_js_url_handle_name',
        $wp_localize_script_values_std_plugin_js_handle
    );
    
}
if ( !is_admin() ) {
    add_action( 'wp_enqueue_scripts', 'productive_forms_scripts', 72 );
} else if ( is_admin() ) {
    global $pagenow;
    if( productive_global_is_block_editor_active() && 
            ( 'post.php' == $pagenow || 'post-new.php' == $pagenow || 'comment.php' == $pagenow ) ) {
        add_action( 'admin_enqueue_scripts', 'productive_forms_scripts', 72 );
    }
}

