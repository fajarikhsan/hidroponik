<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Auth extends BaseController
{
    protected $akunModel;
    public function __construct()
    {
        $this->akunModel = new AkunModel();
    }

    public function index()
    {
        // index
        if (session('logged_in')) {
            return redirect()->to(base_url('/home'));
        }
        return view('login/index');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $akun = $this->akunModel->where('username', $username)->where('password', $password)->first();

        if (!empty($akun)) {
            $data = [
                'id' => $akun['id'],
                'username' => $akun['username'],
                'logged_in' => TRUE
            ];
            session()->set($data);
            return redirect()->to(base_url('/home'));
        } else {
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->to(base_url());
        }
    }

    public function logout()
    {
        // logout
        session()->destroy();
        return redirect()->to(base_url());
    }
}
