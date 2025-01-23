<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid py-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">100% Buatan UMKM</h4>
                        <h1 class="mb-5 display-3 text-primary">Tempat Banten dan Upakara Terlengkap</h1>
                        <div class="position-relative mx-auto">
                            <form action="<?= base_url('shop') ?>" method="GET" class="d-flex">
                                <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" 
                                       type="text" 
                                       name="search" 
                                       placeholder="Banten Caru Lengkap...">
                                <button type="submit" 
                                        class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" 
                                        style="top: 0; right: 25%;">
                                    Carilah
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded">
                                    <img src="<?= base_url('home');?>/img/hero-img-1.jpg" class="img-fluid w-100 h-100 bg-secondary rounded" alt="1">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Banten Dewa Yadnya</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="<?= base_url('home');?>/img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded" alt="2">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Banten Rsi Yadnya</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="<?= base_url('home');?>/img/hero-img-3.jpg" class="img-fluid w-100 h-100 rounded" alt="3">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Banten Manusa Yadnya</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="<?= base_url('home');?>/img/hero-img-4.jpg" class="img-fluid w-100 h-100 rounded" alt="4">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Banten Pitra Yadnya</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="<?= base_url('home');?>/img/hero-img-5.jpg" class="img-fluid w-100 h-100 rounded" alt="5">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Banten Bhuta Yadnya</a>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
         <!-- Features Websitenmya -->
         <div class="container-fluid featurs py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-car-side fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Gratis Pengiriman</h5>
                                <p class="mb-0">Jika Pembelian dalam jumlah banyak</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-user-shield fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Pembayaran Aman</h5>
                                <p class="mb-0">Melalui payment gateway yang aman dan terafiliasi ke Bank</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <!-- <i class="fas fa-exchange-alt fa-3x text-white"></i> -->
                                <i class="fas fa-3x text-white fa-duotone fa-solid fa-people-group"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Kerjasama </h5>
                                <p class="mb-0">Memudahkan akses dalam mencari barang yang dibutuhkan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fa-brands fa-whatsapp fa-3x text-white"></i> 
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Support via Whatsapp</h5>
                                <p class="mb-0">Support yang diberikan untuk kemudahan untuk pengguna</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Banner Section Mulai -->
          <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white">Ingin Upakara Terlengkap ?</h1>
                            <p class="fw-normal display-6 text-white mb-4">di Bantenplace saja</p>
                            <p class="mb-4 text-white">Silahkan Menekan tombol menuju ke halaman shop.</p>
                            <a href="<?= base_url('/shop');?>" class="banner-btn btn border-2 border-white rounded-pill text-white py-3 px-5">SHOP</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative">
                            <img src="<?= base_url('home'); ?>/img/baner-1.png" class="img-fluid w-100 rounded" alt="">
                            <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute" style="width: 140px; height: 140px; top: 0; left: 0;">
                                <h1 style="font-size: 100px;"></h1>
                                <div class="d-flex flex-column">
                                    <span class="h2 mb-0">Mulai</span>
                                    <span class="h4 text-muted mb-0">25 ribu</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       
        
    </div>
<?= $this->endSection(); ?>
