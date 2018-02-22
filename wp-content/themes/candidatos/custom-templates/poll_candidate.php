<?php 
	/* Template Name: Poll_candidate */ 
	if( is_user_logged_in() ):
	else:
		$location = get_site_url();
		wp_redirect( $location, 302 );
	endif;
	get_header( 'custom' );
	$poll_sid = $_GET['poll_sid'];
	$candidates = tec_get_candidate_votes($poll_sid);
	
?>

<div class="container">
	<div class="row">
		<table>
			<thead>
				<tr>
					<th>Candidato</th>
					<th>Votos</th>
          		</tr>
        	</thead>
        
        	<tbody>
        		<?php  
        			foreach($candidates as $candidate):
        		?>
          		<tr>
        			<td>
        				<a href="<?php echo get_site_url().'/poll-municipality?candidate_sid='.$candidate->candidate_sid.'&poll_sid='.$poll_sid; ?>">
        					<?php echo $candidate->post_title; ?>
        				</a>
        			</td>
        			<td><?php echo $candidate->total; ?></td>
          		</tr>
            		
        		
        		<?php
        			endforeach;
        		?>
        	</tbody>
      	</table>
            
	</div>
</div>


<?php  
get_footer( 'custom' );
?>