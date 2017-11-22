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
  	geocodePosition(event.latLng);
  	addMarker(event.latLng);
  	
  });

}

function addMarker(location) {
    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
    markers.push(marker);
}

function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
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
      // service.nearbySearch(request, callback);
      
      google.maps.event.addListener(marker, 'mouseover', function() {
	    infowindow.setContent(results[0].geometry.location);
	    infowindow.open(map, this);
	  });

      document.getElementById("latlog").value = results[0].geometry.location;
      
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  });
}



google.maps.event.addDomListener(window, 'load', initialize);
