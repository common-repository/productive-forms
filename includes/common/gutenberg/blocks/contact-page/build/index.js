(()=>{"use strict";var e,t={882:(e,t,o)=>{const l=window.React,a=window.wp.blocks,i=window.wp.serverSideRender;var n=o.n(i);const r=window.wp.blockEditor,_=window.wp.i18n,c=JSON.parse('{"UU":"productive-forms/contact-page"}'),s=(window.wp.data,window.wp.components),d=(0,l.createElement)("svg",{width:"24",height:"24",viewBox:"0 0 1792 1792",xmlns:"http://www.w3.org/2000/svg"},(0,l.createElement)("path",{d:"M896 352q-148 0-273 73t-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273-73-273-198-198-273-73zm768 544q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"}));(0,a.registerBlockType)(c.UU,{icon:d,edit:function({attributes:e,setAttributes:t}){const{is_formonly:o,productive_forms_form_submit_text:a,productive_forms_contact_side:i,display_contact_form_label:c,contact_how_to_display_contact_name_field:d,contact_ask_for_visitor_phone:u,request_data_privacy_consent:p,submission_verify_type:m,section_title:v,section_title_html_tag:h,section_intro:b,section_header_alignment:g,display_contact_email_address:f,display_contact_phone_number:C,display_contact_whatsapp_number:w,display_contact_location:y,display_contact_opening_hours:x,display_contact_social_media_icons:E,display_contact_social_media_icons_title:k,display_contact_social_media_icons_style:M,section_block_max_width:T,section_block_spacing:S,section_content_show_url_button_shape:B,section_content_show_url_button_width:N,section_bg_color_scheme:W}=e;return(0,l.createElement)(l.Fragment,null,(0,l.createElement)(r.InspectorControls,null,(0,l.createElement)(s.PanelBody,{title:(0,_.__)("Format (Layout)","productive-forms")},(0,l.createElement)(s.ToggleControl,{checked:!!o,label:(0,_.__)("Contact Us Form Only?","productive-forms"),onChange:()=>t({is_formonly:!o})}),(0,l.createElement)(s.TextControl,{label:(0,_.__)("Submit Button Text","productive-forms"),value:a||"",onChange:e=>t({productive_forms_form_submit_text:e})}),!o&&(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Form Position","productive-forms"),labelPosition:"top",value:i,options:[{label:(0,_.__)("Left Side","productive-forms"),value:"contact_form_on_left"},{label:(0,_.__)("Right Side","productive-forms"),value:"contact_form_on_right"}],onChange:e=>t({productive_forms_contact_side:e}),__nextHasNoMarginBottom:!0})),(0,l.createElement)(s.PanelBody,{title:(0,_.__)("Form Fields","productive-forms")},(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Name Field Option","productive-forms"),labelPosition:"top",value:d,options:[{label:(0,_.__)("Combined Name Field","productive-forms"),value:"combined_field"},{label:(0,_.__)("First and Last Name Fields","productive-forms"),value:"individual_fields"}],onChange:e=>t({contact_how_to_display_contact_name_field:e}),__nextHasNoMarginBottom:!0}),(0,l.createElement)(s.ToggleControl,{checked:!!u,label:(0,_.__)("Ask for Phone Number?","productive-forms"),onChange:()=>t({contact_ask_for_visitor_phone:!u})}),(0,l.createElement)(s.ToggleControl,{checked:!!p,label:(0,_.__)("Ask for data privacy consent?","productive-forms"),onChange:()=>t({request_data_privacy_consent:!p})}),(0,l.createElement)(s.ToggleControl,{checked:!!c,label:(0,_.__)("Display Form Labels","productive-forms"),onChange:()=>t({display_contact_form_label:!c})}),(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Spam Protection","productive-forms"),labelPosition:"top",value:m,options:[{label:(0,_.__)("Discreet Verification","productive-forms"),value:"discreet"},{label:(0,_.__)("Simple Maths Challenge","productive-forms"),value:"maths_challenge"},{label:(0,_.__)("Google Recaptcha V3","productive-forms"),value:"productive_g_recaptcha_v3"}],onChange:e=>t({submission_verify_type:e}),__nextHasNoMarginBottom:!0})),(0,l.createElement)(s.PanelBody,{title:(0,_.__)("Header","productive-forms")},(0,l.createElement)(s.TextControl,{label:(0,_.__)("Title","productive-forms"),value:v||"",onChange:e=>t({section_title:e})}),v&&(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Title html Tag","productive-forms"),labelPosition:"top",value:h,options:[{label:(0,_.__)("h1 html tag","productive-forms"),value:"h1"},{label:(0,_.__)("h2 html tag","productive-forms"),value:"h2"},{label:(0,_.__)("h3 html tag","productive-forms"),value:"h3"},{label:(0,_.__)("h4 html tag","productive-forms"),value:"h4"},{label:(0,_.__)("h5 html tag","productive-forms"),value:"h5"},{label:(0,_.__)("h6 html tag","productive-forms"),value:"h6"},{label:(0,_.__)("div html tag","productive-forms"),value:"div"},{label:(0,_.__)("span html tag","productive-forms"),value:"span"}],onChange:e=>t({section_title_html_tag:e}),__nextHasNoMarginBottom:!0}),(0,l.createElement)(s.TextControl,{label:(0,_.__)("Description","productive-forms"),value:b||"",onChange:e=>t({section_intro:e})}),(v||b)&&(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Header Alignment","productive-forms"),labelPosition:"top",value:g,options:[{label:(0,_.__)("None","productive-forms"),value:"none"},{label:(0,_.__)("Center","productive-forms"),value:"centered"},{label:(0,_.__)("Left","productive-forms"),value:"lefted"},{label:(0,_.__)("Right","productive-forms"),value:"righted"},{label:(0,_.__)("Justify","productive-forms"),value:"justified"}],onChange:e=>t({section_header_alignment:e}),__nextHasNoMarginBottom:!0})),(0,l.createElement)(s.PanelBody,{title:(0,_.__)("Content","productive-forms")},!o&&(0,l.createElement)(s.ToggleControl,{checked:!!f,label:(0,_.__)("Display Email Address?","productive-forms"),onChange:()=>t({display_contact_email_address:!f})}),!o&&(0,l.createElement)(s.ToggleControl,{checked:!!C,label:(0,_.__)("Display Phone Number?","productive-forms"),onChange:()=>t({display_contact_phone_number:!C})}),!o&&(0,l.createElement)(s.ToggleControl,{checked:!!w,label:(0,_.__)("Display WhatsApp Number?","productive-forms"),onChange:()=>t({display_contact_whatsapp_number:!w})}),!o&&(0,l.createElement)(s.ToggleControl,{checked:!!y,label:(0,_.__)("Display Physical Address?","productive-forms"),onChange:()=>t({display_contact_location:!y})}),!o&&(0,l.createElement)(s.ToggleControl,{checked:!!x,label:(0,_.__)("Display Opening Hours?","productive-forms"),onChange:()=>t({display_contact_opening_hours:!x})}),!o&&(0,l.createElement)(s.ToggleControl,{checked:!!E,label:(0,_.__)("Display Social Media Icons?","productive-forms"),onChange:()=>t({display_contact_social_media_icons:!E})}),E&&(0,l.createElement)(s.TextControl,{label:(0,_.__)("Social Media Icons Heading","productive-forms"),value:k||"",onChange:e=>t({display_contact_social_media_icons_title:e})}),E&&(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Social Media Icons Style","productive-forms"),labelPosition:"top",value:M,options:[{label:(0,_.__)("Official brand color background with white icon","productive-forms"),value:"brand_color_around_white_icon"},{label:(0,_.__)("Official brand color as icon colour","productive-forms"),value:"brand_color_as_icon_color"},{label:(0,_.__)("Selected color","productive-forms"),value:"selected_color_as_icon_color"}],onChange:e=>t({display_contact_social_media_icons_style:e}),__nextHasNoMarginBottom:!0})),(0,l.createElement)(s.PanelBody,{title:(0,_.__)("Others","productive-forms")},(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Link Button Shape","productive-forms"),labelPosition:"top",value:B,options:[{label:(0,_.__)("Default","productive-forms"),value:"shapeable-content-button-default"},{label:(0,_.__)("Sharp Corner","productive-forms"),value:"shapeable-content-button-sharp-corner"},{label:(0,_.__)("Rounded Corner","productive-forms"),value:"shapeable-content-button-rounded-corner"},{label:(0,_.__)("Ellipse","productive-forms"),value:"shapeable-content-button-ellipsed"}],onChange:e=>t({section_content_show_url_button_shape:e}),__nextHasNoMarginBottom:!0}),(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Button Width","productive-forms"),labelPosition:"top",value:N,options:[{label:(0,_.__)("Wrap Around Text","productive-forms"),value:"button-width-auto"},{label:(0,_.__)("Full Width","productive-forms"),value:"button-width-100pc"}],onChange:e=>t({section_content_show_url_button_width:e}),__nextHasNoMarginBottom:!0}),(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Block Size (Width)","productive-forms"),labelPosition:"top",value:T,options:[{label:(0,_.__)("Default","productive-forms"),value:"siteMaxWidth_Std"},{label:(0,_.__)("Narrow","productive-forms"),value:"siteMaxWidth_Narrow"},{label:(0,_.__)("Narrow, Align Left","productive-forms"),value:"siteMaxWidth_Narrow_Align_Left"},{label:(0,_.__)("Narrow, Align Right","productive-forms"),value:"siteMaxWidth_Narrow_Align_Right"},{label:(0,_.__)("Thin","productive-forms"),value:"siteMaxWidth_Thin"},{label:(0,_.__)("Thin, Align Left","productive-forms"),value:"siteMaxWidth_Thin_Align_Left"},{label:(0,_.__)("Thin, Align Right","productive-forms"),value:"siteMaxWidth_Thin_Align_Right"},{label:(0,_.__)("Extra Thin","productive-forms"),value:"siteMaxWidth_Mini"},{label:(0,_.__)("Extra Thin, Align Left","productive-forms"),value:"siteMaxWidth_Mini_Align_Left"},{label:(0,_.__)("Extra Thin, Align Right","productive-forms"),value:"siteMaxWidth_Mini_Align_Right"},{label:(0,_.__)("Micro Thin","productive-forms"),value:"siteMaxWidth_Micro"},{label:(0,_.__)("Micro Thin, Align Left","productive-forms"),value:"siteMaxWidth_Micro_Align_Left"},{label:(0,_.__)("Micro Thin, Align Right","productive-forms"),value:"siteMaxWidth_Micro_Align_Right"},{label:(0,_.__)("Wide","productive-forms"),value:"siteMaxWidth_Wide"},{label:(0,_.__)("Full Width (with padding)","productive-forms"),value:"siteMaxWidth_Extended"},{label:(0,_.__)("Full Width (100%)","productive-forms"),value:"siteMaxWidth_100pc"}],onChange:e=>t({section_block_max_width:e}),__nextHasNoMarginBottom:!0}),(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Block Spacing","productive-forms"),labelPosition:"top",value:S,options:[{label:(0,_.__)("No Spacing","productive-forms"),value:"section_spacing_none"},{label:(0,_.__)("Default","productive-forms"),value:"section_spacing_default"},{label:(0,_.__)("Small","productive-forms"),value:"section_spacing_small"},{label:(0,_.__)("Large","productive-forms"),value:"section_spacing_large"}],onChange:e=>t({section_block_spacing:e}),__nextHasNoMarginBottom:!0}),(0,l.createElement)(s.SelectControl,{label:(0,_.__)("Component Background Color Scheme","productive-forms"),labelPosition:"top",value:W,options:[{label:(0,_.__)("None","productive-forms"),value:"section_with_no_bg"},{label:(0,_.__)("Light Background","productive-forms"),value:"section_with_light_bg"},{label:(0,_.__)("Dark Background","productive-forms"),value:"section_with_dark_bg"},{label:(0,_.__)("Light Background, Dark Content","productive-forms"),value:"section_with_light_bg_dark_content"},{label:(0,_.__)("Dark Background, Light Content","productive-forms"),value:"section_with_dark_bg_light_content"},{label:(0,_.__)("Theme Color Scheme","productive-forms"),value:"section_with_themed_bg"}],onChange:e=>t({section_bg_color_scheme:e}),__nextHasNoMarginBottom:!0}))),(0,l.createElement)("div",{...(0,r.useBlockProps)()},(0,l.createElement)(n(),{block:"productive-forms/contact-page",attributes:e})))},save:function(){return null}})}},o={};function l(e){var a=o[e];if(void 0!==a)return a.exports;var i=o[e]={exports:{}};return t[e](i,i.exports,l),i.exports}l.m=t,e=[],l.O=(t,o,a,i)=>{if(!o){var n=1/0;for(s=0;s<e.length;s++){for(var[o,a,i]=e[s],r=!0,_=0;_<o.length;_++)(!1&i||n>=i)&&Object.keys(l.O).every((e=>l.O[e](o[_])))?o.splice(_--,1):(r=!1,i<n&&(n=i));if(r){e.splice(s--,1);var c=a();void 0!==c&&(t=c)}}return t}i=i||0;for(var s=e.length;s>0&&e[s-1][2]>i;s--)e[s]=e[s-1];e[s]=[o,a,i]},l.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return l.d(t,{a:t}),t},l.d=(e,t)=>{for(var o in t)l.o(t,o)&&!l.o(e,o)&&Object.defineProperty(e,o,{enumerable:!0,get:t[o]})},l.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={57:0,350:0};l.O.j=t=>0===e[t];var t=(t,o)=>{var a,i,[n,r,_]=o,c=0;if(n.some((t=>0!==e[t]))){for(a in r)l.o(r,a)&&(l.m[a]=r[a]);if(_)var s=_(l)}for(t&&t(o);c<n.length;c++)i=n[c],l.o(e,i)&&e[i]&&e[i][0](),e[i]=0;return l.O(s)},o=globalThis.webpackChunkcontact_page=globalThis.webpackChunkcontact_page||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})();var a=l.O(void 0,[350],(()=>l(882)));a=l.O(a)})();