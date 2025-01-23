<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <form id="formEdit" action="<?= base_url('dashboard/products/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header text-black">
                    <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Produk</h5>
                    <button type="button" class="close text-black" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="product_id">
                    <div class="form-group">
                        <label for="kode_products">Kode Produk</label>
                        <input type="text" class="form-control form-control-lg" id="kode_products" name="kode_products" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="name_products">Nama Produk</label>
                        <input type="text" class="form-control form-control-lg" id="name_products" name="name_products" required>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control form-control-lg" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control form-control-lg" id="stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Kategori</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="gambar_products">Gambar Produk</label>
                        <input type="file" class="form-control-file" id="gambar_products" name="gambar_products" onchange="previewImageEdit(event)">
                        <small class="form-text text-muted">Jika ingin mengganti gambar, silakan pilih gambar baru.</small>
                    </div>
                    <div class="form-group">
                        <label>Preview Gambar</label>
                        <br>
                        <img id="previewGambar" class="img-thumbnail" src="" style="width: 100px;" alt="Preview Gambar">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImageEdit(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('previewGambar');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>