<?php
/**
 *
 * @package     productive-forms
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}


if ( ! class_exists( 'Productive_Forms_Customiser_Header_Contact_Section' ) ) { 
    
    /**
     * Productive_Forms_Customiser_Header_Contact_Section
     * Theme Customiser Class
     */
    class Productive_Forms_Customiser_Header_Contact_Section extends Productive_Forms_Customiser_Common {
        
        /**
         * Register the customizer
         *
         * @param WP_Customize_Manager $wp_customise param.
         */
        public static function register( $wp_customise ) {
            
            $panel = 'productive_forms_plugin_customizers';
            $get_template = get_template();
            if ( strpos( $get_template, 'productive-business') !== false ) {
                $panel = 'productive_business_theme_options';
            } else if ( strpos( $get_template, 'productive-ecommerce') !== false ) {
                $panel = 'productive_ecommerce_theme_options';
            } else if ( strpos( $get_template, 'stockist') !== false ) {
                $panel = 'productive_stockist_theme_options';
            }
            
            $wp_customise->add_section(
                'productive_forms_header_contact_section_options',
                array(
                    'title' => __( 'Header Contact Section Options', 'productive-forms' ),
                    'description' => '',
                    'panel' => $panel,
                    'priority' => 60,
                    'capability' => 'edit_theme_options',
                )
                );

            // add a setting for productive_forms_header_contact_section_switch_on control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_switch_on',
                array(
                    'type' => 'theme_mod',
                    'default' => true,
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_checkbox'),
                )
                );
            // add control..
            $wp_customise->add_control(
                'productive_forms_header_contact_section_switch_on',
                array(
                    'type' => 'checkbox',
                    'priority' => 10,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Enable Header Contact Section', 'productive-forms' ),
                    'description' => '',
                    // 'active_callback' => 'is_front_page',
                )
                );

            // add a setting for productive_forms_header_contact_section_contact_icon_position control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_contact_icon_position',
                array(
                    'type' => 'theme_mod',
                    'default' => 'left',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
            );
            $wp_customise->add_control(
                'productive_forms_header_contact_section_contact_icon_position',
                array(
                    'type' => 'select',
                    'priority' => 20,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Display Contact icon(s)?', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'left' => __( 'Left', 'productive-forms' ),
                        'right' => __( 'Right', 'productive-forms' ),
                        'center' => __( 'Center', 'productive-forms' ),
                        'hide_contact_icon' => __( 'Hide', 'productive-forms' ),
                    ),
                )
            );

            // add a setting for productive_forms_header_contact_section_social_media_icon_position control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_social_media_icon_position',
                array(
                    'type' => 'theme_mod',
                    'default' => 'center',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
            );
            $wp_customise->add_control(
                'productive_forms_header_contact_section_social_media_icon_position',
                array(
                    'type' => 'select',
                    'priority' => 30,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Display of Social media icons?', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'left' => __( 'Left', 'productive-forms' ),
                        'right' => __( 'Right', 'productive-forms' ),
                        'center' => __( 'Center', 'productive-forms' ),
                        'hide_social_media_icon' => __( 'Hide', 'productive-forms' ),
                    ),
                )
            );

            // add a setting for productive_forms_header_contact_section_contact_page_position control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_contact_page_position',
                array(
                    'type' => 'theme_mod',
                    'default' => 'right',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
            );
            $wp_customise->add_control(
                'productive_forms_header_contact_section_contact_page_position',
                array(
                    'type' => 'select',
                    'priority' => 40,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Display of Message Us hyperlink?', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'left' => __( 'Left', 'productive-forms' ),
                        'right' => __( 'Right', 'productive-forms' ),
                        'center' => __( 'Center', 'productive-forms' ),
                        'hide_contact_page' => __( 'Hide', 'productive-forms' ),
                    ),
                )
            );
            
            // add a setting for productive_forms_header_contact_section_contact_icon_copy, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_contact_icon_copy',
                array(
                    'type' => 'theme_mod',
                    'default' => __( 'Any question?', 'productive-forms' ),
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_no_html'),
                )
                );
            // add control..
            $wp_customise->add_control(
                'productive_forms_header_contact_section_contact_icon_copy',
                array(
                    'type' => 'text',
                    'priority' => 50,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Contact icon(s) copy', 'productive-forms' ),
                    'description' => __( 'Copy that preceeds the contact icon(s)', 'productive-forms' ),
                )
                );

            // add a setting for productive_forms_header_contact_section_contact_icon_in_use control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_contact_icon_in_use',
                array(
                    'type' => 'theme_mod',
                    'default' => 'email_only',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
            );
            $wp_customise->add_control(
                'productive_forms_header_contact_section_contact_icon_in_use',
                array(
                    'type' => 'select',
                    'priority' => 60,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Select Contact icon(s) to display', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'email_only' => __( 'Email only (default)', 'productive-forms' ),
                        'phone_only' => __( 'Phone only', 'productive-forms' ),
                        'whatsapp_only' => __( 'WhatsApp only', 'productive-forms' ),
                        'email_and_phone' => __( 'Email and Phone', 'productive-forms' ),
                        'email_and_whatsapp' => __( 'Email and WhatsApp', 'productive-forms' ),
                        'phone_and_whatsapp' => __( 'Phone and WhatsApp', 'productive-forms' ),
                        'all_three' => __( 'All', 'productive-forms' ),
                        'hide_contact_icon' => __( 'None', 'productive-forms' ),
                    ),
                )
            );
            
            // add a setting for productive_forms_header_contact_section_social_media_icon_copy, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_social_media_icon_copy',
                array(
                    'type' => 'theme_mod',
                    'default' => __( 'Follow us on:', 'productive-forms' ),
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_no_html'),
                )
                );
            // add control..
            $wp_customise->add_control(
                'productive_forms_header_contact_section_social_media_icon_copy',
                array(
                    'type' => 'text',
                    'priority' => 70,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Social media copy', 'productive-forms' ),
                    'description' => __( 'Copy that preceeds the social media icon', 'productive-forms' ),
                )
                );
            
            // add a setting for productive_forms_header_contact_section_contact_page_copy, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_contact_page_copy',
                array(
                    'type' => 'theme_mod',
                    'default' => __( 'Message Us', 'productive-forms' ),
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_no_html'),
                )
                );
            // add control..
            $wp_customise->add_control(
                'productive_forms_header_contact_section_contact_page_copy',
                array(
                    'type' => 'text',
                    'priority' => 80,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Message Us', 'productive-forms' ),
                    'description' => __( 'Copy that preceeds the contact page hyperlink.', 'productive-forms' ),
                )
                );
            
            // add a setting for productive_forms_header_contact_section_icon_size control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_icon_size',
                array(
                    'type' => 'theme_mod',
                    'default' => 16,
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_absint'),
                )
            );
            $wp_customise->add_control(
                'productive_forms_header_contact_section_icon_size',
                array(
                    'type' => 'number',
                    'priority' => 90,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Icons size (px)', 'productive-forms' ),
                    'description' => '',
                    'input_attrs' => array(
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ),
                )
            );

            // add a setting for productive_forms_header_contact_section_icon_color control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_icon_color',
                array(
                    'type' => 'theme_mod',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'default' => '#ea3b06',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_color'),
                )
                );
            
            $wp_customise->add_control(
                new WP_Customize_Color_Control(
                    $wp_customise,
                    'productive_forms_header_contact_section_icon_color',
                    array(
                        'priority' => 100,
                        'label' => __( 'Icons colour', 'productive-forms' ),
                        'section' => 'productive_forms_header_contact_section_options',
                    )
                    )
                );

            $wp_customise->add_setting(
                'productive_forms_header_contact_section_use_official_sm_colours',
                array(
                    'type' => 'theme_mod',
                    'default' => 'brand_color_around_white_icon',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
            );
            $wp_customise->add_control(
                'productive_forms_header_contact_section_use_official_sm_colours',
                array(
                    'type' => 'select',
                    'priority' => 110,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Social media icons colour style', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'brand_color_around_white_icon' => __( 'Official brand color background with white icon', 'productive-forms' ),
                        'brand_color_as_icon_color' => __( 'Official brand color as icon colour', 'productive-forms' ),
                        'selected_color_as_icon_color' => __( 'Use selected color as icon colour', 'productive-forms' ),
                    ),
                )
            );

            // add a setting for productive_forms_header_contact_section_text_color control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_text_color',
                array(
                    'type' => 'theme_mod',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'default'              => '#3a465e',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_color'),
                )
                );

            $wp_customise->add_control(
                new WP_Customize_Color_Control(
                    $wp_customise,
                    'productive_forms_header_contact_section_text_color',
                    array(
                        'priority' => 120,
                        'label' => __( 'Text color', 'productive-forms' ),
                        'section' => 'productive_forms_header_contact_section_options',
                    )
                    )
                );

            // add a setting for productive_forms_header_contact_section_hyperlink_color control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_hyperlink_color',
                array(
                    'type' => 'theme_mod',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'default'              => '#0a47bb',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_color'),
                )
                );

            $wp_customise->add_control(
                new WP_Customize_Color_Control(
                    $wp_customise,
                    'productive_forms_header_contact_section_hyperlink_color',
                    array(
                        'priority' => 130,
                        'label' => __( 'Hyperlinks color', 'productive-forms' ),
                        'section' => 'productive_forms_header_contact_section_options',
                    )
                    )
                );

            // add a setting for productive_forms_header_contact_section_hyperlink_color_hover control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_hyperlink_color_hover',
                array(
                    'type' => 'theme_mod',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'default'              => '#2a3b55',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_color'),
                )
                );

            $wp_customise->add_control(
                new WP_Customize_Color_Control(
                    $wp_customise,
                    'productive_forms_header_contact_section_hyperlink_color_hover',
                    array(
                        'priority' => 140,
                        'label' => __( 'Hyperlinks color (on Hover)', 'productive-forms' ),
                        'section' => 'productive_forms_header_contact_section_options',
                    )
                    )
                );

            // add a setting for productive_forms_header_contact_section_alignment control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_alignment',
                array(
                    'type' => 'theme_mod',
                    'default' => 'justify-content-space-between',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
            );
            $wp_customise->add_control(
                'productive_forms_header_contact_section_alignment',
                array(
                    'type' => 'select',
                    'priority' => 150,
                    'section' => 'productive_forms_header_contact_section_options',
                    'label' => __( 'Alignment', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'justify-content-flex-start' => __( 'All on the Left', 'productive-forms' ),
                        'justify-content-flex-end' => __( 'All on the Right', 'productive-forms' ),
                        'justify-content-center' => __( 'All at Center', 'productive-forms' ),
                        'justify-content-space-between' => __( 'Justify evenly', 'productive-forms' ),
                        'justify-content-space-around' => __( 'Justify (with equal spaces)', 'productive-forms' ),
                    ),
                )
            );

            // add a setting for productive_forms_header_contact_section_border_color control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_border_color',
                array(
                    'type' => 'theme_mod',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'default'   => '#bfdaef',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_color'),
                )
                );

            $wp_customise->add_control(
                new WP_Customize_Color_Control(
                    $wp_customise,
                    'productive_forms_header_contact_section_border_color',
                    array(
                        'priority' => 160,
                        'label' => __( 'Bottom Border color', 'productive-forms' ),
                        'section' => 'productive_forms_header_contact_section_options',
                    )
                    )
                );

            // add a setting for productive_forms_header_contact_section_bg_color control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_bg_color',
                array(
                    'type' => 'theme_mod',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'default'              => '#f4f8f9',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_color'),
                )
                );

            $wp_customise->add_control(
                new WP_Customize_Color_Control(
                    $wp_customise,
                    'productive_forms_header_contact_section_bg_color',
                    array(
                        'priority' => 170,
                        'label' => __( 'Section background color', 'productive-forms' ),
                        'section' => 'productive_forms_header_contact_section_options',
                    )
                    )
                );

            // add a setting for productive_forms_header_contact_section_bg_image control, below.
            $wp_customise->add_setting(
                'productive_forms_header_contact_section_bg_image',
                array(
                    'type' => 'theme_mod',
                    'default' => false,
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_image'),
                )
                );
            // add control..
            $wp_customise->add_control(
                new WP_Customize_Media_Control(
                    $wp_customise,
                    'productive_forms_header_contact_section_bg_image',
                        array(
                            'priority' => 180,
                            'section' => 'productive_forms_header_contact_section_options',
                            'label' => __( 'Section background Image', 'productive-forms' ),
                            'description' => __( 'If set, the image overrides the background color.', 'productive-forms' ),
                        )
                    )
                );
            
        }
        
    } // End of class.
    
    // add hook for the class.
    add_action( 'customize_register', array( 'Productive_Forms_Customiser_Header_Contact_Section', 'register' ) );
    
} // End of if class exists



