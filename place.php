<?php require_once("controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Place"; ?>

<!doctype html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <div class="ts-page-wrapper ts-homepage ts-full-screen-page" id="page-top">
    <?php require_once("sections/navbar.php"); ?>
    <section id="ts-hero" class=" mb-0">
      <div class="ts-full-screen d-flex flex-column">

        <section class="ts-shadow__sm ts-z-index__2 ts-bg-light">
          <div class="position-absolute w-100 ts-bottom__0 ts-z-index__1 text-center ts-h-0 d-block d-sm-none">
            <button type="button" class="ts-circle p-3 bg-white ts-shadow__sm border-0 ts-push-up__50 mt-2" data-toggle="collapse" data-target="#form-collapse">
              <i class="fa fa-chevron-up ts-text-color-primary ts-visible-on-uncollapsed"></i>
              <i class="fa fa-chevron-down ts-text-color-primary ts-visible-on-collapsed"></i>
            </button>
          </div>
          <div id="form-collapse" class="collapse ts-xs-hide-collapse show">
            <form class="ts-form mb-0 d-flex flex-column flex-sm-row py-2 pl-2 pr-3" method="get">
              <div class="form-group m-1 w-100">
                <input type="text" class="form-control" id="address" name="address" value="<?php if (isset($_GET['address'])) {
                                                                                              echo $_GET['address'];
                                                                                            } ?>" placeholder="Nama Jalan" required>
              </div>
              <div class="form-group m-1 w-100">
                <select class="custom-select" id="status" name="status" required>
                  <option value="">Status</option>
                  <?php if (isset($_GET['tanggal_kejadian'])) {
                    $id_tingkat_kecelakaan = $_GET['status'];
                    foreach ($views_tingkat_kecelakaan as $data_select_tingkat_kecelakaan) :
                      $selected = ($data_select_tingkat_kecelakaan['id_tingkat_kecelakaan'] == $id_tingkat_kecelakaan) ? 'selected' : ''; ?>
                      <option value="<?= $data_select_tingkat_kecelakaan['id_tingkat_kecelakaan'] ?>" <?= $selected ?>><?= $data_select_tingkat_kecelakaan['tingkat_kecelakaan'] ?></option>
                    <?php endforeach;
                  } else {
                    foreach ($views_tingkat_kecelakaan as $data) : ?>
                      <option value="<?= $data['id_tingkat_kecelakaan'] ?>"><?= $data['tingkat_kecelakaan'] ?></option>
                  <?php endforeach;
                  } ?>
                </select>
              </div>
              <div class="form-group m-1 w-100">
                <input type="date" class="form-control border-right-0" id="tanggal_kejadian" name="tanggal_kejadian" value="<?php if (isset($_GET['tanggal_kejadian'])) {
                                                                                                                              echo $_GET['tanggal_kejadian'];
                                                                                                                            } ?>" placeholder=" Waktu Kejadian">
              </div>
              <div class="input-group m-1 w-100">
                <input type="text" class="form-control border-right-0" id="min_nilai_rugi" name="min_nilai_rugi" value="<?php if (isset($_GET['min_nilai_rugi'])) {
                                                                                                                          echo $_GET['min_nilai_rugi'];
                                                                                                                        } ?>" placeholder="Min. Nilai Kerugian">
                <div class="input-group-append">
                  <span class="input-group-text bg-white border-left-0">Rp</span>
                </div>
              </div>
              <div class="input-group m-1 w-100">
                <input type="text" class="form-control border-right-0" id="max_nilai_rugi" name="max_nilai_rugi" value="<?php if (isset($_GET['max_nilai_rugi'])) {
                                                                                                                          echo $_GET['max_nilai_rugi'];
                                                                                                                        } ?>" placeholder="Max. Nilai Kerugian">
                <div class="input-group-append">
                  <span class="input-group-text bg-white border-left-0">Rp</span>
                </div>
              </div>
              <div class="form-group m-1 ml-auto">
                <button type="submit" class="btn btn-primary" id="search-btn">Cari</button>
              </div>
            </form>
          </div>
        </section>

        <div class="d-flex h-100">

          <div class="ts-results__vertical ts-results__vertical-list ts-shadow__sm scrollbar-inner bg-white ts-z-index__2">
            <section id="ts-results">
              <div class="ts-results-wrapper">
                <?php if (isset($_GET["address"])) {
                  $nama_jalan = valid($conn, $_GET["address"]);
                  if (isset($_GET["status"])) {
                    $status = valid($conn, $_GET["status"]);
                  } else {
                    $status = "";
                  }
                  if (isset($_GET["tanggal_kejadian"])) {
                    $tanggal_kejadian = valid($conn, $_GET["tanggal_kejadian"]);
                  } else {
                    $tanggal_kejadian = "";
                  }
                  if (isset($_GET["min_nilai_rugi"])) {
                    $min_nilai_rugi = valid($conn, $_GET["min_nilai_rugi"]);
                  } else {
                    $min_nilai_rugi = "";
                  }
                  if (isset($_GET["max_nilai_rugi"])) {
                    $max_nilai_rugi = valid($conn, $_GET["max_nilai_rugi"]);
                  } else {
                    $max_nilai_rugi = "";
                  }
                  $select_laka = "SELECT titik_rawan.*, SUM(laka.jumlah_luka_ringan) AS total_jumlah_luka_ringan, SUM(laka.jumlah_luka_berat) AS total_jumlah_luka_berat, SUM(laka.jumlah_meninggal) AS total_jumlah_meninggal, COUNT(laka.id_laka) AS total_laka, laka.tanggal_kejadian
                                  FROM titik_rawan
                                  LEFT JOIN laka ON laka.id_titik_rawan = titik_rawan.id_titik_rawan
                                  WHERE titik_rawan.nama_jalan_rawan LIKE '%$nama_jalan%'
                                  AND laka.id_tingkat_kecelakaan='$status'
                                  OR laka.tanggal_kejadian='$tanggal_kejadian'
                                  OR laka.nilai_kerugian_kendaraan>='$min_nilai_rugi'
                                  AND laka.nilai_kerugian_kendaraan<='$max_nilai_rugi'
                                  GROUP BY titik_rawan.id_titik_rawan";
                  $views_laka = mysqli_query($conn, $select_laka);
                  if (mysqli_num_rows($views_laka) > 0) {
                    foreach ($views_laka as $data) :
                      $bulan_kejadian = date("n", strtotime($data['tanggal_kejadian']));
                      $bulan_saat_ini = date("n");
                      $is_bulan_ini = ($bulan_kejadian == $bulan_saat_ini); ?>
                      <div class="ts-result-link" data-ts-id="9" data-ts-ln="8">
                        <span class="ts-center-marker"><img src="assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>"></span>
                        <a href="laka?id=<?= $data['id_titik_rawan'] ?>&address=<?= $data['nama_jalan_rawan'] ?>" class="card ts-item ts-card ts-result">
                          <?php if ($is_bulan_ini) : ?>
                            <div class="ts-ribbon-corner"><span>Baru Bulan Ini</span></div>
                          <?php endif; ?>
                          <div href="detail-01.html" class="card-img ts-item__image" style="background-image: url(assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>)"></div>
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
                    <?php endforeach;
                  } else { ?>
                    <p class="text-center mt-5">Tidak ada data yang ditemukan!</p>
                  <?php }
                } else { ?>
                  <div class="ts-result-link" id="recommendedLocations" data-ts-id="9" data-ts-ln="8"></div>
                <?php } ?>
              </div>
            </section>
          </div>

          <div class="ts-map w-100 ts-z-index__1">
            <div id="map" class="h-100 ts-z-index__1 shadow" style="width: 100%; height: 100vh;z-index: 0;"></div>
            <?php if (!isset($_GET["address"])) {
              $select_laka = "SELECT titik_rawan.*, SUM(laka.jumlah_luka_ringan) AS total_jumlah_luka_ringan, SUM(laka.jumlah_luka_berat) AS total_jumlah_luka_berat, SUM(laka.jumlah_meninggal) AS total_jumlah_meninggal, COUNT(laka.id_laka) AS total_laka, laka.tanggal_kejadian
                                  FROM titik_rawan
                                  LEFT JOIN laka ON laka.id_titik_rawan = titik_rawan.id_titik_rawan
                                  GROUP BY titik_rawan.id_titik_rawan";
              $views_laka = mysqli_query($conn, $select_laka); ?>
              <script>
                // Inisialisasi peta
                var map = L.map('map');

                // Tambahkan peta dari OpenStreetMap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

                var dangerIcon = L.icon({
                  iconUrl: 'assets/img/warning.png',
                  iconSize: [35, 40],
                  iconAnchor: [12, 41],
                  popupAnchor: [0, -32],
                });

                // Tambahkan marker untuk setiap titik koordinat
                var markers = [
                  <?php foreach ($views_laka as $data) { ?>
                    L.marker([<?= $data['latitude'] ?>, <?= $data['longitude'] ?>], {
                      icon: dangerIcon
                    }).bindPopup('<div style="background-color: white; padding: 10px;"><img src="assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>" style="width: 280px;" alt=""><br><br><b><?= $data['nama_jalan_rawan'] ?></b></div>'),
                  <?php } ?>
                ];

                var group = L.layerGroup(markers).addTo(map);

                // Titik awal dan akhir yang akan digunakan untuk rute
                var start = null;
                var end = null;

                // Kirim data titik koordinat ke JavaScript
                var coordinates = [
                  <?php foreach ($views_laka as $data) { ?> {
                      id_titik_rawan: '<?= $data['id_titik_rawan'] ?>',
                      nama_jalan_rawan: '<?= $data['nama_jalan_rawan'] ?>',
                      img_titik_rawan: '<?= $data['img_titik_rawan'] ?>',
                      total_laka: '<?= $data['total_laka'] ?>',
                      total_jumlah_luka_ringan: '<?= $data['total_jumlah_luka_ringan'] ?>',
                      total_jumlah_luka_berat: '<?= $data['total_jumlah_luka_berat'] ?>',
                      total_jumlah_meninggal: '<?= $data['total_jumlah_meninggal'] ?>',
                      lat: <?= $data['latitude'] ?>,
                      lon: <?= $data['longitude'] ?>
                    },
                  <?php } ?>
                ];

                // Fungsi untuk mendapatkan lokasi pengguna
                function getMyLocation() {
                  if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                      var lat = position.coords.latitude;
                      var lon = position.coords.longitude;

                      // Set tampilan peta untuk menampilkan lokasi pengguna
                      map.setView([lat, lon], 14);

                      // Tampilkan lokasi pengguna pada peta dengan ikon gambar
                      var myLocationMarker = L.marker([lat, lon], {
                        icon: L.icon({
                          iconUrl: 'assets/img/location.png',
                          iconSize: [35, 40],
                          iconAnchor: [12, 41],
                          popupAnchor: [0, -32],
                        })
                      }).addTo(map);

                      // Set lokasi awal untuk rute
                      start = L.latLng(lat, lon);
                    });
                  } else {
                    console.log("Geolokasi tidak didukung di browser ini.");
                  }
                }

                // Fungsi untuk menghitung jarak antara dua titik koordinat
                function calculateDistance(lat1, lon1, lat2, lon2) {
                  var radlat1 = Math.PI * lat1 / 180;
                  var radlat2 = Math.PI * lat2 / 180;
                  var theta = lon1 - lon2;
                  var radtheta = Math.PI * theta / 180;
                  var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
                  dist = Math.acos(dist);
                  dist = dist * 180 / Math.PI;
                  dist = dist * 60 * 1.1515;
                  dist = dist * 1.609344; // Dalam kilometer
                  return dist;
                }

                var recommendedLocations = []; // Definisikan di luar fungsi untuk menjaga data

                // Fungsi untuk mencari bengkel terdekat
                function findNearestWorkshop() {
                  if ("geolocation" in navigator) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                      var userLat = position.coords.latitude;
                      var userLon = position.coords.longitude;
                      var nearestWorkshops = []; // Array untuk menyimpan semua lokasi terdekat

                      // Gunakan koordinat pengguna yang sudah didapatkan
                      var finalUserLat = userLat;
                      var finalUserLon = userLon;

                      // Iterasi melalui data bengkel untuk mencari yang terdekat
                      coordinates.forEach(function(workshop) {
                        var workshopLat = workshop.lat;
                        var workshopLon = workshop.lon;
                        var distance = calculateDistance(finalUserLat, finalUserLon, workshopLat, workshopLon);
                        workshop.distance = distance; // Menambahkan jarak ke setiap lokasi

                        nearestWorkshops.push(workshop);
                      });

                      // Urutkan lokasi terdekat berdasarkan jarak
                      nearestWorkshops.sort(function(a, b) {
                        return a.distance - b.distance;
                      });

                      // Simpan semua lokasi hasil rute terdekat ke dalam array
                      recommendedLocations = nearestWorkshops;

                      // Tampilkan lokasi hasil rute terdekat dalam kartu
                      displayRecommendedLocations(recommendedLocations);
                    });
                  } else {
                    console.log("Geolokasi tidak didukung di browser ini.");
                  }
                }

                // Fungsi untuk menampilkan lokasi hasil rute terdekat dalam kartu-kartu
                function displayRecommendedLocations(locations) {
                  var locationsContainer = document.getElementById("recommendedLocations");

                  // Bersihkan kontainer lokasi sebelum menambahkan yang baru
                  locationsContainer.innerHTML = "";

                  // Tampilkan semua lokasi hasil rute terdekat dalam kartu-kartu
                  locations.forEach(function(location) {
                    var cardHTML = `
                      <span class="ts-center-marker"><img src="assets/img/titik_rawan/${location.img_titik_rawan}"></span>
                      <a href="laka?id=${location.id_titik_rawan}&address=${location.nama_jalan_rawan}" class="card ts-item ts-card ts-result" data-titik-rawan-id="${location.id_titik_rawan}">
                          <div class="card-img ts-item__image" style="background-image: url(assets/img/titik_rawan/${location.img_titik_rawan})"></div>
                          <div class="card-body">
                              <figure class="ts-item__info">
                                  <h4><i class="fa fa-map-marker mr-2"></i>${location.nama_jalan_rawan}</h4>
                              </figure>
                              <div class="ts-description-lists">
                                  <dl>
                                      <dt>Jumlah Kecelakaan</dt>
                                      <dd>${location.total_laka}</dd>
                                  </dl>
                                  <dl>
                                      <dt>Luka Ringan</dt>
                                      <dd>${location.total_jumlah_luka_ringan}</dd>
                                  </dl>
                                  <dl>
                                      <dt>Luka Berat</dt>
                                      <dd>${location.total_jumlah_luka_berat}</dd>
                                  </dl>
                                  <dl>
                                      <dt>Meninggal</dt>
                                      <dd>${location.total_jumlah_meninggal}</dd>
                                  </dl>
                              </div>
                          </div>
                      </a>
                    `;

                    // Tambahkan kartu lokasi ke kontainer
                    locationsContainer.innerHTML += cardHTML;
                  });
                }

                // Panggil fungsi untuk mendapatkan lokasi pengguna
                getMyLocation();

                // Panggil fungsi untuk mencari bengkel terdekat
                findNearestWorkshop();
              </script>
              <?php } else {
              $nama_jalan = valid($conn, $_GET["address"]);
              if (isset($_GET["status"])) {
                $status = valid($conn, $_GET["status"]);
              } else {
                $status = "";
              }
              if (isset($_GET["tanggal_kejadian"])) {
                $tanggal_kejadian = valid($conn, $_GET["tanggal_kejadian"]);
              } else {
                $tanggal_kejadian = "";
              }
              if (isset($_GET["min_nilai_rugi"])) {
                $min_nilai_rugi = valid($conn, $_GET["min_nilai_rugi"]);
              } else {
                $min_nilai_rugi = "";
              }
              if (isset($_GET["max_nilai_rugi"])) {
                $max_nilai_rugi = valid($conn, $_GET["max_nilai_rugi"]);
              } else {
                $max_nilai_rugi = "";
              }
              $select_titik_rawan = "SELECT titik_rawan.* 
                                      FROM titik_rawan 
                                      LEFT JOIN laka ON laka.id_titik_rawan = titik_rawan.id_titik_rawan 
                                      WHERE titik_rawan.nama_jalan_rawan LIKE '%$nama_jalan%' 
                                      AND laka.id_tingkat_kecelakaan='$status'
                                      OR laka.tanggal_kejadian='$tanggal_kejadian'
                                      OR laka.nilai_kerugian_kendaraan>='$min_nilai_rugi'
                                      AND laka.nilai_kerugian_kendaraan<='$max_nilai_rugi'
                                      GROUP BY titik_rawan.id_titik_rawan";
              $take_titik_rawan = mysqli_query($conn, $select_titik_rawan);
              if (mysqli_num_rows($take_titik_rawan) > 0) {
              ?>
                <script>
                  var data_geolocation = {
                    loc: [0, 0]
                  };

                  var currentLocationIcon = L.icon({
                    iconUrl: 'assets/img/location.png',
                    iconSize: [35, 40],
                    iconAnchor: [16, 32],
                    popupAnchor: [0, -32],
                  });

                  function getlokasi() {
                    if (navigator.geolocation) {
                      navigator.geolocation.getCurrentPosition(showPosition);
                    }
                  }

                  function showPosition(position) {
                    data_geolocation.loc = [position.coords.latitude, position.coords.longitude];
                    initializeMap();
                  }

                  function calculateDistance(lat1, lon1, lat2, lon2) {
                    var R = 6371; // Radius of the earth in km
                    var dLat = deg2rad(lat2 - lat1);
                    var dLon = deg2rad(lon2 - lon1);
                    var a =
                      Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                      Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
                      Math.sin(dLon / 2) * Math.sin(dLon / 2);
                    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                    var distance = R * c; // Distance in km
                    return distance;
                  }

                  function deg2rad(deg) {
                    return deg * (Math.PI / 180);
                  }

                  function findNearestDangerZone() {
                    var nearestDangerZone = null;
                    var nearestDistance = Infinity;

                    <?php foreach ($take_titik_rawan as $data) { ?>
                      var distance = calculateDistance(data_geolocation.loc[0], data_geolocation.loc[1], <?= $data['latitude'] ?>, <?= $data['longitude'] ?>);
                      if (distance < nearestDistance) {
                        nearestDistance = distance;
                        nearestDangerZone = <?= json_encode($data) ?>;
                      }
                    <?php } ?>

                    return nearestDangerZone;
                  }

                  function initializeMap() {
                    var map = L.map('map').setView(data_geolocation.loc, 12);
                    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

                    var iconLock = L.icon({
                      iconUrl: 'assets/img/warning.png',
                      iconSize: [35, 40],
                      iconAnchor: [16, 32],
                      popupAnchor: [0, -32],
                    });

                    L.marker(data_geolocation.loc, {
                      icon: currentLocationIcon
                    }).addTo(map);

                    <?php foreach ($take_titik_rawan as $data) { ?>
                      var marker = L.marker([<?= $data['latitude'] ?>, <?= $data['longitude'] ?>], {
                        icon: iconLock
                      }).addTo(map);

                      marker.bindPopup(
                        "<div style='background-color: #fff; padding: 10px; border-radius: 5px;'>" +
                        "<img src='assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>' style='max-width: 250px; height: auto; border-radius: 5px;' alt=''>" +
                        "<h2 style='margin-top: 5px; font-size: 16px; font-weight: bold; color: #333;'>" + <?= json_encode($data['nama_jalan_rawan']) ?> + "</h2>" +
                        "</div>", {
                          maxWidth: 350
                        }
                      );
                    <?php } ?>

                    var nearestDangerZone = findNearestDangerZone();

                    if (nearestDangerZone) {
                      var nearestMarker = L.marker([nearestDangerZone.latitude, nearestDangerZone.longitude], {
                        icon: iconLock
                      }).addTo(map);

                      nearestMarker.bindPopup(
                        "<div style='background-color: #fff; padding: 10px; border-radius: 5px;'>" +
                        "<img src='assets/img/titik_rawan/" + nearestDangerZone.img_titik_rawan + "' style='max-width: 250px; height: auto; border-radius: 5px;' alt=''>" +
                        "<h2 style='margin-top: 5px; font-size: 16px; font-weight: bold; color: #333;'>" + nearestDangerZone.nama_jalan_rawan + "</h2>" +
                        "</div>", {
                          maxWidth: 350
                        }
                      );

                      var control = L.Routing.control({
                        waypoints: [
                          L.latLng(data_geolocation.loc),
                          L.latLng(nearestDangerZone.latitude, nearestDangerZone.longitude)
                        ],
                        routeWhileDragging: true
                      })
                      control.addTo(map);
                    }
                  }

                  getlokasi();
                </script>
              <?php } else { ?>
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

                  getlokasi();
                </script>
            <?php }
            } ?>
          </div>
        </div>

      </div>

  </div>
  </section>
  </div>
  <?php require_once("sections/footer.php"); ?>
</body>

</html>