<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
{
    $query = Transaction::with('category');

    // Pencarian deskripsi atau nama kategori
    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('description', 'like', '%' . $search . '%')
              ->orWhereHas('category', function ($categoryQuery) use ($search) {
                  $categoryQuery->where('name', 'like', '%' . $search . '%');
              });
        });
    }

    // Filter tipe transaksi
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // Filter kategori
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Filter tanggal mulai
    if ($request->filled('start_date')) {
        $query->whereDate('transaction_date', '>=', $request->start_date);
    }

    // Filter tanggal sampai
    if ($request->filled('end_date')) {
        $query->whereDate('transaction_date', '<=', $request->end_date);
    }

    $transactions = $query
        ->orderBy('transaction_date', 'desc')
        ->orderBy('id', 'desc')
        ->get();

    $categories = Category::orderBy('name')->get();

    return view('transactions.index', compact(
        'transactions',
        'categories'
    ));
}
    public function create()
    {
        $categories = Category::all();

        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        Transaction::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit(Transaction $transaction)
    {
        $categories = Category::all();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui!');
    }
    public function destroy(Transaction $transaction)
{
    $transaction->delete();

    return redirect()
        ->route('transactions.index')
        ->with('success', 'Transaksi berhasil dihapus!');
}
}