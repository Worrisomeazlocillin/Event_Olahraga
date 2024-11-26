<?php

namespace App\Models;

use CodeIgniter\Model;

class UserEventModel extends Model
{
    protected $table = 'events'; // Ganti dengan nama tabel yang sesuai
    protected $primaryKey = 'id';
    protected $allowedFields = ['name_event', 'event_date', 'location', 'description', 'event_image', 'biaya']; // Kolom yang boleh diisi
}
