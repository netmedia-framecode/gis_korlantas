<?php require_once("controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Pesan Kapolri"; ?>

<!doctype html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <div class="ts-page-wrapper ts-has-bokeh-bg" id="page-top">
    <?php require_once("sections/navbar.php"); ?>

    <main id="ts-main">

      <section id="breadcrumb">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Beranda</a></li>
              <li class="breadcrumb-item active" aria-current="page">Titik Rawan</li>
            </ol>
          </nav>
        </div>
      </section>

      <section id="page-title">
        <div class="container">
          <div class="ts-title">
            <h1>Titik Rawan</h1>
          </div>
        </div>
      </section>

      <section id="about-us-description">
        <div class="container">
          <div class="row">
            <?php if (isset($_GET['id'])) {
              $id_titik_rawan = valid($conn, $_GET['id']);
              $select_titik_rawan = "SELECT * FROM titik_rawan WHERE id_titik_rawan='$id_titik_rawan'";
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
              $views_laka = mysqli_query($conn, $select_laka); ?>

              <section id="page-title">
                <div class="container">
                  <div class="d-block d-sm-flex justify-content-between">
                    <div class="ts-title mb-0">
                      <h1><i class="fa fa-map-marker text-primary"></i> <?= $data['nama_jalan_rawan'] ?></h1>
                    </div>
                  </div>
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
                    </div>
                    <div class="col-md-7 col-lg-8">
                      <section id="quick-info">
                        <h3>Data Kecelakaan</h3>
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
                                      <td><?= $data['no_laka'] ?></td>
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
                      </section>
                    </div>
                  </div>
                </div>
              </section>
            <?php }
            foreach ($views_titik_rawan_overview as $data) {
              $id_titik_rawan = $data['id_titik_rawan']; ?>
              <div class="col-sm-6 col-lg-3">
                <div class="card ts-item ts-card">
                  <a href="titik-rawan?id=<?= $id_titik_rawan ?>" class="card-img ts-item__image" data-bg-image="assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>">
                    <figure class="ts-item__info">
                      <h4><i class="fa fa-map-marker mr-2"></i><?= $data['nama_jalan_rawan'] ?></h4>
                    </figure>
                  </a>
                  <div class="card-body">
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
                  <a href="titik-rawan?id=<?= $id_titik_rawan ?>" class="card-footer">
                    <span class="ts-btn-arrow">Detail</span>
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
          <hr class="my-5">
        </div>
      </section>

    </main>

    <?php require_once("sections/footer.php"); ?>

</body>

</html>