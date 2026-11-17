<?php

namespace App\Controllers\Api;

use App\Models\UmkmModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\ResponseInterface;

class UmkmController extends ResourceController
{

    public function show($id = null): ResponseInterface
    {
        $model = new UmkmModel();
        $data = $model->find($id);

        if (!$data) {
            return $this->respond([
                'success' => false,
                'message' => 'Data UMKM tidak ditemukan',
            ], 404);
        }

        return $this->respond([
            'success' => true,
            'message' => 'Data UMKM berhasil diambil',
            'data'    => $data,
        ], 200);
    }
    public function index(): ResponseInterface
    {
        $model = new UmkmModel();

        return $this->respond([
            'success' => true,
            'message' => 'Data UMKM berhasil diambil',
            'data'    => $model->findAll(),
        ], 200);
    }

    // POST api/umkm : tambah data
    public function create(): ResponseInterface
    {
        $validation = \Config\Services::validation();
        $rules = [
            'nama_umkm' => 'required|min_length[3]|is_unique[umkm.nama_umkm]',
            'kategori'  => 'permit_empty|string',
            'pemilik'   => 'permit_empty|string',
            'alamat'    => 'permit_empty|string',
            'kontak'    => 'permit_empty|string',
        ];

        $data = $this->request->getPost();

        if (!$validation->setRules($rules)->run($data)) {
            return $this->respond([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validation->getErrors(),
            ], 400);
        }

        $model = new UmkmModel();
        $insertedId = $model->insert($data);

        if ($insertedId === false) {
            return $this->respond([
                'success' => false,
                'message' => 'Gagal menambahkan data UMKM',
                'errors'  => $model->errors(),
            ], 500);
        }

        return $this->respondCreated([
            'success' => true,
            'message' => 'Data UMKM berhasil ditambahkan',
            'data'    => $model->find($insertedId),
        ]);
    }

    // PUT api/umkm/{id} : ubah data
    public function update($id = null): ResponseInterface
    {
        $model = new UmkmModel();

        if (!$model->find($id)) {
            return $this->respond([
                'success' => false,
                'message' => 'Data UMKM tidak ditemukan',
            ], 404);
        }

        $data = $this->request->getRawInput();
        $model->update($id, $data);

        return $this->respond([
            'success' => true,
            'message' => 'Data UMKM berhasil diubah',
            'data'    => $model->find($id),
        ], 200);
    }

    // DELETE api/umkm/{id} : hapus data
    public function delete($id = null): ResponseInterface
    {
        $model = new UmkmModel();
        $data = $model->find($id);

        if (!$data) {
            return $this->respond([
                'success' => false,
                'message' => 'Data UMKM tidak ditemukan',
            ], 404);
        }

        $model->delete($id);

        return $this->respond([
            'success' => true,
            'message' => 'Data UMKM berhasil dihapus',
            'data'    => $data,
        ], 200);
    }
}