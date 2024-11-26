<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'id_event',
        'event_kategori',
        'biaya',
        'jumlah_pembayaran',
        'status_pembayaran',
        'scan_ktp',
        'bukti_transfer',
        'created_at',
        'updated_at'
    ];

    public function getEventWithCategory($idEvent)
    {
        return $this->select('events.event_name, events.biaya, kategori_event.nama_kategori as event_kategori')
            ->join('kategori_event', 'kategori_event.id = events.event_kategori_id')
            ->where('events.id', $idEvent)
            ->first();
    }
}
