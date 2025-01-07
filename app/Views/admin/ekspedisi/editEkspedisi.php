<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <form id="formEdit" action="<?= base_url('dashboard/ekspedisi/update') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Ekspedisi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="ekspedisi_id">
                    <div class="form-group">
                        <label for="edit_nama_ekspedisi">Nama Ekspedisi</label>
                        <input type="text" class="form-control form-control-lg" id="edit_nama_ekspedisi" name="nama_ekspedisi" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_harga_ongkir">Harga Ongkir</label>
                        <input type="number" class="form-control form-control-lg" id="edit_harga_ongkir" name="harga_ongkir" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_satuan">Satuan</label>
                        <input type="text" class="form-control form-control-lg" id="edit_satuan" name="satuan" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update Ekspedisi</button>
                </div>
            </form>
        </div>
    </div>
</div>