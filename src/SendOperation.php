<?php
/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 13.10.2017
 * Time: 13:13
 */

use Skytech\Address;
use Skytech\Customer;
use Skytech\Operation;
use Skytech\Order;
use Skytech\URL_Settings;

$order = new Order();
$url_list = new URL_Settings('','','');
$address = new Address();
$customer = new Customer($address);
$operation = new Operation($order);
$operation->setUrlSettings($url_list);
$operation->customer = $customer;
$result = $operation->CreateOrderOnPurchase($operation,'',1234);
