<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_page_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    public function test_dashboard_alias_route_loads_successfully(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
    }

    public function test_dashboard_calculates_financial_summary_correctly(): void
    {
        $categoryIncome = Category::create([
            'name' => 'Gaji',
            'type' => 'income',
            'icon' => 'fa-wallet',
        ]);

        $categoryExpense = Category::create([
            'name' => 'Makan',
            'type' => 'expense',
            'icon' => 'fa-utensils',
        ]);

        // Income: 10,000,000 + 5,000,000 = 15,000,000
        Transaction::create([
            'category_id' => $categoryIncome->id,
            'type' => 'income',
            'amount' => 10000000.00,
            'description' => 'Gaji Pokok',
            'transaction_date' => '2026-08-01',
        ]);

        Transaction::create([
            'category_id' => $categoryIncome->id,
            'type' => 'income',
            'amount' => 5000000.00,
            'description' => 'Bonus Project',
            'transaction_date' => '2026-08-05',
        ]);

        // Expense: 2,000,000 + 1,500,000 = 3,500,000
        Transaction::create([
            'category_id' => $categoryExpense->id,
            'type' => 'expense',
            'amount' => 2000000.00,
            'description' => 'Sewa Kos',
            'transaction_date' => '2026-08-02',
        ]);

        Transaction::create([
            'category_id' => $categoryExpense->id,
            'type' => 'expense',
            'amount' => 1500000.00,
            'description' => 'Belanja Bulanan',
            'transaction_date' => '2026-08-10',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);

        // Assert calculated values passed to view
        $response->assertViewHas('totalPemasukan', 15000000.00);
        $response->assertViewHas('totalPengeluaran', 3500000.00);
        $response->assertViewHas('totalSaldo', 11500000.00);
        $response->assertViewHas('totalTransaksi', 4);
    }

    public function test_dashboard_displays_top_5_recent_transactions_with_category_details(): void
    {
        $category = Category::create([
            'name' => 'Transportasi',
            'type' => 'expense',
            'icon' => 'fa-car',
        ]);

        // Create 7 transactions with distinct dates
        for ($i = 1; $i <= 7; $i++) {
            Transaction::create([
                'category_id' => $category->id,
                'type' => 'expense',
                'amount' => 10000 * $i,
                'description' => "Bensin $i",
                'transaction_date' => "2026-08-0$i",
            ]);
        }

        $response = $this->get('/');

        $response->assertStatus(200);
        $recentTransactions = $response->viewData('recentTransactions');

        // Should only return 5 recent transactions
        $this->assertCount(5, $recentTransactions);

        // Transaction date of first item should be the latest (2026-08-07)
        $this->assertEquals('2026-08-07', $recentTransactions->first()->transaction_date->format('Y-m-d'));
        $this->assertEquals('Transportasi', $recentTransactions->first()->category->name);
        $this->assertEquals('fa-car', $recentTransactions->first()->category->icon);
        $this->assertEquals('Bensin 7', $recentTransactions->first()->description);

        $response->assertSee('Transportasi');
        $response->assertSee('Bensin 7');
        $response->assertSee('Rp 70.000,00');
    }
}
