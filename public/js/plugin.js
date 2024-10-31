/**
 *
 * @package productive-forms
 */

function productive_forms_form_contact_submit_ajax_verify_form_data( action_btn ) {
    
    let form = action_btn.parentElement.parentElement;
    if( null === form || undefined === form ) {
        return new Array();
    }
        
    let how_to_display_contact_name_field_obj   = form.elements.namedItem("how_to_display_contact_name_field");
    let submission_verify_type_obj              = form.elements.namedItem("submission_verify_type");
    let is_consent_required_obj                 = form.elements.namedItem("is_consent_required");

    let name_obj                                = form.elements.namedItem("productive_forms_form_contact_name");
    let last_name_obj                           = form.elements.namedItem("productive_forms_form_contact_last_name");
    let email_obj                               = form.elements.namedItem("productive_forms_form_contact_email");
    let phone_obj                               = form.elements.namedItem("productive_forms_form_contact_phone");
    let message_obj                             = form.elements.namedItem("productive_forms_form_contact_message");
    let consent_obj                             = form.elements.namedItem("productive_forms_contact_consent_checkbox_text_contact");

    let verify_email_obj                        = form.elements.namedItem("email");
    let verify_maths_obj                        = form.elements.namedItem("productive_forms_form_contact_verify_maths");

    var form_submission_info_box_container      = form.nextElementSibling; /* I.e, .productiveminds_form_submission_info_box_container */
    let form_submission_info_box                = form_submission_info_box_container.querySelector( '.productiveminds_form_submission_info_box' );

    name_obj.classList.remove("outline-full-error");
    last_name_obj.classList.remove("outline-full-error");
    email_obj.classList.remove("outline-full-error");
    phone_obj.classList.remove("outline-full-error");
    message_obj.classList.remove("outline-full-error");
    if( undefined !== consent_obj && null !== consent_obj ) {
        consent_obj.classList.remove("outline-full-error");
    }
    verify_maths_obj.classList.remove("outline-full-error");

    form_submission_info_box.classList.remove("bordered-left-error", "bordered-left-success", "bordered-left-warning");
    form_submission_info_box_container.classList.add("noned");

    let how_to_display_contact_name_field   = how_to_display_contact_name_field_obj.value;
    let submission_verify_type              = submission_verify_type_obj.value;
    let is_consent_required                 = is_consent_required_obj.value;

    let name        = name_obj.value;
    let last_name   = last_name_obj.value;
    let email       = email_obj.value;
    let phone       = phone_obj.value;
    let message     = message_obj.value;
    let consent = '';
    if( undefined !== consent_obj && null !== consent_obj ) {
        if( consent_obj.checked ) {
            consent = 'checked';
        }
    }

    let verify_email        = verify_email_obj.value;
    let verify_maths        = verify_maths_obj.value;

    form_submission_info_box.innerHTML = "";
    let init_error_message = "";
    let error_message = init_error_message;

    if( "" === name || 2 > name.length ) {
        name_obj.classList.add("outline-full-error");
        if ( how_to_display_contact_name_field === 'individual_fields' ) {
            error_message += "" + productive_forms_js_url_handle_name.msg_error_add_first_name +"<br>";
        } else {
            error_message += "" + productive_forms_js_url_handle_name.msg_error_add_name +"<br>";
        }
    }
    if( "" === last_name && how_to_display_contact_name_field === 'individual_fields' ) {
        last_name_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_last_name +"<br>";
    }
    if( !productive_IsValidEmailAddress( email ) ) {
        email_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_email +"<br>";
    }
    if( undefined !== phone_obj && 'unused' !== phone && ( "" === phone || isNaN(phone) || 0 === parseInt(phone) || 8 > phone.length ) ) {
        phone_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_phone +"<br>";
    }
    if( "" === message || 5 > message.length ) {
        message_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_message +"<br>";
    }
    if( (undefined !== consent_obj && null !== consent_obj) && ('checked' !== consent && is_consent_required === '1') ) {
        consent_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_consent +"<br>";
    }
    if( (undefined !== verify_maths_obj && null !== verify_maths_obj) && ( ("" === verify_maths || isNaN(verify_maths) ) && 'maths_challenge' === submission_verify_type) ) {
        verify_maths_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_maths_challenge +"<br>";
    }

    if( init_error_message !== error_message ) {
        form_submission_info_box.classList.add("bordered-left-error");
        form_submission_info_box_container.classList.remove("noned");
        form_submission_info_box.innerHTML = error_message;
        return;
    }

    let array_of_info_objects = new Array();
    array_of_info_objects.push(form);
    array_of_info_objects.push(form_submission_info_box_container);
    array_of_info_objects.push(form_submission_info_box);

    let array_of_values = new Array();
    array_of_values.push(name);
    array_of_values.push(last_name);
    array_of_values.push(email);
    array_of_values.push(phone);
    array_of_values.push(message);
    array_of_values.push(consent);
    array_of_values.push(is_consent_required);
    array_of_values.push(verify_email);
    array_of_values.push(verify_maths);
    array_of_values.push(submission_verify_type);
    
    let form_elements_and_data = new Array();
    form_elements_and_data.push(array_of_info_objects);
    form_elements_and_data.push(array_of_values);
    
    return form_elements_and_data;
}
function productive_forms_form_contact_submit_ajax_process_valid_form( form_valid_items_array ) {
    
    array_of_info_objects = form_valid_items_array[0];
    array_of_values = form_valid_items_array[1];
    
    if( null === array_of_info_objects || !Array.isArray(array_of_info_objects) || 1 > array_of_info_objects.length ) {
        return;
    }
    if( null === array_of_values || !Array.isArray(array_of_values) || 1 > array_of_values.length ) {
        return;
    }
    
    let form                                    = array_of_info_objects[0];
    let form_submission_info_box_container      = array_of_info_objects[1];
    let form_submission_info_box                = array_of_info_objects[2];
    
    let name                        = array_of_values[0];
    let last_name                   = array_of_values[1];
    let email                       = array_of_values[2];
    let phone                       = array_of_values[3];
    let message                     = array_of_values[4];
    let consent                     = array_of_values[5];
    let is_consent_required         = array_of_values[6];
    let verify_email                = array_of_values[7];
    let verify_maths                = array_of_values[8];
    let submission_verify_type      = array_of_values[9];
    
    if( null === form || undefined === form ) {
        return;
    }
    if( null === email || undefined === email || '' === email ) {
        return;
    }
    
    let is_async    = true;
    let method      = "POST";
    let url         = productive_forms_js_url_handle_name.ajax_admin_url;
    
    let action      = "action=productive_forms_process_message_contact_ajax";
    let nonce       = "&nonce="+productive_forms_js_url_handle_name.nonce;
    
    let productive_forms_form_contact_name                          = '&productive_forms_form_contact_name='+name;
    let productive_forms_form_contact_last_name                     = '&productive_forms_form_contact_last_name='+last_name;
    let productive_forms_form_contact_email                         = '&productive_forms_form_contact_email='+email;
    let productive_forms_form_contact_phone                         = '&productive_forms_form_contact_phone='+phone;
    let productive_forms_form_contact_message                       = '&productive_forms_form_contact_message='+message;
    let productive_forms_contact_consent_checkbox_text_contact      = '&productive_forms_contact_consent_checkbox_text_contact='+consent;
    let form_type                                                   = '&form_type=c';
    let productive_forms_contact_is_consent_required                = '&productive_forms_contact_is_consent_required='+is_consent_required;
    let productive_forms_contact_verify_email                       = '&form_verify_email='+verify_email;
    let productive_forms_contact_verify_maths                       = '&form_verify_maths='+verify_maths;
    let productive_forms_contact_submission_verify_type             = '&form_submission_verify_type='+submission_verify_type;
    
    data = action+nonce+productive_forms_form_contact_name+productive_forms_form_contact_last_name+productive_forms_form_contact_email
            +productive_forms_form_contact_phone+productive_forms_form_contact_message+productive_forms_contact_consent_checkbox_text_contact
            +form_type+productive_forms_contact_is_consent_required+productive_forms_contact_verify_email
            +productive_forms_contact_verify_maths+productive_forms_contact_submission_verify_type;
    
    const productive_ajax = new XMLHttpRequest();
    productive_ajax.open(method, url, is_async);    
    productive_ajax.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
    productive_ajax.onreadystatechange = function () {
        if (productive_ajax.readyState === XMLHttpRequest.DONE && productive_ajax.status === 200) {
            let responseJSONObject = JSON.parse(productive_ajax.response);
            let response = responseJSONObject.data;
            
            if ( response.code === 1 ) {
                form_submission_info_box.classList.add('bordered-left-success');
                form_submission_info_box.innerHTML = ''+response.result;
                form_submission_info_box_container.classList.remove("noned");
                setTimeout( productive_forms_form_contact_submit_ajax_reset_form, 5000, array_of_info_objects );
            } else if ( response.code === 700 ) {
                form_submission_info_box.classList.add('bordered-left-error');
                form_submission_info_box.innerHTML = ''+response.result;
                form_submission_info_box_container.classList.remove("noned");
            } else if ( response.code === 701 ) {
                if( undefined !== form && null !== form ) {
                    let verify_maths_obj = form.elements.namedItem("productive_forms_form_contact_verify_maths");
                    verify_maths_obj.classList.add("outline-full-error");
                }
                form_submission_info_box.classList.add('bordered-left-error');
                form_submission_info_box.innerHTML = ''+response.result;
                form_submission_info_box_container.classList.remove("noned");
            } else {
                form_submission_info_box.classList.add('bordered-left-error');
                form_submission_info_box.innerHTML = ''+response.result;
                form_submission_info_box_container.classList.remove("noned");
            }
        }
    };
    productive_ajax.send( data );
}
function productive_forms_form_contact_submit_ajax_reset_form( array_of_info_objects ) {
    
    let form                                    = array_of_info_objects[0];
    let form_submission_info_box_container      = array_of_info_objects[1];
    let form_submission_info_box                = array_of_info_objects[2];
    
    if( undefined !== form && null !== form ) {
        let name_obj                                = form.elements.namedItem("productive_forms_form_contact_name");
        let last_name_obj                           = form.elements.namedItem("productive_forms_form_contact_last_name");
        let email_obj                               = form.elements.namedItem("productive_forms_form_contact_email");
        let phone_obj                               = form.elements.namedItem("productive_forms_form_contact_phone");
        let message_obj                             = form.elements.namedItem("productive_forms_form_contact_message");
        let consent_obj                             = form.elements.namedItem("productive_forms_contact_consent_checkbox_text_contact");        
        let verify_maths_obj                        = form.elements.namedItem("productive_forms_form_contact_verify_maths");

        if( undefined !== name_obj && null !== name_obj && '' !== name_obj.value ) {
            name_obj.value                 = '';
        }
        if( undefined !== last_name_obj && null !== last_name_obj && '' !== last_name_obj.value ) {
            last_name_obj.value                 = '';
        }
        if( undefined !== email_obj && null !== email_obj && '' !== email_obj.value ) {
            email_obj.value                 = '';
        }
        if( undefined !== phone_obj && null !== phone_obj && 'unused' !== phone_obj.value ) {
            phone_obj.value                     = '';
        }
        if( undefined !== message_obj && null !== message_obj && '' !== message_obj.value ) {
            message_obj.value                 = '';
        }
        if( undefined !== consent_obj && null !== consent_obj ) {
            consent_obj.checked                 = false;
        }
        if( undefined !== verify_maths_obj && null !== verify_maths_obj && 'unused' !== verify_maths_obj.value ) {
            verify_maths_obj.value                 = '';
        }
    }
    
    if( undefined !== form_submission_info_box && null !== form_submission_info_box ) {
        form_submission_info_box.classList.remove('bordered-left-success');
        form_submission_info_box.innerHTML = '';
    }
    
    if( undefined !== form_submission_info_box_container && null !== form_submission_info_box_container ) {
        form_submission_info_box_container.classList.add("noned");
    }
}


