<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\WaktuPenyinaranModel;
use App\Models\SettingModel;
use App\Models\TanamanModel;
use App\Models\ManualModel;

class Api extends BaseController
{
    protected $logModel, $waktuPenyinaranModel, $settingModel, $tanamanModel, $manualModel;
    public function __construct()
    {
        $this->logModel = new LogModel();
        $this->waktuPenyinaranModel = new WaktuPenyinaranModel();
        $this->settingModel = new SettingModel();
        $this->tanamanModel = new TanamanModel();
        $this->manualModel = new ManualModel();
    }

    public function log()
    {
        $suhu_udara = $this->request->getPost('suhu_udara');
        $kelembaban_udara = $this->request->getPost('kelembaban_udara');
        $suhu_air = $this->request->getPost('suhu_air');
        $jarak_air = $this->request->getPost('jarak_air');
        $ph_air = $this->request->getPost('ph_air');
        $tds_air = $this->request->getPost('tds_air');
        $created_at = $this->request->getPost('created_at');
        $exp_datetime = explode(" ", $created_at);
        $exp_date = explode(".", $exp_datetime[0]);
        $date = $exp_date[2] . "-" . $exp_date[1] . "-" . $exp_date[0];
        $time = $exp_datetime[1];
        $datetime = $date . " " . $time;
        // $now = date('Y-m-d H:i:s');
        // $date = explode(' ', $now)[0];

        $log = [
            'suhu_udara' => $suhu_udara,
            'kelembaban_udara' => $kelembaban_udara,
            'suhu_air' => $suhu_air,
            'jarak_air' => $jarak_air,
            'ph_air' => $ph_air,
            'tds_air' => $tds_air,
            'created_at' => $datetime
        ];

        $lamp = [
            'waktu' => $datetime
        ];

        $manual = $this->manualModel->first();
        if ($manual['manual'] == '1') {
            $data = [
                'lampu_on' => ($manual['lampu_on'] == '1') ? TRUE : FALSE,
                'kipas_on' => ($manual['kipas_on'] == '1') ? TRUE : FALSE
            ];
            $tanaman_aktif = $this->tanamanModel->getTanamanAktif();
            if (!empty($tanaman_aktif)) {
                $log['tanaman_id'] = $tanaman_aktif['id'];
            }
        } else {
            $tanaman_aktif = $this->tanamanModel->getTanamanAktif();
            if (!empty($tanaman_aktif)) {
                $log['tanaman_id'] = $tanaman_aktif['id'];
                $lamp['tanaman_id'] = $tanaman_aktif['id'];
                $this->waktuPenyinaranModel->insert($lamp);
                $setting = $this->settingModel->orderBy('created_at', 'DESC')->first();
                $waktu_detik = $this->waktuPenyinaranModel->where('DATE(waktu)', $date)->countAllResults();
                $waktu_detail = $this->secToHR($waktu_detik);
                $data = [
                    'lampu_on' => ($waktu_detik < $setting['lama_penyinaran']) ? TRUE : FALSE,
                    'kipas_on' => ($setting['batas_suhu'] < $suhu_udara) ? TRUE : FALSE
                ];
            } else {
                $data = [
                    'lampu_on' => FALSE,
                    'kipas_on' => FALSE
                ];
            }
        }

        $this->logModel->insert($log);


        echo strval(json_encode($data));
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
