@extends('layouts.app')

@section('title', 'Tambah Kategori — DompetKu')

@section('content')

<div class="max-w-2xl mx-auto space-y-6">

    {{-- Header --}}
    <div>
        <a href="{{ route('categories.index') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition mb-4">

            <i class="fa-solid fa-arrow-left"></i>

            Kembali ke Kategori

        </a>

        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
            Tambah Kategori
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Buat kategori baru untuk mengelompokkan transaksi keuangan.
        </p>
    </div>


    {{-- Validation Error --}}
    @if($errors->any())

        <div class="rounded-xl bg-rose-50 border border-rose-200 p-4">

            <div class="flex items-center gap-2 text-rose-700 font-bold text-sm mb-2">

                <i class="fa-solid fa-circle-exclamation"></i>

                Ada kesalahan pada input:

            </div>

            <ul class="list-disc list-inside text-xs text-rose-600 space-y-1">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">

            @csrf


            {{-- Name --}}
            <div>

                <label for="name"
                       class="block text-sm font-bold text-slate-700 mb-2">

                    Nama Kategori

                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Makanan"
                    required
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition"
                >

            </div>


            {{-- Type --}}
            <div>

                <label for="type"
                       class="block text-sm font-bold text-slate-700 mb-2">

                    Tipe Kategori

                </label>

                <select
                    id="type"
                    name="type"
                    required
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition"
                >

                    <option value="">
                        Pilih tipe kategori
                    </option>

                    <option value="income" {{ old('type') === 'income' ? 'selected' : '' }}>
                        Pemasukan
                    </option>

                    <option value="expense" {{ old('type') === 'expense' ? 'selected' : '' }}>
                        Pengeluaran
                    </option>

                </select>

            </div>


            {{-- Icon --}}
            <div>

                <label for="icon"
                       class="block text-sm font-bold text-slate-700 mb-2">

                    Ikon Font Awesome

                </label>

                <input
                    type="text"
                    id="icon"
                    name="icon"
                    value="{{ old('icon') }}"
                    placeholder="Contoh: fa-solid fa-utensils"
                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 transition"
                >

                <p class="text-xs text-slate-400 mt-2">
                    Contoh:
                    <code class="bg-slate-100 px-1.5 py-0.5 rounded">
                        fa-solid fa-utensils
                    </code>
                </p>

            </div>


            {{-- Preview --}}
            <div class="rounded-xl bg-slate-50 border border-slate-200 p-4">

                <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
                    Contoh Tampilan
                </p>

                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200 flex items-center justify-center">

                        <i id="iconPreview"
                           class="fa-solid fa-tag"></i>

                    </div>

                    <div>

                        <p id="namePreview"
                           class="font-bold text-slate-800">

                            Nama Kategori

                        </p>

                        <p id="typePreview"
                           class="text-xs text-slate-400">

                            Tipe kategori

                        </p>

                    </div>

                </div>

            </div>


            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3 pt-2">

                <a href="{{ route('categories.index') }}"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl border border-slate-200 text-slate-600 text-sm font-bold hover:bg-slate-50 transition">

                    Batal

                </a>

                <button
                    type="submit"
                    class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition shadow-sm">

                    <i class="fa-solid fa-check"></i>

                    Simpan Kategori

                </button>

            </div>

        </form>

    </div>

</div>


{{-- Live Preview --}}
<script>

    const nameInput = document.getElementById('name');
    const typeInput = document.getElementById('type');
    const iconInput = document.getElementById('icon');

    const namePreview = document.getElementById('namePreview');
    const typePreview = document.getElementById('typePreview');
    const iconPreview = document.getElementById('iconPreview');


    nameInput.addEventListener('input', function () {

        namePreview.textContent =
            this.value || 'Nama Kategori';

    });


    typeInput.addEventListener('change', function () {

        if (this.value === 'income') {

            typePreview.textContent = 'Pemasukan';

        } else if (this.value === 'expense') {

            typePreview.textContent = 'Pengeluaran';

        } else {

            typePreview.textContent = 'Tipe kategori';

        }

    });


    iconInput.addEventListener('input', function () {

        iconPreview.className =
            this.value || 'fa-solid fa-tag';

    });

</script>

@endsection