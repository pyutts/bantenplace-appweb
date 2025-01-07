<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<?= $this->include('admin/orders/editOrder'); ?>
<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Daftar Orders</h4>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="ordersTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Ekspedisi</th>
                            <th>Transaction ID</th>
                            <th>Payment Amount</th>
                            <th>Payment Date</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($orders) && is_array($orders)): ?>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= esc($order['customer_name']) ?></td>
                                    <td>Rp. <?= esc(number_format($order['total_price'], 0, ',', '.')) ?></td>
                                    <td><?= esc($order['status']) ?></td>
                                    <td><?= esc($order['nama_ekspedisi']) ?></td>
                                    <td><?= esc($order['transaction_id']) ?></td>
                                    <td>Rp. <?= esc(number_format($order['payment_amount'], 0, ',', '.')) ?></td>
                                    <td><?= esc($order['payment_date']) ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editOrder(<?= $order['id'] ?>)">Edit</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data orders</td>
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

    // Handle form submission for editing order
    $('#formEdit').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah anda yakin ingin mengubah data order ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, update!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire('Success', response.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    }
                });
            }
        });
    });
});

function editOrder(id) {
    $.ajax({
        url: '<?= base_url('dashboard/orders/edit') ?>/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#order_id').val(response.data.id);
                $('#edit_status').val(response.data.status);
                $('#edit_ekspedisi_id').val(response.data.ekspedisi_id);
                $('#modalEdit').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        }
    });
}
</script>

<?= $this->endSection(); ?>