function productive_forms_form_newsletter_submit_ajax_verify_form_data( action_btn ) {
    
    let form = null;
    let form_orientation = action_btn.getAttribute('data-form_orientation');
    if( null !== form_orientation && 'landscape' === form_orientation ) {
        form = action_btn.parentElement.parentElement.parentElement.parentElement;
    } else {
        form = action_btn.parentElement.parentElement;
    }
    if( null === form || undefined === form ) {
        return new Array();
    }
    
    let how_to_display_newsletter_name_field_obj   = form.elements.namedItem("how_to_display_newsletter_name_field");
    let submission_verify_type_obj              = form.elements.namedItem("submission_verify_type");
    let is_consent_required_obj                 = form.elements.namedItem("is_consent_required");
    
    let name_obj                                = form.elements.namedItem("productive_forms_form_newsletter_name");
    let last_name_obj                           = form.elements.namedItem("productive_forms_form_newsletter_last_name");
    let email_obj                               = form.elements.namedItem("productive_forms_form_newsletter_email");
    let consent_obj                             = form.elements.namedItem("productive_forms_newsletter_consent_checkbox_text_newsletter");

    let verify_email_obj                        = form.elements.namedItem("email");
    let verify_maths_obj                        = form.elements.namedItem("productive_forms_form_newsletter_verify_maths");

    var form_submission_info_box_container      = form.nextElementSibling; /* I.e, .productiveminds_form_submission_info_box_container */
    let form_submission_info_box                = form_submission_info_box_container.querySelector( '.productiveminds_form_submission_info_box' );

    name_obj.classList.remove("outline-full-error");
    last_name_obj.classList.remove("outline-full-error");
    email_obj.classList.remove("outline-full-error");
    if( undefined !== consent_obj && null !== consent_obj ) {
        consent_obj.classList.remove("outline-full-error");
    }
    verify_maths_obj.classList.remove("outline-full-error");

    form_submission_info_box.classList.remove("bordered-left-error", "bordered-left-success", "bordered-left-warning");
    form_submission_info_box_container.classList.add("noned");

    let how_to_display_newsletter_name_field   = how_to_display_newsletter_name_field_obj.value;
    let submission_verify_type              = submission_verify_type_obj.value;
    let is_consent_required                 = is_consent_required_obj.value;

    let name        = name_obj.value;
    let last_name   = last_name_obj.value;
    let email       = email_obj.value;
    let consent = '';
    if( undefined !== consent_obj && null !== consent_obj ) {
        if( consent_obj.checked ) {
            consent = 'checked';
        }
    }

    let verify_email        = verify_email_obj.value;
    let verify_maths        = verify_maths_obj.value;

    form_submission_info_box.innerHTML = "";
    let init_error_message = "";
    let error_message = init_error_message;

    if( "unused" !== name && ("" === name || 2 > name.length) ) {
        name_obj.classList.add("outline-full-error");
        if ( how_to_display_newsletter_name_field === 'individual_fields' ) {
            error_message += "" + productive_forms_js_url_handle_name.msg_error_add_first_name +"<br>";
        } else {
            error_message += "" + productive_forms_js_url_handle_name.msg_error_add_name +"<br>";
        }
    }
    if( "" === last_name && how_to_display_newsletter_name_field === 'individual_fields' ) {
        last_name_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_last_name +"<br>";
    }
    if( !productive_IsValidEmailAddress( email ) ) {
        email_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_email +"<br>";
    }
    if( (undefined !== consent_obj && null !== consent_obj) && ('checked' !== consent && is_consent_required === '1') ) {
        consent_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_consent +"<br>";
    }
    if( (undefined !== verify_maths_obj && null !== verify_maths_obj) && ( ("" === verify_maths || isNaN(verify_maths) ) && 'maths_challenge' === submission_verify_type) ) {
        verify_maths_obj.classList.add("outline-full-error");
        error_message += "" + productive_forms_js_url_handle_name.msg_error_add_maths_challenge +"<br>";
    }

    if( init_error_message !== error_message ) {
        form_submission_info_box.classList.add("bordered-left-error");
        form_submission_info_box_container.classList.remove("noned");
        form_submission_info_box.innerHTML = error_message;
        return;
    }

    let array_of_info_objects = new Array();
    array_of_info_objects.push(form);
    array_of_info_objects.push(form_submission_info_box_container);
    array_of_info_objects.push(form_submission_info_box);

    let array_of_values = new Array();
    array_of_values.push(name);
    array_of_values.push(last_name);
    array_of_values.push(email);
    array_of_values.push(consent);
    array_of_values.push(is_consent_required);
    array_of_values.push(verify_email);
    array_of_values.push(verify_maths);
    array_of_values.push(submission_verify_type);
    
    let form_elements_and_data = new Array();
    form_elements_and_data.push(array_of_info_objects);
    form_elements_and_data.push(array_of_values);
    
    return form_elements_and_data;
}
function productive_forms_form_newsletter_submit_ajax_process_valid_form( form_valid_items_array ) {
    
    array_of_info_objects = form_valid_items_array[0];
    array_of_values = form_valid_items_array[1];
    
    if( null === array_of_info_objects || !Array.isArray(array_of_info_objects) || 1 > array_of_info_objects.length ) {
        return;
    }
    if( null === array_of_values || !Array.isArray(array_of_values) || 1 > array_of_values.length ) {
        return;
    }
    
    let form                                    = array_of_info_objects[0];
    let form_submission_info_box_container      = array_of_info_objects[1];
    let form_submission_info_box                = array_of_info_objects[2];
    
    let name                        = array_of_values[0];
    let last_name                   = array_of_values[1];
    let email                       = array_of_values[2];
    let consent                     = array_of_values[3];
    let is_consent_required         = array_of_values[4];
    let verify_email                = array_of_values[5];
    let verify_maths                = array_of_values[6];
    let submission_verify_type      = array_of_values[7];
    
    if( null === form || undefined === form ) {
        return;
    }
    if( null === email || undefined === email || '' === email ) {
        return;
    }
    
    let is_async    = true;
    let method      = "POST";
    let url         = productive_forms_js_url_handle_name.ajax_admin_url;
    
    let action      = "action=productive_forms_process_message_newsletter_ajax";
    let nonce       = "&nonce="+productive_forms_js_url_handle_name.nonce;
    
    let productive_forms_form_newsletter_name                               = '&productive_forms_form_newsletter_name='+name;
    let productive_forms_form_newsletter_last_name                          = '&productive_forms_form_newsletter_last_name='+last_name;
    let productive_forms_form_newsletter_email                              = '&productive_forms_form_newsletter_email='+email;
    let productive_forms_newsletter_consent_checkbox_text_newsletter        = '&productive_forms_newsletter_consent_checkbox_text_newsletter='+consent;
    let form_type                                                           = '&form_type=n';
    let productive_forms_newsletter_is_consent_required                     = '&productive_forms_newsletter_is_consent_required='+is_consent_required;
    let productive_forms_newsletter_verify_email                            = '&form_verify_email='+verify_email;
    let productive_forms_newsletter_verify_maths                            = '&form_verify_maths='+verify_maths;
    let productive_forms_newsletter_submission_verify_type                  = '&form_submission_verify_type='+submission_verify_type;
    
    data = action+nonce+productive_forms_form_newsletter_name+productive_forms_form_newsletter_last_name+productive_forms_form_newsletter_email
            +productive_forms_newsletter_consent_checkbox_text_newsletter
            +form_type+productive_forms_newsletter_is_consent_required+productive_forms_newsletter_verify_email
            +productive_forms_newsletter_verify_maths+productive_forms_newsletter_submission_verify_type;
    
    const productive_ajax = new XMLHttpRequest();
    productive_ajax.open(method, url, is_async);    
    productive_ajax.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
    productive_ajax.onreadystatechange = function () {
        if (productive_ajax.readyState === XMLHttpRequest.DONE && productive_ajax.status === 200) {
            let responseJSONObject = JSON.parse(productive_ajax.response);
            let response = responseJSONObject.data;
            
            if ( response.code === 1 ) {
                form_submission_info_box.classList.add('bordered-left-success');
                form_submission_info_box.innerHTML = ''+response.result;
                form_submission_info_box_container.classList.remove("noned");
                setTimeout( productive_forms_form_newsletter_submit_ajax_reset_form, 5000, array_of_info_objects );
            } else if ( response.code === 700 ) {
                form_submission_info_box.classList.add('bordered-left-error');
                form_submission_info_box.innerHTML = ''+response.result;
                form_submission_info_box_container.classList.remove("noned");
            } else if ( response.code === 701 ) {
                if( undefined !== form && null !== form ) {
                    let verify_maths_obj = form.elements.namedItem("productive_forms_form_newsletter_verify_maths");
                    verify_maths_obj.classList.add("outline-full-error");
                }
                form_submission_info_box.classList.add('bordered-left-error');
                form_submission_info_box.innerHTML = ''+response.result;
                form_submission_info_box_container.classList.remove("noned");
            } else {
                form_submission_info_box.classList.add('bordered-left-error');
                form_submission_info_box.innerHTML = ''+response.result;
                form_submission_info_box_container.classList.remove("noned");
            }
        }
    };
    productive_ajax.send( data );
}
function productive_forms_form_newsletter_submit_ajax_reset_form( array_of_info_objects ) {
    
    let form                                    = array_of_info_objects[0];
    let form_submission_info_box_container      = array_of_info_objects[1];
    let form_submission_info_box                = array_of_info_objects[2];
    
    if( undefined !== form && null !== form ) {
        let name_obj                                = form.elements.namedItem("productive_forms_form_newsletter_name");
        let last_name_obj                           = form.elements.namedItem("productive_forms_form_newsletter_last_name");
        let email_obj                               = form.elements.namedItem("productive_forms_form_newsletter_email");
        let consent_obj                             = form.elements.namedItem("productive_forms_newsletter_consent_checkbox_text_newsletter");        
        let verify_maths_obj                        = form.elements.namedItem("productive_forms_form_newsletter_verify_maths");

        if( (undefined !== name_obj && null !== name_obj && '' !== name_obj.value) && 'unused' !== name_obj.value ) {
            name_obj.value                 = '';
        }
        if( undefined !== last_name_obj && null !== last_name_obj && '' !== last_name_obj.value ) {
            last_name_obj.value                 = '';
        }
        if( undefined !== email_obj && null !== email_obj && '' !== email_obj.value ) {
            email_obj.value                 = '';
        }
        if( undefined !== consent_obj && null !== consent_obj ) {
            consent_obj.checked                 = false;
        }
        if( undefined !== verify_maths_obj && null !== verify_maths_obj && 'unused' !== verify_maths_obj.value ) {
            verify_maths_obj.value                 = '';
        }
    }
    
    if( undefined !== form_submission_info_box && null !== form_submission_info_box ) {
        form_submission_info_box.classList.remove('bordered-left-success');
        form_submission_info_box.innerHTML = '';
    }
    
    if( undefined !== form_submission_info_box_container && null !== form_submission_info_box_container ) {
        form_submission_info_box_container.classList.add("noned");
    }
}


