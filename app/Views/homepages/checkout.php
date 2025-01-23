<?= $this->extend('homepages/templates/main_template') ?>

<?php echo $this->section('content'); ?>
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="<?= base_url('/homes');?>">Beranda</a></li>
        <li class="breadcrumb-item"><a href="<?= base_url('/cart');?>">Keranjang</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="card-header bg-secondary">
                                <h4 class="text-white m-0">Detail Pengiriman</h4>
                            </div>
                            <div class="card-body">
                                <form id="checkoutForm">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" 
                                                   value="<?= $user['nama']; ?>" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No. Telepon</label>
                                            <input type="tel" class="form-control" name="telepon" 
                                                   value="<?= $user['telepon']; ?>" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Alamat Lengkap</label>
                                            <textarea class="form-control" rows="3" name="alamat" 
                                                      required><?= $user['alamat']; ?></textarea>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Catatan Pesanan (Opsional)</label>
                                            <textarea class="form-control" rows="3" name="catatan"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 mb-3">
                    <div class="card-header bg-secondary">
                        <h4 class="text-white m-0">Ringkasan Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <?php foreach ($cartItems as $item): ?>
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span><?= $item['name_products']; ?></span>
                                    <small class="d-block">Qty: <?= $item['quantity']; ?></small>
                                </div>
                                <span>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?></span>
                            </div>
                        <?php endforeach; ?>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Subtotal</strong>
                            <strong>Rp <?= number_format($subtotal, 0, ',', '.'); ?></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong class="text-primary">Rp <?= number_format($subtotal, 0, ',', '.'); ?></strong>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="button" class="btn btn-primary w-100" id="btnProcessCheckout">
                        Proses Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Checkout Page End -->

<?php echo $this->endSection(); ?>

<?php echo $this->section('scripts'); ?>
<script>
$(document).ready(function() {
    $('#btnProcessCheckout').click(function() {
        if (!$('#checkoutForm')[0].checkValidity()) {
            $('#checkoutForm')[0].reportValidity();
            return;
        }

        const formData = new FormData($('#checkoutForm')[0]);

        $.ajax({
            url: '<?= base_url('cart/processCheckout'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '<?= base_url('order/detail/'); ?>' + response.order_id;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan sistem'
                });
            }
        });
    });
});
</script>
<?php echo $this->endSection(); ?> 