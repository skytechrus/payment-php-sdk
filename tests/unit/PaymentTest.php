<?php


class PaymentTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    /**
     * @var \Skytech\Payment
     */
    private $payment;

    public function testSomeFeature()
    {
        $this->assertEquals("доделать", $this->payment->purchase());
    }

    protected function _before()
    {
        $order = new \Skytech\Order();
        $date = new DateTime();
        $order->setOrderId(1);
        $order->setCurrency(840);
        $order->setAmount(100);
        $order->setOrderDate($date);

        $merchant = new \Skytech\Merchant();
        $merchant->setMerchantId(1);
        $merchant->setLanguage("RU");
        $merchant->setApproveUrl("");
        $merchant->setCancelUrl("");
        $merchant->setDeclineUrl("");

        $address = new \Skytech\Customer\Address();
        $address->setCity("Moscow");
        $address->setRegion("MO");
        $address->setCountry(840);
        $address->setZip("140182");

        $customer = new \Skytech\Customer($address);
        $customer->setIp("192.168.0.1");
        $customer->setPhone("89269999999");
        $customer->setEmail("test@test.com");
        $customer->setSessionId("asdf");

        $this->payment = new \Skytech\Payment($order, $merchant, $customer);
    }

    // tests

    protected function _after()
    {
    }
}
