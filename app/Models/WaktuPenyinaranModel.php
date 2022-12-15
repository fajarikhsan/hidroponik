<?php

namespace App\Models;

use CodeIgniter\Model;

class WaktuPenyinaranModel extends Model
{
    protected $table = 'waktu_penyinaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['waktu'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = false;
}
