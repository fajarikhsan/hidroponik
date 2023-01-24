<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\FotoModel;
use App\Models\SettingModel;
use App\Models\TanamanModel;
use App\Models\WaktuPenyinaranModel;
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
            'data' => $this->logModel->orderBy('id', 'DESC')->findAll()
        ];
        echo json_encode($data);
    }

    public function getPics()
    {
        $data = [
            'data' => $this->fotoModel->orderBy('id', 'DESC')->findAll()
        ];
        echo json_encode($data);
    }
}
