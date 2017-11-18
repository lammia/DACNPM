// var map;
// var myLatLng;
// $(document).ready(function(){
// 	geoLocationInit();

// 	function geoLocationInit(){
// 		if (navigator.geolocation) {
// 			navigator.geolocation.getCurrentPosition(success,fail);	
// 		}else{
// 			alert("Browser not supported");
// 		}
// 	}

// 	function success(position){
// 		console.log(position);
// 		var latval = position.coords.latitude;
// 		var lngval = position.coords.longitude;

// 		myLatLng = new google.maps.LatLng(latval, lngval);
// 		createMap(myLatLng);
// 		nearbySearch(myLatLng, "school");
// 	}

// 	function fail(){
// 		alert("it fails");
// 	}
	

// 	function createMap(myLatLng){
// 		var map = new google.maps.Map(document.getElementById('map'), {
// 	        center: myLatLng,
// 	        zoom: 12
//     	});

//     	var marker = new google.maps.Marker({
//     		position: myLatLng,
//     		map: map
//     	});
// 	}
    

//     function createMarker(latlng, icon, name){
// 	    var marker = new google.maps.Marker({
// 		    position: latlng,
// 		    map: map,
// 		    icon: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
// 		    title: name
// 	  	});
// 	}

// 	function nearbySearch(myLatLng, type){
// 		var request = {
// 		    location: myLatLng,
// 		    radius: '5000',
// 		    types: [type]
//   		};
//   		service = new google.maps.places.PlacesService(map);
// 		service.nearbySearch(request, callback);

// 		function callback(results, status) {
// 			console.log(results);
// 	  		if (status == google.maps.places.PlacesServiceStatus.OK) {
// 	    		for (var i = 0; i < results.length; i++) {
// 		      		var place = results[i];
// 		      		latlng = place.geometry.location;
// 		      		icn = place.icon;
// 		      		name = place.name;
// 		      		createMarker(latlng, icn, name);
// 	    		}
// 	  		}
// 	  	}
// 	}
    
// });


var geocoder;
var map;
var infowindow;

function initialize() {
  geocoder = new google.maps.Geocoder();
  
  var loca = new google.maps.LatLng(16.047079, 108.206230);

  map = new google.maps.Map(document.getElementById('map'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: loca,
    zoom: 12
  });
  google.maps.event.addListener(map, 'click', function(event){
  	document.getElementById("latlog").value = event.latLng;
  	
  });
}

function updateMarkerAddress(str) {
  document.getElementById('address').value = str;
}


function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {
  var placeLoc = place.geometry.location;
  var marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location
  });

  google.maps.event.addListener(marker, 'mouseover', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}

function codeAddress() {
  var address = document.getElementById("address").value;
  geocoder.geocode({
    'address': address
  }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: map,
        title: name,
        position: results[0].geometry.location
      });
      var request = {
        location: results[0].geometry.location,
        radius: 50000,
        name: 'ski',
        keyword: 'mountain',
        type: ['park']
      };
      infowindow = new google.maps.InfoWindow();
      var service = new google.maps.places.PlacesService(map);
      service.nearbySearch(request, callback);
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
