<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

use Skytech\Sdk\Request\XML\OrderPreAuthorization;
use Skytech\Sdk\Operation\Operation;

/**
 * Class OrderPreAuthorizationTest
 */
class OrderPreAuthorizationTest extends \Codeception\Test\Unit
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
        $order = new \Skytech\Sdk\Order();
        $date = new DateTime();
        $order->setOrderId(5);
        $order->setCurrency(840);
        $order->setAmount(100);
        $order->setOrderDate($date);
        $order->setDescription('a');
        $order->setSessionId('8768767656747456A5D0D');

        $merchant = new \Skytech\Sdk\Merchant();
        $merchant->setMerchantId(1);
        $merchant->setLanguage("RU");

        $address = new \Skytech\Sdk\Customer\Address();
        $address->setCity("Moscow");
        $address->setRegion("MO");

        $customer = new \Skytech\Sdk\Customer($address);
        $customer->setPhone("89269999999");

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
  <Language>ru</Language>
  <SessionID>8768767656747456A5D0D</SessionID>
  <Order>
  <OrderType>PreAuth</OrderType>
  <OrderID>5</OrderID>
  <Merchant>1</Merchant>
  <Amount>10000</Amount>
  <Currency>840</Currency>
  <Description>a</Description>
  <ApproveURL></ApproveURL>
  <CancelURL></CancelURL>
  <DeclineURL></DeclineURL>
  </Order>
 </Request>
</TKKPG>

XML;
        $preAuth = new OrderPreAuthorization($this->operation);
        $xmlActual = $preAuth->getRequestData();
        $this->assertXmlStringEqualsXmlString($xmlExpect, $xmlActual);
    }
}