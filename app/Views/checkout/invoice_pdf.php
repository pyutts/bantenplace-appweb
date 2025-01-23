<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #<?= $order['order_id'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 40px;
            color: #333;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
        }
        .logo-container {
            width: 150px;
        }
        .logo {
            width: 100%;
            height: auto;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-title {
            font-size: 24px;
            margin: 0;
            color: #333;
        }
        .invoice-number {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
        }
        .document-date {
            color: #666;
            font-size: 12px;
            margin-top: 5px;
        }
        .customer-info {
            margin-bottom: 30px;
        }
        .info-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .info-text {
            margin: 0;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            font-size: 14px;
        }
        th {
            background-color: #f8f9fa;
            font-weight: normal;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .summary-section {
            margin-top: 30px;
            width: 100%;
        }
        .summary-table {
            width: 350px;
            float: right;
            margin-bottom: 40px;
        }
        .summary-row {
            padding: 8px 0;
            display: flex;
            justify-content: space-between;
        }
        .summary-total {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
            font-weight: bold;
        }
        .shipping-info {
            margin-top: 40px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #666;
            font-size: 13px;
            line-height: 1.5;
        }
        .header-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }
        .header-table td {
            border: none;
            padding: 0;
        }
        .logo-cell {
            width: 150px;
            text-align: left;
        }
        .logo {
            width: 150px;
            height: auto;
        }
        .invoice-info-cell {
            text-align: right;
            vertical-align: top;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                <?php
                $imagePath = FCPATH . 'home/img/logogreen.png';
                $imageData = base64_encode(file_get_contents($imagePath));
                $src = 'data:image/png;base64,'.$imageData;
                ?>
                <img src="<?= $src ?>" alt="Logo" class="logo">
            </td>
            <td class="invoice-info-cell">
                <h1 class="invoice-title">INVOICE</h1>
                <div class="invoice-number">#<?= $order['order_id'] ?></div>
                <div class="document-date">
                    Dokumen dibuat pada: <?= date('l, d F Y H:i', strtotime($order['created_at'])) ?> WIB
                </div>
            </td>
        </tr>
    </table>

    <div class="customer-info">
        <div class="info-label">Kepada:</div>
        <p class="info-text">
            <?= $order['nama'] ?><br>
            <?= $order['alamat'] ?><br>
            <?= $order['no_telepon'] ?>
        </p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-center">Jumlah</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $order['name_products'] ?></td>
                <td class="text-center"><?= $order['quantity'] ?></td>
                <td class="text-right">
                    Rp <?= number_format($order['total_price']/$order['quantity'], 0, ',', '.') ?>
                </td>
                <td class="text-right">
                    Rp <?= number_format($order['total_price'], 0, ',', '.') ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="summary-section">
        <div class="summary-row">
            <span>Subtotal:</span>
            <span>Rp <?= number_format($order['total_price'], 0, ',', '.') ?></span>
        </div>
        <div class="summary-row">
            <span>Ongkos Kirim (<?= $order['nama_ekspedisi'] ?>):</span>
            <span>Rp <?= number_format($order['harga_ongkir'], 0, ',', '.') ?></span>
        </div>
        <div class="summary-total">
            <span>Total:</span>
            <span>Rp <?= number_format($order['total_price'] + $order['harga_ongkir'], 0, ',', '.') ?></span>
        </div>
    </div>

    <div class="shipping-info">
        <div class="info-label">Status Pengiriman:</div>
        <p class="info-text">
            Ekspedisi: <?= $order['nama_ekspedisi'] ?><br>
            Status: <?= $order['status'] ?>
        </p>
    </div>

    <div class="footer">
        <p>Terima kasih telah berbelanja di Bantenplace!</p>
        <p>Jika ada pertanyaan, silakan hubungi customer service kami.<br>
        Email: admin@bantenplace.id | Telp: 081234567890</p>
    </div>
</body>
</html> 