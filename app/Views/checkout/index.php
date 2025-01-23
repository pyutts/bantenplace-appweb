<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('styles') ?>
<style>
.order-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.order-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.order-item {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    overflow: hidden;
}

.order-header {
    background: #f8f9fa;
    padding: 12px 20px;
    border-bottom: 1px solid #e0e0e0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-id {
    color: #333;
    font-weight: 500;
}

.order-date {
    color: #666;
    font-size: 14px;
    margin-left: 15px;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 13px;
    font-weight: 500;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-paid { background: #d1ecf1; color: #0c5460; }
.status-shipped { background: #cce5ff; color: #004085; }
.status-completed { background: #d4edda; color: #155724; }

.order-body {
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 20px;
}

.product-image {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 6px;
}

.product-details {
    flex: 1;
}

.product-name {
    font-size: 16px;
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
}

.product-meta {
    color: #666;
    font-size: 14px;
    margin-bottom: 8px;
}

.product-price {
    font-weight: 600;
    color: #198754;
}

.order-actions {
    padding: 15px 20px;
    background: #f8f9fa;
    border-top: 1px solid #e0e0e0;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-action {
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.btn-track {
    background: #e9ecef;
    color: #495057;
}

.btn-track:hover {
    background: #dee2e6;
    color: #212529;
}

.btn-invoice {
    background: #198754;
    color: #fff;
}

.btn-invoice:hover {
    background: #157347;
}

.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-state img {
    width: 200px;
    margin-bottom: 20px;
}

@media (max-width: 768px) {
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }

    .order-body {
        flex-direction: column;
        text-align: center;
    }

    .product-image {
        width: 120px;
        height: 120px;
    }

    .order-actions {
        flex-direction: column;
    }

    .btn-action {
        width: 100%;
        justify-content: center;
    }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="order-container">
    <h3 class="mb-4">Pesanan Saya</h3>
    
    <?php if (empty($orders)): ?>
    <div class="empty-state">
        <img src="<?= base_url('assets/images/empty-order.png') ?>" alt="Empty Order">
        <h5>Belum ada pesanan</h5>
        <p class="text-muted">Mulai belanja dan nikmati layanan kami</p>
        <a href="<?= base_url('shop') ?>" class="btn btn-success">
            Mulai Belanja
        </a>
    </div>
    <?php else: ?>
    <div class="order-list">
        <?php foreach ($orders as $order): ?>
        <div class="order-item">
            <div class="order-header">
                <div>
                    <span class="order-id">Order #<?= $order['order_id'] ?></span>
                    <span class="order-date">
                        <i class="bi bi-calendar3"></i> 
                        <?= date('d M Y', strtotime($order['created_at'])) ?>
                    </span>
                </div>
                <span class="status-badge status-<?= strtolower($order['status']) ?>">
                    <?= $order['status'] ?>
                </span>
            </div>
            
            <div class="order-body">
                <img src="<?= base_url('uploads/products/' . $order['gambar_products']) ?>" 
                     alt="<?= $order['name_products'] ?>" 
                     class="product-image">
                
                <div class="product-details">
                    <div class="product-name"><?= $order['name_products'] ?></div>
                    <div class="product-meta">
                        <span><i class="bi bi-box-seam"></i> <?= $order['quantity'] ?> items</span>
                        <span class="mx-2">•</span>
                        <span>Rp <?= number_format($order['price'], 0, ',', '.') ?> / item</span>
                    </div>
                    <div class="product-price">
                        Total: Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                    </div>
                </div>
            </div>
            
            <div class="order-actions">
                <a href="<?= base_url('checkout/tracking/' . $order['id']) ?>" 
                   class="btn-action btn-track">
                    <i class="bi bi-truck"></i> Lacak Pesanan
                </a>
                <a href="<?= base_url('checkout/invoice/' . $order['id']) ?>" 
                   class="btn-action btn-invoice">
                    <i class="bi bi-download"></i> Download Invoice
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?> 