<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Contact extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'people_id' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
            ],
            'number' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'descr' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
            ],
            'contact' => [
                'type'          => 'VARCHAR',
                'constraint'    => 255,
                'null'          => true,
            ],
            'active' => [
                'type'          => 'SMALLINT',
                'constraint'    => 1,
                'unsigned'      => true,
                'deafult'       => '1',
                'null'          => true,
            ],
            'created_at' => [
                'type'          => 'TIMESTAMP',
                'default'       => new RawSql('CURRENT_TIMESTAMP'),
                'null'          => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('people_id', 'peoples', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('contacts');
    }

    public function down() {
        $this->forge->dropTable('contacts');
    }
}
