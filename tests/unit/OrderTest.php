<?php


class OrderTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \Skytech\Order
     */
    protected $order;

    public function testSetAmount()
    {
        $amount = 123;
        $this->order->setAmount($amount);
        $this->assertEquals($amount*100, $this->order->getAmount(), 'Set amount as integer success');
    }

    public function testSetNumericAmountAsString()
    {
        $amount = '123';
        $this->order->setAmount($amount);
        $this->assertEquals($amount*100, $this->order->getAmount(), 'Set amount as string success');
        $this->assertEquals((int)$amount*100, $this->order->getAmount(), 'Set amount as string success #2');
    }

    public function testSetAmountNotNumeric()
    {
        $this->expectException(InvalidArgumentException::class);
        $amount = 'string';
        $this->order->setAmount($amount);
    }

    public function testSetCurrency()
    {
        $currency = 643;
        $this->order->setCurrency($currency);
        $this->assertEquals($currency, $this->order->getCurrency());

        $currency = '643';
        $this->order->setCurrency($currency);
        $this->assertEquals((int)$currency, $this->order->getCurrency());

        $currency = 6433;
        $this->expectException(InvalidArgumentException::class);
        $this->order->setCurrency($currency);

        $currency = 64;
        $this->expectException(InvalidArgumentException::class);
        $this->order->setCurrency($currency);

        $currency = "string";
        $this->expectException(InvalidArgumentException::class);
        $this->order->setCurrency($currency);
    }

    public function testSetWrongCurrency()
    {
        $currency = "RUB";
        $this->expectException(InvalidArgumentException::class);
        $this->order->setCurrency($currency);
    }

    public function testGetCurrency()
    {
        $currency = 643;
        $this->order->setCurrency($currency);
        $this->assertEquals($currency, $this->order->getCurrency());
    }

    public function testSetAndGetDesciption()
    {
        $description = "trololo";
        $this->order->setDescription($description);
        $this->assertEquals($description, $this->order->getDescription());
    }

    public function testSetAndGetOrderStatus()
    {
        $status = "success";
        $this->order->setOrderStatus($status);
        $this->assertEquals($status, $this->order->getOrderStatus());
    }

    public function testSetAndGetXId()
    {
        $xid = "654321";
        $this->order->setXId($xid);
        $this->assertEquals($xid, $this->order->getXId());
    }

    public function testSetAndGetOrderId()
    {
        $orderId = 234;
        $this->order->setOrderId($orderId);
        $this->assertEquals($orderId, $this->order->getOrderId());
    }

    public function testSetAndGetOrderDate()
    {
        $date = new DateTime();
        $this->order->setOrderDate($date);
        $this->assertInstanceOf(DateTime::class, $this->order->getOrderDate());
    }


    protected function _before()
    {
        $this->order = new \Skytech\Order();
    }

    protected function _after()
    {
    }

}
