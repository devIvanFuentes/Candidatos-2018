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
	wp_register_style( 'ticker', get_template_directory_uri().'/css/ticker.css', false, 'all' );
	wp_register_style( 'owl', get_template_directory_uri().'/css/owl.carousel.min.css', false, 'all' );
	wp_register_style( 'owl-default', get_template_directory_uri().'/css/owl.theme.default.min.css', false, 'all' );
	
	wp_register_script( 'sweet-js', 'https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'materialize-js', get_template_directory_uri().'/js/materialize.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'init', get_template_directory_uri().'/js/init.js', array( 'jquery' ), false, false );
	wp_register_script( 'ticker-js', get_template_directory_uri().'/js/jquery.tickerNews.min.js', array( 'jquery' ), false, false );
	wp_register_script( 'geodecoder', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDhJjJuxDUNuzvKvlDdUIxV1qfq--eH_iU', array( 'jquery' ), false, false );



	
	wp_register_script( 'vote', get_template_directory_uri().'/js/vote.js', array( 'jquery','sweet-js' ), false, false );
	$admin = array('ajax_url' => admin_url('admin-ajax.php') );
	wp_localize_script( 'vote', 'url', $admin );
	// wp_register_script( 'owl-js', get_template_directory_uri().'/js/owl.carousel.min.js', array( 'jquery','sweet-js' ), false, false );

	
	wp_enqueue_script( 'geodecoder' );
	wp_enqueue_script( 'ticker-js' );
	wp_enqueue_script( 'candidatos-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'candidatos-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'materialize-js' );
	wp_enqueue_script( 'init' );
	wp_enqueue_script( 'vote' );
	wp_enqueue_script( 'sweet-js' );
	// wp_enqueue_script( 'owl-js' );
	
	wp_enqueue_style( 'candidatos-style', get_stylesheet_uri() );
	wp_enqueue_style( 'materialize-css' );
	wp_enqueue_style( 'custom-css' );
	wp_enqueue_style( 'icons' );
	wp_enqueue_style( 'animate' );
	wp_enqueue_style( 'fontastic' );
	wp_enqueue_style( 'sweet-css' );
	wp_enqueue_style( 'ticker' );
	wp_enqueue_style( 'owl' );
	wp_enqueue_style( 'owl-default' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}


function morris_script_home(){

	if( is_front_page() ):

		wp_register_style( 'morris-css', '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css', null, false, 'all' );
		wp_register_script( 'raphael', '//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js', array( 'jquery' ), false, false );
		wp_register_script( 'morris', '//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js', array( 'jquery', 'raphael' ), false, false );
		wp_register_script( 'custom-morris', get_template_directory_uri().'/js/custom_morris.js', array( 'jquery', 'raphael','morris' ), false, false );

		wp_enqueue_style( 'morris-css' );
		wp_enqueue_script( 'raphael' );
		wp_enqueue_script( 'morris' );
		wp_enqueue_script( 'custom-morris' );

	

	endif;

}

add_action('wp_enqueue_scripts','morris_script_home');
add_action( 'wp_enqueue_scripts', 'candidatos_scripts' );


// FUNCION AJAX
add_action( 'wp_ajax_nopriv_tec_insert_vote', 'tec_insert_vote' );
add_action('wp_ajax_tec_insert_vote','tec_insert_vote');

function tec_get_existing_vote($ip,$status,$location_sid){
	global $wpdb;
	$query = "
		SELECT COUNT(user_ip) AS total_ip
		FROM candidate_vote_b
		WHERE poll_sid = (
				SELECT poll_id
				FROM poll_d
				WHERE status_sid = (
						SELECT status_id
						FROM status_a
						WHERE description = '$status'
						)
					AND user_ip = '$ip'
					AND location_sid = $location_sid
				)
	";

	return $wpdb->get_results( $query, ARRAY_A );


}

//Function to get the location sid
function tec_get_location_sid($term){
	global $wpdb;
	$query = "
		SELECT term_id FROM wp_terms WHERE name = '$term'
	";
	return $wpdb->get_results( $query, ARRAY_A );
}

// Function to get all the taxonomies
function tec_get_all_taxonomies($taxonomy){
	global $wpdb;
	$query = "
		SELECT l.term_id , l.name 
			from wp_term_taxonomy t
    		JOIN wp_terms l ON t.term_id = l.term_id
    		WHERE t.taxonomy = '$taxonomy'
	";

	return $wpdb->get_results( $query );
}

// Function to chek if a taxonomy exist
function tec_validate_taxonomy( $taxonomy, $term ){
	global $wpdb;
	$query = "
	SELECT COUNT(l.term_id) as total_taxonomy 
		from wp_term_taxonomy t
    	JOIN wp_terms l ON t.term_id = l.term_id
    	WHERE t.taxonomy = '$taxonomy'
    	AND l.name = '$term'
	";

	return $wpdb->get_results( $query, ARRAY_A );
}

function tec_get_poll_by_status($status,$location_sid){
	global $wpdb;
	$query="
		SELECT poll_id
		FROM poll_d
		WHERE status_sid = (
				SELECT status_id
				FROM status_a
				WHERE description = '$status'
				)
		AND location_sid = $location_sid
	";

	return $wpdb->get_results( $query, ARRAY_A );
}

// Funcion para obtener el porcentaje de votos
function tec_get_percentage($candidate_sid,$status,$location_sid){
	global $wpdb;
	$query = "
		SELECT ROUND(
		(
			(
				SELECT COUNT(*)
				FROM candidate_vote_b
				WHERE candidate_sid = $candidate_sid
					AND poll_sid = (SELECT poll_id from poll_d WHERE location_sid = $location_sid and status_sid = $status )
				) * 100
		) / COUNT(*), 0) AS porcentaje
		FROM candidate_vote_b WHERE poll_sid = (SELECT poll_id from poll_d WHERE location_sid = $location_sid and status_sid = $status)
	";
	return $wpdb->get_results( $query, ARRAY_A );
}

// Function to get general percentage
function tec_get_general_percentage($status){
	global $wpdb;
	$query = "
		SELECT p.post_title as candidate
			,ROUND((COUNT(candidate_sid) * 100) / (
					SELECT COUNT(*)
					FROM candidate_vote_b
					), 0) AS percentage
		FROM candidate_vote_b c
		INNER JOIN wp_posts p ON c.candidate_sid = p.ID
		WHERE c.poll_sid = (
				SELECT poll_id
				FROM poll_d
				WHERE status_sid = (
						SELECT status_id
						FROM status_a
						WHERE description = '$status'
						)
				)
		GROUP BY c.candidate_sid;
	";

	return $wpdb->get_results( $query, ARRAY_A );
}

// Function to get the date of a poll
function tec_get_poll_dates($status){
	global $wpdb;
	$query = "
		SELECT DATE_FORMAT(start_date, '%d,%m,%Y') AS start_date
			,DATE_FORMAT(end_date, '%d,%m,%Y') AS end_date
		FROM poll_d
		WHERE status_sid = (
				SELECT status_id
				FROM status_a
				WHERE description = '$status'
				)
		AND location_sid = 2;

	";

	return $wpdb->get_results( $query, ARRAY_A );
};

function tec_insert_vote(){

	if ( isset( $_POST['ciudad'] ) ):
		
		global $wpdb;
		// Validando la ciudad
		$term = $_POST['term'];
		$ciudad = $_POST['ciudad'];
		$estado = $_POST['estado'];
		$pais = $_POST['pais'];
		$ip = $_POST['ip'];
		$candidate_sid = $_POST['candidate_sid'];
		$date = date('Y-m-d');
		$location_sid = tec_get_location_sid($term);
		$poll_sid = tec_get_poll_by_status('Activo',$location_sid[0]['term_id']);
		
		if ( $term != 'Nacional' ):
			//validar que sea igual el termino con la ciudad
			if ( $term == $estado ):
				tec_register_vote($candidate_sid,$ip,$pais,$estado,$ciudad,$date,$poll_sid,$location_sid[0]['term_id']);
			else:
				wp_send_json( array(
						'status' => __('ciudad', 'wpduf') 
					) 
				);
			endif; 		
		else:

			tec_register_vote($candidate_sid,$ip,$pais,$estado,$ciudad,$date,$poll_sid,$location_sid[0]['term_id']);

			endif;
	endif;
	
}

function tec_register_vote($candidate_sid,$ip,$pais,$estado,$ciudad,$date,$poll_sid,$location_sid){
	global $wpdb;
	// Verificar que no haya votado
	$existing_vote = tec_get_existing_vote($ip,'Activo',$location_sid);
	if( $existing_vote[0]['total_ip'] > 0 ):
		wp_send_json( array(
						'status' => __(0, 'wpduf') 
					) 
		);
	else:
		
		// global $wpdb;
		$insert = $wpdb->insert(
		'candidate_vote_b',
		array(
			'candidate_sid'		=> 	$candidate_sid,
			'user_ip'			=>	$ip,
			'user_country'		=>	$pais,
			'user_state'		=>	$estado,
			'user_municipality'	=>	$ciudad,
			'vote_date'			=>	$date,
			'poll_sid'			=>	$poll_sid[0]['poll_id']
		),
		array(
			'%d',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%d'
			)
		);


		wp_send_json( array(
			'status' => __($insert, 'wpduf') 
			) 
		);
	endif;
}



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
		wp_register_style( 'circle', get_bloginfo('template_url').'/css/circle.css', false, false, 'all' );
		wp_enqueue_script( 'sticky' );
		wp_enqueue_style( 'circle' );
	 }
}

