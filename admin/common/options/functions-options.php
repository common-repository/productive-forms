<?php
/**
 * The function php file contain all theme-based customisation and functions
 * including several hooks used within the theme
 *
 * @package    productive-forms
 */

$productive_forms_section_options_contact        = get_option( 'productive_forms_section_contact_options' );
$productive_forms_section_options_newsletter     = get_option( 'productive_forms_section_newsletter_options' );
$productive_forms_section_options_integration    = get_option( 'productive_forms_section_integration_options' );

$productive_forms_social_icons_dimension = 30;
$productive_forms_social_icons_css = '';
$productive_forms_social_icons_args_facebook = array(
    'i'=> 'facebook', 
    'w'=>$productive_forms_social_icons_dimension, 
    'h'=>$productive_forms_social_icons_dimension, 
    'css'=>$productive_forms_social_icons_css
);
$productive_forms_social_icons_args_youtube = array(
    'i'=> 'youtube', 
    'w'=>$productive_forms_social_icons_dimension, 
    'h'=>$productive_forms_social_icons_dimension, 
    'css'=>$productive_forms_social_icons_css
);
$productive_forms_social_icons_args_twitter = array(
    'i'=> 'twitter', 
    'w'=>$productive_forms_social_icons_dimension, 
    'h'=>$productive_forms_social_icons_dimension, 
    'css'=>$productive_forms_social_icons_css
);
$productive_forms_social_icons_args_twitter_x = array(
    'i'=> 'twitter-x', 
    'w'=>$productive_forms_social_icons_dimension, 
    'h'=>$productive_forms_social_icons_dimension, 
    'css'=>$productive_forms_social_icons_css
);
$productive_forms_social_icons_args_pinterest = array(
    'i'=> 'pinterest', 
    'w'=>$productive_forms_social_icons_dimension, 
    'h'=>$productive_forms_social_icons_dimension, 
    'css'=>$productive_forms_social_icons_css
);
$productive_forms_social_icons_args_instagram = array(
    'i'=> 'instagram', 
    'w'=>$productive_forms_social_icons_dimension, 
    'h'=>$productive_forms_social_icons_dimension, 
    'css'=>$productive_forms_social_icons_css
);
$productive_forms_social_icons_args_whatsapp = array(
    'i'=> 'whatsapp', 
    'w'=>$productive_forms_social_icons_dimension, 
    'h'=>$productive_forms_social_icons_dimension, 
    'css'=>$productive_forms_social_icons_css
);
$productive_forms_social_icons_args_email = array(
    'i'=> 'inbox-icon-only', 
    'w'=>$productive_forms_social_icons_dimension, 
    'h'=>$productive_forms_social_icons_dimension, 
    'css'=>$productive_forms_social_icons_css
);


$productive_forms_contact_icons_dimension = 25;
$productive_forms_contact_icons_css = '';
$productive_forms_contact_icons_args_envelope = array(
    'i'=> 'envelope', 
    'w'=>$productive_forms_contact_icons_dimension, 
    'h'=>$productive_forms_contact_icons_dimension, 
    'css'=>$productive_forms_contact_icons_css
);
$productive_forms_contact_icons_args_phone_square = array(
    'i'=> 'phone-square', 
    'w'=>$productive_forms_contact_icons_dimension, 
    'h'=>$productive_forms_contact_icons_dimension, 
    'css'=>$productive_forms_contact_icons_css
);
$productive_forms_contact_icons_args_envelope_icon_only = array(
    'i'=> 'envelope-icon-only', 
    'w'=>$productive_forms_contact_icons_dimension, 
    'h'=>$productive_forms_contact_icons_dimension, 
    'css'=>$productive_forms_contact_icons_css
);
$productive_forms_contact_icons_args_phone_square_icon_only = array(
    'i'=> 'phone-square-icon-only', 
    'w'=>$productive_forms_contact_icons_dimension, 
    'h'=>$productive_forms_contact_icons_dimension, 
    'css'=>$productive_forms_contact_icons_css
);
$productive_forms_contact_icons_args_whatsapp_as_address = array(
    'i'=> 'whatsapp-as-address', 
    'w'=>$productive_forms_contact_icons_dimension, 
    'h'=>$productive_forms_contact_icons_dimension, 
    'css'=>$productive_forms_contact_icons_css
);
$productive_forms_contact_icons_args_map_marker = array(
    'i'=> 'map-marker', 
    'w'=>$productive_forms_contact_icons_dimension, 
    'h'=>$productive_forms_contact_icons_dimension, 
    'css'=>$productive_forms_contact_icons_css
);

$productive_forms_brand_color_around_white_icon = productive_global_sharing_brand_color_around_white_icon();


function productive_forms_render_contact_info_heading( $heading_text = '' ) {
    if( !empty($heading_text) ) {
        return '<div class="contact-and-address-heading-container"><span class="contact-and-address-heading">' . esc_html($heading_text) . '</span></div>';
    }
}

