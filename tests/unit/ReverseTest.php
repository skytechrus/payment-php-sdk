<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

use Skytech\Sdk\Request\XML\Reverse;
use Skytech\Sdk\Operation\Operation;

/**
 * Class ReverseTest
 */
class ReverseTest extends \Codeception\Test\Unit
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
        $order->setOrderId(1);
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
//TODO
    // tests
    public function testSomeFeature()
    {
        $xmlExpect = <<< XML
<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
 <Request>
  <Operation>Reverse</Operation>
  <Language>ru</Language>
  <Order>
   <Merchant>1</Merchant>
   <OrderID>1</OrderID>
  </Order>
  <Amount>10000</Amount>
  <Description>a</Description>
  <SessionID>8768767656747456A5D0D</SessionID>
 </Request>
</TKKPG>

XML;
        $reverseOperation = new Reverse($this->operation);
        $xmlActual = $reverseOperation->getRequestData();
        $this->assertXmlStringEqualsXmlString($xmlExpect, $xmlActual);
    }
}
