
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Fruitables - Vegetable Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Libraries Stylesheet -->
        <link href="<?= base_url('home');?>/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="<?= base_url('home');?>/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="<?= base_url('home');?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="<?= base_url('home');?>/css/style.css" rel="stylesheet">
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


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
                            <a href="<?= base_url('/login');?>" class="nav-item nav-link">Beranda</a>
                            <a href="<?= base_url('/login');?>" class="nav-item nav-link">Shop</a>
                            <a href="<?= base_url('/login');?>" class="nav-item nav-link">Shop Detail</a>
                            <a href="<?= base_url('/login');?>" class="nav-item nav-link">Keranjang</a>
                            <a href="<?= base_url('/login');?>" class="nav-item nav-link">Testimoni</a>
                        </div>
                        <div class="d-flex m-3 me-0">
                            <a href="<?= base_url('/login');?>" class="position-relative me-4 my-auto">
                                <i class="fa fa-shopping-bag fa-2x"></i>
                            </a>
                            <a href="<?= base_url('/login');?>" class="my-auto btn btn-primary rounded-2 py-2 px-10 rounded-pill text-white h-100">
                                <i class="fa-solid fa-user"></i>
                                <span>
                                    <font size="3">Login</font>
                                </span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <!-- Hero Start -->
        <div class="container-fluid py-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">100% Buatan UMKM</h4>
                        <h1 class="mb-5 display-3 text-primary">Tempat Banten dan Upakara Terlengkap</h1>
                        <div class="position-relative mx-auto">
                            <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="text" placeholder="Banten Caru Lengkap...">
                            <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Carilah</button>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded">
                                    <img src="<?= base_url('home');?>/img/hero-img-1.png" class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Banten Manusa Yajna</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="<?= base_url('home');?>/img/hero-img-2.jpg" class="img-fluid w-100 h-100 rounded" alt="Second slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Banten Pitra Yajna</a>
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


         <!-- Footer Start -->
         <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
            <div class="container py-5">
                <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                    <div class="row g-4">
                        <div class="col-lg-3">
                            <a href="#">
                                <img src="<?= base_url('home');?>/img/logowhite.png" class="mb-0" alt="Logo" height="35px">
                            </a>
                        </div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-3">
                            <div class="d-flex justify-content-end pt-3">
                                <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-whatsapp"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-5">    
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex flex-column text-start footer-item">
                            <h4 class="text-light mb-3">Shop Menu</h4>
                            <a class="btn-link" href="">Beranda</a>
                            <a class="btn-link" href="">Shop</a>
                            <a class="btn-link" href="">Shop Detail</a>
                            <a class="btn-link" href="">Keranjang</a>
                            <a class="btn-link" href="">Testimoni</a>
                            <a class="btn-link" href="">My Account</a>
                        </div>
                    </div>
                   
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-item">
                            <h4 class="text-light mb-3">Contact</h4>
                            <p>Alamat: Jln Sri Rama No.20 Denpasar</p>
                            <p>Email: adminbantenplace@gmail.com</p>
                            <p>Telepon: +62 81805218333</p>
                            <p>Pembayaran Online maupun Offline</p>
                            <img src="<?= base_url('home');?>/img/payment.png" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-item">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d493.05391379911214!2d115.20933521557679!3d-8.650464306673216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd240a0800e1705%3A0x7418196d58dfdf2d!2s86X5%2BQRP%2C%20Pemecutan%20Kaja%2C%20Kec.%20Denpasar%20Utara%2C%20Kota%20Denpasar%2C%20Bali%2080118!5e0!3m2!1sid!2sid!4v1732806393951!5m2!1sid!2sid" width="480" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-dark py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-light">Desain and Program by <b>Agus Wiadnyana</b></span>
                    </div>
                    <div class="col-md-6 my-auto text-center text-md-end text-white">
                    &copy 2024 <b>Bantenplace</b> Hak Cipta Dilindungi Undang - Undang.
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('home');?>/lib/easing/easing.min.js"></script>
    <script src="<?= base_url('home');?>/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('home');?>/lib/lightbox/js/lightbox.min.js"></script>
    <script src="<?= base_url('home');?>/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('home');?>/js/main.js"></script>
    </body>
</html>
