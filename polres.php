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
              <li class="breadcrumb-item active" aria-current="page">Polres</li>
            </ol>
          </nav>
        </div>
      </section>

      <section id="page-title">
        <div class="container">
          <div class="ts-title">
            <h1>Polres</h1>
          </div>
        </div>
      </section>

      <section id="about-us-description">
        <div class="container">
          <div class="row">
            <?php foreach ($views_polres as $data) : ?>
              <div class="col-sm-6 col-lg-4">
                <div class="card ts-item ts-card ts-item__lg">
                  <a href="polres?id=<?= $data['id_polres'] ?>" class="card-img ts-item__image" data-bg-image="assets/img/polres/<?= $data['img_polres'] ?>">
                    <figure class="ts-item__info">
                      <h4><?= $data['nama_polres'] ?></h4>
                      <aside>
                        <i class="fa fa-map-marker mr-2"></i>
                        <?= $data['alamat'] ?>
                      </aside>
                    </figure>
                  </a>
                  <div class="card-body">
                    <div class="ts-description-lists">
                      <dl>
                        <dt>Telepon</dt>
                        <dd><?php if (empty($data['telepon'])) {
                              echo "-";
                            } else {
                              echo $data['telepon'];
                            } ?></dd>
                      </dl>
                      <dl>
                        <dt>Email</dt>
                        <dd><?php if (empty($data['email'])) {
                              echo "-";
                            } else {
                              echo $data['email'];
                            } ?></dd>
                      </dl>
                      <dl>
                        <dt>Jumlah Anggota</dt>
                        <dd><?= $data['jumlah_anggota'] ?></dd>
                      </dl>
                    </div>
                  </div>
                  <a href="polres?id=<?= $data['id_polres'] ?>" class="card-footer">
                    <span class="ts-btn-arrow">Detail</span>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
          <hr class="my-5">
        </div>
      </section>

    </main>

    <?php require_once("sections/footer.php"); ?>

</body>

</html>