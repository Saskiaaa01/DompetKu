@extends('layouts.app')

@section('title', 'Daftar Transaksi — DompetKu')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                Daftar Transaksi
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Kelola seluruh pemasukan dan pengeluaran DompetKu.
            </p>
        </div>

        <a href="{{ route('transactions.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition shadow-sm">
            <i class="fa-solid fa-plus"></i>
            Tambah Transaksi
        </a>
    </div>

    {{-- Summary --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                Total Transaksi
            </p>
            <p class="text-2xl font-extrabold text-slate-900 mt-2">
                {{ $transactions->count() }}
            </p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                Total Pemasukan
            </p>
            <p class="text-2xl font-extrabold text-emerald-600 mt-2">
                Rp {{ number_format($transactions->where('type', 'income')->sum('amount'), 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
            <p class="text-xs font-bold uppercase tracking-wider text-slate-500">
                Total Pengeluaran
            </p>
            <p class="text-2xl font-extrabold text-rose-600 mt-2">
                Rp {{ number_format($transactions->where('type', 'expense')->sum('amount'), 0, ',', '.') }}
            </p>
        </div>

    </div>
{{-- Filter --}}
<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">

        <div>
            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                <i class="fa-solid fa-filter text-emerald-600"></i>
                Filter Transaksi
            </h2>

            <p class="text-xs text-slate-500 mt-1">
                Cari dan saring transaksi berdasarkan kebutuhan.
            </p>
        </div>

        <span class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-slate-100 text-slate-600 border border-slate-200">
            {{ $transactions->count() }} hasil
        </span>

    </div>


    <form method="GET" action="{{ route('transactions.index') }}">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Search --}}
            <div class="lg:col-span-2">

                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                    Pencarian
                </label>

                <div class="relative">

                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari deskripsi atau kategori..."
                        class="w-full rounded-xl border border-slate-200 pl-11 pr-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition"
                    >

                </div>

            </div>


            {{-- Tipe --}}
            <div>

                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                    Tipe
                </label>

                <select
                    name="type"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition"
                >

                    <option value="">
                        Semua Tipe
                    </option>

                    <option value="income"
                        {{ request('type') === 'income' ? 'selected' : '' }}>
                        Pemasukan
                    </option>

                    <option value="expense"
                        {{ request('type') === 'expense' ? 'selected' : '' }}>
                        Pengeluaran
                    </option>

                </select>

            </div>


            {{-- Kategori --}}
            <div>

                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">
                    Kategori
                </label>

                <select
                    name="category_id"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition"
                >

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Tanggal Mulai --}}
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


            {{-- Tanggal Akhir --}}
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


        {{-- Buttons --}}
        <div class="flex flex-col sm:flex-row gap-3 mt-5 pt-5 border-t border-slate-100">

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition shadow-sm"
            >

                <i class="fa-solid fa-magnifying-glass"></i>

                Terapkan Filter

            </button>


            <a
                href="{{ route('transactions.index') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-slate-200 text-slate-600 text-sm font-bold hover:bg-slate-50 transition"
            >

                <i class="fa-solid fa-rotate-left"></i>

                Reset Filter

            </a>

        </div>

    </form>

</div>

    {{-- Transaction Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-900">
                Semua Transaksi
            </h2>
            <p class="text-xs text-slate-500 mt-1">
                Data transaksi terbaru ditampilkan terlebih dahulu.
            </p>
        </div>

        @if($transactions->isEmpty())

            <div class="p-12 text-center">

                <div class="w-16 h-16 mx-auto rounded-full bg-slate-100 flex items-center justify-center text-slate-400 text-2xl">
                    <i class="fa-solid fa-receipt"></i>
                </div>

                <h3 class="font-bold text-slate-800 mt-4">
                    Belum Ada Transaksi
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Silakan tambahkan transaksi pertama kamu.
                </p>

                <a href="{{ route('transactions.create') }}"
                   class="inline-flex items-center gap-2 mt-5 px-4 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Transaksi
                </a>

            </div>

        @else

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Kategori
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Deskripsi
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Tanggal
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500">
                                Tipe
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-right">
                                Nominal
                            </th>

                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-slate-500 text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @foreach($transactions as $transaction)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Category --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="w-9 h-9 rounded-xl
                                            {{ $transaction->type === 'income'
                                                ? 'bg-emerald-50 text-emerald-600 border border-emerald-200'
                                                : 'bg-rose-50 text-rose-600 border border-rose-200' }}
                                            flex items-center justify-center">

                                            <i class="{{ $transaction->category->icon ?? 'fa-solid fa-tag' }}"></i>

                                        </div>

                                        <span class="font-bold text-slate-800 whitespace-nowrap">
                                            {{ $transaction->category->name ?? 'Tanpa Kategori' }}
                                        </span>

                                    </div>

                                </td>

                                {{-- Description --}}
                                <td class="px-6 py-4 text-sm text-slate-600">
                                    {{ $transaction->description ?: '-' }}
                                </td>

                                {{-- Date --}}
                                <td class="px-6 py-4 text-sm text-slate-500 whitespace-nowrap">

                                    <i class="fa-regular fa-calendar mr-1 text-slate-400"></i>

                                    {{ $transaction->transaction_date
                                        ? $transaction->transaction_date->format('d M Y')
                                        : '-' }}

                                </td>

                                {{-- Type --}}
                                <td class="px-6 py-4 whitespace-nowrap">

                                    @if($transaction->type === 'income')

                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">

                                            <i class="fa-solid fa-arrow-down"></i>

                                            Pemasukan

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">

                                            <i class="fa-solid fa-arrow-up"></i>

                                            Pengeluaran

                                        </span>

                                    @endif

                                </td>

                                {{-- Amount --}}
                                <td class="px-6 py-4 text-right font-extrabold whitespace-nowrap
                                    {{ $transaction->type === 'income'
                                        ? 'text-emerald-600'
                                        : 'text-rose-600' }}">

                                    {{ $transaction->type === 'income' ? '+' : '-' }}

                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}

                                </td>

                                {{-- Action --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center justify-center gap-2">

                                        <a href="{{ route('transactions.edit', $transaction) }}"
   class="w-9 h-9 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 transition flex items-center justify-center"
   title="Edit">

    <i class="fa-solid fa-pen"></i>

</a>

                                        <form action="{{ route('transactions.destroy', $transaction) }}"
      method="POST"
      onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">

    @csrf
    @method('DELETE')

    <button type="submit"
        class="w-9 h-9 rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-100 transition flex items-center justify-center"
        title="Hapus">

        <i class="fa-solid fa-trash"></i>

    </button>

</form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</div>
@endsection