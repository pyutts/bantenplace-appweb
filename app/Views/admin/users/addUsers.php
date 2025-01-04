<!-- filepath: /c:/laragon/www/bantenplaceci4/app/Views/admin/users/addUsers.php -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content card">
            <form id="formAdd" action="<?= base_url('dashboard/users/addProses') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold" id="modalTambahLabel">Tambah User</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
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
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePasswordVisibility()">
                                    <i id="togglePasswordIcon" class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-control" id="level" name="level" required>
                            <option value="">Pilih Level</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="profil_gambar">Profil Gambar</label>
                        <input type="file" class="form-control-file" id="profil_gambar" name="profil_gambar" onchange="previewImageAdd(event)">
                        <img id="previewProfilGambar" class="img-thumbnail" src="#" style="width: 100px; display: none;" alt="Preview Gambar">
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm">Tambah User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImageAdd(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.getElementById('previewProfilGambar');
        output.src = reader.result;
        output.style.display = 'block';
    }
    reader.readAsDataURL(event.target.files[0]);
}

function togglePasswordVisibility() {
    var passwordField = document.getElementById('password');
    var passwordIcon = document.getElementById('togglePasswordIcon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
}
</script>