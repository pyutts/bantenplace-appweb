<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Daftar - Bantenplace</title>
  <!-- Icon -->
  <link rel="icon" href="<?= base_url('auth');?>/img/logogreen.png" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- Custom MDB CSS -->
  <link rel="stylesheet" href="<?= base_url('auth');?>/css/bootstrap-login-form.min.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <style>
    .form-control {
      padding: 15px;
      font-size: 16px;
    }

    .form-control::placeholder {
      font-size: 14px;
      color: #6c757d;
    }

    .btn {
      padding: 12px;
      font-size: 16px;
    }

    .card {
      max-width: 700px; /* Perlebar card */
      margin: auto; /* Pusatkan card */
    }
  </style>
</head>
  <body>
      <section class="vh-100" style="background-color: #dcdcdc;">
          <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-md-10 col-lg-8">
                <div class="card shadow" style="border-radius: 1rem;">
                  <div class="card-body p-5">
                    <h4 class="text-center fw-bold mb-4">Selamat Datang di Halaman Register <b>Bantenplace</b></h4>
                    <?php if (session()->getFlashdata('error')) : ?>
                      <div class="alert alert-danger">
                          <?= session()->getFlashdata('error'); ?>
                      </div>
                     <?php endif; ?>
                     <form action="/auth/attemptRegister" id="#formregister" method="post">
                     <?= csrf_field(); ?>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Nama</label>
                          <input type="text" class="form-control" name="Nama" id="Nama" placeholder="Masukkan Nama" />
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Username</label>
                          <input type="text" class="form-control" name="Username" id="Username" placeholder="Masukkan Username" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Email</label>
                          <input type="email" class="form-control" name="Email" id="Email" placeholder="Masukkan Email" />
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Alamat</label>
                          <textarea class="form-control" rows="1" name="Alamat" id="Alamat" placeholder="Masukkan Alamat"></textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label class="form-label">No Telepon</label>
                          <input type="number" class="form-control" name="No" id="No" placeholder="Masukkan No Telepon" />
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Kode Pos</label>
                          <input type="number" class="form-control" name="Pos" id="Pos" placeholder="Masukkan Kode Pos" />
                        </div>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="Password" id="Password" placeholder="Masukkan Password" />
                      </div>
                      <button class="btn btn-dark w-100 mb-3" type="submit" onclick="RegisterProses()">Register</button>
                      <p class="text-center">Sudah memiliki akun? <a href="<?= base_url('/login'); ?>" class="text-decoration-none"><b>Login</b></a></p>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </section>
  </body>
    <script>
    function RegisterProses() {
      var Nama = $('#Nama').val();
      if (Nama.trim() === "") {
        alert("Nama masih kosong");
        $('#Nama').focus();
        return false;
      }

      var Username = $('#Username').val();
      if (Username.trim() === "") {
        alert("Username masih kosong");
        $('#Username').focus();
        return false;
      }

      var Email = $('#Email').val();
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (Email.trim() === "") {
        alert("Email masih kosong");
        $('#Email').focus();
        return false;
      } else if (!emailRegex.test(Email)) {
        alert("Format email tidak valid");
        $('#Email').focus();
        return false;
      }

      var Alamat = $('#Alamat').val();
      if (Alamat.trim() === "") {
        alert("Alamat masih kosong");
        $('#Alamat').focus();
        return false;
      }

      var No = $('#No').val();
      var phoneRegex = /^[0-9]+$/; 
      if (No.trim() === "") {
        alert("No Telepon masih kosong");
        $('#No').focus();
        return false;
      } else if (!phoneRegex.test(No)) {
        alert("Nomor Telepon hanya boleh berisi angka");
        $('#No').focus();
        return false;
      }

      var Pos = $('#Pos').val();
      if (Pos.trim() === "") {
        alert("Kode Pos masih kosong");
        $('#Pos').focus();
        return false;
      }

      var Password = $('#Password').val();
      if (Password.trim() === "") {
        alert("Password masih kosong");
        $('#Password').focus();
        return false;
      } else if (Password.length < 6) {
        alert("Password minimal 6 karakter");
        $('#Password').focus();
        return false;
      }

      $('#formregister').submit();
    }
  </script>


</html>
 