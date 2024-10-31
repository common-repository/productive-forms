<?php
/**
 *
 * @package productive-forms
 */

if ( !defined('ABSPATH') ) {
	die();
}

if ( ! class_exists( 'Productive_Forms_Export_CSV' ) ) {

    /**
     * Productive_Forms_Export_CSV
     */
    class Productive_Forms_Export_CSV {
        
        public function get_csv_header( $data = array() ) {
            
        }
        
        public function get_csv_column_headers( $is_phone ) {
            
            $column_headers = array();
            $column_headers[] = 'Email';
            if ( $is_phone ) {
                $column_headers[] = 'Phone';
            }
            $column_headers[] = 'First Name';
            $column_headers[] = 'Last Name';
            $column_headers[] = 'Date Submitted';
            $column_headers[] = 'Consent Given';
            
            return $column_headers;
        }
        
        public function get_csv_column_headers_combined( $is_phone ) {
            
            $column_headers = array();
            $column_headers[] = 'Email';
            if ( $is_phone ) {
                $column_headers[] = 'Phone';
            }
            $column_headers[] = 'Name';
            $column_headers[] = 'Date Submitted';
            $column_headers[] = 'Consent Given';
            
            return $column_headers;
        }
        
        public function write_a_row( $csv_file, $data_row ) {
            fputcsv($csv_file, $data_row);
            return $csv_file;
        }
        
        public function write_rows( $csv_file, $data_rows ) {
            foreach ($data_rows as $data_row) {
              fputcsv($csv_file, $data_row);
            }
            return $csv_file;
        }
        
        public function get_export_file( $file_name ) {
            
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Pragma: no-cache');
            header('Expires: 0');
            
            ob_end_clean();
            
            $csv_file = fopen('php://output', 'w');
            
            return $csv_file;
        }
        
    }
    
}