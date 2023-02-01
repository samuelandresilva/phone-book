<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class User extends Migration {
    public function up() {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'          => 'VARCHAR',
                'constraint'    => '150'
            ],
            'email' => [
                'type'          => 'VARCHAR',
                'constraint'    => '150',
                'unique'        => true,
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => '150',
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
        $this->forge->createTable('users');
    }

    public function down() {
        $this->forge->dropTable('users');
    }
}
