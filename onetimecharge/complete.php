<?php

// Requires
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

// Session start
session_start();

// Init GP
$gp = new GP\OneTimeCharge(PARTNER_ID, PARTNER_SECRET, CLIENT_ID, CLIENT_SECRET, MERCHANT_ID);

// Check for OAuth2 code
$accessToken = '';
if (! empty($_REQUEST['code'])) {
    $geAccessToken = $gp->getAccessToken($_REQUEST['code'], $_SESSION['redirectUrl'], $_SESSION['codeVerifier']);
    $accessToken = $geAccessToken->access_token;
} else {
    echo 'OAuth2 code is missing';
}

// Complete the charge
if (! empty($accessToken)) {
    print_r($accessToken);
    $completeCharge = $gp->completeCharge($accessToken, $_SESSION['partnerTxId']);
    print_r($completeCharge);
} else {
    echo 'Access token is empty';
}

// Destroy session
session_destroy();