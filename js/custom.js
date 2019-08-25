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

	$( window ).on( 'load', onLoad );
	$( window ).on( 'resize', onResize );

	makeButtons();

	$( '.carousel.carousel-multi-item.v-2 .carousel-item' ).each( function() {
		var next = $( this ).next();
		if ( !next.length ) {
			next = $( this ).siblings( ':first' );
		}

		next.children( ':first-child' ).clone().appendTo( $( this ) );

		for ( var i = 0; i < 4; i++ ) {
			next=next.next();
			if ( !next.length ) {
				next=$( this ).siblings( ':first' );
			}
			next.children( ':first-child' ).clone().appendTo( $( this ) );
		}
	});

	$( '.ava-chart' ).each( function( i, e ) {
		let chartType = $(this).data( "chart-type" );
		if ( chartType == 'bar' ) {
			barChart($(this));
		} else if ( chartType == 'line' || chartType == 'radar' ) {
			lineChart($(this));
		}
	});

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

	toastr.options = {
		"closeButton": true,
		"debug": false,
		"newestOnTop": true,
		"progressBar": false,
		"positionClass": "md-toast-bottom-right",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": 300,
		"hideDuration": 1000,
		"timeOut": 5000,
		"extendedTimeOut": 1000,
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
	let clipboard = new ClipboardJS('.copy-btn');
	clipboard.on( 'success', ( e ) => {
		let alert = e.text;
		toastr[ "success" ]( alert, "Copied" );
		e.clearSelection();
	});
});

function onLoad() {
//	contentAndFooter();
}

function onResize() {
//	contentAndFooter();
}

function contentAndFooter() {
	let content = $( '#content' );
	let siteFooter = $( '#colophon' );

	let wH = $( window ).innerHeight();
	let menuHeight = $( '.navbar.main-navigation' ).outerHeight();
	let contentHeight = content.outerHeight();

	let totalHeight = menuHeight + contentHeight;

	if ( totalHeight < wH ) {
		siteFooter.addClass( 'fixed-bottom' );
	}
	content.css( 'margin-top', menuHeight + 'px' );

	/*let missionStatement = $( '.mission-statement' );
	let bottomBtns = $( '.bottom-buttons' );
	let bbHeight = bottomBtns.outerHeight();

	let msHeight = contentHeight - bbHeight + menuHeight;

	if ( missionStatement.length ) {
		missionStatement.css( 'height', '100vh' ).css( 'height', '-=' + msHeight + 'px' );
	}*/
}


function makeButtons() {
	$( 'input[type="submit"]' ).addClass( 'btn btn-primary' );
	$( 'button[type="submit"]' ).addClass( 'btn btn-primary' );
	$( '.checkout-button' ).addClass( 'btn btn-primary' );
}


