<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login - Bantenplace</title>
  <!-- MDB icon -->
  <link rel="icon" href="<?= base_url('auth');?>/img/logogreen.png" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="<?= base_url('auth');?>/css/bootstrap-login-form.min.css" />
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
  <!-- Start your project here-->
  <section class="vh-100" style="background-color: #dcdcdc">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img
                  src="<?= base_url('auth');?>/img/loginicon.png"
                  alt="login form"
                  class="img-fluid mx-auto d-block" style="border-radius: 1rem 0 0 1rem;"
                />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form action="/auth/attemptLogin" id="#formlogin" method="post">
                <?= csrf_field(); ?>
  
                    <div class="d-flex align-items-center mb-4 pb-1">
                      <!-- masukkan -->
                    </div>
  
                    <h5 class="fw-normal mb-4 pb-3" style="letter-spacing: 1px;">Selamat Datang di Halaman Login <b>Bantenplace</b></h5>
  
                    <div class="mb-4">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control form-control-lg" name="email" id="Email" placeholder="Masukkan Email" />
                    </div>
  
                    <div class="mb-4">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control form-control-lg" name="password" id="Password" placeholder="Masukkan Passowrd" />
                    </div>
  
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit" onclick="LoginProses()">Login</button>
                    </div>
  
                    
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Anda belum memiliki akun? <a href="<?= base_url('/register'); ?>" style="color: #393f81;"><b>Register</b></a></p>
                  </form>
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

<script>
    function LoginProses() 
    {
      var Email = $('#Email').val();
      if (Email.trim() === "") {
        alert("Email masih kosong");
        $('#Email').focus();
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

      $('#formlogin').submit();
    }
  </script>

</html>