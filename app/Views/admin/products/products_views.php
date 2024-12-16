<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<?= $this->include('admin/products/addProducts'); ?>
<?= $this->include('admin/products/editProducts'); ?>

<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Daftar Products</h4>
            <button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"></i> Tambah Products
            </button>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="add-row" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Gambar Produk</th>
                            <th>Nama Produk</th>
                            <th>Jenis Produk</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Kode Pos</th>
                            <th>Rules</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td>
                                        <img class="img-thumbnail" style="width: 100px;" src="<?= base_url('uploads/profiles/' . $user['profil_gambar']) ?>" alt="icon">
                                    </td>
                                    <td><?= esc($user['nama']) ?></td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td><?= esc($user['alamat']) ?></td>
                                    <td><?= esc($user['no_telepon']) ?></td>
                                    <td><?= esc($user['kode_pos']) ?></td>
                                    <td><?= esc($user['level']) ?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-target="#modalEdit" onclick="formEdit(<?= htmlspecialchars(json_encode($user)) ?>)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $user['id'] ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
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
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#add-row').DataTable({
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

        function submitForm(formId, url) {
            $(formId).submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            Swal.fire("Berhasil!", response.message, "success").then(() => location.reload());
                        } else {
                            Swal.fire("Gagal!", JSON.stringify(response.message), "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error!", "Terjadi kesalahan. Coba lagi nanti.", "error");
                    },
                });
            });
        }

        // memanggil fungsi form dari tambah
        submitForm("#formTambah", "<?= base_url('dashboard/users/save') ?>");

        window.formEdit = function(user) {
        const modal = $('#modalEdit');

        if (modal.length) {
            modal.find('input[name="id"]').val(user.id);
            modal.find('input[name="nama"]').val(user.nama);
            modal.find('input[name="username"]').val(user.username);
            modal.find('input[name="email"]').val(user.email);
            modal.find('input[name="telepon"]').val(user.no_telepon);
            modal.find('textarea[name="alamat"]').val(user.alamat);

            // Tampilkan modal
            modal.modal('show');
        } else {
            console.error("Modal edit tidak ditemukan!");
        }
    };

    function submitForm(formId, url) {
        $(formId).submit(function (e) {
            e.preventDefault(); 
            let formData = new FormData(this);

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success",
                            confirmButtonText: "OK",
                        }).then(() => {
                            $('#modalEdit').modal('hide'); 
                        });
                    } else {
                        Swal.fire({
                            title: "Gagal!",
                            text: response.message || "Terjadi kesalahan.",
                            icon: "error",
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: "Error!",
                        text: "Terjadi kesalahan saat memproses permintaan. Coba lagi nanti.",
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                },
            });
        });
    }
     // memanggil fungsi form dari tambah
    submitForm("#formEdit", "<?= base_url('dashboard/users/update') ?>");
        $(".btn-delete").on("click", function () {
            const userId = $(this).data("id");
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
                        url: "<?= base_url('dashboard/users/delete/') ?>" + userId,
                        type: "DELETE",
                        dataType: "json",
                        success: function (response) {
                            if (response.status === "success") {
                                Swal.fire("Deleted!", response.message, "success").then(() => location.reload());
                            } else {
                                Swal.fire("Error!", response.message, "error");
                            }
                        },
                        error: function () {
                            Swal.fire("Error!", "Terjadi kesalahan. Coba lagi nanti.", "error");
                        },
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>
