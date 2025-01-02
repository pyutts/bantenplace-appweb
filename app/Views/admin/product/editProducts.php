<!-- Modal untuk Mengedit Produk -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <form id="formEdit" action="<?= base_url('dashboard/products/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Produk</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <!-- Hidden input for ID -->
                    <input type="hidden" name="id" id="product_id">

                    <!-- Kode Produk (Tidak bisa diubah, hanya tampil) -->
                    <div class="form-group">
                        <label for="kode_products">Kode Produk</label>
                        <input type="text" class="form-control form-control-lg" id="kode_products" name="kode_products" readonly required>
                    </div>

                    <!-- Nama Produk -->
                    <div class="form-group">
                        <label for="name_products">Nama Produk</label>
                        <input type="text" class="form-control form-control-lg" id="name_products" name="name_products" required>
                    </div>

                    <!-- Harga Produk -->
                    <div class="form-group">
                        <label for="price">Harga</label>
                        <input type="number" class="form-control form-control-lg" id="price" name="price" required>
                    </div>

                    <!-- Deskripsi Produk -->
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <!-- Stok Produk -->
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" class="form-control form-control-lg" id="stock" name="stock" required>
                    </div>

                    <!-- Gambar Produk -->
                    <div class="form-group">
                        <label for="gambar_products">Gambar Produk</label>
                        <input type="file" class="form-control-file" id="gambar_products" name="gambar_products">
                        <small class="form-text text-muted">Jika ingin mengganti gambar, silakan pilih gambar baru.</small>
                    </div>

                    <!-- Preview Gambar -->
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
