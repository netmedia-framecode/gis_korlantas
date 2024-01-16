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

<script src="<?= $baseURL ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?= $baseURL ?>assets/js/popper.min.js"></script>
<script src="<?= $baseURL ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= $baseURL ?>assets/js/owl.carousel.min.js"></script>
<script src="<?= $baseURL ?>assets/js/sly.min.js"></script>
<script src="<?= $baseURL ?>assets/js/dragscroll.js"></script>
<script src="<?= $baseURL ?>assets/js/jquery.scrollbar.min.js"></script>
<script src="<?= $baseURL ?>assets/js/leaflet.js"></script>
<script src="<?= $baseURL ?>assets/js/leaflet.markercluster.js"></script>
<script src="<?= $baseURL ?>assets/js/custom.js"></script>
<script src="<?= $baseURL ?>assets/js/map-leaflet.js"></script>
<script src="<?= $baseURL ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= $baseURL ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= $baseURL ?>assets/js/demo/datatables-demo.js"></script>

<script>
  const showMessage = (type, title, message) => {
    if (message) {
      Swal.fire({
        icon: type,
        title: title,
        text: message,
      });
    }
  };

  showMessage("success", "Berhasil Terkirim", $(".message-success").data("message-success"));
  showMessage("info", "For your information", $(".message-info").data("message-info"));
  showMessage("warning", "Peringatan!!", $(".message-warning").data("message-warning"));
  showMessage("error", "Kesalahan", $(".message-danger").data("message-danger"));
</script>