<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Logout extends BaseController
{
    public function index()
    {
        setcookie('token', "");
        setcookie('payload', time() - 3600);
        return redirect()->to('/login');
    }
}
