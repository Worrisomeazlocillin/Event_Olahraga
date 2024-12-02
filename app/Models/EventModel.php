<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table      = 'events';
    protected $primaryKey = 'id';

    protected $allowedFields = ['event_name', 'event_date', 'location', 'description', 'event_image', 'created_at', 'updated_at'];

    // Atur timestamps secara otomatis jika ingin
    protected $useTimestamps = false; // Set ke true jika menggunakan `created_at` dan `updated_at` secara otomatis oleh CodeIgniter

    public function getEventDetails($eventId)
    {
        return $this->db->table('events') // Sesuaikan dengan nama tabel Anda
            ->where('event_id', $eventId)
            ->get()
            ->getResultArray();
    }

    // Fungsi untuk mengambil event dengan kategori terkait
    public function getEventWithKategori($idEvent)
    {
        return $this->db->table('events')
            ->join('kategori_event', 'kategori_event.id_event = events.id', 'left') // Join berdasarkan id_event di kategori_event dan id di events
            ->select('events.*, kategori_event.nama_kategori, kategori_event.biaya, kategori_event.rute') // Ambil data event beserta nama kategori dan biaya dari kategori_event
            ->where('events.id', $idEvent) // Filter berdasarkan id event
            ->get()
            ->getRowArray(); // Kembalikan hasil sebagai array baris
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
