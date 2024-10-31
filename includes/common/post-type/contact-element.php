<?php
/**
 *
 * @package     productive-form
 * @author      productiveminds.com
 * @copyright   productiveminds.com
 */

if ( !defined('ABSPATH') ) {
	die();
}

// Registrar Custom Post Type
function productive_forms_pro_contact_element_post_type() {
    
    $labels = array(
        'name'                  => _x( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_NAME_PLURAL, 'Post Type General Name', 'productive-form' ),    // Post Type General Name
        'singular_name'         => _x( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_NAME_SINGULAR, 'Post Type Singular Name', 'productive-form' ),     // Post Type Singular Name
        'menu_name'             => __( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_NAME_PLURAL, 'productive-form' ),
        'name_admin_bar'        => __( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_NAME_SINGULAR, 'productive-form' ),
        'archives'              => __( 'Archives', 'productive-form' ),
        'attributes'            => __( 'Attributes', 'productive-form' ),
        'parent_item_colon'     => __( 'Parent Contact Element:', 'productive-form' ),
        'all_items'             => __( 'All Contact Elements', 'productive-form' ),
        'add_new_item'          => __( 'Add New Contact Element', 'productive-form' ),
        'add_new'               => __( 'Add New', 'productive-form' ),
        'new_item'              => __( 'New Contact Element', 'productive-form' ),
        'edit_item'             => __( 'Edit Contact Element', 'productive-form' ),
        'update_item'           => __( 'Update Contact Element', 'productive-form' ),
        'view_item'             => __( 'View Contact Element', 'productive-form' ),
        'view_items'            => __( 'View Contact Elements', 'productive-form' ),
        'search_items'          => __( 'Search Contact Element', 'productive-form' ),
        'not_found'             => __( 'Not found', 'productive-form' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'productive-form' ),
        'featured_image'        => __( 'Contact Element Picture', 'productive-form' ),
        'set_featured_image'    => __( 'Add Contact Element Picture', 'productive-form' ),
        'remove_featured_image' => __( 'Remove Contact Element Picture', 'productive-form' ),
        'use_featured_image'    => __( 'Use as Main Contact Element Picture', 'productive-form' ),
        'insert_into_item'      => __( 'Insert into Contact Element', 'productive-form' ),
        'uploaded_to_this_item' => __( 'Upload to this Contact Element', 'productive-form' ),
        'items_list'            => __( 'Contact Elements list', 'productive-form' ),
        'items_list_navigation' => __( 'Contact Elements list navigation', 'productive-form' ),
        'filter_items_list'     => __( 'Filter Contact Elements', 'productive-form' ),
    );
    $args = array(
        'label'                 => __( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_NAME_SINGULAR, 'productive-form' ),
        'description'           => __( 'Contact Element post type for adding product elements', 'productive-form' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
        'hierarchical'          => true, 
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 9,
        'menu_icon'             => 'dashicons-admin-generic',
        'show_in_admin_bar'     => true, // HD
        'show_in_nav_menus'     => false,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => false,
        'show_in_rest'          => true,
        'capability_type'       => 'page',
    );
    register_post_type( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_SLUG, $args ); // limit this to 20 characters, max.

}
add_action( 'init', 'productive_forms_pro_contact_element_post_type', 0 );


function productive_forms_pro_contact_element_add_meta_box() {
    $args = array(
        '__back_compact_meta_box' => true,
        '__block_editor_compatible_meta_box' => true,
    );
    add_meta_box('productive_pro_contact_element_id', __( 'Contact Element Fields', 'productive-form' ), 'productive_forms_pro_contact_element_add_meta_box_callback', PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_SLUG, 'normal', 'default', $args);
}
add_action( 'add_meta_boxes_' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_SLUG, 'productive_forms_pro_contact_element_add_meta_box' );


function productive_forms_pro_contact_element_add_meta_box_callback( $post ) {
    $element_post_id = $post->ID;
    $element_meta_object = get_post_meta( $element_post_id, PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_META_KEY, true );
    $cpt_icon = '';
    if ( !empty( $element_meta_object['cpt_icon'] ) ) {
        $cpt_icon = $element_meta_object['cpt_icon'];
    }
    $cpt_url = '';
    if ( !empty( $element_meta_object['cpt_url'] ) ) {
        $cpt_url = $element_meta_object['cpt_url'];
    }
    $cpt_url_text = '';
    if ( !empty( $element_meta_object['cpt_url_text'] ) ) {
        $cpt_url_text = $element_meta_object['cpt_url_text'];
    }
    wp_nonce_field( 'elementnonce', '_pro_elementnonce' );
    ?>
    <table class="form-table">
        <tr>
            <th>
                <label for="pro_contact_element-cpt_icon"><?php echo __( 'Icon', 'productive-form' ); ?></label>
                <label class="screen-reader-text" for="pro_contact_element-cpt_icon"><?php echo __( 'Icon', 'productive-form' ); ?></label>
            </th>
            <td>
                <div><input id="pro_contact_element-cpt_icon" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_icon ); ?>" name="pro_contact_element[cpt_icon]" class="form-required form-input-tip" /></div>
                <div>
                    <?php echo __( 'Font awesome Icon Code (e.g fa-check)', 'productive-form' ); ?>
                    <a target="_blank" href="https://fontawesome.com/v4/icons">Icons list</a>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_contact_element-cpt_url"><?php echo __( 'Url', 'productive-form' ); ?></label>
                <label class="screen-reader-text" for="pro_contact_element-cpt_url"><?php echo __( 'Contact Element Url', 'productive-form' ); ?></label>
            </th>
            <td>
                <div><input id="pro_contact_element-cpt_url" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_url ); ?>" name="pro_contact_element[cpt_url]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Destination Url for CTA click, starting with http.', 'productive-form' ); ?></div>
            </td>
        </tr>
        <tr>
            <th>
                <label for="pro_contact_element-cpt_url_text"><?php echo __( 'CTA Text', 'productive-form' ); ?></label>
                <label class="screen-reader-text" for="pro_contact_element-cpt_url_text"><?php echo __( 'Contact Element Text', 'productive-form' ); ?></label>
            </th>
            <td>
                <div><input id="pro_contact_element-cpt_url_text" class="regular-text" aria-required="true" type="text" value="<?php echo esc_attr( $cpt_url_text ); ?>" name="pro_contact_element[cpt_url_text]" class="form-required form-input-tip" /></div>
                <div><?php echo __( 'Text for the CTA button.', 'productive-form' ); ?></div>
            </td>
        </tr>
    </table>
    <?php
}


