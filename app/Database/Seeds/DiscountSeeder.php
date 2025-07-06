<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiscountSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('diskon');

        // Ambil tanggal hari ini
        $today = date('Y-m-d');
        $now = date('Y-m-d H:i:s');

        // Tambahkan 10 data mulai dari hari ini
        for ($i = 0; $i < 10; $i++) {
            $tanggal = date('Y-m-d', strtotime("$today +$i days"));
            $nominal = 100000 + ($i * 10000); // Nominal bertambah

            $builder->insert([
                'tanggal' => $tanggal,
                'nominal' => $nominal,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
