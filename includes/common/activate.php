<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

/**
 * Method productive_forms_activate ''.
 */
function productive_forms_activate() {
    productive_forms_database_install();
    productive_forms_create_contact_us_landing_page();
}

/**
 * Method productive_forms_create_contact_us_landing_page ''.
 */
function productive_forms_create_contact_us_landing_page() {
    $args = array(
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'name'           => PRODUCTIVE_FORMS_CONTACT_US_PAGE_SLUG,
    );
    
    $page_exists = false;
    $productive_posts = new WP_Query( $args );
    if ( $productive_posts->have_posts() ) {
        $page_exists = true;
    }
    
    $admin_user_id = get_current_user_id();
    
    $page_content = '<!-- wp:productive-forms/contact-page /-->';
    
    if ( !$page_exists && user_can_access_admin_page() ) {
        $new_page_id = wp_insert_post(
            array(
                'comment_status'    =>	'closed',
                'ping_status'       =>	'closed',
                'post_author'       =>	$admin_user_id,
                'post_name'         =>	PRODUCTIVE_FORMS_CONTACT_US_PAGE_SLUG,
                'post_title'        =>	PRODUCTIVE_FORMS_CONTACT_US_PAGE_TITLE,
                'post_content'      =>  $page_content,
                'post_status'       =>	'publish',
                'post_type'         =>	'page'
            )
        );
        add_option( PRODUCTIVE_FORMS_CONTACT_US_PAGE_DEFAULT_SLUG_VALUE, PRODUCTIVE_FORMS_CONTACT_US_PAGE_SLUG );
    } else {
        $options = get_option( 'productive_forms_section_contact_options' );
        $option_value = 0;
        if( isset( $options['productive_forms_contact_us_page'] ) ) {
            $option_value = sanitize_text_field( $options['productive_forms_contact_us_page'] );
        }
        if( $option_value ) {
            $page = get_post( $option_value );
            if( null != $page && is_object( $page ) ) {
                update_option( PRODUCTIVE_FORMS_CONTACT_US_PAGE_DEFAULT_SLUG_VALUE, $page->post_name );
            }
        }
    }
}
