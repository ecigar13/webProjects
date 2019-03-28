var map;
var service;
var infowindow;

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 8,
    center: {
      lat: -34.397,
      lng: 150.644
    }
  });
  var geocoder = new google.maps.Geocoder();
  infowindow = new google.maps.InfoWindow();

  document.getElementById('submit').addEventListener('click', function () {
    geocodeAddress(geocoder, map);
  });
}

function geocodeAddress(geocoder, resultsMap) {
  var address = document.getElementById('address').value;
  geocoder.geocode({
    'address': address
  }, function (results, status) {
    if (status === 'OK') {
      resultsMap.setCenter(results[0].geometry.location);
      var lng = results[0].geometry.location.lng();
      var lat = results[0].geometry.location.lat();
      var center = new google.maps.LatLng(lat, lng);

      var request = {
        location: center,
        radius: 1500,
        type: ['restaurant']
      };

      map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: center
      });
      service = new google.maps.places.PlacesService(map);
      service.nearbySearch(request, callback);

    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function callback(results, status) {
  if (status == google.maps.places.PlacesServiceStatus.OK) {
    for (var i = 0; i < results.length; i++) {
      var place = results[i];
      createMarker(results[i]);
    }
  }
}

function createMarker(place) {
  var marker = new google.maps.Marker({
    map: map,
    position: place.geometry.location
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.setContent(place.name);
    infowindow.open(map, this);
  });
}
