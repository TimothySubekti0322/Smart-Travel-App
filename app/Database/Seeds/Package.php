<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Package extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Executive',
            'description'    => 'Toyota hi-ace-8',
            'price' => 100000,
            'departure' => 'Jakarta',
            'destination' => 'Bandung'
        ];

        $data2 = [
            'name' => 'Executive',
            'description'    => 'Toyota hi-ace-8',
            'price' => 100000,
            'departure' => 'Bandung',
            'destination' => 'Jakarta'
        ];

        $data3 = [
            'name' => 'Business',
            'description'    => 'Toyota hi-ace-premio-8',
            'price' => 150000,
            'departure' => 'Malang',
            'destination' => 'Bandung'
        ];

        $data4 = [
            'name' => 'Business',
            'description'    => 'Toyota hi-ace-premio-8',
            'price' => 175000,
            'departure' => 'Jakarta',
            'destination' => 'Malang'
        ];

        $data5 = [
            'name' => 'luxury',
            'description'    => 'Toyota hi-ace-lux-8',
            'price' => 200000,
            'departure' => 'Bandung',
            'destination' => 'Yogyakarta'
        ];

        $this->db->table('packages')->insert($data);
        $this->db->table('packages')->insert($data2);
        $this->db->table('packages')->insert($data3);
        $this->db->table('packages')->insert($data4);
        $this->db->table('packages')->insert($data5);
    }
}

