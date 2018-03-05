<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package candidatos
 */

?>

<section class="no-results not-found">
	<div class="container">
		<div class="row">
			
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'No se encontraron elementos', 'candidatos' ); ?></h1>
			</header><!-- .page-header -->

	<div class="page-content">
		
			
			
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'candidatos' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Lo sentimos, No encontramos ningun elemento', 'candidatos' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'Prueba buscando en el formulario de búsqueda.', 'candidatos' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
			</div>
		</div>
	</div><!-- .page-content -->
</section><!-- .no-results -->
