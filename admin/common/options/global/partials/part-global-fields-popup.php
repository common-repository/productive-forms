<?php
/**
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

// Start: Popup
function productive_global_section_popup_description_callback() {
?>
    <p>
        <h2><?php echo esc_html__( 'Global PopUp Settings', 'productive-forms' ) ?></h2>
        <div><?php echo esc_html__( 'These setting are relevant to all PopUps that are generated by our plugins and themes', 'productive-forms' ) ?></div>
    </p>
<?php
}

/* ============ START Section fields ================= */
function productive_global_add_section_popup_fields($productive_global_section_popup_options) {
    
    $args_field_1a = array(
        'label_for' => 'productive_global_popup_transition_easing',
        'class'     => 'options_field_args_css_class'
    );
    
    add_settings_field(
        'productive_global_popup_transition_easing', // field id
        __( 'Popup Transition Easing Mode', 'productive-forms' ), // Field label
        'productive_global_callback_popup_transition_easing', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_1a
        );

    $args_field_2a = array(
        'label_for' => 'productive_global_popup_transition_direction',
        'class'     => 'options_field_args_css_class'
    );
    
    add_settings_field(
        'productive_global_popup_transition_direction', // field id
        __( 'Popup Transition IN/OUT Direction', 'productive-forms' ), // Field label
        'productive_global_callback_popup_transition_direction', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_2a
        );
    
    $args_field_3a = array(
        'label_for' => 'productive_global_popup_header_footer_bg_color',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_header_footer_bg_color', // field id
        __( 'Popup Header and Footer Background Colour', 'productive-forms' ), // Field label
        'productive_global_callback_popup_footer_bg_color', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_3a
        );

    $args_field_4a = array(
        'label_for' => 'productive_global_popup_header_footer_text_color',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_header_footer_text_color', // field id
        __( 'Popup Header and Footer Text Colour', 'productive-forms' ), // Field label
        'productive_global_callback_popup_header_footer_text_color', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_4a
        );

    $args_field_5a = array(
        'label_for' => 'productive_global_popup_header_footer_hyperlink_color',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_header_footer_hyperlink_color', // field id
        __( 'Popup Header and Footer Hyperlinks Colour', 'productive-forms' ), // Field label
        'productive_global_callback_popup_header_footer_hyperlink_color', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_5a
        );

    $args_field_6a = array(
        'label_for' => 'productive_global_popup_header_footer_hyperlink_color_hover',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_header_footer_hyperlink_color_hover', // field id
        __( 'Popup Header and Footer Hyperlinks Colour (on hover)', 'productive-forms' ), // Field label
        'productive_global_callback_popup_header_footer_hyperlink_color_hover', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_6a
        );

    $args_field_7a = array(
        'label_for' => 'productive_global_popup_close_button_color',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_close_button_color', // field id
        __( 'Popup Close Button Colour', 'productive-forms' ), // Field label
        'productive_global_callback_popup_close_button_color', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_7a
        );

    $args_field_7b = array(
        'label_for' => 'productive_global_popup_close_button_color_bg',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_close_button_color_bg', // field id
        __( 'Popup Close Button Background', 'productive-forms' ), // Field label
        'productive_global_callback_popup_close_button_color_bg', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_7b
        );

    $args_field_7c = array(
        'label_for' => 'productive_global_popup_close_button_color_hover',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_close_button_color_hover', // field id
        __( 'Popup Close Button Colour (on Hover)', 'productive-forms' ), // Field label
        'productive_global_callback_popup_close_button_color_hover', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_7c
        );

    $args_field_7d = array(
        'label_for' => 'productive_global_popup_close_button_color_hover_bg',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_close_button_color_hover_bg', // field id
        __( 'Popup Close Button Background (on Hover)', 'productive-forms' ), // Field label
        'productive_global_callback_popup_close_button_color_hover_bg', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_7d
        );

    $args_field_8a = array(
        'label_for' => 'productive_global_popup_width_min',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_width_min', // field id
        __( 'Popup Minimum width (px)', 'productive-forms' ), // Field label
        'productive_global_callback_popup_width_min', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_8a
        );

    $args_field_9a = array(
        'label_for' => 'productive_global_popup_width_max',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_width_max', // field id
        __( 'Popup Max width (px)', 'productive-forms' ), // Field label
        'productive_global_callback_popup_width_max', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_9a
        );

    $args_field_10a = array(
        'label_for' => 'productive_global_popup_when_modal_goes_fullscreen',
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_when_modal_goes_fullscreen', // field id
        __( 'Popup Full Screen Mode (px)', 'productive-forms' ), // Field label
        'productive_global_callback_popup_when_modal_goes_fullscreen', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_10a
        );
    
    $args_field_11a = array(
        'label_for' => 'is_on_productive_global_popup_close_with_esc_key_enable', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'is_on_productive_global_popup_close_with_esc_key_enable', // field id
        __( 'Close Popup with ESC Key?', 'productive-forms' ), // Field label
        'productive_global_callback_popup_close_with_esc_key_enable', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_11a
        );
    
    $args_field_12a = array(
        'label_for' => 'is_on_productive_global_popup_close_with_click_elsewhere_enable', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'is_on_productive_global_popup_close_with_click_elsewhere_enable', // field id
        __( 'Click Elsewhere to Close Popup?', 'productive-forms' ), // Field label
        'productive_global_callback_popup_close_with_click_elsewhere_enable', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_12a
        );
    
    $args_field_13a = array(
        'label_for' => 'productive_global_popup_bg_opacity', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'productive_global_popup_bg_opacity', // field id
        __( 'Popup Background Opacity', 'productive-forms' ), // Field label
        'productive_global_callback_popup_bg_opacity', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_13a
        );
    
    $args_field_14a = array(
        'label_for' => 'is_on_productive_global_popup_use_theme_style', 
        'class'     => 'options_field_args_css_class'
    );
    add_settings_field(
        'is_on_productive_global_popup_use_theme_style', // field id
        __( 'Use Styles from the Theme?', 'productive-forms' ), // Field label
        'productive_global_callback_popup_use_theme_style', // This callback function will be rendering this field. So, all html of this field will be rendered in this callback function.
        $productive_global_section_popup_options,   // The menu slug of the page that will display this field
        'productive_global_section_popup',   // Section name
        $args_field_14a
        );    
    
}

