<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Config\Upload;

class AccountController extends BaseController
{
    protected $userModel;
    protected $session;
    protected $upload;

    public function __construct()
    {
        $this->userModel = new UsersModel();
        $this->session = session();
        $this->upload = new Upload();
    }

    public function myaccounts()
    {
        $userId = session()->get('id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = $this->userModel->find($userId);
        
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Data pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Profil Saya',
            'userData' => $user,
            'user' => $user
        ];

        return view('homepages/account_views', $data);
    }

    public function edit()
    {
        $userId = session()->get('id');
        
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = $this->userModel->find($userId);
        
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Data pengguna tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Profil',
            'userData' => $user,
            'user' => $user
        ];

        return view('homepages/account_edit', $data);
    }

    public function update()
    {
        $userId = session()->get('id');
        
        $rules = [
            'nama' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'min_length' => 'Nama minimal 3 karakter'
                ]
            ],
            'username' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Username harus diisi',
                    'min_length' => 'Username minimal 3 karakter'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid'
                ]
            ],
            'no_telepon' => [
                'rules' => 'required|min_length[10]|max_length[15]',
                'errors' => [
                    'required' => 'Nomor telepon harus diisi',
                    'min_length' => 'Nomor telepon minimal 10 digit',
                    'max_length' => 'Nomor telepon maksimal 15 digit'
                ]
            ],
            'kode_pos' => [
                'rules' => 'required|min_length[5]|max_length[6]',
                'errors' => [
                    'required' => 'Kode pos harus diisi',
                    'min_length' => 'Kode pos minimal 5 digit',
                    'max_length' => 'Kode pos maksimal 6 digit'
                ]
            ],
            'alamat' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    'required' => 'Alamat harus diisi',
                    'min_length' => 'Alamat terlalu pendek, minimal 10 karakter'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'alamat' => $this->request->getPost('alamat')
        ];

        // Handle optional file upload
        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validasi file hanya jika ada upload
            $validationRule = [
                'profile_image' => [
                    'rules' => 'max_size[profile_image,2048]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran file terlalu besar (maksimal 2MB)',
                        'is_image' => 'File harus berupa gambar',
                        'mime_in' => 'Format file harus JPG, JPEG, atau PNG'
                    ]
                ]
            ];

            if ($this->validate($validationRule)) {
                $newName = $file->getRandomName();
                $file->move('uploads/users', $newName);
                $data['profile_image'] = $newName;
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $this->validator->getErrors()
                ]);
            }
        }

        $updated = $this->userModel->update($userId, $data);
        
        if ($updated) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Profil berhasil diperbarui'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui profil'
            ]);
        }
    }

    public function updateProfile()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false]);
        }

        $userId = session()->get('id');
        $rules = [
            'nama' => 'required|min_length[3]',
            'username' => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'no_telepon' => 'required|min_length[10]|max_length[15]',
            'kode_pos' => 'required|min_length[5]|max_length[6]',
            'alamat' => 'required|min_length[10]',
            'profile_image' => 'uploaded[profile_image]|max_size[profile_image,2048]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'kode_pos' => $this->request->getPost('kode_pos'),
            'alamat' => $this->request->getPost('alamat')
        ];

        // Handle file upload
        $file = $this->request->getFile('profile_image');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/users', $newName);
            $data['profile_image'] = $newName;
        }

        $updated = $this->userModel->update($userId, $data);
        
        if ($updated) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Profil berhasil diperbarui'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal memperbarui profil'
            ]);
        }
    }
}