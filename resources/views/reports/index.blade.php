@extends('layouts.app')

@section('title', 'Laporan Keuangan — DompetKu')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

    <div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
            <i class="fa-solid fa-chart-column text-emerald-600"></i>
            Laporan Keuangan
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Ringkasan pemasukan dan pengeluaran berdasarkan periode.
        </p>
    </div>

    <div class="flex flex-col sm:flex-row gap-2">

        {{-- Lihat Transaksi --}}
        <a href="{{ route('transactions.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-bold hover:bg-slate-50 transition">

            <i class="fa-solid fa-receipt"></i>
            Lihat Transaksi

        </a>

        {{-- Export PDF --}}
        <a href="{{ route('reports.pdf', request()->query()) }}"
           target="_blank"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-600 text-white text-sm font-bold hover:bg-rose-700 transition">

            <i class="fa-solid fa-file-pdf"></i>
            Export PDF

        </a>

    </div>

</div>

        <a href="{{ route('transactions.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-600 text-sm font-bold hover:bg-slate-50 transition">

            <i class="fa-solid fa-receipt"></i>
            Lihat Transaksi

        </a>

        <a href="{{ route('reports.pdf', request()->query()) }}"
   target="_blank"
   class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-600 text-white text-sm font-bold hover:bg-rose-700 transition">

    <i class="fa-solid fa-file-pdf"></i>
    Export PDF

