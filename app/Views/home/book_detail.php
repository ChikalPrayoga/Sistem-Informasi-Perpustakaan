<?= $this->extend('layouts/home_layout') ?>

<?= $this->section('head') ?>
<title>Detail Buku: <?= $book['title']; ?></title>
<style>
  .book-cover {
    width: 100%;
    max-width: 300px;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  }

  .book-details dt {
    font-weight: 600;
    width: 120px;
  }

  .book-details dd {
    margin-left: 130px;
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container my-5">

  <div class="row">
    <div class="col-12 mb-4">
      <a href="<?= base_url('book'); ?>" class="btn btn-outline-primary">
        <i class="ti ti-arrow-left"></i>
        Kembali ke Daftar Buku
      </a>
    </div>
  </div>

  <div class="row g-5">
    <div class="col-md-4 text-center text-md-start">
      <?php
      $coverImageFilePath = BOOK_COVER_URI . $book['book_cover'];
      $coverImageUrl = base_url((!empty($book['book_cover']) && file_exists($coverImageFilePath)) ? $coverImageFilePath : BOOK_COVER_URI . DEFAULT_BOOK_COVER);
      ?>
      <img src="<?= $coverImageUrl; ?>" class="book-cover" alt="Cover <?= esc($book['title']); ?>">
    </div>

    <div class="col-md-8">
      <h1 class="fw-bold"><?= esc($book['title']); ?></h1>
      <p class="text-muted fs-5 mb-4">Oleh <?= esc($book['author']); ?> (<?= esc($book['year']); ?>)</p>

      <dl class="row book-details">
        <dt class="col-sm-3">Penerbit</dt>
        <dd class="col-sm-9">: <?= esc($book['publisher']); ?></dd>

        <dt class="col-sm-3">Kategori</dt>
        <dd class="col-sm-9">: <?= esc($book['category'] ?? 'Tidak ada kategori'); ?></dd>

        <dt class="col-sm-3">Stok Tersedia</dt>
        <dd class="col-sm-9">: <?= esc($book['quantity'] ?? 0); ?> Buah</dd>

        <dt class="col-sm-3">Lokasi Rak</dt>
        <dd class="col-sm-9">: Lantai <?= esc($book['floor'] ?? '-'); ?>, Rak <?= esc($book['rack'] ?? '-'); ?></dd>
      </dl>

      <hr class="my-4">

      <h5 class="fw-semibold">Sinopsis</h5>
      <p><?= nl2br(esc($book['synopsis'] ?? 'Sinopsis tidak tersedia.')); ?></p>
    </div>
  </div>
</div>
<?= $this->endSection() ?>