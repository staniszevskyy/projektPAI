<!DOCTYPE html>
<html>
<head>
    <title>Foodtruck Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <style>
        #map {
            height: 100%;
            width: 70%;
            border-radius: 30px;
            border:5px solid #d09995;

        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0px;
            padding: 10px;
            background-color: #E5C6C4;

        }
    </style>
</head>
<body>
<div id="map"></div>

<script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });

        var infoWindow = new google.maps.InfoWindow();
        // Change this depending on the name of your PHP or XML file
        downloadUrl('/?page=xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('foodtruck');

            Array.prototype.forEach.call(markers, function(markerElem) {
                var id = markerElem.getAttribute('id');

                var name = markerElem.getAttribute('name');
                var address = markerElem.getAttribute('address');

                var point = new google.maps.LatLng(
                    parseFloat(markerElem.getAttribute('lat')),
                    parseFloat(markerElem.getAttribute('lng')));


                var infowincontent = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = name
                infowincontent.appendChild(strong);
                infowincontent.appendChild(document.createElement('br'));

                var text = document.createElement('text');
                text.textContent = address
                infowincontent.appendChild(text);

                var marker = new google.maps.Marker({
                    map: map,
                    position: point,

                });
                marker.addListener('click', function() {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                });
            });
        });


    }

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2EumDPAlhLjDCKlzLwlTgBa1eePjvpnY&callback=initMap"
        async defer></script>
</body>
</html>