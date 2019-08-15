# Sample PHP code for GP PHP SDK 

# Installation
```bash
composer install
```

# Usage
1. Copy `config-sample.php` to `config.php` and fill in your `Partner ID`, `Partner Secret`, `Client ID`, `Client Secret`, and `Merchant ID`.
2. For One-Time Charge, your url will be `https://[HOST_NAME]/gp-php-sdk-sample/onetimecharge/` and your redirect_uri will be `https://[HOST_NAME]/gp-php-sdk-sample/onetimecharge/complete.php`.
3. For Tokenization, your url will be `https://[HOST_NAME]/gp-php-sdk-sample/tokenization/` and your redirect_uri will be `https://[HOST_NAME]/gp-php-sdk-sample/tokenization/charge.php`.
4. You will need to whitelist your server URL on the GP Developer Platform.