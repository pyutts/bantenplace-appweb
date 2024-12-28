<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<?= $this->include('admin/product/addProducts'); ?>
<?= $this->include('admin/product/editProducts'); ?>

<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Daftar Users</h4>
            <button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"></i> Tambah Product
            </button>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="add-row" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Gambar Products</th>
                            <th>Nama Products</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products) && is_array($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td>
                                        <img class="img-thumbnail" style="width: 100px;" src="<?= base_url('uploads/products/' . $product['gambar_products']) ?>" alt="icon">
                                    </td>
                                    <td><?= esc($product['name_products']) ?></td>
                                    <td><?= esc($product['price']) ?></td>
                                    <td><?= esc($product['description']) ?></td>
                                    <td><?= esc($product['stock']) ?></td>
                                    <td>
                                        <button class="btn  btn-primary btn-sm" data-bs-toggle="modal" data-target="#modalEdit" onclick="formEdit(<?= htmlspecialchars(json_encode($product)) ?>)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-delete" data-id="<?= $product['id'] ?>">
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
                    switch (response.status) {
                        case "success":
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.message,
                                icon: "success",
                                confirmButtonText: "OK",
                            }).then(() => {
                                $('#modalEdit').modal('hide');
                                location.reload(); 
                            });
                            break;
                        case "error":
                            Swal.fire({
                                title: "Gagal!",
                                text: response.message || "Terjadi kesalahan.",
                                icon: "error",
                                confirmButtonText: "OK",
                            });
                            break;
                        default:
                            Swal.fire({
                                title: "Peringatan!",
                                text: "Status tidak dikenali.",
                                icon: "warning",
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

    // Form edit
    submitForm("#formEdit", "<?= base_url('dashboard/users/update') ?>");

    // Fungsi untuk menampilkan modal edit dan mengisi input dengan data sebelumnya
    window.formEdit = function(user) {
        const modal = $('#modalEdit');
        if (modal.length) {
            modal.find('input[name="id"]').val(user.id);
            modal.find('input[name="nama"]').val(user.nama);
            modal.find('input[name="username"]').val(user.username);
            modal.find('input[name="email"]').val(user.email);
            modal.find('input[name="no_telepon"]').val(user.no_telepon);
            modal.find('input[name="kode_pos"]').val(user.kode_pos);
            modal.find('textarea[name="alamat"]').val(user.alamat);
            modal.find('textarea[name="password"]').val(user.password);
            modal.find('textarea[name="level"]').val(user.level);
            
            // Preview gambar (jika ada field untuk gambar)
            if (user.profil_gambar) {
                modal.find('#previewProfilGambar').attr('src', '<?= base_url('uploads/profiles/') ?>' + user.profil_gambar);
            }
            
          modal.modal('show');
        } else {
            console.error("Modal edit tidak ditemukan!");
        }
    };

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
                            Swal.fire("Deleted!", response.message, "success").then(() => {
                                location.reload();
                            });
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
