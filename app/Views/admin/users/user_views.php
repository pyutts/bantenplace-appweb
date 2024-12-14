<?= $this->extend('admin/template/main_template'); ?>

<?= $this->section('content'); ?>

<?= $this->include('admin/users/addUsers'); ?>

<?= $this->include('admin/users/editUsers'); ?>

                <div class="col-md-12 py-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Daftar Users</h4>
                                <button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#modalTambah">
                                    <i class="fa fa-plus"></i>
                                    Tambah Users
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Entri Data -->
                            <div class="table-responsive">
                                <div id="add-row_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="dataTables_length" id="add-row_length">
                                                <label>Tampilkan 
                                                    <select name="add-row_length" aria-controls="add-row" class="form-control form-control-sm">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> Entri
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6"><div id="add-row_filter" class="dataTables_filter">
                                            <label>Cari:
                                                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="add-row">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <!-- End Entri Data -->

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="add-row" class="display table table-striped table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Profil Gambar</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Nama</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Email</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Alamat</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">No Telepon</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Kode Pos</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Rules</th>
                                            <th class="" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                        <?php if (!empty($users) && is_array($users)): ?>
                                            
                                            <?php foreach ($users as $user): 
                                            $num = 1;    
                                            ?>
                                                <tr>
                                                <td>
                                                    <img class="img-thumbnail" style="width: 100px;" src="<?= base_url('uploads/profiles/' . $user['profil_gambar']) ?>" alt="icon">
                                                </td>
                                                    <td><?= $user['nama'] ?></td>
                                                    <td><?= $user['email'] ?></td>
                                                    <td><?= $user['alamat'] ?></td>
                                                    <td><?= $user['no_telepon'] ?></td>
                                                    <td><?= $user['kode_pos'] ?></td>
                                                    <td><?= $user['level'] ?></td>
                                                    <td>
                                                        <div class="form-button-action">
                                                        <button type="button" class="btn btn-link btn-primary btn-lg" data-bs-toggle="modal" data-target="#modalEdit" onclick="loadUser(<?= htmlspecialchars(json_encode($user)) ?>)">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                            <button type="button" class="btn btn-link btn-danger btn-delete" data-id="<?= $user['id'] ?>">
                                                                <i class="fa fa-times"></i>
                                                            </button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data pengguna</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="add-row_info" role="status" aria-live="polite">Tampilkan 1 dari 10 data</div>
                            </div>
                                <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="add-row_paginate">
                                    <ul class="pagination">
                                        <li class="paginate_button page-item previous disabled" id="add-row_previous">
                                            <a href="#" aria-controls="add-row" data-dt-idx="0" tabindex="0" class="page-link">Sebelumnya</a>
                                        </li>
                                        <li class="paginate_button page-item active">
                                            <a href="#" aria-controls="add-row" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                                        </li>
                                    <li class="paginate_button page-item next" id="add-row_next">
                                        <a href="#" aria-controls="add-row" data-dt-idx="3" tabindex="0" class="page-link">Selanjutnya</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function loadUser(user) {
    document.getElementById('id').value = user.id; // Hidden ID
    document.getElementById('edit_nama').value = user.nama; // Nama
    document.getElementById('edit_email').value = user.email; // Email
    document.getElementById('edit_alamat').value = user.alamat; // Alamat
    $('#modalEdit').modal('show'); // Tampilkan modal edit
}

$('.btn-delete').on('click', function() {
    var userId = $(this).data('id');
    
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus pengguna ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('dashboard/user-dashboard/delete/') ?>' + userId, 
                type: 'POST',
                data: { id: userId }, 
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Deleted!', response.message, 'success');
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Terjadi kesalahan saat menghapus pengguna.', 'error');
                }
            });
        }
    });
});

// ajax add formnya
$(document).ready(function () {
    $("#formTambah").submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "<?= base_url('dashboard/users/addProses') ?>", 
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function () {
                Swal.fire({
                    title: "Memproses...",
                    text: "Mohon tunggu sebentar",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: response.message,
                    }).then(() => {
                        location.reload(); 
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: response.message || "Harap periksa form!",
                    });
                }
            },
            error: function (xhr, status, error) {
                Swal.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan!",
                    text: "Coba lagi nanti atau hubungi admin.",
                });
            },
        });
    });
});

// ajax update
$(document).ready(function () {
    $("#formEdit").submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "<?= base_url('dashboard/users/update') ?>", // Endpoint edit
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function () {
                Swal.fire({
                    title: "Memproses...",
                    text: "Mohon tunggu sebentar",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function (response) {
                if (response.status === "success") {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: response.message,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal!",
                        text: response.message || "Harap periksa form!",
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Terjadi Kesalahan!",
                    text: "Coba lagi nanti atau hubungi admin.",
                });
            }
        });
    });
});

// ajax untuk delete
$('.btn-delete').on('click', function() {
    var userId = $(this).data('id');
    var url = '<?= base_url('dashboard/users/delete/') ?>' + userId;
    console.log("Request URL: ", url);

    if (!userId) {
        console.error("User ID tidak valid.");
        return;
    }

    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus pengguna ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('dashboard/users/delete/') ?>' + userId, 
                type: 'POST',
                data: { id: userId },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire('Deleted!', response.message, 'success').then(() => {
                            location.reload();                         });
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: ", xhr.responseText);
                    Swal.fire('Error!', 'Terjadi kesalahan saat menghapus pengguna.', 'error');
                }
            });
        }
    });
});

</script>

<?= $this->endSection(); ?>