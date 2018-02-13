<?php 
	/* Template Name: Home */ 
	get_header( 'custom' );
	

?>

<div class="row">
	<div class="col s12">
		<h4 class="center-align animated bounceInUp">Conoce a los candidatos</h4>
	</div>
</div>

<div class="container">
	<div class="row">

		<!-- Candidatos Nacionales -->
		<?php  
			

			$args = array(
					'post_type'		=>	'candidato',
					'tax_query' 	=> 	array(
						array(
							'taxonomy'	=>	'locacion',
							'field'		=>	'slug',
							'terms'		=>	'nacional',
							'operator'	=>	'IN'
						)

					)	
				);
			
			$filter_posts = new WP_Query($args); 
			if( $filter_posts->have_posts() ):
				while( $filter_posts->have_posts() ):
					$filter_posts->the_post();
					get_template_part( 'template-parts/content', 'card' );
				endwhile;
			endif;
			
			wp_reset_postdata(); 


		?>
		


		

		

		
			
	</div>
</div>
<?php  
get_footer( 'custom' );
?>