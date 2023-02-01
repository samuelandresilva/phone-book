<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder {
    public function run() {
        $data = [
            'name'      => 'Administrator',
            'email'     => 'admin@admin.com',
            'password'  => '$2y$10$ZDlXFOJPZftK2i48/xNnCeRNr0IAHyFSO6Tcbc35drD8IWVeUgTvm', // admin + BCRYPT
            'unit'      => 1,
        ];

        $this->db->table('users')->insert($data);
    }
}
