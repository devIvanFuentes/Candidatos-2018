<?php
/**
 * candidatos functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package candidatos
 */

if ( ! function_exists( 'candidatos_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function candidatos_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on candidatos, use a find and replace
		 * to change 'candidatos' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'candidatos', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'candidatos' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'candidatos_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'candidatos_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function candidatos_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'candidatos_content_width', 640 );
}
add_action( 'after_setup_theme', 'candidatos_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function candidatos_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'candidatos' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'candidatos' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'candidatos_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function candidatos_scripts() {
	wp_register_style( 'custom-css', get_template_directory_uri().'/css/custom.css', null, false, 'all' );
	wp_register_style( 'materialize-css', get_template_directory_uri().'/css/materialize.min.css', null, false, 'all' );
	wp_register_style( 'icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', null, false, 'all' );
	wp_register_style( 'animate', get_template_directory_uri().'/css/animate.css', null, false, 'all' );
	wp_register_style( 'fontastic', 'https://file.myfontastic.com/mBECXfgiPWRQmkgkFoU4sc/icons.css', false, 'all' );
	wp_register_style( 'sweet-css', 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.min.css', false, 'all' );
	
	wp_register_script( 'sweet-js', 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'materialize-js', get_template_directory_uri().'/js/materialize.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'init', get_template_directory_uri().'/js/init.js', array( 'jquery' ), false, false );
	wp_register_script( 'vote', get_template_directory_uri().'/js/vote.js', array( 'jquery','sweet-js' ), false, false );
	wp_register_script( 'geodecoder', 'http://maps.googleapis.com/maps/api/js?key=AIzaSyDhJjJuxDUNuzvKvlDdUIxV1qfq--eH_iU', array( 'jquery' ), false, false );
	
	wp_enqueue_script( 'geodecoder' );
	wp_enqueue_script( 'candidatos-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'candidatos-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'materialize-js' );
	wp_enqueue_script( 'init' );
	wp_enqueue_script( 'vote' );
	wp_enqueue_script( 'sweet-js' );
	
	wp_enqueue_style( 'candidatos-style', get_stylesheet_uri() );
	wp_enqueue_style( 'materialize-css' );
	wp_enqueue_style( 'custom-css' );
	wp_enqueue_style( 'icons' );
	wp_enqueue_style( 'animate' );
	wp_enqueue_style( 'fontastic' );
	wp_enqueue_style( 'sweet-css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'candidatos_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}


function tec_custom_logo_output( $html ) {
	$html = str_replace('custom-logo-link', 'brand-logo center', $html );
	return $html;
}
add_filter('get_custom_logo', 'tec_custom_logo_output', 10);


// Function to load sticky script

function tec_add_sticky(){
	
	$pages = array('single.php');

	if ( is_single() ) {
		
		wp_register_script( 'sticky', get_bloginfo('template_url').'/js/sticky.js', array( 'jquery' ), false, false );
		wp_enqueue_script( 'sticky' );
	 }
}

add_action( 'wp_enqueue_scripts', 'tec_add_sticky');


function tec_get_posts($category_sid,$limit){

	$url = "https://seunonoticias.mx/wp-json/wp/v2/posts?categories=".$category_sid."&per_page=".$limit;
	// echo $url;
	
	$curl = curl_init();


	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "cache-control: no-cache"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	$response = json_decode($response, true); //because of true, it's in an array
	// echo 'Online: '. $response['players']['online'];
	return $response;
}