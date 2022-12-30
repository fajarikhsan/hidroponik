<?php

namespace App\Models;

use CodeIgniter\Model;

class WaktuPenyinaranModel extends Model
{
    protected $table = 'waktu_penyinaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['waktu', 'tanaman_id'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = false;

    public function getWaktuPenyinaranByDate($date, $tanaman_id = '')
    {
        $this->select('MAX(waktu) as max, MIN(waktu) as min');
        $this->where('DATE(waktu)', $date);
        $this->where('tanaman_id', $tanaman_id);
        return $this->first();
    }
}
