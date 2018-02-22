jQuery(document).ready(function( $ ) {
	//Obtenitnedo últimas noticias
	let url = "https://seunonoticias.mx/wp-json/wp/v2/posts?categories=10681&per_page=6";
	$.getJSON( url, function(response) {
  		// alert('cargando');
	})
  	.done(function(response) {
    	// console.log( response );
    	$('#loader__latest__news').css('display','none');
    	$.each(response, function(key, value){
	    	
	    	let news = `
	    		<div class="col s12 m6 l4">
					<div class="theNews hoverable" style="background-image: url( ' ${value['better_featured_image']['media_details']['sizes']['thumbnail']['source_url']} ' );" onclick="window.open('${value['guid']['rendered']}','_blank')">
						<div class="theNews__content">
							<p class="title__news">${value['title']['rendered']}</p>

						</div>		
					</div>
				</div>
	    	`;


    		// console.log(value['id']);
    		$(news).appendTo('#latest_news_2018');
    	})
    	
    	
  	})
  	.fail(function(response) {
  		console.log("Error");
    	$(`<p class="center-align">No se pueden mostrar las últimas noticias, intenta más tarde</p>`).appendTo("#loader__latest__news");	
  	})

});