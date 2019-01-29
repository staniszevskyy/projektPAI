<!DOCTYPE html>
<html>
<head>
    <title>Foodtruck Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <style>

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
<?php
    require_once __DIR__.'/../../model/FoodtruckMapper.php';
    $get = new FoodtruckMapper();


    if (isset($_POST['search']) and $_POST['search']!=""){
        var_dump($_POST['search']);
        $get->getCertainFoodtrucks($_POST['search']);

    }

    else{
        $get->getAllFoodtrucks();
    }
    $get = $get->getFoodtruckList();
    unset($_POST['search']);

?>


<div id="map"></div>

<div id="list">
    <div class="card" >
        <div class="card-body">
            <h5 class="card-title">Wyszukaj foodtruck</h5>
            <form  action="?page=search" method="POST">
                <div class="form-group">

                <div class="input-group">

                    <input type="text" class="form-control" id="search" name="search" aria-describedby="emailHelp" placeholder="Wpisz wyszukiwaną nazwę lub adres" >
                        <span class="input-group-btn">
                        <button class="btn btn-dark" type="submit" ><i class="fas fa-search"></i>
                        </button>
                        </span>

                </div>
                </div>
            </form>




            <ul class="list-group">
                <?php foreach($get as $key=>$value): ?>
                    <a onclick="foodtruckClicked(<?php echo $value->getLat(),', ', $value->getLtd() ?>)" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <?php echo $value->getName() ?>
                            </h5>

                        </div>
                        <p class="mb-1">
                            <?php echo $value->getAddress() ?>
                        </p>
                    </a>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>



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

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                var marker = new google.maps.Marker({
                    map: map,
                    position: pos,

                });
                var currLocationInfo = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = "Twoja lokalizacja";
                currLocationInfo.appendChild(strong);
                currLocationInfo.appendChild(document.createElement('br'));
                marker.addListener('click', function() {
                    infoWindow.setContent(currLocationInfo);
                    infoWindow.open(map, marker);
                });




                map.setCenter(pos);
            }, function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
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

    function foodtruckClicked(lat, ltd) {
        var pos = {
            lat: lat,
            lng: ltd
        };

        // map.setCenter(pos);
        map.panTo(pos);
        map.setZoom(16);
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2EumDPAlhLjDCKlzLwlTgBa1eePjvpnY&callback=initMap"
        async defer></script>
</body>
</html>