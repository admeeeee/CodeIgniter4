<?php

namespace App\Models;

use CodeIgniter\Model;

class APIModel extends Model
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    
    public function list_user($limit, $offset){
        $db = $this->db->table('user');
        $db->select('user_id, username, fullname, role, email');
        $db->limit($limit, $offset);
        $result = $db->get()->getResultArray();
        return $result;
    }

    public function count_user(){
        $db = $this->db->table('user');
        $result = $db->countAllResults();
        return $result;
    }
}
