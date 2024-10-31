<?php
/**
 *
 * @package productive-forms
 */


function productive_forms_section_integration_description_callback() {
    ?>
	<p>
            <h2><?php echo esc_html__( 'Settings and API Integrations', 'productive-forms' ) ?></h2>
            <?php echo esc_html__( 'Please provide required settings in the corresponding fields.', 'productive-forms' ); ?>
        </p>
    <?php
}

/* ============ START Section fields ================= */
function productive_forms_add_section_integration_fields($productive_forms_section_integration_options) {
    
    $args_field_1 = array( 
        'label_for' => 'productive_forms_keep_plugin_data_during_uninstall', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_keep_plugin_data_during_uninstall', // field id
        __( 'Preserve data, if plugin is uninstalled?', 'productive-forms' ), // Field label
        'productive_forms_callback_keep_plugin_data_during_uninstall',
        $productive_forms_section_integration_options, 
        'productive_forms_section_integration', 
        $args_field_1
        );
    
    
    $args_field_2aa_heading = array( 
        'label_for' => 'productive_forms_integration_maths_challenge_options_heading', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_integration_maths_challenge_options_heading', // field id
        __( '', 'productive-forms' ), // Field label
        'productive_forms_callback_integration_maths_challenge_options_heading',
        $productive_forms_section_integration_options, 
        'productive_forms_section_integration', 
        $args_field_2aa_heading
        );

    $args_field_2bbb = array( 
        'label_for' => 'productive_forms_integration_maths_challenge_options_var_1', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_integration_maths_challenge_options_var_1', // field id
        __( 'Variable 1', 'productive-forms' ), // Field label
        'productive_forms_callback_integration_maths_challenge_options_var_1',
        $productive_forms_section_integration_options, 
        'productive_forms_section_integration', 
        $args_field_2bbb
        );

    $args_field_2ccc = array( 
        'label_for' => 'productive_forms_integration_maths_challenge_options_var_2', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_integration_maths_challenge_options_var_2', // field id
        __( 'Variable 2', 'productive-forms' ), // Field label
        'productive_forms_callback_integration_maths_challenge_options_var_2',
        $productive_forms_section_integration_options, 
        'productive_forms_section_integration', 
        $args_field_2ccc
        );
    
    if( productive_global_is_a_productive_extra_theme() || productive_forms_is_extra() ) {
        
        $args_field_6_heading = array( 
            'label_for' => 'productive_forms_integration_google_map_heading', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_forms_integration_google_map_heading', // field id
            __( '', 'productive-forms' ), // Field label
            'productive_forms_callback_integration_google_map_heading',
            $productive_forms_section_integration_options, 
            'productive_forms_section_integration', 
            $args_field_6_heading
            );

        $args_field_6 = array( 
            'label_for' => 'productive_forms_integration_ask_show_google_map', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_forms_integration_ask_show_google_map', // field id
            __( 'Show Google map?', 'productive-forms' ), // Field label
            'productive_forms_callback_integration_ask_show_google_map',
            $productive_forms_section_integration_options, 
            'productive_forms_section_integration', 
            $args_field_6
            );

        $args_field_7 = array( 
            'label_for' => 'productive_forms_integration_google_map_api_key',
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_forms_integration_google_map_api_key', // field id
            __( 'Google map API Key', 'productive-forms' ), // Field label
            'productive_forms_callback_integration_google_map_api_key',
            $productive_forms_section_integration_options, 
            'productive_forms_section_integration', 
            $args_field_7
            );

        $args_field_8 = array(
            'label_for' => 'productive_forms_integration_google_map_longitude', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_forms_integration_google_map_longitude', // field id
            __( 'Address Longitude (Geographic Coordinate)', 'productive-forms' ), // Field label
            'productive_forms_callback_integration_google_map_longitude',
            $productive_forms_section_integration_options, 
            'productive_forms_section_integration', 
            $args_field_8
            );

        $args_field_9 = array( 
            'label_for' => 'productive_forms_integration_google_map_latitude', 
            'class'     => 'options_field_args_css_class'
        );
        add_settings_field(
            'productive_forms_integration_google_map_latitude', // field id
            __( 'Address Latitude (Geographic Coordinate)', 'productive-forms' ), // Field label
            'productive_forms_callback_integration_google_map_latitude',
            $productive_forms_section_integration_options, 
            'productive_forms_section_integration', 
            $args_field_9
            );
    }
    
    
    $args_field_10_heading = array( 
        'label_for' => 'productive_forms_integration_recaptcha_heading', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_integration_recaptcha_heading', // field id
        __( '', 'productive-forms' ), // Field label
        'productive_forms_callback_integration_recaptcha_heading',
        $productive_forms_section_integration_options, 
        'productive_forms_section_integration', 
        $args_field_10_heading
        );
    
    $args_field_10 = array( 
        'label_for' => 'productive_forms_integration_recaptcha_key', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_integration_recaptcha_key', // field id
        __( 'Google reCAPTCHA Site Key', 'productive-forms' ), // Field label
        'productive_forms_callback_integration_recaptcha_key',
        $productive_forms_section_integration_options, 
        'productive_forms_section_integration', 
        $args_field_10
        );
    
    $args_field_11 = array(
        'label_for' => 'productive_forms_integration_recaptcha_secret', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_forms_integration_recaptcha_secret', // field id
        __( 'Google reCAPTCHA Secret Key', 'productive-forms' ), // Field label
        'productive_forms_callback_integration_recaptcha_secret',
        $productive_forms_section_integration_options, 
        'productive_forms_section_integration', 
        $args_field_11
        );
    
}

