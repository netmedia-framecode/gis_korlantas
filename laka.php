<?php require_once("controller/script.php");
if (!isset($_GET['id'])) {
  header("Location: place");
  exit();
} else {
  $_SESSION["project_gis_korlantas"]["name_page"] = "Laka";
  $nama_jalan = valid($conn, $_GET['address']);
  $select_titik_rawan = "SELECT * FROM titik_rawan WHERE nama_jalan_rawan='$nama_jalan'";
  $take_titik_rawan = mysqli_query($conn, $select_titik_rawan);
  $data = mysqli_fetch_assoc($take_titik_rawan);

  $select_laka = "SELECT laka.*, informasi_khusus.informasi_khusus, kondisi_cahaya.kondisi_cahaya, cuaca.kondisi, tingkat_kecelakaan.tingkat_kecelakaan, kecelakaan_menonjol.kecelakaan_menonjol, fungsi_jalan.fungsi_jalan, kelas_jalan.kelas_jalan, tipe_jalan.tipe_jalan, permukaan_jalan.permukaan_jalan, kemiringan_jalan.kemiringan_jalan, status_jalan.status_jalan, polres.nama_polres, polres.alamat, polres.telepon, polres.email, polres.jumlah_anggota, titik_rawan.nama_jalan_rawan
                    FROM laka
                    JOIN informasi_khusus ON laka.id_informasi_khusus=informasi_khusus.id_informasi_khusus
                    JOIN kondisi_cahaya ON laka.id_kondisi_cahaya=kondisi_cahaya.id_kondisi_cahaya
                    JOIN cuaca ON laka.id_cuaca=cuaca.id_cuaca
                    JOIN tingkat_kecelakaan ON laka.id_tingkat_kecelakaan=tingkat_kecelakaan.id_tingkat_kecelakaan
                    JOIN kecelakaan_menonjol ON laka.id_kecelakaan_menonjol=kecelakaan_menonjol.id_kecelakaan_menonjol
                    JOIN fungsi_jalan ON laka.id_fungsi_jalan=fungsi_jalan.id_fungsi_jalan
                    JOIN kelas_jalan ON laka.id_kelas_jalan=kelas_jalan.id_kelas_jalan
                    JOIN tipe_jalan ON laka.id_tipe_jalan=tipe_jalan.id_tipe_jalan
                    JOIN permukaan_jalan ON laka.id_permukaan_jalan=permukaan_jalan.id_permukaan_jalan
                    JOIN kemiringan_jalan ON laka.id_kemiringan_jalan=kemiringan_jalan.id_kemiringan_jalan
                    JOIN status_jalan ON laka.id_status_jalan=status_jalan.id_status_jalan
                    JOIN polres ON laka.id_polres=polres.id_polres
                    JOIN titik_rawan ON laka.id_titik_rawan=titik_rawan.id_titik_rawan
                    WHERE laka.id_titik_rawan='$data[id_titik_rawan]'
                  ";
  $views_laka = mysqli_query($conn, $select_laka);
}
?>

