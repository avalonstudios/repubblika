//@prepros-append 'googlemapsapi.js';
//@prepros-append 'geo-location.js';
jQuery( function ( $ ) {
	let args =	{
					MENU_WIDTH: 300,
				};
	$(".button-collapse").sideNav( args );
	// SideNav Scrollbar Initialization
	var sideNavScrollbar = document.querySelector( '.custom-scrollbar' );
	var ps = new PerfectScrollbar(sideNavScrollbar);
	//$( 'select' ).materialSelect();

	makeButtons();

	if ( window.addtocalendar ) if ( typeof window.addtocalendar.start == "function" ) return;
	if ( window.ifaddtocalendar == undefined ) {
		window.ifaddtocalendar = 1;
		var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
		s.type = 'text/javascript';
		s.charset = 'UTF-8';
		s.async = true;
		s.src = ( 'https:' == window.location.protocol ? 'https' : 'http' ) + '://addtocalendar.com/atc/1.5/atc.min.js';
		var h = d[g]('body')[0];
		h.appendChild(s);
	}
});

function makeButtons() {
	$( 'input[type="submit"]' ).addClass( 'btn btn-primary' );
	$( 'button[type="submit"]' ).addClass( 'btn btn-primary' );
	$( '.checkout-button' ).addClass( 'btn btn-primary' );
}