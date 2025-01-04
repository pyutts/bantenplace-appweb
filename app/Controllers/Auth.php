<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $userModel = new UsersModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
    
        if (empty($email) || empty($password)) {
            return redirect()->back()->withInput()->with('error', 'Email dan password wajib diisi.');
        }
    
        $user = $userModel->where('email', $email)->first();
        if ($user && password_verify($password, $user['password'])) {
            $this->setUserSession($user);
            return $this->redirectAfterLogin($user['level'])->with('success', 'Selamat datang, ' . $user['nama'] . '!');
        }
    
        return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
    }
    

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }

    public function register()
    {
        return view('auth/register');
    }

    
    public function attemptRegister()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'Nama'     => 'required',
            'Username' => 'required|is_unique[users.username]',
            'Email'    => 'required|valid_email|is_unique[users.email]',
            'Password' => 'required|min_length[6]',
            'ProfilGambar' => 'uploaded[ProfilGambar]|is_image[ProfilGambar]|mime_in[ProfilGambar,image/jpg,image/jpeg,image/png]|max_size[ProfilGambar,2048]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $profilGambar = $this->request->getFile('ProfilGambar');
        $profilGambarName = $profilGambar->getRandomName();
        $profilGambar->move('public/uploads', $profilGambarName);

        $userModel = new UsersModel();
        $userModel->save([
            'nama'      => $this->request->getPost('Nama'),
            'username'  => $this->request->getPost('Username'),
            'email'     => $this->request->getPost('Email'),
            'alamat'    => $this->request->getPost('Alamat'),
            'no_telepon' => $this->request->getPost('No'),
            'kode_pos'   => $this->request->getPost('Pos'),
            'password'  => password_hash($this->request->getPost('Password'), PASSWORD_BCRYPT),
            'profil_gambar' => $profilGambarName,
            'level'    => 'User', 
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    private function setUserSession($user)
    {
        session()->set([
            'id'            => $user['id'],
            'username'      => $user['username'],
            'email'         => $user['email'],
            'level'         => $user['level'],
            'profil_gambar' => $user['profil_gambar'],
            'logged_in'     => true,
            'logged_out'    => true,
        ]);
    }

    private function redirectAfterLogin($level)
    {
        switch ($level) {
            case 'Admin':
                return redirect()->to('/dashboard');
            case 'User':
                return redirect()->to('/home/user');
            default:
                return redirect()->to('/login')->with('error', 'Level pengguna tidak dikenali.');
        }
    }
}
