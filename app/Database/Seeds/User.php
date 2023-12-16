<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            'email' => 'admin@gmail.com',
            'username'    => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'role' => 'admin'
        ];

        $data2 = [
            'email' => 'user@gmail.com',
            'username'    => 'user',
            'password' => password_hash('user', PASSWORD_DEFAULT),
            'role' => 'user'
        ];

        $this->db->table('users')->insert($data);
        $this->db->table('users')->insert($data2);
    }
}
