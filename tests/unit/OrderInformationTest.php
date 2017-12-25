<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

use Skytech\Sdk\Request\XML\OrderInformation;

/**
 * Class OrderInformationTest
 */
class OrderInformationTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var OrderInformation
     */
    protected $request;


    protected function _before()
    {
        $order = new \Skytech\Sdk\Order();
        $order->setOrderId(69110);
        $order->setSessionId('3C4ABA5872192DD82D33D7A870A3AD8E');
        $merchant = new \Skytech\Sdk\Merchant();
        $merchant->setLanguage('ru');
        $merchant->setMerchantId('POS_IKEA_2');
        $address = new \Skytech\Sdk\Customer\Address();
        $customer = new \Skytech\Sdk\Customer($address);
        $operation = new \Skytech\Sdk\Operation\Operation($order, $customer, $merchant);
        $this->request = new OrderInformation($operation);
    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $expectedRequest = <<< XML
<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
 <Request>
  <Operation>GetOrderInformation</Operation>
  <Language>ru</Language>
  <Order>
   <Merchant>POS_IKEA_2</Merchant>
   <OrderID>69110</OrderID>
  </Order>
  <SessionID>3C4ABA5872192DD82D33D7A870A3AD8E</SessionID>
  <ShowParams>true</ShowParams>
  <ShowOperations>true</ShowOperations>
  <ClassicView>true</ClassicView>
 </Request>
</TKKPG>

XML;
        $actualRequest = $this->request->getRequestData();
        $this->assertXmlStringEqualsXmlString($expectedRequest, $actualRequest);
        //$this->assertXmlStringEqualsXmlString()
    }
}
