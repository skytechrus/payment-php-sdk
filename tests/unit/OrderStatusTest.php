<?php


use Skytech\Operation\Operation;

class OrderStatusTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var Operation
     */
    private $operation;
    //TODO
    public function testSomeFeature()
    {
        $xmlExpect = '<?xml version="1.0" encoding="UTF-8"?>
<TKKPG>
 <Request>
  <Operation>GetOrderStatus</Operation>
  <Language>ru</Language>
  <Order>
   <Merchant>POS_IKEA_2</Merchant>
   <OrderID>1</OrderID>
  </Order>
  <SessionID>05460005547444</SessionID>
 </Request>
</TKKPG>
';
        $orderStat = new \Skytech\DataProvider\XML\OrderStatus($this->operation);
        $requestLine = $orderStat->getRequestData();
        $this->assertXmlStringEqualsXmlString($xmlExpect, $requestLine);
    }

    protected function _before()
    {
        $order = new \Skytech\Order();
        $order->setOrderId(1);
        $order->setSessionId('05460005547444');

        $merchant = new \Skytech\Merchant();
        $merchant->setMerchantId('POS_IKEA_2');
        $merchant->setLanguage("ru");

        $address = new \Skytech\Customer\Address();

        $customer = new \Skytech\Customer($address);

        $this->operation = new Operation($order, $customer, $merchant);
    }

    protected function _after()
    {
    }
}