function productive_forms_render_contact_info_heading_with_icon( $heading_text = '', $productive_forms_contact_icons_args_map_marker = array() ) {
    if( !empty($heading_text) && null != $productive_forms_contact_icons_args_map_marker ) {
        echo '<div class="contact-and-address-heading productiveminds-alignable-container flexed flexed-inlined flexed-in-a-flexed align-items-center align-content-center gap-5px">';
        echo '<span class="social-address icon">';
                do_action( 'display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_map_marker ); 
        echo '</span>';
        echo '<span class="">' . esc_html($heading_text) . '</span>';
        echo '</div>';
    }
}


// START ============== Productive_Theme_Customiser_Social CUSTOMISERS
/**
 * Method productive_forms_social_facebook.
 *
 * @param string $class ''.
 */
function productive_forms_social_facebook( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_social_icons_args_facebook, $productive_forms_brand_color_around_white_icon;    
    if ( isset( $productive_forms_section_options_contact['social_facebook'] )) {
        $option_value = sanitize_url( $productive_forms_section_options_contact['social_facebook'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_facebook['css'] = 'facebook';
        }
        echo '<a class="facebook-share-button ' . $productive_forms_brand_color_around_white_icon . '" aria-label="' . __( 'Facebook', 'productive-forms' ) . '" target="_blank" title="' . __( 'Facebook', 'productive-forms' ) . '" href="' . esc_attr( $option_value ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_facebook);
        echo '</a>';
    }
}
add_action( 'display_productive_forms_social_facebook', 'productive_forms_social_facebook' );


/**
 * Method productive_forms_social_youtube.
 *
 * @param string $class ''.
 */
function productive_forms_social_youtube( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_social_icons_args_youtube, $productive_forms_brand_color_around_white_icon;
    if ( isset( $productive_forms_section_options_contact['social_youtube'] )) {
        $option_value = sanitize_url( $productive_forms_section_options_contact['social_youtube'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_youtube['css'] = 'youtube';
        }
        echo '<a class="youtube-share-button ' . $productive_forms_brand_color_around_white_icon . '" aria-label="' . __( 'YouTube', 'productive-forms' ) . '" target="_blank" title="' . __( 'YouTube', 'productive-forms' ) . '" href="' . esc_attr( $option_value ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_youtube);
        echo '</a>';
    }
}
add_action( 'display_productive_forms_social_youtube', 'productive_forms_social_youtube' );


/**
 * Method productive_forms_social_twitter.
 *
 * @param string $class ''.
 */
function productive_forms_social_twitter( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_social_icons_args_twitter_x, $productive_forms_brand_color_around_white_icon;
    if ( isset( $productive_forms_section_options_contact['social_twitter'] )) {
        $option_value = sanitize_url( $productive_forms_section_options_contact['social_twitter'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_twitter_x['css'] = 'twitter-x';
        }
        echo '<a class="twitter-x-share-button ' . $productive_forms_brand_color_around_white_icon . '" aria-label="' . __( 'Twitter', 'productive-forms' ) . '" target="_blank" title="' . __( 'Twitter', 'productive-forms' ) . '" href="' . esc_attr( $option_value ) . '">';
        do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_twitter_x);
        echo '</a>';
    }
}
add_action( 'display_productive_forms_social_twitter', 'productive_forms_social_twitter' );


/**
 * Method productive_forms_social_pinterest.
 *
 * @param string $class ''.
 */
function productive_forms_social_pinterest( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_social_icons_args_pinterest, $productive_forms_brand_color_around_white_icon;
    if ( isset( $productive_forms_section_options_contact['social_pinterest'] )) {
        $option_value = sanitize_url( $productive_forms_section_options_contact['social_pinterest'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_pinterest['css'] = 'pinterest';
        }
        echo '<a class="pinterest-share-button ' . $productive_forms_brand_color_around_white_icon . '" aria-label="' . __( 'PInterest', 'productive-forms' ) . '" target="_blank" title="' . __( 'PInterest', 'productive-forms' ) . '" href="' . esc_attr( $option_value ) . '">';
        do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_pinterest);
        echo '</a>';
    }
}
add_action( 'display_productive_forms_social_pinterest', 'productive_forms_social_pinterest' );


/**
 * Method productive_forms_social_instagram.
 *
 * @param string $class ''.
 */
function productive_forms_social_instagram( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_social_icons_args_instagram, $productive_forms_brand_color_around_white_icon;
    if ( isset( $productive_forms_section_options_contact['social_instagram'] )) {
        $option_value = sanitize_url( $productive_forms_section_options_contact['social_instagram'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_instagram['css'] = 'instagram';
        }
        echo '<a class="instagram-share-button ' . $productive_forms_brand_color_around_white_icon . '" aria-label="' . __( 'Instagram', 'productive-forms' ) . '" target="_blank" title="' . __( 'Instagram', 'productive-forms' ) . '" href="' . esc_attr( $option_value ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_instagram);
        echo '</a>';
    }
}
add_action( 'display_productive_forms_social_instagram', 'productive_forms_social_instagram' );

/**
 * Method productive_forms_contact_whatsapp.
 *
 * @param string $class ''.
 */
function productive_forms_contact_whatsapp( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_social_icons_args_whatsapp, $productive_forms_brand_color_around_white_icon;
    if ( productive_is_using_contact_whatsapp_dial_code() &&  isset( $productive_forms_section_options_contact['contact_whatsapp'] )) {        
        $contact_whatsapp_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp_dial_code'] );
        $contact_whatsapp = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp'] );
        $option_value = $contact_whatsapp_dial_code . ' ' . $contact_whatsapp;
        $option_value_whatsapp_to_send = str_replace('+', '', $contact_whatsapp_dial_code) . '' . str_replace(' ', '', $contact_whatsapp);
    } else {
        $option_value = '';
    }
    
    if ( !empty($option_value) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_whatsapp['css'] = 'whatsapp';
        }
        echo '<a class="whatsapp-share-button ' . $productive_forms_brand_color_around_white_icon . '" aria-label="' . __( 'WhatsApp', 'productive-forms' ) . '" target="_blank" title="' . __( 'WhatsApp', 'productive-forms' ) . '" href="' . esc_url( 'https://api.whatsapp.com/send?phone=' . $option_value_whatsapp_to_send ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_whatsapp);
        echo '</a>';
    }
}
add_action( 'display_productive_forms_contact_whatsapp', 'productive_forms_contact_whatsapp' );


/**
 * Method productive_forms_contact_how_to_process_contact_submissions.
 *
 * @param string $class ''.
 */
function productive_forms_contact_whatsapp_usage( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_whatsapp_usage'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp_usage'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_social_media_block.
 *
 * @param string $icon_color_style ''.
 */
function productive_forms_social_media_block( $productive_forms_header_contact_section_use_official_sm_colours = 'brand_color_around_white_icon' ) {
    global $productive_forms_section_options_contact, $productive_forms_social_icons_args_facebook, $productive_forms_social_icons_args_youtube, 
            $productive_forms_social_icons_args_twitter_x, $productive_forms_social_icons_args_pinterest, $productive_forms_social_icons_args_instagram, 
            $productive_forms_social_icons_args_whatsapp;
    ?>
    <span class="<?php echo $productive_forms_header_contact_section_use_official_sm_colours; ?> productiveminds-alignable-container flexed flexed-inlined flexed-in-a-flexed align-items-center align-content-center row-gap-5px column-gap-20px">
    <?php
    if ( isset( $productive_forms_section_options_contact['social_facebook'] )) {
        $option_value_facebook = sanitize_url( $productive_forms_section_options_contact['social_facebook'] );
    } else {
        $option_value_facebook = '';
    }
    if ( !empty($option_value_facebook) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_facebook['css'] = 'facebook';
        }
        echo '<a class="facebook-share-button ' . $productive_forms_header_contact_section_use_official_sm_colours . '" aria-label="' . __( 'Facebook', 'productive-forms' ) . '" target="_blank" title="' . __( 'Facebook', 'productive-forms' ) . '" href="' . esc_attr( $option_value_facebook ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_facebook); 
        echo '</a>';
    }
    
    if ( isset( $productive_forms_section_options_contact['social_youtube'] )) {
        $option_value_youtube = sanitize_url( $productive_forms_section_options_contact['social_youtube'] );
    } else {
        $option_value_youtube = '';
    }
    if ( !empty($option_value_youtube) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_youtube['css'] = 'youtube';
        }
        echo '<a class="youtube-share-button ' . $productive_forms_header_contact_section_use_official_sm_colours . '" aria-label="' . __( 'YouTube', 'productive-forms' ) . '" target="_blank" title="' . __( 'YouTube', 'productive-forms' ) . '" href="' . esc_attr( $option_value_youtube ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_youtube);
        echo '</a>';
    }
    
    if ( isset( $productive_forms_section_options_contact['social_twitter'] )) {
        $option_value_twitter = sanitize_url( $productive_forms_section_options_contact['social_twitter'] );
    } else {
        $option_value_twitter = '';
    }
    if ( !empty($option_value_twitter) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_twitter_x['css'] = 'twitter-x';
        }
        echo '<a class="twitter-x-share-button ' . $productive_forms_header_contact_section_use_official_sm_colours . '" aria-label="' . __( 'Twitter', 'productive-forms' ) . '" target="_blank" title="' . __( 'Twitter', 'productive-forms' ) . '" href="' . esc_attr( $option_value_twitter ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_twitter_x);
        echo '</a>';
    }
    
    if ( isset( $productive_forms_section_options_contact['social_pinterest'] )) {
        $option_value_pinterest = sanitize_url( $productive_forms_section_options_contact['social_pinterest'] );
    } else {
        $option_value_pinterest = '';
    }
    if ( !empty($option_value_pinterest) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_pinterest['css'] = 'pinterest';
        }
        echo '<a class="pinterest-share-button ' . $productive_forms_header_contact_section_use_official_sm_colours . '" aria-label="' . __( 'PInterest', 'productive-forms' ) . '" target="_blank" title="' . __( 'PInterest', 'productive-forms' ) . '" href="' . esc_attr( $option_value_pinterest ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_pinterest);
        echo '</a>';
    }
    
    if ( isset( $productive_forms_section_options_contact['social_instagram'] )) {
        $option_value_instagram = sanitize_url( $productive_forms_section_options_contact['social_instagram'] );
    } else {
        $option_value_instagram = '';
    }
    if ( !empty($option_value_instagram) ) {
        if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
            $productive_forms_social_icons_args_instagram['css'] = 'instagram';
        }
        echo '<a class="instagram-share-button ' . $productive_forms_header_contact_section_use_official_sm_colours . '" aria-label="' . __( 'Instagram', 'productive-forms' ) . '" target="_blank" title="' . __( 'Instagram', 'productive-forms' ) . '" href="' . esc_attr( $option_value_instagram ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_instagram);
        echo '</a>';
    }
    
    $whatsapp_usage = productive_forms_contact_whatsapp_usage();
    if ( ($whatsapp_usage == 'social_media_only' || $whatsapp_usage == 'phone_and_social_media') ) {
        if ( productive_is_using_contact_whatsapp_dial_code() &&  isset( $productive_forms_section_options_contact['contact_whatsapp'] )) {        
            $contact_whatsapp_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp_dial_code'] );
            $contact_whatsapp = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp'] );
            $option_value_whatsapp = $contact_whatsapp_dial_code . ' ' . $contact_whatsapp;
            $option_value_whatsapp_to_send = str_replace('+', '', $contact_whatsapp_dial_code) . '' . str_replace(' ', '', $contact_whatsapp);
        } else {
            $option_value_whatsapp = '';
        }
        if ( !empty($option_value_whatsapp) ) {
            if ( is_on_productive_forms_contact_icon_color_use_default_socialmedia() ) {
                $productive_forms_social_icons_args_whatsapp['css'] = 'whatsapp';
            }
            echo '<a class="whatsapp-share-button ' . $productive_forms_header_contact_section_use_official_sm_colours . '" aria-label="' . __( 'WhatsApp', 'productive-forms' ) . '" target="_blank" title="' . __( 'WhatsApp', 'productive-forms' ) . '" href="' . esc_url( 'https://api.whatsapp.com/send?phone=' . $option_value_whatsapp_to_send ) . '">';
                do_action('display_productiveminds_display_font_icon', $productive_forms_social_icons_args_whatsapp);
            echo '</a>';
        }
    }
    ?>
    </span>
    <?php
}
add_action( 'display_productive_forms_social_media_block', 'productive_forms_social_media_block' );


