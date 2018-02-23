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

// IMAGE METABOX
//init the meta box
add_action( 'after_setup_theme', 'custom_postimage_setup' );
function custom_postimage_setup(){
    add_action( 'add_meta_boxes', 'custom_postimage_meta_box' );
    add_action( 'save_post', 'custom_postimage_meta_box_save' );
}

function custom_postimage_meta_box(){

    //on which post types should the box appear?
    $post_types = array('post','page','candidato');
    foreach($post_types as $pt){
        add_meta_box('custom_postimage_meta_box',__( 'Imagenes secundarias', 'yourdomain'),'custom_postimage_meta_box_func',$pt,'side','low');
    }
}

function custom_postimage_meta_box_func($post){

    //an array with all the images (ba meta key). The same array has to be in custom_postimage_meta_box_save($post_id) as well.
    $meta_keys = array('second_featured_image','third_featured_image');

    foreach($meta_keys as $meta_key){
        $image_meta_val=get_post_meta( $post->ID, $meta_key, true);
        ?>
        <div class="custom_postimage_wrapper" id="<?php echo $meta_key; ?>_wrapper" style="margin-bottom:20px;">
            <img src="<?php echo ($image_meta_val!=''?wp_get_attachment_image_src( $image_meta_val)[0]:''); ?>" style="width:100%;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" alt="">
            <a class="addimage button" onclick="custom_postimage_add_image('<?php echo $meta_key; ?>');"><?php _e('Añadir imagen','yourdomain'); ?></a><br>
            <a class="removeimage" style="color:#a00;cursor:pointer;display: <?php echo ($image_meta_val!=''?'block':'none'); ?>" onclick="custom_postimage_remove_image('<?php echo $meta_key; ?>');"><?php _e('remove image','yourdomain'); ?></a>
            <input type="hidden" name="<?php echo $meta_key; ?>" id="<?php echo $meta_key; ?>" value="<?php echo $image_meta_val; ?>" />
        </div>
    <?php } ?>
    <script>
    function custom_postimage_add_image(key){

        var $wrapper = jQuery('#'+key+'_wrapper');

        custom_postimage_uploader = wp.media.frames.file_frame = wp.media({
            title: '<?php _e('Selecciona una imagen','yourdomain'); ?>',
            button: {
                text: '<?php _e('Selecciona una imagen','yourdomain'); ?>'
            },
            multiple: false
        });
        custom_postimage_uploader.on('select', function() {

            var attachment = custom_postimage_uploader.state().get('selection').first().toJSON();
            var img_url = attachment['url'];
            var img_id = attachment['id'];
            $wrapper.find('input#'+key).val(img_id);
            $wrapper.find('img').attr('src',img_url);
            $wrapper.find('img').show();
            $wrapper.find('a.removeimage').show();
        });
        custom_postimage_uploader.on('open', function(){
            var selection = custom_postimage_uploader.state().get('selection');
            var selected = $wrapper.find('input#'+key).val();
            if(selected){
                selection.add(wp.media.attachment(selected));
            }
        });
        custom_postimage_uploader.open();
        return false;
    }

    function custom_postimage_remove_image(key){
        var $wrapper = jQuery('#'+key+'_wrapper');
        $wrapper.find('input#'+key).val('');
        $wrapper.find('img').hide();
        $wrapper.find('a.removeimage').hide();
        return false;
    }
    </script>
    <?php
    wp_nonce_field( 'custom_postimage_meta_box', 'custom_postimage_meta_box_nonce' );
}

function custom_postimage_meta_box_save($post_id){

    if ( ! current_user_can( 'edit_posts', $post_id ) ){ return 'not permitted'; }

    if (isset( $_POST['custom_postimage_meta_box_nonce'] ) && wp_verify_nonce($_POST['custom_postimage_meta_box_nonce'],'custom_postimage_meta_box' )){

        //same array as in custom_postimage_meta_box_func($post)
        $meta_keys = array('second_featured_image','third_featured_image');
        foreach($meta_keys as $meta_key){
            if(isset($_POST[$meta_key]) && intval($_POST[$meta_key])!=''){
                update_post_meta( $post_id, $meta_key, intval($_POST[$meta_key]));
            }else{
                update_post_meta( $post_id, $meta_key, '');
            }
        }
    }
}














