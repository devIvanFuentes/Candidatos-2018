<?php

function dwwp_register_post_type() {

	$singular = __( 'Candidato' );
	$plural = __( 'Candidatos' );
        //Used for the rewrite slug below.
        $plural_slug = str_replace( ' ', '_', $plural );

        //Setup all the labels to accurately reflect this post type.
	$labels = array(
		'name' 					=> $plural,
		'singular_name' 		=> $singular,
		'add_new' 				=> 'Añadir Nuevo',
		'add_new_item' 			=> 'Añadir nuevo ' . $singular,
		'edit'		        	=> 'Editar',
		'edit_item'	        	=> 'Editar ' . $singular,
		'new_item'	        	=> 'Nuevi ' . $singular,
		'view' 					=> 'Ver ' . $singular,
		'view_item' 			=> 'Ver ' . $singular,
		'search_term'   		=> 'Buscar ' . $plural,
		'parent' 				=> 'Padre ' . $singular,
		'not_found' 			=> $plural .' no encontrado',
		'not_found_in_trash' 	=> 'No existen' . $plural .' en la papelera'
	);

        //Define all the arguments for this post type.
	$args = array(
		'labels' 			  => $labels,
		'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'show_in_nav_menus'   => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon'           => 'dashicons-admin-users',
        'can_export'          => true,
        'delete_with_user'    => false,
        'hierarchical'        => false,
        'has_archive'         => true,
        'query_var'           => true,
        'capability_type'     => 'page',
        'map_meta_cap'        => true,
        // 'capabilities' => array(),
        'rewrite'             => array( 
        	'slug' => strtolower( $plural_slug ),
        	'with_front' => true,
        	'pages' => true,
        	'feeds' => false,

        ),
        'supports'            => array( 
        	'title',
          'thumbnail',
          'editor'
        )
	);

        //Create the post type using the above two varaiables.
	register_post_type( 'candidato', $args);
}
add_action( 'init', 'dwwp_register_post_type' );


function dwwp_register_taxonomy() {

	$plural = __( 'Locaciones' );
	$singular = __( 'Locacion' );


	$labels = array(
		'name'                       => $plural,
        'singular_name'              => $singular,
        'search_items'               => 'Buscar ' . $plural,
        'popular_items'              => 'Popular ' . $plural,
        'all_items'                  => 'Todas ' . $plural,
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Editar ' . $singular,
        'update_item'                => 'Actualizar ' . $singular,
        'add_new_item'               => 'Añadir nueva ' . $singular,
        'new_item_name'              => 'Nueva ' . $singular . ' Nombre',
        'separate_items_with_commas' => 'Separar ' . $plural . ' con comas',
        'add_or_remove_items'        => 'Añadir o remover ' . $plural,
        'choose_from_most_used'      => 'Elegir de las mas usadas ' . $plural,
        'not_found'                  => 'Ninguna ' . $plural . ' encontrada.',
        'menu_name'                  => $plural,
	);

	$args = array(
		'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => strtolower( $singular ) ),
	);

	register_taxonomy( strtolower( $singular ), 'candidato', $args );

}

add_action( 'init', 'dwwp_register_taxonomy' );

function dwwp_load_templates( $original_template ) {

       if ( get_query_var( 'post_type' ) !== 'job' ) {

               return;

       }

       if ( is_archive() || is_search() ) {

               if ( file_exists( get_stylesheet_directory(). '/archive-job.php' ) ) {

                     return get_stylesheet_directory() . '/archive-job.php';

               } else {

                       return plugin_dir_path( __FILE__ ) . 'templates/archive-job.php';

               }

       } elseif(is_singular('job')) {

               if (  file_exists( get_stylesheet_directory(). '/single-job.php' ) ) {

                       return get_stylesheet_directory() . '/single-job.php';

               } else {

                       return plugin_dir_path( __FILE__ ) . 'templates/single-job.php';

               }

       }else{
       	return get_page_template();
       }

        return $original_template;


}
// add_action( 'template_include', 'dwwp_load_templates' );
















