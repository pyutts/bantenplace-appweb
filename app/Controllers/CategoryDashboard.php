<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class CategoryDashboard extends BaseController
{
    protected $category;

    public function __construct()
    {
        $this->category = new CategoryModel();
    }

    // Tampilkan semua kategori
    public function index()
    {
        $categories = $this->category->findAll();
        return view('admin/categories/categories_views', ['categories' => $categories]);
    }

    // Proses simpan kategori
    public function saveData()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'name' => 'required',
            'description' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        $this->category->insert($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Kategori berhasil ditambahkan.',
        ]);
    }

    // Form edit kategori
    public function edit($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kategori tidak ditemukan.']);
        }

        return $this->response->setJSON(['status' => 'success', 'data' => $category]);
    }

    // Proses update kategori
    public function update()
    {
        $id = $this->request->getPost('id');
        $category = $this->category->find($id);

        if (!$category) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kategori tidak ditemukan.']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        $this->category->update($id, $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Kategori berhasil diperbarui.']);
    }

    // Hapus kategori
    public function delete($id)
    {
        $category = $this->category->find($id);

        if (!$category) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Kategori tidak ditemukan.']);
        }

        $this->category->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Kategori berhasil dihapus.']);
    }
}