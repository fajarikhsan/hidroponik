<?php

namespace App\Models;

use CodeIgniter\Model;

class PhLogModel extends Model
{
    protected $table = 'ph_log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ph', 'tanaman_id'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