function barChart( obj ) {
	let id 			= obj.data( "chart-id" );
	let type 		= obj.data( "chart-type" );
	let label 		= obj.data( "chart-label" );
	let labels 		= obj.data( "chart-labels" );
	let datas 		= obj.data( "chart-data" );
	let backcolor 	= obj.data( "chart-backcolor" );
	let bordercolor	= obj.data( "chart-bordercolor" );
	let borderwidth	= obj.data( "chart-borderwidth" );

	let barchart = document.getElementById( "bar_" + id ).getContext('2d');
	let myChart = new Chart( barchart, {
		type: 'bar',
		data: {
			labels: labels,
			datasets: [{
				label: label,
				data: datas,
				backgroundColor: backcolor,
				borderColor: 'red',
				borderWidth: borderwidth,
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
}

function splitter( string ) {
	//let data = Object.values(string);
	let split = string.split(',');
	return split;
}

window.getPieChart = function( data, id, chart_type ) {
	let parsedData = jQuery.parseJSON(data);
	if ( parsedData ) {

		let label = parsedData['line_labels'];
		let labelArr = label.split(',');
		let arrayLength = labelArr.length;

		let data = parsedData['data'];
		let datas = JSON.parse("[" + data + "]");

		let dataPoints = parsedData['lines_data_points'];
		let dataPointsLength = dataPoints.length;

		let backColArr = [];
		let hoverColArr = [];

		for ( let i = 0; i < dataPointsLength; i++ ) {
			let backColor = hexToRgb(
					dataPoints[i]['background_color'],
					dataPoints[i]['background_color_opacity']
				);
			backColArr.push(backColor);
			let hoverColor = hexToRgb(
					dataPoints[i]['background_color'],
					100
				);
			hoverColArr.push(hoverColor);
		}

		let chart = document.getElementById("piechart_" + id).getContext('2d');

		let newchart = new Chart(chart, {
				type: chart_type,
				data: {
					labels: labelArr,
					datasets: [{
							data: datas,
							backgroundColor: backColArr,
							hoverBackgroundColor: hoverColArr,
						}
					]
				},
				options: {
					responsive: true
				}
			});
	}
}


window.getBarChart = function( data, id, chart_type ) {
	let parsedData = jQuery.parseJSON(data);
	if ( parsedData ) {

		let label = parsedData['label'];
		let borderWidth = parsedData['border_width'];
		let barsArr = parsedData['chart_data'];
		let numOfBars = barsArr.length;

		let labelsArr = [];
		let dataArr = [];
		let backColArr = [];
		let backColOpArr = [];
		let borderColArr = [];

		for ( let i = 0; i < numOfBars; i++ ) {
			labelsArr.push( barsArr[i]['labels'] );
			dataArr.push( barsArr[i]['data'] );
			let backgroundColor = hexToRgb(
					barsArr[i]['background_color'],
					barsArr[i]['background_color_opacity']
				);
			let borderColor = hexToRgb(
					barsArr[i]['background_color'],
					100
				);
			backColArr.push( backgroundColor );
			borderColArr.push( borderColor );
		}

		let barchart = document.getElementById("barchart_" + id).getContext('2d');

		let barChart = new Chart(barchart, {
				type: chart_type,
				data: {
					labels: labelsArr,
					datasets: [{
						label: label,
						data: dataArr,
						backgroundColor: backColArr,
						borderColor: borderColArr,
						borderWidth: borderWidth,
					}],
				},
				options: {
					responsive: true
				}
			});
	}
}


window.getLineRadarChart = function( data, id, chart_type ) {
	let parsedData = jQuery.parseJSON(data);
	if ( parsedData ) {

		let label = parsedData['line_labels'];
		let labelArr = label.split(',');
		let arrayLength = labelArr.length;

		let borderWidth = parsedData['border_width'];
		let labels = parsedData['labels'];
		let labelsArr = labels.split(',');

		let dataPoints = parsedData['lines_data_points'];
		let dataPointsLength = dataPoints.length;

		let datasets = [];

		for ( let i = 0; i < arrayLength; i++ ) {
			let dataset = {};
			let backColor = hexToRgb(
					dataPoints[i]['background_color'],
					dataPoints[i]['background_color_opacity']
				);
			let borderColor = hexToRgb(
					dataPoints[i]['background_color'],
					100
				);
			let datas = dataPoints[i]['data'];
			dataset['label'] = labelArr[i];
			dataset['data'] = JSON.parse("[" + datas + "]");
			dataset['backgroundColor'] = backColor;
			dataset['borderColor'] = borderColor;
			dataset['borderWidth'] = borderWidth;
			datasets.push(dataset);
		}

		let linechart = document.getElementById("lineradarchart_" + id).getContext('2d');

		let lineChart = new Chart(linechart, {
				type: chart_type,
				data: {
					labels: labelsArr,
					datasets: datasets,
				},
				options: {
					responsive: true
				}
			});
	}
}

function hexToRgb( hex, op ) {
	// Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
	var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
	hex = hex.replace(shorthandRegex, function(m, r, g, b) {
		return r + r + g + g + b + b;
	});

	let opacity = 100;
	opacity = op / 100;

	var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	if ( result ) {
		let r = parseInt(result[1], 16);
		let g = parseInt(result[2], 16);
		let b = parseInt(result[3], 16);
		return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + opacity + ')';
	}
}