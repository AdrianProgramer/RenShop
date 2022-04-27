<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    // protected $primaryKey = 'id';
    // protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'harga', 'merek', 'gambar', 'slug'];
    public function getProduk($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        } else {
            return $this->where(['slug' => $slug])->first();
        }
    }
    public function search($keyword)
    {
        return $this->table('produk')->like('nama', $keyword);
    }
}
