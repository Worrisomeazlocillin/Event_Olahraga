<?php

namespace App\Models;

use CodeIgniter\Model;

class ProvinsiModel extends Model
{
    protected $table = 'provinsi'; // Nama tabel di database
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'nama_provinsi']; // Kolom yang diizinkan

    public function create()
    {
        $provinsiModel = new ProvinsiModel();
        $provinsi = $provinsiModel->findAll(); // Mengambil semua data provinsi dari tabel

        // Kirim data provinsi ke view
        return view('pendaftaran/create', [
            'provinsi' => $provinsi,
            'events' => $this->eventModel->findAll(), // Pastikan event juga dikirim
            'kategori_events' => $this->kategoriEventModel->findAll() // Kategori event
        ]);
    }
}