</a>

    </div>


    {{-- Filter Periode --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

        <div class="flex items-center gap-2 mb-4">

            <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                <i class="fa-solid fa-calendar-days"></i>
            </div>

            <div>
                <h2 class="font-bold text-slate-900">
                    Periode Laporan
                </h2>

                <p class="text-xs text-slate-500">
                    Pilih rentang tanggal laporan.
                </p>
            </div>

        </div>


        <form method="GET" action="{{ route('reports.index') }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>

                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition"
                    >

                </div>


                <div>

                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                        Sampai Tanggal
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition"
                    >

                </div>

            </div>


            <div class="flex flex-col sm:flex-row gap-3 mt-5">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition">

                    <i class="fa-solid fa-filter"></i>
                    Tampilkan Laporan

                </button>


                <a
                    href="{{ route('reports.index') }}"
                    class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-slate-200 text-slate-600 text-sm font-bold hover:bg-slate-50 transition">

                    <i class="fa-solid fa-rotate-left"></i>
                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Saldo --}}
        <div class="stat-card-gradient-1 text-white p-6 rounded-2xl shadow-lg">

            <div class="flex items-center justify-between">

                <span class="text-xs font-bold uppercase tracking-wider text-slate-300">
                    Saldo
                </span>

                <i class="fa-solid fa-wallet text-emerald-400"></i>

            </div>

            <h3 class="text-2xl font-extrabold mt-5">
                Rp {{ number_format($saldo, 2, ',', '.') }}
            </h3>

        </div>


        {{-- Pemasukan --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">

            <div class="flex items-center justify-between">

                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                    Pemasukan
                </span>

                <span class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                </span>

            </div>

            <h3 class="text-2xl font-extrabold text-emerald-600 mt-5">
                Rp {{ number_format($totalPemasukan, 2, ',', '.') }}
            </h3>

        </div>


        {{-- Pengeluaran --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">

            <div class="flex items-center justify-between">

                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                    Pengeluaran
                </span>

                <span class="w-9 h-9 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-trend-down"></i>
                </span>

            </div>

            <h3 class="text-2xl font-extrabold text-rose-600 mt-5">
                Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}
            </h3>

        </div>


        {{-- Jumlah Transaksi --}}
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">

            <div class="flex items-center justify-between">

                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">
                    Transaksi
                </span>

                <span class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <i class="fa-solid fa-receipt"></i>
                </span>

            </div>

            <h3 class="text-2xl font-extrabold text-slate-900 mt-5">
                {{ number_format($jumlahTransaksi) }}

                <span class="text-sm font-medium text-slate-400">
                    transaksi
                </span>
            </h3>

        </div>

    </div>


    {{-- Pengeluaran berdasarkan kategori --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">

                <i class="fa-solid fa-chart-pie text-emerald-600"></i>

                Pengeluaran Berdasarkan Kategori

            </h2>

            <p class="text-xs text-slate-500 mt-1">
                Kategori dengan pengeluaran terbesar ditampilkan terlebih dahulu.
            </p>

        </div>


        @if($pengeluaranPerKategori->isEmpty())

            <div class="p-12 text-center">

                <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>

                <h4 class="font-bold text-slate-800">
                    Belum Ada Data Pengeluaran
                </h4>

                <p class="text-xs text-slate-500 mt-1">
                    Data akan muncul setelah terdapat transaksi pengeluaran.
                </p>

            </div>

        @else

            <div class="divide-y divide-slate-100">

                @foreach($pengeluaranPerKategori as $item)

                    <div class="p-5 flex items-center justify-between gap-4 hover:bg-slate-50 transition">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 border border-rose-100 flex items-center justify-center">

                                <i class="fa-solid fa-tag"></i>

                            </div>

                            <div>

                                <p class="font-bold text-slate-800">
                                    {{ $item['name'] }}
                                </p>

                                <p class="text-xs text-slate-400">
                                    Total pengeluaran kategori
                                </p>

                            </div>

                        </div>


                        <p class="font-extrabold text-rose-600 whitespace-nowrap">
                            Rp {{ number_format($item['total'], 2, ',', '.') }}
                        </p>

                    </div>

                @endforeach

            </div>

        @endif

    </div>


    {{-- Detail Transaksi --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">

                <i class="fa-solid fa-list text-emerald-600"></i>

                Detail Transaksi

            </h2>

        </div>


        @if($transactions->isEmpty())

            <div class="p-12 text-center">

                <i class="fa-solid fa-inbox text-4xl text-slate-300"></i>

                <p class="font-bold text-slate-700 mt-4">
                    Tidak ada transaksi pada periode ini.
                </p>

            </div>

        @else

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead>

                        <tr class="bg-slate-50 border-b border-slate-100 text-xs font-bold text-slate-500 uppercase">

                            <th class="px-6 py-4">
                                Tanggal
                            </th>

                            <th class="px-6 py-4">
                                Kategori
                            </th>

                            <th class="px-6 py-4">
                                Deskripsi
                            </th>

                            <th class="px-6 py-4">
                                Tipe
                            </th>

                            <th class="px-6 py-4 text-right">
                                Nominal
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach($transactions as $transaction)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">

                                    {{ $transaction->transaction_date
                                        ? $transaction->transaction_date->format('d M Y')
                                        : '-' }}

                                </td>


                                <td class="px-6 py-4">

                                    <span class="font-bold text-slate-800">
                                        {{ $transaction->category->name ?? 'Tanpa Kategori' }}
                                    </span>

                                </td>


                                <td class="px-6 py-4 text-sm text-slate-600">

                                    {{ $transaction->description ?: '-' }}

                                </td>


                                <td class="px-6 py-4">

                                    @if($transaction->type === 'income')

                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">

                                            <i class="fa-solid fa-arrow-up"></i>
                                            Pemasukan

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">

                                            <i class="fa-solid fa-arrow-down"></i>
                                            Pengeluaran

                                        </span>

                                    @endif

                                </td>


                                <td class="px-6 py-4 text-right font-extrabold whitespace-nowrap
                                    {{ $transaction->type === 'income'
                                        ? 'text-emerald-600'
                                        : 'text-rose-600' }}">

                                    {{ $transaction->type === 'income' ? '+' : '-' }}

                                    Rp {{ number_format($transaction->amount, 2, ',', '.') }}

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>
{{-- Grafik --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- Grafik Pemasukan vs Pengeluaran --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="mb-5">

            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-chart-column text-emerald-600"></i>
                Pemasukan vs Pengeluaran
            </h2>

            <p class="text-xs text-slate-500 mt-1">
                Perbandingan kondisi keuangan berdasarkan periode yang dipilih.
            </p>

        </div>

        <div class="relative h-72">
            <canvas id="incomeExpenseChart"></canvas>
        </div>

    </div>


    {{-- Grafik Pengeluaran Kategori --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

        <div class="mb-5">

            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-chart-pie text-emerald-600"></i>
                Pengeluaran per Kategori
            </h2>

            <p class="text-xs text-slate-500 mt-1">
                Distribusi pengeluaran berdasarkan kategori.
            </p>

        </div>

        <div class="relative h-72">
            <canvas id="categoryExpenseChart"></canvas>
        </div>

    </div>

</div>


{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // ==========================================
    // Grafik Pemasukan vs Pengeluaran
    // ==========================================

    const incomeExpenseCanvas =
        document.getElementById('incomeExpenseChart');

    new Chart(incomeExpenseCanvas, {

        type: 'bar',

        data: {

            labels: [
                'Pemasukan',
                'Pengeluaran'
            ],

            datasets: [{

                label: 'Nominal',

                data: [
                    {{ $totalPemasukan }},
                    {{ $totalPengeluaran }}
                ],

                borderWidth: 1

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: false
                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        callback: function(value) {

                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID')
                                    .format(value);

                        }

                    }

                }

            }

        }

    });


    // ==========================================
    // Grafik Pengeluaran per Kategori
    // ==========================================

    const categoryExpenseCanvas =
        document.getElementById('categoryExpenseChart');

    new Chart(categoryExpenseCanvas, {

        type: 'doughnut',

        data: {

            labels: @json($chartKategoriLabels),

            datasets: [{

                data: @json($chartKategoriData),

                borderWidth: 2

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {

                    position: 'bottom'

                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            const value = context.raw;

                            return ' Rp ' +
                                new Intl.NumberFormat('id-ID')
                                    .format(value);

                        }

                    }

                }

            }

        }

    });

</script>


@endsection