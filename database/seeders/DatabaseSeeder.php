<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. User default
        User::factory()->create([
            'name' => 'Admin DompetKu',
            'email' => 'admin@dompetku.com',
        ]);

        // 2. Categories
        $gaji = Category::create(['name' => 'Gaji Utama', 'type' => 'income', 'icon' => 'fa-solid fa-money-bill-wave']);
        $freelance = Category::create(['name' => 'Freelance & Project', 'type' => 'income', 'icon' => 'fa-solid fa-laptop-code']);
        $investasi = Category::create(['name' => 'Bonus & Investasi', 'type' => 'income', 'icon' => 'fa-solid fa-chart-line']);

        $makanan = Category::create(['name' => 'Makanan & Minuman', 'type' => 'expense', 'icon' => 'fa-solid fa-utensils']);
        $transport = Category::create(['name' => 'Transportasi', 'type' => 'expense', 'icon' => 'fa-solid fa-car']);
        $belanja = Category::create(['name' => 'Belanja & Kebutuhan', 'type' => 'expense', 'icon' => 'fa-solid fa-cart-shopping']);
        $tagihan = Category::create(['name' => 'Tagihan & Utilitas', 'type' => 'expense', 'icon' => 'fa-solid fa-receipt']);

        // 3. Transactions
        Transaction::create([
            'category_id' => $gaji->id,
            'type' => 'income',
            'amount' => 12500000.00,
            'description' => 'Gaji Bulanan Agustus 2026',
            'transaction_date' => '2026-08-01',
        ]);

        Transaction::create([
            'category_id' => $freelance->id,
            'type' => 'income',
            'amount' => 3500000.00,
            'description' => 'Pembayaran Project Web Redesign',
            'transaction_date' => '2026-08-10',
        ]);

        Transaction::create([
            'category_id' => $tagihan->id,
            'type' => 'expense',
            'amount' => 850000.00,
            'description' => 'Listrik & WiFi Rumah',
            'transaction_date' => '2026-08-12',
        ]);

        Transaction::create([
            'category_id' => $makanan->id,
            'type' => 'expense',
            'amount' => 120000.00,
            'description' => 'Makan Malam Bersama Tim',
            'transaction_date' => '2026-08-20',
        ]);

        Transaction::create([
            'category_id' => $transport->id,
            'type' => 'expense',
            'amount' => 450000.00,
            'description' => 'Bensin & Servis Motor',
            'transaction_date' => '2026-08-22',
        ]);

        Transaction::create([
            'category_id' => $belanja->id,
            'type' => 'expense',
            'amount' => 650000.00,
            'description' => 'Belanja Bulanan Supermarket',
            'transaction_date' => '2026-08-25',
        ]);

        Transaction::create([
            'category_id' => $investasi->id,
            'type' => 'income',
            'amount' => 2000000.00,
            'description' => 'Dividen Saham kuartal 3',
            'transaction_date' => '2026-08-26',
        ]);
    }
}
