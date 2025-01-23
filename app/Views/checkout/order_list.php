<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('styles') ?>
<style>
.order-card {
    transition: transform 0.2s;
}

.order-card:hover {
    transform: translateY(-5px);
}

.status-badge {
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 20px;
}

.status-pending { background-color: #ffc107; color: #000; }
.status-paid { background-color: #0dcaf0; color: #fff; }
.status-shipped { background-color: #0d6efd; color: #fff; }
.status-completed { background-color: #198754; color: #fff; }

.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.order-meta {
    font-size: 13px;
    color: #6c757d;
}

.action-buttons .btn {
    padding: 5px 15px;
    font-size: 14px;
}

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid py-5"></div>
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 class="mb-0">Pesanan Saya</h4>
            <p class="text-muted">Kelola semua pesanan Anda di satu tempat</p>
        </div>
        <div class="col-md-4">
            <select class="form-select" id="statusFilter">
                <option value="">Semua Status</option>
                <option value="Pending">Menunggu Pembayaran</option>
                <option value="Dibayar">Sudah Dibayar</option>
                <option value="Dikirim">Dalam Pengiriman</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
    </div>

    <?php if (empty($orders)): ?>
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: #6c757d;"></i>
        </div>
        <h5>Belum ada pesanan</h5>
        <p class="text-muted mb-4">Jelajahi produk kami dan mulai berbelanja</p>
        <a href="<?= base_url('shop') ?>" class="btn btn-primary">
            <i class="bi bi-shop me-2"></i>Mulai Belanja
        </a>
    </div>
    <?php else: ?>
    <div class="row">
        <?php foreach ($orders as $order): ?>
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <span class="text-muted">#<?= $order['order_id'] ?></span>
                            <span class="mx-2">•</span>
                            <span class="text-muted">
                                <i class="bi bi-calendar3"></i> 
                                <?= date('d M Y', strtotime($order['created_at'])) ?>
                            </span>
                        </div>
                        <div class="col text-end">
                            <?php
                            $badgeClass = match($order['status']) {
                                'Pending' => 'bg-warning',
                                'Dibayar' => 'bg-info',
                                'Dikirim' => 'bg-primary',
                                'Selesai' => 'bg-success',
                                default => 'bg-secondary'
                            };
                            ?>
                            <span class="badge <?= $badgeClass ?>"><?= $order['status'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="<?= base_url('uploads/products/' . $order['gambar_products']) ?>" 
                                 class="img-fluid rounded" 
                                 alt="<?= $order['name_products'] ?>">
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-1"><?= $order['name_products'] ?></h5>
                            <p class="mb-1 text-muted">
                                <?= $order['quantity'] ?> x Rp <?= number_format($order['price'], 0, ',', '.') ?>
                            </p>
                            <small class="text-muted">
                                <i class="bi bi-truck"></i> <?= $order['nama_ekspedisi'] ?>
                            </small>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <p class="mb-2">Total Pembayaran:</p>
                            <h5 class="text-primary mb-3">
                                Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                            </h5>
                            <div class="btn-group">
                                <a href="<?= base_url('checkout/tracking/' . $order['id']) ?>" 
                                   class="btn btn-outline-primary">
                                    <i class="bi bi-truck me-1"></i> Lacak
                                </a>
                                <a href="<?= base_url('checkout/invoice/' . $order['id']) ?>" 
                                   class="btn btn-outline-secondary">
                                    <i class="bi bi-file-text me-1"></i> Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
$(document).ready(function() {
    $('#statusFilter').change(function() {
        const status = $(this).val();
        $('.card').each(function() {
            const cardStatus = $(this).find('.badge').text();
            $(this).closest('.col-12')[status && cardStatus !== status ? 'hide' : 'show']();
        });
    });
});
</script>

<?= $this->endSection() ?> 