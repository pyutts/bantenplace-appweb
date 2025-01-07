<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<?= $this->include('admin/ekspedisi/addEkspedisi'); ?>
<?= $this->include('admin/ekspedisi/editEkspedisi'); ?>
<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Daftar Ekspedisi</h4>
            <button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"></i> Tambah Ekspedisi
            </button>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="ekspedisiTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Ekspedisi</th>
                            <th>Harga Ongkir</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ekspedisi) && is_array($ekspedisi)): ?>
                            <?php foreach ($ekspedisi as $exp): ?>
                                <tr>
                                    <td><?= esc($exp['nama_ekspedisi']) ?></td>
                                    <td>Rp. <?= esc(number_format($exp['harga_ongkir'], 0, ',', '.')) ?></td>
                                    <td><?= esc($exp['satuan']) ?> / Kg</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="editEkspedisi(<?= $exp['id'] ?>)">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteEkspedisi(<?= $exp['id'] ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data ekspedisi</td>
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
    $('#ekspedisiTable').DataTable({
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

    // Handle form submission for adding ekspedisi
    $('#formAdd').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah anda yakin ingin menambah ekspedisi ini?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, tambahkan!',
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

    // Handle form submission for editing ekspedisi
    $('#formEdit').on('submit', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi',
            text: "Apakah anda yakin ingin mengubah data ekspedisi ini?",
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

function editEkspedisi(id) {
    $.ajax({
        url: '<?= base_url('dashboard/ekspedisi/edit') ?>/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#ekspedisi_id').val(response.data.id);
                $('#edit_nama_ekspedisi').val(response.data.nama_ekspedisi);
                $('#edit_harga_ongkir').val(response.data.harga_ongkir);
                $('#edit_satuan').val(response.data.satuan);
                $('#modalEdit').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        }
    });
}

function deleteEkspedisi(id) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('dashboard/ekspedisi/delete') ?>/' + id,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Deleted!', response.message, 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                }
            });
        }
    });
}
</script>

<?= $this->endSection(); ?>