function productive_forms_pro_contact_element_save_meta_box( $post_id, $post ) {
    $element_post_id = $post_id;
    
    if ( !isset( $_POST['_pro_elementnonce'] ) || !wp_verify_nonce( $_POST['_pro_elementnonce'], 'elementnonce' ) ) {
        return $element_post_id;
    }

    $element_post_type_object = get_post_type_object( $post->post_type );
    if ( !current_user_can( $element_post_type_object->cap->edit_post, $element_post_id ) ) {
        return $element_post_id;
    }
    
    if (defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $element_post_id;
    }
    
    $this_posts_post_type = $post->post_type;
    if ( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_SLUG != $this_posts_post_type ) {
        return $element_post_id;
    }
    
    if ( isset( $_POST['pro_contact_element'] ) && ! empty( $_POST['pro_contact_element'] ) ) {
        $element_meta_object = array();
        if ( !empty( $_POST['pro_contact_element']['cpt_icon'] ) ) {
            $element_meta_object['cpt_icon'] = sanitize_text_field( $_POST['pro_contact_element']['cpt_icon'] );
        }
        if ( !empty( $_POST['pro_contact_element']['cpt_url'] ) ) {
            $element_meta_object['cpt_url'] = sanitize_url( $_POST['pro_contact_element']['cpt_url'] );
        }
        if ( !empty( $_POST['pro_contact_element']['cpt_url_text'] ) ) {
            $element_meta_object['cpt_url_text'] = sanitize_text_field( $_POST['pro_contact_element']['cpt_url_text'] );
        }
        update_post_meta( $post_id, PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_META_KEY, $element_meta_object);
    } else {
        delete_post_meta( $post_id, PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_META_KEY);
    }
    
    return $element_post_id;
}
add_action( 'save_post', 'productive_forms_pro_contact_element_save_meta_box', 10, 20 );


function productive_forms_pro_contact_element_edit_columns( $columns ) {
    $columns = array(
        'cb'    => '<input type="checkbox" />',
        'title'    => __( 'Title', 'productive-form' ),
        'pro_contact_element-element-icon'    => __( 'Icon', 'productive-form' ),
        'taxonomy-contact-element-type'    => __( 'Type', 'productive-forms' ),
        'pro_contact_element-element-url'    => __( 'URL', 'productive-form' ),
        'date'    => __( 'Date', 'productive-form' ),
    );
    return $columns;
}
add_filter( 'manage_edit-pro_contact_element_columns', 'productive_forms_pro_contact_element_edit_columns' );


function productive_forms_pro_contact_element_editable_columns( $column_name, $post_id ) {
    $element_meta_object = get_post_meta( $post_id, PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_META_KEY, true );
    switch ( $column_name ) {
        case 'pro_contact_element-element-icon':
            if ( !empty( $element_meta_object['cpt_icon'] ) ) {
                echo esc_attr( $element_meta_object['cpt_icon'] );
            }
            break;
            
        case 'pro_contact_element-element-url':
            if ( !empty( $element_meta_object['cpt_url'] ) ) {
                echo '<a target="_blank" href="' . esc_url( $element_meta_object['cpt_url'] ) . '">' . esc_html( $element_meta_object['cpt_url_text'] ) . '</a>';
            }
            break;
            
        default:
            break;
    }
    return $column_name;
}
add_action( 'manage_pages_custom_column', 'productive_forms_pro_contact_element_editable_columns', 10, 2 );


function productive_forms_pro_contact_element_register_taxonomy() {
    $labels = array(
        'name'              => _x( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_PLURAL, 'Taxonomy General Name', 'productive-forms' ),
        'singular_name'     => _x( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'Taxonomy Singular Name', 'productive-forms' ),
        'search_items'      => __( 'Search ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_PLURAL, 'productive-forms' ),
        'all_items'         => __( 'All ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_PLURAL, 'productive-forms' ),
        'view_item'         => __( 'View ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'productive-forms' ),
        'parent_item'       => __( 'Parent', 'productive-forms' ),
        'parent_item_colon' => __( 'Parent', 'productive-forms' ),
        'edit_item'         => __( 'Edit ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'productive-forms' ),
        'update_item'       => __( 'Update ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'productive-forms' ),
        'add_new_item'      => __( 'Add New ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_SINGULAR, 'productive-forms' ),
        'new_item_name'     => __( 'New ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_SINGULAR . ' Name', 'productive-forms' ),
        'not_found'         => __( 'No ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_PLURAL . ' Found', 'productive-forms' ),
        'back_to_items'     => __( 'Back to ' . PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_PLURAL, 'productive-forms' ),
        'menu_name'         => __( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_NAME_PLURAL, 'productive-forms' ),
    );
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_SLUG ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_TAXONOMY_SLUG, PRODUCTIVE_FORMS_PLUGIN_CONTACT_ELEMENT_POST_TYPE_SLUG, $args );
    
}
add_action( 'init', 'productive_forms_pro_contact_element_register_taxonomy', 0 );
