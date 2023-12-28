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

    <main id="ts-main">

      <!--BREADCRUMB
            =========================================================================================================-->
      <section id="breadcrumb">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Library</a></li>
              <li class="breadcrumb-item active" aria-current="page">Data</li>
            </ol>
          </nav>
        </div>
      </section>

      <!--PAGE TITLE
            =========================================================================================================-->
      <section id="page-title">
        <div class="container">

          <div class="d-block d-sm-flex justify-content-between">

            <!--Title-->
            <div class="ts-title mb-0">
              <h1>Big Luxury Apartment</h1>
              <h5 class="ts-opacity__90">
                <i class="fa fa-map-marker text-primary"></i>
                1350 Arbutus Drive
              </h5>
            </div>

            <!--Price-->
            <h3>
              <span class="badge badge-primary p-3 font-weight-normal ts-shadow__sm">$350,000</span>
            </h3>

          </div>

        </div>
      </section>

      <!--GALLERY CAROUSEL
            =========================================================================================================-->
      <section id="gallery-carousel">

        <div class="owl-carousel ts-gallery-carousel ts-gallery-carousel__multi" data-owl-dots="1" data-owl-items="3" data-owl-center="1" data-owl-loop="1">

          <!--Slide-->
          <div class="slide">
            <div class="ts-image" data-bg-image="assets/img/img-detail-01.jpg">
              <a href="assets/img/img-detail-01.jpg" class="ts-zoom popup-image"><i class="fa fa-search-plus"></i>Zoom</a>
            </div>
          </div>

          <!--Slide-->
          <div class="slide">
            <div class="ts-image" data-bg-image="assets/img/img-detail-02.jpg">
              <a href="assets/img/img-detail-02.jpg" class="ts-zoom popup-image"><i class="fa fa-search-plus"></i>Zoom</a>
            </div>
          </div>

          <!--Slide-->
          <div class="slide">
            <div class="ts-image" data-bg-image="assets/img/img-detail-05.jpg">
              <a href="assets/img/img-detail-03.jpg" class="ts-zoom popup-image"><i class="fa fa-search-plus"></i>Zoom</a>
            </div>
          </div>

          <!--Slide-->
          <div class="slide">
            <div class="ts-image" data-bg-image="assets/img/img-detail-04.jpg">
              <a href="assets/img/img-detail-04.jpg" class="ts-zoom popup-image"><i class="fa fa-search-plus"></i>Zoom</a>
            </div>
          </div>

          <!--Slide-->
          <div class="slide">
            <div class="ts-image" data-bg-image="assets/img/img-detail-03.jpg">
              <a href="assets/img/img-detail-05.jpg" class="ts-zoom popup-image"><i class="fa fa-search-plus"></i>Zoom</a>
            </div>
          </div>

        </div>

      </section>

      <!--CONTENT
            =========================================================================================================-->
      <section id="content">
        <div class="container">
          <div class="row flex-wrap-reverse">

            <!--LEFT SIDE
                        =============================================================================================-->
            <div class="col-md-5 col-lg-4">

              <!--DETAILS
                            =========================================================================================-->
              <section>
                <h3>Details</h3>
                <div class="ts-box">

                  <dl class="ts-description-list__line mb-0">

                    <dt>ID:</dt>
                    <dd>#156461</dd>

                    <dt>Category:</dt>
                    <dd>Apartments</dd>

                    <dt>Status:</dt>
                    <dd>Sale</dd>

                    <dt>Area:</dt>
                    <dd>248<sup>2</sup></dd>

                    <dt>Rooms:</dt>
                    <dd>6</dd>

                    <dt>Bathrooms:</dt>
                    <dd>2</dd>

                    <dt>Bedrooms:</dt>
                    <dd>2</dd>

                    <dt>Garages:</dt>
                    <dd>1</dd>

                  </dl>

                </div>
              </section>

              <!--CONTACT THE AGENT
                            =========================================================================================-->
              <section class="contact-the-agent">
                <h3>Contact the Agent</h3>

                <div class="ts-box">

                  <!--Agent Image & Phone-->
                  <div class="ts-center__vertical mb-4">

                    <!--Image-->
                    <a href="agent-detail-01.html" class="ts-circle p-5 mr-4 ts-shadow__sm" data-bg-image="assets/img/img-person-05.jpg"></a>

                    <!--Phone contact-->
                    <figure class="mb-0">
                      <h5 class="mb-0">Jane Brown</h5>
                      <p class="mb-0">
                        <i class="fa fa-phone-square ts-opacity__50 mr-2"></i>
                        +1 602-862-1673
                      </p>
                    </figure>
                  </div>

                  <!--Agent contact form-->
                  <form id="form-agent" class="ts-form">

                    <!--Name-->
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                    </div>

                    <!--Email-->
                    <div class="form-group">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                    </div>

                    <!--Message-->
                    <div class="form-group">
                      <textarea class="form-control" id="form-contact-message" rows="3" name="message" placeholder="Hi, I want to have more information about property #156461"></textarea>
                    </div>

                    <!--Submit button-->
                    <div class="form-group clearfix mb-0">
                      <button type="submit" class="btn btn-primary float-right" id="form-contact-submit">Send a Message
                      </button>
                    </div>

                  </form>

                </div>
              </section>

              <!--LOCATION
                        =============================================================================================-->
              <section id="location">
                <h3>Location</h3>

                <div class="ts-box">

                  <dl class="ts-description-list__line mb-0">

                    <dt><i class="fa fa-map-marker ts-opacity__30 mr-2"></i>Address:</dt>
                    <dd class="border-bottom pb-2">1350 Arbutus Drive, LD</dd>

                    <dt><i class="fa fa-phone-square ts-opacity__30 mr-2"></i>Phone:</dt>
                    <dd class="border-bottom pb-2">+1 602-862-1673</dd>

                    <dt><i class="fa fa-envelope ts-opacity__30 mr-2"></i>Email:</dt>
                    <dd class="border-bottom pb-2"><a href="#">hello@property.com</a></dd>

                    <dt><i class="fa fa-globe ts-opacity__30 mr-2"></i>Website:</dt>
                    <dd><a href="#">www.property.com</a></dd>

                  </dl>

                </div>

              </section>

              <!--ACTIONS
                        =============================================================================================-->
              <section id="actions">

                <div class="d-flex justify-content-between">

                  <a href="#" class="btn btn-light mr-2 w-100" data-toggle="tooltip" data-placement="top" title="Add to favorites">
                    <i class="far fa-star"></i>
                  </a>

                  <a href="#" class="btn btn-light mr-2 w-100" data-toggle="tooltip" data-placement="top" title="Print">
                    <i class="fa fa-print"></i>
                  </a>

                  <a href="#" class="btn btn-light mr-2 w-100" data-toggle="tooltip" data-placement="top" title="Add to compare">
                    <i class="fa fa-exchange-alt"></i>
                  </a>

                  <a href="#" class="btn btn-light w-100" data-toggle="tooltip" data-placement="top" title="Share property">
                    <i class="fa fa-share-alt"></i>
                  </a>

                </div>

              </section>

            </div>
            <!--end col-md-4-->

            <!--RIGHT SIDE
                        =============================================================================================-->
            <div class="col-md-7 col-lg-8">

              <!--QUICK INFO
                            =========================================================================================-->
              <section id="quick-info">
                <h3>Quick Info</h3>

                <!--Quick Info-->
                <div class="ts-quick-info ts-box">

                  <!--Row-->
                  <div class="row no-gutters">

                    <!--Bathrooms-->
                    <div class="col-sm-3">
                      <div class="ts-quick-info__item" data-bg-image="assets/img/icon-quick-info-shower.png">
                        <h6>Bathrooms</h6>
                        <figure>2</figure>
                      </div>
                    </div>

                    <!--Bedrooms-->
                    <div class="col-sm-3">
                      <div class="ts-quick-info__item" data-bg-image="assets/img/icon-quick-info-bed.png">
                        <h6>Bedrooms</h6>
                        <figure>3</figure>
                      </div>
                    </div>

                    <!--Area-->
                    <div class="col-sm-3">
                      <div class="ts-quick-info__item" data-bg-image="assets/img/icon-quick-info-area.png">
                        <h6>Area</h6>
                        <figure>248m<sup>2</sup></figure>
                      </div>
                    </div>

                    <!--Garages-->
                    <div class="col-sm-3">
                      <div class="ts-quick-info__item" data-bg-image="assets/img/icon-quick-info-garages.png">
                        <h6>Garages</h6>
                        <figure>1</figure>
                      </div>
                    </div>

                  </div>
                  <!--end row-->

                </div>
                <!--end ts-quick-info-->

              </section>

              <!--DESCRIPTION
                            =========================================================================================-->
              <section id="description">

                <h3>Description</h3>

                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. In dictum ac augue et suscipit.
                  Vivamus ac tellus ut massa bibendum aliquam vitae ac diam. Aenean in enim volutpat,
                  accumsan erat non, porta massa. Nulla ac porta orci. Quisque condimentum fermentum
                  isl, lacinia tempor erat venenatis non. Integer ut malesuada est, nec pulvinar magna.
                  Vestibulum tincidunt malesuada mi eget mattis. Phasellus quis purus porta, auctor dolor
                  sed, eleifend tortor. Vestibulum placerat tristique turpis, eu suscipit nulla elementum
                  porttitor. Duis eu varius libero.
                </p>

              </section>

              <!--FEATURES
                            =========================================================================================-->
              <section id="features">

                <h3>Features</h3>

                <ul class="list-unstyled ts-list-icons ts-column-count-4 ts-column-count-sm-2 ts-column-count-md-2">
                  <li>
                    <i class="fa fa-bell"></i>
                    Door Bell
                  </li>
                  <li>
                    <i class="fa fa-wifi"></i>
                    Wi-Fi
                  </li>
                  <li>
                    <i class="fa fa-utensils"></i>
                    Restaurant Nearby
                  </li>
                  <li>
                    <i class="fa fa-plug"></i>
                    230V Plugs
                  </li>
                  <li>
                    <i class="fa fa-wheelchair"></i>
                    Accessible
                  </li>
                  <li>
                    <i class="fa fa-phone"></i>
                    Phone
                  </li>
                  <li>
                    <i class="fa fa-train"></i>
                    Train Station
                  </li>
                  <li>
                    <i class="fa fa-key"></i>
                    Secured Key
                  </li>
                </ul>

              </section>

              <!--MAP
                            =========================================================================================-->
              <section id="map-location">

                <h3>Map</h3>

                <div class="ts-map ts-map__detail ts-border-radius__sm ts-shadow__sm" id="ts-map-simple" data-ts-map-leaflet-provider="../../../cartodb-basemaps-%7bs%7d.global.ssl.fastly.net/light_all/%7bz%7d/%7bx%7d/%7by%7d%7br%7d.png" data-ts-map-zoom="12" data-ts-map-center-latitude="40.702411" data-ts-map-center-longitude="-73.556842" data-ts-map-scroll-wheel="0" data-ts-map-controls="0"></div>

              </section>


              <!--FLOOR PLANS
                            =========================================================================================-->
              <section id="floor-plans">

                <h3>Floor Plans</h3>

                <!--1st Floor-->
                <a href="#collapse-floor-1" class="ts-box d-block mb-2 py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse-floor-1">
                  1st Floor
                  <div class="collapse" id="collapse-floor-1">
                    <img src="assets/img/img-floor-plan-01.jpg" alt="" class="w-100">
                  </div>
                </a>

                <!--2nd Floor-->
                <a href="#collapse-floor-2" class="ts-box d-block py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapse-floor-2">
                  2nd Floor
                  <div class="collapse" id="collapse-floor-2">
                    <img src="assets/img/img-floor-plan-02.jpg" alt="" class="w-100">
                  </div>
                </a>

              </section>

              <!--VIDEO
                        =============================================================================================-->

              <section id="video">

                <h3>Video</h3>

                <div class="embed-responsive embed-responsive-16by9 rounded ts-shadow__md">
                  <iframe src="https://player.vimeo.com/video/9799783?color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>

              </section>

              <!--AMENITIES
                            =========================================================================================-->
              <section id="amenities">

                <h3>Amenities</h3>

                <ul class="ts-list-colored-bullets ts-text-color-light ts-column-count-3 ts-column-count-md-2">
                  <li>Air Conditioning</li>
                  <li>Swimming Pool</li>
                  <li>Central Heating</li>
                  <li>Laundry Room</li>
                  <li>Gym</li>
                  <li>Alarm</li>
                  <li>Window Covering</li>
                  <li>Internet</li>
                </ul>

              </section>

            </div>
            <!--end col-md-8-->

          </div>
          <!--end row-->
        </div>
        <!--end container-->
      </section>

      <!--SIMILAR PROPERTIES
        =============================================================================================================-->
      <section id="similar-properties">
        <div class="container">
          <div class="row">

            <div class="offset-lg-4 col-sm-12 col-lg-8">

              <hr class="mb-5">

              <h3>Similar Properties</h3>

              <!--Item-->
              <div class="card ts-item ts-item__list ts-card">

                <!--Ribbon-->
                <div class="ts-ribbon">
                  <i class="fa fa-thumbs-up"></i>
                </div>

                <!--Card Image-->
                <a href="detail-01.html" class="card-img" data-bg-image="assets/img/img-item-thumb-01.jpg"></a>

                <!--Card Body-->
                <div class="card-body">

                  <figure class="ts-item__info">
                    <h4>Big Luxury Apartment</h4>
                    <aside>
                      <i class="fa fa-map-marker mr-2"></i>
                      1350 Arbutus Drive
                    </aside>
                  </figure>

                  <div class="ts-item__info-badge">
                    $350,000
                  </div>

                  <div class="ts-description-lists">
                    <dl>
                      <dt>Area</dt>
                      <dd>325m<sup>2</sup></dd>
                    </dl>
                    <dl>
                      <dt>Bedrooms</dt>
                      <dd>2</dd>
                    </dl>
                    <dl>
                      <dt>Bathrooms</dt>
                      <dd>1</dd>
                    </dl>
                  </div>
                </div>

                <!--Card Footer-->
                <a href="detail-01.html" class="card-footer">
                  <span class="ts-btn-arrow">Detail</span>
                </a>

              </div>

              <!--Item-->
              <div class="card ts-item ts-item__list ts-card">

                <!--Ribbon-->
                <div class="ts-ribbon-corner">
                  <span>Updated</span>
                </div>

                <!--Card Image-->
                <a href="detail-01.html" class="card-img ts-item__image" data-bg-image="assets/img/img-item-thumb-02.jpg"></a>

                <!--Card Body-->
                <div class="card-body ts-item__body">

                  <figure class="ts-item__info">
                    <h4>Cozy Design Studio</h4>
                    <aside>
                      <i class="fa fa-map-marker mr-2"></i>
                      4831 Worthington Drive
                    </aside>
                  </figure>

                  <div class="ts-item__info-badge">$125,000</div>

                  <div class="ts-description-lists">
                    <dl>
                      <dt>Area</dt>
                      <dd>325m<sup>2</sup></dd>
                    </dl>
                    <dl>
                      <dt>Bedrooms</dt>
                      <dd>2</dd>
                    </dl>
                    <dl>
                      <dt>Bathrooms</dt>
                      <dd>1</dd>
                    </dl>
                  </div>
                </div>

                <!--Card Footer-->
                <a href="detail-01.html" class="card-footer ts-item__footer">
                  <span class="ts-btn-arrow">Detail</span>
                </a>

              </div>

              <!--Item-->
              <div class="card ts-item ts-item__list ts-card">

                <!--Card Image-->
                <a href="detail-01.html" class="card-img ts-item__image" data-bg-image="assets/img/img-item-thumb-03.jpg"></a>

                <!--Card Body-->
                <div class="card-body ts-item__body">

                  <figure class="ts-item__info">
                    <h4>Family Villa</h4>
                    <aside>
                      <i class="fa fa-map-marker mr-2"></i>
                      4127 Winding Way
                    </aside>
                  </figure>

                  <div class="ts-item__info-badge">$45,900</div>

                  <div class="ts-description-lists">
                    <dl>
                      <dt>Area</dt>
                      <dd>325m<sup>2</sup></dd>
                    </dl>
                    <dl>
                      <dt>Bedrooms</dt>
                      <dd>2</dd>
                    </dl>
                    <dl>
                      <dt>Bathrooms</dt>
                      <dd>1</dd>
                    </dl>
                  </div>
                </div>

                <!--Card Footer-->
                <a href="detail-01.html" class="card-footer ts-item__footer">
                  <span class="ts-btn-arrow">Detail</span>
                </a>

              </div>

            </div>

          </div>
        </div>
      </section>

    </main>

    <footer id="ts-footer">
      <section id="ts-footer-secondary">
        <div class="container">

          <!--Copyright-->
          <div class="ts-copyright">(C) <?= date('Y') ?> Netmedia Framecode, All rights reserved</div>

          <!--Social Icons-->
          <div class="ts-footer-nav mt-3">
            <p>Powered by Muhammad Ardy</p>
          </div>
          <!--end ts-footer-nav-->

        </div>
        <!--end container-->
      </section>
      <!--end ts-footer-secondary-->

    </footer>
    <!--end #ts-footer-->

  </div>

  <?php require_once("sections/footer.php"); ?>

</body>

</html>