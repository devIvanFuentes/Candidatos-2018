<?php 
	$post_sid = get_the_ID();
	$party_name = get_post_meta( $post_sid, 'party_name', true );
	$candidate_sid = get_post_meta( $post_sid, 'category_sid', true );
	$category_url = get_post_meta( $post_sid, 'category_slug', true );
	
	$party_sid = get_post_meta( $post_sid, 'second_featured_image', true );
	$party_image = wp_get_attachment_thumb_url( $party_sid );
	$location = wp_get_post_terms( $post_sid, 'locacion', $args );
	// print_r($location);
	$location_name = $location[0]->name;
	$location_sid = tec_get_location_sid($location_name);
	$porcentaje = tec_get_percentage($post_sid,'Activo',$location_sid[0]['term_id']);


?>
<div class="col s12 m6 l3">

			<div class="candidate hoverable animated fadeIn">
				<div class="candidate__image" style=" background-image: url( <?php the_post_thumbnail_url( 'post-thumbnail' ); ?> ); ">
					
					

					<div class="candidate__share">
						<a onclick="window.open(this.href, 'newwindow', 'width=600, height=600'); return false;" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();  ?>" class="icon-facebook-circled"> </a>
						<a onclick="window.open(this.href, 'newwindow', 'width=600, height=600'); return false;" target="_blank" href="https://twitter.com/home?status=<?php the_permalink();  ?>" class="icon-twitter-circled"></a>	
					</div>

				</div>
				<div class="candidate__description">
					<!-- <p class="candidate__party"><?php echo $party_name; ?></p> -->
					<a  class="candidate__title"> <?php the_title(); ?> </a>
				</div>

				<div class="candidate__percent">
					<div class="progress">
						<div class="determinate" style="width: <?php echo $porcentaje[0]['porcentaje']; ?>%"></div>
					</div>
					<p class="candidate__percent__number"><?php echo $porcentaje[0]['porcentaje'].'%'; ?></p>
				</div>
				
				<!-- <?php  
					$news = tec_get_posts( $candidate_sid , 1);
					foreach ($news as $new) {
						$title = $new['title']['rendered'];
						$image = $new['better_featured_image']['media_details']['sizes']['thumbnail']['source_url'];
						$url = $new['guid']['rendered'];

						include(locate_template('template-parts/candidate-thumb.php'));
					}
				?> -->

				

				
				

				<div class="candidate__actions">
					<div class="candidate__more__container">
						<a style="padding: 5px 20px;" candidate-url=" <?php the_permalink(); ?>" location-name="<?php echo $location_name; ?>"  candidate-sid="<?php echo $post_sid; ?>" id="btn__vote" class="icon-like candidate__more__news btn__vote full__btn">
							Votar
						</a>
						
					</div>

					


					
				</div>

			</div>
		
		</div>