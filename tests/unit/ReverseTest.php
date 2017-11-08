<?php


use Skytech\DataProvider\XML\Reverse;
use Skytech\Operation\Operation;

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
        $order = new \Skytech\Order();
        $date = new DateTime();
        $order->setOrderId(1);
        $order->setCurrency(840);
        $order->setAmount(100);
        $order->setOrderDate($date);
        $order->setDescription('a');
        $order->setSessionId('8768767656747456A5D0D');

        $merchant = new \Skytech\Merchant();
        $merchant->setMerchantId(1);
        $merchant->setLanguage("RU");

        $address = new \Skytech\Customer\Address();
        $address->setCity("Moscow");
        $address->setRegion("MO");

        $customer = new \Skytech\Customer($address);
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
        $xmlExpect = '<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
 <Request>
  <Operation>Reverse</Operation>
  <Language>ru</Language>
  <Order>
   <Merchant>1</Merchant>
   <OrderID>1</OrderID>
  </Order>
  <Amount>100</Amount>
  <Description>a</Description>
  <SessionID>8768767656747456A5D0D</SessionID>
 </Request>
</TKKPG>
';
        $reverseOperation = new Reverse($this->operation);
        $xmlActual = $reverseOperation->getRequestData();
        $this->assertEquals($xmlExpect, $xmlActual);
    }
}
