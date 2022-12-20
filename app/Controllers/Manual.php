<?php

namespace App\Controllers;

use App\Models\ManualModel;

class Manual extends BaseController
{
    protected $manualModel;
    public function __construct()
    {
        $this->manualModel = new ManualModel();
    }

    public function index()
    {
        // index
        $data = [
            'title' => 'Manual',
            'manual' => $this->manualModel->first()
        ];
        return view('manual/index', $data);
    }

    public function updateManual()
    {
        $manual = $this->request->getVar('manual');
        $id = 1;
        $manual = ($manual == '1') ? '0' : '1';

        $this->manualModel->save([
            'id' => $id,
            'manual' => $manual
        ]);

        return $manual;
    }

    public function updateLampu()
    {
        $lampu_on = $this->request->getVar('lampu_on');
        $id = 1;
        $lampu_on = ($lampu_on == '1') ? '0' : '1';

        $this->manualModel->save([
            'id' => $id,
            'lampu_on' => $lampu_on
        ]);

        return $lampu_on;
    }

    public function updateKipas()
    {
        $kipas_on = $this->request->getVar('kipas_on');
        $id = 1;
        $kipas_on = ($kipas_on == '1') ? '0' : '1';

        $this->manualModel->save([
            'id' => $id,
            'kipas_on' => $kipas_on
        ]);

        return $kipas_on;
    }

    public function updatePompa()
    {
        $valve_on = $this->request->getVar('valve_on');
        $id = 1;
        $valve_on = ($valve_on == '1') ? '0' : '1';

        $this->manualModel->save([
            'id' => $id,
            'valve_on' => $valve_on
        ]);

        return $valve_on;
    }
}
