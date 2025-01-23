<?= $this->extend('admin/template/main_template'); ?>
<?= $this->section('content'); ?>

<?= $this->include('admin/product/addProducts', ['categories' => $categories]); ?>
<?= $this->include('admin/product/editProducts', ['categories' => $categories]); ?>
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
                <table id="productsTable" class="table table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Kode Produk</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Stock</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
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
                                    <td>Rp. <?= esc(number_format($product['price'], 0, ',', '.')) ?></td>
                                    <td><?= esc($product['description']) ?></td>
                                    <td><?= esc($product['stock']) ?></td>
                                    <td><?= esc($product['category_name']) ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEdit" onclick="editProduct(<?= $product['id'] ?>)">Edit</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?= $product['id'] ?>)">Delete</button>
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
$(document).ready(function() {
    $('#productsTable').DataTable({
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

function editProduct(id) {
    $.ajax({
        url: '<?= base_url('dashboard/products/edit') ?>/' + id,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#product_id').val(response.data.id);
                $('#kode_products').val(response.data.kode_products);
                $('#name_products').val(response.data.name_products);
                $('#price').val(response.data.price);
                $('#description').val(response.data.description);
                $('#stock').val(response.data.stock);
                $('#category_id').val(response.data.category_id);
                $('#previewGambar').attr('src', '<?= base_url('uploads/products') ?>/' + response.data.gambar_products);
                $('#modalEdit').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        }
    });
}

function deleteProduct(id) {
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
                url: '<?= base_url('dashboard/products/delete') ?>/' + id,
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