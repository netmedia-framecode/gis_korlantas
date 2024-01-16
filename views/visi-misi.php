<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Visi Misi";
require_once("../templates/views_top.php"); ?>

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
              <th class="text-center">Gambar</th>
              <th class="text-center">Deskripsi</th>
              <th class="text-center" style="width: 200px;">Aksi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Gambar</th>
              <th class="text-center">Deskripsi</th>
              <th class="text-center">Aksi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_visi_misi as $data) { ?>
              <tr>
                <td><img src="<?= $baseURL ?>assets/img/visi_misi/<?= $data['img_vm'] ?>" style="width: 250px;object-fit: cover;" alt=""></td>
                <td><?= $data['deskripsi'] ?></td>
                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ubah<?= $data['id_vm'] ?>">
                    <i class="bi bi-pencil-square"></i> Ubah
                  </button>
                  <div class="modal fade" id="ubah<?= $data['id_vm'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header border-bottom-0 shadow">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="img_vm">Gambar Kapolri</label>
                              <div class="custom-file">
                                <input type="file" name="img_vm" class="custom-file-input" id="img_vm">
                                <label class="custom-file-label" for="img_vm">Unggah File</label>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="deskripsi">Deskripsi</label>
                              <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" required><?= $data['deskripsi'] ?></textarea>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-center border-top-0">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                            <button type="submit" name="edit_visi_misi" class="btn btn-warning btn-sm">Ubah</button>
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