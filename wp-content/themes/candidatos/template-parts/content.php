<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package candidatos
 */

$post_sid = get_the_ID();
$candidate_sid = get_post_meta( $post_sid, 'category_sid', true );
$terms = wp_get_post_terms( $post_sid, 'locacion' );

// print_r($terms);

$term = $terms[0]->slug;

// echo $term->slug;


?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php get_template_part( 'template-parts/candidate', 'header' ); ?>

	

	<div class="row" id="stickyRelated">
		<div class="col s12 l8">
			<div class="entry-content candidateContent">
				<?php
					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'candidatos' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'candidatos' ),
						'after'  => '</div>',
					) );
				?>
			<h4>Últimas noticias</h4>
			<div class="row" id="latestNews" candidate-sid=" <?php echo $candidate_sid; ?> ">
				<?php  
					$news = tec_get_posts( $candidate_sid , 4); 
					foreach ($news as $new) {
						$title = $new['title']['rendered'];
						$image = $new['better_featured_image']['media_details']['sizes']['thumbnail']['source_url'];
						$url = $new['guid']['rendered'];

						include(locate_template('template-parts/candidate-api.php'));
					}
				?>
				
			</div>

			<div class="row">
				
				<?php
				  

					$args = array(
							'orderby' => 'rand',
							'posts_per_page' => 2,
							'post__not_in' 	=>	array( $post_sid ),
							'post_type'		=>	'candidato',
							'tax_query' 	=> 	array(
								array(
									'taxonomy'	=>	'locacion',
									'field'		=>	'slug',
									'terms'		=>	$term,
									'operator'	=>	'IN'
								)

							)	
						);
					
					$filter_posts = new WP_Query($args); 
					if( $filter_posts->have_posts() ):
						$count = 0;
						while( $filter_posts->have_posts() ):
							$filter_posts->the_post();
							include(locate_template('template-parts/candidate-nav.php'));
							$count ++;
						endwhile;
					endif;
					
					wp_reset_postdata(); 


				?>
				


			</div>

			</div><!-- .entry-content -->


		</div>

		<div class="col s12 l4 relatedMain" id="RelatedCandidates">
			
			<div class="related" >
				<div class="sub-title">
					<h5>Conoce a los candidatos</h5>
				</div>

				<?php
				  

					$args = array(
							'post__not_in' 	=>	array( $post_sid ),
							'post_type'		=>	'candidato',
							'tax_query' 	=> 	array(
								array(
									'taxonomy'	=>	'locacion',
									'field'		=>	'slug',
									'terms'		=>	$term,
									'operator'	=>	'IN'
								)

							)	
						);
					
					$filter_posts = new WP_Query($args); 
					if( $filter_posts->have_posts() ):
						while( $filter_posts->have_posts() ):
							$filter_posts->the_post();
							get_template_part( 'template-parts/content', 'related' );
						endwhile;
					endif;
					
					wp_reset_postdata(); 


				?>

				

				
			</div>

			<div class="col s12 l4" id="stickyPublicity">
				<p>Publicidad</p>		
			</div>
		</div>
	
	</div>

	


</article><!-- #post-<?php the_ID(); ?> -->
