<?php 
	/* Template Name: Poll_municipality */ 
	if( is_user_logged_in() ):
	else:
		$location = get_site_url();
		wp_redirect( $location, 302 );
	endif;
	get_header( 'custom' );
	$poll_sid = $_GET['poll_sid'];
	$candidate_sid = $_GET['candidate_sid'];
	$states = tec_get_candidate_votes_by_municipality($candidate_sid,$poll_sid);
	
?>

<div class="container">
	<div class="row">
		<table>
			<thead>
				<tr>
					<th>Estado</th>
					<th>Municipio</th>
					<th>Votos</th>
          		</tr>
        	</thead>
        
        	<tbody>
        		<?php  
        			foreach($states as $state):
        		?>
          		<tr>
        			<td><?php echo $state->user_state; ?></td>
        			<td><?php echo $state->user_municipality; ?></td>
        			<td><?php echo $state->total; ?></td>
        			
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