# Card payment processing with Checkout API

## Using a PHP server with simple routing

### Requirements
- PHP 7.1 or higher
- [Composer](https://getcomposer.org/download) dependency manager
- Read our [testing instructions](https://developers.mercadopago.com/en/guides/payments/api/testing)
- Set-up your Credentials: 
  - Public Key on client-side [`index.js`](https://github.com/mercadopago/card-payment-sample/client/js/index.js#L2)
  - Private Access Token on server-side [`server.php`](https://github.com/mercadopago/card-payment-sample/server/php/server.php#L6)

### How to run it
- php composer.phar install
- php -S localhost:8080 server.php
- Navigate to http://localhost:8080 on your browser
