<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

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

    /**
     * @throws Exception
     */
    public function testSomeFeature()
    {
        $this->assertEquals("828", $this->payment->purchase()->getOrderId());
    }

    /**
     *
     */
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

        /** @var GuzzleHttp\Psr7\Response $response */
        $response = \Codeception\Util\Stub::make('\\GuzzleHttp\\Psr7\\Response', array(
            'getHeader' => function () {
                return 'application/xml';
            },
            'getBody' => function () {
                return <<< XML
<?xml version='1.0' encoding='UTF-8'?>
<TKKPG>
<Response>
<Operation>CreateOrder</Operation>
<Status>00</Status>
<Order>
<OrderID>828</OrderID>
<SessionID>ECDE79578768ECFBF2897A0F44CC0CEF</SessionID>
<URL>PayGateURL</URL>
</Order>
</Response>
</TKKPG>
XML;
            }
        ));
        /** @var Skytech\Connector $connector */
        $connector = \Codeception\Util\Stub::make('Skytech\Connector', array(
            'sendRequest' => function () use ($response) {
                return new \Skytech\Response\ResponseStrategy($response);
            }
        ));
        $this->payment = new \Skytech\Payment($order, $merchant, $customer, $connector);
    }

    // tests

    protected function _after()
    {
    }
}
