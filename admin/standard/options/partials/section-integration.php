<?php
/**
 *
 * @package productive-forms
 */


function productive_forms_register_section_integration() {
    global $section_integration_heading;
    // Add Section
    add_settings_section(
        'productive_forms_section_integration',    // Section id
        $section_integration_heading, // Section heading
        'productive_forms_section_integration_description_callback', // A callback method that displays the section description
        'productive_forms_section_integration_options'   // The menu slug of the page that will display this section
    );
    
    productive_forms_add_section_integration_fields('productive_forms_section_integration_options');
    
    // Register a new setting for "productive_forms_section_integration" section.
    register_setting( 
            'productive_forms_section_integration_options', // Option group (section)
            'productive_forms_section_integration_options',   // Option name (it holds a collection of values of associated field - e.g productive_forms_section_integration_options[field_name])
            'productive_forms_register_section_integration_validate'      // Validate user entry
        );
    
    
    if ( false == productive_forms_get_section_integration_options_object() || empty( productive_forms_get_section_integration_options_object()) ) {
        add_option( 'productive_forms_section_integration_options', apply_filters( 'productive_forms_section_integration_options_init_fields', productive_forms_section_integration_options_init_fields() ) );
    }
}

// part template include
require PRODUCTIVE_FORMS_PLUGIN_PATH . 'admin/common/options/partials/part-section-integration.php'; // Tab 2


function productive_forms_get_section_integration_options_object() {
    return get_option( 'productive_forms_section_integration_options' );
}

function productive_forms_register_section_integration_validate( $section_inputs ) {
    
    $validated_values = array();
    
    foreach ( $section_inputs as $key => $input ) {
        if ( isset($section_inputs[$key]) ) {
            $validated_values[$key] = productive_forms_get_validate_input_default($input);
        }
    }
    
    return apply_filters('productive_forms_register_section_integration_validate', $validated_values, $section_inputs);
}



function productive_forms_section_integration_options_init_fields() {
    $default_fields_values = array(
        'keep_plugin_data_during_uninstall'                                                         => 'checked',
        'productive_forms_integration_maths_challenge_options_var_1'                                => '4',
        'productive_forms_integration_maths_challenge_options_var_2'                                => '3',
        'integration_recaptcha_key'                                                                 => '',
        'integration_recaptcha_secret'                                                              => '',
        'integration_ask_show_google_map'                                                           => '',
        'integration_google_map_api_key'                                                            => '',
        'integration_google_map_longitude'                                                          => '',
        'integration_google_map_latitude'                                                           => '',
    );
    return apply_filters( 'productive_forms_section_integration_options_init_fields', $default_fields_values );
}
