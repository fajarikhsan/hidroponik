<?php

namespace App\Controllers;

use DateTime;
use App\Models\LogModel;
use App\Models\ManualModel;
use App\Models\SettingModel;
use App\Models\TanamanModel;
use App\Models\WaktuPenyinaranModel;
use App\Models\FotoModel;
use App\Models\ObjectDetectionModel;

class Api extends BaseController
{
    protected $logModel, $waktuPenyinaranModel, $settingModel, $tanamanModel, $manualModel, $fotoModel, $objectDetectionModel;
    public function __construct()
    {
        $this->logModel = new LogModel();
        $this->waktuPenyinaranModel = new WaktuPenyinaranModel();
        $this->settingModel = new SettingModel();
        $this->tanamanModel = new TanamanModel();
        $this->manualModel = new ManualModel();
        $this->fotoModel = new FotoModel();
        $this->objectDetectionModel = new ObjectDetectionModel();
    }

    public function log()
    {
        $suhu_udara = $this->request->getPost('suhu_udara');
        $kelembaban_udara = $this->request->getPost('kelembaban_udara');
        $suhu_air = $this->request->getPost('suhu_air');
        $jarak_air = $this->request->getPost('jarak_air');
        $ph_air = $this->request->getPost('ph_air');
        $tds_air = $this->request->getPost('tds_air');
        $valve_on = $this->request->getPost('valve_on');
        // $created_at = $this->request->getPost('created_at');
        // $exp_datetime = explode(" ", $created_at);
        // $exp_date = explode(".", $exp_datetime[0]);
        // $date = $exp_date[2] . "-" . $exp_date[1] . "-" . $exp_date[0];
        // $time = $exp_datetime[1];
        // $datetime = $date . " " . $time;
        $now = date('Y-m-d H:i:s');
        $date = explode(' ', $now)[0];
        $time = explode(' ', $now)[1];
        $hour = explode(':', $time)[0];

        $log = [
            'suhu_udara' => $suhu_udara,
            'kelembaban_udara' => $kelembaban_udara,
            'suhu_air' => $suhu_air,
            'jarak_air' => $jarak_air,
            'ph_air' => $ph_air,
            'tds_air' => $tds_air,
            'created_at' => $now
        ];

        $lamp = [
            'waktu' => $now
        ];

        $manual = $this->manualModel->first();
        if ($manual['manual'] == '1') {
            $data = [
                'lampu_on' => ($manual['lampu_on'] == '1') ? TRUE : FALSE,
                'kipas_on' => ($manual['kipas_on'] == '1') ? TRUE : FALSE,
                'valve_on' => ($manual['valve_on'] == '1') ? TRUE : FALSE
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
                $setting = $this->settingModel->where('tanaman_id', $tanaman_aktif['id'])->first();
                $lampu_on = FALSE;
                if ($hour >= 6) {
                    $this->waktuPenyinaranModel->insert($lamp);
                    $minMax = $this->waktuPenyinaranModel->getWaktuPenyinaranByDate($date, $tanaman_aktif['id']);
                    $waktu_detik = (!empty($minMax)) ? $this->dateDiff($minMax['min'], $minMax['max']) : 0;
                    $lampu_on = ($waktu_detik < $setting['lama_penyinaran']) ? TRUE : FALSE;
                }
                $data = [
                    'lampu_on' => $lampu_on,
                    'kipas_on' => ($setting['batas_suhu'] < $suhu_udara) ? TRUE : FALSE,
                    'valve_on' => ($jarak_air <= $setting['batas_air']) ? TRUE : (($jarak_air >= 20) ? FALSE : $valve_on)
                    // 'valve_on' => $valve_on
                ];
            } else {
                $data = [
                    'lampu_on' => FALSE,
                    'kipas_on' => FALSE,
                    'valve_on' => FALSE
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

    public function foto()
    {
        if (!$this->validate([
            'foto' => [
                'uploaded[foto]',
                'mime_in[foto,image/png,image/jpg,image/jpeg,image/gif]',
                'ext_in[foto,png,jpg,gif,jpeg]'
            ],
        ])) {
            echo implode(" ", $this->validator->getErrors());
            return;
        };

        $foto = $this->request->getFile('foto');
        $file_name = $foto->getRandomName();
        $foto->move('foto', $file_name);

        $tanaman_aktif = $this->tanamanModel->getTanamanAktif();
        if (!empty($tanaman_aktif)) {
            $data = [
                'file_name' => $file_name,
                'status_tanaman' => NULL,
                'tanaman_id' => $tanaman_aktif['id']
            ];
            $fotoDataFirst = $this->fotoModel->orderBy('created_at', 'DESC')->first();
            $now = date('Y-m-d H:i:s');
            $diff = $this->dateDiff($fotoDataFirst['created_at'], $now);
            $exp = explode(':', $this->secToHR($diff));
            $minute = (int) $exp[1];
            if (empty($fotoDataFirst) || $minute >= 1) {
                $this->fotoModel->insert($data);
                $foto_id = $this->fotoModel->getInsertID();
                $fotoData = $this->fotoModel->where('status_tanaman IS NOT NULL')->orderBy('created_at', 'DESC')->first();
                $diff = $this->dateDiff($fotoData['created_at'], $now);
                $exp = explode(':', $this->secToHR($diff));
                $hour = (int) $exp[0];
                if (empty($fotoData) || $hour >= 6) {
                    $detection = $this->object_detection($file_name, $foto_id);
                    if ($detection['status'] == 'success') {
                        if ($detection['tomato'] == TRUE || $detection['flower'] == TRUE) {
                            $status_tanaman = 'GENERATIF';
                        } else {
                            $status_tanaman = 'VEGETATIF';
                        }
                        $update = [
                            'status_tanaman' => $status_tanaman,
                            'tomat' => ($detection['tomato']) ? '1' : '0',
                            'bunga' => ($detection['flower']) ? '1' : '0'
                        ];
                        $this->fotoModel->update($foto_id, $update);
                    }
                }
            }
        }
        echo "ok";
    }

    public function object_detection($img, $foto_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_URL => "https://api.chooch.ai/predict/object_detection/?model_id=1982&apikey=9474114e-3f6f-425b-9cbf-6f8e947cbe0a", CURLOPT_RETURNTRANSFER => true, CURLOPT_ENCODING => "", CURLOPT_MAXREDIRS => 10, CURLOPT_TIMEOUT => 0, CURLOPT_FOLLOWLOCATION => false, CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1, CURLOPT_CUSTOMREQUEST => "POST", CURLOPT_POSTFIELDS => array('image' => new \CURLFILE(FCPATH . '/foto/' . $img, 'image/jpeg', $img)),));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $result = [];
        if ($err) {
            $result = [
                'status' => 'error',
                'message' => $err
            ];
        } else {
            $tomato = FALSE;
            $flower = FALSE;
            $json = json_decode($response, true);
            $predictions = $json['predictions'];
            $objects = [];
            foreach ($predictions as $prediction) {
                if (strpos(strtolower($prediction['class_title']), 'tomato') === false) {
                } else {
                    $tomato = TRUE;
                }
                if (strpos(strtolower($prediction['class_title']), 'flower') === false) {
                } else {
                    $flower = TRUE;
                }
                $objects[] = [
                    'class_title' => $prediction['class_title'],
                    'score' => $prediction['score'],
                    'foto_id' => $foto_id
                ];
            }
            $result = [
                'status' => 'success',
                'tomato' => $tomato,
                'flower' => $flower,
                'objects' => $objects
            ];

            if (!empty($objects)) {
                $this->objectDetectionModel->insertBatch($objects);
            }
        }
        return $result;
    }
}
