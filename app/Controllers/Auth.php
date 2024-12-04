<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        if (empty($email) || empty($password)) {
            return redirect()->back()->with('error', 'Email dan password wajib diisi.');
        }

        $user = $userModel->where('email', $email)->first();
        if ($user && password_verify($password, $user['password'])) {
            $this->setUserSession($user);
            return $this->redirectAfterLogin($user['level']);
        }

        return redirect()->back()->with('error', 'Email atau password salah.');
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
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'nama'     => $this->request->getPost('Nama'),
            'username' => $this->request->getPost('Username'),
            'email'    => $this->request->getPost('Email'),
            'password' => password_hash($this->request->getPost('Password'), PASSWORD_BCRYPT),
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    private function setUserSession($user)
    {
        session()->set([
            'id'        => $user['id'],
            'username'  => $user['username'],
            'email'     => $user['email'],
            'level'     => $user['level'],
            'logged_in' => true,
        ]);
    }

    private function redirectAfterLogin($level)
    {
        if ($level === 'Admin') {
            return redirect()->to('/dashboard');
        }
        if ($level === 'User') {
            return redirect()->to('/user');
        }
        return redirect()->to('/login')->with('error', 'Level pengguna tidak dikenali.');
    }
}
