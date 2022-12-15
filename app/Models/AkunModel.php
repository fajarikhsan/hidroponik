<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'akun';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'created_at', 'updated_at'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
}
