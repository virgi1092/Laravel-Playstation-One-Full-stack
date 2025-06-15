<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penyewaan PlayStation</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #2563eb;
        }

        .header h2 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .info-item {
            flex: 1;
        }

        .info-label {
            font-weight: bold;
            color: #374151;
        }

        .info-value {
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 9px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            background-color: #e3f2fd;
            font-weight: bold;
        }

        .summary {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .summary-total {
            font-size: 12px;
            font-weight: bold;
            color: #2563eb;
            border-top: 2px solid #2563eb;
            padding-top: 10px;
            margin-top: 10px;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 9px;
            color: #6b7280;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }

        .badge-cash {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-transfer {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-qris {
            background-color: #fef3c7;
            color: #92400e;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENYEWAAN PLAYSTATION</h1>
        <h2>Periode: {{ $tanggal_dari }} s/d {{ $tanggal_sampai }}</h2>
    </div>

    <div class="info-row">
        <div class="info-item">
            <div class="info-label">Tanggal Cetak:</div>
            <div class="info-value">{{ $tanggal_cetak }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Total Transaksi:</div>
            <div class="info-value">{{ $data->count() }} transaksi</div>
        </div>
        <div class="info-item">
            <div class="info-label">Total Pendapatan:</div>
            <div class="info-value">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 3%">No</th>
                <th style="width: 15%">Nama Penyewa</th>
                <th style="width: 12%">No. Telepon</th>
                <th style="width: 20%">PlayStation</th>
                <th style="width: 10%">Tgl Sewa</th>
                <th style="width: 10%">Tgl Kembali</th>
                <th style="width: 5%">Qty</th>
                <th style="width: 15%">Total Harga</th>
                <th style="width: 10%">Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $penyewaan)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $penyewaan->penyewa->name }}</td>
                <td>{{ $penyewaan->no_telpon }}</td>
                <td>
                    {{ $penyewaan->detailPenyewaans->map(fn($detail) => $detail->playstation->nama_playstation)->implode(', ') }}
                </td>
                <td class="text-center">{{ \Carbon\Carbon::parse($penyewaan->tgl_sewa)->format('d/m/Y') }}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($penyewaan->tgl_kembali)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $penyewaan->detailPenyewaans->sum('jumlah') }}</td>
                <td class="text-right">Rp {{ number_format($penyewaan->detailPenyewaans->sum('total_harga'), 0, ',', '.') }}</td>
                <td class="text-center">
                    @php
                        $pembayaran = $penyewaan->pembayaran->first();
                        $metode = $pembayaran ? $pembayaran->metode_bayar : '-';
                    @endphp
                    <span class="badge badge-{{ strtolower($metode) }}">
                        {{ ucfirst($metode) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="6" class="text-center"><strong>TOTAL</strong></td>
                <td class="text-center"><strong>{{ $data->sum(fn($p) => $p->detailPenyewaans->sum('jumlah')) }}</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</strong></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="summary">
        <h3 style="margin-bottom: 10px; color: #374151;">Ringkasan Laporan</h3>
        
        @php
            $metodePembayaran = $data->groupBy(function($item) {
                $pembayaran = $item->pembayaran->first();
                return $pembayaran ? $pembayaran->metode_bayar : 'unknown';
            });
        @endphp

        <div class="summary-item">
            <span>Jumlah Transaksi:</span>
            <span>{{ $data->count() }} transaksi</span>
        </div>

        @foreach($metodePembayaran as $metode => $items)
        <div class="summary-item">
            <span>{{ ucfirst($metode) }}:</span>
            <span>{{ $items->count() }} transaksi (Rp {{ number_format($items->sum(fn($p) => $p->detailPenyewaans->sum('total_harga')), 0, ',', '.') }})</span>
        </div>
        @endforeach

        <div class="summary-total">
            <div class="summary-item">
                <span>TOTAL PENDAPATAN:</span>
                <span>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem pada {{ $tanggal_cetak }}</p>
        <p>Halaman {PAGENO} dari {nb}</p>
    </div>
</body>
</html>