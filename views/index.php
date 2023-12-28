<?php require_once("../controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "";
require_once("../templates/views_top.php"); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Polres</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counts_polres ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                Kecelakaan</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $counts_laka ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Grafik Kecelakaan Tahun <?= date("Y") ?></h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <?php
            $currentYear = date("Y");
            $sql = "SELECT MONTH(tanggal_kejadian) as month, COUNT(*) as total FROM laka WHERE YEAR(tanggal_kejadian) = $currentYear AND MONTH(tanggal_kejadian) BETWEEN 1 AND 12 GROUP BY month";
            $result = $conn->query($sql);
            $data = [];
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $monthName = date("F", mktime(0, 0, 0, $row['month'], 1));
                $data[] = [
                  'month' => $monthName,
                  'total' => $row['total'],
                ];
              }
            } ?>
            <canvas id="myAreaChart"></canvas>
            <script>
              var dataLaka = <?php echo json_encode($data); ?>;
            </script>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Polres</h6>
        </div>
        <div class="card-body">
          <?php foreach ($views_polres as $data) : ?>
            <div class="card mb-3 border-0 shadow">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="../assets/img/polres/<?= $data['img_polres'] ?>" style="width: 100%;height: 220px;object-fit: cover;" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?= $data['nama_polres'] ?></h5>
                    <p class="card-text mb-0">Alamat: <?= $data['alamat'] ?></p>
                    <p class="card-text mb-0">Telepon: <?= $data['telepon'] ?></p>
                    <p class="card-text mb-0">Email: <?= $data['email'] ?></p>
                    <p class="card-text">Jumlah Anggota: <?= $data['jumlah_anggota'] ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">
      <div class="row">
        <?php $querySubMenu = "SELECT * FROM user_sub_menu 
                    JOIN user_menu ON user_sub_menu.id_menu = user_menu.id_menu
                    JOIN user_access_sub_menu ON user_sub_menu.id_sub_menu=user_access_sub_menu.id_sub_menu
                    WHERE user_sub_menu.id_menu = 3
                    AND user_sub_menu.id_active = 1
                    AND user_access_sub_menu.id_role = '$id_role'
                  ";
        $subMenu = mysqli_query($conn, $querySubMenu);
        foreach ($subMenu as $sm) : ?>
          <div class="col-lg-6 mb-4">
            <a class="text-decoration-none" href="<?= $sm['url']; ?>">
              <div class="card bg-primary text-white shadow">
                <div class="card-body">
                  <i class="<?= $sm['icon']; ?>"></i>
                  <div class="text-white-100 small"><?= $sm['title']; ?></div>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Data Kecelakaan</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Detail</div>
            <a class="dropdown-item" href="pemetaan">Tambah Data</a>
            <a class="dropdown-item" href="data-pemetaan">Data Pemetaan Kecelakaan</a>
          </div>
        </div>
      </div>
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
                  <td><?= $data['nilai_kerugian_non_kendaraan'] ?></td>
                  <td><?= $data['nilai_kerugian_kendaraan'] ?></td>
                  <td><?= $data['keterangan_kerugian'] ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<?php require_once("../templates/views_bottom.php") ?>