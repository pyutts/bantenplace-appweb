<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use CodeIgniter\HTTP\ResponseInterface;

class UserDashboard extends BaseController
{
    public function user(){
        $userModel = new \App\Models\UserModel();
        $data['users'] = $userModel->findAll();
        return view('admin/users/user_views', $data);
    }

    public function createUser()
    {
        return view('users/createUser');
    }

    // Untuk fungsi ajaxnya dari button tambah di section users
    public function addUsers()
    {
        return view('admin/users/addUsers');
        if ($this->request->getMethod() === 'POST') {
            $input = $this->request->getJSON();
            if (isset($input->action) && $input->action === 'add_user') {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data anda berhasil ditambahkan']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Ada Data yang tidak valid']);
            }
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Method Request tidak kami kenali']);
    }

    public function addProsesUser()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email',
            'level' => 'required',
            'no_telepon' => 'required|numeric',
            'alamat' => 'required',
            'profil_gambar' => 'uploaded[profil_gambar]|max_size[profil_gambar,2048]|is_image[profil_gambar]|mime_in[profil_gambar,image/png,image/jpg,image/jpeg]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new \App\Models\UserModel();
        $file = $this->request->getFile('profil_gambar');

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/profil', $fileName);
        } else {
            $fileName = null;
        }

        // Data yang akan disimpan
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'alamat' => $this->request->getPost('alamat'),
            'profil_gambar' => $fileName,
        ];

        // Debug data yang akan dikirim
        dd($data);

        // Insert data ke database
        $userModel->insert($data);

        return redirect()->to('dashboard/users')->with('success', 'User berhasil ditambahkan');
    }

    public function edit($id)
    {
        $userModel = new \App\Models\UserModel();
        $data['user'] = $userModel->find($id);

        return view('users/edit', $data);
    }

    public function update($id)
    {
        $userModel = new \App\Models\UserModel();
        $file = $this->request->getFile('profil_gambar');
        $user = $userModel->find($id);

        if ($file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move('uploads/', $fileName);

            if ($user['profil_gambar'] && file_exists('uploads/' . $user['profil_gambar'])) {
                unlink('uploads/' . $user['profil_gambar']);
            }
        } else {
            $fileName = $user['profil_gambar'];
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'alamat' => $this->request->getPost('alamat'),
            'profil_gambar' => $fileName,
        ];

        $userModel->update($id, $data);

        return redirect()->to('/users');
    }


}
