<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
        .invoice-box table { width: 100%; line-height: inherit; text-align: left; }
        .invoice-box table td { padding: 5px; vertical-align: top; }
        .invoice-box table tr td:nth-child(2) { text-align: right; }
        .invoice-box table tr.top table td { padding-bottom: 20px; }
        .invoice-box table tr.information table td { padding-bottom: 40px; }
        .invoice-box table tr.heading td { background: #eee; border-bottom: 1px solid #ddd; font-weight: bold; }
        .invoice-box table tr.details td { padding-bottom: 20px; }
        .invoice-box table tr.item td { border-bottom: 1px solid #eee; }
        .invoice-box table tr.item.last td { border-bottom: none; }
        .invoice-box table tr.total td:nth-child(2) { border-top: 2px solid #eee; font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <h2>Invoice</h2>
                            </td>
                            <td>
                                Invoice #: <?= $order['order_id'] ?><br>
                                Created: <?= date('Y-m-d') ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <?= $user['nama'] ?><br>
                                <?= $user['alamat'] ?><br>
                                <?= $user['no_telepon'] ?>
                            </td>
                            <td>
                                <?= $bank['name'] ?><br>
                                Account: <?= $bank['account'] ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Item</td>
                <td>Price</td>
            </tr>
            <?php foreach ($cartItems as $item): ?>
            <tr class="item">
                <td><?= $item['name_products'] ?></td>
                <td>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total">
                <td></td>
                <td>Total: Rp <?= number_format($total, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>
</body>
</html>