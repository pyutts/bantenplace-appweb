<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<?= $this->include('admin/users/addUsers'); ?>
<?= $this->include('admin/users/editUsers'); ?>
<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Daftar User</h4>
            <button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"></i> Tambah User
            </button>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="usersTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Kode Pos</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= esc($user['id']) ?></td>
                                    <td><?= esc($user['nama']) ?></td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['no_telepon']) ?></td>
                                    <td><?= esc($user['kode_pos']) ?></td>
                                    <td><?= esc($user['level']) ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="editUser(<?= $user['id'] ?>)">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteUser(<?= $user['id'] ?>)">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data user</td>
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
    $('#usersTable').DataTable({
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

    // Handle form submission for adding user
    $('#formAdd').on('submit', function(e) {
        e.preventDefault();
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
    });

    // Handle form submission for editing user
    $('#formEdit').on('submit', function(e) {
        e.preventDefault();
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
    });
});

function editUser(id) {
    $.ajax({
        url: '<?= base_url('dashboard/users/edit') ?>/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#user_id').val(response.data.id);
                $('#nama').val(response.data.nama);
                $('#username').val(response.data.username);
                $('#email').val(response.data.email);
                $('#no_telepon').val(response.data.no_telepon);
                $('#kode_pos').val(response.data.kode_pos);
                $('#level').val(response.data.level);
                $('#previewProfilGambarEdit').attr('src', '<?= base_url('public/uploads/users') ?>/' + response.data.profil_gambar);
                $('#modalEdit').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        }
    });
}

function deleteUser(id) {
    Swal.fire({
            title: "Konfirmasi Hapus",
            text: "Apakah Anda yakin ingin menghapus pengguna ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('dashboard/users/delete') ?>/' + id,
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