<?= $this->extend('template/main') ?>

<?= $this->section('main') ?>

<div class="my-form mt-5 justify-content-center">
    <h1 class="text-center">Form Produk</h1>
    <form action="/update/<?= $produk['id'] ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="slug" value="<?= $produk['slug'] ?>">
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Nama Produk: </label>
            <input type="text" class="form-control <?= ($errors->hasError('nama')) ? 'is-invalid' : '' ?>" value="<?= old('nama') ? old('nama') : $produk['nama'] ?>" id="exampleInputPassword1" name="nama" autofocus autocomplete="off">
            <?= $errors->getError('nama') ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Harga Produk: </label>
            <input type="text" class="form-control <?= ($errors->hasError('harga')) ? 'is-invalid' : '' ?>" value="<?= old('harga') ? old('harga') : $produk['harga'] ?>" id="exampleInputPassword1" name="harga" autocomplete="off">
            <?= $errors->getError('harga') ?>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Merek Produk: </label>
            <input type="text" class="form-control <?= ($errors->hasError('merek')) ? 'is-invalid' : '' ?>" value="<?= old('merek') ? old('merek') : $produk['merek'] ?>" id="exampleInputPassword1" name="merek" autocomplete="off">
            <?= $errors->getError('merek') ?>
        </div>
        <div class="input-group mb-3">
            <input type="file" class="form-control <?= ($errors->hasError('gambar')) ? 'is-invalid' : '' ?>" value="" id="inputGroupFile02" name="gambar" value="<?= old('gambar') ? old('gambar') : $produk['gambar'] ?>">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
            <p style="color:red;"><?= $errors->getError('gambar') ?></p>
        </div>
        <button type="submit" class="btn btn-warning">Edit!</button>
    </form>
</div>


<?= $this->endSection() ?>