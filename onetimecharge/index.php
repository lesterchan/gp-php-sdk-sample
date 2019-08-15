<?php

// Requires
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

// Session Start
session_start();

// Init GP
$gp = new GP\OneTimeCharge(PARTNER_ID, PARTNER_SECRET, CLIENT_ID, CLIENT_SECRET, MERCHANT_ID);

// Amount to charge
$amount = 168;

// Description of the charge
$description = 'Test One-Time Charge Payment';

// Partner group transaction ID
$partnerGroupTxId = 'OrderID' . $gp->generateNonce(4);

// Session variables
$_SESSION['partnerTxId'] = 'IdempotencyKey' . $gp->generateNonce(4);
$_SESSION['codeVerifier'] = $gp->generateNonce(64);
$_SESSION['redirectUrl'] = 'https://' . $_SERVER['SERVER_NAME'] . '/gp-php-sdk-sample/onetimecharge/complete.php';

// Init charge
$initCharge = $gp->initCharge($_SESSION['partnerTxId'], $partnerGroupTxId, $amount, $description);

// Get OAuth authorize url
$oauthAuthorizeUrl = $gp->getOauthAuthorizeUrl($_SESSION['codeVerifier'], $initCharge->request, $_SESSION['redirectUrl'], 'payment.one_time_charge');

// Redirect to OAuth authorize url
if (! empty($oauthAuthorizeUrl)) {
    header('Location: ' . $oauthAuthorizeUrl);
    exit();
}

echo 'OAuth authorize url is empty';
