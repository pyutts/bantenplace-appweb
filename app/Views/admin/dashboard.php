<?= $this->extend('admin/template/main_template'); ?>

<?= $this->section('content'); ?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">Dashboard</h4>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Selamat Datang di Dashboard Bantenplace <b><?= session()->get('username'); ?></b></h4>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