function productive_global_callback_popup_transition_easing( $args ) {
    $options = productive_global_get_section_popup_options_object();
    $productive_global_popup_transition_easing = '';
    if( isset( $options['productive_global_popup_transition_easing'] ) ) {
        $productive_global_popup_transition_easing = $options['productive_global_popup_transition_easing'];
    }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_global_section_popup_options[productive_global_popup_transition_easing]">
            <?php
                $productive_global_get_popup_transition_easings = productive_global_get_popup_transition_easings();
                foreach ( $productive_global_get_popup_transition_easings as $key => $productive_global_get_popup_transition_easing ) {
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $productive_global_popup_transition_easing, esc_attr( $key ), false ); ?>>
                       <?php echo esc_html( $productive_global_get_popup_transition_easing ); ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <p>
            <?php echo esc_html__( 'The easing mode for entrance and exit of Popup.', 'productive-forms' ); ?>
        </p>
    <?php
}


function productive_global_callback_popup_transition_direction( $args ) {
    $options = productive_global_get_section_popup_options_object();
    $productive_global_popup_transition_direction = '';
    if( isset( $options['productive_global_popup_transition_direction'] ) ) {
        $productive_global_popup_transition_direction = $options['productive_global_popup_transition_direction'];
    }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_global_section_popup_options[productive_global_popup_transition_direction]">
            <?php
                $productive_global_popup_transition_direction_options = productive_global_get_popup_transition_directions();
                foreach ( $productive_global_popup_transition_direction_options as $key => $productive_global_popup_transition_direction_option ) {
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $productive_global_popup_transition_direction, esc_attr( $key ), false ); ?>>
                       <?php echo esc_html( $productive_global_popup_transition_direction_option ); ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <p>
            <?php echo esc_html__( 'The direction of transition for entrance and exit of Popup', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_global_callback_popup_footer_bg_color( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_header_footer_bg_color = '';
        if (isset( $options['productive_global_popup_header_footer_bg_color']) ) {
            $productive_global_popup_header_footer_bg_color = $options['productive_global_popup_header_footer_bg_color'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#bfeaff" class="productive_input_color_picker" type="text" name="productive_global_section_popup_options[productive_global_popup_header_footer_bg_color]" value="<?php echo esc_attr( $productive_global_popup_header_footer_bg_color ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
    <p>
        <?php echo esc_html__( 'Background colour for popup header and footer background.', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_header_footer_text_color( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_header_footer_text_color = '';
        if (isset( $options['productive_global_popup_header_footer_text_color']) ) {
            $productive_global_popup_header_footer_text_color = $options['productive_global_popup_header_footer_text_color'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#ffffff" class="productive_input_color_picker" type="text" name="productive_global_section_popup_options[productive_global_popup_header_footer_text_color]" value="<?php echo esc_attr( $productive_global_popup_header_footer_text_color ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
    <p>
        <?php echo esc_html__( 'Colour of textual content in popup header and footer', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_header_footer_hyperlink_color( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_header_footer_hyperlink_color = '';
        if (isset( $options['productive_global_popup_header_footer_hyperlink_color']) ) {
            $productive_global_popup_header_footer_hyperlink_color = $options['productive_global_popup_header_footer_hyperlink_color'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#000000" class="productive_input_color_picker" type="text" name="productive_global_section_popup_options[productive_global_popup_header_footer_hyperlink_color]" value="<?php echo esc_attr( $productive_global_popup_header_footer_hyperlink_color ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
    <p>
        <?php echo esc_html__( 'Colour of hyperlink(s) in popup header and footer', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_header_footer_hyperlink_color_hover( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_header_footer_hyperlink_color_hover = '';
        if (isset( $options['productive_global_popup_header_footer_hyperlink_color_hover']) ) {
            $productive_global_popup_header_footer_hyperlink_color_hover = $options['productive_global_popup_header_footer_hyperlink_color_hover'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#999999" class="productive_input_color_picker" type="text" name="productive_global_section_popup_options[productive_global_popup_header_footer_hyperlink_color_hover]" value="<?php echo esc_attr( $productive_global_popup_header_footer_hyperlink_color_hover ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
    <p>
        <?php echo esc_html__( 'Colour of hyperlink(s) in popup header and footer on hover', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_close_button_color( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_close_button_color = '';
        if (isset( $options['productive_global_popup_close_button_color']) ) {
            $productive_global_popup_close_button_color = $options['productive_global_popup_close_button_color'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#000000" class="productive_input_color_picker" type="text" name="productive_global_section_popup_options[productive_global_popup_close_button_color]" value="<?php echo esc_attr( $productive_global_popup_close_button_color ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
    <p>
        <?php echo esc_html__( 'Close button colour', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_close_button_color_bg( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_close_button_color_bg = '';
        if (isset( $options['productive_global_popup_close_button_color_bg']) ) {
            $productive_global_popup_close_button_color_bg = $options['productive_global_popup_close_button_color_bg'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#f9f9f9" class="productive_input_color_picker" type="text" name="productive_global_section_popup_options[productive_global_popup_close_button_color_bg]" value="<?php echo esc_attr( $productive_global_popup_close_button_color_bg ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
    <p>
        <?php echo esc_html__( 'Close button background colour', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_close_button_color_hover( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_close_button_color_hover = '';
        if (isset( $options['productive_global_popup_close_button_color_hover']) ) {
            $productive_global_popup_close_button_color_hover = $options['productive_global_popup_close_button_color_hover'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#373737" class="productive_input_color_picker" type="text" name="productive_global_section_popup_options[productive_global_popup_close_button_color_hover]" value="<?php echo esc_attr( $productive_global_popup_close_button_color_hover ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
    <p>
        <?php echo esc_html__( 'Close button colour (on Hover)', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_close_button_color_hover_bg( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_close_button_color_hover_bg = '';
        if (isset( $options['productive_global_popup_close_button_color_hover_bg']) ) {
            $productive_global_popup_close_button_color_hover_bg = $options['productive_global_popup_close_button_color_hover_bg'];
        }
    ?>
    <p>
        <input data-alpha-enabled="true" data-default-color="#eef3f7" class="productive_input_color_picker" type="text" name="productive_global_section_popup_options[productive_global_popup_close_button_color_hover_bg]" value="<?php echo esc_attr( $productive_global_popup_close_button_color_hover_bg ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" />
    </p>
    <p>
        <?php echo esc_html__( 'Close button background colour (on Hover)', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_width_min( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_width_min = '';
        if (isset( $options['productive_global_popup_width_min']) ) {
            $productive_global_popup_width_min = $options['productive_global_popup_width_min'];
        }
    ?>
    <input type="number" name="productive_global_section_popup_options[productive_global_popup_width_min]" value="<?php echo esc_attr( $productive_global_popup_width_min ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
   <?php
}

function productive_global_callback_popup_width_max( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_width_max = '';
        if (isset( $options['productive_global_popup_width_max']) ) {
            $productive_global_popup_width_max = $options['productive_global_popup_width_max'];
        }
    ?>
    <input type="number" name="productive_global_section_popup_options[productive_global_popup_width_max]" value="<?php echo esc_attr( $productive_global_popup_width_max ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
   <?php
}

function productive_global_callback_popup_when_modal_goes_fullscreen( $args ) {
        $options = productive_global_get_section_popup_options_object();
        $productive_global_popup_when_modal_goes_fullscreen = '';
        if (isset( $options['productive_global_popup_when_modal_goes_fullscreen']) ) {
            $productive_global_popup_when_modal_goes_fullscreen = $options['productive_global_popup_when_modal_goes_fullscreen'];
        }
    ?>
    <input type="number" name="productive_global_section_popup_options[productive_global_popup_when_modal_goes_fullscreen]" value="<?php echo esc_attr( $productive_global_popup_when_modal_goes_fullscreen ); ?>" size="40" id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>" />
    <p>
        <?php echo esc_html__( 'Popuup will fill the screen both vertically and horizontally, at this screen size - set to 0 to disable this feature.', 'productive-forms' ); ?>
    </p>
   <?php
}

function productive_global_callback_popup_close_with_esc_key_enable() {
        $options = productive_global_get_section_popup_options_object();
        $is_on_productive_global_popup_close_with_esc_key_enable = '';
        if (isset( $options['is_on_productive_global_popup_close_with_esc_key_enable']) ) {
            $is_on_productive_global_popup_close_with_esc_key_enable = $options['is_on_productive_global_popup_close_with_esc_key_enable'];
        }
    ?>
    <p>
        <input id="productive_global_section_popup_options[is_on_productive_global_popup_close_with_esc_key_enable]" type="checkbox" name="productive_global_section_popup_options[is_on_productive_global_popup_close_with_esc_key_enable]" value="checked" <?php echo checked('checked', $is_on_productive_global_popup_close_with_esc_key_enable, false ); ?> />
        <label for="productive_global_section_popup_options[is_on_productive_global_popup_close_with_esc_key_enable]"><?php echo esc_html__( 'Allow users to close popup by pressing escape key on their keyboard?', 'productive-forms' ); ?></label>
    </p>
   <?php
}

function productive_global_callback_popup_close_with_click_elsewhere_enable() {
        $options = productive_global_get_section_popup_options_object();
        $is_on_productive_global_popup_close_with_click_elsewhere_enable = '';
        if (isset( $options['is_on_productive_global_popup_close_with_click_elsewhere_enable']) ) {
            $is_on_productive_global_popup_close_with_click_elsewhere_enable = $options['is_on_productive_global_popup_close_with_click_elsewhere_enable'];
        }
    ?>
    <p>
        <input id="productive_global_section_popup_options[is_on_productive_global_popup_close_with_click_elsewhere_enable]" type="checkbox" name="productive_global_section_popup_options[is_on_productive_global_popup_close_with_click_elsewhere_enable]" value="checked" <?php echo checked('checked', $is_on_productive_global_popup_close_with_click_elsewhere_enable, false ); ?> />
        <label for="productive_global_section_popup_options[is_on_productive_global_popup_close_with_click_elsewhere_enable]"><?php echo esc_html__( 'Allow users to close popup by clicking outside the popup modal?', 'productive-forms' ); ?></label>
    </p>
   <?php
}

function productive_global_callback_popup_bg_opacity( $args ) {
    $options = productive_global_get_section_popup_options_object();
    $productive_global_popup_bg_opacity = '';
    if( isset( $options['productive_global_popup_bg_opacity'] ) ) {
        $productive_global_popup_bg_opacity = $options['productive_global_popup_bg_opacity'];
    }
    ?>
        <select id="<?php echo esc_attr( $args['label_for'] ); ?>" class="<?php echo esc_attr( $args['class'] ); ?>"
                    name="productive_global_section_popup_options[productive_global_popup_bg_opacity]">
            <?php
                $productive_global_get_popup_bg_opacity_options = productive_global_get_popup_bg_opacity_options();
                foreach ( $productive_global_get_popup_bg_opacity_options as $key => $productive_global_get_popup_bg_opacity_option ) {
                    ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php echo selected( $productive_global_popup_bg_opacity, esc_attr( $key ), false ); ?>>
                       <?php echo esc_html( $productive_global_get_popup_bg_opacity_option ); ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <p>
            <?php echo esc_html__( 'Popup background transparency (opacity)', 'productive-forms' ); ?>
        </p>
    <?php
}

function productive_global_callback_popup_use_theme_style() {
        $options = productive_global_get_section_popup_options_object();
        $is_on_productive_global_popup_use_theme_style = '';
        if (isset( $options['is_on_productive_global_popup_use_theme_style']) ) {
            $is_on_productive_global_popup_use_theme_style = $options['is_on_productive_global_popup_use_theme_style'];
        }
    ?>
    <p>
        <input id="productive_global_section_popup_options[is_on_productive_global_popup_use_theme_style]" type="checkbox" name="productive_global_section_popup_options[is_on_productive_global_popup_use_theme_style]" value="checked" <?php echo checked('checked', $is_on_productive_global_popup_use_theme_style, false ); ?> />
        <label for="productive_global_section_popup_options[is_on_productive_global_popup_use_theme_style]"><?php echo esc_html__( 'Ignore settings on this page and use theme css styles instead. Effective only when using one of our themes. ', 'productive-forms' ); ?></label>
    </p>
   <?php
}

/* ============ END Section fields ================= */
// Stop: Popup