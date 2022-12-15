<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['suhu_udara', 'suhu_air', 'kelembaban_udara', 'jarak_air', 'ph_air', 'tds_air', 'created_at'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = false;
}
