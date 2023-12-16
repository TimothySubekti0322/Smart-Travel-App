<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\User;

class Register extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('register');
    }

    public function register()
    {
         $rules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'username' => 'required',
            'password' => 'required',
        ];

        if ($this->validate($rules)) {
            $data = [
                'email' => $this->request->getPost('email'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role') == 'admin' ? 'admin' : 'user',
            ];

            $userModel = new User;
            $userModel->insert($data);

            return redirect()->to('/login?message=success');
        }
        return $this->respond([
            'message' => $this->validator->getErrors(),
            'status' => 400
        ], 400);
    }
}
