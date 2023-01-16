<div class="ratio-container ratio-container--16:10 map" id="js-map"></div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5mihvHkgnNaRyHnz4xGx73zKfdX4JSjE&callback=initMap&v=weekly" defer></script>
<script>
function initMap() {

  var styles = [
      {
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#f5f5f5"
        }
      ]
    },
    {
      "elementType": "labels.icon",
      "stylers": [
        {
          "visibility": "off"
        }
      ]
    },
    {
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#000000"
        }
      ]
    },
    {
      "elementType": "labels.text.stroke",
      "stylers": [
        {
          "color": "#f5f5f5"
        }
      ]
    },
    {
      "featureType": "administrative.land_parcel",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#bdbdbd"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#eeeeee"
        }
      ]
    },
    {
      "featureType": "poi",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#757575"
        }
      ]
    },
    {
      "featureType": "poi.park",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#e5e5e5"
        }
      ]
    },
    {
      "featureType": "poi.park",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#9e9e9e"
        }
      ]
    },
    {
      "featureType": "road",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#ffffff"
        }
      ]
    },
    {
      "featureType": "road.arterial",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#757575"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#dadada"
        }
      ]
    },
    {
      "featureType": "road.highway",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#000000"
        }
      ]
    },
    {
      "featureType": "road.local",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#9e9e9e"
        }
      ]
    },
    {
      "featureType": "transit.line",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#e5e5e5"
        }
      ]
    },
    {
      "featureType": "transit.station",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#eeeeee"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "geometry",
      "stylers": [
        {
          "color": "#c9c9c9"
        }
      ]
    },
    {
      "featureType": "water",
      "elementType": "labels.text.fill",
      "stylers": [
        {
          "color": "#9e9e9e"
        }
      ]
    }
    ];


  const latLng = { lat: 47.38904320283179, lng: 8.524579610686503 };

  const map = new google.maps.Map(document.getElementById("js-map"), {
    zoom: 14,
    center: latLng,
  });
  map.setOptions({styles: styles});
 
  const marker = new google.maps.Marker({
    position: latLng,
    map: map,
    icon: {
      //anchor: new google.maps.Point(0,0),
      anchor: new google.maps.Point(0,0),
      url: 'data:image/svg+xml;utf-8, \
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 54" fill="none"><rect x="0.886154" y="46.7674" width="60" height="10" rx="2" transform="rotate(-50 0.886154 46.7674)" fill="black"/><rect x="8.54659" y="0.804733" width="60" height="10" rx="2" transform="rotate(50 8.54659 0.804733)" fill="black"/></svg>',
      scaledSize: new google.maps.Size(30, 34)
    }
  });
}

window.initMap = initMap;
</script>
