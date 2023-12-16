<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Book extends Seeder
{
    public function run()
    {
        $data = [
            'userId' => 2,
            'name' => 'user',
            'email' => 'user@gmail.com',
            'telephone' => '081234567890',
            'date' => '24/12/2023',
            'time' => '12:00',
            'packageId' => 1,
            'seat' => 'S1,S5,S6',
            'ticket' => 3,
            'total' => 300000
        ];

        $data2 = [
            'userId' => 2,
            'name' => 'user',
            'email' => 'user@gmail.com',
            'telephone' => '081234567890',
            'date' => '25/12/2023',
            'time' => '12:00',
            'packageId' => 2,
            'seat' => 'S1,S5,S7',
            'ticket' => 3,
            'total' => 300000
        ];

        $data3 = [
            'userId' => 2,
            'name' => 'user',
            'email' => 'user@gmail.com',
            'telephone' => '081234567890',
            'date' => '25/12/2023',
            'time' => '12:00',
            'packageId' => 1,
            'seat' => 'S1,S5',
            'ticket' => 2,
            'total' => 200000
        ];

        $data4 = [
            'userId' => 2,
            'name' => 'user',
            'email' => 'user@gmail.com',
            'telephone' => '081234567890',
            'date' => '26/12/2023',
            'time' => '08:00',
            'packageId' => 4,
            'seat' => 'S10,S11,S12',
            'ticket' => 3,
            'total' => 525000
        ];

        $this->db->table('books')->insert($data);
        $this->db->table('books')->insert($data2);
        $this->db->table('books')->insert($data3);
        $this->db->table('books')->insert($data4);
    }
}
