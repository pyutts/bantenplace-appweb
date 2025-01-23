<?= $this->extend('homepages/templates/main_template'); ?>

<?= $this->section('content'); ?>
<div class="container py-5">
  <h1 class="text-center text-green display-6">Profil Saya</h1>
</div>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <!-- Profile Card - Left Side -->
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <img src="<?= base_url('uploads/users/' . ($userData['profile_image'] ?? 'default.jpg')); ?>" 
                             class="rounded-circle img-thumbnail mb-3" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <h4><?= esc($userData['nama']); ?></h4>
                        <p class="text-muted mb-2">User</p>
                        
                        <div class="text-start mt-4">
                            <p class="mb-2"><strong>Nama:</strong><br><?= esc($userData['nama']); ?></p>
                            <p class="mb-2"><strong>Email:</strong><br><?= esc($userData['email']); ?></p>
                            <?php if (!empty($userData['no_telepon'])): ?>
                                <p class="mb-2"><strong>No. Telepon:</strong><br><?= esc($userData['no_telepon']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($userData['alamat'])): ?>
                                <p class="mb-2"><strong>Alamat:</strong><br><?= esc($userData['alamat']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form - Right Side -->
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Edit Profil</h5>
                        <form id="profile-form" method="post" action="<?= base_url('myaccounts/update'); ?>" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label for="profile_image" class="form-label">Foto Profil</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image" 
                                       accept="image/jpeg,image/png,image/jpg">
                                <small class="text-muted">Format: JPG, JPEG, PNG (Max. 2MB)</small>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" 
                                           value="<?= esc($userData['nama']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           value="<?= esc($userData['username']); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?= esc($userData['email']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_telepon" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="no_telepon" name="no_telepon" 
                                           value="<?= esc($userData['no_telepon'] ?? ''); ?>" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="kode_pos" class="form-label">Kode Pos</label>
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" 
                                           value="<?= esc($userData['kode_pos'] ?? ''); ?>" required>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="alamat" name="alamat" 
                                          rows="3" required><?= esc($userData['alamat'] ?? ''); ?></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 15px;
    margin-bottom: 20px;
}
.card-body {
    padding: 2rem;
}
.form-label {
    font-weight: 500;
    color: #555;
}
.form-control {
    border-radius: 8px;
    padding: 0.6rem 1rem;
    border: 1px solid #ddd;
}
.form-control:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
}
.btn-primary {
    background-color: #4CAF50;
    border: none;
    padding: 0.8rem;
    font-weight: 500;
    border-radius: 8px;
}
.btn-primary:hover {
    background-color: #45a049;
}
.img-thumbnail {
    padding: 0.25rem;
    border: 2px solid #4CAF50;
}
</style>

<script>
$(document).ready(function() {
    $('#profile-form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Profil berhasil diperbarui',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    // Membuat pesan error yang lebih detail
                    let errorMessage = 'Validasi gagal:\n';
                    if (response.errors) {
                        Object.keys(response.errors).forEach(function(key) {
                            errorMessage += `• ${response.errors[key]}\n`;
                        });
                    } else {
                        errorMessage = response.message || 'Gagal memperbarui profil';
                    }

                    Swal.fire({
                        title: 'Error!',
                        html: errorMessage.replace(/\n/g, '<br>'),
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan pada server',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
</script>
<?= $this->endSection(); ?>