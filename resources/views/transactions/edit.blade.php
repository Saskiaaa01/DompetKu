@extends('layouts.app')

@section('title', 'Edit Transaksi — DompetKu')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    <div>
        <a href="{{ route('transactions.index') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Transaksi
        </a>

        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">
            Edit Transaksi
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Perbarui informasi transaksi keuangan kamu.
        </p>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

        <form action="{{ route('transactions.update', $transaction) }}" method="POST" class="space-y-6">

            @csrf
            @method('PUT')

            {{-- Tipe Transaksi --}}
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">
                    Tipe Transaksi
                </label>

                <div class="grid grid-cols-2 gap-3">

                    <label class="cursor-pointer">
                        <input
                            type="radio"
                            name="type"
                            value="income"
                            class="peer sr-only"
                            {{ old('type', $transaction->type) === 'income' ? 'checked' : '' }}
                        >

                        <div class="border border-slate-200 rounded-xl p-4 text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition">
                            <i class="fa-solid fa-arrow-trend-up text-emerald-600 text-xl mb-2"></i>
                            <p class="font-bold text-slate-800">Pemasukan</p>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input
                            type="radio"
                            name="type"
                            value="expense"
                            class="peer sr-only"
                            {{ old('type', $transaction->type) === 'expense' ? 'checked' : '' }}
                        >

                        <div class="border border-slate-200 rounded-xl p-4 text-center peer-checked:border-rose-500 peer-checked:bg-rose-50 transition">
                            <i class="fa-solid fa-arrow-trend-down text-rose-600 text-xl mb-2"></i>
                            <p class="font-bold text-slate-800">Pengeluaran</p>
                        </div>
                    </label>

                </div>

                @error('type')
                    <p class="text-xs text-rose-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label for="category_id" class="block text-sm font-bold text-slate-700 mb-2">
                    Kategori
                </label>

                <select
                    id="category_id"
                    name="category_id"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none"
                    required
                >
                    <option value="">Pilih kategori</option>

                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ old('category_id', $transaction->category_id) == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

                @error('category_id')
                    <p class="text-xs text-rose-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nominal --}}
            <div>
                <label for="amount" class="block text-sm font-bold text-slate-700 mb-2">
                    Nominal
                </label>

                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400">
                        Rp
                    </span>

                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        min="1"
                        value="{{ old('amount', $transaction->amount) }}"
                        class="w-full rounded-xl border border-slate-200 pl-12 pr-4 py-3 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none"
                        required
                    >
                </div>

                @error('amount')
                    <p class="text-xs text-rose-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-bold text-slate-700 mb-2">
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Contoh: Belanja kebutuhan bulanan"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none resize-none"
                >{{ old('description', $transaction->description) }}</textarea>

                @error('description')
                    <p class="text-xs text-rose-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal --}}
            <div>
                <label for="transaction_date" class="block text-sm font-bold text-slate-700 mb-2">
                    Tanggal Transaksi
                </label>

                <input
                    type="date"
                    id="transaction_date"
                    name="transaction_date"
                    value="{{ old('transaction_date', $transaction->transaction_date?->format('Y-m-d')) }}"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none"
                    required
                >

                @error('transaction_date')
                    <p class="text-xs text-rose-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-slate-100">

                <a href="{{ route('transactions.index') }}"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-slate-200 text-slate-600 font-bold text-sm hover:bg-slate-50 transition">
                    Batal
                </a>

                <button
                    type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white font-bold text-sm hover:bg-emerald-700 transition shadow-sm"
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>
@endsection