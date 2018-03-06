jQuery(document).ready(function( $ ) {

	$(".button-collapse").sideNav();

  // Obteniendo localización para mostrar alertas
	// BREAKING NEWS
	$.getJSON("https://seunonoticias.mx/wp-json/wp/v2/posts?categories=10681&per_page=10", function(data) {

        console.log(data);

        var comillas='"';
        var noticias = "";
        for (var i = 0; i <= 9 ; i++) {
        
       	// $('#news-post').append('<a class ="news-item" href="'+data[i]['link']+'"><div class="col s12 m6 l4"><div class="card"><div class="card-image"><img src="'+data[i]['better_featured_image']['media_details']['sizes']['medium']['source_url']+'"><span class="card-title">'+data[i]['title']['rendered']+'</span></div><div class="card-content">'+data[i]['excerpt']['rendered']+'</div><div class="card-action"><a href="'+data[i]['link']+'">Leer Nota</a></div></div></div></a>');
        // $('.ti_content').css('display','none');
        // $('#breaking-news').append("<a  class='b-item icon-news' target='_BLANK' href='"+data[i]["link"]+"'> "+data[i]['title']['rendered']+" </a>");


        $('.ti_content').html("<div class='ti_news'><a target='_BLANK' class='icon-bolt' href='"+data[i]["link"]+"'>"+data[i]['title']['rendered']+"</a></div>");
        
          noticias = noticias + "<div class='ti_news'><a target='_BLANK' class='icon-bolt' href='"+data[i]["link"]+"'>"+data[i]['title']['rendered']+"</a></div>";
        }
        //var inicio = "<div class='ti_content' id='#breaking-news'>"
          $('.ti_content').html(noticias);
         _Ticker = $(".TickerNews").newsTicker();


        //$('.ti_content').css('display','block');
      });



 
});