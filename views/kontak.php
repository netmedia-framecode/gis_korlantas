<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Kontak";
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
              <th class="text-center">Nama</th>
              <th class="text-center">Email</th>
              <th class="text-center">Subjek</th>
              <th class="text-center">Pesan</th>
              <th class="text-center">Tgl Kirim</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th class="text-center">Nama</th>
              <th class="text-center">Email</th>
              <th class="text-center">Subjek</th>
              <th class="text-center">Pesan</th>
              <th class="text-center">Tgl Kirim</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($views_kontak as $data) { ?>
              <tr>
                <td><?= $data['name'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['subject'] ?></td>
                <td><?= $data['message'] ?></td>
                <td><?= $data['created_at'] ?></td>
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