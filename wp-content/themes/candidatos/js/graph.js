jQuery(document).ready(function( $ ) {


	$.ajax({
		url: url.ajax_url,
		method: "GET",
		success: function(data) {
			console.log(data);
			var candidate = [];
			var percentage = [];

			for(var i in data) {
				candidate.push(data[i].candidate);
				percentage.push(data[i].percentage);
			}

			var chartdata = {
				labels: candidate,
				datasets : [
					{
						label: 'Porcentaje',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: percentage
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata,
				options:{
					  maintainAspectRatio: false,
					  height:200
				}
			});

		},
		error: function(data) {
			console.log(data);
		}
	});

});