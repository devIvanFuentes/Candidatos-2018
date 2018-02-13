<?php

function dwwp_add_custom_metabox() {

	add_meta_box(
		'dwwp_meta',
		__( 'API' ),
		'dwwp_meta_callback',
		'candidato',
		'normal',
		'core'
	);

}

add_action( 'add_meta_boxes', 'dwwp_add_custom_metabox' );

function dwwp_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'dwwp_jobs_nonce' );
	$dwwp_stored_meta = get_post_meta( $post->ID ); ?>

	<div>
		<div class="meta-row">
			<div class="meta-th">
				<label for="job-id" class="dwwp-row-title"><?php _e( 'Category ID', 'wp-job-listing' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content" name="category_sid" id="job-id"
				value="<?php if ( ! empty ( $dwwp_stored_meta['category_sid'] ) ) {
					echo esc_attr( $dwwp_stored_meta['category_sid'][0] );
				} ?>"/>
			</div>
		</div>
	</div>


		<div class="meta-row">
			<div class="meta-th">
				<label for="party_name" class="dwwp-row-title"><?php _e( 'Partido Político', 'wp-job-listing' ); ?></label>
			</div>

			<div class="meta-td">
					<input type="text" class="dwwp-row-content" name="party_name" id="party_name"
					value="<?php if ( ! empty ( $dwwp_stored_meta['party_name'] ) ) {
						echo esc_attr( $dwwp_stored_meta['party_name'][0] );
					} ?>"/>
				</div>
			</div>
		</div>
		
		
		
		
		
	    
	    	
	<?php
}

function dwwp_meta_save( $post_id ) {
	// Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'dwwp_jobs_nonce' ] ) && wp_verify_nonce( $_POST[ 'dwwp_jobs_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if ( isset( $_POST[ 'category_sid' ] ) ) {
    	update_post_meta( $post_id, 'category_sid', sanitize_text_field( $_POST[ 'category_sid' ] ) );
    }
    if ( isset( $_POST[ 'party_name' ] ) ) {
    	update_post_meta( $post_id, 'party_name', sanitize_text_field( $_POST[ 'party_name' ] ) );
    }
    
}
add_action( 'save_post', 'dwwp_meta_save' );







