<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailEventModel extends Model
{
    protected $table      = 'detail_events';
    protected $primaryKey = 'id';
    protected $allowedFields = ['event_id', 'category_id', 'biaya_id', 'created_at', 'updated_at'];

    public function getDetailEvent($event_id)
    {
        return $this->select('detail_events.*, category_events.category_name, biaya.price')
                    ->join('category_events', 'category_events.id = detail_events.category_id')
                    ->join('biaya', 'biaya.id = detail_events.biaya_id')
                    ->where('detail_events.event_id', $event_id)
                    ->findAll();
    }
}
