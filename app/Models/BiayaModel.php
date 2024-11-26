<?php

namespace App\Models;

use CodeIgniter\Model;

class BiayaModel extends Model
{
    protected $table      = 'biaya';
    protected $primaryKey = 'id';
    protected $allowedFields = ['category_id', 'price', 'created_at', 'updated_at'];
}
