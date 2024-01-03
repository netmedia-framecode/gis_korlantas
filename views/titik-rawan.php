<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Titik Rawan";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_gis_korlantas"]["name_page"] ?></h1>
  </div>

  <div class="row mb-3">
    <div class="col-lg-8">
      <div id="map" class="shadow" style="width: 100%; height: 450px;z-index: 0;"></div>
      <script>
        // Fungsi untuk mendapatkan data geolocation
        function getlokasi() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
          }
        }

        // Fungsi untuk menampilkan hasil geolocation pada peta
        function showPosition(posisi) {
          <?php if (isset($_POST['ubah-titik-rawan'])) { ?>
            var latitude = <?php echo $_POST['latitude'] ?>;
            var longitude = <?php echo $_POST['longitude'] ?>;
          <?php } else { ?>
            var latitude = posisi.coords.latitude;
            var longitude = posisi.coords.longitude;
          <?php } ?>

          var map = L.map('map').setView([latitude, longitude], 14);
          var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

          // get coordinat location
          var latInput = document.querySelector("[name=latitude]");
          var lngInput = document.querySelector("[name=longitude]");
          var curLocation = [latitude, longitude];
          map.attributionControl.setPrefix(false);
          
          // Menggunakan icon bawaan Leaflet
          var marker = L.marker(curLocation, {
            draggable: 'true',
            icon: L.icon({
              iconUrl: '../assets/img/warning.png',
              iconSize: [35, 40]
            })
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
            <h4><?php if (!isset($_POST['ubah-titik-rawan'])) {
                  echo "Tambah";
                } else {
                  echo "Ubah";
                } ?> Data Kecelakaan</h4>
            <div class="form-group">
              <label for="nama_jalan_rawan">Nama Jalan</label>
              <input type="text" name="nama_jalan_rawan" value="<?php if (isset($_POST['nama_jalan_rawan'])) {
                                                                  echo $_POST['nama_jalan_rawan'];
                                                                } ?>" class="form-control" id="nama_jalan_rawan" placeholder="" required>
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
              <label for="img_titik_rawan">Gambar Titik Rawan Kecelakaan</label>
              <div class="custom-file">
                <input type="file" name="img_titik_rawan" class="custom-file-input" id="img_titik_rawan" <?php if (!isset($_POST['ubah-titik-rawan'])) {
                                                                                                            echo " required";
                                                                                                          } ?>>
                <label class="custom-file-label" for="img_titik_rawan">Unggah File</label>
              </div>
            </div>
            <?php if (isset($_POST['ubah-titik-rawan'])) { ?>
              <input type="hidden" name="id_titik_rawan" value="<?= $_POST['id_titik_rawan'] ?>">
              <input type="hidden" name="nama_jalan_rawanOld" value="<?= $_POST['nama_jalan_rawan'] ?>">
              <input type="hidden" name="img_titik_rawanOld" value="<?= $_POST['img_titik_rawan'] ?>">
              <button type="submit" name="edit_titik_rawan" class="btn btn-primary">Submit</button>
            <?php } else { ?>
              <button type="submit" name="add_titik_rawan" class="btn btn-primary">Submit</button>
            <?php } ?>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Nama Jalan</th>
              <th class="text-center">Lokasi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Nama Jalan</th>
              <th class="text-center">Lokasi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_titik_rawan as $data) { ?>
              <tr>
                <td>
                  <p><?= $data['nama_jalan_rawan'] ?></p>
                  <img src="../assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>" style="width: 400px;" alt="">
                </td>
                <td><a href="lokasi?lat=<?= $data['latitude'] ?>&lng=<?= $data['longitude'] ?>">Lihat Lokasi</a></td>
                <td class="d-flex justify-content-center">
                  <form action="" method="post">
                    <input type="hidden" name="id_titik_rawan" value="<?= $data['id_titik_rawan'] ?>">
                    <input type="hidden" name="nama_jalan_rawan" value="<?= $data['nama_jalan_rawan'] ?>">
                    <input type="hidden" name="latitude" value="<?= $data['latitude'] ?>">
                    <input type="hidden" name="longitude" value="<?= $data['longitude'] ?>">
                    <input type="hidden" name="img_titik_rawan" value="<?= $data['img_titik_rawan'] ?>">
                    <button type="submit" name="ubah-titik-rawan" class="btn btn-warning btn-sm">
                      <i class=" bi bi-pencil-square"></i> Ubah
                    </button>
                  </form>
                  <button type="button" class="btn btn-danger btn-sm ml-3" data-toggle="modal" data-target="#hapus<?= $data['id_titik_rawan'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_titik_rawan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_jalan_rawan'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_titik_rawan" value="<?= $data['id_titik_rawan'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_titik_rawan" class="btn btn-danger btn-sm">hapus</button>
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

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>