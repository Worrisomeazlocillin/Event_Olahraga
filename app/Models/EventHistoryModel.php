<?php

namespace App\Models;

use CodeIgniter\Model;

class EventHistoryModel extends Model
{
    protected $table = 'pendaftaran'; // Tabel pendaftaran
    protected $primaryKey = 'id'; // Primary key tabel pendaftaran

    // Kolom yang diizinkan untuk dimasukkan atau diperbarui
    protected $allowedFields = ['id_event', 'nama_lengkap', 'kategori_event', 'ukuran_kaos', 'kewarganegaraan'];

    // Fungsi untuk mengambil histori event dengan pencarian
    public function getEventHistory($search = null)
    {
        // Menggunakan query builder untuk join dengan tabel 'events' dan 'kategori_event'
        $builder = $this->db->table($this->table)
            ->select('pendaftaran.nama_lengkap, events.event_name as nama_event, 
                  kategori_event.nama_kategori, events.event_date as event_dimulai, 
                  pendaftaran.kewarganegaraan')
            ->join('events', 'pendaftaran.id_event = events.id', 'left') // Join tabel 'events'
            ->join('kategori_event', 'pendaftaran.kategori_event = kategori_event.id', 'left'); // Join tabel 'kategori_event'

        // Jika ada pencarian, filter berdasarkan nama event, nama lengkap, atau kategori event
        if ($search) {
            $builder->like('events.event_name', $search)
                ->orLike('pendaftaran.nama_lengkap', $search)
                ->orLike('kategori_event.nama_kategori', $search); // Cari berdasarkan nama kategori
        }

        // Mengembalikan hasil query dalam bentuk array
        return $builder->get()->getResultArray();
    }
}
