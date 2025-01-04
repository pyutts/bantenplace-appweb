<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;
use App\Models\CategoryModel;

class ProductsDashboard extends BaseController
{
    protected $product;
    protected $category;

    public function __construct()
    {
        $this->product = new ProductsModel();
        $this->category = new CategoryModel();
    }

    // Tampilkan semua produk
    public function index()
    {
        $products = $this->product->select('products.*, categories.name as category_name')
                                  ->join('categories', 'categories.id = products.category_id', 'left')
                                  ->findAll();
        $categories = $this->category->findAll();

        return view('admin/product/products_views', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    // Proses simpan produk
    public function saveData()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'name_products'   => 'required',
            'description'     => 'required',
            'price'           => 'required|decimal',
            'stock'           => 'required|integer',
            'category_id'     => 'required|integer',
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
            $image->move('public/uploads/products', $imageName);
        }

        $data = [
            'name_products'   => $this->request->getPost('name_products'),
            'description'     => $this->request->getPost('description'),
            'price'           => $this->request->getPost('price'),
            'stock'           => $this->request->getPost('stock'),
            'category_id'     => $this->request->getPost('category_id'),
            'gambar_products' => $imageName,
        ];

        $this->product->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Produk berhasil ditambahkan.',
        ]);
    }

    // Form edit produk
    public function edit($id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
        }

        return $this->response->setJSON(['status' => 'success', 'data' => $product]);
    }

    // Proses update produk
    public function update()
    {
        $id = $this->request->getPost('id');
        $product = $this->product->find($id);

        if (!$product) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'name_products'   => 'required',
            'description'     => 'required',
            'price'           => 'required|decimal',
            'stock'           => 'required|integer',
            'category_id'     => 'required|integer',
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
        $imageName = $product['gambar_products'];

        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($product['gambar_products'] && file_exists('public/uploads/products/' . $product['gambar_products'])) {
                unlink('public/uploads/products/' . $product['gambar_products']);
            }

            $timestamp = date('YmdHis');
            $imageName = $timestamp . '_' . $image->getRandomName();
            $image->move('public/uploads/products', $imageName);
        }

        $data = [
            'name_products'   => $this->request->getPost('name_products'),
            'description'     => $this->request->getPost('description'),
            'price'           => $this->request->getPost('price'),
            'stock'           => $this->request->getPost('stock'),
            'category_id'     => $this->request->getPost('category_id'),
            'gambar_products' => $imageName,
        ];

        $this->product->update($id, $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil diperbarui.']);
    }

    // Hapus produk
    public function delete($id)
    {
        $product = $this->product->find($id);

        if (!$product) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Produk tidak ditemukan.']);
        }

        if (!empty($product['gambar_products']) && file_exists('public/uploads/products/' . $product['gambar_products'])) {
            unlink('public/uploads/products/' . $product['gambar_products']);
        }

        $this->product->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Produk berhasil dihapus.']);
    }
}