var geocoder;
var map;
var infowindow;
var markers = [];

function initialize() {
  geocoder = new google.maps.Geocoder();
  
  var loca = new google.maps.LatLng(16.047079, 108.206230);

  map = new google.maps.Map(document.getElementById('map'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: loca,
    zoom: 12
  });

  $('#address').on("blur", function(e){
    clearMarkers();
  	codeAddress();
  	
  });

  google.maps.event.addListener(map, 'click', function(event){
    document.getElementById("latlog").value = event.latLng;
    geocodePosition(event.latLng);
    clearMarkers();
    addMarker(event.latLng);
    
  });

}

function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
      }

function clearMarkers() {
  setMapOnAll(null);
  markers = [];
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
      markers.push(marker);
      var request = {
        location: results[0].geometry.location,
        radius: 50000,
        name: 'ski',
        keyword: 'mountain',
        type: ['park']
      };
      infowindow = new google.maps.InfoWindow();
      var service = new google.maps.places.PlacesService(map);
      
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
