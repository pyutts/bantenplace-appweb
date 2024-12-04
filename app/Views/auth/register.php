<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Bantenplace</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-200 bg-[url('<?= base_url('auth'); ?>/img/polabatik.svg')] bg-repeat">
  <section class="w-full max-w-4xl">
    <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
      <!-- Gambar -->
      <div class="hidden lg:flex lg:w-1/2 bg-gray-100 justify-center items-center">
        <img src="<?= base_url('auth'); ?>/img/loginicon.png" alt="Register Icon"
          class="w-3/4 object-contain" />
      </div>
      <!-- Form -->
      <div class="w-full lg:w-1/2 p-8">
        <h5 class="text-2xl font-bold text-gray-700 mb-6">Selamat Datang di Halaman Register 
          <font color="green"><b>Bantenplace</font></b>
        </h5>
        <?php if (session()->getFlashdata('error')) : ?>
        <div class="mb-4 bg-red-100 text-red-700 p-3 rounded-md">
        <?= session()->getFlashdata('error'); ?>
        </div>
        <?php endif; ?>
        <form action="/auth/attemptRegister" id="formregister" method="post">
          <?= csrf_field(); ?>
          <!-- Nama -->
          <div class="mb-4">
            <label for="Nama" class="block text-gray-700 font-medium mb-2">Nama</label>
            <input type="text" id="Nama" name="Nama" placeholder="Masukkan Nama"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <!-- Username -->
          <div class="mb-4">
            <label for="Username" class="block text-gray-700 font-medium mb-2">Username</label>
            <input type="text" id="Username" name="Username" placeholder="Masukkan Username"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <!-- Email -->
          <div class="mb-4">
            <label for="Email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="Email" name="Email" placeholder="Masukkan Email"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <!-- Alamat -->
          <div class="mb-4">
            <label for="Alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
            <textarea id="Alamat" name="Alamat" placeholder="Masukkan Alamat" rows="2"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
          </div>
          <!-- No Telepon -->
          <div class="mb-4">
            <label for="No" class="block text-gray-700 font-medium mb-2">No Telepon</label>
            <input type="number" id="No" name="No" placeholder="Masukkan No Telepon"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <!-- Kode Pos -->
          <div class="mb-4">
            <label for="Pos" class="block text-gray-700 font-medium mb-2">Kode Pos</label>
            <input type="number" id="Pos" name="Pos" placeholder="Masukkan Kode Pos"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <!-- Password -->
          <div class="mb-6">
            <label for="Password" class="block text-gray-700 font-medium mb-2">Password</label>
            <input type="password" id="Password" name="Password" placeholder="Masukkan Password"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <!-- Tombol Register -->
          <button type="submit" onclick="RegisterProses()"
            class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 transition">
            REGISTER
          </button>
          <!-- Link Login -->
          <p class="text-gray-600 text-center mt-4">
            Sudah memiliki akun?
            <a href="<?= base_url('/login'); ?>" class="text-black-500 hover:underline font-medium">Login</a>
          </p>
        </form>
      </div>
    </div>
  </section>

  <script>
    function RegisterProses() {
      const Nama = document.getElementById('Nama').value.trim();
      const Username = document.getElementById('Username').value.trim();
      const Email = document.getElementById('Email').value.trim();
      const Alamat = document.getElementById('Alamat').value.trim();
      const No = document.getElementById('No').value.trim();
      const Pos = document.getElementById('Pos').value.trim();
      const Password = document.getElementById('Password').value.trim();

      if (!Nama) {
        alert("Nama masih kosong");
        document.getElementById('Nama').focus();
        return false;
      }
      if (!Username) {
        alert("Username masih kosong");
        document.getElementById('Username').focus();
        return false;
      }
      if (!Email) {
        alert("Email masih kosong");
        document.getElementById('Email').focus();
        return false;
      }
      if (!Alamat) {
        alert("Alamat masih kosong");
        document.getElementById('Alamat').focus();
        return false;
      }
      if (!No) {
        alert("No Telepon masih kosong");
        document.getElementById('No').focus();
        return false;
      }
      if (!Pos) {
        alert("Kode Pos masih kosong");
        document.getElementById('Pos').focus();
        return false;
      }
      if (!Password || Password.length < 6) {
        alert("Password minimal 6 karakter");
        document.getElementById('Password').focus();
        return false;
      }

      document.getElementById('formregister').submit();
    }
  </script>
</body>

</html>
