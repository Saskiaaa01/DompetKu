<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_category_and_transactions_with_relations(): void
    {
        $category = Category::create([
            'name' => 'Makanan',
            'type' => 'expense',
            'icon' => 'utensils',
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Makanan',
            'type' => 'expense',
            'icon' => 'utensils',
        ]);

        $transaction = $category->transactions()->create([
            'type' => 'expense',
            'amount' => 25000.00,
            'description' => 'Makan Siang',
            'transaction_date' => '2026-08-27',
        ]);

        $this->assertDatabaseHas('transactions', [
            'category_id' => $category->id,
            'amount' => 25000.00,
            'description' => 'Makan Siang',
        ]);

        $this->assertEquals($category->id, $transaction->category->id);
        $this->assertEquals('Makanan', $transaction->category->name);
        $this->assertCount(1, $category->transactions);
    }
}
