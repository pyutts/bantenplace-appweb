<!DOCTYPE html>
<html>
<head>
    <?php
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    ?>
    <title>Laporan <?= $bulan[$month] ?> <?= $year ?></title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #198754;
            padding-bottom: 20px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #198754;
        }
        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .info-box {
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #f8f9fa;
        }
        .info-box h2 {
            margin-top: 0;
            color: #198754;
            font-size: 18px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
        }
        .info-box p {
            margin: 10px 0;
            font-size: 14px;
        }
        .summary-title {
            color: #198754;
            font-size: 18px;
            margin-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 10px;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px;
            font-size: 14px;
        }
        table, th, td { 
            border: 1px solid #e0e0e0;
        }
        th { 
            background-color: #198754;
            color: white;
            padding: 12px 8px;
            text-align: left;
        }
        td { 
            padding: 10px 8px;
            background-color: #fff;
        }
        tr:nth-child(even) td {
            background-color: #f8f9fa;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #198754;
            padding-top: 20px;
        }
        .total-row {
            font-weight: bold;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Laporan Penjualan Banten</div>
        <div class="subtitle">Periode: <?= $bulan[$month] ?> <?= $year ?></div>
        <div class="subtitle">Dibuat pada: <?= date('d/m/Y H:i:s') ?></div>
    </div>

    <div class="info-box">
        <h2>Ringkasan Laporan</h2>
        <p><strong>Total Pesanan:</strong> <?= $monthlyReport['total_orders'] ?> pesanan</p>
        <p><strong>Total Pendapatan:</strong> Rp. <?= number_format($monthlyReport['total_income'], 0, ',', '.') ?></p>
    </div>

    <div class="summary-title">Produk Terbanyak Dibeli</div>
    <table>
        <thead>
            <tr>
                <th style="width: 40%">Nama Produk</th>
                <th style="width: 30%">Total Kuantitas</th>
                <th style="width: 30%">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mostPurchasedProducts as $product): ?>
                <tr>
                    <td><?= esc($product['name_products']) ?></td>
                    <td><?= esc($product['total_quantity']) ?> pcs</td>
                    <td>Rp. <?= number_format($product['total_income'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh sistem BantenPlace</p>
        <p>Tanggal Cetak: <?= date('d/m/Y H:i:s') ?></p>
    </div>
</body>
</html>