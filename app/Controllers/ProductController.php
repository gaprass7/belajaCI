<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    // =======================
    // LIST PRODUK
    // =======================
    public function index()
    {
        $data['products'] = $this->productModel->findAll();
        return view('products/index', $data);
    }

    // =======================
    // FORM TAMBAH PRODUK
    // =======================
    public function create()
    {
        return view('products/create');
    }

    // =======================
    // SIMPAN PRODUK BARU
    // =======================
    public function store()
    {
        // VALIDASI
        if (!$this->validate([
            'name'        => 'required|min_length[3]',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'permit_empty|string',
            'image'       => 'uploaded[image]|is_image[image]|max_size[image,2048]', // max 2MB
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('image');
        $imageName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $imageName);
        }

        $this->productModel->save([
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'stock'       => $this->request->getPost('stock'),
            'image'       => $imageName,
        ]);

        return redirect()->to('/products')->with('success', 'Produk berhasil ditambahkan.');
    }

    // =======================
    // FORM EDIT PRODUK
    // =======================
    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);
        return view('products/edit', $data);
    }

    // =======================
    // UPDATE PRODUK
    // =======================
    public function update($id)
    {
        // VALIDASI
        if (!$this->validate([
            'name'        => 'required|min_length[3]',
            'price'       => 'required|numeric',
            'stock'       => 'required|integer',
            'description' => 'permit_empty|string',
            'image'       => 'if_exist|is_image[image]|max_size[image,2048]', // opsional saat edit
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $product = $this->productModel->find($id);

        $file = $this->request->getFile('image');
        $imageName = $product['image']; // default tetap pakai gambar lama

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move(FCPATH . 'uploads', $imageName);

            // hapus gambar lama kalau ada
            if ($product['image'] && file_exists(FCPATH . 'uploads/' . $product['image'])) {
                unlink(FCPATH . 'uploads/' . $product['image']);
            }
        }

        $this->productModel->update($id, [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'stock'       => $this->request->getPost('stock'),
            'image'       => $imageName,
        ]);

        return redirect()->to('/products')->with('success', 'Produk berhasil diperbarui.');
    }

    // =======================
    // HAPUS PRODUK
    // =======================
    public function delete($id)
    {
        $product = $this->productModel->find($id);

        if ($product && $product['image'] && file_exists(FCPATH . 'uploads/' . $product['image'])) {
            unlink(FCPATH . 'uploads/' . $product['image']);
        }

        $this->productModel->delete($id);

        return redirect()->to('/products')->with('success', 'Produk berhasil dihapus.');
    }
}
