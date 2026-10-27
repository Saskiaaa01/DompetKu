@extends('layouts.app')

@section('title', 'Kategori — DompetKu')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">

        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Kategori
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola kategori pemasukan dan pengeluaran DompetKu.
            </p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition shadow-sm">

            <i class="fa-solid fa-plus"></i>

            Tambah Kategori

        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800">

            <i class="fa-solid fa-circle-check text-emerald-600"></i>

            <span class="text-sm font-semibold">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="flex items-center gap-3 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800">

            <i class="fa-solid fa-circle-exclamation text-rose-600"></i>

            <span class="text-sm font-semibold">
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- Category Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">

                <i class="fa-solid fa-tags text-emerald-600"></i>

                Daftar Kategori

            </h2>

            <p class="text-xs text-slate-500 mt-1">
                {{ $categories->count() }} kategori tersedia.
            </p>

        </div>


        @if($categories->isEmpty())

            <div class="p-12 text-center">

                <div class="w-16 h-16 mx-auto rounded-full bg-slate-100 text-slate-400 flex items-center justify-center text-2xl">

                    <i class="fa-solid fa-tags"></i>

                </div>

                <h3 class="font-bold text-slate-800 mt-4">
                    Belum Ada Kategori
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    Tambahkan kategori pertama untuk mulai mengelola transaksi.
                </p>

                <a href="{{ route('categories.create') }}"
                   class="inline-flex items-center gap-2 mt-5 px-4 py-2.5 rounded-lg bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition">

                    <i class="fa-solid fa-plus"></i>

                    Tambah Kategori

                </a>

            </div>

        @else

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead>

                        <tr class="bg-slate-50 border-b border-slate-100 text-[11px] font-bold text-slate-500 uppercase tracking-wider">

                            <th class="py-4 px-6">
                                Kategori
                            </th>

                            <th class="py-4 px-6">
                                Tipe
                            </th>

                            <th class="py-4 px-6">
                                Ikon
                            </th>

                            <th class="py-4 px-6 text-right">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach($categories as $category)

                            <tr class="hover:bg-slate-50/60 transition">

                                {{-- Name --}}
                                <td class="py-4 px-6">

                                    <div class="flex items-center gap-3">

                                        <div class="w-10 h-10 rounded-xl
                                            {{ $category->type === 'income'
                                                ? 'bg-emerald-50 text-emerald-600 border border-emerald-200'
                                                : 'bg-rose-50 text-rose-600 border border-rose-200' }}
                                            flex items-center justify-center">

                                            <i class="{{ $category->icon ?: 'fa-solid fa-tag' }}"></i>

                                        </div>

                                        <div>

                                            <p class="font-bold text-slate-800">
                                                {{ $category->name }}
                                            </p>

                                            <p class="text-xs text-slate-400">
                                                ID #{{ $category->id }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Type --}}
                                <td class="py-4 px-6">

                                    @if($category->type === 'income')

                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">

                                            <i class="fa-solid fa-arrow-down text-[10px]"></i>

                                            Pemasukan

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800 border border-rose-200">

                                            <i class="fa-solid fa-arrow-up text-[10px]"></i>

                                            Pengeluaran

                                        </span>

                                    @endif

                                </td>


                                {{-- Icon --}}
                                <td class="py-4 px-6">

                                    <code class="text-xs px-2 py-1 rounded-lg bg-slate-100 text-slate-600">
                                        {{ $category->icon ?: 'fa-solid fa-tag' }}
                                    </code>

                                </td>


                                {{-- Actions --}}
                                <td class="py-4 px-6">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="w-9 h-9 rounded-lg bg-slate-100 text-slate-500 hover:bg-slate-200 transition flex items-center justify-center"
                                           title="Edit">

                                            <i class="fa-solid fa-pen text-sm"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="w-9 h-9 rounded-lg bg-rose-50 text-rose-500 hover:bg-rose-100 transition flex items-center justify-center"
                                                    title="Hapus">

                                                <i class="fa-solid fa-trash text-sm"></i>

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