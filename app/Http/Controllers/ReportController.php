<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('category');

        // Filter tanggal mulai
        if ($request->filled('start_date')) {
            $query->whereDate(
                'transaction_date',
                '>=',
                $request->start_date
            );
        }

        // Filter tanggal akhir
        if ($request->filled('end_date')) {
            $query->whereDate(
                'transaction_date',
                '<=',
                $request->end_date
            );
        }

        $transactions = $query
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $totalPemasukan = $transactions
            ->where('type', 'income')
            ->sum('amount');

        $totalPengeluaran = $transactions
            ->where('type', 'expense')
            ->sum('amount');

        $saldo = $totalPemasukan - $totalPengeluaran;

        $jumlahTransaksi = $transactions->count();

        $pengeluaranPerKategori = $transactions
            ->where('type', 'expense')
            ->groupBy('category_id')
            ->map(function ($items) {
                return [
                    'name' => $items->first()->category->name ?? 'Tanpa Kategori',
                    'total' => $items->sum('amount'),
                ];
            })
            ->sortByDesc('total');
        
        $chartKategoriLabels = $pengeluaranPerKategori
    ->pluck('name')
    ->values();

$chartKategoriData = $pengeluaranPerKategori
    ->pluck('total')
    ->map(fn ($total) => (float) $total)
    ->values();

     return view('reports.index', compact(
    'transactions',
    'totalPemasukan',
    'totalPengeluaran',
    'saldo',
    'jumlahTransaksi',
    'pengeluaranPerKategori',
    'chartKategoriLabels',
    'chartKategoriData'
));
    }

    public function pdf(Request $request)
    {
        $query = Transaction::with('category');

        if ($request->filled('start_date')) {
            $query->whereDate(
                'transaction_date',
                '>=',
                $request->start_date
            );
        }

        if ($request->filled('end_date')) {
            $query->whereDate(
                'transaction_date',
                '<=',
                $request->end_date
            );
        }

        $transactions = $query
            ->orderBy('transaction_date', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        $totalPemasukan = $transactions
            ->where('type', 'income')
            ->sum('amount');

        $totalPengeluaran = $transactions
            ->where('type', 'expense')
            ->sum('amount');

        $saldo = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('reports.pdf', compact(
            'transactions',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));

        return $pdf->stream('laporan-keuangan-dompetku.pdf');
    }
}