/**
 * Method productive_forms_social_media_block.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_social_media_block() {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['social_facebook'] )) {
        $option_value_facebook = sanitize_url( $productive_forms_section_options_contact['social_facebook'] );
    } else {
        $option_value_facebook = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['social_youtube'] )) {
        $option_value_youtube = sanitize_url( $productive_forms_section_options_contact['social_youtube'] );
    } else {
        $option_value_youtube = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['social_twitter'] )) {
        $option_value_twitter = sanitize_url( $productive_forms_section_options_contact['social_twitter'] );
    } else {
        $option_value_twitter = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['social_pinterest'] )) {
        $option_value_pinterest = sanitize_url( $productive_forms_section_options_contact['social_pinterest'] );
    } else {
        $option_value_pinterest = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['social_instagram'] )) {
        $option_value_instagram = sanitize_url( $productive_forms_section_options_contact['social_instagram'] );
    } else {
        $option_value_instagram = '';
    }
    
    $whatsapp_usage = productive_forms_contact_whatsapp_usage();
    if ( ($whatsapp_usage == 'social_media_only' || $whatsapp_usage == 'phone_and_social_media') ) {
        if ( productive_is_using_contact_whatsapp_dial_code() &&  isset( $productive_forms_section_options_contact['contact_whatsapp'] )) {        
            $contact_whatsapp_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp_dial_code'] );
            $contact_whatsapp = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp'] );
            $option_value_whatsapp = $contact_whatsapp_dial_code . ' ' . $contact_whatsapp;
        } else {
            $option_value_whatsapp = '';
        }
    }
    return !empty($option_value_facebook) ||
        !empty($option_value_youtube) ||
        !empty($option_value_twitter) ||
        !empty($option_value_pinterest) ||
        !empty($option_value_instagram) ||
        !empty($option_value_whatsapp);
}

/**
 * Method productive_forms_post_contact_icons_color_socialmedia.
 *
 * @param string $class ''.
 */
