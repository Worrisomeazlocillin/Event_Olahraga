<?php

namespace App\Models;

use CodeIgniter\Model;

class EventHistoryModel extends Model
{
    protected $table = 'pendaftaran'; // Ganti dengan tabel yang sesuai
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'nama_lengkap', 'nama_event', 'kategori_event', 'ukuran_kaos', 'kewarganegaraan'];

    // Fungsi untuk mengambil histori event dengan pencarian
    public function getEventHistory($search = null)
    {
        if ($search) {
            // Filter berdasarkan nama
            return $this->like('nama_lengkap', $search)->findAll();
        }
        return $this->findAll();
    }
}
