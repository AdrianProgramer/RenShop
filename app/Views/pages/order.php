<?= $this->extend('template/main') ?>

<?= $this->section('main') ?>

<div class="my-form mt-5 justify-content-center">
    <h1 class="text-center">Form Produk</h1>
    <form action="/order/save" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="slug" value="<?= $produk['slug'] ?>">
        <input type="hidden" name="nama_barang" value="<?= $produk['nama'] ?>">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nama Lengkap: </label>
            <input type="text" class="form-control <?= ($errors->hasError('nama')) ? 'is-invalid' : '' ?>" id="exampleInputPassword1" name="nama" autocomplete="off">
            <?= $errors->getError('harga') ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Alamat: </label>
            <input type="text" class="form-control <?= ($errors->hasError('alamat')) ? 'is-invalid' : '' ?>" id="exampleInputPassword1" name="alamat" autocomplete="off">
            <?= $errors->getError('merek') ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Jumlah: </label>
            <input type="text" class="form-control <?= ($errors->hasError('jumlah')) ? 'is-invalid' : '' ?>" id="exampleInputPassword1" name="jumlah" autocomplete="off">
            <?= $errors->getError('merek') ?>
        </div>
        <button type="submit" class="btn btn-success">Insert!</button>
    </form>
</div>

<?= $this->endSection() ?>