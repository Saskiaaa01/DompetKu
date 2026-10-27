@extends('layouts.app')

@section('title', 'Dashboard Keuangan — DompetKu')

@section('content')
<div class="space-y-8">
    <!-- Header Page Banner -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-xs">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2.5">
                <span>Dashboard Keuangan</span>
                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                    Live Data
                </span>
            </h1>
            <p class="text-slate-500 text-sm mt-1">Ringkasan statistik saldo, pemasukan, pengeluaran, serta aktivitas transaksi terkini.</p>
        </div>
        <div class="flex items-center gap-3">

    <a href="{{ route('reports.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition shadow-sm">
        <i class="fa-solid fa-chart-column"></i>
        Laporan
    </a>

    <a href="{{ route('reports.pdf') }}"
       target="_blank"
       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-bold hover:bg-slate-800 transition shadow-sm">
        <i class="fa-solid fa-file-pdf"></i>
        PDF
    </a>

</div>
    </div>

    <!-- Overview Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Total Saldo -->
        <div class="stat-card-gradient-1 text-white p-6 rounded-2xl shadow-lg relative overflow-hidden flex flex-col justify-between min-h-[160px]">
            <div class="absolute -right-4 -bottom-4 opacity-10 text-white text-8xl pointer-events-none">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Total Saldo</span>
                <span class="w-9 h-9 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center text-emerald-400">
                    <i class="fa-solid fa-wallet text-base"></i>
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-2xl lg:text-3xl font-extrabold tracking-tight">
                    Rp {{ number_format($totalSaldo, 2, ',', '.') }}
                </h3>
                <p class="text-xs text-slate-300 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-scale-balanced text-[10px]"></i> Selisih Pemasukan & Pengeluaran
                </p>
            </div>
        </div>

        <!-- Card 2: Total Pemasukan -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs hover:border-emerald-300 transition flex flex-col justify-between min-h-[160px]">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Pemasukan</span>
                <span class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-trend-up text-base"></i>
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-2xl lg:text-3xl font-extrabold text-emerald-600 tracking-tight">
                    Rp {{ number_format($totalPemasukan, 2, ',', '.') }}
                </h3>
                <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Total akumulasi dana masuk
                </p>
            </div>
        </div>

        <!-- Card 3: Total Pengeluaran -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs hover:border-rose-300 transition flex flex-col justify-between min-h-[160px]">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Pengeluaran</span>
                <span class="w-9 h-9 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-trend-down text-base"></i>
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-2xl lg:text-3xl font-extrabold text-rose-600 tracking-tight">
                    Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}
                </h3>
                <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Total akumulasi dana keluar
                </p>
            </div>
        </div>

        <!-- Card 4: Jumlah Transaksi -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-xs hover:border-indigo-300 transition flex flex-col justify-between min-h-[160px]">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Jumlah Transaksi</span>
                <span class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center">
                    <i class="fa-solid fa-receipt text-base"></i>
                </span>
            </div>
            <div class="mt-4">
                <h3 class="text-2xl lg:text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ number_format($totalTransaksi) }} <span class="text-base font-medium text-slate-500">Item</span>
                </h3>
                <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                    <i class="fa-solid fa-list-check text-[10px]"></i> Total rekaman transaksi
                </p>
            </div>
        </div>
    </div>

    {{-- Monthly Summary --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">

        <div>
            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-calendar-days text-emerald-600"></i>
                Ringkasan Bulan Ini
            </h2>

            <p class="text-xs text-slate-500 mt-1">
                Kondisi keuangan pada {{ now()->translatedFormat('F Y') }}.
            </p>
        </div>

        <span class="px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
            {{ now()->translatedFormat('F Y') }}
        </span>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        {{-- Monthly Income --}}
        <div class="rounded-xl bg-emerald-50 border border-emerald-100 p-5">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-down"></i>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500">
                        Pemasukan Bulan Ini
                    </p>

                    <p class="text-xl font-extrabold text-emerald-600 mt-1">
                        Rp {{ number_format($monthlyIncome, 0, ',', '.') }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Monthly Expense --}}
        <div class="rounded-xl bg-rose-50 border border-rose-100 p-5">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center">
                    <i class="fa-solid fa-arrow-up"></i>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500">
                        Pengeluaran Bulan Ini
                    </p>

                    <p class="text-xl font-extrabold text-rose-600 mt-1">
                        Rp {{ number_format($monthlyExpense, 0, ',', '.') }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Monthly Balance --}}
        <div class="rounded-xl bg-slate-50 border border-slate-200 p-5">

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-slate-200 text-slate-600 flex items-center justify-center">
                    <i class="fa-solid fa-wallet"></i>
                </div>

                <div>
                    <p class="text-xs font-semibold text-slate-500">
                        Sisa Bulan Ini
                    </p>

                    <p class="text-xl font-extrabold {{ $monthlyBalance >= 0 ? 'text-emerald-600' : 'text-rose-600' }} mt-1">
                        Rp {{ number_format($monthlyBalance, 0, ',', '.') }}
                    </p>
                </div>
            </div>

        </div>

    </div>

