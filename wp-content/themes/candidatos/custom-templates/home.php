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
	 <!-- <div id="vmap" style="width: 100%; height: 450px;"></div> -->
	<!-- 
	<div class="col s12">

		<h4 class="center-align animated bounceInUp title">Elecciones 2018 #SéUnoNoticias</h4>
		<h5 class="center-align animated bounceInUp title">Si esta semana fueran las elecciones, ¿Por qué candidato votarías?</h5>
	</div>

	 -->
	 	



	<div class="col s12">
		<h4 class="center-align animated bounceInUp title">Conoce a los candidatos</h4>
	</div>

</div>

<div class="container">
	<div class="row desktop__candidate">

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
					$post_sid = get_the_ID();
					$party_name = get_post_meta( $post_sid, 'party_name', true );
					
					get_template_part( 'template-parts/content', 'card' );
				
				endwhile;
			endif;
			
			wp_reset_postdata(); 


		?>

	</div>

	<div class="row movile__candidate">

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
					$post_sid = get_the_ID();
					$party_name = get_post_meta( $post_sid, 'party_name', true );
					
					get_template_part( 'template-parts/content', 'related' );
				
				endwhile;
			endif;
			
			wp_reset_postdata(); 


		?>
		
	</div>
	
	<div class="row">

		<div class="col s12">
			<h4 class="center-align animated bounceInUp title">
				Últimas noticias #elecciones 2018
			</h4>
		</div>

		<?php 

			get_template_part( 'template-parts/content', 'latestNews' );
		 ?>
		

		<?php 
	 		// echo do_shortcode('[mapsvg id="53"]');
	 	 ?>


	 	 <div class="col s12">
			<h4 class="center-align animated bounceInUp title">
				Resultados otras encuestas
			</h4>

			<?php 
				get_template_part( 'template-parts/content', 'vendor_poll' );
			?>

			<?php  
				get_template_part( 'template-parts/content','line_poll');
			?>
		</div>


		
			
	</div>
</div>
<?php  
get_footer( 'custom' );
?>