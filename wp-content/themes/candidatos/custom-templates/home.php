<?php 
	/* Template Name: Home */ 
	get_header( 'custom' );
	

?>

<div class="row">
	<!-- 

	<div class="col s12">
		<h4 class="center-align animated bounceInUp">Elecciones 2018 #SéUnoNoticias</h4>
		<p class="center-align animated bounceInUp">Siesta semana fueran las elecciones, ¿Por qué candidato votarías?</p>
	</div>
	
	<div id="chart-container">
			<canvas id="mycanvas" width="100%" height="200px"></canvas>
	</div>
	 -->

	<div class="col s12">
		<h4 class="center-align animated bounceInUp title">Conoce a los candidatos</h4>
	</div>

</div>

<div class="container">
	<div class="row">

		<!-- Candidatos Nacionales -->
		<?php  
			

			$args = array(
					'post_type'		=>	'candidato',
					'orderby' 		=> 	'rand',
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
		

		<div class="col s12">
			<h4 class="center-align animated bounceInUp title">
				Últimas noticias #elecciones 2018
			</h4>
		</div>

		<?php 

			get_template_part( 'template-parts/content', 'latestNews' );
		 ?>
		

		

		
			
	</div>
</div>
<?php  
get_footer( 'custom' );
?>