</div>

    {{-- Financial Chart --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    <div class="p-6 border-b border-slate-100">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">

            <div>
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-chart-column text-emerald-600"></i>
                    Ringkasan Keuangan
                </h2>

                <p class="text-slate-500 text-xs mt-1">
                    Perbandingan pemasukan dan pengeluaran dalam 6 bulan terakhir.
                </p>
            </div>

            <span class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 border border-slate-200">
                6 Bulan Terakhir
            </span>

        </div>
    </div>

    <div class="p-6">
        <div class="relative h-[320px]">
            <canvas id="financialChart"></canvas>
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartLabels = @json($chartLabels);
    const incomeData = @json($incomeData);
    const expenseData = @json($expenseData);

    const ctx = document.getElementById('financialChart');

    new Chart(ctx, {
        type: 'bar',

        data: {
            labels: chartLabels,

            datasets: [
                {
                    label: 'Pemasukan',
                    data: incomeData,
                    borderWidth: 0,
                    borderRadius: 8
                },
                {
                    label: 'Pengeluaran',
                    data: expenseData,
                    borderWidth: 0,
                    borderRadius: 8
                }
            ]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            interaction: {
                mode: 'index',
                intersect: false
            },

            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' +
                                new Intl.NumberFormat('id-ID').format(context.raw);
                        }
                    }
                }
            },

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        callback: function(value) {
                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID', {
                                    notation: 'compact',
                                    maximumFractionDigits: 1
                                }).format(value);
                        }
                    },

                    grid: {
                        drawBorder: false
                    }
                },

                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

