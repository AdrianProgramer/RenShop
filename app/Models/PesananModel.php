<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table      = 'pesanan';
    // protected $primaryKey = 'id';
    // protected $useAutoIncrement = true;
    // protected $useTimestamps = true;
    protected $allowedFields = ['nama_barang', 'nama', 'alamat', 'jumlah'];
}
