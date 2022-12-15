<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\WaktuPenyinaranModel;
use App\Models\SettingModel;

class Home extends BaseController
{
    protected $logModel, $waktuPenyinaranModel, $settingModel;
    public function __construct()
    {
        $this->logModel = new LogModel();
        $this->waktuPenyinaranModel = new WaktuPenyinaranModel();
        $this->settingModel = new SettingModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        return view('home/index', $data);
    }

    public function get_data()
    {
        $date = date('Y-m-d');
        $log = $this->logModel->orderBy('created_at', 'DESC')->first();
        $lampu = $this->secToHR($this->waktuPenyinaranModel->where('DATE(waktu)', $date)->countAllResults());

        $data = [
            'suhu_udara' => $log['suhu_udara'],
            'kelembaban_udara' => $log['kelembaban_udara'],
            'suhu_air' => $log['suhu_air'],
            'ph_air' => $log['ph_air'],
            'tds_air' => $log['tds_air'],
            'jarak_air' => $log['jarak_air'],
            'lampu' => $lampu
        ];

        echo json_encode($data);
    }

    public function secToHR($seconds)
    {
        $hours_temp = floor($seconds / 3600);
        $minutes_temp = floor(($seconds / 60) % 60);
        $seconds_temp = $seconds % 60;
        $hours = sprintf("%02d", $hours_temp);
        $minutes = sprintf("%02d", $minutes_temp);
        $seconds = sprintf("%02d", $seconds_temp);
        return "$hours:$minutes:$seconds";
    }
}
