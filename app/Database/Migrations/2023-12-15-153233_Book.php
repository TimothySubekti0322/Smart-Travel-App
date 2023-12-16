<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Book extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'userId' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'telephone' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'date' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'time' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'packageId' => [
                'type' => 'INT',
                'unsigned' => true
            ],
            'seat' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'ticket' => [
                'type' => 'INT'
            ],
            'total' => [
                'type' => 'INT'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}
