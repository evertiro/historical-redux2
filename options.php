<?php
/*
 *
 * Set the text domain for the theme or plugin.
 *
 */
define('Redux_TEXT_DOMAIN', 'redux-opts');

/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */
//define('Redux_OPTIONS_URL', site_url('path the options folder'));
if(!class_exists('Redux_Options')){
    require_once(dirname(__FILE__) . '/options/defaults.php');
}

/*
 *
 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for URLs, and directories will NOT be available at this point in a child theme,
 * so you must use get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
    //$sections = array();
    $sections[] = array(
        'title' => __('A Section added by hook', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', Redux_TEXT_DOMAIN),
        // Redux ships with the glyphicons free icon pack, included in the options folder.
        // Feel free to use them, add your own icons, or leave this blank for the default.
        'icon' => trailingslashit(get_template_directory_uri()) . 'options/img/icons/glyphicons_062_attach.png',
        // Leave this as a blank section, no options just some intro text set above.
        'fields' => array()
    );

    return $sections;
}
//add_filter('redux-opts-sections-twenty_eleven', 'add_another_section');


/*
 * 
 * Custom function for filtering the args array given by a theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
    //$args['dev_mode'] = false;
    
    return $args;
}
//add_filter('redux-opts-args-twenty_eleven', 'change_framework_args');


/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */
function setup_framework_options(){
    $args = array();

    // Setting dev mode to true allows you to view the class settings/info in the panel.
    // Default: false
    //$args['dev_mode'] = true;

    // If you want to use Google Webfonts, you MUST define the api key.
    //$args['google_api_key'] = 'xxxx';

    // Define the starting tab for the option panel.
    // Default: '0';
    //$args['last_tab'] = '0';

    // Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
    // If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
    // If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
    // Default: 'standard'
    //$args['admin_stylesheet'] = 'standard';

    // Add HTML before the form.
    $args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Add content after the form.
    $args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Set footer/credit line.
    //$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', Redux_TEXT_DOMAIN);

    // Setup custom links in the footer for share icons
    $args['share_icons']['twitter'] = array(
        'link' => 'http://twitter.com/ghost1227',
        'title' => 'Follow me on Twitter', 
        'img' => Redux_OPTIONS_URL . 'img/icons/glyphicons_322_twitter.png'
    );
    $args['share_icons']['linked_in'] = array(
        'link' => 'http://www.linkedin.com/profile/view?id=52559281',
        'title' => 'Find me on LinkedIn', 
        'img' => Redux_OPTIONS_URL . 'img/icons/glyphicons_337_linked_in.png'
    );

    // Enable the import/export feature.
    // Default: true
    //$args['show_import_export'] = false;

    // Set a custom option name. Don't forget to replace spaces with underscores!
    $args['opt_name'] = 'twenty_eleven2';

    // Set a custom menu icon.
    // Redux ships with the glyphicons free icon pack, included in the options folder.
    // Feel free to use them, add your own icons, or leave this blank for the default.
    //$args['menu_icon'] = '';

    // Set a custom title for the options page.
    // Default: Options
    $args['menu_title'] = __('Options', Redux_TEXT_DOMAIN);

    // Set a custom page title for the options page.
    // Default: Options
    $args['page_title'] = __('Options', Redux_TEXT_DOMAIN);

    // Set a custom page slug for options page (wp-admin/themes.php?page=***).
    // Default: redux_options
    $args['page_slug'] = 'redux_options';

    // Set a custom page capability.
    // Default: manage_options
    //$args['page_cap'] = 'manage_options';

    // Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
    // Default: menu
    //$args['page_type'] = 'submenu';

    // Set the parent menu.
    // Default: themes.php
    // A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    //$args['page_parent'] = 'options_general.php';

    // Set a custom page location. This allows you to place your menu where you want in the menu order.
    // Must be unique or it will override other items!
    // Default: null
    //$args['page_position'] = null;

    // Set a custom page icon class (used to override the page icon next to heading)
    //$args['page_icon'] = 'icon-themes';

    // Disable the panel sections showing as submenu items.
    // Default: true
    //$args['allow_sub_menu'] = false;
        
    // Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-1',
        'title' => __('Theme Information 1', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );
    $args['help_tabs'][] = array(
        'id' => 'redux-opts-2',
        'title' => __('Theme Information 2', Redux_TEXT_DOMAIN),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', Redux_TEXT_DOMAIN)
    );

    // Set the help sidebar for the options page.                                        
    $args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', Redux_TEXT_DOMAIN);

    $sections = array();

    $sections[] = array(
        'title' => __('Getting Started', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is the description field for this section. HTML is allowed</p>', Redux_TEXT_DOMAIN),
        // Redux ships with the glyphicons free icon pack, included in the options folder.
        // Feel free to use them, add your own icons, or leave this blank for the default.
        'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_062_attach.png'
        // Lets leave this as a blank section, no options just some intro text set above.
        //'fields' => array()
    );

    $sections[] = array(
        'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_107_text_resize.png',
        'title' => __('Text Fields', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is the description field for this section. Again HTML is allowed2</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => '1', // The item ID must be unique
                'type' => 'text', // Built-in field types include:
                // text, textarea, editor, checkbox, multi_checkbox, radio, radio_img, button_set,
                // select, multi_select, color, date, divide, info, upload
                'title' => __('Text Option', Redux_TEXT_DOMAIN),
                'sub_desc' => __('This is a little space under the field title which can be used for additonal info.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                //'validate' => '', // Built-in validation includes: 
                //  email, html, html_custom, no_html, js, numeric, comma_numeric, url, str_replace, preg_replace
                //'msg' => 'custom error message', // Override the default validation error message for specific fields
                //'std' => '', // This is the default value and is used to set an option on theme activation.
                //'class' => '' // Set custom classes for elements if you want to do something a little different
                //'rows' => '6' // Set the number of rows shown for the textarea. Default: 6
            ),
            array(
                'id' => '2',
                'type' => 'text',
                'title' => __('Text Option - Email Validated', Redux_TEXT_DOMAIN),
                'sub_desc' => __('This is a little space under the field title which can be used for additonal info.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'email',
                'msg' => 'custom error message',
                'std' => 'test@test.com'
            ),
            array(
                'id' => 'password',
                'type' => 'password',
                'title' => __('Password Option', Redux_TEXT_DOMAIN),
                'sub_desc' => __('This is a little space under the field title which can be used for additonal info.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN)
            ),
            array(
                'id' => 'multi_text',
                'type' => 'multi_text',
                'title' => __('Multi Text Option', Redux_TEXT_DOMAIN),
                'sub_desc' => __('This is a little space under the field title which can be used for additonal info.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
            ),
            array(
                'id' => '3',
                'type' => 'text',
                'title' => __('Text Option - URL Validated', Redux_TEXT_DOMAIN),
                'sub_desc' => __('This must be a URL.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'url',
                'std' => 'http://reduxframework.com'
            ),
            array(
                'id' => '4',
                'type' => 'text',
                'title' => __('Text Option - Numeric Validated', Redux_TEXT_DOMAIN),
                'sub_desc' => __('This must be numeric.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'numeric',
                'std' => '0',
                'class' => 'small-text'
            ),
            array(
                'id' => 'comma_numeric',
                'type' => 'text',
                'title' => __('Text Option - Comma Numeric Validated', Redux_TEXT_DOMAIN),
                'sub_desc' => __('This must be a comma seperated string of numerical values.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'comma_numeric',
                'std' => '0',
                'class' => 'small-text'
            ),
            array(
                'id' => 'no_special_chars',
                'type' => 'text',
                'title' => __('Text Option - No Special Chars Validated', Redux_TEXT_DOMAIN),
                'sub_desc' => __('This must be a alpha numeric only.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'no_special_chars',
                'std' => '0'
            ),
            array(
                'id' => 'str_replace',
                'type' => 'text',
                'title' => __('Text Option - Str Replace Validated', Redux_TEXT_DOMAIN),
                'sub_desc' => __('You decide.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'str_replace',
                'str' => array('search' => ' ', 'replacement' => 'thisisaspace'),
                'std' => '0'
            ),
            array(
                'id' => 'preg_replace',
                'type' => 'text',
                'title' => __('Text Option - Preg Replace Validated', Redux_TEXT_DOMAIN),
                'sub_desc' => __('You decide.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'preg_replace',
                'preg' => array('pattern' => '/[^a-zA-Z_ -]/s', 'replacement' => 'no numbers'),
                'std' => '0'
            ),
            array(
                'id' => 'custom_validate',
                'type' => 'text',
                'title' => __('Text Option - Custom Callback Validated', Redux_TEXT_DOMAIN),
                'sub_desc' => __('You decide.', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate_callback' => 'validate_callback_function',
                'std' => '0'
            ),
            array(
                'id' => '5',
                'type' => 'textarea',
                'title' => __('Textarea Option - No HTML Validated', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('All HTML will be stripped', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'no_html',
                'std' => 'No HTML is allowed in here.'
            ),
            array(
                'id' => '6',
                'type' => 'textarea',
                'title' => __('Textarea Option - HTML Validated', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('HTML Allowed', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'html', // See http://codex.wordpress.org/Function_Reference/wp_kses_post
                'std' => 'HTML is allowed in here.'
            ),
            array(
                'id' => '7',
                'type' => 'textarea',
                'title' => __('Textarea Option - HTML Validated Custom', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('Custom HTML Allowed', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'html_custom',
                'std' => 'Some HTML is allowed in here.',
                'allowed_html' => array('') // See http://codex.wordpress.org/Function_Reference/wp_kses
            ),
            array(
                'id' => '8',
                'type' => 'textarea',
                'title' => __('Textarea Option - JS Validated', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('JS will be escaped', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'validate' => 'js'
            ),
            array(
                'id' => '9',
                'type' => 'editor',
                'title' => __('Editor Option', Redux_TEXT_DOMAIN),
                'sub_desc' => __('Can also use the validation methods if required', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'std' => 'OOOOOOhhhh, rich editing.',
            ),
            array(
                'id' => 'editor2',
                'type' => 'editor',
                'title' => __('Editor Option 2', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('Can also use the validation methods if required', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'std' => 'OOOOOOhhhh, rich editing with auto paragraphs disabled.',
                'autop' => false
            )
        )
    );
    
    $sections[] = array(
        'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_150_check.png',
        'title' => __('Radio/Checkbox Fields', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => '10',
                'type' => 'checkbox',
                'title' => __('Checkbox Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'switch' => true,
                'std' => '1 '// 1 = checked | 0 = unchecked
            ),
            array(
                'id' => '11',
                'type' => 'multi_checkbox',
                'title' => __('Multi Checkbox Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'options' => array('1' => 'Opt 1', '2' => 'Opt 2', '3' => 'Opt 3'), // Must provide key => value pairs for multi checkbox options
                'std' => array('1' => '1', '2' => '0', '3' => '0') // See how std has changed? You also dont need to specify opts that are 0.
            ),
            array(
                'id' => '12',
                'type' => 'radio',
                'title' => __('Radio Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'options' => array('1' => 'Opt 1', '2' => 'Opt 2', '3' => 'Opt 3'), // Must provide key => value pairs for radio options
                'std' => '2'
            ),
            array(
                'id' => '13',
                'type' => 'radio_img',
                'title' => __('Radio Image Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'options' => array(
                    '1' => array('title' => 'Opt 1', 'img' => 'images/align-none.png'),
                    '2' => array('title' => 'Opt 2', 'img' => 'images/align-left.png'),
                    '3' => array('title' => 'Opt 3', 'img' => 'images/align-center.png'),
                    '4' => array('title' => 'Opt 4', 'img' => 'images/align-right.png')
                ), // Must provide key => value(array:title|img) pairs for radio options
                'std' => '2'
            ),
            array(
                'id' => 'radio_img',
                'type' => 'radio_img',
                'title' => __('Radio Image Option For Layout', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This uses some of the built in images, you can use them for layout options.', Redux_TEXT_DOMAIN),
                'options' => array(
                    '1' => array('title' => '1 Column', 'img' => Redux_OPTIONS_URL . 'img/1col.png'),
                    '2' => array('title' => '2 Column Left', 'img' => Redux_OPTIONS_URL . 'img/2cl.png'),
                    '3' => array('title' => '2 Column Right', 'img' => Redux_OPTIONS_URL . 'img/2cr.png')
                ), // Must provide key => value(array:title|img) pairs for radio options
                'std' => '2'
            )                                                                        
        )
    );
    
    $sections[] = array(
        'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_157_show_lines.png',
        'title' => __('Select Fields', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => '14',
                'type' => 'select',
                'title' => __('Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'options' => array('1' => 'Opt 1', '2' => 'Opt 2', '3' => 'Opt 3'), // Must provide key => value pairs for select options
                'std' => '2'
            ),
            array(
                'id' => '15',
                'type' => 'multi_select',
                'title' => __('Multi Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'options' => array('1' => 'Opt 1', '2' => 'Opt 2', '3' => 'Opt 3'), // Must provide key => value pairs for radio options
                'std' => array('2', '3')
            )                                    
        )
    );
    
    $sections[] = array(
        'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_023_cogwheels.png',
        'title' => __('Custom Fields', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => '16',
                'type' => 'color',
                'title' => __('Color Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('Only color validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'std' => '#FFFFFF'
            ),
            array(
                'id' => 'color_gradient',
                'type' => 'color_gradient',
                'title' => __('Color Gradient Option', Redux_TEXT_DOMAIN),
                'sub_desc' => __('Only color validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'std' => array('from' => '#000000', 'to' => '#FFFFFF')
            ),
            array(
                'id' => '17',
                'type' => 'date',
                'title' => __('Date Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN)
            ),
            array(
                'id' => '18',
                'type' => 'button_set',
                'title' => __('Button Set Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN),
                'options' => array('1' => 'Opt 1', '2' => 'Opt 2', '3' => 'Opt 3'), // Must provide key => value pairs for radio options
                'std' => '2'
            ),
            array(
                'id' => '19',
                'type' => 'upload',
                'title' => __('Upload Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN)
            ),
            array(
                'id' => 'pages_select',
                'type' => 'pages_select',
                'title' => __('Pages Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a drop down menu of all the sites pages.', Redux_TEXT_DOMAIN),
                'args' => array() // Uses get_pages()
            ),
            array(
                'id' => 'pages_multi_select',
                'type' => 'pages_multi_select',
                'title' => __('Pages Multiple Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a multi select menu of all the sites pages.', Redux_TEXT_DOMAIN),
                'args' => array('number' => '5') // Uses get_pages()
            ),
            array(
                'id' => 'posts_select',
                'type' => 'posts_select',
                'title' => __('Posts Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a drop down menu of all the sites posts.', Redux_TEXT_DOMAIN),
                'args' => array('numberposts' => '10') // Uses get_posts()
            ),
            array(
                'id' => 'posts_multi_select',
                'type' => 'posts_multi_select',
                'title' => __('Posts Multiple Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a multi select menu of all the sites posts.', Redux_TEXT_DOMAIN),
                'args' => array('numberposts' => '10') // Uses get_posts()
            ),
            array(
                'id' => 'tags_select',
                'type' => 'tags_select',
                'title' => __('Tags Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a drop down menu of all the sites tags.', Redux_TEXT_DOMAIN),
                'args' => array('number' => '10') // Uses get_tags()
            ),
            array(
                'id' => 'tags_multi_select',
                'type' => 'tags_multi_select',
                'title' => __('Tags Multiple Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a multi select menu of all the sites tags.', Redux_TEXT_DOMAIN),
                'args' => array('number' => '10') // Uses get_tags()
            ),
            array(
                'id' => 'cats_select',
                'type' => 'cats_select',
                'title' => __('Cats Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a drop down menu of all the sites cats.', Redux_TEXT_DOMAIN),
                'args' => array('number' => '10') // Uses get_categories()
            ),
            array(
                'id' => 'cats_multi_select',
                'type' => 'cats_multi_select',
                'title' => __('Cats Multiple Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a multi select menu of all the sites cats.', Redux_TEXT_DOMAIN),
                'args' => array('number' => '10') // Uses get_categories()
            ),
            array(
                'id' => 'menu_select',
                'type' => 'menu_select',
                'title' => __('Menu Select Option', Redux_TEXT_DOMAIN),
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a drop down menu of all the sites menus.', Redux_TEXT_DOMAIN),
                //'args' => array() // Uses wp_get_nav_menus()
            ),
            array(
                'id' => 'select_hide_below',
                'type' => 'select_hide_below',
                'title' => __('Select Hide Below Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field requires certain options to be checked before the below field will be shown.', Redux_TEXT_DOMAIN),
                'options' => array(
                    '1' => array('name' => 'Opt 1 field below allowed', 'allow' => 'true'),
                    '2' => array('name' => 'Opt 2 field below hidden', 'allow' => 'false'),
                    '3' => array('name' => 'Opt 3 field below allowed', 'allow' => 'true')
                ), // Must provide key => value(array) pairs for select options
                'std' => '2'
            ),
            array(
                'id' => 'menu_location_select',
                'type' => 'menu_location_select',
                'title' => __('Menu Location Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a drop down menu of all the themes menu locations.', Redux_TEXT_DOMAIN)
            ),
            array(
                'id' => 'checkbox_hide_below',
                'type' => 'checkbox_hide_below',
                'title' => __('Checkbox to hide below', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a checkbox which will allow the user to use the next setting.', Redux_TEXT_DOMAIN),
            ),
            array(
                'id' => 'post_type_select',
                'type' => 'post_type_select',
                'title' => __('Post Type Select Option', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('No validation can be done on this field type', Redux_TEXT_DOMAIN),
                'desc' => __('This field creates a drop down menu of all registered post types.', Redux_TEXT_DOMAIN),
                //'args' => array() // Uses get_post_types()
            ),
            array(
                'id' => 'custom_callback',
                //'type' => 'nothing', // Doesn't need to be called for callback fields
                'title' => __('Custom Field Callback', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('This is a completely unique field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is created with a callback function, so anything goes in this field. Make sure to define the function though.', Redux_TEXT_DOMAIN),
                'callback' => 'my_custom_field'
            ),
            array(
                'id' => 'google_webfonts',
                'type' => 'google_webfonts',
                'title' => __('Google Webfonts', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('This is a completely unique field type', Redux_TEXT_DOMAIN),
                'desc' => __('This is a simple implementation of the developer API for Google Webfonts. Don\t forget to set your API key!', Redux_TEXT_DOMAIN)
            )                            
        )
    );

    $sections[] = array(
        'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_093_crop.png',
        'title' => __('Non Value Fields', Redux_TEXT_DOMAIN),
        'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', Redux_TEXT_DOMAIN),
        'fields' => array(
            array(
                'id' => '20',
                'type' => 'text',
                'title' => __('Text Field', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('Additional Info', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN)
            ),
            array(
                'id' => '21',
                'type' => 'divide'
            ),
            array(
                'id' => '22',
                'type' => 'text',
                'title' => __('Text Field', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('Additional Info', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN)
            ),
            array(
                'id' => '23',
                'type' => 'info',
                'desc' => __('<p class="description">This is the info field, if you want to break sections up.</p>', Redux_TEXT_DOMAIN)
            ),
            array(
                'id' => '24',
                'type' => 'text',
                'title' => __('Text Field', Redux_TEXT_DOMAIN), 
                'sub_desc' => __('Additional Info', Redux_TEXT_DOMAIN),
                'desc' => __('This is the description field, again good for additional info.', Redux_TEXT_DOMAIN)
            )                
        )
    );
                
    $tabs = array();

    if (function_exists('wp_get_theme')){
        $theme_data = wp_get_theme();
        $item_uri = $theme_data->get('ThemeURI');
        $description = $theme_data->get('Description');
        $author = $theme_data->get('Author');
        $author_uri = $theme_data->get('AuthorURI');
        $version = $theme_data->get('Version');
        $tags = $theme_data->get('Tags');
    }else{
        $theme_data = get_theme_data(trailingslashit(get_stylesheet_directory()) . 'style.css');
        $item_uri = $theme_data['URI'];
        $description = $theme_data['Description'];
        $author = $theme_data['Author'];
        $author_uri = $theme_data['AuthorURI'];
        $version = $theme_data['Version'];
        $tags = $theme_data['Tags'];
     }
    
    $item_info = '<div class="redux-opts-section-desc">';
    $item_info .= '<p class="redux-opts-item-data description item-uri">' . __('<strong>Theme URL:</strong> ', Redux_TEXT_DOMAIN) . '<a href="' . $item_uri . '" target="_blank">' . $item_uri . '</a></p>';
    $item_info .= '<p class="redux-opts-item-data description item-author">' . __('<strong>Author:</strong> ', Redux_TEXT_DOMAIN) . ($author_uri ? '<a href="' . $author_uri . '" target="_blank">' . $author . '</a>' : $author) . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-version">' . __('<strong>Version:</strong> ', Redux_TEXT_DOMAIN) . $version . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-description">' . $description . '</p>';
    $item_info .= '<p class="redux-opts-item-data description item-tags">' . __('<strong>Tags:</strong> ', Redux_TEXT_DOMAIN) . implode(', ', $tags) . '</p>';
    $item_info .= '</div>';

    $tabs['item_info'] = array(
        'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_195_circle_info.png',
        'title' => __('Theme Information', Redux_TEXT_DOMAIN),
        'content' => $item_info
    );
    
    if(file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
        $tabs['docs'] = array(
            'icon' => Redux_OPTIONS_URL . 'img/icons/glyphicons_071_book.png',
            'title' => __('Documentation', Redux_TEXT_DOMAIN),
            'content' => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
        );
    }

    global $Redux_Options;
    $Redux_Options = new Redux_Options($sections, $args, $tabs);

}
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
    print_r($field);
    print_r($value);
}

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
    $error = false;
    $value =  'just testing';
    /*
    do your validation
    
    if(something) {
        $value = $value;
    } elseif(somthing else) {
        $error = true;
        $value = $existing_value;
        $field['msg'] = 'your custom error message';
    }
    */
    
    $return['value'] = $value;
    if($error == true) {
        $return['error'] = $field;
    }
    return $return;
}
