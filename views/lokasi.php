<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Lokasi";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_gis_korlantas"]["name_page"] ?></h1>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div id="map" class="shadow" style="width: 100%; height: 100vh;z-index: 0;"></div>
      <script>
        // Fungsi untuk mendapatkan data geolocation
        function getlokasi() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          }
        }

        // Fungsi untuk menampilkan hasil geolocation pada peta
        function showPosition(posisi) {
          var latitude = <?= $_GET['lat'] ?>;
          var longitude = <?= $_GET['lng'] ?>;

          var map = L.map('map').setView([latitude, longitude], 14);
          var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

          // get coordinat location
          var latInput = document.querySelector("[name=latitude]");
          var lngInput = document.querySelector("[name=longitude]");
          var curLocation = [latitude, longitude];
          map.attributionControl.setPrefix(false);
          var marker = new L.marker(curLocation, {
            draggable: 'true',
          });
          marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
              draggable: 'true',
            }).bindPopup(position).update();
            latInput.value = position.lat;
            lngInput.value = position.lng;
          });
          map.addLayer(marker);

          map.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!marker) {
              marker = L.marker(e.latlng).addTo(map);
            } else {
              marker.setLatLng(e.latlng);
            }
            latInput.value = lat;
            lngInput.value = lng;
          });
        }

        // Panggil fungsi getlokasi() saat halaman dimuat
        getlokasi();
      </script>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>