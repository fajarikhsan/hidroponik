<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'id';
    protected $allowedFields = ['batas_suhu', 'lama_penyinaran', 'batas_air', 'tanaman_id'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
}
