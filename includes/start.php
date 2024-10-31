<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die(); 
}

if( !function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

require_once plugin_dir_path( $productive_forms_plugin_main_file ) . 'global-settings.php';

$productive_forms_plugin_version_obj        = get_plugin_data( $productive_forms_plugin_main_file );
$productive_forms_plugin_version            = $productive_forms_plugin_version_obj['Version'];

$productiveminds_base_demo_url              = 'https://demo.productiveminds.com';
$productiveminds_base_support_url           = 'https://www.productiveminds.com/support';
$productiveminds_base_documentation_url     = 'https://www.productiveminds.com/support/docs';

$plugin_slug                    = $productive_forms_plugin_version_obj[ 'TextDomain' ];
$plugin_name                    = $productive_forms_plugin_version_obj[ 'Name' ];
$plugin_url                     = $productive_forms_plugin_version_obj[ 'PluginURI' ];
$author_name                    = $productive_forms_plugin_version_obj[ 'Author' ];
$author_url                     = $productive_forms_plugin_version_obj[ 'AuthorURI' ];
$plugin_demo_url                = $productiveminds_base_demo_url . '/' . $plugin_slug;
$plugin_support_url             = $productiveminds_base_support_url;
$plugin_documentation_url       = $productiveminds_base_documentation_url . '/' . $plugin_slug;
$plugin_review_on_repo_url      = 'https://wordpress.org/support/plugin' . '/' . $plugin_slug . '/reviews/';
$plugin_review_pro_url          = $author_url . '/product-reviews/' . $plugin_slug;
$plugin_download_from_repo_url  = 'https://downloads.wordpress.org/plugin' . '/' . $plugin_slug . 
        '.' . $productive_forms_plugin_version . '.zip';

define( 'PRODUCTIVE_FORMS_VERSION', $productive_forms_plugin_version );
define( 'PRODUCTIVE_FORMS_PLUGIN_DEVELOPER_NAME', 'productiveminds.com' );
define( 'PRODUCTIVE_FORMS_PLUGIN_DEVELOPER_WEBSITE', $author_url );
define( 'PRODUCTIVE_FORMS_CURRENT_PLUGIN_NAME', $plugin_name );
define( 'PRODUCTIVE_FORMS_PLUGIN_DEMO_URL', $plugin_demo_url );
define( 'PRODUCTIVE_FORMS_PLUGIN_SUPPORT_URL', $plugin_support_url );
define( 'PRODUCTIVE_FORMS_PLUGIN_DOCUMENTATION_URL', $plugin_documentation_url );
define( 'PRODUCTIVE_FORMS_PLUGIN_DOWNLOAD_FROM_REPO_URL', $plugin_download_from_repo_url );
define( 'PRODUCTIVE_FORMS_PLUGIN_REVIEW_ON_REPO_URL', $plugin_review_on_repo_url );
define( 'PRODUCTIVE_FORMS_PLUGIN_PRO_REVIEW_URL', $plugin_review_pro_url );
define( 'PRODUCTIVE_FORMS_PLUGIN_FEATURES_OR_BUY_URL', $plugin_url );
define( 'PRODUCTIVE_FORMS_HOMEPAGE_PLUGIN_ICON', PRODUCTIVE_FORMS_PLUGIN_URI . 'public/images/plugin-icon.webp' );
define( 'PRODUCTIVE_FORMS_PLACEHOLDER_IMAGE_POSTS', PRODUCTIVE_FORMS_PLUGIN_URI . 'public/images/posts-placeholder.webp' );


if( is_dir( PRODUCTIVE_FORMS_PLUGIN_PATH . 'extra' ) ) {
    require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'extra/includes/functions-extra.php';
} else {
    require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/standard/functions.php';
}


// Start main plugin activation
register_activation_hook( $productive_forms_plugin_main_file, 'productive_forms_activate');

// Start main plugin deactivation
register_deactivation_hook( $productive_forms_plugin_main_file, 'productive_forms_deactivate' );


// Transition easing & direction
$productive_forms_integration_popup_transition_easing = productive_forms_integration_popup_transition_easing();
$productive_forms_integration_popup_transition_direction = productive_forms_integration_popup_transition_direction();


/**
 * Method productive_forms_is_active.
 */
function productive_forms_is_active() {}

function productive_forms_is_extra() {
    return function_exists( 'productive_forms_extra_is_active' );
}


/**
 * Load (wp_enqueue_script) admin css * JS files.
 */
function productive_forms_admin_scripts() {
    
    global $productive_forms_plugin_version;
    
    // Admin Common assets
    if ( !function_exists( 'productiveminds_common_asset_admin') ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'productive_forms_admin_css', PRODUCTIVE_FORMS_PLUGIN_URI . 'admin/css/admin-style.css', array('wp-color-picker'), $productive_forms_plugin_version );
    
        require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/productiveminds-common-asset-admin.php';
    }
    wp_enqueue_script( 'productive_forms_admin_js_handle', PRODUCTIVE_FORMS_PLUGIN_URI . 'admin/js/admin-plugin.js', array('jquery','wp-color-picker'), $productive_forms_plugin_version, true );
    
    $admin_ajax_php_class = array(
        'ajax_admin_url' => admin_url( 'admin-ajax.php' ),
        'nonce' => wp_create_nonce('productive_forms_admin_scripts'),
        'msg_error_deleting_item' => __( 'Error deleting, please try again', 'productive-forms' ),
    );
    wp_localize_script(
    'productive_forms_admin_js_handle',
    'productive_forms_admin_js_url_name',
    $admin_ajax_php_class
    );   
}
if ( ( is_admin() && isset($_GET[ 'page' ]) ) && 
        ( $_GET[ 'page' ] === PRODUCTIVE_FORMS_ADMIN_OVERVIEW_REQUEST_URI || $_GET[ 'page' ] === PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI || $_GET[ 'page' ] === PRODUCTIVE_GLOBAL_ADMIN_PAGE_REQUEST_URI ) ) {
    add_action( 'admin_enqueue_scripts', 'productive_forms_admin_scripts' );
}


