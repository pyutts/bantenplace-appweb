<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <form id="formEdit" action="<?= base_url('dashboard/orders/update') ?>" method="post">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title fw-bold" id="modalEditLabel">Edit Order</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="order_id">
                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Dibayar">Dibayar</option>
                            <option value="Dikirim">Dikirim</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_ekspedisi_id">Ekspedisi</label>
                        <select class="form-control" id="edit_ekspedisi_id" name="ekspedisi_id" required>
                            <?php foreach ($ekspedisi as $exp): ?>
                                <option value="<?= $exp['id'] ?>"><?= $exp['nama_ekspedisi'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update Order</button>
                </div>
            </form>
        </div>
    </div>
</div>