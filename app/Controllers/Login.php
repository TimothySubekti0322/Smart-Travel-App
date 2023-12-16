<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\API\ResponseTrait;
use \Firebase\JWT\JWT;

class Login extends BaseController
{

    use ResponseTrait;

    public function index()
    {
        $message = $this->request->getGet('message');
        $data['message'] = $message;
        return view('login', $data);
    }

    public function auth(){

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new User;
        
        $user = $userModel->where('email', $email)->first();
        
        
        if (!$user) {
            return $this->respond([
                'status' => 404,
                'message' => 'Email not found'
            ], 404);
        }
        
        if (!password_verify($password, $user['password'])) {
            return $this->respond([
                'status' => 401,
                'message' => 'Password not match'
            ], 401);
        }
        
        
        $key = "d2ff7174120474a55903c47ec1b44ccb672ef3d889ea24be72650eba1ae40d57";


        $iat = time();
        $exp = $iat + (3600 * 60);
       
        $payload = [
            'iss' => 'c14-jwt',
            'aud' => 'logintoken',
            'iat' => $iat,
            'exp' => $exp,
            'data' => [
                'id' => $user['id'],
                'name' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
            ]
        ];

        $token = JWT::encode($payload, $key, "HS256");

        $exp = time() + (3600 * 60);

        setcookie('token', $token, $exp, '/');
        setcookie('payload', json_encode($payload['data']), $exp, '/');

        return redirect()->route('/');
    }
}
