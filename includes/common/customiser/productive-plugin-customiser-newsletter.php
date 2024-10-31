<?php
/**
 * Theme Customiser
 *
 * @package productive-forms
 */

if ( ! defined( 'ABSPATH' ) ) {
    die();
}


if ( ! class_exists( 'Productive_Forms_Customiser_Newsletter' ) ) {
    
    /**
     * Productive_Forms_Customiser_Newsletter
     * Theme Customiser Class
     */
    class Productive_Forms_Customiser_Newsletter extends Productive_Forms_Customiser_Common {
        
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
                'productive_forms_newsletter_options',
                array(
                    'title' => __( 'Newsletter Options', 'productive-forms' ),
                    'description' => __( 'Join our list today and enjoy a 25% discount on your first order!' ),
                    'panel' => $panel,
                    'priority' => 80,
                    'capability' => 'edit_theme_options',
                )
                );

            $wp_customise->add_setting(
                'productive_forms_newsletter_switch_on',
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
                'productive_forms_newsletter_switch_on',
                array(
                    'type' => 'checkbox',
                    'priority' => 10,
                    'section' => 'productive_forms_newsletter_options',
                    'label' => __( 'Show Newsletter?', 'productive-forms' ),
                    'description' => __( 'Show newsletter opt-in form on website', 'productive-forms' ),
                )
                );

            $wp_customise->add_setting(
                'productive_forms_newsletter_layout',
                array(
                    'type' => 'theme_mod',
                    'default' => 'landscape',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
                );

            // add control..
            $wp_customise->add_control(
                'productive_forms_newsletter_layout',
                array(
                    'type' => 'select',
                    'priority' => 20,
                    'section' => 'productive_forms_newsletter_options',
                    'label' => __( 'Newsletter Layout', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'portrait' => __( 'Portrait', 'productive-forms' ),
                        'landscape' => __( 'Landscape', 'productive-forms' )
                    ),
                )
                );
            
            $wp_customise->add_setting(
                'productive_forms_newsletter_request_data_privacy_consent',
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
                'productive_forms_newsletter_request_data_privacy_consent',
                array(
                    'type' => 'checkbox',
                    'priority' => 30,
                    'section' => 'productive_forms_newsletter_options',
                    'label' => __( 'Ask for data privacy consent?', 'productive-forms' ),
                    'description' => __( 'Allow newsletter opt-ins with email address only.', 'productive-forms' ),
                )
                );
            
            $wp_customise->add_setting(
                'productive_forms_newsletter_show_only_email_field',
                array(
                    'type' => 'theme_mod',
                    'default' => false,
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_checkbox'),
                )
                );
            // add control..
            $wp_customise->add_control(
                'productive_forms_newsletter_show_only_email_field',
                array(
                    'type' => 'checkbox',
                    'priority' => 40,
                    'section' => 'productive_forms_newsletter_options',
                    'label' => __( 'Show Email Field Only?', 'productive-forms' ),
                    'description' => __( 'Allow newsletter opt-ins with email address only.', 'productive-forms' ),
                )
                );
            
            $wp_customise->add_setting(
                'productive_forms_newsletter_how_to_display_contact_name_field',
                array(
                    'type' => 'theme_mod',
                    'default' => 'combined_field',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
                );

            // add control..
            $wp_customise->add_control(
                'productive_forms_newsletter_how_to_display_contact_name_field',
                array(
                    'type' => 'select',
                    'priority' => 50,
                    'section' => 'productive_forms_newsletter_options',
                    'label' => __( 'Name Field Option', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'combined_field' => __( 'Combined Name Field', 'productive-forms' ),
                        'individual_fields' => __( 'First and Last Name Fields', 'productive-forms' ),
                    ),
                )
                );
            
            
            $wp_customise->add_setting(
                'productive_forms_newsletter_submission_verify_type',
                array(
                    'type' => 'theme_mod',
                    'default' => 'discreet',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
                );

            // add control..
            $wp_customise->add_control(
                'productive_forms_newsletter_submission_verify_type',
                array(
                    'type' => 'select',
                    'priority' => 60,
                    'section' => 'productive_forms_newsletter_options',
                    'label' => __( 'Spam Protection Verification', 'productive-forms' ),
                    'description' => '',
                    'choices' => array(
                        'discreet' => __( 'Discreet Verification', 'productive-forms' ),
                        'maths_challenge' => __( 'Simple Maths Challenge', 'productive-forms' ),
                        'productive_g_recaptcha_v3' => __( 'Google Recaptcha V3', 'productive-forms' )
                    ),
                )
                );
            
            $wp_customise->add_setting(
                'productive_forms_homepage_newsletter_section_bg_color_scheme',
                array(
                    'type' => 'theme_mod',
                    'default' => 'section_with_light_bg',
                    'theme_supports' => '',
                    'transport' => 'refresh',
                    'capability' => 'edit_theme_options',
                    'sanitize_callback' => array(__CLASS__, 'productive_forms_sanitize_select'),
                )
            );
            $wp_customise->add_control(
                'productive_forms_homepage_newsletter_section_bg_color_scheme',
                array(
                    'type' => 'select',
                    'priority' => 100,
                    'section' => 'productive_forms_newsletter_options',
                    'label' => __( 'Section Background Color Scheme', 'productive-forms' ),
                    'description' => '',
                    'choices' => productive_global_get_colour_schemes_for_bg(),
                )
            );
            // END: NEWSLETTER
            
            
        }
        
    } // End of class.
    
    // add hook for the class.
    add_action( 'customize_register', array( 'Productive_Forms_Customiser_Newsletter', 'register' ) );
    
} // End of if class exists


/**
 * Method productive_forms_newsletter_switch_on.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_switch_on( $class = '' ) {
    return get_theme_mod( 'productive_forms_newsletter_switch_on', true );
}

/**
 * Method productive_forms_newsletter_layout.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_layout( $class = '' ) {
    return get_theme_mod( 'productive_forms_newsletter_layout', 'landscape' );
}

/**
 * Method productive_forms_newsletter_request_data_privacy_consent.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_request_data_privacy_consent( $class = '' ) {
    return get_theme_mod( 'productive_forms_newsletter_request_data_privacy_consent', true );
}

/**
 * Method productive_forms_newsletter_show_only_email_field.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_show_only_email_field( $class = '' ) {
    return get_theme_mod( 'productive_forms_newsletter_show_only_email_field', false );
}

/**
 * Method productive_forms_newsletter_how_to_display_contact_name_field.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_how_to_display_contact_name_field( $class = '' ) {
    return get_theme_mod( 'productive_forms_newsletter_how_to_display_contact_name_field', 'combined_field' );
}

/**
 * Method productive_forms_newsletter_submission_verify_type.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_submission_verify_type( $class = '' ) {
    return get_theme_mod( 'productive_forms_newsletter_submission_verify_type', 'discreet' );
}
            
/**
 * Method productive_forms_homepage_newsletter_section_bg_color_scheme.
 *
 * @param string $class ''.
 */
function productive_forms_homepage_newsletter_section_bg_color_scheme( $class = '' ) {
    return get_theme_mod( 'productive_forms_homepage_newsletter_section_bg_color_scheme', 'section_with_light_bg' );
}
