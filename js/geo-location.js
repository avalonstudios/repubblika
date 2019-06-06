var x = $("#ava-geolocation");

function getLocation(lat, lng, address) {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(
			function(p) {
				let userLat = p.coords.latitude;
				let userLng = p.coords.longitude;
				if ( getMobileOperatingSystem() === 'win' || getMobileOperatingSystem() === 'and' ) {
					let button = '<a class="btn btn-primary" href="https://www.google.com/maps/dir/' +
						userLat + ',' + userLng + '/' + address +
						'/@' + lat + ',' + lng + 'z" target="_blank"><i class="fas fa-directions"></i> Directions</a>';
					$('#directions-btn').html( button );
				} else if ( getMobileOperatingSystem() === 'ios' ) {
					let button = '<a class="btn btn-primary" href="http://maps.apple.com/?ll=' +
						lat + ',' + lng + '&t=k" target="_blank"><i class="fas fa-directions"></i> Directions</a>';
					$('#directions-btn').html( button );
				} else {
					let button = '<a class="btn btn-primary mr-2" href="https://www.google.com/maps/dir/' +
						userLat + ',' + userLng + '/' + address +
						'/@' + lat + ',' + lng + 'z" target="_blank"><i class="fas fa-directions"></i> Directions</a>';
					button += '<a class="btn btn-primary" href="http://maps.apple.com/?ll=' +
						lat + ',' + lng + '&t=k" target="_blank"><i class="fas fa-directions"></i> Directions</a>';
					$('#directions-btn').html( button );
				}
			}, showError);
	} else {
		x.html('Sorry, geolocation does not seem to be supported by this browser.');
	}
}

function showError(error) {
	switch(error.code) {
		case error.PERMISSION_DENIED:
			x.html("Sorry, you have denied the request access your Geolocation.");
			break;
		case error.POSITION_UNAVAILABLE:
			x.html("Sorry, location information is unavailable.");
			break;
		case error.TIMEOUT:
			x.html("Sorry, the request to get user location timed out.");
			break;
		case error.UNKNOWN_ERROR:
			x.html("Sorry, an unknown error occurred. Please, try refreshing the page.");
			break;
	}
}

function getMobileOperatingSystem() {
	var userAgent = navigator.userAgent || navigator.vendor || window.opera;

	// Windows Phone must come first because its UA also contains "Android"
	if (/windows phone/i.test(userAgent)) {
		return "win";
	}

	if (/android/i.test(userAgent)) {
		return "and";
	}

	// iOS detection from: http://stackoverflow.com/a/9039885/177710
	if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
		return "ios";
	}

	return "unknown";
}
