<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk;

use Skytech\Sdk\Operation\OperationType;

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
        $response = $this->send(OperationType::PURCHASE);
        return new \Skytech\Sdk\Response\Order($response);
    }

    /**
     * Send request
     * @param $operationType
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \Exception
     */
    private function send($operationType)
    {
        $data = $this->payload($operationType);
        $this->connector->orderData = $data;
        return $this->connector->sendRequest();
    }

    /**
     * Prepare request body
     * @param $operationType
     * @return mixed
     */
    private function payload($operationType)
    {
        $data = new \Skytech\Sdk\Request\DataProviderStrategy($operationType, $this->operation);
        return $data->getPayload();
    }

    /**
     * @return \Skytech\Response\Reverse
     * @throws \Exception
     */
    public function reverse()
    {
        $response = $this->send(OperationType::REVERSE);
        return new \Skytech\Sdk\Response\Reverse($response);
    }

    /**
     * @return \Skytech\Response\OrderStatus
     * @throws \Exception
     */
    public function orderStatus()
    {
        $response = $this->send(OperationType::ORDERSTATUS);
        return new \Skytech\Sdk\Response\OrderStatus($response);
    }

    /**
     * @return \Skytech\Response\OrderInformation
     * @throws \Exception
     */
    public function orderInformation()
    {
        $response = $this->send(OperationType::ORDER_INFORMATION);
        return new \Skytech\Sdk\Response\OrderInformation($response);
    }

    /**
     * @return Response\Order
     * @throws \Exception
     */
    public function preAuthorisation()
    {
        $response = $this->send(OperationType::ORDER_PREAUTHORISATION);
        return new \Skytech\Sdk\Response\Order($response);
    }

    /**
     * @return Response\Completion
     * @throws \Exception
     */
    public function completion()
    {
        $response = $this->send(OperationType::COMPLETION);
        return new \Skytech\Sdk\Response\Completion($response);
    }

    /**
     * @return Response\Order
     * @throws \Exception
     */
    public function payment()
    {
        $response = $this->send(OperationType::PAYMENT);
        return new \Skytech\Sdk\Response\Order($response);
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
        return new \Skytech\Sdk\Response\Refund($response);
    }
}
