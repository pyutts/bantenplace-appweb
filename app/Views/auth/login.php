<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Bantenplace</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-200 bg-[url('<?= base_url('auth'); ?>/img/polabatik.svg')] bg-repeat">
  <section class="w-full max-w-4xl">
    <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
      <!-- Gambar -->
      <div class="hidden lg:flex lg:w-1/2 bg-gray-100 justify-center items-center">
        <img src="<?= base_url('auth'); ?>/img/loginicon.png" alt="Login Icon"
          class="w-3/4 object-contain" />
      </div>
      <!-- Form -->
      <div class="w-full lg:w-1/2 p-8">
        <h5 class="text-2xl font-bold text-gray-700 mb-6">Selamat Datang di Halaman Login 
          <font color="green"><b>Bantenplace</font></b>
        </h5>
        <form action="<?= base_url('auth/attemptLogin'); ?>" id="formlogin" method="post">
          <?= csrf_field(); ?>
          <!-- Email -->
          <div class="mb-4">
            <label for="Email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="Email" name="email" placeholder="Masukkan Email"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <!-- Password -->
          <div class="mb-6">
            <label for="Password" class="block text-gray-700 font-medium mb-2">Password</label>
            <input type="password" id="Password" name="password" placeholder="Masukkan Password"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <!-- Tombol Login -->
          <div class="mb-6">
            <button type="submit" onclick="LoginProses()"
              class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 transition">
              LOGIN
            </button>
          </div>
          <!-- Link Register -->
          <p class="text-gray-600 text-center">
            Anda belum memiliki akun?
            <a href="<?= base_url('/register'); ?>" class="text-black-500 hover:underline font-medium">Register</a>
          </p>
        </form>
      </div>
    </div>
  </section>

  <script>
    function LoginProses() {
      const email = document.getElementById('Email').value.trim();
      const password = document.getElementById('Password').value.trim();

      if (email === "") {
        alert("Email masih kosong");
        document.getElementById('Email').focus();
        return false;
      }

      if (password === "") {
        alert("Password masih kosong");
        document.getElementById('Password').focus();
        return false;
      } else if (password.length < 6) {
        alert("Password minimal 6 karakter");
        document.getElementById('Password').focus();
        return false;
      }

      document.getElementById('formlogin').submit();
    }
  </script>
</body>

</html>
