let position;
let marker;

function initMap() {
    let defaultLatLng = {lat: 42.842326386012516, lng: -2.691612846296414};

    let map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: defaultLatLng
    });

    google.maps.event.addDomListener(map, 'click', function( event ){
        if (typeof marker !== 'undefined') {
            marker.setMap(null);
        }

        position = {lat: event.latLng.lat(), lng: event.latLng.lng()};

        marker = new google.maps.Marker({
            position: position,
            map: map
        });
        console.log("Lat: " + position.lat)
        console.log("Long: " + position.lng)
    });
}





