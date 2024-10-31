<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

// Register Custom Post Type
function productive_forms_contact_post_type() {
    
    $labels = array(
        'name'                  => _x( PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_NAME_PLURAL, 'Post Type General Name', 'productive-forms' ),    // Post Type General Name
        'singular_name'         => _x( PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_NAME_SINGULAR, 'Post Type Singular Name', 'productive-forms' ),     // Post Type Singular Name
        'menu_name'             => __( PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_NAME_PLURAL, 'productive-forms' ),
        'name_admin_bar'        => __( PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_NAME_SINGULAR, 'productive-forms' ),
        'archives'              => __( 'Archives', 'productive-forms' ),
        'attributes'            => __( 'Attributes', 'productive-forms' ),
        'parent_item_colon'     => __( 'Parent Contact:', 'productive-forms' ),
        'all_items'             => __( 'All Contacts', 'productive-forms' ),
        'add_new_item'          => __( 'Add New Contact', 'productive-forms' ),
        'add_new'               => __( 'Add New', 'productive-forms' ),
        'new_item'              => __( 'New Contact', 'productive-forms' ),
        'edit_item'             => __( 'Edit Contact', 'productive-forms' ),
        'update_item'           => __( 'Update Contact', 'productive-forms' ),
        'view_item'             => __( 'View Contact', 'productive-forms' ),
        'view_items'            => __( 'View Contacts', 'productive-forms' ),
        'search_items'          => __( 'Search Contact', 'productive-forms' ),
        'not_found'             => __( 'Not found', 'productive-forms' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'productive-forms' ),
        'featured_image'        => __( 'Contact Image', 'productive-forms' ),
        'set_featured_image'    => __( 'Add Contact Image', 'productive-forms' ),
        'remove_featured_image' => __( 'Remove Contact Image', 'productive-forms' ),
        'use_featured_image'    => __( 'Use as Main Contact Image', 'productive-forms' ),
        'insert_into_item'      => __( 'Insert into Contact', 'productive-forms' ),
        'uploaded_to_this_item' => __( 'Upload to this Contact', 'productive-forms' ),
        'items_list'            => __( 'Contacts list', 'productive-forms' ),
        'items_list_navigation' => __( 'Contacts list navigation', 'productive-forms' ),
        'filter_items_list'     => __( 'Filter Contacts', 'productive-forms' ),
    );
    $args = array(
        'label'                 => __( PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_NAME_SINGULAR, 'productive-forms' ),
        'description'           => __( 'Contact post type for adding contacts', 'productive-forms' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'hierarchical'          => true,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true, // HD
        'menu_position'         => 11,
        'menu_icon'             => 'dashicons-admin-generic',
        'show_in_admin_bar'     => true, // HD
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'show_in_rest'          => true,
        'capability_type'       => 'page',
    );
    register_post_type( PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_SLUG, $args ); // limit this to 20 characters, max.

}
add_action( 'init', 'productive_forms_contact_post_type', 0 );


function productive_forms_contact_add_meta_box() {
    $args = array(
        //'__back_compact_meta_box' => true,
        //'__block_editor_compatible_meta_box' => false,
    );
    add_meta_box('productive_contact_id', __( 'Contacts Info', 'productive-forms' ), 'productive_forms_contact_add_meta_box_callback', PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_SLUG, 'normal', 'default', $args);
}
add_action( 'add_meta_boxes_' . PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_SLUG, 'productive_forms_contact_add_meta_box' );


function productive_forms_contact_add_meta_box_callback( $post ) {
    $contact_post_id = $post->ID;
    $contact_meta_object = get_post_meta( $contact_post_id, '_contact', true );
    $contact_icon = '';
    if ( !empty( $contact_meta_object['contact_icon'] ) ) {
        $contact_icon = $contact_meta_object['contact_icon'];
    }
    $contact_url = '';
    if ( !empty( $contact_meta_object['contact_url'] ) ) {
        $contact_url = $contact_meta_object['contact_url'];
    }
    $contact_cta_text = '';
    if ( !empty( $contact_meta_object['contact_cta_text'] ) ) {
        $contact_cta_text = $contact_meta_object['contact_cta_text'];
    }
    wp_nonce_field( 'contactnonce', '_contactnonce' );
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="contact-contact_icon"><?php echo __( 'Icon', 'productive-forms' ); ?></label>
                <label class="screen-reader-text" for="contact-contact_icon"><?php echo __( 'Contact Icon', 'productive-forms' ); ?></label>
            </th>
            <td>
                <div><input id="contact_icon" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $contact_icon ); ?>" name="contact[contact_icon]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'Font awesome Icon Code (e.g fa-check)', 'productive-forms' ); ?>
                    <a target="_blank" href="https://fontawesome.com/v4/icons">Icons list</a>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="contact-contact_url"><?php echo __( 'CTA Url', 'productive-forms' ); ?></label>
                <label class="screen-reader-text" for="contact-contact_url"><?php echo __( 'Contact Url', 'productive-forms' ); ?></label>
            </th>
            <td>
                <div><input id="contact_url" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $contact_url ); ?>" name="contact[contact_url]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Destination Url for CTA click, starting with http (optional)', 'productive-forms' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="contact-contact_cta_text"><?php echo __( 'CTA Text', 'productive-forms' ); ?></label>
                <label class="screen-reader-text" for="contact-contact_cta_text"><?php echo __( 'Contact Text', 'productive-forms' ); ?></label>
            </th>
            <td>
                <div><input id="contact_cta_text" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $contact_cta_text ); ?>" name="contact[contact_cta_text]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Text for the CTA button (optional)', 'productive-forms' ); ?></div>
            </td>
        </tr>
    </table>
    <?php
}


