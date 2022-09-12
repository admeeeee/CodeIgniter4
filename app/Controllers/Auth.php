<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function __construct(){
        
    }

    public function index(){
        //
    }
    
    public function login(){
        return view('auth/login');
    }
    
    public function verify(){
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        if($username == 'admin' && $password == 'abc123'){
            $this->session->set('username', $username);
            return redirect()->to('dashboard');
        }else{
            return redirect()->to('login');
        }

        
    }
    
    public function logout(){
        $this->session->destroy();
        return redirect()->to('login');
    }
}
