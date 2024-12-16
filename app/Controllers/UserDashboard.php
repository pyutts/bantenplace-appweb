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
        return view('admin/users/addUsers');
    }

    public function saveData()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama'         => 'required',
            'username'     => 'required|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
            'no_telepon'   => 'required|numeric',
            'kode_pos'     => 'required|numeric',
            'alamat'       => 'required',
            'profil_gambar' => [
                'rules'  => 'is_image[profil_gambar]|mime_in[profil_gambar,image/png,image/jpeg]|max_size[profil_gambar,2048]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format file harus PNG/JPEG.',
                    'max_size' => 'Ukuran gambar maksimal 2MB.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status'  => 'error',
                'errors'  => $validation->getErrors()
            ]);
        }

        $image = $this->request->getFile('profil_gambar');
        $imageName = '';

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $timestamp = date('YmdHis'); 
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('uploads/profiles', $imageName);
        }

        $data = [
            'nama'          => $this->request->getPost('nama'),
            'username'      => $this->request->getPost('username'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'no_telepon'    => $this->request->getPost('no_telepon'),
            'kode_pos'      => $this->request->getPost('kode_pos'),
            'alamat'        => $this->request->getPost('alamat'),
            'profil_gambar' => $imageName,
            'level'         => 'User'
        ];

        $this->users->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'User berhasil ditambahkan.'
        ]);
    }

    public function edit($id)
    {
        $user = $this->users->find($id);

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

        return view('admin/users/editUsers', ['user' => $user]);
    }

    public function update()
    {
        $id   = $this->request->getPost('id');
        $user = $this->users->find($id);
    
        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }
    
        $rules = [
            'nama'       => 'required',
            'username'   => 'required',
            'email'      => 'required|valid_email',
            'no_telepon' => 'required|numeric',
            'alamat'     => 'required',
        ];
    
        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors(),
            ]);
        }
    
        $this->users->update($id, [
            'nama'       => $this->request->getPost('nama'),
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'alamat'     => $this->request->getPost('alamat'),
        ]);
    
        return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil diperbarui.']);
    }
    
    public function delete($id = null)
    {
        $user = $this->users->find($id);

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan.']);
        }

        
        if (!empty($user['profil_gambar']) && file_exists('uploads/profiles/' . $user['profil_gambar'])) {
            unlink('uploads/profiles/' . $user['profil_gambar']);
        }

        $this->users->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil dihapus.']);
    }
}
