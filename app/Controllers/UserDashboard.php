<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UserDashboard extends BaseController
{
    protected $users;
    public function __construct()
    {
        $this->users = new \App\Models\UsersModel();
    }
    public function index()
    {
        $users = $this->users->findAll();

        $data = [
            'users' => $users
        ];

        return view('admin/users/user_views', $data);
    }

    public function addProses()
    {
        return view('admin/users/addUsers');
    }


    public function saveData()
{
    $validation = \Config\Services::validation();
    $rules = [
        'nama' => 'required',
        'username' => 'required|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'profil_gambar' => [
            'rules' => 'is_image[profil_gambar]|mime_in[profil_gambar,image/png,image/jpeg]|max_size[profil_gambar,2048]',
            'errors' => [
                'is_image' => 'File harus berupa gambar.',
                'mime_in' => 'Format file harus PNG/JPEG.',
                'max_size' => 'Ukuran gambar maksimal 2MB.'
            ]
        ]
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Upload gambar
    $image = $this->request->getFile('profil_gambar');
    $imageName = '';
    if ($image && $image->isValid() && !$image->hasMoved()) {
        $imageName = $image->getRandomName();
        $image->move('uploads/profiles', $imageName);
    }

    $data = [
        'nama' => $this->request->getPost('nama'),
        'username' => $this->request->getPost('username'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        'profil_gambar' => $imageName,
        'level' => 'User'
    ];

    $this->users->insert($data);
    return redirect()->to('users')->with('success', 'User berhasil ditambahkan.');
}

public function edit($id)
{
    $user = $this->users->find($id);
    if (!$user) {
        return redirect()->to('users')->with('error', 'User tidak ditemukan.');
    }

    return view('admin/users/editUsers', ['user' => $user]);
}

public function update()
{
    $id = $this->request->getPost('id');
    $user = $this->users->find($id);

    if (!$user) {
        return redirect()->to('users')->with('error', 'User tidak ditemukan.');
    }

    $validation = \Config\Services::validation();
    $rules = [
        'nama' => 'required',
        'username' => 'required',
        'email' => 'required|valid_email',
        'profil_gambar' => 'permit_empty|is_image[profil_gambar]|mime_in[profil_gambar,image/png,image/jpeg]|max_size[profil_gambar,2048]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $image = $this->request->getFile('profil_gambar');
    $imageName = $user['profil_gambar'];

    if ($image && $image->isValid() && !$image->hasMoved()) {
        if (file_exists('uploads/profiles/' . $user['profil_gambar'])) {
            unlink('uploads/profiles/' . $user['profil_gambar']);
        }
        $imageName = $image->getRandomName();
        $image->move('uploads/profiles', $imageName);
    }

    $dataUpdate = [
        'nama' => $this->request->getPost('nama'),
        'username' => $this->request->getPost('username'),
        'email' => $this->request->getPost('email'),
        'profil_gambar' => $imageName,
    ];

    if (!empty($this->request->getPost('password'))) {
        $dataUpdate['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
    }

    $this->users->update($id, $dataUpdate);
    return redirect()->to('users')->with('success', 'User berhasil diperbarui.');
}

public function delete($id = null)
{
    $user = $this->users->find($id);

    if (!$user) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'User tidak ditemukan.'
        ]);
    }

    if (!empty($user['profil_gambar']) && file_exists('uploads/profiles/' . $user['profil_gambar'])) {
        unlink('uploads/profiles/' . $user['profil_gambar']);
    }

    $this->users->delete($id);

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'User berhasil dihapus.'
    ]);
}




}