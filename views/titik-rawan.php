<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Titik Rawan";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $_SESSION["project_gis_korlantas"]["name_page"] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#tambah"><i class="bi bi-plus-lg"></i> Tambah</a>
  </div>

  <div class="card shadow mb-4 border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">Nama Jalan</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Nama Jalan</th>
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
                <td class="d-flex justify-content-center">
                  <button type="button" class="btn btn-warning btn-sm ml-3" data-toggle="modal" data-target="#edit<?= $data['id_titik_rawan'] ?>">
                    <i class="bi bi-pen"></i> Ubah
                  </button>
                  <div class="modal fade" id="edit<?= $data['id_titik_rawan'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_jalan_rawan'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_titik_rawan" value="<?= $_POST['id_titik_rawan'] ?>">
                          <input type="hidden" name="nama_jalan_rawanOld" value="<?= $_POST['nama_jalan_rawan'] ?>">
                          <input type="hidden" name="img_titik_rawanOld" value="<?= $_POST['img_titik_rawan'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_jalan_rawan">Nama Jalan</label>
                              <input type="text" name="nama_jalan_rawan" value="<?php if (isset($_POST['nama_jalan_rawan'])) {
                                                                                  echo $_POST['nama_jalan_rawan'];
                                                                                } ?>" class="form-control" id="nama_jalan_rawan" placeholder="" required>
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
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_titik_rawan" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
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

  <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header border-bottom-0 shadow">
          <h5 class="modal-title" id="tambahLabel">Tambah Titik Rawan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama_jalan_rawan">Nama Jalan</label>
              <input type="text" name="nama_jalan_rawan" value="<?php if (isset($_POST['nama_jalan_rawan'])) {
                                                                  echo $_POST['nama_jalan_rawan'];
                                                                } ?>" class="form-control" id="nama_jalan_rawan" placeholder="" required>
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
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_titik_rawan" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>