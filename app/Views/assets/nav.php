<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid container">
        <a class="navbar-brand" href="#">
            <img src="<?= ($title == 'detail') ? '../img/logo.png' : '/img/logo.png' ?>" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Ren<b>Shop</b>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= ($title == 'home') ? 'active' : '' ?>" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($title == 'insert') ? 'active' : '' ?>" href="/insert">Insert</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Info</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mr-5">
                <li class="nav-item" style="color:white;margin-right:5px;">
                    <?= user()->username ?>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="btn btn-danger ms-auto">logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>