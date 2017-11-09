<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

use Skytech\Operation\OperationType;
use Skytech\Response\OrderInformation;
use Skytech\Response\OrderStatus;
use Skytech\Response\Response;
use Skytech\Response\Reverse;

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

    /**
     * Payment constructor.
     *
     * @param $order
     * @param $merchant
     * @param $customer
     */
    public function __construct(Order $order, Merchant $merchant, Customer $customer)
    {
        $this->operation = new Operation\Operation($order, $customer, $merchant);
    }

    /**
     * @return  Response
     */
    public function purchase()
    {
        $response = $this->send(OperationType::PURCHASE);
//        return new Response((string)$response->getBody());
//        return $response->getBody();
        return new \Skytech\Response\Order($response);
    }

    /**
     * @return Reverse
     * @throws \Exception
     */
    public function reverse()
    {
        $response = $this->send(OperationType::REVERSE);
        return new Reverse($response);
    }

    /**
     * @return OrderStatus
     * @throws \Exception
     */
    public function orderStatus()
    {
        $response = $this->send(OperationType::ORDERSTATUS);
        return new OrderStatus($response);
    }

    /**
     * @return OrderInformation
     */
    public function orderInformation()
    {
        $response = $this->send(OperationType::ORDER_INFORMATION);
        return new OrderInformation($response);
    }

    /**
     * @param $operationType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function send($operationType)
    {
        $data = $this->payload($operationType);
        $connector = new \Skytech\Connector($data);
        return $connector->sendRequest();
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
}
