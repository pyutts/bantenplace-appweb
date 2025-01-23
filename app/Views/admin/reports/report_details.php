<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<?php
$bulan = [
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];
?>

<div class="col-md-12 py-5">
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <div>
                <h4 class="card-title mb-0 text-white">Laporan untuk <?= $bulan[$month] ?> <?= $year ?></h4>
            </div>
            <div>
                <a href="<?= base_url('dashboard/reports') ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <a href="<?= base_url('dashboard/reports/exportPdf/' . $month . '/' . $year) ?>" class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-file-pdf"></i> Cetak PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5><i class="fas fa-shopping-cart"></i> Total Pesanan</h5>
                            <h2><?= $monthlyReport['total_orders'] ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5><i class="fas fa-money-bill-wave"></i> Total Pendapatan</h5>
                            <h2>Rp. <?= number_format($monthlyReport['total_income'], 0, ',', '.') ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <h5 class="mb-3"><i class="fas fa-chart-bar"></i> Produk Terbanyak Dibeli Bulan Ini</h5>
                <table class="table table-hover table-bordered">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Total Kuantitas</th>
                            <th>Total Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productsPurchasedThisMonth as $product): ?>
                            <tr>
                                <td><?= esc($product['name_products']) ?></td>
                                <td><?= esc($product['total_quantity']) ?></td>
                                <td>Rp. <?= number_format($product['total_income'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?> 