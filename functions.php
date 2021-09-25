<?php
/**
 * eclab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eclab
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'eclab_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function eclab_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'eclab' ),
				'menu-2' => esc_html__( 'Footer', 'eclab' ),
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
		add_theme_support( 'customize-selective-refresh-widgets' );

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
add_action( 'after_setup_theme', 'eclab_setup' );


/**
 * Enqueue scripts and styles.
 */
function eclab_scripts() {
	wp_enqueue_style( 'eclab-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'eclab-style', 'rtl', 'replace' );
	
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
	// wp_enqueue_script('jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array(), null, true);
	wp_enqueue_script( 'global', get_template_directory_uri() . '/js/global.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'home', get_template_directory_uri() . '/js/home.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'tags', get_template_directory_uri() . '/js/tags.js', array(), _S_VERSION, true );
	wp_enqueue_script('gsap', get_template_directory_uri() . '/js/gsap.min.js', true);
	if( !is_front_page() ) {
		wp_enqueue_script( 'action-network-api', get_template_directory_uri() . '/js/action-network-api.js', array(), _S_VERSION, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_localize_script('global','site_data',array(
        'site_url' => site_url(),
        'theme_url' => get_template_directory_uri()
    ));
}
add_action( 'wp_enqueue_scripts', 'eclab_scripts' );

//If acf plugin exists
if( function_exists('acf_add_options_page') ) {
    //Register acf option page
    acf_add_options_page(array(
        'page_title'    => 'Global Settings',
        'menu_title'    => 'Global Settings',
        'menu_slug'     => 'global-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

function get_pll_current_language() {
	if ( function_exists('pll_current_language') ) {
		return pll_current_language();
	}
}

function get_pll_languages_list($args = array()) {
	if ( function_exists('pll_languages_list') ) {
		return pll_languages_list($args);
	}
}

if( get_pll_languages_list() ):
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

function get_pll_option_page() {	
	if ( get_pll_current_language() ) {
		$option_page = get_pll_current_language();
	} else {
		$option_page = 'option';
	}

	return $option_page;
}

function get_pll_home_url($slug = '') {
	if ( function_exists('pll_home_url') ) {
		return pll_home_url($slug);
	} else {
		return get_home_url();
	}
}

add_action('wp_ajax_t311_submissions' , 't311_submissions');
add_action('wp_ajax_nopriv_t311_submissions','t311_submissions');
function t311_submissions() {
    if( (isset($_POST['fname']) && !empty($_POST['fname'])) &&
		(isset($_POST['lname']) && !empty($_POST['lname'])) &&
		(isset($_POST['email']) && !empty($_POST['email'])) &&
		(isset($_POST['story']) && !empty($_POST['story'])) &&
		(isset($_POST['storytile']) && !empty($_POST['storytile'])) &&
		(isset($_POST['checkbox']) && !empty($_POST['checkbox'])) &&
		(isset($_POST['topic']) && !empty($_POST['topic'])) &&
		(isset($_POST['phonenumber']) && !empty($_POST['phonenumber'])) &&
		(isset($_POST['radio']) && !empty($_POST['radio'])) &&
		(isset($_POST['radios']) && !empty($_POST['radios'])) &&
		(isset($_POST['zipcode']) &&!empty($_POST['zipcode'])) ){

    	$add_tags = explode(',', $_POST['tags']);

    	$api_key = "78e7e43ff662bc958e6b869a9ea44307";
		$api_request_url = "https://actionnetwork.org/api/v2/forms/fe289885-c119-4ee7-a543-d3e92a0ce691/submissions/";
		$headers = array(
		       "Content-Type: application/json",
		       'OSDI-API-Token: '.$api_key
		    );
		$post_data = array(
			"person" => array(
				'email_addresses' => array(
					array('address' => $_POST['email'])
				),
				"custom_fields" => array(
					'fname'	=> $_POST['fname'],
					'lname' => $_POST['lname'],
					'storytile' => $_POST['storytile'],
					'checkbox' => $_POST['checkbox'],
					'phonenumber' => $_POST['phonenumber'],
					'story' => $_POST['story'],
					'topic' => $_POST['topic'],
					'radios' => $_POST['radios'],
					'zipcode' => $_POST['zipcode'],
					'base64_img' => $_POST['base64_img'],
					'radio' => $_POST['radio']
				)
			),
			"add_tags" => $add_tags
		);


		error_reporting(1);
		$api_key = "78e7e43ff662bc958e6b869a9ea44307";
		$form_id = "fe289885-c119-4ee7-a543-d3e92a0ce691";


		$first_name = 'new';
		$last_name = 'testing1';
		$email = 'testnew@gmail.com';
		$zipcode = '10000';
		$api_key = "78e7e43ff662bc958e6b869a9ea44307";
		$api_request_url = "https://actionnetwork.org/api/v2/forms/fe289885-c119-4ee7-a543-d3e92a0ce691/submissions/";
		$headers = array(
		       "Content-Type: application/json",
		       'OSDI-API-Token: '.$api_key
		    );
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_URL,$api_request_url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);
		curl_close ($ch);

		print_r($server_output);
    }
    die();
}