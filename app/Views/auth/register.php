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
        <form id="formregister" action="<?= base_url('/auth/attemptRegister'); ?>" method="post" enctype="multipart/form-data">
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
            <label for="Password" class="block text-gray-700 font-medium mb-2">Password</label>
            <input type="password" id="Password" name="Password" placeholder="Masukkan Password"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-4">
            <label for="Alamat" class="block text-gray-700 font-medium mb-2">Alamat</label>
            <input type="text" id="Alamat" name="Alamat" placeholder="Masukkan Alamat"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-4">
            <label for="No" class="block text-gray-700 font-medium mb-2">No Telepon</label>
            <input type="text" id="No" name="No" placeholder="Masukkan No Telepon"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-4">
            <label for="Pos" class="block text-gray-700 font-medium mb-2">Kode Pos</label>
            <input type="text" id="Pos" name="Pos" placeholder="Masukkan Kode Pos"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="mb-4">
            <label for="ProfilGambar" class="block text-gray-700 font-medium mb-2">Profil Gambar</label>
            <input type="file" id="ProfilGambar" name="ProfilGambar" accept="image/png, image/jpeg"
              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" />
          </div>
          <div class="flex items-center justify-between">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
              Register
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>

</html>