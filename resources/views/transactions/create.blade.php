@extends('layouts.app')

@section('content')
<style>
    .transaction-page {
        max-width: 900px;
        margin: 0 auto;
        padding: 35px 20px 60px;
    }

    .page-header {
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin: 0 0 7px;
        font-size: 28px;
        font-weight: 700;
        color: #172b24;
    }

    .page-header p {
        margin: 0;
        color: #718078;
        font-size: 14px;
    }

    .transaction-card {
        background: #ffffff;
        border: 1px solid #e7ece9;
        border-radius: 18px;
        padding: 32px;
        box-shadow: 0 8px 30px rgba(23, 43, 36, 0.06);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    .form-group label {
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        color: #263a32;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        box-sizing: border-box;
        height: 48px;
        padding: 0 14px;
        border: 1px solid #dfe6e2;
        border-radius: 10px;
        background: #fbfcfc;
        color: #263a32;
        font-size: 14px;
        outline: none;
        transition: all 0.2s ease;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #0aa879;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(10, 168, 121, 0.10);
    }

    .form-group input::placeholder {
        color: #a5afa9;
    }

    .type-options {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .type-option input {
        display: none;
    }

    .type-option label {
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dfe6e2;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        color: #63716a;
        background: #fbfcfc;
        transition: all 0.2s ease;
    }

    .type-option.income input:checked + label {
        border-color: #0aa879;
        background: #eaf9f3;
        color: #07845f;
    }

    .type-option.expense input:checked + label {
        border-color: #e57373;
        background: #fff1f1;
        color: #d94b4b;
    }

    .error-box {
        margin-bottom: 22px;
        padding: 14px 16px;
        border-radius: 10px;
        background: #fff1f1;
        border: 1px solid #ffd4d4;
        color: #c03939;
        font-size: 14px;
    }

    .error-box ul {
        margin: 7px 0 0 18px;
        padding: 0;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 24px;
        border-top: 1px solid #edf0ee;
    }

    .btn {
        height: 45px;
        padding: 0 22px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.2s ease;
    }

    .btn-cancel {
        background: #f1f4f2;
        color: #53635b;
    }

    .btn-cancel:hover {
        background: #e7ebe9;
    }

    .btn-save {
        background: #08a878;
        color: white;
        box-shadow: 0 5px 14px rgba(8, 168, 120, 0.20);
    }

    .btn-save:hover {
        background: #078f67;
        transform: translateY(-1px);
    }

    @media (max-width: 700px) {
        .transaction-page {
            padding: 25px 15px 40px;
        }

        .transaction-card {
            padding: 22px;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="transaction-page">

    <div class="page-header">
        <h1>Tambah Transaksi</h1>
        <p>Catat pemasukan atau pengeluaran kamu dengan mudah.</p>
    </div>

    <div class="transaction-card">

        @if ($errors->any())
            <div class="error-box">
                <strong>Periksa kembali data yang kamu masukkan.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="form-grid">

                <div class="form-group full">
                    <label>Jenis Transaksi</label>

                    <div class="type-options">

                        <div class="type-option income">
                            <input
                                type="radio"
                                name="type"
                                id="income"
                                value="income"
                                {{ old('type') == 'income' ? 'checked' : '' }}
                                required
                            >
                            <label for="income">
                                ↑ &nbsp; Pemasukan
                            </label>
                        </div>

                        <div class="type-option expense">
                            <input
                                type="radio"
                                name="type"
                                id="expense"
                                value="expense"
                                {{ old('type') == 'expense' ? 'checked' : '' }}
                            >
                            <label for="expense">
                                ↓ &nbsp; Pengeluaran
                            </label>
                        </div>

                    </div>
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori</label>

                    <select name="category_id" id="category_id" required>
                        <option value="">Pilih kategori</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Jumlah</label>

                    <input
                        type="number"
                        name="amount"
                        id="amount"
                        placeholder="Contoh: 500000"
                        min="1"
                        value="{{ old('amount') }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="transaction_date">Tanggal</label>

                    <input
                        type="date"
                        name="transaction_date"
                        id="transaction_date"
                        value="{{ old('transaction_date', date('Y-m-d')) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="description">Keterangan</label>

                    <input
                        type="text"
                        name="description"
                        id="description"
                        placeholder="Contoh: Gaji bulanan"
                        maxlength="255"
                        value="{{ old('description') }}"
                    >
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn btn-cancel">
                    Batal
                </a>

                <button type="submit" class="btn btn-save">
                    Simpan Transaksi
                </button>
            </div>

        </form>
    </div>

</div>
@endsection