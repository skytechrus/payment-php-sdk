<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request\XML;

use Skytech\Sdk\Operation\Operation;
use Skytech\Sdk\Request\DataProvider;
use Skytech\Sdk\Service;

/**
 * Class OrderStatus
 *
 * @package Skytech\DataProvider\XML
 */
class OrderStatus extends DataProvider
{

    /**
     * XMLDataGetOrderStatus constructor.
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return string
     */
    public function getRequestData()
    {
        $xmlRequestData = $this->getOrderStatusRequest();
        return $xmlRequestData;
    }

    /**
     * @return string
     */
    public function getOrderStatusRequest()
    {
        $service = new Service();

        $xml = $service->write("TKKPG", [
            "Request" => [
                "Operation" => "GetOrderStatus",
                "Language" => $this->operation->merchant->getLanguage(),
                "Order" => [
                    "Merchant" => $this->operation->merchant->getId(),
                    "OrderID" => $this->operation->order->getOrderId()
                ],
                "SessionID" => $this->operation->order->getSessionId()
            ]
        ]);

        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }
}
