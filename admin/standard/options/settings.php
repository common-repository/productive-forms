<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

require PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/validate-verify-process.php';

require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/global/global-settings-admin.php';

require_once PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/productive-list-table.php';

require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/partials/section-about.php';
require PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/common/productiveminds-forms-options.php';
require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/partials/section-all-submissions.php'; 
require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/partials/section-contact.php';
require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/partials/section-newsletter.php';
require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/standard/options/partials/section-integration.php'; 
require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/standard/options/partials/section-go-pro.php'; 
require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/partials/part-view-a-submission.php';


$productive_forms_admin_navbar_title    = PRODUCTIVE_FORMS_CURRENT_PLUGIN_NAME . esc_html__( ' Admin Settings and Options', 'productive-forms' );
$productive_forms_admin_topmenu_title   = esc_html('Productive...');

add_action('wp_loaded', 'productive_forms_goto_plugin_options');
function productive_forms_goto_plugin_options() {  
    if( isset( $_GET[ 'page' ] ) && ( $_GET[ 'page' ] == PRODUCTIVE_FORMS_ADMIN_OVERVIEW_REQUEST_URI && !isset( $_GET[ 'tab' ] ) ) ) {
        wp_safe_redirect( add_query_arg( array( 'page' => PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI .'&tab=section_about_options_tab' ), admin_url( 'admin.php' ) ) );
    }
}

/**
 * Render Pages and Menus
 * 
 * @global string $productive_forms_admin_navbar_title
 * @global type $productive_forms_admin_topmenu_title
 */
function productive_forms_plugin_options_render_page_menu() {
    
    global $productive_forms_admin_navbar_title;
    global $productive_forms_admin_topmenu_title;
        
    $menu_title         = PRODUCTIVE_FORMS_CURRENT_PLUGIN_NAME;
    $capability         = 'administrator';          // allowed user role.
    $icon_url           = 'dashicons-carrot';
    $position           = 60; // Just after the Appearnce Page Menu
    
    // Plugin Custom Top-Level Menu & SubMenu
    // Register a new section in the "productive_forms" page.
    add_menu_page(
        $productive_forms_admin_navbar_title, // Browser navbar title
        $productive_forms_admin_topmenu_title, // Sidebar menu text
        $capability,
        PRODUCTIVE_FORMS_ADMIN_OVERVIEW_REQUEST_URI, // Unique id, which will be used to bind submenus to this top menu
        'productive_forms_plugin_options_render_page_menu_html', // Callback function for the menu
        $icon_url, 
        $position,
    );
   
    // Add global content
    productive_global_plugin_options_render_page_menu_global();
   
    // Plugin Custom Top-Level Menu & SubMenu
    // Register a new section in the "productive_forms" page.
    add_submenu_page(
        PRODUCTIVE_FORMS_ADMIN_OVERVIEW_REQUEST_URI,
        $productive_forms_admin_navbar_title, // Browser navbar title
        $menu_title, // Sidebar menu text
        $capability, 
        PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI, // Unique id
        'productive_forms_plugin_options_render_page_menu_html' // Callback function for the menu
    );
    
}
add_action( 'admin_menu', 'productive_forms_plugin_options_render_page_menu' );

function productive_forms_options_main_init() {
    // Add global sections
    productive_global_register_sections();
    
    // Add plugin-specific sections
    // Register section contact
    productive_forms_register_section_contact();
    // Register section newsletter
    productive_forms_register_section_newsletter();
    // Register section 3
    productive_forms_register_section_integration();
}
add_action( 'admin_init', 'productive_forms_options_main_init' );

