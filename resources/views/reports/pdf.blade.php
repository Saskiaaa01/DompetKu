<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Laporan Keuangan DompetKu</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1e293b;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            margin-bottom: 25px;
        }

        .summary {
            width: 100%;
            margin-bottom: 25px;
        }

        .summary td {
            border: 1px solid #e2e8f0;
            padding: 12px;
        }

        .label {
            font-size: 10px;
            color: #64748b;
            text-transform: uppercase;
        }

        .value {
            font-size: 16px;
            font-weight: bold;
            margin-top: 5px;
        }

        table.transactions {
            width: 100%;
            border-collapse: collapse;
        }

        table.transactions th {
            background: #f1f5f9;
            padding: 8px;
            border: 1px solid #cbd5e1;
            text-align: left;
        }

        table.transactions td {
            padding: 8px;
            border: 1px solid #e2e8f0;
        }

        .income {
            color: #059669;
            font-weight: bold;
        }

        .expense {
            color: #e11d48;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Laporan Keuangan DompetKu</h1>

    <div class="subtitle">
        Laporan pemasukan dan pengeluaran
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="label">Total Pemasukan</div>
                <div class="value">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </div>
            </td>

            <td>
                <div class="label">Total Pengeluaran</div>
                <div class="value">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </div>
            </td>

            <td>
                <div class="label">Saldo</div>
                <div class="value">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </div>
            </td>
        </tr>
    </table>

    <table class="transactions">

        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Tipe</th>
                <th>Nominal</th>
            </tr>
        </thead>

        <tbody>

            @forelse($transactions as $index => $transaction)

                <tr>

                    <td>{{ $index + 1 }}</td>

                    <td>
                        {{ $transaction->transaction_date
                            ? $transaction->transaction_date->format('d-m-Y')
                            : '-' }}
                    </td>

                    <td>
                        {{ $transaction->category->name ?? 'Tanpa Kategori' }}
                    </td>

                    <td>
                        {{ $transaction->description ?: '-' }}
                    </td>

                    <td class="{{ $transaction->type === 'income' ? 'income' : 'expense' }}">
                        {{ $transaction->type === 'income'
                            ? 'Pemasukan'
                            : 'Pengeluaran' }}
                    </td>

                    <td>
                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6" style="text-align:center;">
                        Tidak ada transaksi.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>