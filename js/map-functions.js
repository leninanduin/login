var map, infoWindow, marker, geocoder;
var pos = { lat: '', lng: ''};

/**
 * setup the map funtionality: click listener and center the map in the given city
 * @return {null}
 */
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12
  });
  infowindow = new google.maps.InfoWindow;

  marker = new google.maps.Marker({
    map: map,
    draggable:true
  });
  geocoder = new google.maps.Geocoder();
  // center the in the visitor city
  if (typeof city !== 'undefined') {
    map.addListener('click', function(e) {
      updateMarkerAndForm(e.latLng);
    });

    geocoder.geocode( { 'address': city }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
          map.setCenter(results[0].geometry.location);
      } else {
          alert("Could not find location: " + city);
      }
    });
  } else if( pos.lat && pos.lng ) {
    setMarker(pos);
  }
}

function setMarker(_pos) {
  marker.setPosition(_pos);
  infowindow.setContent("You are here!");
  infowindow.open(map, marker);
  map.setZoom(17);
  map.panTo(_pos);
}

/**
 * update the marker to the given position
 * @param  {object} pos {lat,lng} object
 * @return {null}
 */
function updateMarkerAndForm(_pos) {
  setMarker(_pos);

  // get the readable address of a given position
  geocoder.geocode({'location': _pos}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        var add_c = results[0].address_components;
        fillAddress(add_c, _pos);
      } else {
        alert('No address found, try another place');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
  });

}

/**
 * [centers the map to the user location]
 * @return {null}
 */
function findMe() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      pos.lat = position.coords.latitude;
      pos.lng = position.coords.longitude;

      updateMarkerAndForm(pos);

    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

/**
 * fills the form inputs with the correspondig address element
 * @param  {array} address_components map with the address componets
 * @return {null}
 */
function fillAddress(address_components, _pos) {
  document.getElementById('address_line_1').value = address_components[1].long_name + ' ' + address_components[0].long_name;
  document.getElementById('city').value = address_components[2].long_name + ', ' + address_components[4].long_name;
  document.getElementById('zip').value = address_components[7].long_name;
  document.getElementById('state_or_region').value = address_components[5].long_name;
  document.getElementById('country').value = address_components[6].long_name;
  document.getElementById('lat').value = _pos.lat();
  document.getElementById('lng').value = _pos.lng();
}

function handleLocationError(browserHasGeolocation, infoWindow, _pos) {
  infoWindow.setPosition(_pos);
  infoWindow.setContent(browserHasGeolocation ?
                      'Error: The Geolocation service failed.' :
                      'Error: Your browser doesn\'t support geolocation.');
}