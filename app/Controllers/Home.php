<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;
    public function index(): string
    {
        return view('landing');
    }

    public function success(): string
    {
        return view('success');
    }

    public function adminBookChart()
    {

        // Check Role
        helper('cookie');
        $cookie = get_cookie('payload');
        $cookie = $cookie ? json_decode($cookie) : null;
        $role = $cookie ? $cookie->role : null;

        if ($role != 'admin') {
            return redirect()->to('/403');
        }

        return view('adminBookChart');
    }

    public function listPackage() : string
    {
        helper('cookie');
        $cookie = get_cookie('payload');
        $cookie = $cookie ? json_decode($cookie) : null;
        $role = $cookie ? $cookie->role : null;

        if ($role != 'admin') {
            return redirect()->to('/403');
        }
        return view('listPackage');
    }

    public function adminHotelChart() : string
    {
        helper('cookie');
        $cookie = get_cookie('payload');
        $cookie = $cookie ? json_decode($cookie) : null;
        $role = $cookie ? $cookie->role : null;

        if ($role != 'admin') {
            return redirect()->to('/403');
        }
        return view('adminHotelChart');
    }

    public function forbidden() : string
    {
        return view('403');
    }
}
