<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">View Payment</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Order ID</label>
                <p><?= esc($payment['order_id']) ?></p>
            </div>
            <div class="form-group">
                <label>Transaction ID</label>
                <p><?= esc($payment['transaction_id']) ?></p>
            </div>
            <div class="form-group">
                <label>Payment Method</label>
                <p><?= esc($payment['payment_method']) ?></p>
            </div>
            <div class="form-group">
                <label>Payment Status</label>
                <p><?= esc($payment['payment_status']) ?></p>
            </div>
            <div class="form-group">
                <label>Amount Paid</label>
                <p>Rp. <?= esc(number_format($payment['amount_paid'], 0, ',', '.')) ?></p>
            </div>
            <div class="form-group">
                <label>Payment Date</label>
                <p><?= esc($payment['payment_date']) ?></p>
            </div>
            <a href="<?= base_url('dashboard/payments') ?>" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>