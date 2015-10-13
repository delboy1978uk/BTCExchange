# BTCExchange
[![Build Status](https://travis-ci.org/delboy1978uk/BTCExchange.png?branch=master)](https://travis-ci.org/delboy1978uk/BTCExchange) [![Code Coverage](https://scrutinizer-ci.com/g/delboy1978uk/btcexchange/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/btcexchange/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/delboy1978uk/btcexchange/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/delboy1978uk/btcexchange/?branch=master) <br />
a btcexchange PHP setup for writing a new Github project with Composer and Packagist complete with travis builds and scrutinizer code coverage & quality analysis
A PHP Service for connecting to various Bitcoin exchange API's
##Installation
```
composer require delboy1978uk/btcexchange
```
##Usage
```php
use Del\BTCTradeApi;

$settings = [
    'btce' => [
        'key' => 'blah',
        'secret' => 'blah',
    ],
    'kraken' => [
        'key' => 'blah',
        'secret' => 'blah',
    ],
    //etc. BTC-e is the only API currently written, more coming soon
]
$api = new BTCTradeApi($settings);

$btce = $api->getBtcEExchange();
$result = $btce->buyOrder(3.2, 240.221); // Buy 3.2BTC at a price of $240.221 per Bitcoin 
```
###API Methods
```php
$btce->buyOrder($btc_amt, $price);
$btce->cancelOrder($id);
$btce->getInfo();
$btce->getOrders();
$btce->getTicker();
$btce->getTradeHistory();
$btce->getTransactionHistory();
$btce->sellOrder($btc_amt, $price);
```