<!doctype html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <div class="ts-page-wrapper ts-homepage ts-full-screen-page" id="page-top">
    <?php require_once("sections/navbar.php"); ?>

    <main id="ts-main">

      <section id="breadcrumb">
        <div class="container mt-5">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="place">Place</a></li>
              <li class="breadcrumb-item"><a href="laka">Laka</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= $nama_jalan ?></li>
            </ol>
          </nav>
        </div>
      </section>

      <section id="page-title">
        <div class="container">

          <div class="d-block d-sm-flex justify-content-between">

            <!--Title-->
            <div class="ts-title mb-0">
              <h1><i class="fa fa-map-marker text-primary"></i> <?= $nama_jalan ?></h1>
            </div>

          </div>

        </div>
      </section>

      <section id="gallery-carousel">

        <div class="owl-carousel ts-gallery-carousel ts-gallery-carousel__multi" data-owl-dots="1" data-owl-items="3" data-owl-center="1" data-owl-loop="1">

          <!--Slide-->
          <?php $id_titik_rawan = $data['id_titik_rawan'];
          $take_img_laka = "SELECT * FROM laka WHERE id_titik_rawan='$id_titik_rawan'";
          $takes_img_laka = mysqli_query($conn, $take_img_laka);
          if (mysqli_num_rows($takes_img_laka) > 0) {
            while ($data_img_laka = mysqli_fetch_assoc($takes_img_laka)) { ?>
              <div class="slide">
                <div class="ts-image" data-bg-image="assets/img/laka/<?= $data_img_laka['img_laka'] ?>">
                  <a href="assets/img/laka/<?= $data_img_laka['img_laka'] ?>" class="ts-zoom popup-image"><i class="fa fa-search-plus"></i>Zoom</a>
                </div>
              </div>
          <?php }
          } ?>

        </div>

      </section>

      <section id="content">
        <div class="container">
          <div class="row flex-wrap-reverse">

            <div class="col-md-5 col-lg-4">

              <section>
                <h3>Details</h3>
                <div class="ts-box shadow">

                  <dl class="ts-description-list__line mb-0">

                    <dt>Kecelakaan Ringan:</dt>
                    <dd><?php $id_titik_rawan = $data['id_titik_rawan'];
                        $detail_titik_rawan_ringan = "SELECT * FROM laka WHERE id_titik_rawan='$id_titik_rawan' AND id_tingkat_kecelakaan='1'";
                        $detail_titik_rawan_ringan = mysqli_query($conn, $detail_titik_rawan_ringan);
                        $details_titik_rawan_ringan = mysqli_num_rows($detail_titik_rawan_ringan);
                        echo $details_titik_rawan_ringan; ?></dd>

                    <dt>Kecelakaan Sedang:</dt>
                    <dd><?php
                        $detail_titik_rawan_sedang = "SELECT * FROM laka WHERE id_titik_rawan='$id_titik_rawan' AND id_tingkat_kecelakaan='2'";
                        $detail_titik_rawan_sedang = mysqli_query($conn, $detail_titik_rawan_sedang);
                        $details_titik_rawan_sedang = mysqli_num_rows($detail_titik_rawan_sedang);
                        echo $details_titik_rawan_sedang; ?></dd>

                    <dt>Kecelakaan Berat:</dt>
                    <dd><?php
                        $detail_titik_rawan_berat = "SELECT * FROM laka WHERE id_titik_rawan='$id_titik_rawan' AND id_tingkat_kecelakaan='3'";
                        $detail_titik_rawan_berat = mysqli_query($conn, $detail_titik_rawan_berat);
                        $details_titik_rawan_berat = mysqli_num_rows($detail_titik_rawan_berat);
                        echo $details_titik_rawan_berat; ?></dd>

                    <dt>Jumlah Korban Meninggal:</dt>
                    <dd><?php
                        $detail_titik_rawan_meninggal = "SELECT SUM(jumlah_meninggal) as total_jumlah_meninggal FROM laka WHERE id_titik_rawan='$id_titik_rawan'";
                        $detail_titik_rawan_meninggal = mysqli_query($conn, $detail_titik_rawan_meninggal);
                        $details_titik_rawan_meninggal = mysqli_fetch_assoc($detail_titik_rawan_meninggal);
                        echo $details_titik_rawan_meninggal['total_jumlah_meninggal']; ?></dd>

                    <dt>Luka Berat / Ringan:</dt>
                    <dd><?php
                        $detail_titik_rawan_beratringan = "SELECT SUM(jumlah_luka_berat) as total_jumlah_luka_berat, SUM(jumlah_luka_ringan) as total_jumlah_luka_ringan FROM laka WHERE id_titik_rawan='$id_titik_rawan'";
                        $detail_titik_rawan_beratringan = mysqli_query($conn, $detail_titik_rawan_beratringan);
                        $details_titik_rawan_beratringan = mysqli_fetch_assoc($detail_titik_rawan_beratringan);
                        echo $details_titik_rawan_beratringan['total_jumlah_luka_berat'] . " / " . $details_titik_rawan_beratringan['total_jumlah_luka_ringan']; ?></dd>

                    <dt>Status Jalan:</dt>
                    <dd><?php
                        $count_status_jalan_query = "SELECT laka.id_status_jalan, COUNT(laka.id_status_jalan) AS jumlah FROM laka JOIN status_jalan ON laka.id_status_jalan=status_jalan.id_status_jalan WHERE laka.id_titik_rawan='$id_titik_rawan' GROUP BY laka.id_status_jalan ORDER BY jumlah DESC LIMIT 1";
                        $count_status_jalan_result = mysqli_query($conn, $count_status_jalan_query);
                        if ($count_status_jalan_result) {
                          $count_status_jalan_row = mysqli_fetch_assoc($count_status_jalan_result);
                          if ($count_status_jalan_row) {
                            $id_status_jalan_terbanyak = $count_status_jalan_row['id_status_jalan'];
                            $detail_titik_rawan_status_jalan_query = "SELECT * FROM laka JOIN status_jalan ON laka.id_status_jalan=status_jalan.id_status_jalan WHERE laka.id_titik_rawan='$id_titik_rawan' AND laka.id_status_jalan='$id_status_jalan_terbanyak'";
                            $detail_titik_rawan_status_jalan_result = mysqli_query($conn, $detail_titik_rawan_status_jalan_query);
                            $details_titik_rawan_status_jalan = mysqli_fetch_assoc($detail_titik_rawan_status_jalan_result);
                            echo $details_titik_rawan_status_jalan['status_jalan'];
                          } else {
                            echo "Tidak ada data status jalan";
                          }
                        } else {
                          echo "Gagal mengambil data status jalan";
                        }
                        ?></dd>

                    <dt>Titik Rawan:</dt>
                    <dd><?= $data['nama_jalan_rawan'] ?></dd>

                    <dt>Polres:</dt>
                    <dd><?php
                        $count_polres_query = "SELECT laka.id_polres, COUNT(laka.id_polres) AS jumlah FROM laka JOIN polres ON laka.id_polres=polres.id_polres WHERE laka.id_titik_rawan='$id_titik_rawan' GROUP BY laka.id_polres ORDER BY jumlah DESC LIMIT 1";
                        $count_polres_result = mysqli_query($conn, $count_polres_query);
                        if ($count_polres_result) {
                          $count_polres_row = mysqli_fetch_assoc($count_polres_result);
                          if ($count_polres_row) {
                            $id_polres_terbanyak = $count_polres_row['id_polres'];
                            $detail_titik_rawan_polres_query = "SELECT * FROM laka JOIN polres ON laka.id_polres=polres.id_polres WHERE laka.id_titik_rawan='$id_titik_rawan' AND laka.id_polres='$id_polres_terbanyak'";
                            $detail_titik_rawan_polres_result = mysqli_query($conn, $detail_titik_rawan_polres_query);
                            $details_titik_rawan_polres = mysqli_fetch_assoc($detail_titik_rawan_polres_result);
                            echo $details_titik_rawan_polres['nama_polres'];
                          } else {
                            echo "Tidak ada data polres";
                          }
                        } else {
                          echo "Gagal mengambil data polres";
                        }
                        ?></dd>

                  </dl>

                </div>
              </section>

              <section id="location">
                <h3>Location</h3>

                <div class="ts-box shadow">

                  <dl class="ts-description-list__line mb-0">

                    <dt><i class="fa fa-map-marker ts-opacity__30 mr-2"></i>Alamat:</dt>
                    <dd class="border-bottom pb-2"><?= $data['nama_jalan_rawan'] ?></dd>

                    <dt><i class="fas fa-map-pin ts-opacity__30 mr-2"></i>Latitude:</dt>
                    <dd class="border-bottom pb-2"><?= $data['latitude'] ?></dd>

                    <dt><i class="fas fa-map-pin ts-opacity__30 mr-2"></i>Longitude:</dt>
                    <dd class="border-bottom pb-2"><?= $data['longitude'] ?></dd>

                  </dl>

                </div>

              </section>

            </div>

            <div class="col-md-7 col-lg-8">

              <section id="quick-info">
                <h3>Data Kecelakaan</h3>

                <!--Quick Info-->
                <div class="card mb-4 border-0">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-sm text-dark" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th class="text-center">No. Laka</th>
                            <th class="text-center">Polres</th>
                            <th class="text-center">Waktu Kejadian</th>
                            <th class="text-center">Tingkat Kecelakaan</th>
                            <th class="text-center">Jumlah Meninggal</th>
                            <th class="text-center">Jumlah Luka Berat</th>
                            <th class="text-center">Jumlah Luka Ringan</th>
                            <th class="text-center">Titik Acuan</th>
                            <th class="text-center">Informasi Khusus</th>
                            <th class="text-center">Tipe Kecelakaan</th>
                            <th class="text-center">Kondisi Cahaya</th>
                            <th class="text-center">Cuaca</th>
                            <th class="text-center">kecelakaan Menonjol</th>
                            <th class="text-center">Nama Jalan</th>
                            <th class="text-center">Fungsi Jalan</th>
                            <th class="text-center">Kelas Jalan</th>
                            <th class="text-center">Tipe Jalan</th>
                            <th class="text-center">Permukaan Jalan</th>
                            <th class="text-center">Batas Kecepatan</th>
                            <th class="text-center">Kemiringan Jalan</th>
                            <th class="text-center">Status Jalan</th>
                            <th class="text-center">Nilai Kerugian Non Kendaraan</th>
                            <th class="text-center">Nilai Kerugian Kendaraan</th>
                            <th class="text-center">Keterangan Kerugian</th>
                          </tr>
                        </thead>
                        <tfoot>
                          <tr>
                            <th class="text-center">No. Laka</th>
                            <th class="text-center">Polres</th>
                            <th class="text-center">Waktu Kejadian</th>
                            <th class="text-center">Tingkat Kecelakaan</th>
                            <th class="text-center">Jumlah Meninggal</th>
                            <th class="text-center">Jumlah Luka Berat</th>
                            <th class="text-center">Jumlah Luka Ringan</th>
                            <th class="text-center">Titik Acuan</th>
                            <th class="text-center">Informasi Khusus</th>
                            <th class="text-center">Tipe Kecelakaan</th>
                            <th class="text-center">Kondisi Cahaya</th>
                            <th class="text-center">Cuaca</th>
                            <th class="text-center">kecelakaan Menonjol</th>
                            <th class="text-center">Nama Jalan</th>
                            <th class="text-center">Fungsi Jalan</th>
                            <th class="text-center">Kelas Jalan</th>
                            <th class="text-center">Tipe Jalan</th>
                            <th class="text-center">Permukaan Jalan</th>
                            <th class="text-center">Batas Kecepatan</th>
                            <th class="text-center">Kemiringan Jalan</th>
                            <th class="text-center">Status Jalan</th>
                            <th class="text-center">Nilai Kerugian Non Kendaraan</th>
                            <th class="text-center">Nilai Kerugian Kendaraan</th>
                            <th class="text-center">Keterangan Kerugian</th>
                          </tr>
                        </tfoot>
                        <tbody>
                          <?php foreach ($views_laka as $data) { ?>
                            <tr>
                              <td>
                                <p><?= $data['no_laka'] ?></p>
                                <img src="assets/img/laka/<?= $data['img_laka'] ?>" style="width: 200px;" alt="">
                              </td>
                              <td><?= $data['nama_polres'] ?></td>
                              <td><?= $data['tanggal_kejadian'] . " " . $data['jam_kejadian'] ?></td>
                              <td><?= $data['tingkat_kecelakaan'] ?></td>
                              <td><?= $data['jumlah_meninggal'] ?></td>
                              <td><?= $data['jumlah_luka_berat'] ?></td>
                              <td><?= $data['jumlah_luka_ringan'] ?></td>
                              <td><?= $data['titik_acuan'] ?></td>
                              <td><?= $data['informasi_khusus'] ?></td>
                              <td><?= $data['tipe_kecelakaan'] ?></td>
                              <td><?= $data['kondisi_cahaya'] ?></td>
                              <td><?= $data['kondisi'] ?></td>
                              <td><?= $data['kecelakaan_menonjol'] ?></td>
                              <td><?= $data['nama_jalan_rawan'] ?></td>
                              <td><?= $data['fungsi_jalan'] ?></td>
                              <td><?= $data['kelas_jalan'] ?></td>
                              <td><?= $data['tipe_jalan'] ?></td>
                              <td><?= $data['permukaan_jalan'] ?></td>
                              <td><?= $data['batas_kecepatan_dilokasi'] ?></td>
                              <td><?= $data['kemiringan_jalan'] ?></td>
                              <td><?= $data['status_jalan'] ?></td>
                              <td>Rp. <?= number_format($data['nilai_kerugian_non_kendaraan']) ?></td>
                              <td>Rp. <?= number_format($data['nilai_kerugian_kendaraan']) ?></td>
                              <td><?= $data['keterangan_kerugian'] ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!--end ts-quick-info-->

              </section>

              <section id="map-location">

                <h3>Maps</h3>

                <div id="map" class="shadow" style="width: 100%; height: 150vh;z-index: 0;"></div>
                <?php $select_laka = "SELECT laka.*, informasi_khusus.informasi_khusus, kondisi_cahaya.kondisi_cahaya, cuaca.kondisi, tingkat_kecelakaan.tingkat_kecelakaan, kecelakaan_menonjol.kecelakaan_menonjol, fungsi_jalan.fungsi_jalan, kelas_jalan.kelas_jalan, tipe_jalan.tipe_jalan, permukaan_jalan.permukaan_jalan, kemiringan_jalan.kemiringan_jalan, status_jalan.status_jalan, polres.nama_polres, polres.alamat, polres.telepon, polres.email, polres.jumlah_anggota, titik_rawan.nama_jalan_rawan
                                              FROM laka 
                                              JOIN informasi_khusus ON laka.id_informasi_khusus=informasi_khusus.id_informasi_khusus
                                              JOIN kondisi_cahaya ON laka.id_kondisi_cahaya=kondisi_cahaya.id_kondisi_cahaya
                                              JOIN cuaca ON laka.id_cuaca=cuaca.id_cuaca
                                              JOIN tingkat_kecelakaan ON laka.id_tingkat_kecelakaan=tingkat_kecelakaan.id_tingkat_kecelakaan
                                              JOIN kecelakaan_menonjol ON laka.id_kecelakaan_menonjol=kecelakaan_menonjol.id_kecelakaan_menonjol
                                              JOIN fungsi_jalan ON laka.id_fungsi_jalan=fungsi_jalan.id_fungsi_jalan
                                              JOIN kelas_jalan ON laka.id_kelas_jalan=kelas_jalan.id_kelas_jalan
                                              JOIN tipe_jalan ON laka.id_tipe_jalan=tipe_jalan.id_tipe_jalan
                                              JOIN permukaan_jalan ON laka.id_permukaan_jalan=permukaan_jalan.id_permukaan_jalan
                                              JOIN kemiringan_jalan ON laka.id_kemiringan_jalan=kemiringan_jalan.id_kemiringan_jalan
                                              JOIN status_jalan ON laka.id_status_jalan=status_jalan.id_status_jalan
                                              JOIN polres ON laka.id_polres=polres.id_polres
                                              JOIN titik_rawan ON laka.id_titik_rawan=titik_rawan.id_titik_rawan
                                              WHERE laka.id_titik_rawan='$id_titik_rawan%'";
                $take_laka = mysqli_query($conn, $select_laka); ?>
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

                    <?php foreach ($take_laka as $data) { ?>
                      var distance = calculateDistance(data_geolocation.loc[0], data_geolocation.loc[1], <?= $data['latitude'] ?>, <?= $data['longitude'] ?>);
                      if (distance < nearestDistance) {
                        nearestDistance = distance;
                        nearestDangerZone = <?= json_encode($data) ?>;
                      }
                    <?php } ?>

                    return nearestDangerZone;
                  }

                  function initializeMap() {
                    var map = L.map('map').setView(data_geolocation.loc, 16);
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

                    <?php foreach ($take_laka as $data) { ?>
                      var marker = L.marker([<?= $data['latitude'] ?>, <?= $data['longitude'] ?>], {
                        icon: iconLock
                      }).addTo(map);

                      marker.bindPopup(
                        "<div style='background-color: #fff; padding: 10px; border-radius: 5px;'>" +
                        "<img src='assets/img/laka/<?= $data['img_laka'] ?>' style='max-width: 250px; height: auto; border-radius: 5px;' alt=''>" +
                        "<h2 style='margin-top: 5px; font-size: 16px; font-weight: bold; color: #333;'>" + <?= json_encode($data['nama_jalan_rawan']) ?> + "</h2>" +
                        "<p style='margin-top: -15px;'>No. Laka: <?= $data['no_laka'] ?></p>" +
                        "<p style='margin-top: -20px;'>Polres: <?= $data['nama_polres'] ?></p>" +
                        "<p style='margin-top: -20px;'>Waktu Kejadian: <?= $data['tanggal_kejadian'] . " " . $data['jam_kejadian'] ?></p>" +
                        "<p style='margin-top: -20px;'>Tingkat Kecelakaan: <?= $data['tingkat_kecelakaan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Jumlah Meninggal: <?= $data['jumlah_meninggal'] ?></p>" +
                        "<p style='margin-top: -20px;'>Jumlah Luka Berat: <?= $data['jumlah_luka_berat'] ?></p>" +
                        "<p style='margin-top: -20px;'>Jumlah Luka Ringan: <?= $data['jumlah_luka_ringan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Titik Acuan: <?= $data['titik_acuan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Informasi Khusus: <?= $data['informasi_khusus'] ?></p>" +
                        "<p style='margin-top: -20px;'>Tipe Kecelakaan: <?= $data['tipe_kecelakaan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Kondisi Cahaya: <?= $data['kondisi_cahaya'] ?></p>" +
                        "<p style='margin-top: -20px;'>Cuaca: <?= $data['kondisi'] ?></p>" +
                        "<p style='margin-top: -20px;'>kecelakaan Menonjol: <?= $data['kecelakaan_menonjol'] ?></p>" +
                        "<p style='margin-top: -20px;'>Nama Jalan: <?= $data['nama_jalan_rawan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Fungsi Jalan: <?= $data['fungsi_jalan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Kelas Jalan: <?= $data['kelas_jalan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Tipe Jalan: <?= $data['tipe_jalan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Permukaan Jalan: <?= $data['permukaan_jalan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Batas Kecepatan: <?= $data['batas_kecepatan_dilokasi'] ?></p>" +
                        "<p style='margin-top: -20px;'>Kemiringan Jalan: <?= $data['kemiringan_jalan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Status Jalan: <?= $data['status_jalan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Nilai Kerugian Non Kendaraan: <?= $data['nilai_kerugian_non_kendaraan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Nilai Kerugian Kendaraan: <?= $data['nilai_kerugian_kendaraan'] ?></p>" +
                        "<p style='margin-top: -20px;'>Keterangan Kerugian: <?= $data['keterangan_kerugian'] ?></p>" +
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
                        "<img src='assets/img/laka/" + nearestDangerZone.img_laka + "' style='max-width: 100%; height: auto; border-radius: 5px;' alt=''>" +
                        "<h2 style='margin-top: 5px; font-size: 16px; font-weight: bold; color: #333;'>" + nearestDangerZone.nama_jalan_rawan + "</h2>" +
                        "<p style='margin-top: -15px;'>No. Laka: " + nearestDangerZone.no_laka + "</p>" +
                        "<p style='margin-top: -20px;'>Polres: " + nearestDangerZone.nama_polres + "</p>" +
                        "<p style='margin-top: -20px;'>Waktu Kejadian: " + nearestDangerZone.tanggal_kejadian + " " + nearestDangerZone.jam_kejadian + "</p>" +
                        "<p style='margin-top: -20px;'>Tingkat Kecelakaan: " + nearestDangerZone.tingkat_kecelakaan + "</p>" +
                        "<p style='margin-top: -20px;'>Jumlah Meninggal: " + nearestDangerZone.jumlah_meninggal + "</p>" +
                        "<p style='margin-top: -20px;'>Jumlah Luka Berat: " + nearestDangerZone.jumlah_luka_berat + "</p>" +
                        "<p style='margin-top: -20px;'>Jumlah Luka Ringan: " + nearestDangerZone.jumlah_luka_ringan + "</p>" +
                        "<p style='margin-top: -20px;'>Titik Acuan: " + nearestDangerZone.titik_acuan + "</p>" +
                        "<p style='margin-top: -20px;'>Informasi Khusus: " + nearestDangerZone.informasi_khusus + "</p>" +
                        "<p style='margin-top: -20px;'>Tipe Kecelakaan: " + nearestDangerZone.tipe_kecelakaan + "</p>" +
                        "<p style='margin-top: -20px;'>Kondisi Cahaya: " + nearestDangerZone.kondisi_cahaya + "</p>" +
                        "<p style='margin-top: -20px;'>Cuaca: " + nearestDangerZone.kondisi + "</p>" +
                        "<p style='margin-top: -20px;'>kecelakaan Menonjol: " + nearestDangerZone.kecelakaan_menonjol + "</p>" +
                        "<p style='margin-top: -20px;'>Nama Jalan: " + nearestDangerZone.nama_jalan_rawan + "</p>" +
                        "<p style='margin-top: -20px;'>Fungsi Jalan: " + nearestDangerZone.fungsi_jalan + "</p>" +
                        "<p style='margin-top: -20px;'>Kelas Jalan: " + nearestDangerZone.kelas_jalan + "</p>" +
                        "<p style='margin-top: -20px;'>Tipe Jalan: " + nearestDangerZone.tipe_jalan + "</p>" +
                        "<p style='margin-top: -20px;'>Permukaan Jalan: " + nearestDangerZone.permukaan_jalan + "</p>" +
                        "<p style='margin-top: -20px;'>Batas Kecepatan: " + nearestDangerZone.batas_kecepatan_dilokasi + "</p>" +
                        "<p style='margin-top: -20px;'>Kemiringan Jalan: " + nearestDangerZone.kemiringan_jalan + "</p>" +
                        "<p style='margin-top: -20px;'>Status Jalan: " + nearestDangerZone.status_jalan + "</p>" +
                        "<p style='margin-top: -20px;'>Nilai Kerugian Non Kendaraan: " + nearestDangerZone.nilai_kerugian_non_kendaraan + "</p>" +
                        "<p style='margin-top: -20px;'>Nilai Kerugian Kendaraan: " + nearestDangerZone.nilai_kerugian_kendaraan + "</p>" +
                        "<p style='margin-top: -20px;'>Keterangan Kerugian: " + nearestDangerZone.keterangan_kerugian + "</p>" +
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

              </section>

            </div>

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

  </div>

  <?php require_once("sections/footer.php"); ?>

</body>

</html>