<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Package extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT', 
                'unsigned' => true, 
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR', 
                'constraint' => 255
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'price' => [
                'type' => 'INT'
            ],
            'departure' => [
                'type' => 'VARCHAR', 
                'constraint' => 255
            ],
            'destination' => [
                'type' => 'VARCHAR', 
                'constraint' => 255
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('packages');
    }

    public function down()
    {
        $this->forge->dropTable('packages');
    }
}
