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
}