function productive_forms_contact_save_meta_box( $post_id, $post ) {
    $contact_post_id = $post_id;
    
    if ( !isset( $_POST['_contactnonce'] ) || !wp_verify_nonce( $_POST['_contactnonce'], 'contactnonce' ) ) {
        return $contact_post_id;
    }

    $contact_post_type_object = get_post_type_object( $post->post_type );
    if ( !current_user_can( $contact_post_type_object->cap->edit_post, $contact_post_id ) ) {
        return $contact_post_id;
    }
    
    if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $contact_post_id;
    }
    
    $this_posts_post_type = $post->post_type;
    if ( PRODUCTIVE_FORMS_PLUGIN_SERVICE_POST_TYPE_SLUG != $this_posts_post_type ) {
        return $contact_post_id;
    }
    
    if ( isset( $_POST['contact'] ) && ! empty( $_POST['contact'] ) ) {
        $contact_meta_object = array();
        if ( !empty( $_POST['contact']['contact_icon'] ) ) {
            $contact_meta_object['contact_icon'] = sanitize_text_field( $_POST['contact']['contact_icon'] );
        }
        if ( !empty( $_POST['contact']['contact_url'] ) ) {
            $contact_meta_object['contact_url'] = sanitize_url( $_POST['contact']['contact_url'] );
        }
        if ( !empty( $_POST['contact']['contact_cta_text'] ) ) {
            $contact_meta_object['contact_cta_text'] = sanitize_text_field( $_POST['contact']['contact_cta_text'] );
        }
        update_post_meta( $post_id, '_contact', $contact_meta_object);
    } else {
        delete_post_meta( $post_id, '_contact');
    }
    
    return $contact_post_id;
}
add_action( 'save_post', 'productive_forms_contact_save_meta_box', 10, 20 );


function productive_forms_contact_edit_columns( $columns ) {
    $columns = array(
        'cb'    => '<input type="checkbox" />',
        'title'    => __( 'Title', 'productive-forms' ),
        'contact-contact-icon'    => __( 'Icon', 'productive-forms' ),
        'contact-contact-url'    => __( 'Url', 'productive-forms' ),
        'contact-cta-text'    => __( 'CTA Title', 'productive-forms' ),
        'date'    => __( 'Date', 'productive-forms' ),
    );
    return $columns;
}
add_filter( 'manage_edit-contact_columns', 'productive_forms_contact_edit_columns' );


function productive_forms_contact_editable_columns( $column_name, $post_id ) {
    $contact_meta_object = get_post_meta( $post_id, '_contact', true );
    switch ( $column_name ) {
        case 'contact-contact-icon':
            if ( !empty( $contact_meta_object['contact_icon'] ) ) {
                echo esc_attr( $contact_meta_object['contact_icon'] );
            }
            break;

        case 'contact-contact-url':
            if ( !empty( $contact_meta_object['contact_url'] ) ) {
                echo '<a target="_blank" href="' . esc_url( $contact_meta_object['contact_url'] ) . '">' . esc_url( $contact_meta_object['contact_url'] ) . '</a>';
            }
            break;

        case 'contact-cta-text':
            if ( !empty( $contact_meta_object['contact_cta_text'] ) ) {
                echo esc_attr( $contact_meta_object['contact_cta_text'] );
            }
            break;

        default:
            break;
    }
    return $column_name;
}
add_action( 'manage_pages_custom_column', 'productive_forms_contact_editable_columns', 10, 2 );
