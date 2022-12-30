<?php

namespace App\Controllers;

use DateTime;
use App\Models\LogModel;
use App\Models\ManualModel;
use App\Models\SettingModel;
use App\Models\TanamanModel;
use App\Models\WaktuPenyinaranModel;

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
                $minMax = $this->waktuPenyinaranModel->getWaktuPenyinaranByDate($date, $tanaman_aktif['id']);
                $waktu_detik = (!empty($minMax)) ? $this->dateDiff($minMax['min'], $minMax['max']) : 0;
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

    public function dateDiff($date1, $date2)
    {
        // Create two new DateTime-objects...
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);

        $diff = $date2->getTimestamp() - $date1->getTimestamp();
        return $diff;
    }

    public function test()
    {
        $tanaman_aktif = 1;
        $date = date('Y-m-d');
        $minMax = $this->waktuPenyinaranModel->getWaktuPenyinaranByDate($date, $tanaman_aktif);
        $sec = (!empty($minMax)) ? $this->dateDiff($minMax['min'], $minMax['max']) : 0;
        $lampu = $this->secToHR($sec);
        // echo $lampu;
        var_dump($minMax);
    }
}
