<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeAndCategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Transaction Types
        $pemasukan = TransactionType::firstOrCreate(['name' => 'pemasukan']);
        $pengeluaran = TransactionType::firstOrCreate(['name' => 'pengeluaran']);

        // 2. Seed Default Categories for Pengeluaran
        $pengeluaranCategories = [
            ['name' => 'Makan', 'icon' => 'food'],
            ['name' => 'Belanja', 'icon' => 'shopping'],
            ['name' => 'Transport', 'icon' => 'transport'],
            ['name' => 'Tagihan', 'icon' => 'bills'],
            ['name' => 'Hiburan', 'icon' => 'entertainment'],
            ['name' => 'Sehat', 'icon' => 'health'],
            ['name' => 'Edukasi', 'icon' => 'education'],
            ['name' => 'Lainnya', 'icon' => 'other'],
        ];

        foreach ($pengeluaranCategories as $cat) {
            Category::firstOrCreate([
                'user_id' => null, // null means global default category
                'transaction_type_id' => $pengeluaran->id,
                'name' => $cat['name'],
            ], [
                'icon' => $cat['icon'],
            ]);
        }

        // 3. Seed Default Categories for Pemasukan
        $pemasukanCategories = [
            ['name' => 'Gaji', 'icon' => 'bank'],
            ['name' => 'Investasi', 'icon' => 'wallet-solid'],
            ['name' => 'Lainnya', 'icon' => 'other'],
        ];

        foreach ($pemasukanCategories as $cat) {
            Category::firstOrCreate([
                'user_id' => null,
                'transaction_type_id' => $pemasukan->id,
                'name' => $cat['name'],
            ], [
                'icon' => $cat['icon'],
            ]);
        }
    }
}
