<?php

// Requires
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

// Init GP
$gp = new GP\Pos(PARTNER_ID, PARTNER_SECRET, MERCHANT_ID, TERMINAL_ID);

// Amount to charge
$amount = 168;

// Transaction ID
$txId = 'OrderID' . $gp->generateNonce(4);

// Create Merchant Present QR
$merchantPresentQrCode = $gp->createMerchantPresentQrCode($txId, $amount);

// Display QR Code using Google Charts
$googleChartQrCodeImgUrl = 'https://chart.googleapis.com/chart?' . http_build_query([
    'cht' => 'qr',
    'chs' => '300x300',
    'chl' => $merchantPresentQrCode->qrcode ?? '',
]);
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Merchant Present QR Code</title>
    </head>
    <body>
        <img src="<?php echo $googleChartQrCodeImgUrl; ?>" title="Merchant Present QR Code" />
    </body>
</html>