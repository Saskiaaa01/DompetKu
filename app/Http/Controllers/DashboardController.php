<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPemasukan = (float) Transaction::where('type', 'income')->sum('amount');
        $totalPengeluaran = (float) Transaction::where('type', 'expense')->sum('amount');
        $totalSaldo = $totalPemasukan - $totalPengeluaran;
        $totalTransaksi = Transaction::count();
        $startOfMonth = now()->startOfMonth();
$endOfMonth = now()->endOfMonth();

$monthlyIncome = (float) Transaction::where('type', 'income')
    ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
    ->sum('amount');

$monthlyExpense = (float) Transaction::where('type', 'expense')
    ->whereBetween('transaction_date', [$startOfMonth, $endOfMonth])
    ->sum('amount');

$monthlyBalance = $monthlyIncome - $monthlyExpense;

        $recentTransactions = Transaction::with('category')
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Data grafik 6 bulan terakhir
        $monthlyData = Transaction::selectRaw("
                strftime('%Y-%m', transaction_date) as month,
                type,
                SUM(amount) as total
            ")
            ->where('transaction_date', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('month', 'type')
            ->orderBy('month')
            ->get();

        $chartLabels = [];
        $incomeData = [];
        $expenseData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);

            $monthKey = $date->format('Y-m');

            $chartLabels[] = $date->translatedFormat('M Y');

            $incomeData[] = (float) (
                $monthlyData
                    ->where('month', $monthKey)
                    ->where('type', 'income')
                    ->first()
                    ->total ?? 0
            );

            $expenseData[] = (float) (
                $monthlyData
                    ->where('month', $monthKey)
                    ->where('type', 'expense')
                    ->first()
                    ->total ?? 0
            );
        }

        $categoryExpenses = Transaction::with('category')
    ->where('type', 'expense')
    ->selectRaw('category_id, SUM(amount) as total')
    ->groupBy('category_id')
    ->orderByDesc('total')
    ->get();

$categoryLabels = $categoryExpenses->map(function ($item) {
    return $item->category->name ?? 'Tanpa Kategori';
})->values();

$categoryData = $categoryExpenses->map(function ($item) {
    return (float) $item->total;
})->values();

$topExpenseCategory = $categoryExpenses->first();

if ($topExpenseCategory) {
    $topCategoryName = $topExpenseCategory->category->name ?? 'Tanpa Kategori';
    $topCategoryAmount = (float) $topExpenseCategory->total;
} else {
    $topCategoryName = null;
    $topCategoryAmount = 0;
}

       return view('dashboard', compact(
    'totalSaldo',
    'totalPemasukan',
    'totalPengeluaran',
    'totalTransaksi',
    'recentTransactions',
    'chartLabels',
    'incomeData',
    'expenseData',
    'categoryLabels',
    'categoryData',
    'topCategoryName',
    'topCategoryAmount',
    'monthlyIncome',
    'monthlyExpense',
    'monthlyBalance'
));
        
    }
}