function productive_forms_post_contact_icons_color_socialmedia( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_icon_color_socialmedia'] )) {
        $option_value = sanitize_hex_color( $productive_forms_section_options_contact['contact_icon_color_socialmedia'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method is_on_productive_forms_contact_icon_color_use_default_socialmedia.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_contact_icon_color_use_default_socialmedia() {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_icon_color_use_default_socialmedia'] )) {
        return sanitize_text_field( $productive_forms_section_options_contact['contact_icon_color_use_default_socialmedia'] );
    } else {
        return false;
    }
}

/**
 * Method is_on_productive_forms_contact_show_social_media_on_contact_page.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_contact_show_social_media_on_contact_page() {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_show_social_media_on_contact_page'] )) {
        return sanitize_text_field( $productive_forms_section_options_contact['contact_show_social_media_on_contact_page'] );
    } else {
        return false;
    }
}

/**
 * Method is_on_productive_forms_contact_show_business_hour_on_contact_page.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_contact_show_business_hour_on_contact_page() {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_show_business_hour_on_contact_page'] )) {
        return sanitize_text_field( $productive_forms_section_options_contact['contact_show_business_hour_on_contact_page'] );
    } else {
        return false;
    }
}

/**
 * Method productive_forms_contact_what_to_display_in_floating_buttons.
 *
 * @param string $class ''.
 */
function productive_forms_contact_what_to_display_in_floating_buttons( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['what_to_display_in_floating_buttons'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['what_to_display_in_floating_buttons'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_what_to_display_in_floating_buttons', 'productive_forms_contact_what_to_display_in_floating_buttons' );

/**
 * Method productive_forms_contact_floating_buttons_placement_vertical.
 *
 * @param string $class ''.
 */
function productive_forms_contact_floating_buttons_placement_vertical( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['floating_buttons_placement_vertical'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['floating_buttons_placement_vertical'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_floating_buttons_placement_vertical', 'productive_forms_contact_floating_buttons_placement_vertical' );

/**
 * Method productive_forms_contact_floating_buttons_placement_horizontal.
 *
 * @param string $class ''.
 */
function productive_forms_contact_floating_buttons_placement_horizontal( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['floating_buttons_placement_horizontal'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['floating_buttons_placement_horizontal'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_floating_buttons_placement_horizontal', 'productive_forms_contact_floating_buttons_placement_horizontal' );


// START ============== Productive_Theme_Customiser_Contact CUSTOMISERS

/**
 * Method productive_forms_contact_location_heading.
 *
 * @param string $class ''.
 */
function productive_forms_contact_location_heading() {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_location_heading'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['contact_location_heading'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_contact_email.
 *
 * @param string $class ''.
 */
function productive_forms_contact_email( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_envelope;
    if ( isset( $productive_forms_section_options_contact['contact_email'] )) {
        $option_value = sanitize_email( $productive_forms_section_options_contact['contact_email'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        $item_value = __( 'EMAIL', 'productive-forms' );
        echo '<span class="social-email icon">'; 
            do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_envelope);
        echo '</span>';
        echo '<span class="social-email title ' . esc_attr( $class ) . '">' . esc_html($item_value) . '</span>';
        echo '<a aria-label="' . esc_attr( $option_value ) . __( ' (Email)', 'productive-forms' ) . '" href="mailto:' . esc_attr( $option_value ) . '"><span class="social-email">' . esc_html( $option_value ) . '</span></a>';
    }
}
add_action( 'display_productive_forms_contact_email', 'productive_forms_contact_email' );

/**
 * Method productive_forms_contact_phone.
 *
 * @param string $class ''.
 */
function productive_forms_contact_phone( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_phone_square;
    if ( productive_is_using_contact_phone_dial_code() && isset( $productive_forms_section_options_contact['contact_phone'] )  ) {
        $contact_phone_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_phone_dial_code'] );
        $contact_phone = sanitize_text_field( $productive_forms_section_options_contact['contact_phone'] );
        $option_value = $contact_phone_dial_code . ' ' . $contact_phone;
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        $item_value = __( 'PHONE', 'productive-forms' );
        echo '<span class="social-phone icon">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_phone_square);
        echo '</span>';
        echo '<span class="social-phone title ' . esc_attr( $class ) . '">' . esc_html($item_value) . '</span>';
        echo '<a aria-label="' . esc_attr( $option_value ) . __( ' (Phone)', 'productive-forms' ) . '" href="tel:' . esc_attr( $option_value ) . '"><span class="social-phone">' . esc_html( $option_value ) . '</span></a>';
    }
}
add_action( 'display_productive_forms_contact_phone', 'productive_forms_contact_phone' );

/**
 * Method productive_forms_contact_email_and_phone.
 *
 * @param string $class ''.
 */
function productive_forms_contact_email_and_phone( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_envelope, $productive_forms_contact_icons_args_phone_square;
    if ( isset( $productive_forms_section_options_contact['contact_email'] )) {
        $option_value_email = sanitize_email( $productive_forms_section_options_contact['contact_email'] );
    } else {
        $option_value_email = '';
    }
    if ( !empty($option_value_email) ) {   
        $item_value = __( 'EMAIL', 'productive-forms' );
        echo '<span class="social-email icon">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_envelope);
        echo '</span>';
        echo '<span class="social-email title ' . esc_attr( $class ) . '">' . esc_html($item_value) . '</span>';
        echo '<a aria-label="' . esc_attr( $option_value_email ) . __( ' (Email)', 'productive-forms' ) . '" href="mailto:' . esc_attr( $option_value_email ) . '"><span class="social-email">' . esc_html( $option_value_email ) . '</span></a>';
    }
    
    if ( productive_is_using_contact_phone_dial_code() && isset( $productive_forms_section_options_contact['contact_phone'] )  ) {
        $contact_phone_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_phone_dial_code'] );
        $contact_phone = sanitize_text_field( $productive_forms_section_options_contact['contact_phone'] );
        $option_value_phone = $contact_phone_dial_code . ' ' . $contact_phone;
    } else {
        $option_value_phone = '';
    }
    if ( !empty($option_value_phone) ) {        
        $item_value = __( 'PHONE', 'productive-forms' );
        echo '<span class="social-phone icon">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_phone_square);
        echo '</span>';
        echo '<span class="social-phone title ' . esc_attr( $class ) . '">' . esc_html($item_value) . '</span>';
        echo '<a aria-label="' . esc_attr( $option_value_phone ) . __( ' (Phone)', 'productive-forms' ) . '" href="tel:' . esc_attr(  $option_value_phone ) . '"><span class="social-phone">' . esc_html( $option_value_phone ) . '</span></a>';
    }
}
add_action( 'display_productive_forms_contact_email_and_phone', 'productive_forms_contact_email_and_phone' );

/**
 * Method productive_forms_contact_email_icon_only.
 *
 * @param string $class ''.
 */
function productive_forms_contact_email_icon_only( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_envelope_icon_only;
    if ( isset( $productive_forms_section_options_contact['contact_email'] )) {
        $option_value = sanitize_email( $productive_forms_section_options_contact['contact_email'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {   
        echo '<a aria-label="' . esc_attr( $option_value ) . __( ' (Email)', 'productive-forms' ) . '" target="_blank" title="' . __( 'Email', 'productive-forms' ) . '" href="mailto:' . esc_attr( $option_value ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_envelope_icon_only);
        echo '</a>';
    }
}
add_action( 'display_productive_forms_contact_email_icon_only', 'productive_forms_contact_email_icon_only' );

/**
 * Method productive_forms_contact_phone_icon_only.
 *
 * @param string $class ''.
 */
function productive_forms_contact_phone_icon_only( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_phone_square_icon_only;
    if ( productive_is_using_contact_phone_dial_code() && isset( $productive_forms_section_options_contact['contact_phone'] )  ) {
        $contact_phone_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_phone_dial_code'] );
        $contact_phone = sanitize_text_field( $productive_forms_section_options_contact['contact_phone'] );
        $option_value = $contact_phone_dial_code . ' ' . $contact_phone;
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {        
        echo '<a aria-label="' . esc_attr( $option_value ) . __( ' (Phone)', 'productive-forms' ) . '" target="_blank" title="' . __( 'Phone', 'productive-forms' ) . '" href="tel:' . esc_attr(  $option_value ) . '">';
            do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_phone_square_icon_only);
        echo '</a>';
    }
}
add_action( 'display_productive_forms_contact_phone_icon_only', 'productive_forms_contact_phone_icon_only' );

/**
 * Method productive_forms_contact_whatsapp_icon_only.
 *
 * @param string $class ''.
 */
function productive_forms_contact_whatsapp_icon_only( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_whatsapp_as_address;
    if ( productive_is_using_contact_whatsapp_dial_code() &&  isset( $productive_forms_section_options_contact['contact_whatsapp'] )) {        
            $contact_whatsapp_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp_dial_code'] );
            $contact_whatsapp = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp'] );
            $option_value_whatsapp = $contact_whatsapp_dial_code . ' ' . $contact_whatsapp;
            $option_value_whatsapp_to_send = str_replace('+', '', $contact_whatsapp_dial_code) . '' . str_replace(' ', '', $contact_whatsapp);
        } else {
            $option_value_whatsapp = '';
        }

        if ( !empty($option_value_whatsapp) ) {       
            echo '<a class="productiveminds-alignable-container flexed align-items-center align-content-center row-gap-5px column-gap-5px" aria-label="' . __( 'WhatsApp', 'productive-forms' ) . '" target="_blank" title="' . __( 'WhatsApp', 'productive-forms' ) . '" href="' . esc_url( 'https://api.whatsapp.com/send?phone=' . $option_value_whatsapp_to_send ) . '">';
                do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_whatsapp_as_address);
            echo '</a>';
        }
}
add_action( 'display_productive_forms_contact_whatsapp_icon_only', 'productive_forms_contact_whatsapp_icon_only' );

/**
 * Method productive_forms_contact_email_themes.
 *
 * @param string $hide_icon.
 */
function productive_forms_contact_email_themes( $hide_icon = '0' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_envelope;
    if ( isset( $productive_forms_section_options_contact['contact_email'] )) {
        $option_value = sanitize_email( $productive_forms_section_options_contact['contact_email'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        ?>
        <a class="blocked" aria-label="<?php echo esc_attr( $option_value )?>" 
           href="mailto:<?php echo esc_attr( $option_value )?>"
              class="">
            <span class="social-email productiveminds-alignable-container flexed align-items-center align-content-center row-gap-5px column-gap-10px">
                <?php if ( !intval($hide_icon) ) { do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_envelope); } ?>
                <?php echo esc_attr( $option_value )?>
            </span>
        </a>
        <?php
    }
}
add_action( 'display_productive_forms_contact_email_themes', 'productive_forms_contact_email_themes' );

/**
 * Method productive_forms_contact_phone_themes.
 *
 * @param string $hide_icon.
 */
function productive_forms_contact_phone_themes( $hide_icon = '0' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_phone_square;
    
    if ( productive_is_using_contact_phone_dial_code() && isset( $productive_forms_section_options_contact['contact_phone'] )  ) {
        $contact_phone_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_phone_dial_code'] );
        $contact_phone = sanitize_text_field( $productive_forms_section_options_contact['contact_phone'] );
        $option_value = $contact_phone_dial_code .  ' ' . $contact_phone;
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {        
        echo '<a class="blocked" aria-label="' . esc_attr( $option_value ) . __( ' (Phone)', 'productive-forms' ) . '" href="tel:' . esc_attr(  $option_value ) . '">'
                . '<span class="social-phone productiveminds-alignable-container flexed align-items-center align-content-center row-gap-5px column-gap-5px">';
            if ( !intval($hide_icon) ) { do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_phone_square); }
        echo '' . esc_html( $option_value ) . '</span></a>';
    }
    
} 
add_action( 'display_productive_forms_contact_phone_themes', 'productive_forms_contact_phone_themes' );

/**
 * Method productive_forms_contact_whatsapp.
 *
 * @param string $hide_icon.
 */
function productive_forms_contact_whatsapp_themes( $hide_icon = '0' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_whatsapp_as_address;
    
    $whatsapp_usage = productive_forms_contact_whatsapp_usage();
    if ( ($whatsapp_usage == 'phone_only' || $whatsapp_usage == 'phone_and_social_media') ) {
        if ( productive_is_using_contact_whatsapp_dial_code() &&  isset( $productive_forms_section_options_contact['contact_whatsapp'] )) {        
            $contact_whatsapp_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp_dial_code'] );
            $contact_whatsapp = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp'] );
            $option_value_whatsapp = $contact_whatsapp_dial_code . ' ' . $contact_whatsapp;
            $option_value_whatsapp_to_send = str_replace('+', '', $contact_whatsapp_dial_code) . '' . str_replace(' ', '', $contact_whatsapp);
        } else {
            $option_value_whatsapp = '';
        }

        if ( !empty($option_value_whatsapp) ) {       
            echo '<a class="blocked" aria-label="' . __( 'WhatsApp', 'productive-forms' ) . '" target="_blank" title="' . __( 'WhatsApp', 'productive-forms' ) . '" href="' . esc_url( 'https://api.whatsapp.com/send?phone=' . $option_value_whatsapp_to_send ) . '">'
                    . '<span class="social-phone productiveminds-alignable-container flexed align-items-center align-content-center row-gap-5px column-gap-5px">';
                if ( !intval($hide_icon) ) { do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_whatsapp_as_address); }
            echo '' . esc_html( $option_value_whatsapp ) . '</span></a>';
        }
    }
}
add_action( 'display_productive_forms_contact_whatsapp_themes', 'productive_forms_contact_whatsapp_themes' );

/**
 * Method productive_forms_contact_email_and_phone_themes.
 *
 * @param string $class ''.
 */
function productive_forms_contact_email_and_phone_themes( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_envelope, $productive_forms_contact_icons_args_phone_square, $productive_forms_contact_icons_args_whatsapp_as_address;
    ?>
    <span class="productiveminds-alignable-container flexed align-items-center align-content-center row-gap-5px column-gap-20px">
    <?php
    
        if ( isset( $productive_forms_section_options_contact['contact_email'] )) {
            $option_value_email = sanitize_email( $productive_forms_section_options_contact['contact_email'] );
        } else {
            $option_value_email = '';
        }
        if ( !empty($option_value_email) ) {
            echo '<a aria-label="' . esc_attr( $option_value_email ) . __( ' (Email)', 'productive-forms' ) . '" href="mailto:' . esc_attr( $option_value_email ) . '"><span class="social-email productiveminds-alignable-container flexed-inlined flexed-in-a-flexed align-items-center align-content-center gap-10px">';
                do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_envelope);
            echo '' . esc_html( $option_value_email ) . '</span></a>';
        }

        if ( productive_is_using_contact_phone_dial_code() && isset( $productive_forms_section_options_contact['contact_phone'] )  ) {
            $contact_phone_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_phone_dial_code'] );
            $contact_phone = sanitize_text_field( $productive_forms_section_options_contact['contact_phone'] );
            $option_value_phone = $contact_phone_dial_code . ' ' . $contact_phone;
        } else {
            $option_value_phone = '';
        }
        if ( !empty($option_value_phone) ) {        
            echo '<a aria-label="' . esc_attr( $option_value_phone ) . __( ' (Phone)', 'productive-forms' ) . '" href="tel:' . esc_attr(  $option_value_phone ) . '"><span class="social-phone productiveminds-alignable-container flexed-inlined flexed-in-a-flexed align-items-center align-content-center gap-5px">';
                do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_phone_square);
            echo '' . esc_html( $option_value_phone ) . '</span></a>';
        }

        $whatsapp_usage = productive_forms_contact_whatsapp_usage();
        if ( ($whatsapp_usage == 'phone_only' || $whatsapp_usage == 'phone_and_social_media') ) {
            if ( productive_is_using_contact_whatsapp_dial_code() &&  isset( $productive_forms_section_options_contact['contact_whatsapp'] )) {        
                $contact_whatsapp_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp_dial_code'] );
                $contact_whatsapp = sanitize_text_field( $productive_forms_section_options_contact['contact_whatsapp'] );
                $option_value_whatsapp = $contact_whatsapp_dial_code . ' ' . $contact_whatsapp;
                $option_value_whatsapp_to_send = str_replace('+', '', $contact_whatsapp_dial_code) . '' . str_replace(' ', '', $contact_whatsapp);
            } else {
                $option_value_whatsapp = '';
            }

            if ( !empty($option_value_whatsapp) ) {       
                echo '<a aria-label="' . esc_attr( 'WhatsApp', 'productive-forms' ) . '" target="_blank" title="' . esc_attr( 'WhatsApp', 'productive-forms' ) . '" href="' . esc_url( 'https://api.whatsapp.com/send?phone=' . $option_value_whatsapp_to_send ) . '"><span class="social-phone productiveminds-alignable-container flexed-inlined flexed-in-a-flexed align-items-center align-content-center gap-5px">';
                    do_action('display_productiveminds_display_font_icon', $productive_forms_contact_icons_args_whatsapp_as_address);
                echo '' . esc_html( $option_value_whatsapp ) . '</span></a>';
            }
        }
    ?>
    </span>
    <?php
}
add_action( 'display_productive_forms_contact_email_and_phone_themes', 'productive_forms_contact_email_and_phone_themes' );

/**
 * Method productive_forms_contact_full_address_per_line.
 *
 * @param string $hide_heading.
 */
function productive_forms_contact_full_address_per_line( $hide_heading = '0' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_map_marker;
    if ( isset( $productive_forms_section_options_contact['contact_address'] )) {
        $option_value_address = sanitize_text_field( $productive_forms_section_options_contact['contact_address'] );
    } else {
        $option_value_address = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_city'] )) {
        $option_value_city = sanitize_text_field( $productive_forms_section_options_contact['contact_city'] );
    } else {
        $option_value_city = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['contact_county'] )) {
        $option_value_county = sanitize_text_field( $productive_forms_section_options_contact['contact_county'] );
    } else {
        $option_value_county = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['contact_country'] )) {
        $option_value_country = sanitize_text_field( $productive_forms_section_options_contact['contact_country'] );
    } else {
        $option_value_country = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_postcode'] )) {
        $option_value_postcode = sanitize_text_field( $productive_forms_section_options_contact['contact_postcode'] );
    } else {
        $option_value_postcode = '';
    }  
    
    /*
        if ( !intval($hide_heading) && !empty($heading) ) {
            productive_forms_render_contact_info_heading_with_icon( $heading, $productive_forms_contact_icons_args_map_marker );
        }
     */
    
    if ( !empty($option_value_address) || !empty($option_value_country) || !empty($option_value_postcode) ) {
        $heading = productive_forms_contact_location_heading();
        echo '<div>';
        
        if ( !intval($hide_heading) && !empty($heading) ) {
            productive_forms_render_contact_info_heading_with_icon( $heading, $productive_forms_contact_icons_args_map_marker );
        }
    }
    if ( !empty($option_value_address) ) {
        echo '<div>' . esc_html( $option_value_address ) . '</div>';
    }
    if ( !empty($option_value_city) ) {
        echo '<div>' . esc_html( $option_value_city ) . '</div>';
    }
    if ( !empty($option_value_county) ) {
        echo '<div>' . esc_html( $option_value_county ) . '</div>';
    }
    if ( !empty($option_value_country) ) {
        echo '<div>' . esc_html( $option_value_country ) . '</div>';
    }
    if ( !empty($option_value_postcode) ) {
        echo '<div>' . esc_html( $option_value_postcode ) . '</div>';
    }
    if ( !empty($option_value_address) || !empty($option_value_country) || !empty($option_value_postcode) ) {
        echo '</div>';
    }
}
add_action( 'display_productive_forms_contact_full_address_per_line', 'productive_forms_contact_full_address_per_line' );

/**
 * Method productive_forms_contact_full_address_all_in_one_line.
 *
 * @param string $hide_heading.
 */
function productive_forms_contact_full_address_all_in_one_line( $hide_heading = '0' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_map_marker;
    if ( isset( $productive_forms_section_options_contact['contact_address'] )) {
        $option_value_address = sanitize_text_field( $productive_forms_section_options_contact['contact_address'] );
    } else {
        $option_value_address = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_city'] )) {
        $option_value_city = sanitize_text_field( $productive_forms_section_options_contact['contact_city'] );
    } else {
        $option_value_city = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_county'] )) {
        $option_value_county = sanitize_text_field( $productive_forms_section_options_contact['contact_county'] );
    } else {
        $option_value_county = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['contact_country'] )) {
        $option_value_country = sanitize_text_field( $productive_forms_section_options_contact['contact_country'] );
    } else {
        $option_value_country = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_postcode'] )) {
        $option_value_postcode = sanitize_text_field( $productive_forms_section_options_contact['contact_postcode'] );
    } else {
        $option_value_postcode = '';
    }
    
    $option_value_address_in_one_line = '';
    if ( !empty($option_value_address) ) {
        $option_value_address_in_one_line .= $option_value_address . ', ';
    }
    
    if ( !empty($option_value_city) ) {
        $option_value_address_in_one_line .= $option_value_city . ', ';
    }
    
    if ( !empty($option_value_county) ) {
        $option_value_address_in_one_line .= $option_value_county . ', ';
    }
    
    if ( !empty($option_value_country) ) {
        $option_value_address_in_one_line .= $option_value_country . ', ';
    }
    
    if ( !empty($option_value_postcode) ) {
        $option_value_address_in_one_line .= $option_value_postcode;
    }
    
    if ( !empty($option_value_address_in_one_line) ) {
        $heading = productive_forms_contact_location_heading();
        echo '<div>';
        if ( !intval($hide_heading) && !empty($heading) ) {
            productive_forms_render_contact_info_heading_with_icon( $heading, $productive_forms_contact_icons_args_map_marker );
        }
        echo '<div>' . esc_html( $option_value_address_in_one_line ) . '</div>';
        echo '</div>';
    }
}
add_action( 'display_productive_forms_contact_full_address_all_in_one_line', 'productive_forms_contact_full_address_all_in_one_line' );


/**
 * Method productive_forms_contact_get_full_address_textonly_all_in_one_line.
 *
 * @param string $class ''.
 */
function productive_forms_contact_get_full_address_textonly_all_in_one_line( $class = '' ) {
    global $productive_forms_section_options_contact, $productive_forms_contact_icons_args_map_marker;
    if ( isset( $productive_forms_section_options_contact['contact_address'] )) {
        $option_value_address = sanitize_text_field( $productive_forms_section_options_contact['contact_address'] );
    } else {
        $option_value_address = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_city'] )) {
        $option_value_city = sanitize_text_field( $productive_forms_section_options_contact['contact_city'] );
    } else {
        $option_value_city = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_county'] )) {
        $option_value_county = sanitize_text_field( $productive_forms_section_options_contact['contact_county'] );
    } else {
        $option_value_county = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['contact_country'] )) {
        $option_value_country = sanitize_text_field( $productive_forms_section_options_contact['contact_country'] );
    } else {
        $option_value_country = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_postcode'] )) {
        $option_value_postcode = sanitize_text_field( $productive_forms_section_options_contact['contact_postcode'] );
    } else {
        $option_value_postcode = '';
    }  
    
    $option_value_address_in_one_line = '';
    if ( !empty($option_value_address) ) {
        $option_value_address_in_one_line .= $option_value_address . ', ';
    }
    
    if ( !empty($option_value_city) ) {
        $option_value_address_in_one_line .= $option_value_city . ', ';
    }
    
    if ( !empty($option_value_county) ) {
        $option_value_address_in_one_line .= $option_value_county . ', ';
    }
    
    if ( !empty($option_value_country) ) {
        $option_value_address_in_one_line .= $option_value_country . ', ';
    }
    
    if ( !empty($option_value_postcode) ) {
        $option_value_address_in_one_line .= $option_value_postcode;
    }
    
    return $option_value_address_in_one_line;
}



/**
 * Method productive_forms_contact_full_address_textonly_all_in_one_line.
 *
 * @param string $class ''.
 */
function productive_forms_contact_full_address_textonly_all_in_one_line( $class = '' ) {
    $option_value_address_in_one_line = productive_forms_contact_get_full_address_textonly_all_in_one_line( $class );
    if ( !empty($option_value_address_in_one_line) ) {
        echo esc_html( $option_value_address_in_one_line );
    }
}
add_action( 'display_productive_forms_contact_full_address_textonly_all_in_one_line', 'productive_forms_contact_full_address_textonly_all_in_one_line' );

/**
 * Method is_on_productive_forms_show_contactdetails.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_show_contactdetails() {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_email'] )) {
        $option_value_email = sanitize_email( $productive_forms_section_options_contact['contact_email'] );
    } else {
        $option_value_email = '';
    }
    
    if ( productive_is_using_contact_phone_dial_code() && isset( $productive_forms_section_options_contact['contact_phone'] )  ) {
        $contact_phone_dial_code = sanitize_text_field( $productive_forms_section_options_contact['contact_phone_dial_code'] );
        $contact_phone = sanitize_text_field( $productive_forms_section_options_contact['contact_phone'] );
        $option_value_phone = $contact_phone_dial_code . ' ' . $contact_phone;
    } else {
        $option_value_phone = '';
    }
    
    if ( isset( $productive_forms_section_options_contact['contact_address'] )) {
        $option_value_address = sanitize_text_field( $productive_forms_section_options_contact['contact_address'] );
    } else {
        $option_value_address = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_city'] )) {
        $option_value_city = sanitize_text_field( $productive_forms_section_options_contact['contact_city'] );
    } else {
        $option_value_city = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_county'] )) {
        $option_value_county = sanitize_text_field( $productive_forms_section_options_contact['contact_county'] );
    } else {
        $option_value_county = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_country'] )) {
        $option_value_country = sanitize_text_field( $productive_forms_section_options_contact['contact_country'] );
    } else {
        $option_value_country = '';
    }  
    
    if ( isset( $productive_forms_section_options_contact['contact_postcode'] )) {
        $option_value_postcode = sanitize_text_field( $productive_forms_section_options_contact['contact_postcode'] );
    } else {
        $option_value_postcode = '';
    }  
    
    return !empty($option_value_email) || 
    !empty($option_value_phone) || 
    ( !empty($option_value_address) && !empty($option_value_city) && !empty($option_value_country) );
}

/**
 * Method productive_forms_post_contact_ _addressinfo.
 * @param string $class ''.
 */
function productive_forms_post_contact_icons_color_addressinfo( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_icon_color_addressinfo'] )) {
        $option_value = sanitize_hex_color( $productive_forms_section_options_contact['contact_icon_color_addressinfo'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
add_action( 'display_productive_forms_post_contact_icons_color_addressinfo', 'productive_forms_post_contact_icons_color_addressinfo' );

/**
 * Method is_on_productive_forms_contact_show_email_phone_address_on_contact_page.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_contact_show_email_phone_address_on_contact_page() {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_show_email_phone_address_on_contact_page'] )) {
        return sanitize_text_field( $productive_forms_section_options_contact['contact_show_email_phone_address_on_contact_page'] );
    } else {
        return false;
    }
}

/**
 * Method productive_forms_contact_business_hours_heading.
 *
 * @param string $class ''.
 */
function productive_forms_contact_business_hours_heading( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_heading'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_heading'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_business_hours_heading', 'productive_forms_contact_business_hours_heading' );

/**
 * Method productive_forms_contact_business_hours_mon_fri.
 *
 * @param string $class ''.
 */
function productive_forms_contact_business_hours_mon_fri( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_mon_fri'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_mon_fri'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_business_hours_mon_fri', 'productive_forms_contact_business_hours_mon_fri' );

/**
 * Method productive_forms_contact_business_hours_sat.
 *
 * @param string $class ''.
 */
function productive_forms_contact_business_hours_sat( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_sat'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_sat'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_business_hours_sat', 'productive_forms_contact_business_hours_sat' );

/**
 * Method productive_forms_contact_business_hours_sun.
 *
 * @param string $class ''.
 */
function productive_forms_contact_business_hours_sun( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_sun'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_sun'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_business_hours_sun', 'productive_forms_contact_business_hours_sun' );

/**
 * Method productive_forms_contact_business_hours_full_footer_all_in_one_line.
 *
 * @param string $hide_heading.
 */
function productive_forms_contact_business_hours_full_footer_all_in_one_line( $hide_heading = '0' ) {
    global $productive_forms_section_options_contact;
    
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_heading'] )) {
        $option_value_heading = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_heading'] );
    } else {
        $option_value_heading = '';
    }
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_mon_fri'] )) {
        $option_value_mon_fri = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_mon_fri'] );
    } else {
        $option_value_mon_fri = '';
    }
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_sat'] )) {
        $option_value_sat = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_sat'] );
    } else {
        $option_value_sat = '';
    }
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_sun'] )) {
        $option_value_sun = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_sun'] );
    } else {
        $option_value_sun = '';
    }
    
    if ( !empty($option_value_heading) && ( !empty($option_value_mon_fri) || !empty($option_value_sat) || !empty($option_value_sun) ) ) {
        echo '<div>';
        if ( !intval($hide_heading) && !empty($option_value_heading) ) {
            echo productive_forms_render_contact_info_heading( $option_value_heading );
        }
        echo '<div>';
        if ( !empty($option_value_mon_fri) ) {
            echo esc_html( $option_value_mon_fri );
            if ( !empty($option_value_sat) ) {
                echo ', ';
            }
        }
        if ( !empty($option_value_sat) ) {
            echo esc_html( $option_value_sat );
            if ( !empty($option_value_sun) ) {
                echo ', ';
            } else {
                echo '. ';
            }
        }
        if ( !empty($option_value_sun) ) {
            echo esc_html( $option_value_sun ) . '.';
        }
        echo '</div>';
        echo '</div>';
    }
}
add_action( 'display_productive_forms_contact_business_hours_full_footer_all_in_one_line', 'productive_forms_contact_business_hours_full_footer_all_in_one_line' );


/**
 * Method productive_forms_contact_business_hours_full_footer_per_line.
 *
 * @param string $hide_heading.
 */
function productive_forms_contact_business_hours_full_footer_per_line( $hide_heading = '0' ) {
    global $productive_forms_section_options_contact;
    
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_heading'] )) {
        $option_value_heading = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_heading'] );
    } else {
        $option_value_heading = '';
    }
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_mon_fri'] )) {
        $option_value_mon_fri = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_mon_fri'] );
    } else {
        $option_value_mon_fri = '';
    }
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_sat'] )) {
        $option_value_sat = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_sat'] );
    } else {
        $option_value_sat = '';
    }
    if ( isset( $productive_forms_section_options_contact['contact_business_hours_sun'] )) {
        $option_value_sun = sanitize_text_field( $productive_forms_section_options_contact['contact_business_hours_sun'] );
    } else {
        $option_value_sun = '';
    }
    
    if ( !empty($option_value_heading) && ( !empty($option_value_mon_fri) || !empty($option_value_sat) || !empty($option_value_sun) ) ) {
        echo '<div>';
        if ( !intval($hide_heading) && !empty($option_value_heading) ) {
            echo productive_forms_render_contact_info_heading( $option_value_heading );
        }
        echo '<ul>';
        if ( !empty($option_value_mon_fri) ) {
            echo '<li>' . esc_html( $option_value_mon_fri ) . '</li>';
        }
        if ( !empty($option_value_sat) ) {
            echo '<li>' . esc_html( $option_value_sat ) . '</li>';
        }
        if ( !empty($option_value_sun) ) {
            echo '<li>' . esc_html( $option_value_sun ) . '</li>';
        }
        echo '</ul></div>';
    }
}
add_action( 'display_productive_forms_contact_business_hours_full_footer_per_line', 'productive_forms_contact_business_hours_full_footer_per_line' );

/**
 * Method is_on_productive_forms_contact_show_contact_field_labels.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_contact_show_contact_field_labels() {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['show_contact_field_labels'] )) {
        return sanitize_text_field( $productive_forms_section_options_contact['show_contact_field_labels'] );
    } else {
        return false;
    }
}

/**
 * Method productive_forms_contact_intro_1.
 *
 * @param string $class ''.
 */
function productive_forms_contact_intro_1( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['page_intro_1'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['page_intro_1'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_intro_1', 'productive_forms_contact_intro_1' );

/**
 * Method productive_forms_contact_ask_for_visitor_phone.
 *
 * @param string $class ''.
 */
function productive_forms_contact_ask_for_visitor_phone( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_ask_for_visitor_phone'] )) {
        return $productive_forms_section_options_contact['contact_ask_for_visitor_phone'];
    } else {
        return false;
    }
}
add_action( 'display_productive_forms_contact_ask_for_visitor_phone', 'productive_forms_contact_ask_for_visitor_phone' );

/**
 * Method productive_forms_contact_copy_contactus_email_to_visitor.
 *
 * @param string $class ''.
 */
function productive_forms_contact_copy_contactus_email_to_visitor( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['copy_contactus_email_to_visitor'] )) {
        return $productive_forms_section_options_contact['copy_contactus_email_to_visitor'];
    } else {
        return false;
    }
}
add_action( 'display_productive_forms_contact_copy_contactus_email_to_visitor', 'productive_forms_contact_copy_contactus_email_to_visitor' );

/**
 * Method productive_forms_contact_how_to_display_contact_name_field.
 *
 * @param string $class ''.
 */
function productive_forms_contact_how_to_display_contact_name_field( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['how_to_display_contact_name_field'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['how_to_display_contact_name_field'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
add_action( 'display_productive_forms_contact_how_to_display_contact_name_field', 'productive_forms_contact_how_to_display_contact_name_field' );

/**
 * Method productive_forms_contact_how_to_process_contact_submissions.
 *
 * @param string $class ''.
 */
function productive_forms_contact_how_to_process_contact_submissions( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['how_to_process_contact_submissions'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['how_to_process_contact_submissions'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
add_action( 'display_productive_forms_contact_how_to_process_contact_submissions', 'productive_forms_contact_how_to_process_contact_submissions' );

/**
 * Method productive_forms_get_consent_checkbox_text_contact.
 *
 * @param string $class ''.
 */
function productive_forms_get_consent_checkbox_text_contact( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['consent_checkbox_text_contact'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['consent_checkbox_text_contact'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_contact_consent_checkbox_text_contact.
 *
 * @param string $class ''.
 */
function productive_forms_contact_consent_checkbox_text_contact( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['consent_checkbox_text_contact'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['consent_checkbox_text_contact'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_contact_consent_checkbox_text_contact', 'productive_forms_contact_consent_checkbox_text_contact' );

/**
 * Method productive_forms_get_contact_success_message.
 *
 * @param string $class ''.
 */
function productive_forms_get_contact_success_message( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['contact_success_message'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['contact_success_message'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_contact_receiver_of_contact_email_messages.
 *
 * @param string $class ''.
 */
function productive_forms_contact_receiver_of_contact_email_messages( $class = '' ) {
    global $productive_forms_section_options_contact;
    if ( isset( $productive_forms_section_options_contact['receiver_of_contact_email_messages'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_contact['receiver_of_contact_email_messages'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}



// START ============== Productive_Theme_Customiser_Integration

/**
 * Method productive_forms_get_keep_plugin_data_during_uninstall.
 *
 * @param string $class ''.
 */
function productive_forms_get_keep_plugin_data_during_uninstall( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['keep_plugin_data_during_uninstall'] )) {
        $option_value = $productive_forms_section_options_integration['keep_plugin_data_during_uninstall'];
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_integration_ask_show_google_map.
 *
 * @param string $class ''.
 */
function productive_forms_integration_ask_show_google_map( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['integration_ask_show_google_map'] )) {
        return $productive_forms_section_options_integration['integration_ask_show_google_map'];
    } else {
        return false;
    }
}

/**
 * Method productive_forms_integration_popup_transition_easing.
 *
 * @param string $class ''.
 */
function productive_forms_integration_popup_transition_easing( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['productive_forms_integration_popup_transition_easing'] )) {
        return $productive_forms_section_options_integration['productive_forms_integration_popup_transition_easing'];
    } else {
        return false;
    }
}

/**
 * Method productive_forms_integration_popup_transition_direction.
 *
 * @param string $class ''.
 */
function productive_forms_integration_popup_transition_direction( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['productive_forms_integration_popup_transition_direction'] )) {
        return $productive_forms_section_options_integration['productive_forms_integration_popup_transition_direction'];
    } else {
        return false;
    }
}

/**
 * Method productive_forms_integration_google_map_api_key.
 *
 * @param string $class ''.
 */
function productive_forms_integration_google_map_api_key( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['integration_google_map_api_key'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_integration['integration_google_map_api_key'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
add_action( 'display_productive_forms_integration_google_map_api_key', 'productive_forms_integration_google_map_api_key' );

/**
 * Method productive_forms_integration_google_map_longitude.
 *
 * @param string $class ''.
 */
function productive_forms_integration_google_map_longitude( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['integration_google_map_longitude'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_integration['integration_google_map_longitude'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
add_action( 'display_productive_forms_integration_google_map_longitude', 'productive_forms_integration_google_map_longitude' );

/**
 * Method productive_forms_integration_google_map_latitude.
 *
 * @param string $class ''.
 */
function productive_forms_integration_google_map_latitude( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['integration_google_map_latitude'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_integration['integration_google_map_latitude'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
add_action( 'display_productive_forms_integration_google_map_latitude', 'productive_forms_integration_google_map_latitude' );

/**
 * Method productive_forms_integration_recaptcha_key.
 *
 * @param string $class ''.
 */
function productive_forms_integration_recaptcha_key( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['integration_recaptcha_key'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_integration['integration_recaptcha_key'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_integration_recaptcha_secret.
 *
 * @param string $class ''.
 */
function productive_forms_integration_recaptcha_secret( $class = '' ) {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['integration_recaptcha_secret'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_integration['integration_recaptcha_secret'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

// END ============== Productive_Theme_Customiser_Integration




// START ============== Productive_Theme_Customiser_Newsletter CUSTOMISERS
/**
 * Method productive_forms_newsletter_heading.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_heading( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['productive_forms_newsletter_heading'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['productive_forms_newsletter_heading'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
function display_productive_forms_newsletter_heading( $class = '' ) {
    $option_value = productive_forms_newsletter_heading( $class );
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_newsletter_heading', 'display_productive_forms_newsletter_heading' );

/**
 * Method productive_forms_newsletter_intro.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_intro( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['productive_forms_newsletter_intro'] )) {
        $option_value = sanitize_textarea_field( $productive_forms_section_options_newsletter['productive_forms_newsletter_intro'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
function display_productive_forms_newsletter_intro( $class = '' ) {
    $option_value = productive_forms_newsletter_intro( $class );
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_newsletter_intro', 'display_productive_forms_newsletter_intro' );


/**
 * Method productive_forms_newsletter_copy_newsletter_email_to_visitor.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_copy_newsletter_email_to_visitor( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['copy_newsletter_email_to_visitor'] )) {
        return $productive_forms_section_options_newsletter['copy_newsletter_email_to_visitor'];
    } else {
        return false;
    }
}
add_action( 'display_productive_forms_newsletter_copy_newsletter_email_to_visitor', 'productive_forms_newsletter_copy_newsletter_email_to_visitor' );

/**
 * Method productive_forms_newsletter_how_to_display_newsletter_name_field.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_how_to_display_newsletter_name_field( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['how_to_display_newsletter_name_field'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['how_to_display_newsletter_name_field'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
add_action( 'display_productive_forms_newsletter_how_to_display_newsletter_name_field', 'productive_forms_newsletter_how_to_display_newsletter_name_field' );

/**
 * Method productive_forms_newsletter_how_to_process_newsletter_submissions.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_how_to_process_newsletter_submissions( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['how_to_process_newsletter_submissions'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['how_to_process_newsletter_submissions'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}
add_action( 'display_productive_forms_newsletter_how_to_process_newsletter_submissions', 'productive_forms_newsletter_how_to_process_newsletter_submissions' );

/**
 * Method productive_forms_newsletter_receiver_of_newsletter_email_messages.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_receiver_of_newsletter_email_messages( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['receiver_of_newsletter_email_messages'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['receiver_of_newsletter_email_messages'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method is_on_productive_forms_newsletter_show_newsletter_field_labels.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_newsletter_show_newsletter_field_labels() {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['show_newsletter_field_labels'] )) {
        return $productive_forms_section_options_newsletter['show_newsletter_field_labels'];
    } else {
        return false;
    }
}

/**
 * Method productive_forms_get_consent_checkbox_text_newsletter.
 *
 * @param string $class ''.
 */
function productive_forms_get_consent_checkbox_text_newsletter( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['consent_checkbox_text_newsletter'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['consent_checkbox_text_newsletter'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_newsletter_consent_checkbox_text_newsletter.
 *
 * @param string $class ''.
 */
function productive_forms_newsletter_consent_checkbox_text_newsletter( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['consent_checkbox_text_newsletter'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['consent_checkbox_text_newsletter'] );
    } else {
        $option_value = '';
    }
    if ( !empty($option_value) ) {
        echo esc_html($option_value);
    }
}
add_action( 'display_productive_forms_newsletter_consent_checkbox_text_newsletter', 'productive_forms_newsletter_consent_checkbox_text_newsletter' );

/**
 * Method productive_forms_get_newsletter_success_message.
 *
 * @param string $class ''.
 */
function productive_forms_get_newsletter_success_message( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['newsletter_success_message'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['newsletter_success_message'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method is_on_productive_forms_newsletter_customer_subscription_enable_account_subscribe.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_newsletter_customer_subscription_enable_account_subscribe() {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['newsletter_customer_subscription_enable_account_subscribe'] )) {
        return $productive_forms_section_options_newsletter['newsletter_customer_subscription_enable_account_subscribe'];
    } else {
        return false;
    }
}

/**
 * Method is_on_productive_forms_newsletter_customer_subscription_enable_checkout_subscribe.
 *
 * @param string $class ''.
 */
function is_on_productive_forms_newsletter_customer_subscription_enable_checkout_subscribe() {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['newsletter_customer_subscription_enable_checkout_subscribe'] )) {
        return $productive_forms_section_options_newsletter['newsletter_customer_subscription_enable_checkout_subscribe'];
    } else {
        return false;
    }
}

/**
 * Method productive_forms_get_newsletter_customer_subscription_checkout_heading.
 *
 * @param string $class ''.
 */
function productive_forms_get_newsletter_customer_subscription_checkout_heading( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['newsletter_customer_subscription_checkout_heading'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['newsletter_customer_subscription_checkout_heading'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_get_newsletter_customer_subscription_checkout_desc.
 *
 * @param string $class ''.
 */
function productive_forms_get_newsletter_customer_subscription_checkout_desc( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['newsletter_customer_subscription_checkout_desc'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['newsletter_customer_subscription_checkout_desc'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

/**
 * Method productive_forms_get_newsletter_customer_subscription_checkout_checkbox_text.
 *
 * @param string $class ''.
 */
function productive_forms_get_newsletter_customer_subscription_checkout_checkbox_text( $class = '' ) {
    global $productive_forms_section_options_newsletter;
    if ( isset( $productive_forms_section_options_newsletter['newsletter_customer_subscription_checkout_checkbox_text'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_newsletter['newsletter_customer_subscription_checkout_checkbox_text'] );
    } else {
        $option_value = '';
    }
    return $option_value;
}

// END ============== Productive_Theme_Customiser_Newsletter CUSTOMISERS



// START ============== Widgets Contact & Newsletter Buttons
/**
 * Method productive_forms_widget_contact_button.
 *
 * @param string $class ''.
 */
function productive_forms_widget_contact_button( $text = '' ) {
    
    if ( !empty($text) ) {
        echo '<a data-open-popup="productive_popup_contact_form" aria-label="' . __( 'Contact Form', 'productive-forms' ) . '" class="productive_forms_widget_button contact" href="#">' . esc_html($text) . '</a>';
    }
}
add_action( 'display_productive_forms_widget_contact_button', 'productive_forms_widget_contact_button' );



/**
 * Method productive_forms_widget_newsletter_button.
 *
 * @param string $class ''.
 */
function productive_forms_widget_newsletter_button( $text = '' ) {
    
    if ( !empty($text) ) {
        echo '<a data-open-popup="productive_popup_newsletter_form" aria-label="' . __( 'Newsletter', 'productive-forms' ) . '" class="productive_forms_widget_button newsletter" href="#">' . esc_html($text) . '</a>';
    }
}
add_action( 'display_productive_forms_widget_newsletter_button', 'productive_forms_widget_newsletter_button' );
// END ============== Widgets Contact & Newsletter Buttons




function productive_forms_contact_form_show_contact_info() {
    return is_on_productive_forms_contact_show_email_phone_address_on_contact_page() || 
        is_on_productive_forms_contact_show_social_media_on_contact_page() || 
        is_on_productive_forms_contact_show_business_hour_on_contact_page();
}


function productive_is_using_contact_phone_dial_code() {
    global $productive_forms_section_options_contact;
    return ( isset( $productive_forms_section_options_contact['contact_phone_dial_code'] ) && !empty( $productive_forms_section_options_contact['contact_phone_dial_code'] ) );
}

function productive_is_using_contact_whatsapp_dial_code() {
    global $productive_forms_section_options_contact;
    return ( isset( $productive_forms_section_options_contact['contact_whatsapp_dial_code'] ) && !empty( $productive_forms_section_options_contact['contact_whatsapp_dial_code'] ) );
}

function productive_forms_integration_maths_challenge_options_var_1() {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['productive_forms_integration_maths_challenge_options_var_1'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_integration['productive_forms_integration_maths_challenge_options_var_1'] );
    } else {
        $option_value = 4;
    }
    return intval($option_value);
}

function productive_forms_integration_maths_challenge_options_var_2() {
    global $productive_forms_section_options_integration;
    if ( isset( $productive_forms_section_options_integration['productive_forms_integration_maths_challenge_options_var_2'] )) {
        $option_value = sanitize_text_field( $productive_forms_section_options_integration['productive_forms_integration_maths_challenge_options_var_2'] );
    } else {
        $option_value = 3;
    }
    return intval($option_value);
}
