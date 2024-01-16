<?php require_once("controller/script.php");
$_SESSION["project_gis_korlantas"]["name_page"] = "Pesan Kapolri"; ?>

<!doctype html>
<html lang="en">

<head>
  <?php require_once("sections/head.php"); ?>
</head>

<body>
  <?php foreach ($messageTypes as $type) {
    if (isset($_SESSION["project_gis_korlantas"]["message_$type"])) {
      echo "<div class='message-$type' data-message-$type='{$_SESSION["project_gis_korlantas"]["message_$type"]}'></div>";
    }
  } ?>
  <div class="ts-page-wrapper ts-has-bokeh-bg" id="page-top">
    <?php require_once("sections/navbar.php"); ?>

    <main id="ts-main">

      <section id="breadcrumb">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Beranda</a></li>
              <li class="breadcrumb-item active" aria-current="page">Kontak</li>
            </ol>
          </nav>
        </div>
      </section>

      <section id="page-title">
        <div class="container">
          <div class="ts-title">
            <h1>Kontak</h1>
          </div>
        </div>
      </section>

      <section id="contact-form">
        <div class="container">
          <div class="row">

            <div class="col-md-4">
              <h3>Dapatkan Bantuan</h3>
              <p>
                Anda bisa menghubungi kami melalui kontak pesan ini atau lewat beberapa kontak dibawah ini.
              </p>
              <figure class="ts-center__vertical">
                <i class="fa fa-phone ts-opacity__50 mr-3 mb-0 h4 font-weight-bold"></i>
                <dl class="mb-0">
                  <dt>Phone</dt>
                  <dd class="ts-opacity__50">+1 321-978-5552</dd>
                </dl>
              </figure>
              <figure class="ts-center__vertical">
                <i class="fa fa-envelope ts-opacity__50 mr-3 mb-0 h4 font-weight-bold"></i>
                <dl class="mb-0">
                  <dt>Email</dt>
                  <dd class="ts-opacity__50">
                    <a href="#">hello@example.com</a>
                  </dd>
                </dl>
              </figure>
            </div>
            <div class="col-md-8">
              <h3>Contact Form</h3>
              <form id="form-contact" method="post" class="clearfix ts-form ts-form-email">
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <label for="form-contact-name">Name *</label>
                      <input type="text" class="form-control" id="form-contact-name" name="nama" placeholder="Your Name" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <div class="form-group">
                      <label for="form-contact-email">Email *</label>
                      <input type="email" class="form-control" id="form-contact-email" name="email" placeholder="Your Email" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="form-contact-email">Subject*</label>
                  <input type="text" class="form-control" id="form-contact-subject" name="subject" placeholder="Subject" required>
                </div>
                <div class="form-group">
                  <label for="form-contact-message">Message *</label>
                  <textarea class="form-control" id="form-contact-message" rows="5" name="message" placeholder="Your Message" required></textarea>
                </div>
                <div class="form-group clearfix">
                  <button type="submit" name="kontak" class="btn btn-primary float-right" id="form-contact-submit">Send
                    a Message
                  </button>
                </div>
                <div class="form-contact-status"></div>
              </form>
            </div>
          </div>
        </div>
      </section>

    </main>

    <?php require_once("sections/footer.php"); ?>

</body>

</html>