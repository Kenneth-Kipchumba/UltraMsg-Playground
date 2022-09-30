<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Messages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => '5',
                'unsigned' => true,
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'img' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'audio' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'document' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        $this->forge->createTable('messages');
    }

    public function down()
    {
        $this->forge->dropTable('messages');
    }
}
