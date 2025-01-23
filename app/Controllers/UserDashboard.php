<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UserDashboard extends BaseController
{
    protected $users;

    public function __construct()
    {
        $this->users = new UsersModel();
    }

    public function index()
    {
        $users = $this->users->findAll();
        return view('admin/users/user_views', ['users' => $users]);
    }

    public function addProses()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama'          => 'required',
            'username'      => 'required|is_unique[users.username]',
            'email'         => 'required|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[6]',
            'level'         => 'required',
            'profil_gambar' => [
                'rules'  => 'uploaded[profil_gambar]|is_image[profil_gambar]|mime_in[profil_gambar,image/png,image/jpeg]|max_size[profil_gambar,512]',
                'errors' => [
                    'uploaded' => 'Profil gambar wajib diunggah.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format file harus PNG atau JPEG.',
                    'max_size' => 'Ukuran gambar maksimal 512Kb.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $image = $this->request->getFile('profil_gambar');
        $imageName = '';

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $timestamp = date('YmdHis');
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('uploads/users', $imageName);
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
            'kode_pos'      => $this->request->getPost('kode_pos'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'alamat'        => $this->request->getPost('alamat'),
            'level'         => $this->request->getPost('level'),
            'profil_gambar' => $imageName,
        ];

        $this->users->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'User berhasil ditambahkan.',
        ]);
    }

    public function edit($profil_gambar)
    {
        $user = $this->users->where('profil_gambar', $profil_gambar)->first();

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

        return $this->response->setJSON(['status' => 'success', 'data' => $user]);
    }

    public function update()
    {
        $profil_gambar = $this->request->getPost('profil_gambar_old');
        $user = $this->users->where('profil_gambar', $profil_gambar)->first();

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'nama'          => 'required',
            'username'      => 'required|is_unique[users.username,id,' . $user['id'] . ']',
            'email'         => 'required|valid_email|is_unique[users.email,id,' . $user['id'] . ']',

        ];

        if ($this->request->getFile('profil_gambar')->isValid()) {
            $rules['profil_gambar'] = [
                'rules'  => 'is_image[profil_gambar]|mime_in[profil_gambar,image/png,image/jpeg]|max_size[profil_gambar,512]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format file harus PNG atau JPEG.',
                    'max_size' => 'Ukuran gambar maksimal 512Kb.',
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'no_telepon'    => $this->request->getPost('no_telepon'),
            'kode_pos'      => $this->request->getPost('kode_pos'),
            'alamat'        => $this->request->getPost('alamat'),
            'level'         => $this->request->getPost('level')
        ];

        $image = $this->request->getFile('profil_gambar');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            if ($user['profil_gambar'] && file_exists('uploads/users/' . $user['profil_gambar'])) {
                unlink('uploads/users/' . $user['profil_gambar']);
            }
            $timestamp = date('YmdHis');
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('uploads/users', $imageName);
            $data['profil_gambar'] = $imageName;
        }

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        $this->users->update($user['id'], $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil diperbarui.']);
    }

    public function delete($id)
    {
        $user = $this->users->find($id);

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User tidak ditemukan!'
            ]);
        }

        try {
            // Hapus file gambar profil jika ada
            if (!empty($user['profil_gambar'])) {
                $filePath = 'uploads/users/' . $user['profil_gambar'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Hapus data user
            $this->users->delete($id);

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'User berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Gagal menghapus user. Silakan coba lagi!'
            ]);
        }
    }
}