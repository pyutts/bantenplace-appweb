<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanModel;

class LaporanDashboard extends BaseController
{
    protected $products;

    public function __construct()
    {
        $this->products = new LaporanModel();
    }

    // Tampilkan semua produk
    public function index()
    {
        $products = $this->products->findAll();

        return view('admin/product/products_views', ['products' => $products]);
    }

    // Form tambah produk
    public function add()
    {
        return view('admin/product/addProducts');
    }

    // Proses simpan produk
    public function saveData()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'name'            => 'required',
            'description'     => 'required',
            'price'           => 'required|decimal',
            'stock'           => 'required|integer',
            'gambar_products' => [
                'rules'  => 'uploaded[gambar_products]|is_image[gambar_products]|mime_in[gambar_products,image/png,image/jpeg]|max_size[gambar_products,512]',
                'errors' => [
                    'uploaded' => 'Gambar produk wajib diunggah.',
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

        $image = $this->request->getFile('gambar_products');
        $imageName = '';

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $timestamp = date('YmdHis');
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('uploads/products', $imageName);
        }

        $data = [
            'kode_products'   => $this->request->getPost('GenerateKodeUnik'),
            'name'            => $this->request->getPost('name'),
            'description'     => $this->request->getPost('description'),
            'price'           => $this->request->getPost('price'),
            'stock'           => $this->request->getPost('stock'),
            'gambar_produk'   => $imageName,
        ];

        $this->products->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Produk berhasil ditambahkan.',
        ]);
    }

    // Form edit produk
    public function edit($id)
    {
        $product = $this->products->find($id);

        if (!$product) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
        }

        return view('admin/product/editProducts', ['product' => $product]);
    }

    // Proses update produk
    public function update()
    {
        $id = $this->request->getPost('id');
        $product = $this->products->find($id);

        if (!$product) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'name'        => 'required',
            'description' => 'required',
            'price'       => 'required|decimal',
            'stock'       => 'required|integer',
            'gambar_products' => [
                'rules'  => 'is_image[gambar_products]|mime_in[gambar_products,image/png,image/jpeg]|max_size[gambar_products,512]',
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

        $image = $this->request->getFile('gambar_products');
        $imageName = $product['gambar_produk'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($product['gambar_produk'] && file_exists('uploads/products/' . $product['gambar_produk'])) {
                unlink('uploads/products/' . $product['gambar_produk']);
            }

            $timestamp = date('YmdHis');
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('uploads/products', $imageName);
        }

        $data = [
            'kode_products'   => $this->request->getPost('GenerateKodeUnik'),
            'name'            => $this->request->getPost('name'),
            'description'     => $this->request->getPost('description'),
            'price'           => $this->request->getPost('price'),
            'stock'           => $this->request->getPost('stock'),
            'gambar_produk'   => $imageName,
        ];

        $this->products->update($id, $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil diperbarui.']);
    }

    // Hapus produk
    public function delete($id)
    {
        $product = $this->products->find($id);

        if (!$product) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan.']);
        }

        if (!empty($product['gambar_produk']) && file_exists('uploads/products/' . $product['gambar_produk'])) {
            unlink('uploads/products/' . $product['gambar_produk']);
        }

        $this->products->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil dihapus.']);
    }
}
