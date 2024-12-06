<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Bantenplace</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-200 bg-[url('<?= base_url('auth'); ?>/img/polabatik.svg')] bg-repeat">
  <section class="w-full max-w-4xl">
    <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
      <div class="hidden lg:flex lg:w-1/2 bg-gray-100 justify-center items-center">
        <img src="<?= base_url('auth'); ?>/img/loginicon.png" alt="Login Icon" class="w-3/4 object-contain" />
      </div>
      <div class="w-full lg:w-1/2 p-8">
        <h5 class="text-2xl font-bold text-gray-700 mb-6">
          Selamat Datang di Halaman Login 
          <font color="green"><b>Bantenplace</b></font>
        </h5>
        <form id="formlogin" action="<?= base_url('auth/attemptLogin'); ?>" method="post">
          <?= csrf_field(); ?>
          <div class="mb-4">
            <label for="Email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="Email" name="email" placeholder="Masukkan Email"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-6">
            <label for="Password" class="block text-gray-700 font-medium mb-2">Password</label>
            <input type="password" id="Password" name="password" placeholder="Masukkan Password"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-6">
            <button type="button" onclick="LoginProses()"
              class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 transition">
              LOGIN
            </button>
          </div>
          <p class="text-gray-600 text-center">
            Anda belum memiliki akun?
            <a href="<?= base_url('/register'); ?>" class="text-black-500 hover:underline font-medium">Register</a>
          </p>
        </form>
      </div>
    </div>
  </section>

  <!-- SweetAlertnya ya -->
  <script>
    function LoginProses() {
      const email = document.getElementById('Email').value.trim();
      const password = document.getElementById('Password').value.trim();

      if (!email) {
        Swal.fire('Error', 'Email masih kosong', 'error');
        return;
      }

      if (!password) {
        Swal.fire('Error', 'Password masih kosong', 'error');
        return;
      }

      if (password.length < 6) {
        Swal.fire('Error', 'Password minimal 6 karakter', 'error');
        return;
      }

      Swal.fire({
        title: 'Konfirmasi Login',
        text: 'Apakah Anda yakin ingin melanjutkan?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Login',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById('formlogin').submit();
        }
      });
    }

    <?php if (session()->getFlashdata('success')) : ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('success'); ?>',
        });
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session()->getFlashdata('error'); ?>',
        });
    <?php endif; ?>
  </script>
</body>

</html>
