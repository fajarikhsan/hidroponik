<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Profil extends BaseController
{
    protected $akunModel;
    public function __construct()
    {
        $this->akunModel = new AkunModel();
    }

    public function index()
    {
        // index
        $data = [
            'title' => 'Profil',
            'validation' => \Config\Services::validation(),
            'akun' => $this->akunModel->where('username', session('username'))->first()
        ];
        return view('profil/index', $data);
    }

    public function update()
    {
        // update
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[akun.username,id,{id}]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ]
        ])) {
            return redirect()->to(base_url('/profil'))->withInput();
        }

        $this->akunModel->save([
            'id' => $this->request->getVar('id'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password')
        ]);

        session()->setFlashdata('success', 'Data berhasil diubah.');

        return redirect()->to(base_url('/profil'));
    }
}
