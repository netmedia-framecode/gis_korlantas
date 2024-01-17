<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Data Kecelakaan";
require_once("../templates/views_top.php");
if (isset($_SESSION["project_gis_korlantas"]["id_pemetaan"])) {
  unset($_SESSION["project_gis_korlantas"]["id_pemetaan"]);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_gis_korlantas"]["name_page"] ?></h1>
    <div class="d-none d-sm-inline-block">
      <a href="#" class="btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
      <a href="export" class="btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Export</a>
    </div>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
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
              <th class="text-center">Aksi</th>
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
              <th class="text-center">Aksi</th>
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
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit<?= $data['id_laka'] ?>">
                    <i class="bi bi-pen"></i> Ubah
                  </button>
                  <div class="modal fade" id="edit<?= $data['id_laka'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['no_laka'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_laka" value="<?= $data['id_laka'] ?>">
                          <input type="hidden" name="no_lakaOld" value="<?= $data['no_laka'] ?>">
                          <div class="modal-body">
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="id_informasi_khusus">Informasi Khusus</label>
                                <select name="id_informasi_khusus" class="form-control" id="id_informasi_khusus" required>
                                  <option value="" selected>Pilih Informasi Khusus</option>
                                  <?php if (isset($data['id_informasi_khusus'])) {
                                    $id_informasi_khusus = $data['id_informasi_khusus'];
                                    foreach ($views_informasi_khusus as $data_select_informasi_khusus) {
                                      $selected = ($data_select_informasi_khusus['id_informasi_khusus'] == $id_informasi_khusus) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_informasi_khusus['id_informasi_khusus'] ?>" <?= $selected ?>><?= $data_select_informasi_khusus['informasi_khusus'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_informasi_khusus as $data_select_informasi_khusus) { ?>
                                      <option value="<?= $data_select_informasi_khusus['id_informasi_khusus'] ?>"><?= $data_select_informasi_khusus['informasi_khusus'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_kondisi_cahaya">Kondisi Cahaya</label>
                                <select name="id_kondisi_cahaya" class="form-control" id="id_kondisi_cahaya" required>
                                  <option value="" selected>Pilih Kondisi Cahaya</option>
                                  <?php if (isset($data['id_kondisi_cahaya'])) {
                                    $id_kondisi_cahaya = $data['id_kondisi_cahaya'];
                                    foreach ($views_kondisi_cahaya as $data_select_kondisi_cahaya) {
                                      $selected = ($data_select_kondisi_cahaya['id_kondisi_cahaya'] == $id_kondisi_cahaya) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_kondisi_cahaya['id_kondisi_cahaya'] ?>" <?= $selected ?>><?= $data_select_kondisi_cahaya['kondisi_cahaya'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_kondisi_cahaya as $data_select_kondisi_cahaya) { ?>
                                      <option value="<?= $data_select_kondisi_cahaya['id_kondisi_cahaya'] ?>"><?= $data_select_kondisi_cahaya['kondisi_cahaya'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_tingkat_kecelakaan">Cuaca</label>
                                <select name="id_cuaca" class="form-control" id="id_cuaca" required>
                                  <option value="" selected>Pilih Cuaca</option>
                                  <?php if (isset($data['id_cuaca'])) {
                                    $id_cuaca = $data['id_cuaca'];
                                    foreach ($views_cuaca as $data_select_cuaca) {
                                      $selected = ($data_select_cuaca['id_cuaca'] == $id_cuaca) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_cuaca['id_cuaca'] ?>" <?= $selected ?>><?= $data_select_cuaca['kondisi'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_cuaca as $data_select_cuaca) { ?>
                                      <option value="<?= $data_select_cuaca['id_cuaca'] ?>"><?= $data_select_cuaca['kondisi'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_tingkat_kecelakaan">Tingkat Kecelakaan</label>
                                <select name="id_tingkat_kecelakaan" class="form-control" id="id_tingkat_kecelakaan" required>
                                  <option value="" selected>Pilih Tingkat Kecelakaan</option>
                                  <?php if (isset($data['id_tingkat_kecelakaan'])) {
                                    $id_tingkat_kecelakaan = $data['id_tingkat_kecelakaan'];
                                    foreach ($views_tingkat_kecelakaan as $data_select_tingkat_kecelakaan) {
                                      $selected = ($data_select_tingkat_kecelakaan['id_tingkat_kecelakaan'] == $id_tingkat_kecelakaan) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_tingkat_kecelakaan['id_tingkat_kecelakaan'] ?>" <?= $selected ?>><?= $data_select_tingkat_kecelakaan['tingkat_kecelakaan'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_tingkat_kecelakaan as $data_select_tingkat_kecelakaan) { ?>
                                      <option value="<?= $data_select_tingkat_kecelakaan['id_tingkat_kecelakaan'] ?>"><?= $data_select_tingkat_kecelakaan['tingkat_kecelakaan'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_kecelakaan_menonjol">Kecelakaan Menonjol</label>
                                <select name="id_kecelakaan_menonjol" class="form-control" id="id_kecelakaan_menonjol" required>
                                  <option value="" selected>Pilih Kecelakaan Menonjol</option>
                                  <?php if (isset($data['id_kecelakaan_menonjol'])) {
                                    $id_kecelakaan_menonjol = $data['id_kecelakaan_menonjol'];
                                    foreach ($views_kecelakaan_menonjol as $data_select_kecelakaan_menonjol) {
                                      $selected = ($data_select_kecelakaan_menonjol['id_kecelakaan_menonjol'] == $id_kecelakaan_menonjol) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_kecelakaan_menonjol['id_kecelakaan_menonjol'] ?>" <?= $selected ?>><?= $data_select_kecelakaan_menonjol['kecelakaan_menonjol'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_kecelakaan_menonjol as $data_select_kecelakaan_menonjol) { ?>
                                      <option value="<?= $data_select_kecelakaan_menonjol['id_kecelakaan_menonjol'] ?>"><?= $data_select_kecelakaan_menonjol['kecelakaan_menonjol'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_fungsi_jalan">Fungsi Jalan</label>
                                <select name="id_fungsi_jalan" class="form-control" id="id_fungsi_jalan" required>
                                  <option value="" selected>Pilih Fungsi Jalan</option>
                                  <?php if (isset($data['id_fungsi_jalan'])) {
                                    $id_fungsi_jalan = $data['id_fungsi_jalan'];
                                    foreach ($views_fungsi_jalan as $data_select_fungsi_jalan) {
                                      $selected = ($data_select_fungsi_jalan['id_fungsi_jalan'] == $id_fungsi_jalan) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_fungsi_jalan['id_fungsi_jalan'] ?>" <?= $selected ?>><?= $data_select_fungsi_jalan['fungsi_jalan'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_fungsi_jalan as $data_select_fungsi_jalan) { ?>
                                      <option value="<?= $data_select_fungsi_jalan['id_fungsi_jalan'] ?>"><?= $data_select_fungsi_jalan['fungsi_jalan'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_kelas_jalan">Kelas Jalan</label>
                                <select name="id_kelas_jalan" class="form-control" id="id_kelas_jalan" required>
                                  <option value="" selected>Pilih Kelas Jalan</option>
                                  <?php if (isset($data['id_kelas_jalan'])) {
                                    $id_kelas_jalan = $data['id_kelas_jalan'];
                                    foreach ($views_kelas_jalan as $data_select_kelas_jalan) {
                                      $selected = ($data_select_kelas_jalan['id_kelas_jalan'] == $id_kelas_jalan) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_kelas_jalan['id_kelas_jalan'] ?>" <?= $selected ?>><?= $data_select_kelas_jalan['kelas_jalan'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_kelas_jalan as $data_select_kelas_jalan) { ?>
                                      <option value="<?= $data_select_kelas_jalan['id_kelas_jalan'] ?>"><?= $data_select_kelas_jalan['kelas_jalan'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_tipe_jalan">Tipe Jalan</label>
                                <select name="id_tipe_jalan" class="form-control" id="id_tipe_jalan" required>
                                  <option value="" selected>Pilih Tipe Jalan</option>
                                  <?php if (isset($data['id_tipe_jalan'])) {
                                    $id_tipe_jalan = $data['id_tipe_jalan'];
                                    foreach ($views_tipe_jalan as $data_select_tipe_jalan) {
                                      $selected = ($data_select_tipe_jalan['id_tipe_jalan'] == $id_tipe_jalan) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_tipe_jalan['id_tipe_jalan'] ?>" <?= $selected ?>><?= $data_select_tipe_jalan['tipe_jalan'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_tipe_jalan as $data_select_tipe_jalan) { ?>
                                      <option value="<?= $data_select_tipe_jalan['id_tipe_jalan'] ?>"><?= $data_select_tipe_jalan['tipe_jalan'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_permukaan_jalan">Permukaan Jalan</label>
                                <select name="id_permukaan_jalan" class="form-control" id="id_permukaan_jalan" required>
                                  <option value="" selected>Pilih Permukaan Jalan</option>
                                  <?php if (isset($data['id_permukaan_jalan'])) {
                                    $id_permukaan_jalan = $data['id_permukaan_jalan'];
                                    foreach ($views_permukaan_jalan as $data_select_permukaan_jalan) {
                                      $selected = ($data_select_permukaan_jalan['id_permukaan_jalan'] == $id_permukaan_jalan) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_permukaan_jalan['id_permukaan_jalan'] ?>" <?= $selected ?>><?= $data_select_permukaan_jalan['permukaan_jalan'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_permukaan_jalan as $data_select_permukaan_jalan) { ?>
                                      <option value="<?= $data_select_permukaan_jalan['id_permukaan_jalan'] ?>"><?= $data_select_permukaan_jalan['permukaan_jalan'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_kemiringan_jalan">Kemiringan Jalan</label>
                                <select name="id_kemiringan_jalan" class="form-control" id="id_kemiringan_jalan" required>
                                  <option value="" selected>Pilih Kemiringan Jalan</option>
                                  <?php if (isset($data['id_kemiringan_jalan'])) {
                                    $id_kemiringan_jalan = $data['id_kemiringan_jalan'];
                                    foreach ($views_kemiringan_jalan as $data_select_kemiringan_jalan) {
                                      $selected = ($data_select_kemiringan_jalan['id_kemiringan_jalan'] == $id_kemiringan_jalan) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_kemiringan_jalan['id_kemiringan_jalan'] ?>" <?= $selected ?>><?= $data_select_kemiringan_jalan['kemiringan_jalan'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_kemiringan_jalan as $data_select_kemiringan_jalan) { ?>
                                      <option value="<?= $data_select_kemiringan_jalan['id_kemiringan_jalan'] ?>"><?= $data_select_kemiringan_jalan['kemiringan_jalan'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_status_jalan">Status Jalan</label>
                                <select name="id_status_jalan" class="form-control" id="id_status_jalan" required>
                                  <option value="" selected>Pilih Status Jalan</option>
                                  <?php if (isset($data['id_status_jalan'])) {
                                    $id_status_jalan = $data['id_status_jalan'];
                                    foreach ($views_status_jalan as $data_select_status_jalan) {
                                      $selected = ($data_select_status_jalan['id_status_jalan'] == $id_status_jalan) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_status_jalan['id_status_jalan'] ?>" <?= $selected ?>><?= $data_select_status_jalan['status_jalan'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_status_jalan as $data_select_status_jalan) { ?>
                                      <option value="<?= $data_select_status_jalan['id_status_jalan'] ?>"><?= $data_select_status_jalan['status_jalan'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="id_polres">Polres</label>
                                <select name="id_polres" class="form-control" id="id_polres" required>
                                  <option value="" selected>Pilih Polres</option>
                                  <?php if (isset($data['id_polres'])) {
                                    $id_polres = $data['id_polres'];
                                    foreach ($views_polres as $data_select_polres) {
                                      $selected = ($data_select_polres['id_polres'] == $id_polres) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_polres['id_polres'] ?>" <?= $selected ?>><?= $data_select_polres['nama_polres'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_polres as $data_select_polres) { ?>
                                      <option value="<?= $data_select_polres['id_polres'] ?>"><?= $data_select_polres['nama_polres'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="no_laka">No. Laka</label>
                                <input type="text" name="no_laka" value="<?php if (isset($data['no_laka'])) {
                                                                            echo $data['no_laka'];
                                                                          } ?>" class="form-control" id="no_laka" placeholder="" required>
                              </div>
                              <div class="form-group">
                                <label for="tanggal_kejadian">Tgl. Kejadian</label>
                                <input type="date" name="tanggal_kejadian" value="<?php if (isset($data['tanggal_kejadian'])) {
                                                                                    echo $data['tanggal_kejadian'];
                                                                                  } ?>" class="form-control" id="tanggal_kejadian" placeholder="" required>
                              </div>
                              <div class="form-group">
                                <label for="jam_kejadian">Jam Kejadian</label>
                                <input type="time" name="jam_kejadian" value="<?php if (isset($data['jam_kejadian'])) {
                                                                                echo $data['jam_kejadian'];
                                                                              } ?>" class="form-control" id="jam_kejadian" placeholder="" required>
                              </div>
                              <div class="form-group">
                                <label for="jumlah_meninggal">Jumlah Meninggal</label>
                                <input type="number" name="jumlah_meninggal" value="<?php if (isset($data['jumlah_meninggal'])) {
                                                                                      echo $data['jumlah_meninggal'];
                                                                                    } ?>" class="form-control" id="jumlah_meninggal" placeholder="" required>
                              </div>
                              <div class="form-group">
                                <label for="jumlah_luka_berat">Jumlah Luka Berat</label>
                                <input type="number" name="jumlah_luka_berat" value="<?php if (isset($data['jumlah_luka_berat'])) {
                                                                                        echo $data['jumlah_luka_berat'];
                                                                                      } ?>" class="form-control" id="jumlah_luka_berat" placeholder="" required>
                              </div>
                              <div class="form-group">
                                <label for="jumlah_luka_ringan">Jumlah Luka Ringan</label>
                                <input type="number" name="jumlah_luka_ringan" value="<?php if (isset($data['jumlah_luka_ringan'])) {
                                                                                        echo $data['jumlah_luka_ringan'];
                                                                                      } ?>" class="form-control" id="jumlah_luka_ringan" placeholder="" required>
                              </div>
                              <div class="form-group">
                                <label for="titik_acuan">Titik Acuan</label>
                                <input type="text" name="titik_acuan" value="<?php if (isset($data['titik_acuan'])) {
                                                                                echo $data['titik_acuan'];
                                                                              } ?>" class="form-control" id="titik_acuan" placeholder="" required>
                                <small>Contoh: tempat ibadah, simpang, sekolah atau kampus.</small>
                              </div>
                              <div class="form-group">
                                <label for="tipe_kecelakaan">Tipe Kecelakaan</label>
                                <input type="text" name="tipe_kecelakaan" value="<?php if (isset($data['tipe_kecelakaan'])) {
                                                                                    echo $data['tipe_kecelakaan'];
                                                                                  } ?>" class="form-control" id="tipe_kecelakaan" placeholder="" required>
                                <small>Contoh: tabrakan depan - belakang, tabrakan saat menyalip dari kanan, rem blong atau lainnya</small>
                              </div>
                              <div class="form-group">
                                <label for="id_titik_rawan">Nama Jalan</label>
                                <select name="id_titik_rawan" class="form-control" id="id_titik_rawan" required>
                                  <option value="" selected>Pilih Nama Jalan</option>
                                  <?php if (isset($data['nama_jalan_rawan'])) {
                                    $nama_jalan_rawan = $data['nama_jalan_rawan'];
                                    foreach ($views_titik_rawan as $data_select_titik_rawan) {
                                      $selected = ($data_select_titik_rawan['nama_jalan_rawan'] == $nama_jalan_rawan) ? 'selected' : ''; ?>
                                      <option value="<?= $data_select_titik_rawan['id_titik_rawan'] ?>" <?= $selected ?>><?= $data_select_titik_rawan['nama_jalan_rawan'] ?></option>
                                    <?php }
                                  } else {
                                    foreach ($views_titik_rawan as $data_select_titik_rawan) { ?>
                                      <option value="<?= $data_select_titik_rawan['id_titik_rawan'] ?>"><?= $data_select_titik_rawan['nama_jalan_rawan'] ?></option>
                                  <?php }
                                  } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="batas_kecepatan_dilokasi">Batas Kecepatan Dilokasi</label>
                                <input type="text" name="batas_kecepatan_dilokasi" value="<?php if (isset($data['batas_kecepatan_dilokasi'])) {
                                                                                            echo $data['batas_kecepatan_dilokasi'];
                                                                                          } ?>" class="form-control" id="batas_kecepatan_dilokasi" placeholder="" required>
                              </div>
                              <div class="form-group">
                                <label for="nilai_kerugian_non_kendaraan">Nilai Kerugian Non Kendaraan</label>
                                <input type="text" name="nilai_kerugian_non_kendaraan" value="<?php if (isset($data['nilai_kerugian_non_kendaraan'])) {
                                                                                                echo $data['nilai_kerugian_non_kendaraan'];
                                                                                              } ?>" class="form-control" id="nilai_kerugian_non_kendaraan" placeholder="">
                              </div>
                              <div class="form-group">
                                <label for="nilai_kerugian_kendaraan">Nilai Kerugian Kendaraan</label>
                                <input type="text" name="nilai_kerugian_kendaraan" value="<?php if (isset($data['nilai_kerugian_kendaraan'])) {
                                                                                            echo $data['nilai_kerugian_kendaraan'];
                                                                                          } ?>" class="form-control" id="nilai_kerugian_kendaraan" placeholder="">
                              </div>
                              <div class="form-group">
                                <label for="keterangan_kerugian">Keterangan Kerugian</label>
                                <input type="text" name="keterangan_kerugian" value="<?php if (isset($data['keterangan_kerugian'])) {
                                                                                        echo $data['keterangan_kerugian'];
                                                                                      } ?>" class="form-control" id="keterangan_kerugian" placeholder="">
                              </div>
                            </div>
                            <div class="modal-footer justify-content-center border-top-0">
                              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                              <button type="submit" name="edit_laka" class="btn btn-warning btn-sm">Ubah</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_laka'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_laka'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['no_laka'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_laka" value="<?= $data['id_laka'] ?>">
                          <input type="hidden" name="img_laka" value="<?= $data['img_laka'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_laka" class="btn btn-danger btn-sm">hapus</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="tambahLabel">Tambah Kecelakaan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_informasi_khusus">Informasi Khusus</label>
              <select name="id_informasi_khusus" class="form-control" id="id_informasi_khusus" required>
                <option value="" selected>Pilih Informasi Khusus</option>
                <?php if (isset($_POST['id_informasi_khusus'])) {
                  $id_informasi_khusus = $_POST['id_informasi_khusus'];
                  foreach ($views_informasi_khusus as $data_select_informasi_khusus) {
                    $selected = ($data_select_informasi_khusus['id_informasi_khusus'] == $id_informasi_khusus) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_informasi_khusus['id_informasi_khusus'] ?>" <?= $selected ?>><?= $data_select_informasi_khusus['informasi_khusus'] ?></option>
                  <?php }
                } else {
                  foreach ($views_informasi_khusus as $data_select_informasi_khusus) { ?>
                    <option value="<?= $data_select_informasi_khusus['id_informasi_khusus'] ?>"><?= $data_select_informasi_khusus['informasi_khusus'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_kondisi_cahaya">Kondisi Cahaya</label>
              <select name="id_kondisi_cahaya" class="form-control" id="id_kondisi_cahaya" required>
                <option value="" selected>Pilih Kondisi Cahaya</option>
                <?php if (isset($_POST['id_kondisi_cahaya'])) {
                  $id_kondisi_cahaya = $_POST['id_kondisi_cahaya'];
                  foreach ($views_kondisi_cahaya as $data_select_kondisi_cahaya) {
                    $selected = ($data_select_kondisi_cahaya['id_kondisi_cahaya'] == $id_kondisi_cahaya) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_kondisi_cahaya['id_kondisi_cahaya'] ?>" <?= $selected ?>><?= $data_select_kondisi_cahaya['kondisi_cahaya'] ?></option>
                  <?php }
                } else {
                  foreach ($views_kondisi_cahaya as $data_select_kondisi_cahaya) { ?>
                    <option value="<?= $data_select_kondisi_cahaya['id_kondisi_cahaya'] ?>"><?= $data_select_kondisi_cahaya['kondisi_cahaya'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_tingkat_kecelakaan">Cuaca</label>
              <select name="id_cuaca" class="form-control" id="id_cuaca" required>
                <option value="" selected>Pilih Cuaca</option>
                <?php if (isset($_POST['id_cuaca'])) {
                  $id_cuaca = $_POST['id_cuaca'];
                  foreach ($views_cuaca as $data_select_cuaca) {
                    $selected = ($data_select_cuaca['id_cuaca'] == $id_cuaca) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_cuaca['id_cuaca'] ?>" <?= $selected ?>><?= $data_select_cuaca['kondisi'] ?></option>
                  <?php }
                } else {
                  foreach ($views_cuaca as $data_select_cuaca) { ?>
                    <option value="<?= $data_select_cuaca['id_cuaca'] ?>"><?= $data_select_cuaca['kondisi'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_tingkat_kecelakaan">Tingkat Kecelakaan</label>
              <select name="id_tingkat_kecelakaan" class="form-control" id="id_tingkat_kecelakaan" required>
                <option value="" selected>Pilih Tingkat Kecelakaan</option>
                <?php if (isset($_POST['id_tingkat_kecelakaan'])) {
                  $id_tingkat_kecelakaan = $_POST['id_tingkat_kecelakaan'];
                  foreach ($views_tingkat_kecelakaan as $data_select_tingkat_kecelakaan) {
                    $selected = ($data_select_tingkat_kecelakaan['id_tingkat_kecelakaan'] == $id_tingkat_kecelakaan) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_tingkat_kecelakaan['id_tingkat_kecelakaan'] ?>" <?= $selected ?>><?= $data_select_tingkat_kecelakaan['tingkat_kecelakaan'] ?></option>
                  <?php }
                } else {
                  foreach ($views_tingkat_kecelakaan as $data_select_tingkat_kecelakaan) { ?>
                    <option value="<?= $data_select_tingkat_kecelakaan['id_tingkat_kecelakaan'] ?>"><?= $data_select_tingkat_kecelakaan['tingkat_kecelakaan'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_kecelakaan_menonjol">Kecelakaan Menonjol</label>
              <select name="id_kecelakaan_menonjol" class="form-control" id="id_kecelakaan_menonjol" required>
                <option value="" selected>Pilih Kecelakaan Menonjol</option>
                <?php if (isset($_POST['id_kecelakaan_menonjol'])) {
                  $id_kecelakaan_menonjol = $_POST['id_kecelakaan_menonjol'];
                  foreach ($views_kecelakaan_menonjol as $data_select_kecelakaan_menonjol) {
                    $selected = ($data_select_kecelakaan_menonjol['id_kecelakaan_menonjol'] == $id_kecelakaan_menonjol) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_kecelakaan_menonjol['id_kecelakaan_menonjol'] ?>" <?= $selected ?>><?= $data_select_kecelakaan_menonjol['kecelakaan_menonjol'] ?></option>
                  <?php }
                } else {
                  foreach ($views_kecelakaan_menonjol as $data_select_kecelakaan_menonjol) { ?>
                    <option value="<?= $data_select_kecelakaan_menonjol['id_kecelakaan_menonjol'] ?>"><?= $data_select_kecelakaan_menonjol['kecelakaan_menonjol'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_fungsi_jalan">Fungsi Jalan</label>
              <select name="id_fungsi_jalan" class="form-control" id="id_fungsi_jalan" required>
                <option value="" selected>Pilih Fungsi Jalan</option>
                <?php if (isset($_POST['id_fungsi_jalan'])) {
                  $id_fungsi_jalan = $_POST['id_fungsi_jalan'];
                  foreach ($views_fungsi_jalan as $data_select_fungsi_jalan) {
                    $selected = ($data_select_fungsi_jalan['id_fungsi_jalan'] == $id_fungsi_jalan) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_fungsi_jalan['id_fungsi_jalan'] ?>" <?= $selected ?>><?= $data_select_fungsi_jalan['fungsi_jalan'] ?></option>
                  <?php }
                } else {
                  foreach ($views_fungsi_jalan as $data_select_fungsi_jalan) { ?>
                    <option value="<?= $data_select_fungsi_jalan['id_fungsi_jalan'] ?>"><?= $data_select_fungsi_jalan['fungsi_jalan'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_kelas_jalan">Kelas Jalan</label>
              <select name="id_kelas_jalan" class="form-control" id="id_kelas_jalan" required>
                <option value="" selected>Pilih Kelas Jalan</option>
                <?php if (isset($_POST['id_kelas_jalan'])) {
                  $id_kelas_jalan = $_POST['id_kelas_jalan'];
                  foreach ($views_kelas_jalan as $data_select_kelas_jalan) {
                    $selected = ($data_select_kelas_jalan['id_kelas_jalan'] == $id_kelas_jalan) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_kelas_jalan['id_kelas_jalan'] ?>" <?= $selected ?>><?= $data_select_kelas_jalan['kelas_jalan'] ?></option>
                  <?php }
                } else {
                  foreach ($views_kelas_jalan as $data_select_kelas_jalan) { ?>
                    <option value="<?= $data_select_kelas_jalan['id_kelas_jalan'] ?>"><?= $data_select_kelas_jalan['kelas_jalan'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_tipe_jalan">Tipe Jalan</label>
              <select name="id_tipe_jalan" class="form-control" id="id_tipe_jalan" required>
                <option value="" selected>Pilih Tipe Jalan</option>
                <?php if (isset($_POST['id_tipe_jalan'])) {
                  $id_tipe_jalan = $_POST['id_tipe_jalan'];
                  foreach ($views_tipe_jalan as $data_select_tipe_jalan) {
                    $selected = ($data_select_tipe_jalan['id_tipe_jalan'] == $id_tipe_jalan) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_tipe_jalan['id_tipe_jalan'] ?>" <?= $selected ?>><?= $data_select_tipe_jalan['tipe_jalan'] ?></option>
                  <?php }
                } else {
                  foreach ($views_tipe_jalan as $data_select_tipe_jalan) { ?>
                    <option value="<?= $data_select_tipe_jalan['id_tipe_jalan'] ?>"><?= $data_select_tipe_jalan['tipe_jalan'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_permukaan_jalan">Permukaan Jalan</label>
              <select name="id_permukaan_jalan" class="form-control" id="id_permukaan_jalan" required>
                <option value="" selected>Pilih Permukaan Jalan</option>
                <?php if (isset($_POST['id_permukaan_jalan'])) {
                  $id_permukaan_jalan = $_POST['id_permukaan_jalan'];
                  foreach ($views_permukaan_jalan as $data_select_permukaan_jalan) {
                    $selected = ($data_select_permukaan_jalan['id_permukaan_jalan'] == $id_permukaan_jalan) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_permukaan_jalan['id_permukaan_jalan'] ?>" <?= $selected ?>><?= $data_select_permukaan_jalan['permukaan_jalan'] ?></option>
                  <?php }
                } else {
                  foreach ($views_permukaan_jalan as $data_select_permukaan_jalan) { ?>
                    <option value="<?= $data_select_permukaan_jalan['id_permukaan_jalan'] ?>"><?= $data_select_permukaan_jalan['permukaan_jalan'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_kemiringan_jalan">Kemiringan Jalan</label>
              <select name="id_kemiringan_jalan" class="form-control" id="id_kemiringan_jalan" required>
                <option value="" selected>Pilih Kemiringan Jalan</option>
                <?php if (isset($_POST['id_kemiringan_jalan'])) {
                  $id_kemiringan_jalan = $_POST['id_kemiringan_jalan'];
                  foreach ($views_kemiringan_jalan as $data_select_kemiringan_jalan) {
                    $selected = ($data_select_kemiringan_jalan['id_kemiringan_jalan'] == $id_kemiringan_jalan) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_kemiringan_jalan['id_kemiringan_jalan'] ?>" <?= $selected ?>><?= $data_select_kemiringan_jalan['kemiringan_jalan'] ?></option>
                  <?php }
                } else {
                  foreach ($views_kemiringan_jalan as $data_select_kemiringan_jalan) { ?>
                    <option value="<?= $data_select_kemiringan_jalan['id_kemiringan_jalan'] ?>"><?= $data_select_kemiringan_jalan['kemiringan_jalan'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_status_jalan">Status Jalan</label>
              <select name="id_status_jalan" class="form-control" id="id_status_jalan" required>
                <option value="" selected>Pilih Status Jalan</option>
                <?php if (isset($_POST['id_status_jalan'])) {
                  $id_status_jalan = $_POST['id_status_jalan'];
                  foreach ($views_status_jalan as $data_select_status_jalan) {
                    $selected = ($data_select_status_jalan['id_status_jalan'] == $id_status_jalan) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_status_jalan['id_status_jalan'] ?>" <?= $selected ?>><?= $data_select_status_jalan['status_jalan'] ?></option>
                  <?php }
                } else {
                  foreach ($views_status_jalan as $data_select_status_jalan) { ?>
                    <option value="<?= $data_select_status_jalan['id_status_jalan'] ?>"><?= $data_select_status_jalan['status_jalan'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="id_polres">Polres</label>
              <select name="id_polres" class="form-control" id="id_polres" required>
                <option value="" selected>Pilih Polres</option>
                <?php if (isset($_POST['id_polres'])) {
                  $id_polres = $_POST['id_polres'];
                  foreach ($views_polres as $data_select_polres) {
                    $selected = ($data_select_polres['id_polres'] == $id_polres) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_polres['id_polres'] ?>" <?= $selected ?>><?= $data_select_polres['nama_polres'] ?></option>
                  <?php }
                } else {
                  foreach ($views_polres as $data_select_polres) { ?>
                    <option value="<?= $data_select_polres['id_polres'] ?>"><?= $data_select_polres['nama_polres'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="no_laka">No. Laka</label>
              <input type="text" name="no_laka" value="<?php if (isset($_POST['no_laka'])) {
                                                          echo $_POST['no_laka'];
                                                        } ?>" class="form-control" id="no_laka" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="tanggal_kejadian">Tgl. Kejadian</label>
              <input type="date" name="tanggal_kejadian" value="<?php if (isset($_POST['tanggal_kejadian'])) {
                                                                  echo $_POST['tanggal_kejadian'];
                                                                } ?>" class="form-control" id="tanggal_kejadian" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="jam_kejadian">Jam Kejadian</label>
              <input type="time" name="jam_kejadian" value="<?php if (isset($_POST['jam_kejadian'])) {
                                                              echo $_POST['jam_kejadian'];
                                                            } ?>" class="form-control" id="jam_kejadian" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="jumlah_meninggal">Jumlah Meninggal</label>
              <input type="number" name="jumlah_meninggal" value="<?php if (isset($_POST['jumlah_meninggal'])) {
                                                                    echo $_POST['jumlah_meninggal'];
                                                                  } ?>" class="form-control" id="jumlah_meninggal" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="jumlah_luka_berat">Jumlah Luka Berat</label>
              <input type="number" name="jumlah_luka_berat" value="<?php if (isset($_POST['jumlah_luka_berat'])) {
                                                                      echo $_POST['jumlah_luka_berat'];
                                                                    } ?>" class="form-control" id="jumlah_luka_berat" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="jumlah_luka_ringan">Jumlah Luka Ringan</label>
              <input type="number" name="jumlah_luka_ringan" value="<?php if (isset($_POST['jumlah_luka_ringan'])) {
                                                                      echo $_POST['jumlah_luka_ringan'];
                                                                    } ?>" class="form-control" id="jumlah_luka_ringan" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="titik_acuan">Titik Acuan</label>
              <input type="text" name="titik_acuan" value="<?php if (isset($_POST['titik_acuan'])) {
                                                              echo $_POST['titik_acuan'];
                                                            } ?>" class="form-control" id="titik_acuan" placeholder="" required>
              <small>Contoh: tempat ibadah, simpang, sekolah atau kampus.</small>
            </div>
            <div class="form-group">
              <label for="tipe_kecelakaan">Tipe Kecelakaan</label>
              <input type="text" name="tipe_kecelakaan" value="<?php if (isset($_POST['tipe_kecelakaan'])) {
                                                                  echo $_POST['tipe_kecelakaan'];
                                                                } ?>" class="form-control" id="tipe_kecelakaan" placeholder="" required>
              <small>Contoh: tabrakan depan - belakang, tabrakan saat menyalip dari kanan, rem blong atau lainnya</small>
            </div>
            <div class="form-group">
              <label for="id_titik_rawan">Nama Jalan</label>
              <select name="id_titik_rawan" class="form-control" id="id_titik_rawan" required>
                <option value="" selected>Pilih Nama Jalan</option>
                <?php if (isset($_POST['nama_jalan_rawan'])) {
                  $nama_jalan_rawan = $_POST['nama_jalan_rawan'];
                  foreach ($views_titik_rawan as $data_select_titik_rawan) {
                    $selected = ($data_select_titik_rawan['nama_jalan_rawan'] == $nama_jalan_rawan) ? 'selected' : ''; ?>
                    <option value="<?= $data_select_titik_rawan['id_titik_rawan'] ?>" <?= $selected ?>><?= $data_select_titik_rawan['nama_jalan_rawan'] ?></option>
                  <?php }
                } else {
                  foreach ($views_titik_rawan as $data_select_titik_rawan) { ?>
                    <option value="<?= $data_select_titik_rawan['id_titik_rawan'] ?>"><?= $data_select_titik_rawan['nama_jalan_rawan'] ?></option>
                <?php }
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label for="batas_kecepatan_dilokasi">Batas Kecepatan Dilokasi</label>
              <input type="text" name="batas_kecepatan_dilokasi" value="<?php if (isset($_POST['batas_kecepatan_dilokasi'])) {
                                                                          echo $_POST['batas_kecepatan_dilokasi'];
                                                                        } ?>" class="form-control" id="batas_kecepatan_dilokasi" placeholder="" required>
            </div>
            <div class="form-group">
              <label for="nilai_kerugian_non_kendaraan">Nilai Kerugian Non Kendaraan</label>
              <input type="text" name="nilai_kerugian_non_kendaraan" value="<?php if (isset($_POST['nilai_kerugian_non_kendaraan'])) {
                                                                              echo $_POST['nilai_kerugian_non_kendaraan'];
                                                                            } ?>" class="form-control" id="nilai_kerugian_non_kendaraan" placeholder="">
            </div>
            <div class="form-group">
              <label for="nilai_kerugian_kendaraan">Nilai Kerugian Kendaraan</label>
              <input type="text" name="nilai_kerugian_kendaraan" value="<?php if (isset($_POST['nilai_kerugian_kendaraan'])) {
                                                                          echo $_POST['nilai_kerugian_kendaraan'];
                                                                        } ?>" class="form-control" id="nilai_kerugian_kendaraan" placeholder="">
            </div>
            <div class="form-group">
              <label for="keterangan_kerugian">Keterangan Kerugian</label>
              <input type="text" name="keterangan_kerugian" value="<?php if (isset($_POST['keterangan_kerugian'])) {
                                                                      echo $_POST['keterangan_kerugian'];
                                                                    } ?>" class="form-control" id="keterangan_kerugian" placeholder="">
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_laka" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>