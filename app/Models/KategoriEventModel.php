<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriEventModel extends Model
{
    protected $table = 'kategori_event';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_event',          // Kolom untuk mengacu ke tabel events
        'nama_kategori',
        'deskripsi_kategori',
        'biaya',
        'rute',
        'start_date',
        'start_jam',
        'cut_off_time',
        'keterangan',
        'created_at',
        'updated_at'
    ];

    protected $useTtimestamps = true;

    // Fungsi untuk mengambil data lengkap dengan join ke tabel events
    public function getCategoriesWithEvents()
    {
        return $this->db->table($this->table)
            ->join('events', 'kategori_event.id_event = events.id', 'left') // Join tabel events
            ->select('kategori_event.*, events.nama_event') // Ambil semua dari kategori_event dan nama_event dari events
            ->get()
            ->getResultArray(); // Kembalikan hasil dalam bentuk array
    }

    // Fungsi untuk mengambil kategori event dengan kolom yang lebih spesifik (id, nama_kategori, biaya)
    public function getKategoriEvents()
    {
        return $this->db->table($this->table)
            ->select('id, nama_kategori, biaya') // Hanya ambil id, nama_kategori, dan biaya
            ->get()
            ->getResultArray(); // Kembalikan hasil dalam bentuk array
    }

    public function getEventHistory()
    {
        // Ambil ID user yang sedang login
        $userId = session()->get('user_id');

        // Lakukan join antara tabel event_history, event, dan kategori_event
        $builder = $this->db->table('event_history');
        $builder->select('event_history.*, event.nama_event, kategori_event.kategori_event')
            ->join('event', 'event.id = event_history.id_event')
            ->join('kategori_event', 'kategori_event.id = event_history.id_kategori_event')
            ->where('event_history.user_id', $userId);

        // Ambil hasil query
        $query = $builder->get();

        // Kembalikan hasil sebagai array
        return $query->getResultArray();
    }
}
