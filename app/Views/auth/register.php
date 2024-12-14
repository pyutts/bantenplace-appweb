<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Bantenplace</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" href="<?= base_url('admin');?>/img/icon.jpg" type="image/x-icon"/>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-200 bg-[url('<?= base_url('auth'); ?>/img/polabatik.svg')] bg-repeat">
  <section class="w-full max-w-4xl">
    <div class="flex bg-white shadow-md rounded-lg overflow-hidden">
      <!-- Gambar -->
      <div class="hidden lg:flex lg:w-1/2 bg-gray-100 justify-center items-center">
        <img src="<?= base_url('auth'); ?>/img/loginicon.png" alt="Register Icon" class="w-3/4 object-contain" />
      </div>
      <!-- Form -->
      <div class="w-full lg:w-1/2 p-8">
        <h5 class="text-2xl font-bold text-gray-700 mb-6">
          Selamat Datang di Halaman Register 
          <font color="green"><b>Bantenplace</b></font>
        </h5>
        <form id="formregister" action="/auth/attemptRegister" method="post">
          <?= csrf_field(); ?>
          <div class="mb-4">
            <label for="Nama" class="block text-gray-700 font-medium mb-2">Nama</label>
            <input type="text" id="Nama" name="Nama" placeholder="Masukkan Nama"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-4">
            <label for="Username" class="block text-gray-700 font-medium mb-2">Username</label>
            <input type="text" id="Username" name="Username" placeholder="Masukkan Username"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-4">
            <label for="Email" class="block text-gray-700 font-medium mb-2">Email</label>
            <input type="email" id="Email" name="Email" placeholder="Masukkan Email"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-4">
            <label for="Alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
            <textarea id="Alamat" name="Alamat" placeholder="Masukkan Alamat" rows="2"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"></textarea>
          </div>
          <div class="mb-4">
            <label for="No" class="block text-gray-700 font-medium mb-2">No Telepon</label>
            <input type="number" id="No" name="No" placeholder="Masukkan No Telepon"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-4">
            <label for="Pos" class="block text-gray-700 font-medium mb-2">Kode Pos</label>
            <input type="number" id="Pos" name="Pos" placeholder="Masukkan Kode Pos"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-6">
            <label for="Password" class="block text-gray-700 font-medium mb-2">Password</label>
            <input type="password" id="Password" name="Password" placeholder="Masukkan Password"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <button type="button" onclick="RegisterProses()"
            class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 transition">
            REGISTER
          </button>
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
        Swal.fire('Error', 'Nama masih kosong', 'error');
        return false;
      }
      if (!Username) {
        Swal.fire('Error', 'Username masih kosong', 'error');
        return false;
      }
      if (!Email) {
        Swal.fire('Error', 'Email masih kosong', 'error');
        return false;
      }
      if (!Alamat) {
        Swal.fire('Error', 'Alamat masih kosong', 'error');
        return false;
      }
      if (!No) {
        Swal.fire('Error', 'No Telepon masih kosong', 'error');
        return false;
      }
      if (!Pos) {
        Swal.fire('Error', 'Kode Pos masih kosong', 'error');
        return false;
      }
      if (!Password || Password.length < 6) {
        Swal.fire('Error', 'Password minimal 6 karakter', 'error');
        return false;
      }
      document.getElementById('formregister').submit();
    }
  </script>
</body>

</html>
