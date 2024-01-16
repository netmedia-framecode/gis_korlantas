<?php require_once("controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Pesan Kapolri"; ?>

<!doctype html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <div class="ts-page-wrapper ts-has-bokeh-bg" id="page-top">
    <?php require_once("sections/navbar.php"); ?>

    <main id="ts-main">

      <section id="breadcrumb">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Beranda</a></li>
              <li class="breadcrumb-item"><a href="#">Tentang</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pesan Kapolri</li>
            </ol>
          </nav>
        </div>
      </section>

      <section id="page-title">
        <div class="container">
          <div class="ts-title">
            <h1>Pesan Kapolri</h1>
          </div>
        </div>
      </section>

      <section id="about-us-description">
        <div class="container">
          <div class="row">
            <?php foreach ($views_pesan_kapolri as $data) { ?>
              <div class="col-lg-4">
                <img src="assets/img/pesan_kapolri/<?= $data['img_kapolri'] ?>" style="width: 350px;" alt="">
              </div>
              <div class="col-lg-8">
                <?= $data['deskripsi']; ?>
              </div>
            <?php } ?>
          </div>
          <hr class="my-5">
        </div>
      </section>

    </main>

    <?php require_once("sections/footer.php"); ?>

</body>

</html>