<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

if ( ! class_exists( 'Productive_Forms_And_Forms_List_Messages' ) ) {

    if ( ! class_exists( 'WP_List_Table' ) ) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
    }
    
    require PRODUCTIVE_FORMS_PLUGIN_PATH . 'includes/helper/productive-export-csv.php';

    /**
     * Productive_Forms_And_Forms_List_Messages
     * The class lists contact messages that have been submitted by website visitors
     */
    class Productive_Forms_And_Forms_List_Messages extends WP_List_Table {
        
	public $checkbox = true;

        /**
	 * @param array $args An associative array of arguments.
	 */
	public function __construct( $args = array() ) {

		parent::__construct(
			array(
				'plural'   => __( 'Submissions', 'productive-forms' ),
				'singular' => __( 'Submission', 'productive-forms' ),
				'ajax'     => false,
			)
		);
	}
        
        
	/**
	 * @return array of columns to display
	 */
	public function get_columns() {

		$columns = array();

		if ( $this->checkbox ) {
			$columns['cb'] = '<input type="checkbox" />';
		}
                
                // table_field_names => table field titles - i.e, table name (in admin) => db field
                if ( !empty( productive_forms_contact_how_to_display_contact_name_field() && productive_forms_contact_how_to_display_contact_name_field() === 'individual_fields' ) ) {
                    $columns['name']        = __( 'First Name', 'column name', 'productive-forms' );
                    $columns['last_name']   = __( 'Last Name', 'column name', 'productive-forms' );
                } else {
                    $columns['name']        = __( 'Name', 'column name', 'productive-forms' );
                }
                
                $columns['email']           = __( 'Email', 'column name', 'productive-forms' );    
                
		$columns['date']            = __( 'Date Sent', 'column name', 'productive-forms' ); 
                
                if ( productive_forms_contact_ask_for_visitor_phone() ) {
                    $columns['phone']           = __( 'Phone', 'column name', 'productive-forms' );
                }
                
                $columns['data_consent']           = __( 'Data Consented?', 'column name', 'productive-forms' );
		
		$columns['status']          = __( 'Status', 'column name', 'productive-forms' );      
                $columns['type']              = __( 'Submission Type', 'productive-forms' );  
                
		return $columns;
	}
        
        
	/**
	 * @return array
	 */
	protected function get_sortable_columns() {
            // Table name (in admin) => db field
            return array(
                'name' => ['name', true], 
                'email' => ['email', true], 
                'date' => ['date', true],
                'status' => ['status', true], 
            );
	}
        
        
        public function prepare_items() {
            
            $columns = $this->get_columns(); 
            $hidden = array();
            $sortable = $this->get_sortable_columns();
            $this->_column_headers = array($columns, $hidden, $sortable);
            
            // Check if there a bulk action to process
            $this->do_bulk_action_if_any();

            $per_page = 10;
            $current_page = $this->get_pagenum();
            $offset = ( $current_page - 1 ) * $per_page;
                        
            $submission_type = '';
            if ( $_REQUEST != null && isset($_REQUEST['subtab']) ) {
                if ( 'sub_section_contact' === $_REQUEST['subtab']) {
                    $submission_type = 'contact';
                } else if ( 'sub_section_newsletter' === $_REQUEST['subtab']) {
                    $submission_type = 'newsletter';
                }
            }
            
            $total_contact_items_count = $this->get_total_table_data_count($submission_type);
            
            $this->items = $this->get_table_data($offset, $per_page, $submission_type);
                                
            $total_pages = ceil( $total_contact_items_count / $per_page );
            $this->set_pagination_args(
                array(
                'total_pages' => $total_pages,
                'total_items'    => $total_contact_items_count,
                'per_page'    => $per_page,
                )
            );
        }
        
        
        function get_total_table_data_count($submission_type) {
            global $wpdb;
            $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
            $sql = 'SELECT id FROM ';
            $sql .= $table;
            if ( !empty($submission_type) ) {
                $sql .= ' WHERE type = "' . $submission_type.'"';
            }
            
            $wpdb->get_results( $sql );
            return $wpdb->num_rows;
        }
        
        function get_table_data($offset, $per_page, $submission_type) {
            global $wpdb;
            $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
            
            $order_by = 'id';
            $order_value = 'DESC';
            
            if( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) ) {
                $order_by = sanitize_text_field( $_REQUEST['orderby'] );
                $order_value = sanitize_text_field( $_REQUEST['order'] );
            }
            
            if ( empty($submission_type) ) {
                $sql = 'SELECT * FROM ';
                $sql .= $table;
                $sql .= ' ORDER BY %2s %3s ';
                $sql .= ' LIMIT %4s, %5s ';

                $result = $wpdb->get_results( $wpdb->prepare($sql, $order_by, $order_value, $offset, $per_page), ARRAY_A );
            } else {
                $sql = 'SELECT * FROM ';
                $sql .= $table;
                $sql .= ' WHERE type = "%1s" ';
                $sql .= ' ORDER BY %2s %3s ';
                $sql .= ' LIMIT %4s, %5s ';

                $result = $wpdb->get_results( $wpdb->prepare($sql, $submission_type, $order_by, $order_value, $offset, $per_page), ARRAY_A );
            }
            
            return $result;
        }
        
        
	/**
	 * Method display_the_table_content.
	 */
	public function display_the_table_content() {

		$this->prepare_items();

		echo '<div class="productive_forms_options_list_table">';
                    echo '<form method="post" id="productive_forms_options_list_table_form">';

                    $this->display();

                    echo '</form>';
		echo '</div>';
	}
        
        
        /**
	 * 
	 */
	public function column_cb( $item ) {
            if ( current_user_can( 'manage_options' ) ) {
                ?>
                    <label class="screen-reader-text" for="productive-form-list-table-cb-<?php echo esc_attr($item['id']); ?>"><?php echo esc_attr__( 'Select item', 'productive-forms' ); ?></label>
                    <input id="productive-form-list-table-cb-<?php echo esc_attr($item['id']); ?>" type="checkbox" name="productive-form-list-table-cb[]" value="<?php echo esc_attr($item['id']); ?>" />
                <?php
            }
	}
        
        
	/**
	 * Message to show when the database is empty 
	 */
	public function no_items() {
            echo __( 'No submission to display', 'productive-forms' );
	}
        
        
        public function column_default( $item, $column_name ) {
            switch ( $column_name ) {
			case 'name':
                            ?>
                                <a class="main-hyperlink" href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_view_item&id=<?php echo esc_attr( $item['id'] ); ?>">
                                    <?php echo esc_html( $item[$column_name] );  ?>
                                </a>
                                <div class="row-actions">
                                    <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_view_item&id=<?php echo esc_attr( $item['id'] ); ?>">
                                        <?php echo __( 'View', 'productive-forms' ); ?>
                                    </a>
                                    |
                                    <a href="mailto:<?php echo esc_attr( $item['email'] ); ?>">
                                        <?php echo __( 'Send', 'productive-forms' ); ?>
                                    </a>
                                    |
                                    <a href="#" class="productive-global-table-attr-delete-request" id="<?php echo esc_attr( $item['id'] ); ?>">
                                        <?php echo __( 'Delete', 'productive-forms' ); ?>
                                    </a>
                                    
                                    <div class="productive-global-table-attr-delete-confirmation noned">
                                        
                                        <div class="confirmation-heading"><?php esc_html_e( 'DELETE?', 'productive-forms' ); ?></div>
                                        
                                        <a href="#" class="productive-global-table-attr-delete-no" id="<?php echo esc_attr( $item['id'] ); ?>">
                                            <?php echo __( 'Cancel', 'productive-forms' ); ?>
                                        </a>
                                        |
                                        <a href="#" class="productive-global-table-attr-delete-yes" id="<?php echo esc_attr( $item['id'] ); ?>">
                                            <?php echo __( 'Yes, Delete', 'productive-forms' ); ?>
                                        </a>
                                        <div class="productive-global-table-attr-delete-error"></div>
                                    </div>
                                </div>
                            <?php
				break;

			case 'email':
				?>
                                <a href="?page=<?php echo PRODUCTIVE_FORMS_ADMIN_PAGE_REQUEST_URI; ?>&tab=section_view_item&id=<?php echo esc_attr( $item['id'] ); ?>">
                                    <?php echo esc_html( $item[$column_name] );  ?>
                                </a>
                                <?php
				break;

			case 'type':
				if ( 'contact' == $item[$column_name] ) {
                                    echo __( 'Contact Form', 'productive-forms' );
                                } else {
                                    echo __( 'Newsletter', 'productive-forms' );
                                }
				break;

			default:
				echo esc_attr( $item[$column_name] );
				break;
		}
	}
        
        
	/**
	 * @return array
	 */
	protected function get_bulk_actions() {
            $actions = array();
            $actions['new']      = __( 'Mark as New', 'productive-forms' );
            $actions['read']        = __( 'Mark as Read', 'productive-forms' );
            $actions['delete']      = __( 'Delete Permanently', 'productive-forms' );
            $actions['export']      = __( 'Export to CSV', 'productive-forms' );
            return $actions;
	}
        
        /**
	 * Process Bulk Actions - export, delete etc
	 */
	public function do_bulk_action_if_any() {
            $action   = $this->current_action();

            $message = '';
            if ( $_REQUEST != null && ( isset($_REQUEST['action']) || isset($_REQUEST['action2']) ) && isset( $_POST['productive-form-list-table-cb']) ) {
                $nonce_raw = sanitize_text_field( $_REQUEST['_wpnonce'] );
                $nonce = wp_unslash( $nonce_raw );
                // TODO, verify nonce

                if ( ! current_user_can( 'manage_options' ) ) {
                    wp_die( __( 'You do not have permission to access this resource.', 'productive-forms' ) );
                }
                
                $sanitized_post = sanitize_post( $_POST );
                $ids = $sanitized_post['productive-form-list-table-cb'];
                
                $action = sanitize_text_field( $_REQUEST['action'] );
                if ( 'read' === $action ) {
                    $message = $this->do_bulk_read( $ids );
                } else if ( 'new' === $action ) {
                    $message = $this->do_bulk_unread( $ids );
                } else if ( 'delete' === $action ) {
                    $message = $this->do_bulk_delete( $ids );
                } else if ( 'export' === $action ) {
                    $message = $this->do_bulk_export( $ids );
                }
                  
                if ( !empty( $message ) ) {
                    $_REQUEST['productive_forms_bulk_action_confirmation_message'] = $message;
                }
            }
            return $message;
	}
        
        
        /**
	 * Process Bulk Delete
	 */
	public function do_bulk_export( $ids ) {
            
            global $wpdb;
            $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
            $sanitized_ids = '(';
            $counter = 0;
            foreach ( $ids as $id ) {
                if ( 0 < $counter ) {
                    $sanitized_ids .= ',';
                }
                $sanitized_ids .= sanitize_key($id);
                $counter++;
            }
            $sanitized_ids .= ')';
            
            $export_object = $this->productive_forms_export_object();
            
            $column_headers = array();
            
            if ( productive_forms_contact_ask_for_visitor_phone() ) {
                $column_headers = $export_object->get_csv_column_headers_combined( true ); // Get header columns with combined name field, with Phone
                $export_sql = 'SELECT email, phone, name, date, data_consent FROM ' . $table . ' WHERE id IN %1s' ;
            } else {
                $column_headers = $export_object->get_csv_column_headers_combined( false ); // Get header columns with combined name field, WITHOUT Phone
                $export_sql = 'SELECT email, name, date, data_consent FROM ' . $table . ' WHERE id IN %1s' ;
            }
            
            if ( !empty( productive_forms_contact_how_to_display_contact_name_field() && productive_forms_contact_how_to_display_contact_name_field() === 'individual_fields' ) ) {
                
                if ( productive_forms_contact_ask_for_visitor_phone() ) {
                    $column_headers = $export_object->get_csv_column_headers( true ); // Get header columns with last name field, with Phone
                    $export_sql = 'SELECT email, phone, name, last_name, date, data_consent FROM ' . $table . ' WHERE id IN %1s' ;
                } else {
                    $column_headers = $export_object->get_csv_column_headers( false); // Get header columns with last name field, WITHOUT Phone
                    $export_sql = 'SELECT email, name, last_name, date, data_consent FROM ' . $table . ' WHERE id IN %1s' ;
                }
            }
            
            $results = $wpdb->get_results( $wpdb->prepare($export_sql, $sanitized_ids), ARRAY_A );
            
            $csv_file = $export_object->get_export_file( 'productive-form-export.csv' );
            
            $csv_file = $export_object->write_a_row( $csv_file, $column_headers );
            $csv_file = $export_object->write_rows( $csv_file, $results );
            
            fclose($csv_file);
            exit();
	}
        
        /**
	 * Process Bulk Mark as Read
	 */
	public function do_bulk_read( $ids ) {
            
            global $wpdb;
            $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
            
            $message = '' . count($ids) . __( ' items successful marked as Read', 'productive-forms' );
            $processed_items = 0;
            $un_processed_items = 0;
            foreach ( $ids as $id ) {
                $data = array(
                    'id' => sanitize_key($id),
                    'status' => __( 'Read', 'productive-forms' ),
                );
                $where = array( 'id' => $id );
                $result = $wpdb->update( $table, $data, $where );
                if ( $result || $result == 0 ) {
                    $processed_items += 1;
                } else {
                    $un_processed_items += 1;
                }
            }
                            
            if ( count($ids) != $processed_items ) {
                $message = '' . $un_processed_items . __( ' items could not be marked as Read', 'productive-forms' );
            }
            return $message;
	}
        
        
        /**
	 * Process Bulk Mark as Read
	 */
	public function do_bulk_unread( $ids ) {
            
            global $wpdb;
            $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
            
            $message = '' . count($ids) . __( ' items successful marked as New', 'productive-forms' );
            $processed_items = 0;
            $un_processed_items = 0;
            foreach ( $ids as $id ) {
                $data = array(
                    'id' => sanitize_key($id),
                    'status' => __( 'New', 'productive-forms' ),
                );
                $where = array( 'id' => $id );
                $result = $wpdb->update( $table, $data, $where );
                
                if ( $result || $result == 0 ) {
                    $processed_items += 1;
                } else {
                    $un_processed_items += 1;
                }
            }
            
            if ( count($ids) != $processed_items ) {
                $message = '' . $un_processed_items . __( ' items could not be marked as New', 'productive-forms' );
            }
            return $message;
	}
        
        /**
	 * Process Bulk Delete
	 */
	public function do_bulk_delete( $ids ) {
            
            global $wpdb;
            $table = $wpdb->prefix . PRODUCTIVE_FORMS_DATABASE_NAME;
            
            $message = '' . count($ids) . __( ' items successful deleted', 'productive-forms' );
            $processed_items = 0;
            $un_processed_items = 0;
            foreach ( $ids as $id ) {
                $where = array(
                    'id' => sanitize_key($id),
                );
                $where_format = array( '%d' );
                $result = $wpdb->delete( $table, $where, $where_format );
                
                if ( $result || $result == 0 ) {
                    $processed_items += 1;
                } else {
                    $un_processed_items += 1;
                }
            }
            
            if ( count($ids) != $processed_items ) {
                $message = '' . $un_processed_items . __( ' items could not be deleted', 'productive-forms' );
            }
            return $message;
	}
        
        /**
         * 
	 */
	protected function extra_tablenav( $which ) {
            if ( 'top' === $which ) {
                // Do nothing
            }
            
            if ( 'bottom' === $which ) {
                // Do nothing
            }
	}
        
        
        function productive_forms_export_object() {
            $export_object = new Productive_Forms_Export_CSV();
            return $export_object;
        }
        
        
    }
    
}