/**
 * Method productive_forms_header_contact_section_switch_on.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_switch_on( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_switch_on', true );
}

/**
 * Method productive_forms_header_contact_section_contact_icon_position.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_contact_icon_position( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_contact_icon_position', 'left' );
}

/**
 * Method productive_forms_header_contact_section_social_media_icon_position.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_social_media_icon_position( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_social_media_icon_position', 'center' );
}

/**
 * Method productive_forms_header_contact_section_contact_page_position.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_contact_page_position( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_contact_page_position', 'right' );
}

/**
 * Method productive_forms_header_contact_section_contact_icon_copy.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_contact_icon_copy( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_contact_icon_copy', __( 'Any question?', 'productive-forms' ) );
}

/**
 * Method productive_forms_header_contact_section_contact_icon_in_use.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_contact_icon_in_use( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_contact_icon_in_use', 'email_only' );
}

/**
 * Method productive_forms_header_contact_section_social_media_icon_copy.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_social_media_icon_copy( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_social_media_icon_copy', __( 'Follow us on:', 'productive-forms' ) );
}

/**
 * Method productive_forms_header_contact_section_contact_page_copy.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_contact_page_copy( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_contact_page_copy', __( 'Message Us', 'productive-forms' ) );
}

/**
 * 
 * Method productive_forms_header_contact_section_icon_size.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_icon_size( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_icon_size', 16 );
}

/**
 * Method productive_forms_header_contact_section_icon_color.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_icon_color( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_icon_color', '#ea3b06' );
}

/**
 * Method productive_forms_header_contact_section_use_official_sm_colours.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_use_official_sm_colours( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_use_official_sm_colours', 'brand_color_around_white_icon' );
}

/**
 * Method productive_forms_header_contact_section_text_color.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_text_color( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_text_color', '#3a465e' );
}

/**
 * Method productive_forms_header_contact_section_hyperlink_color.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_hyperlink_color( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_hyperlink_color', '#0a47bb' );
}

/**
 * Method productive_forms_header_contact_section_hyperlink_color_hover.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_hyperlink_color_hover( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_hyperlink_color_hover', '#2a3b55' );
}

/**
 * Method productive_forms_header_contact_section_alignment.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_alignment( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_alignment', 'justify-content-space-between' );
}

/**
 * Method productive_forms_header_contact_section_border_color.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_border_color( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_border_color', '#bfdaef' );
}

/**
 * Method productive_forms_header_contact_section_bg_color.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_bg_color( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_bg_color', '#f4f8f9' );
}

/**
 * Method productive_forms_header_contact_section_bg_image.
 *
 * @param string $class ''.
 */
function productive_forms_header_contact_section_bg_image( $class = '' ) {
    return get_theme_mod( 'productive_forms_header_contact_section_bg_image', false );
}
