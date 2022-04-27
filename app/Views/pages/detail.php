<?= $this->extend('template/main') ?>

<?= $this->section('main') ?>

<div class="container mt-5 justify-content-center">

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="/img/<?= $produk['gambar'] ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $produk['nama'] ?></h5>
                    <p class="card-text"><?= $produk['harga'] ?></p>
                    <p class="card-text"><small class="text-muted"><?= $produk['merek'] ?></small></p>

                    <a href="/update/<?= $produk['slug'] ?>"><button type="submit" class="btn btn-warning">Edit</button></a>

                    <form action="/detail/<?= $produk['id'] ?>" method="post" class="d-inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection() ?>