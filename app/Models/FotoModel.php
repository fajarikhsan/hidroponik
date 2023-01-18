<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoModel extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'id';
    protected $allowedFields = ['file_name', 'status_tanaman', 'tanaman_id', 'tomat', 'bunga'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;

    public function getFoto()
    {
        return $this->findAll();
    }
}
