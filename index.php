<?php require_once("controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = ""; ?>

<!doctype html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <div class="ts-page-wrapper ts-homepage ts-full-screen-page" id="page-top">
    <?php require_once("sections/navbar.php"); ?>
    <section id="ts-hero" class=" mb-0">
      <div class="ts-full-screen ts-has-horizontal-results w-1001 d-flex1 flex-column1">
        <div class="ts-map ts-shadow__sm">
          <div class="ts-form__map-search ts-z-index__2">
            <form class="ts-form" method="get" action="place">
              <a href=".html" data-toggle="collapse" class="ts-center__vertical justify-content-between">
                <h5 class="mb-0">Pencarian Titik Rawan</h5>
              </a>
              <div class="ts-form-collapse ts-xs-hide-collapse collapse show">
                <div class="form-group my-2 pt-2">
                  <input type="text" class="form-control" id="address" name="address" placeholder="Nama Jalan">
                </div>
                <div class="form-group mt-2 mb-3">
                  <button type="submit" class="btn btn-primary w-100" id="search-btn">Cari</button>
                </div>
              </div>
            </form>
          </div>

          <div id="map" class="shadow" style="width: 100%; height: 100%;z-index: 0;"></div>
          <?php $data = array();
          if ($views_titik_rawan_maps->num_rows > 0) {
            while ($row = $views_titik_rawan_maps->fetch_assoc()) {
              $data[] = $row;
            }
          } ?>
          <script>
            function getlokasi() {
              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
              }
            }

            function showPosition(posisi) {
              var latitude = posisi.coords.latitude;
              var longitude = posisi.coords.longitude;

              var map = L.map('map').setView([latitude, longitude], 14);
              var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

              var latInput = document.querySelector("[name=latitude]");
              var lngInput = document.querySelector("[name=longitude]");
              var curLocation = [latitude, longitude];
              map.attributionControl.setPrefix(false);

              // Ikon untuk lokasi saat ini
              var currentLocationIcon = L.icon({
                iconUrl: 'assets/img/location.png',
                iconSize: [35, 40],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
              });

              var marker = new L.marker(curLocation, {
                draggable: 'true',
                icon: currentLocationIcon,
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
                  marker = L.marker(e.latlng, {
                    icon: currentLocationIcon
                  }).addTo(map);
                } else {
                  marker.setLatLng(e.latlng);
                }
                latInput.value = lat;
                lngInput.value = lng;
              });

              // Panggil fungsi untuk menampilkan titik rawan
              tampilkanTitikRawan(map);
            }

            function tampilkanTitikRawan(map) {
              var dataTitikRawan = <?php echo json_encode($data); ?>;

              // Ikon untuk titik rawan
              var rawanIcon = L.icon({
                iconUrl: 'assets/img/warning.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32],
              });

              dataTitikRawan.forEach(titik => {
                var marker = L.marker([titik.latitude, titik.longitude], {
                  icon: rawanIcon
                }).addTo(map);
                marker.bindPopup('<div style="background-color: white; padding: 10px;"><img src="assets/img/titik_rawan/' + titik.img_titik_rawan + '" style="width: 280px;" alt=""><br><br><b>' + titik.nama_jalan_rawan + '</b></div>');
              });
            }

            getlokasi();
          </script>

        </div>

        <div id="ts-results" class="ts-results__horizontal scrollbar-inner dragscroll">
          <div class="ts-results-wrapper">
            <?php foreach ($views_titik_rawan_overview as $data) : ?>
              <div class="ts-result-link" data-ts-id="1" data-ts-ln="0" style="width: 400px;">
                <span class="ts-center-marker"><img src="assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>" style="object-fit: cover;width: 150px;"></span>
                <a href="laka?id=<?= $data['id_titik_rawan'] ?>&address=<?= $data['nama_jalan_rawan'] ?>" class="card ts-item ts-card ts-result" style="width: 400px;">
                  <div class="card-img ts-item__image" style="background-image: url(assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>);object-fit: cover;width: 150px;"></div>
                  <div class="card-body">
                    <figure class="ts-item__info">
                      <h4><i class="fa fa-map-marker mr-2"></i><?= $data['nama_jalan_rawan'] ?></h4>
                    </figure>
                    <div class="ts-description-lists">
                      <dl>
                        <dt>Jumlah Kecelakaan</dt>
                        <dd><?= $data['total_laka'] ?></dd>
                      </dl>
                      <dl>
                        <dt>Luka Ringan</dt>
                        <dd><?= $data['total_jumlah_luka_ringan'] ?></dd>
                      </dl>
                      <dl>
                        <dt>Luka Berat</dt>
                        <dd><?= $data['total_jumlah_luka_berat'] ?></dd>
                      </dl>
                      <dl>
                        <dt>Meninggal</dt>
                        <dd><?= $data['total_jumlah_meninggal'] ?></dd>
                      </dl>
                    </div>
                  </div>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <main id="ts-main">

      <section id="featured-properties" class="ts-block pt-5">
        <div class="container">
          <div class="ts-title text-center">
            <h2>Satlantas Kupang Kota</h2>
          </div>
          <div class="row">
            <?php foreach ($views_polres as $data) : ?>
              <div class="col-sm-6 col-lg-4">

                <div class="card ts-item ts-card ts-item__lg">
                  <a href="laka?id=<?= $data['id_titik_rawan'] ?>&address=<?= $data['nama_jalan_rawan'] ?>" class="card-img ts-item__image" data-bg-image="assets/img/polres/<?= $data['img_polres'] ?>">
                    <figure class="ts-item__info">
                      <h4><?= $data['nama_polres'] ?></h4>
                      <aside>
                        <i class="fa fa-map-marker mr-2"></i>
                        <?= $data['alamat'] ?>
                      </aside>
                    </figure>
                  </a>
                  <div class="card-body">
                    <div class="ts-description-lists">
                      <dl>
                        <dt>Telepon</dt>
                        <dd><?php if (empty($data['telepon'])) {
                              echo "-";
                            } else {
                              echo $data['telepon'];
                            } ?></dd>
                      </dl>
                      <dl>
                        <dt>Email</dt>
                        <dd><?php if (empty($data['email'])) {
                              echo "-";
                            } else {
                              echo $data['email'];
                            } ?></dd>
                      </dl>
                      <dl>
                        <dt>Jumlah Anggota</dt>
                        <dd><?= $data['jumlah_anggota'] ?></dd>
                      </dl>
                    </div>
                  </div>
                </div>
                <!--end ts-item-->
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

    </main>

    <footer id="ts-footer">
      <section id="ts-footer-secondary">
        <div class="container">

          <!--Copyright-->
          <div class="ts-copyright">(C) <?= date('Y') ?> Netmedia Framecode, All rights reserved</div>

          <!--Social Icons-->
          <div class="ts-footer-nav mt-3">
            <p>Powered by Muhammad Ardy</p>
          </div>
          <!--end ts-footer-nav-->

        </div>
        <!--end container-->
      </section>
      <!--end ts-footer-secondary-->

    </footer>
    <!--end #ts-footer-->

  </div>

  <?php require_once("sections/footer.php"); ?>

</body>

</html>