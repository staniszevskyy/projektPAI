<!DOCTYPE html>
<html>
<head>
    <title>Foodtruck Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css" />
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous">
    </script>

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
    require_once __DIR__.'/../../Database.php';
    $get = new FoodtruckMapper();
    $idx=0;

    if (isset($_POST['search']) and $_POST['search']!=""){

        $get->getCertainFoodtrucks($_POST['search']);

    }

    else{
        $get->getAllFoodtrucks();


    }
    $get = $get->getFoodtruckList();


//    foreach ($get as $key => $value) {
//
//    $food=$value->getFood();
//    var_dump($food);
//    foreach ($value as $klucz => $food){
//        var_dump($food);
//
//    }
//}



    unset($_POST['search']);


?>


<div id="map"></div>

<div id="list">
    <div class="card" >
        <div class="card-body">
            <h4 class="card-title">Wyszukaj foodtruck</h4>
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



<script type="text/javascript">



    var map;

    var food;
    //Inicjuj mapę
    function initMap() {
        navigating=false;
        directionsService = new google.maps.DirectionsService();

        directionsDisplay = new google.maps.DirectionsRenderer(
            {
                suppressMarkers: true
            });
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -34.397, lng: 150.644},
            zoom: 8
        });
        directionsDisplay.setMap(map);
        var infoWindow = new google.maps.InfoWindow();
        //Synchronizuj z XMLem
        downloadUrl('/?page=xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('foodtruck');
            Array.prototype.forEach.call(markers, function(markerElem) {
                var id = markerElem.getAttribute('id');
                var name = markerElem.getAttribute('name');
                var address = markerElem.getAttribute('street') + ", " + markerElem.getAttribute('city') + " " + markerElem.getAttribute('zipcode');
                var openHours = {
                    pon: markerElem.getAttribute('pon'),
                    wt: markerElem.getAttribute('wt'),
                    sr: markerElem.getAttribute('sr'),
                    czw: markerElem.getAttribute('czw'),
                    pt: markerElem.getAttribute('pt'),
                    sob: markerElem.getAttribute('sob'),
                    nd: markerElem.getAttribute('nd')
                };
                var point = new google.maps.LatLng(
                    parseFloat(markerElem.getAttribute('lat')),
                    parseFloat(markerElem.getAttribute('lng')));




                $.ajax({

                    url: 'http://localhost:8000/?page=map',
                    type: 'POST',
                    data: {
                        index: id
                    },


                    success: function(){

                    }});
<!--                --><?php
//                echo $_SESSION['index'];
//                ?>


//
//                document.cookie = "id"+"="+id;
                //console.log(<?php //echo $_COOKIE['id']; ?>//);
                //TU DZIALA DOBRZE!!!




                <?php //$idx= htmlentities($_COOKIE['gowno'], 3, 'UTF-8');


                //?>
                //
                //food = <?php //echo json_encode($get[$idx]->getFood()); ?>//;
                //
                //console.log(food);

                <?php

                    $database = new Database();
                    if (isset($_COOKIE['id'])) {
                        $id = $_COOKIE["id"];
                    }


                    $food = [];
                    $stmt=$database->connect()->prepare('SELECT f.name, f.price FROM food f, foodtrucks fo, foodlist l
                    WHERE l.foodFK=f.idfood AND l.foodtruckFK=fo.id AND fo.id=:idx;');
                    $stmt->bindParam(':idx', $id, PDO::PARAM_INT);


                if ($stmt->execute()) {

                    while ($row =  $stmt->fetch(PDO::FETCH_ASSOC))
                    {

                        $food[] = $row['name'];

                    }
                }

                ?>

                food = <?php echo json_encode($food); ?>;

                var marker = new google.maps.Marker({
                    map: map,
                    position: point,

                });
                var destination = [
                    parseFloat(markerElem.getAttribute('lat')), parseFloat(markerElem.getAttribute('lng'))
                ];
                var contentString = '<div id="content">' +
                        '<div class="infoWindow">' +
                        '<h3 id="foodtruckName" class="foodtruckName">' + name + '</h3>' +
                        '<h5 class="foodtruckAdress">' + address + '</h5>' +
                        '<div id="bodyContent">' +
                        '<p><b>' + name + '</b>, oferuje takie potrawy jak:' +
                        '<ul>';
                        for (var i = 0; i < food.length; i++) {
                            contentString+= '<li>'+ food[i] + '</li>';
                        }

                contentString+= '</ul>' +
                        '<p>Otwarte:<ul>' +
                        '<li>Poniedziałek: '+ openHours['pon']+'</li>'+
                        '<li>Wtorek: '+ openHours['wt']+'</li>'+
                        '<li>Środa: '+ openHours['sr']+'</li>'+
                        '<li>Czwartek: '+ openHours['czw']+'</li>'+
                        '<li>Piątek: '+ openHours['pt']+'</li>'+
                        '<li>Sobota: '+ openHours['sob']+'</li>'+
                        '<li>Niedziela: '+ openHours['nd']+'</li></ul>'+
                        '<button type="button" style="margin: 5px" class="btn btn-secondary btn-lg float-right" onclick=cancelNavigation()>Anuluj</button>' +
                        '<button type="button"  style="margin: 5px" class="btn btn-primary btn-lg float-right" onclick=navigateFoodtruck(' + destination[0] + ',' + destination[1] + ',' + false + ')><i class="fas fa-car"></i></button>' +
                        '<button type="button" style="margin: 5px" class="btn btn-primary btn-lg float-right" onclick=navigateFoodtruck(' + destination[0] + ',' + destination[1] + ',' + true + ')><i class="fas fa-walking"></i></button>' +


                        '</div>' +
                        '</div>' +
                        '</div>';



                infowindow = new google.maps.InfoWindow({
                    content: contentString

                });

                //Kliknięcie na markera
                marker.addListener('click', function() {

                    infowindow.open(map, marker);
                    map.panTo(point);
                    map.setZoom(18);

                });
            });

        });

        //Wyśrodkuj mapę do obecnej lokalizacji użytkownika
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
                map.setZoom(14);
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

    //Kliknięcię wpisu na liście foodtrucków
    function foodtruckClicked(lat, ltd) {
        var pos = {
            lat: lat,
            lng: ltd
        };

        // map.setCenter(pos);
        map.panTo(pos);
        map.setZoom(15);
    }

    //Funkcja google directions , flaga == 1 to znajdz drogę pieszo, flaga==0 znajdź drogę samochodem
    function navigateFoodtruck(lat, long, flag)
    {
        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

        var start = new google.maps.LatLng(pos['lat'], pos['lng']);

        var end = new google.maps.LatLng(lat, long);
        if (flag == true) {
            var request = {
                origin: start,
                destination: end,
                travelMode: 'WALKING'
            };
        }
        else{
            var request = {
                    origin: start,
                    destination: end,
                    travelMode: 'WALKING'
                };
        }
        directionsService.route(request, function(result, status) {
            if (status == 'OK') {
                directionsDisplay.setDirections(result);
                navigating = true;
            }
        });
        },
         function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
        }
    }

    function cancelNavigation(){
        directionsDisplay.set('directions', null);
        infowindow.close();
    }


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2EumDPAlhLjDCKlzLwlTgBa1eePjvpnY&callback=initMap"
        async defer></script>
</body>
</html>