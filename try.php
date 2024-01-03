<?php
require_once("controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Place";
$nama_jalan = valid($conn, $_GET["address"]);
$select_laka = "SELECT * FROM titik_rawan WHERE nama_jalan_rawan LIKE '%$nama_jalan%'";
$take_titik_rawan = mysqli_query($conn, $select_laka);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Leaflet Map with Routing</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
  <style>
    #map {
      height: 400px;
    }
  </style>
</head>

<body>
  <div id="map"></div>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
  <script>
    function getlokasi() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else {
        alert("Geolocation is not supported by this browser.");
      }
    }

    function showPosition(posisi) {
      var latitude = posisi.coords.latitude;
      var longitude = posisi.coords.longitude;

      var map = L.map('map').setView([latitude, longitude], 14);
      var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
      }).addTo(map);

      var latInput = document.querySelector("[name=latitude]");
      var lngInput = document.querySelector("[name=longitude]");
      var curLocation = [latitude, longitude];

      var currentLocationIcon = L.icon({
        iconUrl: 'assets/img/location.png',
        iconSize: [35, 40],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });

      var marker = L.marker(curLocation, {
        icon: currentLocationIcon
      }).addTo(map);

      marker.on('click', function(event) {
        var position = marker.getLatLng();
        marker.bindPopup(position.toString()).openPopup();
      });

      map.on("click", function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        latInput.value = lat;
        lngInput.value = lng;
      });

      var rawanIcon = L.icon({
        iconUrl: 'assets/img/warning.png',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32],
      });

      var titikRawanData = [
        <?php
        while ($row = mysqli_fetch_assoc($take_titik_rawan)) {
          echo "[" . $row['latitude'] . ", " . $row['longitude'] . "],";
        }
        ?>
      ];

      var titikRawanMarkers = [];
      for (var i = 0; i < titikRawanData.length; i++) {
        var marker = L.marker(titikRawanData[i], {
          icon: rawanIcon
        }).addTo(map);
        titikRawanMarkers.push(marker);
      }

      var titikRawanGroup = L.layerGroup(titikRawanMarkers);
      map.addLayer(titikRawanGroup);

      var control = L.Routing.control({
        waypoints: [
          L.latLng(latitude, longitude),
          <?php foreach ($take_titik_rawan as $data) : ?>
            L.latLng(<?= $data['latitude'] ?>, <?= $data['longitude'] ?>)
          <?php endforeach; ?>
        ],
        routeWhileDragging: true
      }).addTo(map);

      // Simpan referensi marker routing
      var routingMarker;
      control.on('routingstart', function(event) {
        var posisi = marker.getLatLng();
        var titikRawanTerdekat = cariTetikRawanTerdekat(posisi, titikRawanMarkers);

        if (titikRawanTerdekat) {
          control.spliceWaypoints(control.getWaypoints().length - 1, 1, titikRawanTerdekat);

          // Tambahkan marker di titik rawan
          routingMarker = L.marker(titikRawanTerdekat, {
            icon: rawanIcon
          }).addTo(map);
        }
      });

      // Ganti ikon marker yang dibuat oleh Leaflet Routing Machine
      control.on('routeselected', function(event) {
        if (event.route && event.route.coordinates) {
          event.route.coordinates.forEach(function(coord) {
            var marker = L.marker(coord, {
              icon: rawanIcon
            }).addTo(map);
          });
        }
      });
    }

    function showError(error) {
      switch (error.code) {
        case error.PERMISSION_DENIED:
          alert("User denied the request for Geolocation.");
          break;
        case error.POSITION_UNAVAILABLE:
          alert("Location information is unavailable.");
          break;
        case error.TIMEOUT:
          alert("The request to get user location timed out.");
          break;
        case error.UNKNOWN_ERROR:
          alert("An unknown error occurred.");
          break;
      }
    }

    getlokasi();
  </script>
</body>

</html>