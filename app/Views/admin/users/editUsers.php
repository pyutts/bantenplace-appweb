<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <form id="formEdit" action="<?= base_url('dashboard/users/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="modalEditLabel">Edit User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control form-control-lg" id="nama" name="nama" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-lg" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <input type="number" class="form-control form-control-lg" id="no_telepon" name="no_telepon">
                    </div>
                    <div class="form-group">
                        <label for="kodepos">Kode Pos</label>
                        <input type="number" class="form-control form-control-lg" id="kode_pos" name="kode_pos">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control form-control-lg" id="level" name="level" required>
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profil_gambar">Foto Profil</label>
                        <input type="file" class="form-control-file" id="profil_gambar" name="profil_gambar">
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
