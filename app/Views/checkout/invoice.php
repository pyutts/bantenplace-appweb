<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('content') ?>
<div class="container-fluid py-5"></div>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <!-- Header Invoice -->
                    <div class="text-center mb-5">
                        <h4 class="mb-0">INVOICE</h4>
                        <p class="text-muted">#<?= $order['order_id'] ?></p>
                    </div>

                    <!-- Info Pembeli dan Tanggal -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="mb-3">Info Pembeli:</h6>
                            <p class="mb-1"><?= $order['nama'] ?></p>
                            <p class="mb-1"><?= $order['alamat'] ?></p>
                            <p class="mb-0"><?= $order['no_telepon'] ?></p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h6 class="mb-3">Tanggal Pemesanan:</h6>
                            <p class="mb-1"><?= date('d F Y', strtotime($order['created_at'])) ?></p>
                            <p class="mb-1">Status: <span class="badge bg-success"><?= $order['status'] ?></span></p>
                        </div>
                    </div>

                    <!-- Tabel Produk -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga Satuan</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('uploads/products/' . $order['gambar_products']) ?>" 
                                                 class="rounded me-2" style="width: 50px;"
                                                 alt="<?= $order['name_products'] ?>">
                                            <?= $order['name_products'] ?>
                                        </div>
                                    </td>
                                    <td class="text-center"><?= $order['quantity'] ?></td>
                                    <td class="text-end">
                                        Rp <?= number_format($order['total_price']/$order['quantity'], 0, ',', '.') ?>
                                    </td>
                                    <td class="text-end">
                                        Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Ringkasan Biaya -->
                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="bg-light p-3 rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span>Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Ongkos Kirim (<?= $order['nama_ekspedisi'] ?>)</span>
                                    <span>Rp <?= number_format($order['harga_ongkir'], 0, ',', '.') ?></span>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <strong>Total</strong>
                                    <strong>
                                        Rp <?= number_format($order['total_price'] + $order['harga_ongkir'], 0, ',', '.') ?>
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="text-center mt-5">
                        <button onclick="openInvoicePdf()" class="btn btn-primary">
                            <i class="bi bi-file-pdf me-1"></i> Lihat Invoice PDF
                        </button>
                        <a href="<?= base_url('checkout') ?>" class="btn btn-outline-secondary ms-2">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openInvoicePdf() {
    window.open(
        '<?= base_url('checkout/generateInvoicePdf/' . $order['id']) ?>', 
        'Invoice PDF',
        'width=800,height=600'
    );
}
</script>
<?= $this->endSection() ?> 