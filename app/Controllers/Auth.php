<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function loginPost()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $model = new LoginModel();
        $user = $model->where('user_name', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'id'          => $user['id'],
                'name'        => $user['name'],
                'isLoggedIn'  => true,
            ]);
            return redirect()->to('/employees');
        }

        return redirect()->back()->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