/**
 * Method enable featured image.
 */
function productive_forms_setup_plugin() {
    // initiate text-domain.
    load_plugin_textdomain( 'productive-forms', false, PRODUCTIVE_FORMS_PLUGIN_PATH . 'languages' );
}
// hook for productive_forms_setup_plugin.
add_action( 'init', 'productive_forms_setup_plugin' );


function productive_forms_add_action_links ( $actions ) {
   $settings_text = esc_html__( 'Settings', 'productive-forms' );
   $setting_page_uri = 'admin.php?page=' . PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI . '&tab=section_integration_options_tab';
   $plugin_action_links = array();
   $plugin_action_links[] = '<a href="' . esc_url( admin_url( $setting_page_uri ) ) . '">' . esc_html($settings_text) . '</a>';
   $action_links = array_merge( $actions, $plugin_action_links );
   return $action_links;
}
add_filter( 'plugin_action_links_' . plugin_basename($productive_forms_plugin_main_file), 'productive_forms_add_action_links' );


/**
 * Method productive_forms_get_attachment_by_thumbnail_id
 */
function productive_forms_get_attachment_by_thumbnail_id($attachment_id, $type = 'full') {
    $productive_forms_homepage_usp_image = PRODUCTIVE_FORMS_PLUGIN_URI . 'public/images/posts-placeholder.webp';
    if ( $attachment_id ) {
        $attachment_url = wp_get_attachment_url( $attachment_id, $type );
        if ( !empty( trim($attachment_url)) ) {
            $productive_forms_homepage_usp_image = $attachment_url;
        }
    }
    return $productive_forms_homepage_usp_image;
}

function productive_forms_get_attachment_by_thumbnail($attachment_id, $type = 'full') {
    $productive_forms_homepage_usp_image = PRODUCTIVE_FORMS_PLUGIN_URI . 'public/images/posts-placeholder.webp';
    ?>
        <img src="<?php echo esc_attr($productive_forms_homepage_usp_image); ?>" />
    <?php
}
add_action( 'display_plugin_placeholder_image', 'productive_forms_get_attachment_by_thumbnail' );


