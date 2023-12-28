<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Data Pemetaan";
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
              <th class="text-center">Lokasi</th>
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
              <th class="text-center">Lokasi</th>
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
                <td>
                  <p><?= $data['no_laka'] ?></p>
                  <img src="../assets/img/laka/<?= $data['img_laka'] ?>" style="width: 200px;" alt="">
                </td>
                <td><?= $data['nama_polres'] ?></td>
                <td><?= $data['tanggal_kejadian'] . " " . $data['jam_kejadian'] ?></td>
                <td><?= $data['tingkat_kecelakaan'] ?></td>
                <td><?= $data['jumlah_meninggal'] ?></td>
                <td><?= $data['jumlah_luka_berat'] ?></td>
                <td><?= $data['jumlah_luka_ringan'] ?></td>
                <td><a href="lokasi?id=<?= $data['id_laka'] ?>&lat=<?= $data['latitude'] ?>&lng=<?= $data['longitude'] ?>">Lihat Lokasi</a></td>
                <td><?= $data['titik_acuan'] ?></td>
                <td><?= $data['informasi_khusus'] ?></td>
                <td><?= $data['tipe_kecelakaan'] ?></td>
                <td><?= $data['kondisi_cahaya'] ?></td>
                <td><?= $data['kondisi'] ?></td>
                <td><?= $data['kecelakaan_menonjol'] ?></td>
                <td><?= $data['nama_jalan'] ?></td>
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
                  <form action="" method="post">
                    <input type="hidden" name="id_laka" value="<?= $data['id_laka'] ?>">
                    <button type="submit" name="ubah_pemetaan" class="btn btn-warning btn-sm">
                      <i class="bi bi-pencil-square"></i> Ubah
                    </button>
                  </form>
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

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>