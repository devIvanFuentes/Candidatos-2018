
jQuery(document).ready(function( $ ) {
	// 992px

		function desktopSticky(x) {
	    	if (x.matches) { // If media query matches
	        	window.onscroll = function() {stickyFunction()};
	    	} 
		}

	var x = window.matchMedia("(min-width: 992px)")
	desktopSticky(x) // Call listener function at run time
	x.addListener(desktopSticky) // Attach listener function on state changes



	// Get the navbar
	var navbar = document.getElementById("stickyPublicity");


	// Get the offset position of the navbar
	var sticky = navbar.offsetTop;


	// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
	function stickyFunction() {
	  if (window.pageYOffset >= (sticky + 500) ) {
	    navbar.classList.add("fixed__related")
	  } else {
	    navbar.classList.remove("fixed__related");
	  }
	}

});