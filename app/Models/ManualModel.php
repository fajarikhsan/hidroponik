<?php

namespace App\Models;

use CodeIgniter\Model;

class ManualModel extends Model
{
    protected $table = 'manual';
    protected $primaryKey = 'id';
    protected $allowedFields = ['manual', 'lampu_on', 'kipas_on', 'valve_on'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = false;
}
