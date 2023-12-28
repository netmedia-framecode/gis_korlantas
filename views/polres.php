<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Polres";
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
              <th class="text-center">Nama Polres</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">Telepon</th>
              <th class="text-center">Email</th>
              <th class="text-center">Jumlah Anggota</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Nama Polres</th>
              <th class="text-center">Alamat</th>
              <th class="text-center">Telepon</th>
              <th class="text-center">Email</th>
              <th class="text-center">Jumlah Anggota</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_polres as $data) { ?>
              <tr>
                <td>
                  <p><?= $data['nama_polres'] ?></p>
                  <img src="../assets/img/polres/<?= $data['img_polres'] ?>" style="width: 150px;" alt="">
                </td>
                <td><?= $data['alamat'] ?></td>
                <td><?= $data['telepon'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['jumlah_anggota'] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_polres'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_polres'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah <?= $data['nama_polres'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id_polres" value="<?= $data['id_polres'] ?>">
                          <input type="hidden" name="nama_polresOld" value="<?= $data['nama_polres'] ?>">
                          <input type="hidden" name="img_polresOld" value="<?= $data['img_polres'] ?>">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="nama_polres">Nama Polres</label>
                              <input type="text" name="nama_polres" value="<?= $data['nama_polres'] ?>" class="form-control" id="nama_polres" required>
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <input type="text" name="alamat" value="<?= $data['alamat'] ?>" class="form-control" id="alamat" required>
                            </div>
                            <div class="form-group">
                              <label for="telepon">Telepon</label>
                              <input type="number" name="telepon" value="<?= $data['telepon'] ?>" class="form-control" id="telepon">
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" name="email" value="<?= $data['email'] ?>" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                              <label for="jumlah_anggota">Jumlah Anggota</label>
                              <input type="number" name="jumlah_anggota" value="<?= $data['jumlah_anggota'] ?>" class="form-control" id="jumlah_anggota" required>
                            </div>
                            <div class="form-group">
                              <label for="img_polres">Gambar Polres</label>
                              <div class="custom-file">
                                <input type="file" name="img_polres" class="custom-file-input" id="img_polres">
                                <label class="custom-file-label" for="img_polres">Unggah File</label>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_polres" class="btn btn-warning btn-sm">Ubah</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus<?= $data['id_polres'] ?>">
                    <i class="bi bi-trash3"></i> Hapus
                  </button>
                  <div class="modal fade" id="hapus<?= $data['id_polres'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Hapus <?= $data['nama_polres'] ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post">
                          <input type="hidden" name="id_polres" value="<?= $data['id_polres'] ?>">
                          <input type="hidden" name="img_polres" value="<?= $data['img_polres'] ?>">
                          <div class="modal-body">
                            <p>Jika anda yakin ingin menghapus data ini, klik Hapus!</p>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="delete_polres" class="btn btn-danger btn-sm">hapus</button>
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
          <h5 class="modal-title" id="tambahLabel">Tambah Polres</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for="nama_polres">Nama Polres</label>
              <input type="text" name="nama_polres" class="form-control" id="nama_polres" required>
            </div>
            <div class="form-group">
              <label for="alamat">Alamat</label>
              <input type="text" name="alamat" class="form-control" id="alamat" required>
            </div>
            <div class="form-group">
              <label for="telepon">Telepon</label>
              <input type="number" name="telepon" class="form-control" id="telepon">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="jumlah_anggota">Jumlah Anggota</label>
              <input type="number" name="jumlah_anggota" class="form-control" id="jumlah_anggota" required>
            </div>
            <div class="form-group">
              <label for="img_polres">Gambar Polres</label>
              <div class="custom-file">
                <input type="file" name="img_polres" class="custom-file-input" id="img_polres" required>
                <label class="custom-file-label" for="img_polres">Unggah File</label>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-center border-top-0">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" name="add_polres" class="btn btn-primary btn-sm">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>