function productive_forms_apply_custom_css() {
    $css_settings = productive_forms_get_custom_css();
    $css =  '' .
        '.contact-us-page .addressinfo, .contact-info .addressinfo {
                fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_addressinfo'] ) . ';
        }.productive_widget_container .addressinfo {
                fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_addressinfo'] ) . ';
        }.productive_widget_container_content .addressinfo {
                fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_addressinfo'] ) . ';
        }.productive_widget_container_content .productive_widget_container .addressinfo {
                fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_addressinfo'] ) . ';
        }';
        
        $css .=  '' .
        '.header-header_contact_section-content-box, .header-header_contact_section-content-box span {
            color: ' . $css_settings['productive_forms_header_contact_section_text_color'] . ';
        }.header-header_contact_section-content-box a, .header-header_contact_section-content-box span a, .header-header_contact_section-content-box a span {
            color: ' . $css_settings['productive_forms_header_contact_section_hyperlink_color'] . ';
        }.header-header_contact_section-content-box a:hover, .header-header_contact_section-content-box span a:hover, .header-header_contact_section-content-box a:hover span {
            color: ' . $css_settings['productive_forms_header_contact_section_hyperlink_color_hover'] . ';
        }.header-header_contact_section-content-box a:hover svg path, .header-header_contact_section-content-box span a:hover svg path, .header-header_contact_section-content-box a:hover span svg path {
            fill: ' . $css_settings['productive_forms_header_contact_section_hyperlink_color_hover'] . ';
        }.header-header_contact_section-content-box .header_contact_section_contact_icon svg path {
            fill: ' . $css_settings['productive_forms_header_contact_section_icon_color'] . ';
        }.header-header_contact_section-content-box svg {
            width: ' . $css_settings['productive_forms_header_contact_section_icon_size'] . 'px;
            height: ' . $css_settings['productive_forms_header_contact_section_icon_size'] . 'px;
        }.site-body-container_box_full.header-header_contact_section-container {
            border-bottom: 1px solid ' . $css_settings['productive_forms_header_contact_section_border_color'] . ';
        }';
        
        $css .= 
        '.selected_color_as_icon_color .contact-and-address-container > div.contact-and-address-container-social-media a svg path {
            fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_socialmedia'] ) . ';
        }';
        
        if ( isset($css_settings['productive_forms_header_contact_section_use_official_sm_colours']) && 'selected_color_as_icon_color' == $css_settings['productive_forms_header_contact_section_use_official_sm_colours'] ) {
            $css .= '.header-header_contact_section-content-box .header_contact_section_contact_social_media_icon svg path {
                fill: ' . $css_settings['productive_forms_header_contact_section_icon_color'] . ';
            }';
        }
        
        if ( !$css_settings['is_on_productive_forms_contact_icon_color_use_default_socialmedia'] ) {
            $css .= 
            '.contact-us-page .plugin-social-media-icons {
                fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_socialmedia'] ) . ';
            }.productive_widget_container .plugin-social-media-icons {
                    fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_socialmedia'] ) . ';
            }.productive_widget_container_content .plugin-social-media-icons {
                    fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_socialmedia'] ) . ';
            }.productive_widget_container_content .productive_widget_container .plugin-social-media-icons {
                    fill: ' . esc_html( $css_settings['productive_forms_post_contact_icons_color_socialmedia'] ) . ';
            }';
        }
        
        if ( ! productive_forms_header_contact_section_bg_image() ) {
            $css .= '.site-body-container_box_full.header-header_contact_section-container {
                background: ' . $css_settings['productive_forms_header_contact_section_bg_color'] . ';
            }';
        }
        
        return trim($css);
}
function productive_forms_get_custom_css() {
    $css_settings = array();
    $css_settings['productive_forms_post_contact_icons_color_addressinfo'] = productive_forms_post_contact_icons_color_addressinfo();
    $css_settings['productive_forms_post_contact_icons_color_socialmedia'] = productive_forms_post_contact_icons_color_socialmedia();
    $css_settings['is_on_productive_forms_contact_icon_color_use_default_socialmedia']    = is_on_productive_forms_contact_icon_color_use_default_socialmedia();
    
    $css_settings['productive_forms_header_contact_section_icon_size']                  = productive_forms_header_contact_section_icon_size();
    $css_settings['productive_forms_header_contact_section_icon_color']                 = productive_forms_header_contact_section_icon_color();
    $css_settings['productive_forms_header_contact_section_use_official_sm_colours']    = productive_forms_header_contact_section_use_official_sm_colours();
    $css_settings['productive_forms_header_contact_section_text_color']                 = productive_forms_header_contact_section_text_color();
    $css_settings['productive_forms_header_contact_section_hyperlink_color']            = productive_forms_header_contact_section_hyperlink_color();
    $css_settings['productive_forms_header_contact_section_hyperlink_color_hover']      = productive_forms_header_contact_section_hyperlink_color_hover();
    $css_settings['productive_forms_header_contact_section_border_color']               = productive_forms_header_contact_section_border_color();
    $css_settings['productive_forms_header_contact_section_bg_color']                   = productive_forms_header_contact_section_bg_color();
    
    return $css_settings;
}
