<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Ekspedisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formAdd" action="<?= base_url('dashboard/ekspedisi/saveData') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Ekspedisi</label>
                        <input type="text" class="form-control" name="nama_ekspedisi" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Ongkir</label>
                        <input type="number" class="form-control" name="harga_ongkir" required>
                    </div>
                    <div class="form-group">
                        <label>Satuan</label>
                        <input type="text" class="form-control" name="satuan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>