{{-- Expense Category Chart --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    <div class="p-6 border-b border-slate-100">
        <div>
            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-chart-pie text-emerald-600"></i>
                Pengeluaran Berdasarkan Kategori
            </h2>

            <p class="text-slate-500 text-xs mt-1">
                Melihat kategori yang paling banyak menggunakan dana.
            </p>
        </div>
    </div>

    <div class="p-6">

        @if(count($categoryData) > 0)

            <div class="relative h-[340px] flex justify-center">
                <canvas id="categoryChart"></canvas>
            </div>

        @else

            <div class="py-12 text-center">

                <div class="w-16 h-16 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>

                <h3 class="font-bold text-slate-800 mt-4">
                    Belum Ada Data Pengeluaran
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Grafik akan muncul setelah ada transaksi pengeluaran.
                </p>

            </div>

        @endif

    </div>

</div>

<script>
    const categoryLabels = @json($categoryLabels);
    const categoryData = @json($categoryData);

    const categoryCtx = document.getElementById('categoryChart');

    if (categoryCtx && categoryData.length > 0) {

        new Chart(categoryCtx, {
            type: 'doughnut',

            data: {
                labels: categoryLabels,

                datasets: [{
                    data: categoryData,
                    borderWidth: 3,
                    hoverOffset: 8
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                cutout: '65%',

                plugins: {
                    legend: {
                        position: 'bottom',

                        labels: {
                            usePointStyle: true,
                            padding: 18
                        }
                    },

                    tooltip: {
                        callbacks: {
                            label: function(context) {

                                const value = context.raw;

                                return context.label + ': Rp ' +
                                    new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                }
            }
        });

    }
</script>

{{-- Financial Insight --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

    <div class="p-6">

        <div class="flex flex-col sm:flex-row sm:items-center gap-4">

            <div class="w-14 h-14 shrink-0 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl">
                <i class="fa-solid fa-lightbulb"></i>
            </div>

            <div class="flex-1">

                <p class="text-xs font-bold uppercase tracking-wider text-amber-600">
                    Insight Keuangan
                </p>

                @if($topCategoryName)

                    <h3 class="text-lg font-extrabold text-slate-900 mt-1">
                        Pengeluaran terbesar kamu ada di kategori
                        <span class="text-emerald-600">
                            {{ $topCategoryName }}
                        </span>
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Total pengeluaran pada kategori ini mencapai
                        <span class="font-bold text-slate-700">
                            Rp {{ number_format($topCategoryAmount, 0, ',', '.') }}
                        </span>.
                    </p>

                @else

                    <h3 class="text-lg font-extrabold text-slate-900 mt-1">
                        Belum Ada Data Pengeluaran
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        Tambahkan transaksi pengeluaran untuk mendapatkan insight keuangan.
                    </p>

                @endif

            </div>

            <div class="hidden sm:flex w-10 h-10 rounded-xl bg-slate-50 items-center justify-center text-slate-400">
                <i class="fa-solid fa-arrow-trend-up"></i>
            </div>

        </div>

    </div>

</div>

    <!-- Recent Transactions Table Section -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <!-- Section Header -->
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-clock-rotate-left text-emerald-600"></i>
                    <span>5 Transaksi Terbaru</span>
                </h2>
                <p class="text-slate-500 text-xs mt-0.5">Daftar transaksi pencatatan keuangan terkini yang tercatat pada sistem.</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 self-start sm:self-auto border border-slate-200">
                Top 5 Recent Records
            </span>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            @if($recentTransactions->isEmpty())
                <div class="p-12 text-center">
                    <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl border border-slate-200">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 text-base">Belum Ada Transaksi</h4>
                    <p class="text-slate-500 text-xs max-w-sm mx-auto mt-1">Data transaksi keuangan Anda akan muncul di sini setelah Anda menambahkan transaksi baru.</p>
                </div>
            @else
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">
                            <th class="py-3.5 px-6">Kategori</th>
                            <th class="py-3.5 px-6">Deskripsi</th>
                            <th class="py-3.5 px-6">Tanggal</th>
                            <th class="py-3.5 px-6">Tipe</th>
                            <th class="py-3.5 px-6 text-right">Nominal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @foreach($recentTransactions as $transaction)
                            <tr class="hover:bg-slate-50/60 transition">
                                <!-- Category -->
                                <td class="py-4 px-6 font-medium text-slate-900">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-xl {{ $transaction->type === 'income' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-rose-50 text-rose-600 border border-rose-200' }} flex items-center justify-center shrink-0">
                                            <i class="{{ $transaction->category->icon ?? 'fa-solid fa-tag' }} text-sm"></i>
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-800 block">{{ $transaction->category->name ?? 'Tanpa Kategori' }}</span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Description -->
                                <td class="py-4 px-6 text-slate-600">
                                    {{ $transaction->description ?: '-' }}
                                </td>

                                <!-- Date -->
                                <td class="py-4 px-6 text-slate-500 text-xs whitespace-nowrap">
                                    <i class="fa-regular fa-calendar text-slate-400 mr-1"></i>
                                    {{ $transaction->transaction_date ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') : '-' }}
                                </td>

                                <!-- Type Badge -->
                                <td class="py-4 px-6 whitespace-nowrap">
                                    @if($transaction->type === 'income')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            <i class="fa-solid fa-circle-arrow-down text-[10px]"></i>
                                            Pemasukan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">
                                            <i class="fa-solid fa-circle-arrow-up text-[10px]"></i>
                                            Pengeluaran
                                        </span>
                                    @endif
                                </td>

                                <!-- Amount -->
                                <td class="py-4 px-6 text-right font-extrabold whitespace-nowrap {{ $transaction->type === 'income' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $transaction->type === 'income' ? '+' : '-' }} Rp {{ number_format($transaction->amount, 2, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
