<?php

namespace App\Models;

use CodeIgniter\Model;

class KabupatenModel extends Model
{
    protected $table = 'kabupaten'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = ['id', 'id_provinsi', 'nama_kabupaten']; // Kolom yang diizinkan untuk diubah

    public function getKabupatenByProvinsi($id_provinsi)
    {
        // Menggunakan query builder untuk mengambil data berdasarkan id_provinsi
        return $this->where('id_provinsi', $id_provinsi)->findAll();
    }
}
