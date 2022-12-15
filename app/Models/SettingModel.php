<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'id';
    protected $allowedFields = ['suhu', 'lampu', 'created_at'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
}
