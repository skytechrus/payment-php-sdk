<?php

use Skytech\Operation\Operation;

class CompletionTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;


    protected $order;
    protected $customer;
    protected $merchant;

    protected function _before()
    {
        $this->order = new \Skytech\Order();
        $date = new DateTime();
        $this->order->setOrderId(1);

        $this->order->setOrderDate($date);
        $this->order->setDescription('auff');
        $this->order->setSessionId('8768767656747456A5D0D');

        $this->merchant = new \Skytech\Merchant();
        $this->merchant->setMerchantId(1);
        $this->merchant->setLanguage("RU");

        $address = new \Skytech\Customer\Address();
        $address->setCity("Moscow");
        $address->setRegion("MO");
        $this->customer = new \Skytech\Customer($address);
        $this->customer->setPhone("89269999999");


    }

    protected function _after()
    {
    }

    // tests
    public function testSomeFeature()
    {
        $order = $this->order;
        $order->setCurrency(840);
        $order->setAmount(100);
        $operation = new Operation($order, $this->customer, $this->merchant);



        $xmlExpect = <<< XML
<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
 <Request>
  <Operation>Completion</Operation>
  <Language></Language>
  <Order>
   <Merchant>1</Merchant>
   <OrderID>1</OrderID>
  </Order>
  <SessionID>8768767656747456A5D0D</SessionID>
  <Amount>10000</Amount>
  <Currency>840</Currency>
  <Description>auff</Description>  
 </Request>
</TKKPG>

XML;
        $compileOperation = new \Skytech\Request\XML\Completion($operation);
        $xmlActual = $compileOperation->getRequestData();
        $this->assertXmlStringEqualsXmlString($xmlExpect, $xmlActual);
    }

    public function testSomeFeature_NotAll()
    {

        $operation = new Operation($this->order, $this->customer, $this->merchant);

        $xmlExpect = <<< XML
<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
 <Request>
  <Operation>Completion</Operation>
  <Language></Language>
  <Order>
   <Merchant>1</Merchant>
   <OrderID>1</OrderID>
  </Order>
  <SessionID>8768767656747456A5D0D</SessionID>
  <Description>auff</Description>  
 </Request>
</TKKPG>  

XML;
        $compileOperation = new \Skytech\Request\XML\Completion($operation);
        $xmlActual = $compileOperation->getRequestData();
        $this->assertXmlStringEqualsXmlString($xmlExpect, $xmlActual);
    }
}
