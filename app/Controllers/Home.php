<?php

namespace App\Controllers;

use DateTime;
use App\Models\LogModel;
use App\Models\SettingModel;
use App\Models\WaktuPenyinaranModel;
use App\Models\TanamanModel;
use App\Models\FotoModel;

class Home extends BaseController
{
    protected $logModel, $waktuPenyinaranModel, $settingModel, $tanamanModel, $fotoModel;
    public function __construct()
    {
        $this->logModel = new LogModel();
        $this->waktuPenyinaranModel = new WaktuPenyinaranModel();
        $this->settingModel = new SettingModel();
        $this->tanamanModel = new TanamanModel();
        $this->fotoModel = new FotoModel();
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
        $foto = $this->fotoModel->orderBy('created_at', 'DESC')->first();
        $tanaman_aktif = $this->tanamanModel->getTanamanAktif();
        if (!empty($tanaman_aktif)) {
            $tanaman_aktif = $tanaman_aktif['id'];
            $minMax = $this->waktuPenyinaranModel->getWaktuPenyinaranByDate($date, $tanaman_aktif);
            $sec = (!empty($minMax)) ? $this->dateDiff($minMax['min'], $minMax['max']) : 0;
            $lampu = $this->secToHR($sec);
        } else {
            $lampu = 'Tidak Ada Tanaman Aktif';
        }

        $data = [
            'suhu_udara' => $log['suhu_udara'],
            'kelembaban_udara' => $log['kelembaban_udara'],
            'suhu_air' => $log['suhu_air'],
            'ph_air' => $log['ph_air'],
            'tds_air' => $log['tds_air'],
            'jarak_air' => $log['jarak_air'],
            'lampu' => $lampu,
            'foto' => $foto
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

    public function dateDiff($date1, $date2)
    {
        // Create two new DateTime-objects...
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);

        $diff = $date2->getTimestamp() - $date1->getTimestamp();
        return $diff;
    }
}
