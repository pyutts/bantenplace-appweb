<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<?= $this->include('admin/product/addProducts'); ?>
<?= $this->include('admin/product/editProducts'); ?>
<div class="col-md-12 py-5">
    <div class="card">
        <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Daftar Produk</h4>
            <button class="btn btn-success btn-round ml-auto" data-toggle="modal" data-target="#modalTambah">
                <i class="fa fa-plus"></i> Tambah Produk
            </button>
        </div>
        <div class="card-body">
            <!-- Tabel Data -->
            <div class="table-responsive">
                <table id="productsAdd" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
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
                                    <td><?= esc($product['kode_products']) ?></td>
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
                                <td colspan="8" class="text-center">Tidak ada data produk</td>
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
    $('#productsAdd').DataTable({
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

    // Form handling
    $("#formAdd").on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        
        // Debug
        console.log("Submitting form...");
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            url: "<?= base_url('dashboard/products/saveData') ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            beforeSend: function() {
                // Tampilkan loading
                Swal.fire({
                    title: 'Loading...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                console.log("Response:", response);
                Swal.close();
                
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", {xhr, status, error});
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat memproses permintaan.',
                });
            }
        });
    });

    // Form Edit handling
    $("#formEdit").on('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        
        $.ajax({
            url: "<?= base_url('dashboard/products/update') ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: response.message,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: response.message,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat memproses permintaan.',
                });
            }
        });
    });

    // Preview image
    $('input[name="gambar_products"]').change(function() {
        const file = this.files[0];
        const reader = new FileReader();
        const preview = $(this).closest('form').find('img');
        
        reader.onload = function(e) {
            preview.attr('src', e.target.result).show();
        }
        
        if (file) {
            reader.readAsDataURL(file);
        }
    });

    // Fungsi untuk menampilkan modal edit dan mengisi input dengan data sebelumnya
    window.formEdit = function(product) {
        const modal = $('#modalEdit');
        if (modal.length) {
            modal.find('input[name="id"]').val(product.id);
            modal.find('input[name="name_products"]').val(product.name_products);
            modal.find('input[name="price"]').val(product.price);
            modal.find('textarea[name="description"]').val(product.description);
            modal.find('input[name="stock"]').val(product.stock);
            modal.find('input[name="rating"]').val(product.rating);
            
            if (product.gambar_products) {
                modal.find('#previewProdukGambar').attr('src', '<?= base_url('uploads/products/') ?>' + product.gambar_products);
            }
            
          modal.modal('show');
        } else {
            console.error("Modal edit tidak ditemukan!");
        }
    };

    $(".btn-delete").on("click", function () {
        const productId = $(this).data("id");
        Swal.fire({
            title: "Konfirmasi Hapus",
            text: "Apakah Anda yakin ingin menghapus produk ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('dashboard/products/delete/') ?>" + productId,
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
