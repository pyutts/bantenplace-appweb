<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
    <h2 class="mb-4">Riwayat Pesanan</h2>
    
    <!-- Tambahkan filter dan pencarian -->
    <div class="row mb-4">
        <div class="col-md-4">
            <select class="form-select" id="statusFilter">
                <option value="">Semua Status</option>
                <option value="Pending">Pending</option>
                <option value="Dibayar">Dibayar</option>
                <option value="Dikirim">Dikirim</option>
                <option value="Selesai">Selesai</option>
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" id="searchOrder" 
                   placeholder="Cari pesanan...">
        </div>
    </div>
    
    <?php if (empty($orders)): ?>
    <div class="alert alert-info">
        Belum ada pesanan.
    </div>
    <?php else: ?>
    <div class="row">
        <?php foreach ($orders as $order): ?>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex mb-3">
                        <img src="<?= base_url('uploads/products/' . $order['gambar_products']); ?>" 
                             alt="<?= $order['name_products']; ?>"
                             class="me-3"
                             style="width: 100px; height: 100px; object-fit: cover;">
                        <div>
                            <h5 class="card-title"><?= $order['name_products']; ?></h5>
                            <p class="text-muted mb-1">Order ID: <?= $order['order_id']; ?></p>
                            <p class="text-muted mb-1">
                                <?= date('d/m/Y H:i', strtotime($order['created_at'])); ?>
                            </p>
                            <span class="badge bg-<?= $order['status'] == 'Selesai' ? 'success' : 
                                                   ($order['status'] == 'Dikirim' ? 'info' : 
                                                   ($order['status'] == 'Dibayar' ? 'primary' : 'warning')); ?>">
                                <?= $order['status']; ?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="mb-1">Total: Rp <?= number_format($order['total_price'], 0, ',', '.'); ?></p>
                            <small class="text-muted"><?= $order['payment_method']; ?></small>
                        </div>
                        <a href="<?= base_url('checkout/invoice/' . $order['id']); ?>" 
                           class="btn btn-outline-success btn-sm">
                            Download Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<style>
@media (max-width: 768px) {
    .tracking-wrapper {
        padding: 20px 0;
    }
    
    .product-image {
        width: 60px;
        height: 60px;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .action-buttons .btn {
        width: 100%;
    }
}
</style>

<script>
// Fungsi untuk update status pesanan secara real-time
function updateOrderStatus() {
    const orderId = '<?= $order['id'] ?>';
    
    fetch(`/api/order-status/${orderId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status !== currentStatus) {
                updateStatusUI(data.status);
                updateTrackingProgress(data.status);
            }
        });
}

// Update setiap 30 detik
setInterval(updateOrderStatus, 30000);

// Notifikasi ketika status berubah
function showStatusNotification(status) {
    const notification = new Notification('Status Pesanan Updated', {
        body: `Status pesanan Anda sekarang: ${status}`,
        icon: '/path/to/icon.png'
    });
}

// Tambahkan script untuk filter dan pencarian
document.getElementById('searchOrder').addEventListener('keyup', function() {
    const searchText = this.value.toLowerCase();
    const cards = document.querySelectorAll('.order-card');
    
    cards.forEach(card => {
        const orderText = card.textContent.toLowerCase();
        if (orderText.includes(searchText)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
<?= $this->endSection(); ?> 