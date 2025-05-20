<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email'    => 'admin@example.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'roles'    => 'admin',
        ];

        $this->db->table('users')->insert($data);
    }
}