function productive_forms_callback_keep_plugin_data_during_uninstall() {
        $options = get_option( 'productive_forms_section_integration_options' );
        $keep_plugin_data_during_uninstall = '';
        if (isset( $options['keep_plugin_data_during_uninstall']) ) {
            $keep_plugin_data_during_uninstall = $options['keep_plugin_data_during_uninstall'];
        }
    ?>
    <p>
        <input id="productive_forms_section_integration_options[keep_plugin_data_during_uninstall]" type="checkbox" name="productive_forms_section_integration_options[keep_plugin_data_during_uninstall]" value="checked" <?php echo checked('checked', $keep_plugin_data_during_uninstall, false ); ?> />
        <label for="productive_forms_section_integration_options[keep_plugin_data_during_uninstall]"><?php echo esc_html__( 'Keep settings and data (do not delete), if this plugin is uninstalled.', 'productive-forms' ); ?></label>
    </p>
   <?php
}




/**
 * 
 * @param type $args
 */
function productive_forms_callback_integration_maths_challenge_options_heading( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Maths Challenge Settings', 'productive-forms' ) ?></h3>
    <p>
        <?php echo esc_html__( 'Protect your forms with Simple Maths challenge.', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_forms_callback_integration_maths_challenge_options_var_1( $args ) {
        $options = productive_forms_get_section_integration_options_object();
        $productive_forms_integration_maths_challenge_options_var_1 = '';
        if (isset( $options['productive_forms_integration_maths_challenge_options_var_1']) ) {
            $productive_forms_integration_maths_challenge_options_var_1 = $options['productive_forms_integration_maths_challenge_options_var_1'];
        }
    ?>
    <input type="number" name="productive_forms_section_integration_options[productive_forms_integration_maths_challenge_options_var_1]" value="<?php echo esc_attr( $productive_forms_integration_maths_challenge_options_var_1 ); ?>" size="30" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
   <?php
}

function productive_forms_callback_integration_maths_challenge_options_var_2( $args ) {
        $options = productive_forms_get_section_integration_options_object();
        $productive_forms_integration_maths_challenge_options_var_2 = '';
        if (isset( $options['productive_forms_integration_maths_challenge_options_var_2']) ) {
            $productive_forms_integration_maths_challenge_options_var_2 = $options['productive_forms_integration_maths_challenge_options_var_2'];
        }
    ?>
    <input type="number" name="productive_forms_section_integration_options[productive_forms_integration_maths_challenge_options_var_2]" value="<?php echo esc_attr( $productive_forms_integration_maths_challenge_options_var_2 ); ?>" size="30" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
   <?php
}




/**
 * 
 * @param type $args
 */
function productive_forms_callback_integration_google_map_heading( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Google Maps Settings', 'productive-forms' ) ?></h3>
    <p>
        <?php echo esc_html__( 'Protect your forms with reCaptcha v3.', 'productive-forms' ); ?>
        <a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key"><?php echo esc_html__( 'Get your free Google Maps API Keys on Google', 'productive-forms' ); ?></a>
    </p>
   <?php
}

function productive_forms_callback_integration_ask_show_google_map() {
        $options = productive_forms_get_section_integration_options_object();
        $integration_ask_show_google_map = '';
        if (isset( $options['integration_ask_show_google_map']) ) {
            $integration_ask_show_google_map = $options['integration_ask_show_google_map'];
        }
    ?>
    <p>
        <input id="productive_forms_section_integration_options[integration_ask_show_google_map]" type="checkbox" name="productive_forms_section_integration_options[integration_ask_show_google_map]" value="checked" <?php echo checked('checked', $integration_ask_show_google_map, false ); ?> />
        <label for="productive_forms_section_integration_options[integration_ask_show_google_map]"><?php echo esc_html__( 'Map relies on the Google Map API key, and a valid set of Longitude and Latitude.', 'productive-forms' ); ?></label>
    </p>
   <?php
}

function productive_forms_callback_integration_google_map_api_key() {
        $options = productive_forms_get_section_integration_options_object();
        $integration_google_map_api_key = '';
        if (isset( $options['integration_google_map_api_key']) ) {
            $integration_google_map_api_key = $options['integration_google_map_api_key'];
        }
    ?>
        <input type="text" name="productive_forms_section_integration_options[integration_google_map_api_key]" value="<?php echo esc_attr( $integration_google_map_api_key ); ?>" size="40" />
        <p>
            <?php echo esc_html__( 'Visit Google Maps website to obtain a free API Key. See the documentation, if you need help.', 'productive-forms' ); ?>
        </p>
   <?php
}

function productive_forms_callback_integration_google_map_latitude() {
        $options = productive_forms_get_section_integration_options_object();
        $integration_google_map_latitude = '';
        if (isset( $options['integration_google_map_latitude']) ) {
            $integration_google_map_latitude = $options['integration_google_map_latitude'];
        }
    ?>
        <input type="text" name="productive_forms_section_integration_options[integration_google_map_latitude]" value="<?php echo esc_attr( $integration_google_map_latitude ); ?>" size="40" />
        <p>
            <?php echo esc_html__( 'Visit Google Geocoding to ', 'productive-forms' ); ?> <a target="_blank" href="https://developers.google.com/maps/documentation/geocoding/overview"><?php echo esc_html__( 'discover the Latitude for an address', 'productive-forms' ); ?></a>
        </p>
   <?php
}

function productive_forms_callback_integration_google_map_longitude() {
        $options = productive_forms_get_section_integration_options_object();
        $integration_google_map_longitude = '';
        if (isset( $options['integration_google_map_longitude']) ) {
            $integration_google_map_longitude = $options['integration_google_map_longitude'];
        }
    ?>
        <input type="text" name="productive_forms_section_integration_options[integration_google_map_longitude]" value="<?php echo esc_attr( $integration_google_map_longitude ); ?>" size="40" />
        <p>
            <?php echo esc_html__( 'Visit Google Geocoding to ', 'productive-forms' ); ?> <a target="_blank" href="https://developers.google.com/maps/documentation/geocoding/overview"><?php echo esc_html__( 'discover the Longitude for an address', 'productive-forms' ); ?></a>
        </p>
   <?php
}



/**
 * 
 * @param type $args
 */
function productive_forms_callback_integration_recaptcha_heading( $args ) {
    ?>
    <h3><?php echo esc_html__( 'Google reCaptcha Settings', 'productive-forms' ) ?></h3>
    <p>
        <?php echo esc_html__( 'Protect your forms with reCaptcha v3.', 'productive-forms' ); ?>
        <a target="_blank" href="https://www.google.com/recaptcha/about/"><?php echo esc_html__( 'Get your free API settings on Google', 'productive-forms' ); ?></a>
    </p>
   <?php
}

function productive_forms_callback_integration_recaptcha_key() {
        $options = productive_forms_get_section_integration_options_object();
        $integration_recaptcha_key = '';
        if (isset( $options['integration_recaptcha_key']) ) {
            $integration_recaptcha_key = $options['integration_recaptcha_key'];
        }
    ?>
        <input type="text" name="productive_forms_section_integration_options[integration_recaptcha_key]" value="<?php echo esc_attr( $integration_recaptcha_key ); ?>" size="40" />
        <p>
            <?php echo esc_html__( 'Visit Google reCAPTCHA to obtain a free key. See the documentation, if you need help.', 'productive-forms' ); ?>
        </p>
   <?php
}

function productive_forms_callback_integration_recaptcha_secret() {
        $options = productive_forms_get_section_integration_options_object();
        $integration_recaptcha_secret = '';
        if (isset( $options['integration_recaptcha_secret']) ) {
            $integration_recaptcha_secret = $options['integration_recaptcha_secret'];
        }
    ?>
        <input type="text" name="productive_forms_section_integration_options[integration_recaptcha_secret]" value="<?php echo esc_attr( $integration_recaptcha_secret ); ?>" size="40" />
        <p>
            <?php echo esc_html__( 'Visit Google reCAPTCHA to obtain a free secret. See the documentation, if you need help.', 'productive-forms' ); ?>
        </p>
   <?php
}
/* ============ END Section fields ================= */
