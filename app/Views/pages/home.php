<?= $this->extend('template/main') ?>

<?= $this->section('main') ?>


<form action="" method="post">
    <div class="input-group mb-3 mt-3 container">
        <input type="text" class="form-control" placeholder="Tuliskan Nama Produk" aria-label="Recipient's username" aria-describedby="button-addon2" name="keyword" autofocus autocomplete="off">
        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari..</button>
    </div>
</form>



<div class="row text-center justify-content-center">
    <div class="col-md-7 mt-5">
        <section class="jumbotron jumbotron-fluid">
            <div class="container">
                <img src="img/jumbotron.jpg" alt="" width="900px" height="500px" class="img-fluid">
            </div>
        </section>
    </div>
    <div class="col-md-2 mt-3 this">
        <img src="img/jumbotron2.jpg" alt="" width="400px" class="img-fluid">
        <img src="img/jumbotron3.jpg" alt="" width="400px" class="img-fluid mt-3">
    </div>
</div>

<?php if (session()->getFlashdata('upload')) : ?>
    <div class="alert alert-success mt-3 mb-3 container" role="alert">
        <?= session()->getFlashdata('upload') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('delete')) : ?>
    <div class="alert alert-danger mt-3 mb-3 container" role="alert">
        <?= session()->getFlashdata('delete') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('ubah')) : ?>
    <div class="alert alert-primary mt-3 mb-3 container" role="alert">
        <?= session()->getFlashdata('ubah') ?>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <?php foreach ($produk as $p) : ?>
            <div class="col-md-4 mb-3">
                <div class="card" style="">
                    <img src="img/<?= $p['gambar'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $p['nama'] ?></h5>
                        <p class="card-text"><?= $p['harga'] ?></p>
                        <p class="card-text"><?= $p['merek'] ?></p>
                        <?php if (in_groups('admin')) : ?>
                            <a href="/detail/<?= $p['slug'] ?>" class="btn btn-primary">Detail Produk</a>
                        <?php endif; ?>
                        <a href="/order/<?= $p['slug'] ?>" class="btn btn-success">Beli!</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $pager->links('produk', 'default_my') ?>






<?= $this->endSection() ?>