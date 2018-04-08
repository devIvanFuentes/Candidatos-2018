<?php
/**
 * The template for displaying taxonomy pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package candidatos
 */

get_header( 'custom' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">
		<?php
		if ( have_posts() ) : ?>
			<div class="col s12">
				
				<header class="page-header">
					<?php
						$title = get_the_archive_title();
						$title = explode(':', $title);
						// the_archive_title( '<h1 class="page-title">', '</h1>' );
						$description =  get_the_archive_description();
						
					?>
					<h1 class="page-title">
						Candidatos: <?php echo $title[1];  ?>
				</header><!-- .page-header -->
			
			</div>

			
					
				
			<?php
			/* Start the Loop */
			
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				
				get_template_part( 'template-parts/content-card', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
			</div>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer( 'custom' );
