<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class People extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'type' => [
                'type'          => 'SMALLINT',
                'constraint'    => 1,
                'unsigned'      => true,
            ],
            'name' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255'
            ],
            'nickname' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'null'          => true,
            ],
            'inscnum' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'unsigned'      => true,
                'null'          => true,
            ],
            'obs' => [
                'type'          => 'TEXT',
                'null'          => true,
            ],
            'unit' => [
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
        $this->forge->createTable('peoples');
    }

    public function down() {
        $this->forge->dropTable('peoples');
    }
}
