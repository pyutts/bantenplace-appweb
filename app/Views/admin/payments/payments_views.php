<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Daftar Payments</h4>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="paymentsTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Kode Transaksi</th>
                         
                            <th>Status Pembayaran</th>
                            <th>Jumlah Bayar</th>
                            <th>Tanggal Bayar</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($payments) && is_array($payments)): ?>
                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?= esc($payment['order_id']) ?></td>
                                    <td><?= esc($payment['transaction_id']) ?></td>
                                   
                                    <td><?= esc($payment['payment_status']) ?></td>
                                    <td>Rp. <?= esc(number_format($payment['amount_paid'], 0, ',', '.')) ?></td>
                                    <td><?= esc($payment['payment_date']) ?></td>
                                    <td>Rp. <?= esc(number_format($payment['total_price'], 0, ',', '.')) ?></td>
                                    <td>
                                        <a href="<?= base_url('dashboard/payments/view/' . $payment['order_id']) ?>" class="btn btn-info btn-sm">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data payments</td>
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
    $('#paymentsTable').DataTable({
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