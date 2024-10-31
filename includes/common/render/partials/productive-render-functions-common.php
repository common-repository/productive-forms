<?php
/**
 * @package     productive-forms
 * @author      productiveminds.com
 * @copyright   productiveminds.com
*/

/**
 * Display Block Header
 * 
 * @param type $section_title
 * @param type $section_intro
 */
function productive_forms_render_header_v_1( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment = '', $physical_address = '' ) { 
?>
    <?php if ( !empty( $section_title ) || !empty( $section_intro ) ) { ?>
    <div class="productiveminds_section-header-container productiveminds-alignable-container">
        <div class="productiveminds_section-header-container_uno productiveminds-alignable-container_uno <?php echo esc_attr( $section_header_alignment ); ?>">
            <?php if ( !empty( $section_title ) ) { ?>

                <?php 
                if ( productive_global_is_valid_html_tag_for_title( $section_title_html_tag ) ) {
                    echo '<' . esc_attr( $section_title_html_tag ) . ' class="section-title">' . wp_specialchars_decode( $section_title ) . '</' . esc_attr( $section_title_html_tag ) . '>';
                } else { 
                ?>
                    <h2 class="section-title">
                        <?php echo wp_specialchars_decode( $section_title ) ?>
                    </h2>
                <?php } ?>
            <?php } ?>
            <?php if ( !empty( $section_intro ) ) { ?>
                <div class="section-intro g-maps-intro-text">
                    <?php echo wp_specialchars_decode( $section_intro ) ?>
                </div>
            <?php } ?>
            <?php if ( !empty( $physical_address ) ) { ?>
                <div class="section-intro physical-address">
                    <?php echo wp_specialchars_decode( $physical_address ) ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
<?php 
}

/**
 * Display Block Header
 * 
 * @param type $section_title
 * @param type $section_intro
 */
function productive_forms_render_header_v_1_data( $section_title, $section_title_html_tag, $section_intro, $section_header_alignment = '', $physical_address = '' ) {
    $section_data = '';
    if ( !empty( $section_title ) || !empty( $section_intro ) ) {
        $section_data = '<div class="productiveminds_section-header-container productiveminds-alignable-container">';
        $section_data .= '<div class="productiveminds_section-header-container_uno productiveminds-alignable-container_uno ' . $section_header_alignment . '">';
        if ( !empty( $section_title ) ) {
            if ( productive_global_is_valid_html_tag_for_title( $section_title_html_tag ) ) {
                $section_data .= '<' . esc_attr( $section_title_html_tag ) . ' class="section-title">' . wp_specialchars_decode( $section_title ) . '</' . esc_attr( $section_title_html_tag ) . '>';
            } else {
                $section_data .= '<h2 class="section-title">' . wp_specialchars_decode( $section_title ) . '</h2>';
            }
        }
        if ( !empty( $section_intro ) ) {
            $section_data .= '<div class="section-intro g-maps-intro-text">' . wp_specialchars_decode( $section_intro ) . '</div>';
        }
        if ( !empty( $physical_address ) ) {
            $section_data .= '<div class="section-intro physical-address">' . wp_specialchars_decode( $physical_address ) . '</div>';
        }
        $section_data .= '</div>';
        $section_data .= '</div>';
    }
    return $section_data;
}


/**
 * Display Block Header
 * 
 * @param type $misc
 * @param type $productive_cpt_id
 */
function productive_forms_render_content_media_v_1( $misc = array(), $productive_cpt_id = 0 ) {
    
    $productive_cpt_is_show_image_or_icon               = $misc['productive_cpt_is_show_image_or_icon'];
    
    $is_search_result_page = false;
    if( isset( $misc['is_search_result_page'] )) {
        $is_search_result_page                      = $misc['is_search_result_page'];
    }
    
    $section_show_search_result_post_type = false;
    if( isset( $misc['section_show_search_result_post_type'] )) {
        $section_show_search_result_post_type       = $misc['section_show_search_result_post_type'];
    }
    
    $section_content_media_item_shape = '';
    if( isset( $misc['section_content_media_item_shape'] )) {
        $section_content_media_item_shape               = $misc['section_content_media_item_shape'];
    }
    
    $productive_cpt_icon_code = '';
    if( isset( $misc['productive_cpt_icon_code'] ) ) {
        $productive_cpt_icon_code = $misc['productive_cpt_icon_code'];
    }
    
    $section_video_thumbnail_id = '';
    $productiveminds_section_video_item_thumbnail = '';
    $productiveminds_section_video_render_inline_container = 0;
    if( isset( $misc['productive_cpt_video'] ) ) {
        if( $misc['productive_cpt_video'] ) {
            $section_video_thumbnail_id = $misc['productive_cpt_video'];
            $productiveminds_section_video_item_thumbnail = 'productiveminds_section_video_item_thumbnail';
            $productiveminds_section_video_render_inline_container = 1;
        }
    }
?>
    <?php if ( ( !empty( $productive_cpt_icon_code ) && 'icon' == $productive_cpt_is_show_image_or_icon ) || strpos( $productive_cpt_is_show_image_or_icon, 'image' ) !== false ) { ?>
        <div class="productiveminds_section-single-item-media shapeable-image-box <?php echo esc_attr_e($section_content_media_item_shape); ?> productiveminds-alignable-container width-autoed <?php echo esc_attr( $productiveminds_section_video_item_thumbnail ); ?>" data-video-id="<?php echo esc_attr( $section_video_thumbnail_id ); ?>">
            <?php
            if ( strpos( $productive_cpt_is_show_image_or_icon, 'image' ) !== false ) {
                _productive_forms_render_content_media( $misc, $productive_cpt_id );
            } else if ( !empty( $productive_cpt_icon_code ) ) { ?>
                <i class="single-item-icon fa <?php echo esc_attr($productive_cpt_icon_code); ?>"></i>
            <?php 
            } ?>

            <?php if ( $productiveminds_section_video_render_inline_container ) { ?>
                <div class="productiveminds_section-single-item-media-video"></div>
            <?php } ?>
            
            <?php if ( $is_search_result_page && $section_show_search_result_post_type ) { ?>
                <div class="search-result-page-post-type">
                    <?php echo _productive_forms_get_search_result_page_post_type(); ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php 
}


function _productive_forms_render_content_media( $misc, $productive_cpt_id = 0 ) {
    
    $productive_cpt_is_link_image = 0;
    if( isset( $misc['productive_cpt_is_link_image'] )) {
        $productive_cpt_is_link_image                           = $misc['productive_cpt_is_link_image'];
    }
    
    $productiveminds_section_widget_type = '';
    if( isset( $misc['productiveminds_section_widget_type'] )) {
        $productiveminds_section_widget_type                     = $misc['productiveminds_section_widget_type'];
    }
    
    $get_post_type = get_post_type();
    $product_title = get_the_title();
    if( $productive_cpt_is_link_image || 'post' == $get_post_type || $productiveminds_section_widget_type == PRODUCTIVE_FORMS_PLUGIN_WIDGET_TYPE_SEARCH_RESULT ) {
        
        $productive_cpt_url = '';
        if( isset( $misc['productive_cpt_url'] )) {
            $productive_cpt_url                     = $misc['productive_cpt_url'];
        }

        $url = '#';
        if( 'post' == $get_post_type || $productiveminds_section_widget_type == PRODUCTIVE_FORMS_PLUGIN_WIDGET_TYPE_SEARCH_RESULT ) {
            $url = get_permalink( $productive_cpt_id );
        } else if( !empty($productive_cpt_url) ) {
            $url = $productive_cpt_url;
        }

        $section_content_show_url_button_target = '_parent'; 
        if( 2 == $productive_cpt_is_link_image ) {
            $section_content_show_url_button_target = '_blank';
        }
        
        if ( has_post_thumbnail() ) {
            $attr = array (
                'alt' => $product_title,
            );
        ?>
            <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" href="<?php echo esc_url( $url ); ?>"><?php the_post_thumbnail( 'full', $attr ); ?></a>
        <?php } else { ?>
            <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" href="<?php echo esc_url( $url ); ?>"><?php do_action( 'display_productive_global_post_thumbnail', productive_forms_get_image_placeholder_args($product_title) ); ?></a>
        <?php
        }
    } else {
        do_action( 'display_productive_global_post_thumbnail', productive_forms_get_image_placeholder_args($product_title) );
    }
}
function productive_forms_get_image_placeholder_args($product_title) {
    return array(
        'post_id'           => get_the_ID(),
        'default_image_url' => PRODUCTIVE_FORMS_PLACEHOLDER_IMAGE_POSTS,
        'alt'               => $product_title,
        'type'              => 'full',
    );
}

function _productive_forms_get_search_result_page_post_type() {
    if( 'post' == get_post_type() ) {
        return __('blog', 'productive-forms');
    }
    return get_post_type();
}


/**
 * 
 * @param type $misc
 * @param type $productive_cpt_id
 */
function productive_forms_render_content_text_v_1( $misc, $productive_cpt_id = 0 ) {
    $section_content_show_url_button                    = intval($misc['section_content_show_url_button']);
    $section_style_content_button_hover_animation       = $misc['section_style_content_button_hover_animation'];
    $section_show_content_title                         = intval($misc['section_show_content_title']);
    $section_show_content_text                          = intval($misc['section_show_content_text']);
    
    $productive_cpt_url = '';
    if( isset( $misc['productive_cpt_url'] )) {
        $productive_cpt_url                         = $misc['productive_cpt_url'];
    }
    $productive_cpt_url_text = '';
    if( isset( $misc['productive_cpt_url_text'] )) {
        $productive_cpt_url_text                    = $misc['productive_cpt_url_text'];
    }
    $alignable_container_layout_text                = '';
    if( isset( $misc['alignable_container_layout_text'] )) {
        $alignable_container_layout_text            = $misc['alignable_container_layout_text'];
    }
    $content_type = 'content';
    if( isset( $misc['content_type'] )) {
        $content_type                               = $misc['content_type'];
    }
    $excerpt_word_count = 20;
    if( isset( $misc['excerpt_word_count'] )) {
        $excerpt_word_count                         = $misc['excerpt_word_count'];
    }
    
    $section_content_show_url_button_target = '_parent'; 
    if( 2 == $section_content_show_url_button ) {
        $section_content_show_url_button_target = '_blank';
    }
?>
    <?php if( $section_show_content_title || $section_show_content_text || $section_content_show_url_button ) { ?>
    <div class="productiveminds_section-single-item-text productiveminds-alignable-container align-items-flex-start align-content-flex-start <?php echo esc_attr( $alignable_container_layout_text ); ?> row-gap-5px">
        <?php if( $section_show_content_title ) { ?>
            <?php _productive_forms_render_the_title( $section_show_content_title, $productive_cpt_id, $productive_cpt_url ); ?>
        <?php } ?>
        <?php
            if( 'excerpt' == $content_type ) {
                _productive_forms_render_the_excerpt( get_the_excerpt(), $section_show_content_text, $excerpt_word_count );
            } else {
                _productive_forms_render_the_content( get_the_content(), $section_show_content_text );
            }
        ?>
        <?php if ( !empty( $productive_cpt_url ) && $section_content_show_url_button ) { ?>
            <div class="single-item-button-container">
                <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" class="single-item-button <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                   aria-label="<?php echo esc_attr('Read more about ', 'productive-forms') . the_title(); ?>" 
                   href="<?php echo esc_url($productive_cpt_url); ?>">
                        <?php echo esc_html($productive_cpt_url_text); ?>
                        <span class="screen-reader-text"><?php echo __('Read more about ', 'productive-forms') . the_title(); ?></span>
                </a>
            </div>
        <?php } ?>
    </div>
    <?php } ?>
<?php 
}

function _productive_forms_render_the_title( $section_show_content_title, $productive_cpt_id, $productive_cpt_url = '' ) {
    ?>
    <div class="single-item-title">
        <?php
        $section_content_show_url_button_target = '_parent';
        if( 3 == $section_show_content_title ) {
            $section_content_show_url_button_target = '_blank';
        }
        $get_post_type = get_post_type();
        if( 1 < $section_show_content_title || 'post' == $get_post_type ) {
            $url = '#';
            if( 'post' == $get_post_type ) {
                $url = get_permalink( $productive_cpt_id );
            } else if( !empty($productive_cpt_url) ) {
                $url = $productive_cpt_url;
            }
        ?>
        <a target="<?php echo esc_attr($section_content_show_url_button_target); ?>" href="<?php echo esc_url( $url ); ?>"><?php the_title(); ?></a>
        <?php } else { ?>
            <?php the_title(); ?>
        <?php } ?>
    </div>
    <?php
}

function _productive_forms_render_the_excerpt( $the_excerpt, $section_show_content_text = 1, $excerpt_word_count = 20 ) {
    if( $section_show_content_text ) { 
    ?>
        <div class="single-item-desc">
            <?php echo wp_specialchars_decode( wp_trim_words( $the_excerpt, $excerpt_word_count ) ); ?>
        </div>
    <?php 
    }
}

function _productive_forms_render_the_content( $the_content, $section_show_content_text = 1 ) {
    if( $section_show_content_text ) { 
    ?>
        <div class="single-item-desc">
            <?php echo wp_specialchars_decode($the_content); ?>
        </div>
    <?php 
    }
}


function productive_forms_render_content_get_loop_data_cpt( $productive_cpt_id, $productiveminds_section_meta_key ) {
    $productive_cpt_data = array();
    $productive_cpt_data['productive_cpt_icon_code'] = '';
    $productive_cpt_data['productive_cpt_url'] = '';
    $productive_cpt_data['productive_cpt_url_text'] = '';
    
    $productive_cpt_meta_object = get_post_meta( $productive_cpt_id, $productiveminds_section_meta_key, true );
    if ( !empty( $productive_cpt_meta_object['cpt_icon'] ) ) {
        $productive_cpt_data['productive_cpt_icon_code'] = sanitize_text_field( $productive_cpt_meta_object['cpt_icon'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_url'] ) ) {
        $productive_cpt_data['productive_cpt_url'] = sanitize_text_field( $productive_cpt_meta_object['cpt_url'] );
    }
    if ( !empty( $productive_cpt_meta_object['cpt_url_text'] ) ) {
        $productive_cpt_data['productive_cpt_url_text'] = sanitize_text_field( $productive_cpt_meta_object['cpt_url_text'] );
    }
    
    return $productive_cpt_data;
}


function productive_forms_render_post_pagination( $productive_cpt, $misc ) {
    $section_settings_show_post_pagination = 0;
    if( isset( $misc['section_settings_show_post_pagination'] )) {
        $section_settings_show_post_pagination  = $misc['section_settings_show_post_pagination'];
    }
    if( $section_settings_show_post_pagination ) {
        productive_global_paginate_links( $productive_cpt ); 
    }
}


function productive_forms_render_contact_us_page_content( $misc = array()  ) {
    
    $productive_forms_contact_side                  = $misc['productive_forms_contact_side'];
    $is_formonly                                    = $misc['is_formonly'];
    $display_contact_form_label                     = $misc['display_contact_form_label'];
    $display_contact_email_address                  = $misc['display_contact_email_address'];
    $display_contact_phone_number                   = $misc['display_contact_phone_number'];
    $display_contact_whatsapp_number                = $misc['display_contact_whatsapp_number'];
    $display_contact_location                       = $misc['display_contact_location'];
    $display_contact_opening_hours                  = $misc['display_contact_opening_hours'];
    $display_contact_social_media_icons             = $misc['display_contact_social_media_icons'];
    $display_contact_social_media_icons_title       = $misc['display_contact_social_media_icons_title'];
    
    $labelled = '';
    if ( $display_contact_form_label ) {
        $labelled = ' labelled';
    }
    
    $column_split = 'column_60_40';
    if ( 'contact_form_on_right' == $productive_forms_contact_side ) {
        $column_split = 'column_45_55';
    }
?>
    <div class="productiveminds_form_container productive_forms_form_contact_container <?php echo esc_attr( $labelled ); ?>">
        
        <?php if ( !$is_formonly ) { ?>
            <div class="productiveminds_double_grid <?php echo esc_attr($column_split); ?>">
                <?php if ( 'contact_form_on_left' == $productive_forms_contact_side ) { ?>
                    <div class="productiveminds_double_grid_content productive_forms_contact_us_page_form_side">
                        <div class="productive-forms-box">
                            <?php 
                                productive_forms_render_contact_us_page_fields( $misc );
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <div class="productiveminds_double_grid_content productive_forms_contact_us_page_info_side relatived productiveminds-alignable-container align-items-flex-start align-content-flex-start">
                    <div class="contact-and-address-container no_margin productiveminds-alignable-container row-gap-10px">
                        <?php if ( $display_contact_email_address ) { ?>
                            <div class="contact-and-address-container-email">
                               <?php do_action( 'display_productive_forms_contact_email_themes' ); ?>
                            </div>
                        <?php } ?>
                        
                        <?php if ( $display_contact_phone_number ) { ?>
                            <div class="contact-and-address-container-phone">
                                <?php do_action( 'display_productive_forms_contact_phone_themes'); ?>
                            </div>
                        <?php } ?>
                        
                        <?php if ( $display_contact_whatsapp_number ) { ?>
                            <div class="contact-and-address-container-phone">
                                <?php do_action( 'display_productive_forms_contact_whatsapp_themes'); ?>
                            </div>
                        <?php } ?>
                        
                        <?php if ( $display_contact_location ) { ?>
                            <div class="contact-and-address-container-physical-address">
                                <div><?php do_action( 'display_productive_forms_contact_full_address_all_in_one_line' ); ?></div>
                            </div>
                        <?php } ?>
                        
                        <?php if ( $display_contact_opening_hours ) { ?>
                            <div class="contact-and-address-container-opening-hours">
                                <?php do_action( 'display_productive_forms_contact_business_hours_full_footer_per_line' ); ?>
                            </div>
                        <?php } ?>
                        
                        <?php if ( $display_contact_social_media_icons ) { ?>
                            <div class="contact-and-address-container-social-media">
                                <?php echo productive_forms_render_contact_info_heading( $display_contact_social_media_icons_title ); ?>
                                <div><?php do_action( 'display_productive_forms_social_media_block' ); ?></div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php if ( 'contact_form_on_right' == $productive_forms_contact_side ) { ?>
                    <div class="productiveminds_double_grid_content productive_forms_contact_us_page_form_side">
                        <div class="productive-forms-box">
                            <?php 
                                productive_forms_render_contact_us_page_fields( $misc );
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="productive-forms-box">
                <?php 
                    productive_forms_render_contact_us_page_fields( $misc );
                ?>
            </div>
        <?php } ?>
        
    </div>
<?php
}

function productive_forms_render_contact_us_page_fields( $misc = array() ) {
    
    $form_unique_id                                     = $misc['form_unique_id'];
    $display_contact_form_label                         = $misc['display_contact_form_label'];
    $productive_forms_form_submit_text                  = $misc['productive_forms_form_submit_text'];
    $contact_how_to_display_contact_name_field          = $misc['contact_how_to_display_contact_name_field'];
    $contact_ask_for_visitor_phone                      = $misc['contact_ask_for_visitor_phone'];
    $request_data_privacy_consent                       = $misc['request_data_privacy_consent'];
    $submission_verify_type                             = $misc['submission_verify_type'];
    $section_style_content_button_hover_animation       = $misc['section_style_content_button_hover_animation'];
    
    $labelled = '';
    if ( $display_contact_form_label ) {
        $labelled = ' labelled';
    }
    $recaptcha_site_key = productive_forms_integration_recaptcha_key();
    $maths_challenge_variable_1 = productive_forms_integration_maths_challenge_options_var_1();
    $maths_challenge_variable_2 = productive_forms_integration_maths_challenge_options_var_2();
?>
    <form class="productive_forms_form_contact_form productiveminds-alignable-container gap-10px" id="productive_forms_form_contact_form_<?php echo esc_attr($form_unique_id); ?>" method="POST">

        <?php if ( 'individual_fields' == $contact_how_to_display_contact_name_field ) { ?>
        <input type="hidden" id="how_to_display_contact_name_field_<?php echo esc_attr($form_unique_id); ?>" name="how_to_display_contact_name_field" value="individual_fields" />
        <?php } else { ?>
            <input type="hidden" id="how_to_display_contact_name_field_<?php echo esc_attr($form_unique_id); ?>" name="how_to_display_contact_name_field" value="combined_fields" />
        <?php } ?>

        <div class="productiveminds_form_field_box">
            <?php if ( 'individual_fields' == $contact_how_to_display_contact_name_field ) {
                $productive_forms_form_contact_name = __( 'First Name', 'productive-forms' );
            } else {
                $productive_forms_form_contact_name = __( 'Name', 'productive-forms' );
            } ?>
            <label class="noned" for="productive_forms_form_contact_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_attr($productive_forms_form_contact_name); ?> <span class="required-field-asterik">*</span></label>
            <input name="productive_forms_form_contact_name" id="productive_forms_form_contact_name_<?php echo esc_attr($form_unique_id); ?>" type="text" <?php if (empty($labelled)) { ?>placeholder="<?php echo esc_attr($productive_forms_form_contact_name); ?> *"<?php } ?>/>
        </div>

        <?php if ( 'individual_fields' == $contact_how_to_display_contact_name_field ) { ?>
            <div class="productiveminds_form_field_box">
                <label class="noned" for="productive_forms_form_contact_last_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo __( 'Last Name', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
                <input name="productive_forms_form_contact_last_name" id="productive_forms_form_contact_last_name_<?php echo esc_attr($form_unique_id); ?>" type="text" <?php if (empty($labelled)) { ?>placeholder="<?php echo __( 'Last Name', 'productive-forms' ) ?> *"<?php } ?>/>
            </div>
        <?php } else { ?>
            <input type="hidden" id="productive_forms_form_contact_last_name_<?php echo esc_attr($form_unique_id); ?>" name="productive_forms_form_contact_last_name" value="" />
        <?php } ?>

        <div class="productiveminds_form_field_box">
            <label class="noned" for="productive_forms_form_contact_email_<?php echo esc_attr($form_unique_id); ?>"><?php echo __( 'Email', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
            <input name="productive_forms_form_contact_email" id="productive_forms_form_contact_email_<?php echo esc_attr($form_unique_id); ?>" type="email" <?php if (empty($labelled)) { ?>placeholder="<?php echo __( 'Email', 'productive-forms' ) ?> *"<?php } ?>/>
        </div>

        <?php if ( $contact_ask_for_visitor_phone ) { ?>
        <div class="productiveminds_form_field_box">
            <label class="noned" for="productive_forms_form_contact_phone_<?php echo esc_attr($form_unique_id); ?>"><?php echo __( 'Phone', 'productive-forms' ) ?></label>
            <input name="productive_forms_form_contact_phone" id="productive_forms_form_contact_phone_<?php echo esc_attr($form_unique_id); ?>" type="tel" <?php if (empty($labelled)) { ?>placeholder="<?php echo __( 'Phone', 'productive-forms' ) ?>"<?php } ?> />
        </div>
        <?php } else { ?>
            <input type="hidden" id="productive_forms_form_contact_phone_<?php echo esc_attr($form_unique_id); ?>" name="productive_forms_form_contact_phone" value="unused" />
        <?php } ?>

        <div class="productiveminds_form_field_box">
            <label class="noned" for="productive_forms_form_contact_message_<?php echo esc_attr($form_unique_id); ?>"><?php echo __( 'Message', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
            <textarea name="productive_forms_form_contact_message" id="productive_forms_form_contact_message_<?php echo esc_attr($form_unique_id); ?>" rows="4" <?php if (empty($labelled)) { ?>placeholder="<?php echo __( 'message', 'productive-forms' ) ?> *"<?php } ?>></textarea>
        </div>

        <?php if ( 'maths_challenge' == $submission_verify_type ) { ?>
           <div class="productiveminds_form_field_box">
               <label class="noned" for="productive_forms_form_contact_verify_is_spam_<?php echo esc_attr($form_unique_id); ?>"><?php echo __('What is the answer:', 'productive-forms') ?> <span class="required-field-asterik">*</span> <?php echo esc_html($maths_challenge_variable_1); ?> + <?php echo esc_html($maths_challenge_variable_2); ?> = ? </label>
               <input name="productive_forms_form_contact_verify_maths" id="productive_forms_form_contact_verify_maths_<?php echo esc_attr($form_unique_id); ?>" type="type" <?php if (empty($labelled)) { ?>placeholder="<?php echo __( 'What is the answer:', 'productive-forms' ) ?> <?php echo esc_attr($maths_challenge_variable_1); ?> + <?php echo esc_attr($maths_challenge_variable_2); ?> = ?"<?php } ?> value="" />
           </div>
        <?php } else { ?>
           <input name="productive_forms_form_contact_verify_maths" id="productive_forms_form_contact_verify_maths_<?php echo esc_attr($form_unique_id); ?>" type="hidden" value="unused" />
        <?php } ?>

        <?php if ( $request_data_privacy_consent ) { ?>
           <div class="productiveminds_form_field_box extra-margin">
               <input id="productive_forms_contact_consent_checkbox_text_contact_<?php echo esc_attr($form_unique_id); ?>" type="checkbox" name="productive_forms_contact_consent_checkbox_text_contact" />
               <label for="productive_forms_contact_consent_checkbox_text_contact_<?php echo esc_attr($form_unique_id); ?>">
                   <?php do_action( 'display_productive_forms_contact_consent_checkbox_text_contact'); ?> <span class="required-field-asterik">*</span>
               </label>
           </div>
        <?php } ?>

        <input type="hidden" id="is_consent_required_<?php echo esc_attr($form_unique_id); ?>" name="is_consent_required" value="<?php echo esc_attr($request_data_privacy_consent); ?>" />
        <input type="hidden" id="submission_verify_type_<?php echo esc_attr($form_unique_id); ?>" name="submission_verify_type" value="<?php echo esc_attr($submission_verify_type); ?>" />

        <div class="productiveminds_form_field_box action productiveminds-alignable-container width-100pc align-items-center align-content-center justify-items-start align-content-flex-start">
           <?php if ( 'productive_g_recaptcha_v3' == $submission_verify_type ) { ?>
               <button aria-label="<?php echo esc_attr('Submit', 'productive-forms'); ?>" 
                    class="productive_forms_form_contact_submit_ajax g_recaptcha_v3 contact <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                   name="productive_forms_form_contact_submit_ajax_<?php echo esc_attr($form_unique_id); ?>" 
                   id="productive_forms_form_contact_submit_ajax_<?php echo esc_attr($form_unique_id); ?>"
                   data-productive_form_id="<?php echo esc_attr($form_unique_id); ?>"
                   type="submit"
                   data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>" 
                   data-callback='submitProductiveContactFormWithReCaptcha_<?php echo esc_attr($form_unique_id); ?>' data-action='click'
               >
                   <?php echo esc_html($productive_forms_form_submit_text); ?>
               </button>
           <?php } else { ?>
               <button aria-label="<?php echo esc_attr('Submit', 'productive-forms'); ?>" 
                    class="productive_forms_form_contact_submit_ajax std contact <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                   name="productive_forms_form_contact_submit_ajax" 
                   id="productive_forms_form_contact_submit_ajax_<?php echo esc_attr($form_unique_id); ?>"
                   data-productive_form_id="<?php echo esc_attr($form_unique_id); ?>"
                   type="submit"
               >
                   <?php echo esc_html($productive_forms_form_submit_text); ?>
               </button>
           <?php } ?>
        </div>
       
        <div class="clear_min">
           <?php $form_nonce = wp_create_nonce('productive_forms_contact_form_nonce'); ?>
           <input type="hidden" name="nonce" value="<?php echo esc_attr($form_nonce); ?>" />
           <input name="email" id="email_<?php echo esc_attr($form_unique_id); ?>" type="hidden" value="" />
        </div>
    </form>

    <div class="productiveminds_form_submission_info_box_container noned">
        <div class="productiveminds_form_submission_info_box">
            <?php // Success or error message ?>
        </div>
    </div>
    <?php if ( 'productive_g_recaptcha_v3' == $submission_verify_type ) { ?>
        <script>
            function submitProductiveContactFormWithReCaptcha_<?php echo esc_attr($form_unique_id); ?>(token) {
                document.getElementById("productive_forms_form_contact_submit_ajax_<?php echo esc_attr($form_unique_id); ?>").click();
            }
        </script>
                
        <?php if( 'productive_g_recaptcha_v3' == $submission_verify_type && ( empty(productive_forms_integration_recaptcha_key()) || empty(productive_forms_integration_recaptcha_secret()) ) ) { ?>
            <div class="bordered-left-error red fs-xs">
                <?php echo __( 'Google reCAPTCHA settings are missing. Please configure your Google reCAPTCHA settings in the admin panel.', 'productive-forms' ) ?>
            </div>
        <?php } ?>
    <?php } ?>
<?php
}



function productive_forms_newsletter_form_in_portrait_ajax( $misc = array()  ) {
    
    $form_unique_id                                     = $misc['form_unique_id'];
    $display_email_field_only                           = $misc['display_email_field_only'];
    $newsletter_how_to_display_contact_name_field       = $misc['newsletter_how_to_display_contact_name_field'];
    $display_contact_form_label                         = $misc['display_contact_form_label'];
    $request_data_privacy_consent                       = $misc['request_data_privacy_consent'];
    $submission_verify_type                             = $misc['submission_verify_type'];
    $section_style_content_button_hover_animation       = $misc['section_style_content_button_hover_animation'];
    $productive_forms_form_submit_text                  = $misc['productive_forms_form_submit_text'];
    $productive_forms_form_footnote_text                = $misc['productive_forms_form_footnote_text'];
    
    $labelled = '';
    if ( $display_contact_form_label ) {
        $labelled = ' labelled';
    }
    
    $recaptcha_site_key = productive_forms_integration_recaptcha_key();
    $maths_challenge_variable_1 = productive_forms_integration_maths_challenge_options_var_1();
    $maths_challenge_variable_2 = productive_forms_integration_maths_challenge_options_var_2();
    ?>
    <div class="productiveminds_form_container productive_forms_form_newsletter_container portrait <?php echo esc_attr( $labelled ); ?>">
        
        <div class="productive-forms-box productiveminds-alignable-container gap-10px">
            <form class="productive_forms_form_newsletter_form portrait productiveminds-alignable-container gap-10px" id="productive_forms_form_newsletter_form_<?php echo esc_attr($form_unique_id); ?>" method="POST">
                
                <?php if( !$display_email_field_only ) { ?>
                    <div class="productiveminds_form_field_box">
                        <?php if ( 'individual_fields' == $newsletter_how_to_display_contact_name_field ) {
                            $productive_forms_form_newsletter_name = __( 'First Name', 'productive-forms' );
                        } else {
                            $productive_forms_form_newsletter_name = __( 'Name', 'productive-forms' );
                        } ?>
                        <label class="noned" for="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_attr($productive_forms_form_newsletter_name); ?> <span class="required-field-asterik">*</span></label>
                        <input name="productive_forms_form_newsletter_name" id="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>" type="text" placeholder="<?php echo esc_attr($productive_forms_form_newsletter_name); ?> *"/>
                    </div>

                    <?php if ( 'individual_fields' == $newsletter_how_to_display_contact_name_field ) { ?>
                        <div class="productiveminds_form_field_box">
                            <label class="noned" for="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo __( 'Last Name', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
                            <input name="productive_forms_form_newsletter_last_name" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" type="text" placeholder="<?php echo __( 'Last Name', 'productive-forms' ) ?> *"/>
                        </div>
                    <?php } else { ?>
                        <input type="hidden" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" name="productive_forms_form_newsletter_last_name" value="" />
                    <?php } ?>
                <?php } else { ?>
                    <input type="hidden" name="productive_forms_form_newsletter_name" id="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>" value="unused" />
                    <input type="hidden" name="productive_forms_form_newsletter_last_name" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" value="unused" />
                <?php } ?>
                        
                <div class="productiveminds_form_field_box">
                    <label class="noned" for="productive_forms_form_newsletter_email_<?php echo esc_attr($form_unique_id); ?>"><?php echo __( 'Email', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
                    <input name="productive_forms_form_newsletter_email" id="productive_forms_form_newsletter_email_<?php echo esc_attr($form_unique_id); ?>" type="email" placeholder="<?php echo __( 'Email', 'productive-forms' ) ?> *"/>
                    
                    <?php if ( 'individual_fields' == $newsletter_how_to_display_contact_name_field ) {
                        $how_to_display_newsletter_name_field_value = 'individual_fields';
                    } else {
                        $how_to_display_newsletter_name_field_value = 'combined_fields';
                    } ?>
                    <input type="hidden" id="how_to_display_newsletter_name_field_<?php echo esc_attr($form_unique_id); ?>" name="how_to_display_newsletter_name_field" value="<?php echo esc_attr($how_to_display_newsletter_name_field_value); ?>" />
                </div>

                <?php if ( 'maths_challenge' == $submission_verify_type ) { ?>
                   <div class="productiveminds_form_field_box">
                       <label class="noned" for="productive_forms_form_newsletter_verify_is_spam_<?php echo esc_attr($form_unique_id); ?>"><?php echo __('What is the answer:', 'productive-forms') ?> <span class="required-field-asterik">*</span> <?php echo esc_html($maths_challenge_variable_1); ?> + <?php echo esc_html($maths_challenge_variable_2); ?> = ? </label>
                       <input name="productive_forms_form_newsletter_verify_maths" id="productive_forms_form_newsletter_verify_maths_<?php echo esc_attr($form_unique_id); ?>" type="type" <?php if (empty($labelled)) { ?>placeholder="<?php echo __( 'What is the answer:', 'productive-forms' ) ?>  <?php echo esc_attr($maths_challenge_variable_1); ?> + <?php echo esc_attr($maths_challenge_variable_2); ?> = ?"<?php } ?> value="" />
                   </div>
                <?php } else { ?>
                   <input name="productive_forms_form_newsletter_verify_maths" id="productive_forms_form_newsletter_verify_maths_<?php echo esc_attr($form_unique_id); ?>" type="hidden" value="unused" />
                <?php } ?>

                <?php if ( $request_data_privacy_consent ) { ?>
                    <div class="productiveminds_form_field_box extra-margin">
                        <input id="productive_forms_newsletter_consent_checkbox_text_newsletter_<?php echo esc_attr($form_unique_id); ?>" type="checkbox" name="productive_forms_newsletter_consent_checkbox_text_newsletter" />
                        <label for="productive_forms_newsletter_consent_checkbox_text_newsletter_<?php echo esc_attr($form_unique_id); ?>">
                            <?php do_action( 'display_productive_forms_newsletter_consent_checkbox_text_newsletter'); ?> <span class="required-field-asterik">*</span>
                        </label>
                    </div>
                    <input type="hidden" id="is_consent_checkbox_<?php echo esc_attr($form_unique_id); ?>" name="is_consent_checkbox" value="1" />
                <?php } else { ?>
                    <input type="hidden" id="is_consent_checkbox_<?php echo esc_attr($form_unique_id); ?>" name="is_consent_checkbox" value="0" />
                <?php } ?>
                    
                <input type="hidden" id="is_consent_required_<?php echo esc_attr($form_unique_id); ?>" name="is_consent_required" value="<?php echo esc_attr($request_data_privacy_consent); ?>" />
                <input type="hidden" id="submission_verify_type_<?php echo esc_attr($form_unique_id); ?>" name="submission_verify_type" value="<?php echo esc_attr($submission_verify_type); ?>" />
                    
                <div class="productiveminds_form_field_box action productiveminds-alignable-container width-100pc align-items-center align-content-center justify-items-start align-content-flex-start">
                    <?php if ( 'productive_g_recaptcha_v3' == $submission_verify_type ) { ?>
                        <button aria-label="<?php echo esc_attr('Submit', 'productive-forms'); ?>" 
                            class="productive_forms_form_newsletter_submit_ajax g_recaptcha_v3 newsletter <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                            name="productive_forms_form_newsletter_submit_ajax_<?php echo esc_attr($form_unique_id); ?>" 
                            id="productive_forms_form_newsletter_submit_ajax_<?php echo esc_attr($form_unique_id); ?>"
                            data-productive_form_id="<?php echo esc_attr($form_unique_id); ?>"
                            type="submit"
                            data-form_orientation="portrait"
                            data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>" 
                            data-callback='submitProductiveNewsletterFormWithReCaptcha_<?php echo esc_attr($form_unique_id); ?>' data-action='click'
                        >
                            <?php echo esc_html($productive_forms_form_submit_text); ?>
                        </button>
                    <?php } else { ?>
                        <button aria-label="<?php echo esc_attr('Send', 'productive-forms'); ?>" 
                            class="productive_forms_form_newsletter_submit_ajax std newsletter <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                            name="productive_forms_form_newsletter_submit_ajax" 
                            id="productive_forms_form_newsletter_submit_ajax_<?php echo esc_attr($form_unique_id); ?>"
                            data-productive_form_id="<?php echo esc_attr($form_unique_id); ?>"
                            type="submit"
                            data-form_orientation="portrait"
                        >
                            <?php echo esc_html($productive_forms_form_submit_text); ?>
                        </button>
                    <?php } ?>
                 </div>
                <div class="clear_min">
                    <?php $form_nonce = wp_create_nonce('productive_forms_newsletter_form_nonce'); ?>
                    <input type="hidden" name="nonce" value="<?php echo esc_attr($form_nonce); ?>" />
                    <input name="email" id="email_<?php echo esc_attr($form_unique_id); ?>" type="hidden" value="" />
                </div>
            </form>
            
            <div class="productiveminds_form_submission_info_box_container noned">
                <div class="productiveminds_form_submission_info_box">
                    <?php // Success or error message ?>
                </div>
            </div>
            
            <?php if ( 'productive_g_recaptcha_v3' == $submission_verify_type ) { ?>
                <script>
                    function submitProductiveNewsletterFormWithReCaptcha_<?php echo esc_attr($form_unique_id); ?>(token) {
                        document.getElementById("productive_forms_form_newsletter_submit_ajax_<?php echo esc_attr($form_unique_id); ?>").click();
                    }
                </script>
            <?php } ?>
                
            <?php if( 'productive_g_recaptcha_v3' == $submission_verify_type && ( empty(productive_forms_integration_recaptcha_key()) || empty(productive_forms_integration_recaptcha_secret()) ) ) { ?>
                <div class="bordered-left-error red fs-xs">
                    <?php echo __( 'Google reCAPTCHA settings are missing. Please configure your Google reCAPTCHA settings in the admin panel.', 'productive-forms' ) ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php if( !empty($productive_forms_form_footnote_text) ) { ?>
        <div class="productive_forms_newsletter_form_side_footnote"><?php echo esc_html( $productive_forms_form_footnote_text ); ?></div>
    <?php } ?>
<?php
}


function productive_forms_newsletter_form_in_landscape_ajax( $misc = array()  ) {
    
    $form_unique_id                                     = $misc['form_unique_id'];
    $display_email_field_only                           = $misc['display_email_field_only'];
    $newsletter_how_to_display_contact_name_field       = $misc['newsletter_how_to_display_contact_name_field'];
    $display_contact_form_label                         = $misc['display_contact_form_label'];
    $request_data_privacy_consent                       = $misc['request_data_privacy_consent'];
    $submission_verify_type                             = $misc['submission_verify_type'];
    $section_style_content_button_hover_animation       = $misc['section_style_content_button_hover_animation'];
    $productive_forms_form_submit_text                  = $misc['productive_forms_form_submit_text'];
    $productive_forms_form_footnote_text                = $misc['productive_forms_form_footnote_text'];
    
    $labelled = '';
    $landscape_column_alignment = 'align-items-center align-content-center';
    if ( $display_contact_form_label ) {
        $labelled = ' labelled';
        $landscape_column_alignment = 'align-items-flex-end align-content-flex-end';
    }
    
    $recaptcha_site_key = productive_forms_integration_recaptcha_key();
    $maths_challenge_variable_1 = productive_forms_integration_maths_challenge_options_var_1();
    $maths_challenge_variable_2 = productive_forms_integration_maths_challenge_options_var_2();
    ?>
    <div class="productiveminds_form_container productive_forms_form_newsletter_container landscape <?php echo esc_attr( $labelled ); ?>">
        <div>
            <form class="productive_forms_form_newsletter_form landscape productiveminds-alignable-container gap-10px" id="productive_forms_form_newsletter_form_<?php echo esc_attr($form_unique_id); ?>" method="POST">

                <div class="productive-forms-box-grid productiveminds-alignable-container flexed <?php echo esc_attr( $landscape_column_alignment ); ?> column-gap-5px row-gap-5px">
                    <div class="productive-forms-box-grid-inputs flexed-autoed">
                        <div class="productive-forms-box-grid-inputs-grid productiveminds-alignable-container flexed flexed-in-a-flexed align-items-center align-content-center column-gap-5px row-gap-5px">

                            <?php if( !$display_email_field_only ) { ?>
                                <div class="productiveminds_form_field_box flexed-autoed">
                                    <?php if ( 'individual_fields' == $newsletter_how_to_display_contact_name_field ) {
                                        $productive_forms_form_newsletter_name = __( 'First Name', 'productive-forms' );
                                    } else {
                                        $productive_forms_form_newsletter_name = __( 'Name', 'productive-forms' );
                                    } ?>
                                    <label class="noned" for="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo esc_attr($productive_forms_form_newsletter_name); ?> <span class="required-field-asterik">*</span></label>
                                    <input name="productive_forms_form_newsletter_name" id="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>" type="text" placeholder="<?php echo esc_attr($productive_forms_form_newsletter_name); ?> *"/>
                                </div>

                                <?php if ( 'individual_fields' == $newsletter_how_to_display_contact_name_field ) { ?>
                                    <div class="productiveminds_form_field_box flexed-autoed">
                                        <label class="noned" for="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>"><?php echo __( 'Last Name', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
                                        <input name="productive_forms_form_newsletter_last_name" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" type="text" placeholder="<?php echo __( 'Last Name', 'productive-forms' ) ?> *"/>
                                    </div>
                                <?php } else { ?>
                                    <input type="hidden" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" name="productive_forms_form_newsletter_last_name" value="" />
                                <?php } ?>
                            <?php } else { ?>
                                <input type="hidden" name="productive_forms_form_newsletter_name" id="productive_forms_form_newsletter_name_<?php echo esc_attr($form_unique_id); ?>" value="unused" />
                                <input type="hidden" name="productive_forms_form_newsletter_last_name" id="productive_forms_form_newsletter_last_name_<?php echo esc_attr($form_unique_id); ?>" value="unused" />
                            <?php } ?>

                            <div class="productiveminds_form_field_box flexed-autoed">
                                <label class="noned" for="productive_forms_form_newsletter_email_<?php echo esc_attr($form_unique_id); ?>"><?php echo __( 'Email', 'productive-forms' ) ?> <span class="required-field-asterik">*</span></label>
                                <input name="productive_forms_form_newsletter_email" id="productive_forms_form_newsletter_email_<?php echo esc_attr($form_unique_id); ?>" type="email" placeholder="<?php echo __( 'Email', 'productive-forms' ) ?> *"/>

                                <?php if ( 'individual_fields' == $newsletter_how_to_display_contact_name_field ) {
                                    $how_to_display_newsletter_name_field_value = 'individual_fields';
                                } else {
                                    $how_to_display_newsletter_name_field_value = 'combined_fields';
                                } ?>
                                <input type="hidden" id="how_to_display_newsletter_name_field_<?php echo esc_attr($form_unique_id); ?>" name="how_to_display_newsletter_name_field" value="<?php echo esc_attr($how_to_display_newsletter_name_field_value); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="productive-forms-box-grid-button">
                        <div class="productiveminds_form_field_box action productiveminds-alignable-container width-100pc align-items-center align-content-center justify-items-start align-content-flex-start">
                            <?php if ( 'productive_g_recaptcha_v3' == $submission_verify_type ) { ?>
                                <button aria-label="<?php echo esc_attr('Submit', 'productive-forms'); ?>" 
                                    class="productive_forms_form_newsletter_submit_ajax g_recaptcha_v3 newsletter <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                                    name="productive_forms_form_newsletter_submit_ajax_<?php echo esc_attr($form_unique_id); ?>" 
                                    id="productive_forms_form_newsletter_submit_ajax_<?php echo esc_attr($form_unique_id); ?>"
                                    data-productive_form_id="<?php echo esc_attr($form_unique_id); ?>"
                                    type="submit"
                                    data-form_orientation="landscape"
                                    data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>" 
                                    data-callback='submitProductiveNewsletterFormWithReCaptcha_<?php echo esc_attr($form_unique_id); ?>' data-action='click'
                                >
                                    <?php echo esc_html($productive_forms_form_submit_text); ?>
                                </button>
                            <?php } else { ?>
                                <button aria-label="<?php echo esc_attr('Send', 'productive-forms'); ?>" 
                                    class="productive_forms_form_newsletter_submit_ajax std newsletter <?php echo esc_attr( $section_style_content_button_hover_animation ); ?>" 
                                    name="productive_forms_form_newsletter_submit_ajax" 
                                    id="productive_forms_form_newsletter_submit_ajax_<?php echo esc_attr($form_unique_id); ?>"
                                    data-productive_form_id="<?php echo esc_attr($form_unique_id); ?>"
                                    type="submit"
                                    data-form_orientation="landscape"
                                >
                                    <?php echo esc_html($productive_forms_form_submit_text); ?>
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if ( 'maths_challenge' == $submission_verify_type ) { ?>
                   <div class="productiveminds_form_field_box">
                       <label class="noned" for="productive_forms_form_newsletter_verify_is_spam_<?php echo esc_attr($form_unique_id); ?>"><?php echo __('What is the answer:', 'productive-forms') ?> <span class="required-field-asterik">*</span> <?php echo esc_html($maths_challenge_variable_1); ?> + <?php echo esc_html($maths_challenge_variable_2); ?> = ? </label>
                       <input name="productive_forms_form_newsletter_verify_maths" id="productive_forms_form_newsletter_verify_maths_<?php echo esc_attr($form_unique_id); ?>" type="type" <?php if (empty($labelled)) { ?>placeholder="<?php echo __( 'What is the answer:', 'productive-forms' ) ?>  <?php echo esc_attr($maths_challenge_variable_1); ?> + <?php echo esc_attr($maths_challenge_variable_2); ?> = ?"<?php } ?> value="" />
                   </div>
                <?php } else { ?>
                   <input name="productive_forms_form_newsletter_verify_maths" id="productive_forms_form_newsletter_verify_maths_<?php echo esc_attr($form_unique_id); ?>" type="hidden" value="unused" />
                <?php } ?>

                <?php if ( $request_data_privacy_consent ) { ?>
                    <div class="productiveminds_form_field_box extra-margin">
                        <input id="productive_forms_newsletter_consent_checkbox_text_newsletter_<?php echo esc_attr($form_unique_id); ?>" type="checkbox" name="productive_forms_newsletter_consent_checkbox_text_newsletter" />
                        <label for="productive_forms_newsletter_consent_checkbox_text_newsletter_<?php echo esc_attr($form_unique_id); ?>">
                            <?php do_action( 'display_productive_forms_newsletter_consent_checkbox_text_newsletter'); ?> <span class="required-field-asterik">*</span>
                        </label>
                    </div>
                    <input type="hidden" id="is_consent_checkbox_<?php echo esc_attr($form_unique_id); ?>" name="is_consent_checkbox" value="1" />
                <?php } else { ?>
                    <input type="hidden" id="is_consent_checkbox_<?php echo esc_attr($form_unique_id); ?>" name="is_consent_checkbox" value="0" />
                <?php } ?>
                    
                <input type="hidden" id="is_consent_required_<?php echo esc_attr($form_unique_id); ?>" name="is_consent_required" value="<?php echo esc_attr($request_data_privacy_consent); ?>" />
                <input type="hidden" id="submission_verify_type_<?php echo esc_attr($form_unique_id); ?>" name="submission_verify_type" value="<?php echo esc_attr($submission_verify_type); ?>" />
                   
                <div class="clear_min">
                    <?php $form_nonce = wp_create_nonce('productive_forms_newsletter_form_nonce'); ?>
                    <input type="hidden" name="nonce" value="<?php echo esc_attr($form_nonce); ?>" />
                    <input name="email" id="email_<?php echo esc_attr($form_unique_id); ?>" type="hidden" value="" />
                </div>
            </form>
            
            <div class="productiveminds_form_submission_info_box_container noned">
                <div class="productiveminds_form_submission_info_box">
                    <?php // Success or error message ?>
                </div>
            </div>
            
            <?php if ( 'productive_g_recaptcha_v3' == $submission_verify_type ) { ?>
                <script>
                    function submitProductiveNewsletterFormWithReCaptcha_<?php echo esc_attr($form_unique_id); ?>(token) {
                        document.getElementById("productive_forms_form_newsletter_submit_ajax_<?php echo esc_attr($form_unique_id); ?>").click();
                    }
                </script>
            <?php } ?>
                
            <?php if( 'productive_g_recaptcha_v3' == $submission_verify_type && ( empty(productive_forms_integration_recaptcha_key()) || empty(productive_forms_integration_recaptcha_secret()) ) ) { ?>
                <div class="bordered-left-error red fs-xs">
                    <?php echo __( 'Google reCAPTCHA settings are missing. Please configure your Google reCAPTCHA settings in the admin panel.', 'productive-forms' ) ?>
                </div>
            <?php } ?>
                
        </div>        
    </div>
    <?php if( !empty($productive_forms_form_footnote_text) ) { ?>
        <div class="productive_forms_newsletter_form_side_footnote"><?php echo esc_html( $productive_forms_form_footnote_text ); ?></div>
    <?php } ?>
<?php
}
