<?php
/**
 *
 * @package productive-forms
 */

function productive_forms_message_view( $id ) {
    $items = productive_forms_process_contact_get_item($id);
    ?>
    <div class="productive-global-item-container">

        <div class="clear_min"></div>

        <div class="item-box">
            <div class="productiveminds_double_grid column_70_30">
                <div class="productiveminds_double_grid_content">

                    <h2>
                        <?php 
                            if ( !empty( productive_forms_contact_how_to_display_contact_name_field() && productive_forms_contact_how_to_display_contact_name_field() === 'individual_fields' ) ) {
                                echo esc_html__( 'Submitted by: ', 'productive-forms' ); ?><?php echo esc_html( $items['name'] ) . ' ' . esc_html( $items['last_name'] );
                            } else {
                                echo esc_html__( 'Submitted by: ', 'productive-forms' ); ?><?php echo esc_html( $items['name'] );
                            }
                        ?>
                    </h2>

                    <div class="item-sub-heading"><?php echo esc_html__( 'Date: ', 'productive-forms' ); ?><?php echo esc_html( $items['date'] ); ?></div>
                    <div class="item-sub-heading"><?php echo esc_html__( 'Email: ', 'productive-forms' ); ?><?php echo esc_html( $items['email'] ); ?></div>

                    <?php if ( !empty( $items['phone'] ) ) { ?>
                    <div class="item-sub-heading"><?php echo esc_html__( 'Phone: ', 'productive-forms' ); ?><?php echo esc_html( $items['phone'] ); ?></div>
                    <?php } ?>

                    <div class="item-body">
                        <?php echo esc_html( $items['content'] ); ?> 
                    </div>

                    <div class="item-extras"><?php echo esc_html__( 'Data Consent Agreed?: ', 'productive-forms' ); ?><?php echo esc_html( $items['data_consent'] ); ?> </div>
                    <div class="item-extras"><?php echo esc_html__( 'Message Source: ', 'productive-forms' ); ?><?php echo esc_html( $items['source'] ); ?> </div>
                    <div class="item-extras"><?php echo esc_html__( 'Message Type: ', 'productive-forms' ); ?><?php echo esc_html( $items['type'] ); ?> </div>
                </div>
                <div class="productiveminds_double_grid_content">
                    
                </div>
            </div>
        </div>
        <div class="clear_min"></div>
    </div>
<?php
    productive_forms_process_contact_set_item_as_read($id);
}

