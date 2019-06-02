jQuery( function ( $ ) {
	let args =	{
					MENU_WIDTH: 300,
				};
	$(".button-collapse").sideNav( args );
	// SideNav Scrollbar Initialization
	var sideNavScrollbar = document.querySelector( '.custom-scrollbar' );
	var ps = new PerfectScrollbar(sideNavScrollbar);
});