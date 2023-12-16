<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('landing');
    }

    public function success(): string
    {
        return view('success');
    }

    public function adminBookChart(): string
    {
        return view('adminBookChart');
    }
}
