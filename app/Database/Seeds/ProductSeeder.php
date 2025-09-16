<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'        => 'Kopi Hitam',
                'price'       => 15000,
                'stock'       => 20,
                'description' => 'Kopi hitam robusta khas Indonesia',
                'image'       => 'kopi_hitam.jpg',
            ],
            [
                'name'        => 'Teh Hijau',
                'price'       => 12000,
                'stock'       => 30,
                'description' => 'Teh hijau segar dengan aroma khas',
                'image'       => 'teh_hijau.jpg',
            ],
            [
                'name'        => 'Coklat Panas',
                'price'       => 20000,
                'stock'       => 15,
                'description' => 'Minuman coklat panas creamy',
                'image'       => 'coklat_panas.jpg',
            ],
        ];

        $this->db->table('products')->insertBatch($data);
    }
}
