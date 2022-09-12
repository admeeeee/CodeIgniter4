<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{

    public function __construct()
    {
        $this->mod = new UserModel();
        //$this->mod = model('App\Models\UserModel');
    }

    public function index()
    {
        //
    }

    public function create(){
        $data['error'] = $this->session->getFlashData('error');
        $this->render('user/create',$data);
        //return view('user/create',$data);
    }

    public function save(){
        $data = [
            'user_id' => $this->request->getPost('id'),
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role' => $this->request->getPost('role'),
        ];
        //dd($data);
        if($this->mod->save($data) === false){
            //dd($this->mod->errors());
            $error = $this->mod->errors();
            return redirect()->back()->withInput()->with('error', $error);
        }

        return redirect()->to('/user/listing');
    }

    public function update($id){
        $data['user'] = $this->mod->find($id);
        $data['error'] = $this->session->getFlashData('error');
        $this->render('user/update',$data);
    }

    public function delete($id){
        $this->mod->delete($id);
        return redirect()->to('/user/listing');
    }

    public function generate(){
        $faker = \Faker\Factory::create('ms_MY');
        echo $faker->name();
        echo '<br>';
        echo $faker->username();
        echo '<br>';
        echo $faker->email();
        echo '<br>';
        echo $faker->state();

        $data = [
            'username' => $faker->username(),
            'fullname' => $faker->name(),
            'email' => $faker->email(),
            'password' => 'abc123',
            'role' => '2'
        ];
        $this->mod->insert($data);
    }

    public function listing(){
        $data['users'] = $this->mod ->join('role',  'role_id = role')
                                    ->findAll();
        //dd($users);
        $this->render('user/listing', $data);
    }

    public function vlisting(){
        $data['data'] = '';
        $this->render('user/vlisting', $data);
    }
}
