<?php require_once("controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = ""; ?>

<!doctype html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <div class="ts-page-wrapper ts-homepage ts-full-screen-page" id="page-top">
    <?php require_once("sections/navbar.php"); ?>
    <style>
      .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 0;
      }

      .ts-hero-img {
        background-image: url('assets/img/banner.jpeg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        object-fit: cover;
        height: 100%;
      }
    </style>
    <section id="ts-hero" class="mb-0 ts-hero-img">
      <div class="overlay"></div>
      <div class="container py-5">
        <div class="row ts-center__both ts-h__auto ts-min-h__60vh">

          <div class="col-sm-6 col-md-8 text-white">
            <!--Title-->
            <h1 class="mb-2">Digital Satlantas Polres Kupang Kota</h1>
            <!--Subtitle-->
          </div>

          <div class="col-sm-6 col-md-4">

            <!--Form-->
            <form method="get" action="titik-rawan" class="ts-form py-3 px-4 ts-border-radius__md ts-shadow__md" data-bg-color="rgba(255,255,255,.9)">

              <h4 class="mb-3">Cari Titik Kecelakaan</h4>

              <!--Keyword-->
              <div class="form-group my-2">
                <input type="text" class="form-control" id="keyword" name="place" placeholder="Nama Jalan">
              </div>

              <!--Submit button-->
              <div class="form-group my-2">
                <button type="submit" class="btn btn-primary w-100" id="search-btn"><i class="fas fa-search"></i> Cari</button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </section>

    <main id="ts-main">

      <section id="category-select" class="ts-icons-select ts-icons-select__dark" data-bg-color="#292929">
        <?php foreach ($views_titik_rawan_overview as $data) {
          $id_titik_rawan = $data['id_titik_rawan']; ?>
          <a href="titik-rawan?id=<?= $id_titik_rawan ?>">
            <aside><?php $take_laka = "SELECT * FROM laka WHERE id_titik_rawan='$id_titik_rawan'";
                    $take_data_laka = mysqli_query($conn, $take_laka);
                    echo mysqli_num_rows($take_data_laka); ?></aside>
            <img src="assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>" style="width: 75px;" alt="">
            <figure>
              <h6><?= $data['nama_jalan_rawan'] ?></h6>
              <small><?= $data['nama_polres'] ?></small>
            </figure>
          </a>
        <?php } ?>
      </section>

      <section id="featured-properties" class="ts-block pt-5">
        <div class="container">
          <div class="ts-title text-center">
            <h2>List Polres</h2>
          </div>
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
          <div class="text-center mt-3">
            <a href="polres" class="btn btn-outline-dark ts-btn-border-muted">Lihat Semua Polres</a>
          </div>
        </div>
      </section>

      <section id="latest-listings" class="ts-block">
        <div class="container">
          <div class="ts-title">
            <h2>List Titik Rawan</h2>
          </div>
          <div class="row">
            <?php foreach ($views_titik_rawan_overview as $data) {
              $id_titik_rawan = $data['id_titik_rawan']; ?>
              <div class="col-sm-6 col-lg-3">
                <div class="card ts-item ts-card">
                  <a href="titik-rawan?id=<?= $id_titik_rawan ?>" class="card-img ts-item__image" data-bg-image="assets/img/titik_rawan/<?= $data['img_titik_rawan'] ?>">
                    <figure class="ts-item__info">
                      <h4><i class="fa fa-map-marker mr-2"></i><?= $data['nama_jalan_rawan'] ?></h4>
                    </figure>
                  </a>
                  <div class="card-body">
                    <div class="ts-description-lists">
                      <dl>
                        <dt>Jumlah Kecelakaan</dt>
                        <dd><?= $data['total_laka'] ?></dd>
                      </dl>
                      <dl>
                        <dt>Luka Ringan</dt>
                        <dd><?= $data['total_jumlah_luka_ringan'] ?></dd>
                      </dl>
                      <dl>
                        <dt>Luka Berat</dt>
                        <dd><?= $data['total_jumlah_luka_berat'] ?></dd>
                      </dl>
                      <dl>
                        <dt>Meninggal</dt>
                        <dd><?= $data['total_jumlah_meninggal'] ?></dd>
                      </dl>
                    </div>
                  </div>
                  <a href="titik-rawan?id=<?= $id_titik_rawan ?>" class="card-footer">
                    <span class="ts-btn-arrow">Detail</span>
                  </a>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </section>

      <section id="submit-banner" class="ts-block">
        <div class="container">
          <div class="ts-block-inside text-center ts-separate-bg-element" data-bg-image-opacity=".2" data-bg-image="assets/img/bg-chair.jpg" data-bg-color="#fff">
            <figure class="h1 font-weight-light mb-2">Anda ingin menghubungi kami?</figure>
            <p class="mb-5">Silakan klik kontak kami untuk mengirimkan pesan kepada kami.</p>
            <a href="kontak" class="btn btn-dark">Kontak Kami</a>
          </div>
        </div>
      </section>

    </main>

    <?php require_once("sections/footer.php"); ?>

</body>

</html>