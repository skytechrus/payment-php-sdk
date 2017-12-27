[![codecov](https://codecov.io/bb/skytechrus/payment-php-sdk/branch/master/graph/badge.svg?token=dCZ556fNrg)](https://codecov.io/bb/skytechrus/payment-php-sdk)

# PHP Payment SDK #

## Install
Via Composer
```bash
composer require skytech/payment-php-sdk
```

## Usage
Purchase
```php
$order = new \Skytech\Sdk\Order();
$order->setAmount(100);
$order->setCurrency(643); //Russian rubles. ISO 4217 numeric-3
$order->setDescription("Test description");

$merchant = new \Skytech\Sdk\Merchant();
$merchant->setLanguage('RU'); // ISO 639-1
$merchant->setMerchantId("ES000000");
$merchant->setApproveUrl($approveUrl);
$merchant->setCancelUrl($cancelUrl);
$merchant->setDeclineUrl($declineUrl);

$address = new \Skytech\Sdk\Customer\Address();
$address->setCountry(643); // ISO 3166-1 numeric
$address->setRegion("Moscow");
$address->setCity("Moscow");
$address->setAddressline("evergreen street");
$address->setZip("123123");

$customer = new \Skytech\Sdk\Customer($address);
$customer->setEmail($email);
$customer->setPhone($phone);
$customer->setIp($clientIp);

$connector = new \Skytech\Sdk\Connector();
$connector->setCert('C:\Payment_php_sdk\test.pem', ''); // Path to the client certificate
$payment = new \Skytech\Sdk\Payment($order, $merchant, $customer, $connector);
try {
    $response = $payment->purchase();
} catch (Exception $e) {
    echo $e->getMessage();
}

$url = $response->getPaymentUrl(); // Redirect client to payment page by this url
header('Location: ' . $url);
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing
## Security
If you discover any security related issues, please email sv@skytecrussia.com instead of using the issue tracker. 
## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.
