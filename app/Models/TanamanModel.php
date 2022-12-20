<?php

namespace App\Models;

use CodeIgniter\Model;

class TanamanModel extends Model
{
    protected $table = 'tanaman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_tanaman', 'tanggal_semai', 'tanggal_tanam', 'is_active', 'tanggal_panen'];
    protected $useAutoIncrement = true;
    protected $useTimestamps = false;

    public function getTanamanAktif()
    {
        $this->select('tanaman.id');
        $this->join('setting', 'setting.tanaman_id = tanaman.id', 'inner');
        $this->where('is_active', '1');
        return $this->first();
    }

    public function getTanamanById($id)
    {
        $this->select('*, tanaman.id as tanaman_id, setting.id as setting_id');
        $this->join('setting', 'setting.tanaman_id = tanaman.id', 'inner');
        $this->where('tanaman.id', $id);
        return $this->first();
    }
}
