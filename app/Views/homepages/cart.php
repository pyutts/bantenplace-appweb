<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid page-header py-5" id="cart-container">
    <h1 class="text-center text-white display-6">Keranjang</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="<?= base_url('/homes');?>">Beranda</a></li>
        <li class="breadcrumb-item active text-white">Keranjang</li>
    </ol>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <h2 class="mb-4">Keranjang Belanja</h2>
        <?php if (!empty($cartItems)): 
            // Hitung total di awal
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        ?>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <?php foreach ($cartItems as $item): 
                                $subtotal = $item['price'] * $item['quantity'];
                            ?>
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-2">
                                    <img src="<?= base_url('uploads/products/' . $item['gambar_products']); ?>" 
                                         class="img-fluid rounded" alt="<?= $item['name_products']; ?>">
                                </div>
                                <div class="col-md-4">
                                    <h5><?= $item['name_products']; ?></h5>
                                    <p class="text-muted">Rp <?= number_format($item['price'], 0, ',', '.'); ?></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <button class="btn btn-outline-secondary update-cart" 
                                                data-cartid="<?= $item['cart_id']; ?>" 
                                                data-action="decrease">-</button>
                                        <input type="text" class="form-control text-center" 
                                               value="<?= $item['quantity']; ?>" readonly>
                                        <button class="btn btn-outline-secondary update-cart" 
                                                data-cartid="<?= $item['cart_id']; ?>" 
                                                data-action="increase">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <p class="mb-0">Rp <?= number_format($subtotal, 0, ',', '.'); ?></p>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-danger btn-sm remove-from-cart" 
                                            data-cartid="<?= $item['cart_id']; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Ringkasan Pesanan</h5>
                            <div class="mb-3">
                                <label class="form-label">Metode Pembayaran</label>
                                <select class="form-select" id="payment_method_id" required>
                                    <option value="">Pilih metode pembayaran</option>
                                    <?php foreach ($paymentMethods as $method): ?>
                                        <option value="<?= $method['id']; ?>"><?= $method['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ekspedisi</label>
                                <select class="form-select" id="ekspedisi_id" required>
                                    <option value="">Pilih ekspedisi</option>
                                    <?php foreach ($ekspedisi as $eks): ?>
                                        <option value="<?= $eks['id']; ?>" 
                                                data-ongkir="<?= $eks['harga_ongkir']; ?>">
                                            <?= $eks['nama_ekspedisi']; ?> - 
                                            Rp <?= number_format($eks['harga_ongkir'], 0, ',', '.'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span id="cart-subtotal">Rp <?= number_format($total, 0, ',', '.'); ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Ongkos Kirim</span>
                                <span id="ongkir">Rp 0</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total</strong>
                                <strong id="cart-total">Rp <?= number_format($total, 0, ',', '.'); ?></strong>
                            </div>
                            <button class="btn btn-primary w-100" id="checkout-btn">
                                Checkout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <h4>Keranjang belanja kosong</h4>
                <a href="<?= base_url('/shop'); ?>" class="btn btn-primary mt-3">Belanja Sekarang</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .total-price-container {
        max-width: 100%;
        margin-top: 30px;
    }
    .total-price-box {
        width: 100%;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        background-color: #fff;
        padding: 25px;
    }
    .price-header {
        border-bottom: 2px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    .price-item {
        padding: 12px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .price-label {
        color: #555;
        font-weight: 500;
        margin: 0;
    }
    .price-value {
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    .shipping-select, .bank-select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 5px;
    }
    .total-section {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-radius: 8px;
        margin: 20px 0;
    }
    .total-price {
        color: #2c3e50;
        font-size: 1.2em;
        font-weight: 700;
    }
    .checkout-btn {
        width: 100%;
        padding: 12px;
        font-size: 1.1em;
        font-weight: 600;
        border-radius: 5px;
        background-color: #4CAF50;
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    .checkout-btn:hover {
        background-color: #45a049;
        transform: translateY(-2px);
    }
</style>


<script>
function addToCart(productId, quantity = 1) {
    $.ajax({
        url: `/cart/add/${productId}/${quantity}`,
        method: 'POST',
        success: function(response) {
            if (response.success) {
                // Update cart badge
                $('#cartCount').text(response.cartCount);
                // Show success message with SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
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
                title: 'Error!',
                text: 'Terjadi kesalahan. Silakan coba lagi.'
            });
        }
    });
}


$(document).ready(function() {
    $('#checkout-btn').click(function(e) {
        e.preventDefault();
        
        let paymentMethodId = $('#payment_method_id').val();
        let ekspedisiId = $('#ekspedisi_id').val();
        let totalAmount = $('#cart-total').text().replace(/[^0-9]/g, '');

        if (!paymentMethodId || !ekspedisiId) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Silakan pilih metode pembayaran dan ekspedisi!'
            });
            return;
        }

        console.log('Payment Method:', paymentMethodId);
        console.log('Ekspedisi:', ekspedisiId);
        console.log('Total:', totalAmount);

        $.ajax({
            url: '<?= base_url('cart/checkout') ?>',
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            data: {
                payment_method_id: paymentMethodId,
                ekspedisi_id: ekspedisiId,
                total_amount: totalAmount
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                        showCancelButton: true,
                        confirmButtonText: 'Lihat Pesanan',
                        cancelButtonText: 'Lanjut Belanja'
                    }).then((result) => {
                        if (result.isConfirmed && response.redirect) {
                            window.location.href = response.redirect;
                        } else {
                            window.location.href = '<?= base_url('shop') ?>';
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message || 'Terjadi kesalahan'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat memproses checkout'
                });
            }
        });
    });
});


// Fungsi untuk update quantity
function updateQuantity(cartId, action) {
    $.ajax({
        url: '<?= base_url("cart/update") ?>/' + cartId,
        method: 'POST',
        dataType: 'json',
        data: { action: action },
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Keranjang berhasil diperbarui',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.message
                });
            }
        }
    });
}

// Fungsi untuk hapus item dari keranjang
function removeFromCart(cartId) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Item akan dihapus dari keranjang",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url("cart/remove") ?>/' + cartId,
                method: 'POST',
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {
                        if (response.cartCount !== undefined) {
                            $('#cartCount').text(response.cartCount);
                        }
                        Swal.fire({
                            icon: 'success',
                            title: 'Terhapus!',
                            text: 'Item berhasil dihapus dari keranjang',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message || 'Gagal menghapus item'
                        });
                    }
                }
            });
        }
    });
}

// Event listener untuk tombol-tombol di keranjang
$(document).ready(function() {
    const initialTotal = <?= $total ?? 0 ?>; 

    $('#ekspedisi_id').change(function() {
        const ongkir = $(this).find(':selected').data('ongkir') || 0;
        const total = initialTotal + parseFloat(ongkir);
        
        $('#ongkir').text('Rp ' + numberFormat(ongkir));
        $('#cart-total').text('Rp ' + numberFormat(total));
    });

    // Update quantity buttons
    $('.update-cart').click(function() {
        const cartId = $(this).data('cartid');
        const action = $(this).data('action');
        updateQuantity(cartId, action);
    });

    // Remove item button
    $('.remove-from-cart').click(function() {
        const cartId = $(this).data('cartid');
        removeFromCart(cartId);
    });

    function numberFormat(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
});
</script>

<?= $this->endSection(); ?>