<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <div class="modal-header text-black">
                <h5 class="modal-title fw-bold" id="modalEditLabel">Edit User</h5>
                <button type="button" class="close text-black" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formEdit" action="<?= base_url('dashboard/users/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <input type="hidden" name="profil_gambar_old" id="profil_gambar_old">
                    <div class="form-group">
                        <label for="edit_nama">Nama</label>
                        <input type="text" class="form-control form-control-lg" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-lg" id="edit_username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-lg" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon">Nomor Telepon</label>
                        <input type="number" class="form-control form-control-lg" id="edit_no_telepon" name="no_telepon">
                    </div>
                    <div class="form-group">
                        <label for="kode_pos">Kode Pos</label>
                        <input type="number" class="form-control form-control-lg" id="edit_kode_pos" name="kode_pos">
                    </div>
                    <div class="form-group">  
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" id="edit_level" name="level" required>
                            <option value="">Pilih Level</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_profil_gambar">Profil Gambar</label>
                        <input type="file" class="form-control-file" id="edit_profil_gambar" name="profil_gambar" onchange="previewImage(this, 'previewProfilGambarEdit')">
                        <img id="previewProfilGambarEdit" class="img-thumbnail mt-2" style="width: 100px; display: none;" alt="Preview Gambar">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#' + previewId).attr('src', e.target.result).show();
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>