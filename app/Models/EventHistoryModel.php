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
        // Menggunakan query builder untuk join dengan tabel 'events' dan mengambil nama event
        $builder = $this->db->table($this->table)
            ->select('pendaftaran.nama_lengkap, events.event_name as nama_event, 
                      pendaftaran.kategori_event, pendaftaran.ukuran_kaos, 
                      pendaftaran.kewarganegaraan')
            ->join('events', 'pendaftaran.id_event = events.id', 'left'); // Join tabel 'events' berdasarkan id_event

        // Jika ada pencarian, filter berdasarkan nama event, nama lengkap, atau kategori event
        if ($search) {
            $builder->like('events.event_name', $search)
                ->orLike('pendaftaran.nama_lengkap', $search)
                ->orLike('pendaftaran.kategori_event', $search);
        }

        // Mengembalikan hasil query dalam bentuk array
        return $builder->get()->getResultArray();
    }
}
