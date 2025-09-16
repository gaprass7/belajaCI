<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'     => 'Admin',
                'email'    => 'admin@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
            ],
            [
                'name'     => 'User Demo',
                'email'    => 'user@example.com',
                'password' => password_hash('password', PASSWORD_DEFAULT),
            ],
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