add_action( 'wp_enqueue_scripts', 'tec_add_sticky');



// Funcion para cargar grafica general
function tec_add_chart(){
	$pages = array('home.php');
	if( is_front_page() ):
		// wp_register_script( 'chart-js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js', array( 'jquery' ), false, false );
		// wp_register_script( 'graph', get_bloginfo('template_url').'/js/graph.js' , array( 'jquery' ), false, false );
		// $data_url = get_site_url().'/data';
		// $admin = array('ajax_url' => $data_url );
		// wp_localize_script( 'graph', 'url', $admin );
		// jvector
	
		wp_register_style( 'jvector-css',  get_bloginfo('template_url').'/css/vectormap.css', false, false, 'all' );
		wp_register_script( 'jvector-js',  get_bloginfo('template_url').'/js/vectormap.js' , array( 'jquery' ), false, false );
		wp_register_script( 'map', get_bloginfo('template_url').'/js/map.js', array( 'jquery' ), false, false );
		

		// mapbox 
		/*
		wp_register_style( 'mapbox-css', 'https://api.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.css', false, false, 'all' );
		wp_register_script( 'mapbox-js', 'https://api.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.js' , array( 'jquery' ), false, false );
		*/

		wp_register_script( 'latest-api', get_bloginfo('template_url').'/js/latest-api.js' , array( 'jquery' ), false, false );

		// wp_enqueue_script( 'graph' );
		// wp_enqueue_script( 'chart-js' );
		// wp_enqueue_style( 'jvector-css' );
		wp_enqueue_script( 'latest-api' );
		// wp_enqueue_script( 'jvector-js' );
		// wp_enqueue_script( 'map' );
	endif;
}

