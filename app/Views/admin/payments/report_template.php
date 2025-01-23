<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembayaran</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Laporan Pembayaran</h2>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Kode Transaksi</th>
                    <th>Status Pembayaran</th>
                    <th>Jumlah Bayar</th>
                    <th>Tanggal Bayar</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?= esc($payment['order_id']) ?></td>
                        <td><?= esc($payment['transaction_id']) ?></td>
                        <td><?= esc($payment['payment_status']) ?></td>
                        <td>Rp. <?= esc(number_format($payment['amount_paid'], 0, ',', '.')) ?></td>
                        <td><?= esc($payment['payment_date']) ?></td>
                        <td>Rp. <?= esc(number_format($payment['total_price'], 0, ',', '.')) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 