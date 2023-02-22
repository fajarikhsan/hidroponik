<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\FotoModel;
use App\Controllers\BaseController;

class Log extends BaseController
{
    protected $logModel, $waktuPenyinaranModel, $settingModel, $tanamanModel, $fotoModel;
    public function __construct()
    {
        $this->logModel = new LogModel();
        $this->fotoModel = new FotoModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Log'
        ];
        return view('log/index', $data);
    }

    public function getLog()
    {
        $data = [
            'data' => $this->logModel->orderBy('id', 'DESC')->limit(1000)->find()
        ];
        echo json_encode($data);
    }

    public function getPics()
    {
        $data = [
            'data' => $this->fotoModel->orderBy('id', 'DESC')->limit(1000)->find()
        ];
        echo json_encode($data);
    }



    public function getDetectedPics()
    {
        $foto = $this->fotoModel->where('status_tanaman IS NOT NULL')->orderBy('created_at', 'DESC')->findAll();
        $data = [
            'data' => $foto
        ];
        return view('pics', $data);
    }
}
