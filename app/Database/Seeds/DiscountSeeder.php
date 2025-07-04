<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('diskon');

        $tanggal_awal = '2025-06-25';
        $now = date('Y-m-d H:i:s');

        for ($i = 0; $i < 10; $i++) {
            $tanggal = date('Y-m-d', strtotime("$tanggal_awal +$i days"));
            $nominal = 100000 + ($i * 10000); // Tambah variasi nominal

            $builder->insert([
                'tanggal' => $tanggal,
                'nominal' => $nominal,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
