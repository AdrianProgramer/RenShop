<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PesananModel;

class Home extends BaseController
{
    protected $produk;
    protected $pesanan;

    public function __construct()
    {
        $this->produk = new ProdukModel();
        $this->pesanan = new PesananModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $my = $this->produk->search($keyword);
        } else {
            $my = $this->produk;
        }
        $data = [
            'title' => 'home',
            'produk' => $my->paginate(5, 'produk'),
            'pager' => $this->produk->pager
        ];
        return view('pages/home', $data);
    }

    public function insert_view()
    {
        $data = [
            'title' => 'insert',
            'errors' => \Config\Services::validation()
        ];
        return view('pages/insert', $data);
    }
    public function insert_save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[produk.nama]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => 'produk sudah ada'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'merek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar' => [
                'rules' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'gambar harus berupa gambar',
                    'mime_in' => 'gambar harus berupa jpg, jpeg, atau png'
                ]
            ]
        ])) {
            // $error = \Config\Services::validation();
            return redirect()->to('http://localhost:8080/insert')->withInput();
        }
        $file = $this->request->getFile('gambar');
        if ($file->getError() == 4) {
            $gambar = 'default.png';
        } else {
            $gambar = $file->getRandomName();
            $file->move('img', $gambar);
        }
        $this->produk->save([
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'merek' => $this->request->getVar('merek'),
            'gambar' => $gambar,
            'slug' => url_title($this->request->getVar('nama'), '-', true)
        ]);

        session()->setFlashdata('upload', 'Data berhasil ditambahkan');
        return redirect()->to('http://localhost:8080/');
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'detail',
            'produk' => $this->produk->getProduk($slug)
        ];
        return view('pages/detail', $data);
    }

    public function delete($id)
    {
        $this->produk->delete($id);
        session()->setFlashdata('delete', 'Data berhasil dihapus');
        return redirect()->to('http://localhost:8080/');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'edit',
            'produk' => $this->produk->getProduk($slug),
            'errors' => \Config\Services::validation()
        ];
        return view('pages/edit', $data);
    }
    public function edit_save($id)
    {
        $cond = $this->produk->getProduk($this->request->getVar('slug'));
        if ($this->request->getVar('nama') == $cond['nama']) {
            $rules = 'required';
        } else {
            $rules = 'required|is_unique[produk.nama]';
        }
        if (!$this->validate([
            'nama' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => 'produk sudah ada'
                ]
            ],
            'harga' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
            'merek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'gambar' => [
                'rules' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'gambar harus berupa gambar',
                    'mime_in' => 'gambar harus berupa jpg, jpeg, atau png'
                ]
            ]
        ])) {
            // $error = \Config\Services::validation();
            return redirect()->to('http://localhost:8080/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $file = $this->request->getFile('gambar');
        if ($file->getError() == 4) {
            $gambar = $this->request->getVar('gambar');
        } else {
            $gambar = $file->getRandomName();
            $file->move('img', $gambar);
        }
        $this->produk->save([
            'id' => $id,
            'nama' => $this->request->getVar('nama'),
            'harga' => $this->request->getVar('harga'),
            'merek' => $this->request->getVar('merek'),
            'gambar' => $gambar,
            'slug' => url_title($this->request->getVar('nama'), '-', true)
        ]);

        session()->setFlashdata('ubah', 'Data berhasil diubah');
        return redirect()->to('http://localhost:8080/');
    }

    public function order_view($slug)
    {
        $data = [
            'title' => 'order',
            'produk' => $this->produk->getProduk($slug),
            'errors' => \Config\Services::validation()
        ];
        return view('pages/order', $data);
    }

    public function order_save()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'jumlah' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'numeric' => '{field} harus berupa angka'
                ]
            ],
        ])) {
            // $error = \Config\Services::validation();
            return redirect()->to('order/' . $this->request->getVar('slug'))->withInput();
        }
        $this->pesanan->save([
            'nama_barang' => $this->request->getVar('nama_barang'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'jumlah' => $this->request->getVar('jumlah'),
        ]);

        session()->setFlashdata('order', 'Kamu Berhasil Order');
        return redirect()->to('/');
    }
}
