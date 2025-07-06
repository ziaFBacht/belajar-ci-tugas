<?php

namespace App\Controllers;
use App\Models\DiskonModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DiskonController extends BaseController
{
    protected $diskon;
    public function __construct()
    {
        $this->diskon = new DiskonModel();
    }

    public function index()
    {
        $diskon = $this->diskon->findAll();
        $data['diskon'] = $diskon;

        return view('v_diskon', $data);
    }

    public function create()
    {
        $tanggalInput = $this->request->getPost('tgl');

        $existing = $this->diskon
            ->where('tanggal', $tanggalInput)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Tanggal tidak boleh sama dengan yang sudah ada!');
        }

        $dataForm = [
            'tanggal' => $this->request->getPost('tgl'),
            'nominal' => $this->request->getPost('nom'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->diskon->insert($dataForm);

        return redirect('diskon')->with('success', 'Data Berhasil Ditambah');
    }
    public function edit($id)
    {
        $tanggalInput = $this->request->getPost('tgl');

        // Cek apakah tanggal sudah dipakai oleh record lain
        $existing = $this->diskon
            ->where('tanggal', $tanggalInput)
            ->where('id !=', $id)
            ->first();

        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Tanggal tidak boleh sama dengan yang sudah ada!');
        }

        $dataForm = [
            'tanggal' => $this->request->getPost('tgl'),
            'nominal' => $this->request->getPost('nom'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->diskon->update($id, $dataForm);

        return redirect('diskon')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataProduk = $this->diskon->find($id);

        $this->diskon->delete($id);

        return redirect('diskon')->with('success', 'Data Berhasil Dihapus');
    }

}