add_action( 'wp_enqueue_scripts', 'tec_add_chart');



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

// Function to get all the polls
function tec_get_all_polls(){
	
	global $wpdb;
	$query="SELECT * FROM poll_d";
	return $wpdb->get_results( $query , OBJECT);
}

// Function to get the votes by candidate of a poll
function tec_get_candidate_votes($poll_sid){
	global $wpdb;
	$query="
		SELECT 
			c.candidate_sid,
			p.post_title,
			count(c.candidate_sid) AS total
		FROM candidate_vote_b c
		INNER JOIN wp_posts p ON p.ID = c.candidate_sid
		WHERE poll_sid = $poll_sid
		GROUP BY candidate_sid
		ORDER BY total DESC
			";
	return $wpdb->get_results( $query, OBJECT );
}

// Function to get votes of a candidate by municipality (state error insert)

function tec_get_candidate_votes_by_municipality($candidate_sid,$poll_sid){
	
	global $wpdb;
	
	$query = "
		SELECT user_municipality
			,user_state
			,COUNT(user_state) AS total
		FROM candidate_vote_b
		WHERE candidate_sid = $candidate_sid
			AND poll_sid = $poll_sid
		GROUP BY user_municipality
		ORDER BY total DESC
	";

	return $wpdb->get_results( $query, OBJECT );

}

// Function to change te redirect of the custom logo
add_filter( 'get_custom_logo', 'tec_change_logo_url' );

function tec_change_logo_url($html){

	$new_logo_url = 'https://seunonoticias.mx/';

	$search  = sprintf( '<a href="%s"', esc_url( home_url( '/' ) ) );
	$replace = sprintf( '<a target="_blank" href="%s"', esc_url( $new_logo_url ) );

	return str_replace( $search, $replace, $html );	
}

add_action( 'pre_get_posts', 'generate_random_category_posts' );
function generate_random_category_posts( $query ) {
if ( $query->is_main_query() ) {
	$query->set( 'orderby', 'rand' );
	}
}
