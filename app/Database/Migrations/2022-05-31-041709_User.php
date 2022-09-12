<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $fields = [
            
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            
            
        ];
        $this->forge->addColumn('user',$fields);
    }

    public function down()
    {
        //
    }
}
