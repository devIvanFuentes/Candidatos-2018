jQuery(document).ready(function( $ ) {

	$('.btn__vote').click(function(e){
		e.preventDefault();
		var candidate_sid = $(this).attr('candidate-sid');
		var candidate_url = $(this).attr('candidate-url');
			

		var geocoder;
		geocoder = new google.maps.Geocoder();
		function getLocation() {
    		if (navigator.geolocation) {
        		navigator.geolocation.getCurrentPosition(showPosition,error);
    		} else {
        		// x.innerHTML = "Geolocation is not supported by this browser.";
        		// alert('Geolocation is not supported by this browser.');
        		
        		swal({
			  		type: 'error',
			  		title: 'Oops...',
			  		text: 'Tu navegador no soporta la geolocalizacion, actualizalo'
				});
    		}
		}

		function showPosition(position) {
   			 // x.innerHTML = "Latitude: " + position.coords.latitude + 
   			 // "<br>Longitude: " + position.coords.longitude;
   			 var lat = position.coords.latitude;
   			 var lng =  position.coords.longitude;
   			 // alert('Latitud: ' + position.coords.latitude + ' Longitud: ' + position.coords.longitude);
   			 codeLatLng(lat, lng) 
		}



		function error(){
			alert('Para poder votar necesitamos conocer tu ubicacion');
			swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'Para poder votar necesitamos conocer tu ubicacion'
			});
		}


  function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      console.log(results)
        if (results[1]) {
         //formatted address
        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            	for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    state= results[0].address_components[i];
                    console.log(state);
                    console.log('posicion:' + i);
                    // break;
                }

                if (results[0].address_components[i].types[b] == "locality") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    // break;
                }

                if (results[0].address_components[i].types[b] == "country") {
                    //this is the object you are looking for
                    country= results[0].address_components[i];
                    // break;
                }
            }
        }

        //city data
        // alert(city.short_name + " " + city.long_name);
        // alert(state.short_name + " " + state.long_name);
        // alert(country.short_name + " " + country.long_name);

        // country.short_name = 'USA';

        console.log('Ciudad: ' + city.long_name);
  		console.log('Estado: ' + state.long_name );
  		console.log('Pais: ' + country.short_name);
	                  

       
        console.log('obteniendo la ip');

        // Obteniendo la ip
        $.getJSON("https://api.ipify.org?format=jsonp&callback=?", function(data) {
        	console.log('entando a la ip');
        	console.log(data.ip);
        	var ip = data.ip;
        	// alert(ip);
        	// console.log(ip);
        	// alert(candidate_sid);

        	// AJAX

	        $.ajax({
	               type : "post",
	               url : url.ajax_url,
	               data : {
	               	  ciudad:city.long_name,
	                  estado:state.short_name,
	                  pais:country.short_name,
	                  ip:ip,
	                  candidate_sid:candidate_sid,
	                  action: 'tec_insert_vote'
	               },
	               success: function(response) {
	               	console.log(response);

	               	if( response['status'] != false ){
	               		swal(
  							'Excelente',
  							'Tu voto ha sido registrado',
  							'success'
						).then((result)=>{
							swal({
					  			title: 'Comparte tu voto',
					  			html:
					    		`<div class="candidate__share-alert">
									<a onclick="window.open(this.href, 'newwindow', 'width=600, height=600'); return false;" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=${candidate_url}" class="icon-facebook-circled"> </a>
									<a onclick="window.open(this.href, 'newwindow', 'width=600, height=600'); return false;" target="_blank" href="https://twitter.com/home?status=${candidate_url}" class="icon-twitter-circled"></a>	
								</div>`,
					  			showCloseButton: true,
					  			confirmButtonText:'Cerrar'
					  
							}).then((result)=>{
								location.reload();
							});
						});
	               	}else{
	               		swal(
  							'Lo sentimos',
  							'Ya votaste en esta encuesta regresa la proxima semana',
  							'error'
						).then((result)=>{
							swal({
					  			title: 'Comparte tu voto',
					  			html:
					    		`<div class="candidate__share-alert">
									<a onclick="window.open(this.href, 'newwindow', 'width=600, height=600'); return false;" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=${candidate_url}" class="icon-facebook-circled"> </a>
									<a onclick="window.open(this.href, 'newwindow', 'width=600, height=600'); return false;" target="_blank" href="https://twitter.com/home?status=${candidate_url}" class="icon-twitter-circled"></a>	
								</div>`,
					  			showCloseButton: true,
					  			confirmButtonText:'Cerrar'
					  
							})
						});



	               	}
	                 

	                  console.log(response);
	               },
	               error: function(response){
	                   swal(
	                     'Lo sentimos!',
	                     'No se pudo procesar tu voto',
	                     'error'
	                  )
	               }
	         })

	        // END AJAX	
	        });

    

        




        } else {
          // alert("No results found");
          swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'No se pudo registrar tu voto'
			});
        }
      } else {
        // alert("Geocoder failed due to: " + status);
        swal({
			  type: 'error',
			  title: 'Oops...',
			  text: 'No se pudo registrar tu voto'
			});
      	}
    });
  }

		getLocation();	
		
	});
	
 
});