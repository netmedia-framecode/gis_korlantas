<?php require_once("../controller/script.php");

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Kecelakaan - Digital Satlantas Polres Kupang Kota.xls");
?>
<center>
  <h3>Data Kecelakaan - Digital Satlantas Polres Kupang Kota</h3>
</center>
<table border="1">
  <thead>
    <tr>
      <th class="text-center">#</th>
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
  <tbody>
    <?php if (mysqli_num_rows($views_laka) == 0) { ?>
      <tr>
        <th scope="row" colspan="9">belum ada data kecelakaan</th>
      </tr>
      <?php } else if (mysqli_num_rows($views_laka) > 0) {
      $no = 1;
      while ($data = mysqli_fetch_assoc($views_laka)) { ?>
        <tr>
          <th scope="row"><?= $no; ?></th>
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
    <?php $no++;
      }
    } ?>
  </tbody>
  <tfoot>
    <tr>
      <th class="text-center">#</th>
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
</table>