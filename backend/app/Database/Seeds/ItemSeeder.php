<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Sample Item 1',
                'description' => 'This is a description for sample item 1',
                'price' => 19.99,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Sample Item 2',
                'description' => 'This is a description for sample item 2',
                'price' => 29.99,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Sample Item 3',
                'description' => 'This is a description for sample item 3',
                'price' => 39.99,
                'status' => 'inactive',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('items')->insertBatch($data);
    }
}