<?php $post_sid = get_the_ID(); ?>
<div class="related__card hoverable">
				<figure>
					<img src=" <?php the_post_thumbnail_url('thumbnail'); ?> ">
				</figure>

				<div class="related__information">
					<a href=" <?php echo the_permalink(); ?> " class="related__title"><?php the_title(); ?></a>
					<p class="related__party">
						<?php 
							$party =  get_post_meta( $post_sid , 'party_name' , true);
							echo($party); 
						?>
					</p>

					<div class="without-left-padding candidate__percent">
						<div class="progress">
							<div class="determinate" style="width: 70%"></div>
						</div>
						<p class="candidate__percent__number">90%</p>
					</div>


					<div class="candidate__actions candidateHeader-actions">
						<div class="candidate__more__container candidate__more__container-header">
							<a candidate-sid="<?php echo $post_sid; ?>" id="btn__vote" class="icon-like candidate__more__news btn__vote">
								Votar
							</a>
						
						</div>

						<div class="candidate__share-header">
							<a onclick="window.open(this.href, 'newwindow', 'width=600, height=600'); return false;" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();  ?>" class="icon-facebook-circled"> </a>
							<a onclick="window.open(this.href, 'newwindow', 'width=600, height=600'); return false;" target="_blank" href="https://twitter.com/home?status=<?php the_permalink();  ?>" class="icon-twitter-circled"></a>	
						</div>

					</div>


				
				</div>
			</div>