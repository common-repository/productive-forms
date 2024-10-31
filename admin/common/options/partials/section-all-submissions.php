<?php
/**
 *
 * @package productive-forms
 */

function productive_forms_message_list() {
    $contact_message_table = new Productive_Forms_And_Forms_List_Messages();
    $contact_message_table->display_the_table_content();
}