function productive_forms_plugin_options_render_page_menu_html() {
    // check user capabilities
    if ( !current_user_can( 'manage_options' ) ) {
        add_settings_error( 'productive_forms_admin_messages', 'productive_forms_admin_message', esc_html__( 'You do not have permission to access this page.', 'productive-forms' ), 'error' );
        settings_errors( 'productive_forms_admin_messages' );
    } else {
            
    // check if the user have submitted the settings
    $is_error_count_section_contact = count( get_settings_errors('productive_forms_section_contact_options') );
    $is_error_count_section_newsletter = count( get_settings_errors('productive_forms_section_newsletter_options') );
    $is_error_count_section_integration = count( get_settings_errors('productive_forms_section_integration_options') );
    if ( isset( $_GET['settings-updated'] ) && $is_error_count_section_contact < 1 && $is_error_count_section_integration < 1 && $is_error_count_section_newsletter < 1 ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'productive_forms_admin_messages', 'productive_forms_admin_message', __( 'Settings Saved', 'productive-forms' ), 'updated' );
    }
    settings_errors( 'productive_forms_admin_messages' );
    
    $active_tab = 'section_about_options_tab';
    if( isset( $_GET[ 'tab' ] ) ) {
        $active_tab = sanitize_text_field( $_GET[ 'tab' ] );
    } 
    
    $active_subtab = 'sub_section_all';
    if ( 'section_1_options_tab' === $active_tab ) {
        $active_subtab = 'sub_section_all';
        if( isset( $_GET[ 'subtab' ] ) ) {
            $active_subtab = sanitize_text_field( $_GET[ 'subtab' ] );
        }
    }
    ?>

    <div class="wrap productive-global-options-page-wrapper">
        <div class="page-wrapper-heading-container">
            <div class="page-wrapper-heading">
                <h1>
                    <img class="admin-page-heading-icon" src="<?php echo PRODUCTIVE_FORMS_PLUGIN_URI . 'public/images/productivemedia/' . PRODUCTIVE_GLOBAL_PRODUCTIVE_PLUGIN_FORMS_TEXT_DOMAIN . '.webp' ?>" alt="" />
                    <?php echo PRODUCTIVE_FORMS_CURRENT_PLUGIN_NAME; ?>
                    <a target="_blank" class="page-wrapper-heading-get-pro" href="<?php echo PRODUCTIVE_FORMS_PLUGIN_DOCUMENTATION_URL; ?>"><?php echo esc_html__( 'Documentation', 'productive-forms' ); ?></a>
                    <a target="_blank" class="page-wrapper-heading-get-pro" href="<?php echo PRODUCTIVE_FORMS_PLUGIN_SUPPORT_URL; ?>"><?php echo esc_html__( 'Get Support', 'productive-forms' ); ?></a>
                </h1>
            </div>
            <div class="page-wrapper-heading-version">
                <div><?php echo 'v' . PRODUCTIVE_FORMS_VERSION; ?></div>
            </div>
        </div>
        <div class="page-wrapper-body">
                
            <div class="page-wrapper-options-error">
                <?php settings_errors('productive_forms_section_1_options'); ?>
                <?php settings_errors('productive_forms_section_contact_options'); ?>
                <?php settings_errors('productive_forms_section_newsletter_options'); ?>
                <?php settings_errors('productive_forms_section_integration_options'); ?>
                <?php settings_errors('productive_forms_section_pro_options'); ?>
            </div>
            
            <?php
                $section_about_options_tab = '';
                if ( $active_tab === 'section_about_options_tab' ) {
                    $section_about_options_tab = 'nav-tab-active';
                }
                $section_1_options_tab = '';
                if ( $active_tab === 'section_1_options_tab' ) {
                    $section_1_options_tab = 'nav-tab-active';
                }
                $section_contact_options_tab = '';
                if ( $active_tab === 'section_contact_options_tab' ) {
                    $section_contact_options_tab = 'nav-tab-active';
                }
                $section_newsletter_options_tab = '';
                if ( $active_tab === 'section_newsletter_options_tab' ) {
                    $section_newsletter_options_tab = 'nav-tab-active';
                }
                $section_integration_options_tab = '';
                if ( $active_tab === 'section_integration_options_tab' ) {
                    $section_integration_options_tab = 'nav-tab-active';
                }
                $section_pro_options_tab = '';
                if ( $active_tab === 'section_pro_options_tab' ) {
                    $section_pro_options_tab = 'nav-tab-active';
                }
            ?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_about_options_tab" class="nav-tab <?php echo esc_attr($section_about_options_tab); ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_ABOUT_TITLE; ?></a>
                <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_1_options_tab" class="nav-tab <?php echo esc_attr( $section_1_options_tab ); ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_1_TITLE; ?></a>
                <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_contact_options_tab" class="nav-tab <?php echo esc_attr( $section_contact_options_tab ); ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_CONTACT_TITLE; ?></a>
                <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_newsletter_options_tab" class="nav-tab <?php echo esc_attr( $section_newsletter_options_tab ); ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_NEWSLETTER_TITLE; ?></a>
                <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_integration_options_tab" class="nav-tab <?php echo esc_attr( $section_integration_options_tab ); ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_INTEGRATION_TITLE; ?></a>
                <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_pro_options_tab" class="nav-tab <?php echo esc_attr( $section_pro_options_tab ); ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_PRO_TITLE; ?></a>
            </h2>
            
            <div class="page-wrapper-body-form">
                
                <?php if ( $active_tab === 'section_contact_options_tab' ||  $active_tab === 'section_newsletter_options_tab' ||  $active_tab === 'section_integration_options_tab' ) { ?>
                        <form name="productive_forms_options_form" method="post" action="options.php">                        
                <?php } ?>
                
                <?php if ( $active_tab == 'section_about_options_tab' ) { ?>
                    <?php
                        productive_forms_about_section();
                    ?>
                <?php } else { ?>
                        
                    <div class="productive-global-item-container">            
                        <?php if ( $active_tab == 'section_1_options_tab' ) { ?>

                            <h2 class=""><?php echo __( 'Form Submissions', 'productive-forms' ); ?></h2>

                            <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_1_options_tab&subtab=sub_section_all" class="leftmost <?php echo ($active_tab == 'section_1_options_tab' && ($active_subtab == 'sub_section_all' || (!isset($active_subtab) || empty($active_subtab)) ) ) ? 'nav-subtab-active' : 'nav-subtab'; ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_1_SUB_TITLE_ALL; ?></a>
                            |
                            <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_1_options_tab&subtab=sub_section_contact" class="<?php echo ($active_tab == 'section_1_options_tab' && $active_subtab == 'sub_section_contact') ? 'nav-subtab-active' : 'nav-subtab'; ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_1_SUB_TITLE_CONTACT; ?></a>
                            |
                            <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_1_options_tab&subtab=sub_section_newsletter" class="rightmost <?php echo ($active_tab == 'section_1_options_tab' && $active_subtab == 'sub_section_newsletter') ? 'nav-subtab-active' : 'nav-subtab'; ?>"><?php echo PRODUCTIVE_FORMS_OPTION_TAB_1_SUB_TITLE_NEWSLETTER; ?></a>

                            <?php
                                productive_forms_message_list();
                           ?>
                        <?php } else if ( $active_tab == 'section_contact_options_tab' ) { ?>
                            <?php
                                settings_fields( 'productive_forms_section_contact_options' );
                                do_settings_sections( 'productive_forms_section_contact_options' );
                            ?>
                            <?php submit_button();?>
                        <?php } else if ( $active_tab == 'section_newsletter_options_tab' ) { ?>
                            <?php
                                settings_fields( 'productive_forms_section_newsletter_options' );
                                do_settings_sections( 'productive_forms_section_newsletter_options' );
                            ?>
                            <?php submit_button();?>
                        <?php } else if ( $active_tab == 'section_integration_options_tab' ) { ?>
                            <?php
                                settings_fields( 'productive_forms_section_integration_options' );
                                do_settings_sections( 'productive_forms_section_integration_options' );
                            ?>
                            <?php submit_button();?>
                        <?php } else if ( $active_tab == 'section_pro_options_tab' ) { ?>
                            <?php
                                productive_forms_section_get_pro();
                           ?>
                        <?php } else if ( $active_tab == 'section_view_item' ) { ?>
                            <?php
                                if( isset( $_GET[ 'id' ] ) ) {
                                    $item = sanitize_text_field( $_GET[ 'id' ] );
                                    productive_forms_message_view(esc_html($item));
                                } else {
                                    echo esc_html__( 'The requested item is not found!', 'productive-forms' );
                                }
                           ?>
                        <?php } ?>
                    </div> 
                            
                    <?php } ?>
                            
                <?php if ( $active_tab === 'section_contact_options_tab' ||  $active_tab === 'section_newsletter_options_tab' ||  $active_tab === 'section_integration_options_tab' ) { ?>
                    </form>                       
                <?php } ?>
            </div>
            
            <div class="leave-a-review-box">
                <?php _e( 'Support our efforts, interact with fellow users, and contribute to enhancing ', 'productive-forms' ); ?>
                <?php echo PRODUCTIVE_FORMS_CURRENT_PLUGIN_NAME; ?>.
                <a target="_blank" href="<?php echo PRODUCTIVE_FORMS_PLUGIN_REVIEW_ON_REPO_URL; ?>">
                    <?php _e( 'Kindly submit a review', 'productive-forms' ); ?>
               </a>
            </div>

        </div>
    </div>

    <?php
    }
}
