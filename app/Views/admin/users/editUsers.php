<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <form id="formEdit" action="<?= base_url('dashboard/users/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="modalEditLabel">Edit User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="edit_nama">Nama</label>
                        <input type="text" class="form-control form-control-lg" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_username">Username</label>
                        <input type="text" class="form-control form-control-lg" id="edit_username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control form-control-lg" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_telepon">Telepon</label>
                        <input type="number" class="form-control form-control-lg" id="edit_telepon" name="no_telepon">
                    </div>
                    <div class="form-group">
                        <label for="edit_alamat">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
