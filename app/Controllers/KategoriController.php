<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\HTTP\ResponseInterface;

class KategoriController extends BaseController
{
    protected $product_category;

    function __construct()
    {
        $this->product_category = new KategoriModel();
    }

    public function index()
    {
        $product_category = $this->product_category->findAll();
        $data['product_category'] = $product_category;

        return view('v_kategori', $data);
    }

    public function create()
    {

        $dataForm = [
            'kategori' => $this->request->getPost('nama'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $this->product_category->insert($dataForm);

        return redirect('produk_kategori')->with('success', 'Data Berhasil Ditambah');
    }
    public function edit($id)
    {
        $dataProduk = $this->product_category->find($id);

        $dataForm = [
            'kategori' => $this->request->getPost('nama'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $this->product_category->update($id, $dataForm);

        return redirect('produk_kategori')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $dataProduk = $this->product_category->find($id);

        $this->product_category->delete($id);

        return redirect('produk_kategori')->with('success', 'Data Berhasil Dihapus');
    }
}
