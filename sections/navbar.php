<header id="ts-header" class="navbar-light fixed-top">
  <nav id="ts-primary-navigation" class="navbar navbar-expand-md navbar-light">
    <div class="container">
      <a class="navbar-brand" href="./">
        <img src="<?= $baseURL ?>assets/img/logo.png" style="width: 50px;" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarPrimary" aria-controls="navbarPrimary" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarPrimary">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="./">
              Beranda
            </a>
          </li>
          <li class="nav-item ts-has-child">
            <a class="nav-link" href="#">Tentang</a>
            <ul class="ts-child">
              <li class="nav-item">
                <a href="pesan-kapolri" class="nav-link">Pesan Kapolri</a>
              </li>
              <li class="nav-item">
                <a href="sejarah" class="nav-link">Sejarah</a>
              </li>
              <li class="nav-item">
                <a href="visi-misi" class="nav-link">Visi Misi</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="polres">Polres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="titik-rawan">Titik Rawan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mr-2" href="kontak">Kontak</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="auth/register">Daftar</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-outline-primary btn-sm m-1 px-3" href="auth/">
              <i class="fa fa-sign-in small mr-2"></i>
              Masuk
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>