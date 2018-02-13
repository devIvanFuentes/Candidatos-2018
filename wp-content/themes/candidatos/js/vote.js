jQuery(document).ready(function( $ ) {

	$('.btn__vote').click(function(e){
		e.preventDefault();
		var candidate_sid = $(this).attr('candidate-sid');
			

		var geocoder;
		geocoder = new google.maps.Geocoder();
		function getLocation() {
    		if (navigator.geolocation) {
        		navigator.geolocation.getCurrentPosition(showPosition,error);
    		} else {
        		// x.innerHTML = "Geolocation is not supported by this browser.";
        		alert('Geolocation is not supported by this browser.');
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
                    city= results[0].address_components[i];
                    console.log(city);
                    console.log('posicion:' + i);
                    // break;
                }

                if (results[0].address_components[i].types[b] == "locality") {
                    //this is the object you are looking for
                    state= results[0].address_components[i];
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
        alert(city.short_name + " " + city.long_name);
        alert(state.short_name + " " + state.long_name);
        alert(country.short_name + " " + country.long_name);
        // Obteniendo la ip
        $.getJSON("http://ip-api.com/json/?callback=?", function(data) {
        	var ip = data['query'];
        	alert(ip);
        	alert(candidate_sid);	
        });




        } else {
          alert("No results found");
        }
      } else {
        alert("Geocoder failed due to: " + status);
      }
    });
  }

		getLocation();	
		
	});
	
 
});