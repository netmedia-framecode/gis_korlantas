<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Pemetaan";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_gis_korlantas"]["name_page"] ?></h1>
  </div>

  <div class="row mb-3">
    <div class="col-lg-8">
      <div id="map" class="shadow" style="width: 100%; height: 405vh;z-index: 0;"></div>
      <script>
        // Fungsi untuk mendapatkan data geolocation
        function getlokasi() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          }
        }

        // Fungsi untuk menampilkan hasil geolocation pada peta
        function showPosition(posisi) {
          var latitude = posisi.coords.latitude;
          var longitude = posisi.coords.longitude;

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
    <div class="col-lg-4">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="card border-0 shadow">
          <div class="card-body text-center">
            <h4>Tambah Data Kecelakaan</h4>
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
              <label for="latitude" class="form-label required">Latitude</label>
              <input type="text" name="latitude" value="<?php if (isset($_POST['latitude'])) {
                                                          echo $_POST['latitude'];
                                                        } ?>" class="form-control text-center" id="latitude" placeholder="Latitude" required>
            </div>
            <div class="form-group">
              <label for="longitude" class="form-label required">Longitude</label>
              <input type="text" name="longitude" value="<?php if (isset($_POST['longitude'])) {
                                                            echo $_POST['longitude'];
                                                          } ?>" class="form-control text-center" id="longitude" placeholder="Longitude" required>
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
              <label for="nama_jalan">Nama Jalan</label>
              <input type="text" name="nama_jalan" value="<?php if (isset($_POST['nama_jalan'])) {
                                                            echo $_POST['nama_jalan'];
                                                          } ?>" class="form-control" id="nama_jalan" placeholder="" required>
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
            <div class="form-group">
              <label for="img_laka">Gambar Kecelakaan</label>
              <div class="custom-file">
                <input type="file" name="img_laka" class="custom-file-input" id="img_laka" required>
                <label class="custom-file-label" for="img_laka">Unggah File</label>
              </div>
            </div>
            <button type="submit" name="add_laka" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>