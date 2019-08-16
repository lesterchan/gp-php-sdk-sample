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

// Scanned QR Code
$qrCode = '650000000000000000';

// Perform transaction after scanning Consumer Present QR
$consumerPresentQrCode = $gp->performConsumerPresentQrCode($txId, $amount, $qrCode);