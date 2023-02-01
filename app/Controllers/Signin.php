<?php

namespace App\Controllers;

use App\Models\UserModel;

class Signin extends BaseController {
    public function index() {
        helper(['form']);
        echo view('signin');
    }

    public function loginAuth() {
        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $data = $userModel->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'unit' => $data['unit'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/phone-book');
            } else {
                $session->setFlashdata('msg', lang('General.signin.dataNotMatch'));
                return redirect()->to('/signin');
            }
        } else {
            $session->setFlashdata('msg', lang('General.signin.userNotFound'));
            return redirect()->to('/signin');
        }
    }

    public function logout() {
        session()->destroy();
        return redirect()->to("/signin");
    }
}
