<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EkspedisiModel;

class EkspedisiDashboard extends BaseController
{
    protected $ekspedisi;

    public function __construct()
    {
        $this->ekspedisi = new EkspedisiModel();
    }

    public function index()
    {
        $ekspedisi = $this->ekspedisi->findAll();
        return view('admin/ekspedisi/ekspedisi_views', ['ekspedisi' => $ekspedisi]);
    }

    public function saveData()
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_ekspedisi' => 'required',
            'harga_ongkir'   => 'required|decimal',
            'satuan'         => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_ekspedisi' => $this->request->getPost('nama_ekspedisi'),
            'harga_ongkir'   => $this->request->getPost('harga_ongkir'),
            'satuan'         => $this->request->getPost('satuan')
        ];

        $this->ekspedisi->insert($data);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Ekspedisi berhasil ditambahkan.',
        ]);
    }

    public function edit($id)
    {
        $ekspedisi = $this->ekspedisi->find($id);

        if (!$ekspedisi) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Ekspedisi tidak ditemukan']);
        }

        return $this->response->setJSON(['status' => 'success', 'data' => $ekspedisi]);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $ekspedisi = $this->ekspedisi->find($id);

        if (!$ekspedisi) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Ekspedisi tidak ditemukan']);
        }

        $validation = \Config\Services::validation();
        $rules = [
            'nama_ekspedisi' => 'required',
            'harga_ongkir'   => 'required|decimal',
            'satuan'         => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $validation->getErrors(),
            ]);
        }

        $data = [
            'nama_ekspedisi' => $this->request->getPost('nama_ekspedisi'),
            'harga_ongkir'   => $this->request->getPost('harga_ongkir'),
            'satuan'         => $this->request->getPost('satuan')
        ];

        $this->ekspedisi->update($id, $data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Ekspedisi berhasil diperbarui.']);
    }

    public function delete($id)
    {
        $ekspedisi = $this->ekspedisi->find($id);

        if (!$ekspedisi) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Ekspedisi tidak ditemukan.']);
        }

        $this->ekspedisi->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Ekspedisi berhasil dihapus.']);
    }
}