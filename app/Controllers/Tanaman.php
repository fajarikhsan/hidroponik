<?php

namespace App\Controllers;

use App\Models\SettingModel;
use App\Models\TanamanModel;

class Tanaman extends BaseController
{
    protected $tanamanModel, $settingModel;
    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->tanamanModel = new TanamanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Tanaman',
            'validation' => \Config\Services::validation(),
            'tanaman' => $this->tanamanModel->orderBy('id, is_active', 'DESC')->findAll()
        ];
        return view('tanaman/index', $data);
    }

    public function create()
    {
        if (!$this->validate([
            'nama_tanaman' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tanaman harus diisi'
                ]
            ],
            'batas_suhu' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Batas suhu harus diisi',
                    'numeric' => 'Batas suhu harus berupa angka'
                ]
            ],
            'lama_penyinaran' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Lama penyinaran harus diisi',
                    'numeric' => 'Lama penyinaran harus berupa angka'
                ]
            ],
        ])) {
            return redirect()->to(base_url('tanaman'))->withInput();
        };

        $nama_tanaman = $this->request->getVar('nama_tanaman');
        $batas_suhu = $this->request->getVar('batas_suhu');
        $lama_penyinaran = $this->request->getVar('lama_penyinaran');
        $tanggal_semai = $this->request->getVar('tanggal_semai');
        $tanggal_tanam = $this->request->getVar('tanggal_tanam');
        $is_active = $this->request->getVar('is_active');

        if ($is_active == '1') {
            $check = $this->tanamanModel->where('is_active', '1')->first();
            if (!empty($check)) {
                session()->setFlashdata('error', 'Data gagal ditambahkan. Hanya boleh ada satu tanaman yang aktif.');
                return redirect()->to(base_url('tanaman'));
            }
        }

        $data = [
            'nama_tanaman' => $nama_tanaman,
            'tanggal_semai' => $tanggal_semai,
            'tanggal_tanam' => $tanggal_tanam,
            'is_active' => $is_active
        ];

        $this->tanamanModel->insert($data);
        $last_insert_id = $this->tanamanModel->getInsertID();

        $setting = [
            'tanaman_id' => $last_insert_id,
            'batas_suhu' => $batas_suhu,
            'lama_penyinaran' => $lama_penyinaran,
            'batas_air' => 0
        ];

        $this->settingModel->insert($setting);
        session()->setFlashdata('success', 'Data berhasil ditambahkan.');
        return redirect()->to(base_url('tanaman'));
    }

    public function getTanaman()
    {
        $tanaman_id = $this->request->getVar('tanaman_id');
        $tanaman = $this->tanamanModel->getTanamanById($tanaman_id);
        echo json_encode($tanaman);
    }

    public function update()
    {
        if (!$this->validate([
            'nama_tanaman_edit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama tanaman harus diisi'
                ]
            ],
            'batas_suhu_edit' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Batas suhu harus diisi',
                    'numeric' => 'Batas suhu harus berupa angka'
                ]
            ],
            'lama_penyinaran_edit' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Lama penyinaran harus diisi',
                    'numeric' => 'Lama penyinaran harus berupa angka'
                ]
            ],
        ])) {
            return redirect()->to(base_url('tanaman'))->withInput();
        };

        $tanaman_id = $this->request->getVar('tanaman_id');
        $setting_id = $this->request->getVar('setting_id');
        $nama_tanaman = $this->request->getVar('nama_tanaman_edit');
        $batas_suhu = $this->request->getVar('batas_suhu_edit');
        $lama_penyinaran = $this->request->getVar('lama_penyinaran_edit');
        $tanggal_semai = $this->request->getVar('tanggal_semai_edit');
        $tanggal_tanam = $this->request->getVar('tanggal_tanam_edit');
        $tanggal_panen = $this->request->getVar('tanggal_panen_edit');
        $is_active = $this->request->getVar('is_active_edit');

        if ($is_active == '1') {
            $check = $this->tanamanModel->where('is_active', '1')->where('id !=', $tanaman_id)->first();
            if (!empty($check)) {
                session()->setFlashdata('error', 'Data gagal ditambahkan. Hanya boleh ada satu tanaman yang aktif.');
                return redirect()->to(base_url('tanaman'));
            }
        }

        $data = [
            'nama_tanaman' => $nama_tanaman,
            'tanggal_semai' => $tanggal_semai,
            'tanggal_tanam' => $tanggal_tanam,
            'tanggal_panen' => $tanggal_panen,
            'is_active' => $is_active
        ];

        $this->tanamanModel->update($tanaman_id, $data);

        $setting = [
            'batas_suhu' => $batas_suhu,
            'lama_penyinaran' => $lama_penyinaran,
            'batas_air' => 0
        ];
        $this->settingModel->update($setting_id, $setting);
        session()->setFlashdata('success', 'Data berhasil diubah.');
        return redirect()->to(base_url('tanaman'));
    }

    public function updateActive()
    {
        $tanaman_id = $this->request->getVar('tanaman_id');
        $is_active = $this->request->getVar('is_active');

        $is_active = ($is_active == '1') ? '0' : '1';
        $data = [
            'is_active' => $is_active
        ];
        $this->tanamanModel->update($tanaman_id, $data);
        echo $is_active;
    }

    public function deleteTanaman()
    {
        $tanaman_id = $this->request->getVar('tanaman_id');
        $this->tanamanModel->delete($tanaman_id);
        echo '1';
    }
}
