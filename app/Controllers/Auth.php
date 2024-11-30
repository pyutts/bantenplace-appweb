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
        $session = session();
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->setUserSession($user);
                return $this->redirectAfterLogin($user['level']);
            }

            if ($user['password'] === md5($password)) {
                $newHash = password_hash($password, PASSWORD_BCRYPT);
                $userModel->update($user['id'], ['password' => $newHash]);

                $this->setUserSession($user);
                return $this->redirectAfterLogin($user['level']);
            }
        }

        return redirect()->back()->with('error', 'Email atau password salah.');
    }

    private function setUserSession($user)
    {
        session()->set([
            'id'        => $user['id'],
            'email'     => $user['email'],
            'username'  => $user['username'],
            'level'     => $user['level'],
            'logged_in' => true,
        ]);
    }

    private function redirectAfterLogin($level)
    {
        if ($level === 'Admin') {
            return redirect()->to('/dashboard');
        } elseif ($level === 'User') {
            return redirect()->to('/user');
        }
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
            'Alamat'   => 'required',
            'No'       => 'required|numeric',
            'Pos'      => 'required|numeric',
            'Password' => 'required|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $data = [
            'nama'        => $this->request->getPost('Nama'),
            'username'    => $this->request->getPost('Username'),
            'email'       => $this->request->getPost('Email'),
            'alamat'      => $this->request->getPost('Alamat'),
            'no_telepon'  => $this->request->getPost('No'),
            'kode_pos'    => $this->request->getPost('Pos'),
            'password'    => password_hash($this->request->getPost('Password'), PASSWORD_BCRYPT), 
        ];

        $userModel = new UserModel();
        if ($userModel->insert($data)) {
            return redirect()->to('/login')->with('success', 'Registrasi berhasil. Silakan login.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
