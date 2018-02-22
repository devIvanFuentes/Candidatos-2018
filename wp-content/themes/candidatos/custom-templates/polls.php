<?php 
	/* Template Name: Polls */ 
	if( is_user_logged_in() ):
	else:
		$location = get_site_url();
		wp_redirect( $location, 302 );
	endif;
	get_header( 'custom' );
	$polls = tec_get_all_polls();
	
?>

<div class="container">
	<div class="row">
		<table>
			<thead>
				<tr>
					<th>Identificador</th>
					<th>Fecha Inicio</th>
					<th>Fecha Fin</th>
					<th>Acciones</th>
          		</tr>
        	</thead>
        
        	<tbody>
        		<?php  
        			foreach($polls as $poll):
        		?>

          		<tr>
            		<td><?php echo $poll->poll_id; ?></td>
            		<td><?php echo $poll->start_date; ?></td>
            		<td><?php echo $poll->end_date; ?></td>
            		<td><a href="<?php echo get_site_url().'/poll-candidates?poll_sid='.$poll->poll_id; ?>">Ver Votos</a></td>
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