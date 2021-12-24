<?php
/**
 * eclab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eclab
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

if (! function_exists('eclab_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function eclab_setup()
    {

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'eclab'),
                'menu-2' => esc_html__('Footer', 'eclab'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'eclab_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }
endif;
add_action('after_setup_theme', 'eclab_setup');

/**
 * Admin story script
 */
add_action('admin_enqueue_scripts', 'my_admin_scripts');
function my_admin_scripts()
{
    if (isset($_GET['post_type']) && $_GET['post_type'] == 'an_stories') {
        wp_register_script('story-status', get_template_directory_uri() . '/js/manage-story.js');
        wp_enqueue_script('story-status');
    }
}

/**
 * Enqueue scripts and styles.
 */
function eclab_scripts()
{
    wp_enqueue_style('eclab-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_style_add_data('eclab-style', 'rtl', 'replace');
    
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
    // wp_enqueue_script('jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array(), null, true);
    wp_enqueue_script('cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array(), _S_VERSION, true);
    wp_enqueue_script('tagthis', get_template_directory_uri() . '/js/jquery.tagthis.js', array(), _S_VERSION, true);
    
    wp_enqueue_script('global', get_template_directory_uri() . '/js/global.js?v=1013', array(), _S_VERSION, true);
    // wp_enqueue_script( 'home', get_template_directory_uri() . '/js/home.js', array(), _S_VERSION, true );

    wp_enqueue_script('gsap', get_template_directory_uri() . '/js/gsap.min.js', true);
    wp_enqueue_script('scrolltrigger', get_template_directory_uri() . '/js/ScrollTrigger.min.js', true);

    if (!is_front_page() || is_page_template("template-landing.php")) {
        wp_enqueue_script('action-network-api', get_template_directory_uri() . '/js/action-network-api.js', array(), _S_VERSION, true);
    }
    if (is_page_template("template-about.php")) {
        wp_enqueue_script('about-page', get_template_directory_uri() . '/js/about-page.js', array(), _S_VERSION, true);
    }

    if (is_front_page() || is_page_template("template-landing.php")) {
        wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), _S_VERSION, true);
        wp_enqueue_script('validate-steps', get_template_directory_uri() . '/js/jquery.steps.js', array(), _S_VERSION, true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_localize_script('global', 'site_data', array(
        'site_url' => site_url(),
        'theme_url' => get_template_directory_uri()
    ));
}
add_action('wp_enqueue_scripts', 'eclab_scripts');

//If acf plugin exists
if (function_exists('acf_add_options_page')) {
    //Register acf option page
    acf_add_options_page(array(
        'page_title'    => 'Global Settings',
        'menu_title'    => 'Global Settings',
        'menu_slug'     => 'global-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

function get_pll_current_language()
{
    if (function_exists('pll_current_language')) {
        return pll_current_language();
    }
}

function get_pll_languages_list($args = array())
{
    if (function_exists('pll_languages_list')) {
        return pll_languages_list($args);
    }
}

if (get_pll_languages_list()) :
    foreach (get_pll_languages_list() as $lang) {
        acf_add_options_sub_page([
            'page_title' => 'Global Settings '.$lang,
            'menu_title' => 'Global Settings '.$lang,
            'menu_slug' => "global-settings-${lang}",
            'post_id' => $lang,
            'parent' => 'global-settings'
        ]);
    }
endif;

function get_pll_option_page()
{
    if (get_pll_current_language()) {
        $option_page = get_pll_current_language();
    } else {
        $option_page = 'option';
    }

    return $option_page;
}

function get_pll_home_url($slug = '')
{
    if (function_exists('pll_home_url')) {
        return pll_home_url($slug);
    } else {
        return get_home_url();
    }
}

add_action('wp_ajax_t311_submissions', 't311_submissions');
add_action('wp_ajax_nopriv_t311_submissions', 't311_submissions');
function t311_submissions()
{
    // print_r($_POST);
    if ((isset($_POST['fname']) && !empty($_POST['fname'])) &&
        (isset($_POST['lname']) && !empty($_POST['lname'])) &&
        (isset($_POST['email']) && !empty($_POST['email'])) &&
        (isset($_POST['story']) && !empty($_POST['story'])) &&
        (isset($_POST['storytile']) && !empty($_POST['storytile'])) &&
        (isset($_POST['checkbox']) && !empty($_POST['checkbox'])) &&
        (isset($_POST['radio']) && !empty($_POST['radio'])) &&
        (isset($_POST['radios']) && !empty($_POST['radios']))) {
        $img_url = '';
        if (!empty($_FILES)) {
            $img_url = upload_user_file($_FILES['file']);
        }
        $add_tags = $_POST['tags'];
        if ($_POST['tags'] != '') {
            $add_tags = explode(',', $add_tags);
            $add_tags = array_map("tn_array_map", $add_tags);
            $add_tags = implode(',', $add_tags);
        }

        $post_data = array(
            "person" => array(
                'family_name' => $_POST['lname'],
                'given_name' => $_POST['fname'],
                'email_addresses' => array(
                    array('address' => $_POST['email'])
                ),
                "custom_fields" => array(
                    'fname' => $_POST['fname'],
                    'lname' => $_POST['lname'],
                    'storytile' => $_POST['storytile'],
                    'checkbox' => $_POST['checkbox'],
                    'phonenumber' => $_POST['phonenumber'],
                    'story' => $_POST['story'],
                    'topic' => $_POST['topic'],
                    'radios' => $_POST['radios'],
                    'zipcode' => $_POST['zipcode'],
                    'base64_img' => $img_url,
                    'radio' => $_POST['radio'],
                    'tag' => $add_tags
                )
            ),
            "triggers" => array(
                'autoresponse' => array(
                    'enabled' => true
                )
            )
        );


        error_reporting(1);
        $api_key = "78e7e43ff662bc958e6b869a9ea44307";
        $api_request_url = "https://actionnetwork.org/api/v2/forms/0256972e-f4ad-4a1f-985a-e8944d2f85ae/submissions/";
        $headers = array(
               "Content-Type: application/json",
               'OSDI-API-Token: '.$api_key
            );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $api_request_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);

        $server_output_arr = json_decode($server_output);
        if (!empty($server_output_arr) && isset($server_output_arr->identifiers) && !empty($server_output_arr->identifiers)) {
            print_r($server_output);
            $current_user = wp_get_current_user();
            // create post object
            $story = array(
                'post_title'  => $_POST['storytile'],
                'post_status' => 'publish',
                'post_author' => $current_user->ID,
                'post_type'   => 'an_stories',
                'post_date'   => date('Y-m-d H:i:s')
            );
            // insert the post into the database
            $post_story_id = wp_insert_post($story);
            $person_link =  $server_output_arr->_links->{"osdi:person"}->href;
            add_post_meta($post_story_id, 'story_id', $server_output_arr->identifiers[0]);
            add_post_meta($post_story_id, 'person_link', $person_link);
            
            add_post_meta($post_story_id, 'approve', 'not_approved');
        }
    }
    die();
}

add_action('wp_ajax_t311_upload_image', 't311_upload_image');
add_action('wp_ajax_nopriv_t311_upload_image', 't311_upload_image');
function t311_upload_image()
{
    if (!empty($_FILES)) {
        $img_url = upload_user_file($_FILES['file']);
        echo $img_url;
    }
    die();
}

/**
 * Signup email ajax
 */
add_action('wp_ajax_signup_email_an', 'signup_email_an');
add_action('wp_ajax_nopriv_signup_email_an', 'signup_email_an');
function signup_email_an()
{
    if ((isset($_POST['fname'])&& !empty($_POST['fname'])) &&
        (isset($_POST['lname'])&& !empty($_POST['lname'])) &&
        (isset($_POST['email'])&& !empty($_POST['email'])) &&
        (isset($_POST['zipcode']) &&!empty($_POST['zipcode']))) {
        $first_name = sanitize_text_field($_POST['fname']);
        $last_name = sanitize_text_field($_POST['lname']);
        $email = sanitize_email($_POST['email']);
        $zipcode = sanitize_text_field($_POST['zipcode']);
        $api_key = "78e7e43ff662bc958e6b869a9ea44307";
        $api_request_url = "https://actionnetwork.org/api/v2/forms/ffba81ee-03e0-4c17-abf6-1dae7786c3fa/submissions/";
        $headers = array(
               "Content-Type: application/json",
               'OSDI-API-Token: '.$api_key
            );
        $string = '{
		  "person" : {
		    "family_name" : "'.$last_name.'",
		    "given_name" : "'.$first_name.'",
		    "postal_addresses" : [ { "postal_code" : "'.$zipcode.'" }],
		    "email_addresses" : [ { "address" : "'.$email.'" }]
		   },
           "triggers":{"autoresponse":{"enabled":true}},
		  "add_tags": [
		    "volunteer",
		    "member"
		  ]
		}';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $api_request_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);
        wp_send_json_success($server_output);
    } else {
        wp_send_json_success('Nothing!!!!!!');
    }
}

add_action('wp_ajax_childhoodFundingCoalition', 'childhoodFundingCoalition');
add_action('wp_ajax_nopriv_childhoodFundingCoalition', 'childhoodFundingCoalition');
function childhoodFundingCoalition()
{
    if ((isset($_POST['email'])&& !empty($_POST['email'])) &&
            (isset($_POST['zipcode']) &&!empty($_POST['zipcode']) )) {
        $first_name = sanitize_text_field($_POST['fname']);
        $last_name = sanitize_text_field($_POST['lname']);
        if (empty($first_name) && empty($last_name)) {
            $first_name = "Anonymous";
            $last_name = "Anonymous";
        }
        $email = sanitize_email($_POST['email']);
        $zipcode = sanitize_text_field($_POST['zipcode']);
        $api_key = "78e7e43ff662bc958e6b869a9ea44307";
        $api_request_url = "https://actionnetwork.org/api/v2/forms/f31feaba-2d33-435c-a2cd-91c4f07638aa/submissions/";
        $headers = array(
               "Content-Type: application/json",
               'OSDI-API-Token: '.$api_key
            );
        $string = '{
              "person" : {
                "family_name" : "'.$last_name.'",
                "given_name" : "'.$first_name.'",
                "postal_addresses" : [ { "postal_code" : "'.$zipcode.'" }],
                "email_addresses" : [ { "address" : "'.$email.'" }]
               },
                   "triggers":{"autoresponse":{"enabled":true}},
              "add_tags": [
                "volunteer",
                "member"
              ]
            }';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $api_request_url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $string);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);
        wp_send_json_success($server_output);
    } else {
        wp_send_json_success('Nothing!!!!!!');
    }
}


function upload_user_file($file)
{
    require(dirname(__FILE__) . '/../../../wp-load.php');

    $wordpress_upload_dir = wp_upload_dir();
    // $wordpress_upload_dir['path'] is the full server path to wp-content/uploads/2017/05, for multisite works good as well
    // $wordpress_upload_dir['url'] the absolute URL to the same folder, actually we do not need it, just to show the link to file
    $i = 1; // number of tries when the file with the same name is already exists

    $profilepicture = $file;
    $new_file_path = $wordpress_upload_dir['path'] . '/' . $profilepicture['name'];
    $new_file_mime = mime_content_type($profilepicture['tmp_name']);

    if (empty($profilepicture)) {
        die('File is not selected.');
    }

    if ($profilepicture['error']) {
        die($profilepicture['error']);
    }
        
    if ($profilepicture['size'] > wp_max_upload_size()) {
        die('It is too large than expected.');
    }
        
    if (!in_array($new_file_mime, get_allowed_mime_types())) {
        die('WordPress doesn\'t allow this type of uploads.');
    }
        
    while (file_exists($new_file_path)) {
        $i++;
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $i . '_' . $profilepicture['name'];
    }

    // looks like everything is OK
    if (move_uploaded_file($profilepicture['tmp_name'], $new_file_path)) {
        $upload_id = wp_insert_attachment(array(
            'guid'           => $new_file_path,
            'post_mime_type' => $new_file_mime,
            'post_title'     => preg_replace('/\.[^.]+$/', '', $profilepicture['name']),
            'post_content'   => '',
            'post_status'    => 'inherit'
        ), $new_file_path);

        // wp_generate_attachment_metadata() won't work if you do not include this file
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        // Generate and save the attachment metas into the database
        wp_update_attachment_metadata($upload_id, wp_generate_attachment_metadata($upload_id, $new_file_path));

        // Show the uploaded file in browser
        // wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
    }

    return $wordpress_upload_dir['url'] . '/' . basename($new_file_path);
}

function tn_array_map($arr)
{
    return('#' . $arr);
}

function add_cors_http_header()
{
    header("Access-Control-Allow-Origin: *");
}
add_action('init', 'add_cors_http_header');
/*
18/10
 */
/**
 * Custom post type
 */
function an_story()
{
    register_post_type(
        'an_stories',
        array(
            'labels'        => array(
                'name'          => 'Stories',
                'singular_name' => 'Story',
                'add_new_item'  => 'New Story ',
                'menu_name'     => 'AN Stories',
                'all_items'     => 'All Stories',
            ),
            'public'        => true,
            'has_archive'   => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'revisions'),
            'hierarchical'  => true,
            'capability_type' => 'post',
            'capabilities' => array(
              'edit_post'          => false,
              'delete_post'        => false,
              'create_posts' => false,
            ),
        )
    );
}
add_action('init', 'an_story');
add_action('wp_ajax_rtc_change_story_status', 'rtc_change_story_status_11');
function rtc_change_story_status_11()
{
    $id = intval($_POST['story_id']);
    $value = sanitize_text_field($_POST['value']);
    if ($id && $value) {
        update_post_meta($id, 'approve', $value);
        wp_send_json_success("Done!");
    } else {
        wp_send_json_success("Fail!!");
    }
}

add_filter('manage_an_stories_posts_columns', 'set_custom_edit_an_stories_columns');
function set_custom_edit_an_stories_columns($columns)
{
    
    $columns['approved'] = __('Approved', 'an_stories');
    return $columns;
}

add_action('manage_an_stories_posts_custom_column', 'custom_an_stories_column', 10, 2);
function custom_an_stories_column($column, $post_id)
{
    $story_status = get_post_meta($post_id, 'approve', true);
    switch ($column) {
        case 'approved':
            echo '<select name="status" class="story-status" data-id="'.$post_id.'">
                        <option value="approved"'.($story_status=="approved"?"selected":"").'>Approved</option>
                        <option value="not_approved" '.($story_status=="not_approved"?"selected":"").' >Not Approved</option>
                    </select>';
            break;
    }
}

/**
 * Check story
 */
add_action('wp', 'rtc_post_listing_page');
function rtc_post_listing_page()
{
    global $current_screen;
    if (is_admin() && "edit-an_stories"===$current_screen->id) {
        $current_user = wp_get_current_user();
        $rtc_stories = get_posts([
          'post_type' => 'an_stories',
          'post_status' => 'publish',
          'numberposts' => -1
          // 'order'    => 'ASC'
        ]);
        $story_ids = array();

        // foreach ($rtc_stories as $story) {
        //     $story_ids[] = get_post_meta($story->ID, 'story_id', true);
        // }
        for ($i=0; $i<count($rtc_stories); $i++) {
            $story_ids[] = get_post_meta($rtc_stories[$i]->ID, 'story_id', true);
        }
        $person_link = array();
        $api_key = "78e7e43ff662bc958e6b869a9ea44307";
        $form_id = "0256972e-f4ad-4a1f-985a-e8944d2f85ae";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 100);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('OSDI-API-Token: '.$api_key));
        // $api_request_url = "https://actionnetwork.org/api/v2/forms/f31feaba-2d33-435c-a2cd-91c4f07638aa/submissions";
        $api_request_url = "https://actionnetwork.org/api/v2/forms/{$form_id}/submissions/";
        curl_setopt($ch, CURLOPT_URL, $api_request_url);

        $submissions = json_decode(curl_exec($ch));
        $total_page = $submissions->total_pages;
        if ($total_page > 1) {
            for ($i=1; $i<=$total_page; $i++) {
                $url = "https://actionnetwork.org/api/v2/forms/{$form_id}/submissions/?per_page=25&page=".$i;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_TIMEOUT, 100);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('OSDI-API-Token: '.$api_key));
                curl_setopt($ch, CURLOPT_URL, $url);
                $each_url = json_decode(curl_exec($ch));
                foreach ($each_url->_embedded->{"osdi:submissions"} as $key => $value) {
                    $single_link = $value->_links->{"osdi:person"}->href;
                    if (!in_array($single_link, $person_link)) {
                        array_push($person_link, $value->_links->{"osdi:person"}->href);
                    }
                }
            }
        } else {
            foreach ($submissions->_embedded->{"osdi:submissions"} as $key => $value) {
                $single_link = $value->_links->{"osdi:person"}->href;
                if (!in_array($single_link, $person_link)) {
                    array_push($person_link, $value->_links->{"osdi:person"}->href);
                }
            }
        }

        $person_link = array_reverse($person_link);

        foreach ($person_link as $key => $l) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 100);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('OSDI-API-Token: '.$api_key));
            $api_request_url = $l;
            //$api_request_url .= "?".http_build_query($api_request_parameters);
            curl_setopt($ch, CURLOPT_URL, $api_request_url);
            $response = curl_exec($ch);
            $person_data = json_decode($response);
            $single_id = $person_data->identifiers[0];
            $custom_fields = $person_data->custom_fields;
            $person_link =  $person_data->_links->self->href;
            if (!in_array($single_id, $story_ids)) {
                // create post object
                $check_post = get_posts(array(
                    'numberposts'   => 1,
                    'post_type'     => 'an_stories',
                    'meta_key'      => 'person_link',
                    'meta_value'    => $person_link
                ));
                if (empty($check_post)) {
                    $single_story = array(
                        'post_title'  => $custom_fields->storytile,
                        'post_status' => 'publish',
                        'post_author' => $current_user->ID,
                        'post_type'   => 'an_stories',
                        'post_date'   => date('Y-m-d H:i:s')
                    );
                    $post_story_id = wp_insert_post($single_story);
                    
                    add_post_meta($post_story_id, 'story_id', $single_id);
                    add_post_meta($post_story_id, 'person_link', $person_link);
                    
                    add_post_meta($post_story_id, 'approve', 'not_approved');
                } else {
                    $check_post = $check_post[0];
                    $post_id = $check_post->ID;
                    update_post_meta($post_id, 'story_id', $single_id);
                    update_post_meta($post_id, 'approve', 'not_approved');
                }
            }
        }
    }
}
