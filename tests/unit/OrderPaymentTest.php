<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

use Skytech\Sdk\Customer;
use Skytech\Sdk\Merchant;
use Skytech\Sdk\Operation\Operation;
use Skytech\Sdk\OrderPayment;

/**
 * Class OrderPaymentTest
 */
class OrderPaymentTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Operation
     */
    protected $operation;

    protected function _before()
    {
        $order = new OrderPayment();
        $order->setAmount(100);
        $order->setCurrency(643);
        $order->setDescription('municipal payment');
        $order->setVendorId("002");
        $params = array();
        $params["USER"] = "Ivanov Ivan Ivanovich";
        $params["ADDRESS"] = "Moscow, Minskay pl, 4, korp 7, kv 45 \\ut";
        $params["ACCOUNT"] = "15000044";
        $params["SERVICENAME"] = "Payment for municipal stuff";
        $order->setPaymentParams($params);

        $merchant = new Merchant();
        $merchant->setMerchantId("1");

        $address = new Customer\Address();
        $customer = new Customer($address);
        $customer->setPhone("+78529875500");

        $this->operation = new Operation($order, $customer, $merchant);
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $xmlExpect = <<< XML
<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
 <Request>
  <Operation>CreateOrder</Operation>
  <Language></Language>
  <Order>
   <OrderType>Payment</OrderType>
   <Merchant>1</Merchant>   
   <Amount>10000</Amount>
   <Currency>643</Currency>
   <Description>municipal payment</Description> 
   <ApproveURL></ApproveURL>
   <CancelURL></CancelURL>
   <DeclineURL></DeclineURL>
   <phone>+78529875500</phone>  
   <AddParams>
    <VendorID>002</VendorID> 
    <PaymentParams>Ivanov Ivan Ivanovich/Moscow, Minskay pl, 4, korp 7, kv 45 \\\\ut/15000044/Payment for municipal stuff</PaymentParams>
   </AddParams> 
  </Order>   
 </Request>
</TKKPG>
XML;
        $paymentOperation = new \Skytech\Sdk\Request\XML\Payment($this->operation);
        $xmlActual = $paymentOperation->getRequestData();
        $this->assertXmlStringEqualsXmlString($xmlExpect, $xmlActual);
    }
}