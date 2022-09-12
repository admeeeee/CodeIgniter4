<?php

namespace App\Controllers;

//use App\Controllers\BaseController;
use App\Models\APIModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class APIUser extends ResourceController
{
    private $limit = 5;

    public function __construct()
    {
        $this->mod = new APIModel();
        $this->user = new UserModel();
    }

    public function index()
    {
        //
    }

    public function getOffset($page){
        $offset = ($page-1)*$this->limit;
        return $offset;
    }

    public function getTotalPage($totalData){
        $totalPage= ceil($totalData/$this->limit);
        return $totalPage;
    }

    public function list(){
         $page = $this->request->getPost('page');
        if(!$page){$page = 1;}
        $data = $this->mod->list_user($this->limit,$this->getOffset($page));
        $totalData = $this->mod->count_user();
        // $data = $this->user->findAll();

        $array= [
            'page'=> $page,
            'perPage'=> $this->limit,
            'totalPage'=> $this->getTotalPage($totalData),
            'totalData'=> $totalData,
            'data'=> $data,
        ];

        return $this->respond($array);
    }

    public function change(){
        $data= [
            'user_id'=>$this->request->getPost('id'),
            'username'=>$this->request->getPost('username'),
            'fullname'=>$this->request->getPost('fullname'),
            'email'=>$this->request->getPost('email'),
            'password'=>$this->request->getPost('password'),
            'role'=>$this->request->getPost('role'),
        ];

        $data['error']= 'no';
        if($this->user->save($data) === false){
            $data['error'] = 'yes';
            $data['message'] = $this->user->errors();
        }
        
        return $this->respond($data);
    }

    public function remove(){
        $id = $this->request->getPost('id');
        $this->user->delete($id);
    }
}