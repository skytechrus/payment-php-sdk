<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech;

use Skytech\Operation\OperationType;
use Skytech\Response\Refund;
use Skytech\Response\Response;

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
     */
    public function purchase()
    {
        $response = $this->send(OperationType::PURCHASE);
        return new \Skytech\Response\Order($response);
    }

    /**
     * @param $operationType
     * @return mixed|\Psr\Http\Message\ResponseInterface
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
     * @return Refund
     */
    public function refund($amount, $currency)
    {
        $this->operation->setRefundAmount($amount);
        $this->operation->setRefundCurrency($currency);
        $response = $this->send(OperationType::REFUND);
        return new Refund($response);
    }
}
