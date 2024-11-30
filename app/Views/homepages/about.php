<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('content'); ?>

        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">About</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url('/user');?>">Beranda</a></li>
                <li class="breadcrumb-item active text-white">About</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <?= $this->endSection(); ?>