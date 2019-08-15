<?php

// Requires
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config.php';

// Session Start
session_start();

// Init GP
$gp = new GP\Tokenization(PARTNER_ID, PARTNER_SECRET, CLIENT_ID, CLIENT_SECRET, MERCHANT_ID);

// Session variables
$_SESSION['partnerTxId'] = 'IdempotencyKey' . $gp->generateNonce(4);
$_SESSION['codeVerifier'] = $gp->generateNonce(64);
$_SESSION['redirectUrl'] = 'https://' . $_SERVER['SERVER_NAME'] . '/gp-php-sdk-sample/tokenization/charge.php';

// Init charge
$initCharge = $gp->bind($_SESSION['partnerTxId']);

// Get OAuth authorize url
$oauthAuthorizeUrl = $gp->getOauthAuthorizeUrl($_SESSION['codeVerifier'], $initCharge->request, $_SESSION['redirectUrl'], 'payment.recurring_charge');

// Redirect to OAuth authorize url
if (! empty($oauthAuthorizeUrl)) {
    header('Location: ' . $oauthAuthorizeUrl);
    exit();
}

echo 'OAuth authorize url is empty';
