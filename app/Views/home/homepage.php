<?= $this->extend('layouts/home_layout') ?>

<?= $this->section('head') ?>
<title>Home</title>
<style>
  .sticky-login-button {
    position: fixed;
    /* Tetap di posisi yang sama relatif terhadap layar */
    top: 1.5rem;
    /* Jarak dari atas */
    right: 1.5rem;
    /* Jarak dari kanan */
    z-index: 1030;
    /* Memastikan tombol selalu di lapisan paling atas */
  }

  /* CSS untuk menyamakan ukuran gambar */
  .showcase-img {
    width: 100%;
    height: 350px;
    /* Atur tinggi yang sama untuk kedua gambar */
    object-fit: cover;
    /* Membuat gambar mengisi area tanpa distorsi */
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<header class="p-3 border-bottom shadow-sm fixed-top bg-white sticky-header d-flex justify-content-between align-items-center">
  <h5 class="my-0 mr-md-auto font-weight-normal fw-bold">
    <a href="<?= base_url(); ?>" class="text-dark text-decoration-none">
      Buku<span class="text-primary">Perpus</span>
    </a>
  </h5>
  <a href="<?= base_url('login'); ?>" class="btn btn-primary">Login petugas</a>
</header>
<div class="px-4 pt-5 my-5 text-center border-bottom">
  <h1 class="display-4 fw-bold text-body-emphasis">Buku<span class="text-primary">Perpus</span></h1>
  <div class="col-lg-8 mx-auto">
    <p class="lead mb-4">"BukuPerpus adalah solusi praktis bagi pencinta buku yang ingin mengetahui koleksi yang tersedia di perpustakaan.
      Jelajahi daftar buku kami secara online dan lakukan peminjaman langsung di lokasi untuk pengalaman membaca yang lebih mudah dan menyenangkan."</p>
    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
      <a href="<?= base_url('book'); ?>" class="btn btn-outline-secondary btn-lg px-4">Daftar buku</a>
    </div>
  </div>
  <div class="container px-5 mt-5">
    <div class="row g-4 justify-content-center">
      <div class="col-md-8 col-lg-5">
        <img src="<?= base_url('assets/images/pinjam_buku.jpg'); ?>" class="showcase-img border rounded-3 shadow-lg" alt="Peminjaman Buku" loading="lazy">
      </div>
      <div class="col-md-8 col-lg-5">
        <img src="<?= base_url('assets/images/website_perpus.png'); ?>" class="showcase-img border rounded-3 shadow-lg" alt="Tampilan Website Perpustakaan" loading="lazy">
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>