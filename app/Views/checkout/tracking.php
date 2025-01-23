<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('styles') ?>
<style>
.tracking-wrapper {
    padding: 40px 0;
}

.tracking-status {
    position: relative;
    margin-bottom: 60px;
}

.tracking-line {
    height: 3px;
    background: #e9ecef;
    position: relative;
    width: 100%;
    margin: 0 auto;
    margin-top: 30px;
}

.tracking-dot {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #e9ecef;
    position: absolute;
    top: -11px;
    transition: all 0.3s ease;
}

.tracking-dot.active {
    background: #198754;
    animation: pulse 1.5s infinite;
}

.tracking-dot.completed {
    background: #198754;
}

.tracking-label {
    position: absolute;
    top: -40px;
    transform: translateX(-50%);
    font-size: 14px;
    color: #6c757d;
}

.tracking-dot:nth-child(1) { left: 0%; }
.tracking-dot:nth-child(2) { left: 33.33%; }
.tracking-dot:nth-child(3) { left: 66.66%; }
.tracking-dot:nth-child(4) { left: 100%; }

@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(25, 135, 84, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(25, 135, 84, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(25, 135, 84, 0);
    }
}

.order-details {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    margin-top: 30px;
}

.product-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.shipping-info {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
    margin-top: 20px;
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid py-5"></div>

<div class="container py-5">
    <!-- Timeline Progress -->
    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <div class="position-relative">
                <!-- Progress Line -->
                <div class="progress" style="height: 2px;">
                    <?php
                    $progressWidth = match($order['status']) {
                        'Pending' => 25,
                        'Dibayar' => 50,
                        'Dikirim' => 75,
                        'Selesai' => 100,
                        default => 0
                    };
                    ?>
                    <div class="progress-bar bg-success" style="width: <?= $progressWidth ?>%"></div>
                </div>

                <!-- Timeline Items -->
                <div class="d-flex justify-content-between position-relative" style="margin-top: -10px;">
                    <!-- Pesanan Dibuat -->
                    <div class="text-center" style="width: 120px;">
                        <div class="btn btn-sm <?= $progressWidth >= 25 ? 'btn-success' : 'btn-light border' ?> rounded-circle mb-2">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <div class="mt-2">
                            <small class="d-block text-muted">Pesanan Dibuat</small>
                            <small class="d-block text-dark"><?= date('d M Y', strtotime($order['created_at'])) ?></small>
                        </div>
                    </div>

                    <!-- Pembayaran -->
                    <div class="text-center" style="width: 120px;">
                        <div class="btn btn-sm <?= $progressWidth >= 50 ? 'btn-success' : 'btn-light border' ?> rounded-circle mb-2">
                            <i class="bi bi-wallet2"></i>
                        </div>
                        <div class="mt-2">
                            <small class="d-block text-muted">Pembayaran</small>
                            <small class="d-block text-dark">
                                <?= $progressWidth >= 50 ? date('d M Y', strtotime($order['updated_at'])) : '-' ?>
                            </small>
                        </div>
                    </div>

                    <!-- Pengiriman -->
                    <div class="text-center" style="width: 120px;">
                        <div class="btn btn-sm <?= $progressWidth >= 75 ? 'btn-success' : 'btn-light border' ?> rounded-circle mb-2">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div class="mt-2">
                            <small class="d-block text-muted">Pengiriman</small>
                            <small class="d-block text-dark">
                                <?= $progressWidth >= 75 ? date('d M Y', strtotime($order['updated_at'])) : '-' ?>
                            </small>
                        </div>
                    </div>

                    <!-- Selesai -->
                    <div class="text-center" style="width: 120px;">
                        <div class="btn btn-sm <?= $progressWidth >= 100 ? 'btn-success' : 'btn-light border' ?> rounded-circle mb-2">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="mt-2">
                            <small class="d-block text-muted">Selesai</small>
                            <small class="d-block text-dark">
                                <?= $progressWidth == 100 ? date('d M Y', strtotime($order['updated_at'])) : '-' ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Cards -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="row g-4">
                <!-- Detail Produk -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="card-title mb-4">Detail Produk</h6>
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('uploads/products/' . $order['gambar_products']) ?>" 
                                     class="rounded" 
                                     style="width: 70px; height: 70px; object-fit: cover;"
                                     alt="<?= $order['name_products'] ?>">
                                <div class="ms-3">
                                    <h6 class="mb-1"><?= $order['name_products'] ?></h6>
                                    <p class="text-muted mb-1">Quantity: <?= $order['quantity'] ?></p>
                                    <div class="text-success">
                                        Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Pengiriman -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h6 class="card-title mb-4">Informasi Pengiriman</h6>
                            <div class="mb-3">
                                <div class="text-muted mb-1">Penerima:</div>
                                <div><?= $order['nama'] ?></div>
                            </div>
                            <div class="mb-3">
                                <div class="text-muted mb-1">Alamat Pengiriman:</div>
                                <div><?= $order['alamat'] ?></div>
                            </div>
                            <div class="mb-3">
                                <div class="text-muted mb-1">No. Telepon:</div>
                                <div><?= $order['no_telepon'] ?></div>
                            </div>
                            <div>
                                <div class="text-muted mb-1">Ekspedisi:</div>
                                <div>
                                    <?= $order['nama_ekspedisi'] ?> - 
                                    Rp <?= number_format($order['harga_ongkir'], 0, ',', '.') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="<?= base_url('checkout') ?>" class="btn btn-outline-secondary px-4">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <a href="<?= base_url('checkout/invoice/' . $order['id']) ?>" 
                   class="btn btn-success px-4">
                    <i class="bi bi-file-text me-1"></i> Lihat Invoice
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Auto update status setiap 30 detik
setInterval(function() {
    $.ajax({
        url: '<?= base_url('checkout/checkStatus/' . $order['id']) ?>',
        type: 'GET',
        success: function(response) {
            if (response.status !== '<?= $order['status'] ?>') {
                location.reload();
            }
        }
    });
}, 30000);
</script>
<?= $this->endSection() ?> 
