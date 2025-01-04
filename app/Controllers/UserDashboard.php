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
            $image->move('public/uploads/users', $imageName);
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'level'         => $this->request->getPost('level'),
            'profil_gambar' => $imageName,
        ];

        $this->users->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'User berhasil ditambahkan.',
        ]);
    }

    public function edit($id)
    {
        $user = $this->users->find($id);

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

        return $this->response->setJSON(['status' => 'success', 'data' => $user]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $user = $this->users->find($id);

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'nama'          => 'required',
            'username'      => 'required|is_unique[users.username,id,{id}]',
            'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
            'level'         => 'required',
            'profil_gambar' => [
                'rules'  => 'is_image[profil_gambar]|mime_in[profil_gambar,image/png,image/jpeg]|max_size[profil_gambar,512]',
                'errors' => [
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
        $imageName = $user['profil_gambar'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($user['profil_gambar'] && file_exists('public/uploads/users/' . $user['profil_gambar'])) {
                unlink('public/uploads/users/' . $user['profil_gambar']);
            }

            $timestamp = date('YmdHis');
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('public/uploads/users', $imageName);
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'level'         => $this->request->getPost('level'),
            'profil_gambar' => $imageName,
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        $this->users->update($id, $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil diperbarui.']);
    }

    public function delete($id)
    {
        $user = $this->users->find($id);

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan.']);
        }

        if (!empty($user['profil_gambar']) && file_exists('public/uploads/users/' . $user['profil_gambar'])) {
            unlink('public/uploads/users/' . $user['profil_gambar']);
        }

        $this->users->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil dihapus.']);
    }
}