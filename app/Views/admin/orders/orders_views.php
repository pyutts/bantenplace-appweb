<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>
<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Daftar Pesanan</h4>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="ordersTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Nama Customer</th>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Metode Pembayaran</th>
                            <th>Ekspedisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders) && is_array($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= esc($order['order_id']) ?></td>
                                    <td><?= esc($order['customer_name']) ?></td>
                                    <td><?= esc($order['product_name']) ?></td>
                                    <td><?= esc($order['category_name']) ?></td>
                                    <td><?= esc($order['status']) ?></td>
                                    <td><?= esc($order['payment_method_name']) ?></td>
                                    <td><?= esc($order['nama_ekspedisi']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data order</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#ordersTable').DataTable({
        responsive: true,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ entri",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
                previous: "Sebelumnya",
                next: "Selanjutnya"
            }
        }
    });

});
</script>

<?= $this->endSection(); ?>