function productive_forms_execute_plugin_std_scripts() {
    
    const productive_forms_form_contact_submit_ajaxs_with_g_recaptcha_v3s = document.querySelectorAll(".productive_forms_form_contact_submit_ajax.g_recaptcha_v3.contact");
    for (i = 0; i < productive_forms_form_contact_submit_ajaxs_with_g_recaptcha_v3s.length; i++) {
        let productive_forms_form_contact_submit_ajaxs_with_g_recaptcha_v3 = productive_forms_form_contact_submit_ajaxs_with_g_recaptcha_v3s[i];
        productive_forms_form_contact_submit_ajaxs_with_g_recaptcha_v3.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
            const form_valid_items_array = productive_forms_form_contact_submit_ajax_verify_form_data( this );
            if( null === form_valid_items_array || !Array.isArray(form_valid_items_array) || 1 > form_valid_items_array.length ) {
                return;
            }
            
            let productive_forms_form_contact_submit_ajaxs_with_g_recaptcha_v3_name = this.getAttribute('name');
            grecaptcha.ready(function() {
                    grecaptcha.execute(productive_forms_js_url_handle_name.msg_recaptcha_site_key, {action: productive_forms_form_contact_submit_ajaxs_with_g_recaptcha_v3_name}).then(function(token) {
                        
                        let g_recaptcha_v3_t        = token;
                        let g_recaptcha_v3_action   = productive_forms_form_contact_submit_ajaxs_with_g_recaptcha_v3_name;
                        
                        let is_async    = true;
                        let method      = "POST";
                        let url         = productive_forms_js_url_handle_name.ajax_admin_url;

                        let action      = "action=productive_forms_process_g_recaptcha_v3_verify_ajax";
                        let nonce       = "&nonce="+productive_forms_js_url_handle_name.nonce;
                        
                        let form_g_recaptcha_v3_t               = '&form_g_recaptcha_v3_t='+g_recaptcha_v3_t;
                        let form_g_recaptcha_v3_action          = '&form_g_recaptcha_v3_action='+g_recaptcha_v3_action;

                        data = action+nonce+form_g_recaptcha_v3_t+form_g_recaptcha_v3_action;

                        const productive_ajax = new XMLHttpRequest();
                        productive_ajax.open(method, url, is_async);    
                        productive_ajax.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
                        productive_ajax.onreadystatechange = function () {
                            if (productive_ajax.readyState === XMLHttpRequest.DONE && productive_ajax.status === 200) {
                                let responseJSONObject = JSON.parse(productive_ajax.response);
                                let response = responseJSONObject.data;
                                
                                if ( response.code === 1 ) {
                                    productive_forms_form_contact_submit_ajax_process_valid_form( form_valid_items_array );
                                } else {
                                    array_of_info_objects = form_valid_items_array[0];
                                    if( null !== array_of_info_objects && Array.isArray(array_of_info_objects) && 0 < array_of_info_objects.length ) {
                                        let form                                    = array_of_info_objects[0];
                                        let form_submission_info_box_container      = array_of_info_objects[1];
                                        let form_submission_info_box                = array_of_info_objects[2];

                                        if( undefined !== form && null !== form ) {
                                            let verify_maths_obj = form.elements.namedItem("productive_forms_form_contact_verify_maths");
                                            verify_maths_obj.classList.add("outline-full-error");
                                        }
                                        form_submission_info_box.classList.add('bordered-left-error');
                                        form_submission_info_box.innerHTML = ''+response.result;
                                        form_submission_info_box_container.classList.remove("noned");
                                    }
                                }
                            }
                        };
                        productive_ajax.send( data );
                });
            });
            
        });
    }
    const productive_forms_form_contact_submit_ajaxs = document.querySelectorAll(".productive_forms_form_contact_submit_ajax.std.contact");
    for (i = 0; i < productive_forms_form_contact_submit_ajaxs.length; i++) {
        let productive_forms_form_contact_submit_ajax = productive_forms_form_contact_submit_ajaxs[i];
        productive_forms_form_contact_submit_ajax.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
            const form_valid_items_array = productive_forms_form_contact_submit_ajax_verify_form_data( this );
            if( null === form_valid_items_array || !Array.isArray(form_valid_items_array) || 1 > form_valid_items_array.length ) {
                return;
            }
            productive_forms_form_contact_submit_ajax_process_valid_form( form_valid_items_array );
        });
    }
    
    
    const productive_forms_form_newsletter_submit_ajaxs_with_g_recaptcha_v3s = document.querySelectorAll(".productive_forms_form_newsletter_submit_ajax.g_recaptcha_v3.newsletter");
    for (i = 0; i < productive_forms_form_newsletter_submit_ajaxs_with_g_recaptcha_v3s.length; i++) {
        let productive_forms_form_newsletter_submit_ajaxs_with_g_recaptcha_v3 = productive_forms_form_newsletter_submit_ajaxs_with_g_recaptcha_v3s[i];
        productive_forms_form_newsletter_submit_ajaxs_with_g_recaptcha_v3.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
            const form_valid_items_array = productive_forms_form_newsletter_submit_ajax_verify_form_data( this );
            if( null === form_valid_items_array || !Array.isArray(form_valid_items_array) || 1 > form_valid_items_array.length ) {
                return;
            }
            
            let productive_forms_form_newsletter_submit_ajaxs_with_g_recaptcha_v3_name = this.getAttribute('name');
            grecaptcha.ready(function() {
                    grecaptcha.execute(productive_forms_js_url_handle_name.msg_recaptcha_site_key, {action: productive_forms_form_newsletter_submit_ajaxs_with_g_recaptcha_v3_name}).then(function(token) {
                        
                        let g_recaptcha_v3_t        = token;
                        let g_recaptcha_v3_action   = productive_forms_form_newsletter_submit_ajaxs_with_g_recaptcha_v3_name;
                        
                        let is_async    = true;
                        let method      = "POST";
                        let url         = productive_forms_js_url_handle_name.ajax_admin_url;

                        let action      = "action=productive_forms_process_g_recaptcha_v3_verify_ajax";
                        let nonce       = "&nonce="+productive_forms_js_url_handle_name.nonce;
                        
                        let form_g_recaptcha_v3_t               = '&form_g_recaptcha_v3_t='+g_recaptcha_v3_t;
                        let form_g_recaptcha_v3_action          = '&form_g_recaptcha_v3_action='+g_recaptcha_v3_action;

                        data = action+nonce+form_g_recaptcha_v3_t+form_g_recaptcha_v3_action;

                        const productive_ajax = new XMLHttpRequest();
                        productive_ajax.open(method, url, is_async);    
                        productive_ajax.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
                        productive_ajax.onreadystatechange = function () {
                            if (productive_ajax.readyState === XMLHttpRequest.DONE && productive_ajax.status === 200) {
                                let responseJSONObject = JSON.parse(productive_ajax.response);
                                let response = responseJSONObject.data;
                                
                                if ( response.code === 1 ) {
                                    productive_forms_form_newsletter_submit_ajax_process_valid_form( form_valid_items_array );
                                } else {
                                    array_of_info_objects = form_valid_items_array[0];
                                    if( null !== array_of_info_objects && Array.isArray(array_of_info_objects) && 0 < array_of_info_objects.length ) {
                                        let form                                    = array_of_info_objects[0];
                                        let form_submission_info_box_container      = array_of_info_objects[1];
                                        let form_submission_info_box                = array_of_info_objects[2];

                                        if( undefined !== form && null !== form ) {
                                            let verify_maths_obj = form.elements.namedItem("productive_forms_form_newsletter_verify_maths");
                                            verify_maths_obj.classList.add("outline-full-error");
                                        }
                                        form_submission_info_box.classList.add('bordered-left-error');
                                        form_submission_info_box.innerHTML = ''+response.result;
                                        form_submission_info_box_container.classList.remove("noned");
                                    }
                                }
                            }
                        };
                        productive_ajax.send( data );
                });
            });
            
        });
    }
    const productive_forms_form_newsletter_submit_ajaxs = document.querySelectorAll(".productive_forms_form_newsletter_submit_ajax.std.newsletter");
    for (i = 0; i < productive_forms_form_newsletter_submit_ajaxs.length; i++) {
        let productive_forms_form_newsletter_submit_ajax = productive_forms_form_newsletter_submit_ajaxs[i];
        productive_forms_form_newsletter_submit_ajax.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            
            const form_valid_items_array = productive_forms_form_newsletter_submit_ajax_verify_form_data( this );
            if( null === form_valid_items_array || !Array.isArray(form_valid_items_array) || 1 > form_valid_items_array.length ) {
                return;
            }
            productive_forms_form_newsletter_submit_ajax_process_valid_form( form_valid_items_array );
        });
    }
}
document.addEventListener( 'DOMContentLoaded', productive_forms_execute_plugin_std_scripts() );

