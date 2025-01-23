<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('content'); ?>

<style>
    .about-section {
        padding: 60px 0;
    }
    .about-img {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    .about-img img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }
    .about-img:hover img {
        transform: scale(1.05);
    }
    .timeline {
        position: relative;
        padding: 40px 0;
    }
    .timeline-item {
        padding: 20px;
        margin: 20px 0;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        position: relative;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        width: 2px;
        height: 100%;
        background: #4CAF50;
        left: -20px;
        top: 0;
    }
    .timeline-year {
        color: #4CAF50;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .team-member {
        text-align: center;
        margin: 20px 0;
        padding: 20px;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .team-member:hover {
        transform: translateY(-5px);
    }
    .team-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin: 0 auto 15px;
        overflow: hidden;
    }
    .team-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .mission-vision {
        background: #f8f9fa;
        padding: 40px 0;
        margin: 40px 0;
    }
    .stat-box {
        text-align: center;
        padding: 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        margin: 15px 0;
    }
    .stat-number {
        font-size: 2.5em;
        color: #4CAF50;
        font-weight: bold;
    }
</style>

<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Tentang Kami</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="<?= base_url('/user');?>">Beranda</a></li>
        <li class="breadcrumb-item active text-white">Tentang Kami</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- About Section Start -->
<div class="container about-section">
    <div class="row align-items-center">
        <div class="col-lg-12">
            <h2 class="display-4 mb-4">Selamat Datang di Bantenplace</h2>
            <p class="lead mb-4">BantenPlace adalah marketplace pertama yang mengkhususkan diri dalam penyediaan banten dan perlengkapan upacara adat Bali.</p>
            <p class="mb-4">Didirikan pada tahun 2024, kami berkomitmen untuk melestarikan dan memudahkan akses masyarakat terhadap kebutuhan upacara adat Bali. Melalui platform digital kami, kami menghubungkan pengrajin banten tradisional dengan masyarakat modern.</p>
        </div>
    </div>
</div>
<!-- About Section End -->

<!-- Mission Vision Section Start -->
<div class="mission-vision">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="timeline-item">
                    <h3>Visi</h3>
                    <p>Menjadi platform terdepan dalam pelestarian dan modernisasi akses terhadap kebutuhan upacara adat Bali.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="timeline-item">
                    <h3>Misi</h3>
                    <ul>
                        <li>Menyediakan akses mudah untuk mendapatkan banten berkualitas</li>
                        <li>Melestarikan tradisi dan budaya Bali</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mission Vision Section End -->

<!-- Timeline Section Start -->
<div class="container">
    <h2 class="text-center mb-5">Perjalanan Kami</h2>
    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-year">2024</div>
            <h4>Awal Mula</h4>
            <p>Bantenplace didirikan sebagai solusi digital untuk kebutuhan upacara adat Bali.</p>
        </div>
        <div class="timeline-item">
            <div class="timeline-year">2024 s/d 2025</div>
            <h4>Pengembangan Platform</h4>
            <p>Peluncuran website dan aplikasi mobile untuk kemudahan akses pelanggan.</p>
        </div>
    </div>
</div>
<!-- Timeline Section End -->

<!-- Team Section Start -->
<div class="container py-5">
    <h2 class="text-center mb-5">Tim Kami</h2>
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="team-member">
                <div class="team-img">
                    <img src="<?= base_url('uploads');?>/default/default_user.png" alt="Team Member">
                </div>
                <h4>Mangku Alit</h4>
                <p>Founder</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="team-member">
                <div class="team-img">
                    <img src="<?= base_url('uploads');?>/default/default_user.png" alt="Team Member">
                </div>
                <h4>I Putu Agus Wiadnyana</h4>
                <p>Admin</p>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="team-member">
                <div class="team-img">
                    <img src="<?= base_url('uploads');?>/default/default_user.png" alt="Team Member">
                </div>
                <h4>I Made Oka Raditya Widana</h4>
                <p>Marketing Director</p>
            </div>
        </div>
    </div>
</div>
<!-- Team Section End -->

<?= $this->endSection(); ?>