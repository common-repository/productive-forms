<?php
/**
 *
 * @package     productive-forms
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

function productive_forms_render_header_contact_section() {
    if( productive_forms_header_contact_section_switch_on() ) {
        
        $productive_forms_header_contact_section_contact_icon_position      = productive_forms_header_contact_section_contact_icon_position();
        $productive_forms_header_contact_section_social_media_icon_position = productive_forms_header_contact_section_social_media_icon_position();
        $productive_forms_header_contact_section_contact_page_position      = productive_forms_header_contact_section_contact_page_position();
        
        $productive_forms_header_contact_section_contact_icon_in_use        = productive_forms_header_contact_section_contact_icon_in_use();
        
        $productive_forms_header_contact_section_alignment = productive_forms_header_contact_section_alignment();

        $attachment_id = productive_forms_header_contact_section_bg_image();
        $productive_forms_header_contact_section_bg_image = '';
        if( $attachment_id ) {
            $productive_forms_header_contact_section_bg_image = productive_forms_get_attachment_by_thumbnail_id($attachment_id);
        }

        ?>
        <?php if( $attachment_id && !empty($productive_forms_header_contact_section_bg_image) ) { ?>
            <div class="site-body-container_box_full header-header_contact_section-container container_with_bg_image" style="background-image: url(<?php echo esc_url( $productive_forms_header_contact_section_bg_image ); ?>)">
            <?php } else { ?>
            <div class="site-body-container_box_full header-header_contact_section-container">
            <?php } ?>
            <div class="site-body-container_box">
                <div class="site-body-container_box_uno">
                    <div class="header-header_contact_section-content-box productiveminds-alignable-container flexed align-items-center align-content-center row-gap-5px column-gap-25px <?php echo esc_attr($productive_forms_header_contact_section_alignment) ?>">
                        
                        <?php //left
                        if( 'hide_contact_icon' != $productive_forms_header_contact_section_contact_icon_in_use && 'left' == $productive_forms_header_contact_section_contact_icon_position ) {
                            productive_forms_render_header_contact_section_contact_icon( $productive_forms_header_contact_section_contact_icon_in_use );
                        } else if( 'left' == $productive_forms_header_contact_section_social_media_icon_position ) {
                            productive_forms_render_header_contact_section_contact_social_media_icon();
                        } else if( 'left' == $productive_forms_header_contact_section_contact_page_position ) {
                            productive_forms_render_header_contact_section_contact_page();
                        }
                        ?>
                        
                        <?php // center
                        if( 'hide_contact_icon' != $productive_forms_header_contact_section_contact_icon_in_use && 'center' == $productive_forms_header_contact_section_contact_icon_position ) {
                            productive_forms_render_header_contact_section_contact_icon( $productive_forms_header_contact_section_contact_icon_in_use );
                        } else if( 'center' == $productive_forms_header_contact_section_social_media_icon_position ) {
                            productive_forms_render_header_contact_section_contact_social_media_icon();
                        } else if( 'center' == $productive_forms_header_contact_section_contact_page_position ) {
                            productive_forms_render_header_contact_section_contact_page();
                        }
                        ?>
                        
                        <?php // right
                        if( 'hide_contact_icon' != $productive_forms_header_contact_section_contact_icon_in_use && 'right' == $productive_forms_header_contact_section_contact_icon_position ) {
                            productive_forms_render_header_contact_section_contact_icon( $productive_forms_header_contact_section_contact_icon_in_use );
                        } else if( 'right' == $productive_forms_header_contact_section_social_media_icon_position ) {
                            productive_forms_render_header_contact_section_contact_social_media_icon();
                        } else if( 'right' == $productive_forms_header_contact_section_contact_page_position ) {
                            productive_forms_render_header_contact_section_contact_page();
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
add_shortcode('display_productive_header_contact_section', 'productive_forms_render_header_contact_section');
add_action('display_productive_header_contact_section', 'productive_forms_render_header_contact_section');

function productive_forms_render_header_contact_section_contact_icon( $productive_forms_header_contact_section_contact_icon_in_use ) {
    $productive_forms_header_contact_section_contact_icon_copy          = productive_forms_header_contact_section_contact_icon_copy();
    ?>
        <div class="header_contact_section_contact_icon productiveminds-alignable-container flexed flexed-in-a-flexed align-items-center align-content-center row-gap-5px column-gap-10px">
            <?php if( !empty($productive_forms_header_contact_section_contact_icon_copy) ) { ?>
                <span class="header_contact_section_block_copy"><?php echo $productive_forms_header_contact_section_contact_icon_copy; ?></span>
            <?php } ?>
            <?php 
                switch ( $productive_forms_header_contact_section_contact_icon_in_use ) {
                    case 'email_only':
                        do_action( 'display_productive_forms_contact_email_themes' );
                        break;
                    
                    case 'phone_only':
                        do_action( 'display_productive_forms_contact_phone_themes' );
                        break;
                    
                    case 'whatsapp_only':
                        do_action( 'display_productive_forms_contact_whatsapp_themes' );
                        break;
                    
                    case 'email_and_phone':
                        do_action( 'display_productive_forms_contact_email_themes' );
                        do_action( 'display_productive_forms_contact_phone_themes' );
                        break;
                    
                    case 'email_and_whatsapp':
                        do_action( 'display_productive_forms_contact_email_themes' );
                        do_action( 'display_productive_forms_contact_whatsapp_themes' );
                        break;
                    
                    case 'phone_and_whatsapp':
                        do_action( 'display_productive_forms_contact_phone_themes' );
                        do_action( 'display_productive_forms_contact_whatsapp_themes' );
                        break;
                    
                    case 'all_three':
                        do_action( 'display_productive_forms_contact_email_themes' );
                        do_action( 'display_productive_forms_contact_phone_themes' );
                        do_action( 'display_productive_forms_contact_whatsapp_themes' );
                        break;
                    
                    default:
                        break;
                }
            ?>
        </div>
    <?php
}

function productive_forms_render_header_contact_section_contact_social_media_icon() {
    $productive_forms_header_contact_section_social_media_icon_copy     = productive_forms_header_contact_section_social_media_icon_copy();
    $productive_forms_header_contact_section_use_official_sm_colours    = productive_forms_header_contact_section_use_official_sm_colours();
    ?>
        <div class="header_contact_section_contact_social_media_icon flexed flexed-in-a-flexed align-items-center align-content-center gap-10px">
            <?php if( !empty($productive_forms_header_contact_section_social_media_icon_copy) ) { ?>
                <span class="header_contact_section_block_copy"><?php echo $productive_forms_header_contact_section_social_media_icon_copy; ?></span>
            <?php } ?>
            <?php do_action( 'display_productive_forms_social_media_block', $productive_forms_header_contact_section_use_official_sm_colours ); ?>
        </div>
    <?php
}

function productive_forms_render_header_contact_section_contact_page() {
    $productive_forms_header_contact_section_contact_page_copy = productive_forms_header_contact_section_contact_page_copy();
    ?>
        <?php 
            if( !empty($productive_forms_header_contact_section_contact_page_copy) ) {
                $productive_forms_contact_us_page_url = productive_forms_contact_us_page_url();
        ?>
                <div class="header_contact_section_contact_page flexed flexed-in-a-flexed align-items-center align-content-center">
                    <a href="<?php echo esc_url($productive_forms_contact_us_page_url); ?>"><?php echo productive_forms_header_contact_section_contact_page_copy(); ?></a>
                </div>   
        <?php } ?>
    <?php
}
