<?php

namespace App\Models;

use CodeIgniter\Model;

class KabupatenModel extends Model
{
    protected $table = 'kabupaten';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'id_provinsi', 'nama_kabupaten'];
    
    public function getKabupatenByProvinsi($id_provinsi)
    {
        // Query untuk mengambil kabupaten berdasarkan provinsi
        $this->db->where('id_provinsi', $id_provinsi);
        $query = $this->db->get('kabupaten'); // Ganti dengan nama tabel Anda

        return $query->result_array(); // Mengembalikan hasil dalam bentuk array
    }
}
