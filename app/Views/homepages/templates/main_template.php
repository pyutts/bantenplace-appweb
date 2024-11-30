<?= $this->include('homepages/templates/header'); ?>

<!-- Navbar Start -->
<div class="container-fluid fixed-top shadow-sm">
    <div class="container">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="#" class="navbar-brand">
                <img src="<?= base_url('home');?>/img/logogreen.png" alt="Logo" class="display-6" height="33px"></img>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="<?= base_url('/user');?>" class="nav-item nav-link">Beranda</a>
                    <a href="<?= base_url('/shop');?>" class="nav-item nav-link">Shop</a>
                    <a href="<?= base_url('/cart');?>" class="nav-item nav-link">Keranjang</a>
                    <a href="<?= base_url('/testimoni');?>" class="nav-item nav-link">Testimoni</a>
                    <a href="<?= base_url('/about');?>" class="nav-item nav-link">About</a>
                </div>
                <div class="d-flex m-3 me-0">
                    <a href="<?= base_url('/cart');?>" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                    </a>

                    <div class="dropdown">
                        <a class="my-auto btn btn-primary rounded-2 py-2 px-10 rounded-pill text-white h-100" 
                        href="#" 
                        role="button" 
                        data-bs-toggle="dropdown" 
                        aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                            <span>
                                <font size="3"><?= session()->get('username'); ?></font>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-black" href="#">Akun Saya</a></li>
                            <li><a class="dropdown-item text-black" href="#">Atur Pembayaran</a></li>
                            <hr>
                            <li><a class="dropdown-item text-black" href="<?= base_url('/logout');?>"><b>Keluar Akun</b></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<?= $this->renderSection('content'); ?>

<?= $this->include('homepages/templates/footer'); ?>
