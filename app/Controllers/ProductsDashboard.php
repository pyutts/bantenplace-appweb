<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;

class ProductsDashboard extends BaseController
{
    protected $products;

    public function __construct()
    {
        $this->products = new ProductsModel();
    }

    public function index()
    {
        $products = $this->products->findAll();

        return view('admin/product/products_views', ['products' => $products]);
    }

    public function addProses()
    {
        return view('admin/product/addProducts');
    }

    public function saveData()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_products' => 'required',
            'description'   => 'required',
            'price'         => 'required',
            'stock'         => 'required',
            'gambar_product'=> 'required',
            'rating'        => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $image = $this->request->getFile('gambar_products');
        $imageName = '';

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $timestamp = date('YmdHis');
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('uploads/profiles', $imageName);
        }

        $data = [
            'nama_products'     => $this->request->getPost('nama_products'),
            'description'       => $this->request->getPost('description'),
            'price'             => $this->request->getPost('price'),
            'stock'             => $this->request->getPost('stock'),
            'rating'            => $this->request->getPost('rating'),
            'gambar_products'   => $imageName,
        ];

        $this->products->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'User berhasil ditambahkan.',
        ]);
    }

    public function edit($id)
    {
        $user = $this->products->find($id);

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

        return view('admin/products/editproducts', ['user' => $user]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $user = $this->products->find($id);

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan']);
        }

        $rules = [
            'nama'       => 'required',
            'username'   => 'required',
            'email'      => 'required|valid_email',
            'no_telepon' => 'required|numeric',
            'alamat'     => 'required',
            'level'      => 'required',
            'kode_pos'   => 'required|numeric',
            'profil_gambar' => [
                'rules'  => 'is_image[profil_gambar]|mime_in[profil_gambar,image/png,image/jpeg]|max_size[profil_gambar,2048]',
                'errors' => [
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format file harus PNG/JPEG.',
                    'max_size' => 'Ukuran gambar maksimal 2MB.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $image = $this->request->getFile('profil_gambar');
        $imageName = $user['profil_gambar']; 

        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Hapus gambar lama jika baru di-upload
            if ($user['profil_gambar'] && file_exists('uploads/profiles/' . $user['profil_gambar'])) {
                unlink('uploads/profiles/' . $user['profil_gambar']);
            }

            $timestamp = date('YmdHis');
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('uploads/profiles', $imageName);
        }

        $data = [
            'nama'       => $this->request->getPost('nama'),
            'username'   => $this->request->getPost('username'),
            'email'      => $this->request->getPost('email'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'alamat'     => $this->request->getPost('alamat'),
            'level'      => $this->request->getPost('level'),
            'kode_pos'   => $this->request->getPost('kode_pos'),
            'profil_gambar' => $imageName,
        ];

        $this->products->update($id, $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil diperbarui.']);
    }


    public function delete($id = null)
    {
        $user = $this->products->find($id);

        if (!$user) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'User tidak ditemukan.']);
        }

        if (!empty($user['profil_gambar']) && file_exists('uploads/profiles/' . $user['profil_gambar'])) {
            unlink('uploads/profiles/' . $user['profil_gambar']);
        }

        $this->products->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'User berhasil dihapus.']);
    }
}
