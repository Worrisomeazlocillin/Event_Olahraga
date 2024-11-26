<?php

namespace App\Models;

use CodeIgniter\Model;

class OnlyUserModel extends Model
{
    protected $table      = 'login_user';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['username', 'email', 'password'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
