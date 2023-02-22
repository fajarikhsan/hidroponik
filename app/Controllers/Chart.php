<?php

namespace App\Controllers;

class Chart extends BaseController
{
    protected $logModel;
    public function __construct()
    {
        $this->logModel = new \App\Models\LogModel();
    }

    public function index()
    {
        // index
        $data = [
            'title' => 'Chart'
        ];
        return view('chart/index', $data);
    }

    public function getLog()
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM (SELECT * FROM log ORDER BY id DESC LIMIT 50) a ORDER BY a.id ASC")->getResultArray();
        $source = [];
        foreach ($data as $row) {
            foreach ($row as $key => $val) {
                $source[$key]['value'][] = $val;
                $source[$key]['label'][] = $row['created_at'];
            }
            // $source[] = $key;
        }
        echo json_encode($source);
        // var_dump($source);
    }

    public function getPh()
    {
        $db = db_connect();
        $data = $db->query("SELECT * FROM (SELECT * FROM ph_log ORDER BY id DESC LIMIT 50) a ORDER BY a.id ASC")->getResultArray();
        $source = [];
        foreach ($data as $row) {
            foreach ($row as $key => $val) {
                $source[$key]['value'][] = $val;
                $source[$key]['label'][] = $row['created_at'];
            }
            // $source[] = $key;
        }
        echo json_encode($source);
    }
}
