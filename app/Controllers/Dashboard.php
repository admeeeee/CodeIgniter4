<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        dd($this->session->get());
        echo 'ini dashboard';
    }
}
