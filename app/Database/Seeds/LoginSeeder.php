<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LoginSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'user_name' => 'admin',
            'password'  => password_hash('password', PASSWORD_DEFAULT),
            'name'      => 'Administrator',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ];

        $this->db->table('login_details')->insert($data);
    }
}
