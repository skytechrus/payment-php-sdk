<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 07.11.2017
 * Time: 14:31
 */

namespace Skytech\Sdk;

use Skytech\Sdk\Operation\OperationType;
use Skytech\Sdk\Request\DataProviderStrategy;

/**
 * Class OrderInformation
 *
 * @package Skytech
 */
class OrderInformation
{
    /**
     * @var Operation\Operation
     */
    private $operation;

    /**
     * OrderInformation constructor.
     * @param Order $order
     * @param Merchant $merchant
     * @param Customer $customer
     */
    public function __construct(Order $order, Merchant $merchant, Customer $customer)
    {
        $this->operation = new Operation\Operation($order, $customer, $merchant);
    }

    /**
     * @return Response\OrderInformation
     * @throws \Exception
     */
    public function perform()
    {
        $response = $this->send(OperationType::ORDER_INFORMATION);
        return new Response\OrderInformation($response);
    }

    /**
     * @param string $operationType
     * @return Response\ResponseStrategy
     * @throws \Exception
     */
    private function send($operationType)
    {
        $data = $this->loadOrderInformation($operationType);
        $connector = new Connector($data);
        return $connector->sendRequest();
    }

    /**
     * @param string $operationType
     * @return DataProviderStrategy
     */
    private function loadOrderInformation($operationType)
    {
        $data = new DataProviderStrategy($operationType, $this->operation);
        return $data->getPayload();
    }
}
