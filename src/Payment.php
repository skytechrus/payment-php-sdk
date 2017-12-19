<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

use GuzzleHttp\Client;
use Skytech\Operation\OperationType;

/**
 * Class Payment
 *
 * @package Skytech
 */
class Payment
{
    /**
     * @var Operation\Operation
     */
    private $operation;
    private $connector;

    /**
     * Payment constructor.
     *
     * @param Order $order
     * @param Merchant $merchant
     * @param Customer $customer
     * @param Connector $connector
     */
    public function __construct(Order $order, Merchant $merchant, Customer $customer, Connector $connector)
    {
        $this->operation = new Operation\Operation($order, $customer, $merchant);
        $this->connector = $connector;
    }

    /**
     * @return \Skytech\Response\Order
     * @throws \Exception
     */
    public function purchase()
    {
        try {
            $response = $this->send(OperationType::PURCHASE);
        } catch (\Exception $e) {
            print_r('response 1 error ' . $e);
        }
        $response = new \Skytech\Response\Order($response);
//        $body = [];
//        $body['SESSIONID'] = $response->getSessionID();
//        $body['ORDERID'] = $response->getOrderId();
//        var_dump($response->getURL());
//        var_dump($body);
//        try {
//            $response_2 = $this->connector->send($response->getURL(), '', $body, 'get', true);
//        } catch (\Exception $e) {
//            var_dump('response 2 error ' . $e);
//        }
//        var_dump($response_2);
        return $response;
//        return $body;
    }

    /**
     * @return \Skytech\Response\Reverse
     * @throws \Exception
     */
    public function reverse()
    {
        $response = $this->send(OperationType::REVERSE);
        return new \Skytech\Response\Reverse($response);
    }

    /**
     * @return \Skytech\Response\OrderStatus
     * @throws \Exception
     */
    public function orderStatus()
    {
        $response = $this->send(OperationType::ORDERSTATUS);
        return new \Skytech\Response\OrderStatus($response);
    }

    /**
     * @return \Skytech\Response\OrderInformation
     */
    public function orderInformation()
    {
        $response = $this->send(OperationType::ORDER_INFORMATION);
        return new \Skytech\Response\OrderInformation($response);
    }

    /**
     * @param $operationType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    private function send($operationType)
    {
        $data = $this->payload($operationType);
        $this->connector->orderdata = $data;
        return $this->connector->sendRequest();
    }

    /**
     * @param $operationType
     * @return mixed
     */
    private function payload($operationType)
    {
        $data = new \Skytech\DataProvider\DataProviderStrategy($operationType, $this->operation);
        return $data->getPayload();
    }

    /**
     * @param $amount
     * @param $currency
     * @return \Skytech\Response\Refund
     * @throws \Exception
     */
    public function refund($amount, $currency)
    {
        $this->operation->setRefundAmount($amount);
        $this->operation->setRefundCurrency($currency);
        $response = $this->send(OperationType::REFUND);
        return new \Skytech\Response\Refund($response);
    }
}
