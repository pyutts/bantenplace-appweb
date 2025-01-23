<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Lihat Pembayaran</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Order ID</label>
                <p><?= esc($payment['order_id']) ?></p>
            </div>
            <div class="form-group">
                <label>Kode Transaksi</label>
                <p><?= esc($payment['transaction_id']) ?></p>
            </div>
           
            <div class="form-group">
                <label>Status Pembayaran</label>
                <p><?= esc($payment['payment_status']) ?></p>
            </div>
            <div class="form-group">
                <label>Jumlah Bayar</label>
                <p>Rp. <?= esc(number_format($payment['amount_paid'], 0, ',', '.')) ?></p>
            </div>
            <div class="form-group">
                <label>Tanggal Bayar</label>
                <p><?= esc($payment['payment_date']) ?></p>
            </div>
            <div class="form-group">
                <label>Total Harga</label>
                <p>Rp. <?= esc(number_format($payment['total_price'], 0, ',', '.')) ?></p>
            </div>
            <a href="<?= base_url('dashboard/payments') ?>" class="btn btn-secondary">Back</a>
            <a href="<?= base_url('dashboard/payments/report') ?>" class="btn btn-primary">Generate Report</a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>