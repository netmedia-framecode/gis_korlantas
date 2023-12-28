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
    <section id="ts-hero" class=" mb-0">
      <div class="ts-full-screen d-flex flex-column">

        <section class="ts-shadow__sm ts-z-index__2 ts-bg-light">
          <div class="position-absolute w-100 ts-bottom__0 ts-z-index__1 text-center ts-h-0 d-block d-sm-none">
            <button type="button" class="ts-circle p-3 bg-white ts-shadow__sm border-0 ts-push-up__50 mt-2" data-toggle="collapse" data-target="#form-collapse">
              <i class="fa fa-chevron-up ts-text-color-primary ts-visible-on-uncollapsed"></i>
              <i class="fa fa-chevron-down ts-text-color-primary ts-visible-on-collapsed"></i>
            </button>
          </div>
          <div id="form-collapse" class="collapse ts-xs-hide-collapse show">
            <form class="ts-form mb-0 d-flex flex-column flex-sm-row py-2 pl-2 pr-3" method="post">
              <div class="form-group m-1 w-100">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Nama Jalan">
              </div>
              <div class="form-group m-1 w-100">
                <select class="custom-select" id="type" name="category">
                  <option value="">Type</option>
                  <option value="1">Apartment</option>
                  <option value="2">Villa</option>
                  <option value="3">Land</option>
                  <option value="4">Garage</option>
                </select>
              </div>
              <div class="form-group m-1 w-100">
                <select class="custom-select" id="status" name="status">
                  <option value="">Status</option>
                  <option value="1">Sale</option>
                  <option value="2">Rent</option>
                </select>
              </div>
              <div class="input-group m-1 w-100">
                <input type="text" class="form-control border-right-0" id="min-area" placeholder="Min Area">
                <div class="input-group-append">
                  <span class="input-group-text bg-white border-left-0">m<sup>2</sup></span>
                </div>
              </div>
              <div class="input-group m-1 w-100">
                <input type="text" class="form-control border-right-0" id="max-area" placeholder="Max Area">
                <div class="input-group-append">
                  <span class="input-group-text bg-white border-left-0">m<sup>2</sup></span>
                </div>
              </div>
              <div class="input-group m-1 w-100">
                <input type="text" class="form-control border-right-0" id="min-price" placeholder="Min. Nilai Kerugian">
                <div class="input-group-append">
                  <span class="input-group-text bg-white border-left-0">Rp</span>
                </div>
              </div>
              <div class="input-group m-1 w-100">
                <input type="text" class="form-control border-right-0" id="max-price" placeholder="Max. Nilai Kerugian">
                <div class="input-group-append">
                  <span class="input-group-text bg-white border-left-0">Rp</span>
                </div>
              </div>
              <div class="form-group m-1 ml-auto">
                <button type="submit" class="btn btn-primary" id="search-btn">Cari</button>
              </div>
            </form>
          </div>
        </section>

        <div class="d-flex h-100">

          <div class="ts-results__vertical ts-results__vertical-list ts-shadow__sm scrollbar-inner bg-white ts-z-index__2">
            <section id="ts-results">
              <div class="ts-results-wrapper">
                <?php foreach ($views_laka as $data) :
                  $bulan_kejadian = date("n", strtotime($data['tanggal_kejadian']));
                  $bulan_saat_ini = date("n");
                  $is_bulan_ini = ($bulan_kejadian == $bulan_saat_ini); ?>
                  <div class="ts-result-link" data-ts-id="9" data-ts-ln="8">
                    <span class="ts-center-marker"><img src="assets/img/laka/<?= $data['img_laka'] ?>"></span>
                    <a href="laka?id=<?= $data['id_laka'] ?>" class="card ts-item ts-card ts-result">
                      <?php if ($is_bulan_ini) : ?>
                        <div class="ts-ribbon-corner"><span>Baru Bulan Ini</span></div>
                      <?php endif; ?>
                      <div href="detail-01.html" class="card-img ts-item__image" style="background-image: url(assets/img/laka/<?= $data['img_laka'] ?>)"></div>
                      <div class="card-body">
                        <figure class="ts-item__info">
                          <h4><?= $data['nama_polres'] ?></h4>
                          <aside><i class="fa fa-map-marker mr-2"></i><?= $data['nama_jalan'] ?></aside>
                        </figure>
                        <div class="ts-description-lists">
                          <dl>
                            <dt>Status</dt>
                            <dd><?= $data['tingkat_kecelakaan'] ?></dd>
                          </dl>
                          <dl>
                            <dt>Luka Ringan</dt>
                            <dd><?= $data['jumlah_luka_ringan'] ?></dd>
                          </dl>
                          <dl>
                            <dt>Luka Berat</dt>
                            <dd><?= $data['jumlah_luka_berat'] ?></dd>
                          </dl>
                          <dl>
                            <dt>Meninggal</dt>
                            <dd><?= $data['jumlah_meninggal'] ?></dd>
                          </dl>
                        </div>
                      </div>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            </section>
          </div>

          <div class="ts-map w-100 ts-z-index__1">
            <div id="ts-map-hero" class="h-100 ts-z-index__1" data-ts-map-leaflet-provider="https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}" data-ts-map-leaflet-attribution="Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community" data-ts-map-controls="1" data-ts-map-scroll-wheel="1" data-ts-map-zoom="13" data-ts-map-center-latitude="40.702411" data-ts-map-center-longitude="-73.556842" data-ts-locale="en-US" data-ts-currency="USD" data-ts-unit="m<sup>2</sup>" data-ts-display-additional-info="area_Area;bedrooms_Bedrooms;bathrooms_Bathrooms;rooms_Rooms">
            </div>
          </div>

        </div>

      </div>
    </section>
  </div>
  <?php require_once("sections/footer.php"); ?>
</body>

</html>