<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <form id="formEdit" action="<?= base_url('dashboard/users/update') ?>" method="post" enctype="multipart/form-data">
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="modalEditLabel">Edit User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-4">
                    <!-- Hidden ID -->
                    <input type="hidden" id="id" name="id">

                    <!-- Nama -->
                    <div class="form-group">
                        <label for="edit_nama">Nama</label>
                        <input type="text" class="form-control form-control-lg" id="edit_nama" name="nama" required>
                    </div>

                    <!-- Username -->
                    <div class="form-group">
                        <label for="edit_username">Username</label>
                        <input type="text" class="form-control form-control-lg" id="edit_username" name="username" required>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control form-control-lg" id="edit_email" name="email" required>
                    </div>

                    <!-- Telepon -->
                    <div class="form-group">
                        <label for="edit_telepon">Telepon</label>
                        <input type="number" class="form-control form-control-lg" id="edit_telepon" name="telepon">
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="edit_alamat">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3"></textarea>
                    </div>

                    <!-- Level -->
                    <div class="form-group">
                        <label for="edit_level">Level</label>
                        <select class="form-control form-control-lg" id="edit_level" name="level" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                            <!-- Tambahkan level lain jika diperlukan -->
                        </select>
                    </div>

                    <!-- Password (Optional) -->
                    <div class="form-group">
                        <label for="edit_password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" class="form-control form-control-lg" id="edit_password" name="password">
                    </div>

                    <!-- Foto Profil -->
                    <div class="form-group">
                        <label for="edit_profil_gambar">Foto Profil</label>
                        <input type="file" class="form-control-file" id="edit_profil_gambar" name="profil_gambar">
                        <small class="form-text text-muted">Ukuran maksimal 2MB, format jpg/png</small>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

