<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\Request\XML;

use Skytech\Operation\Operation;
use Skytech\Service;
use Skytech\Request\DataProvider;

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
        $this->operation=$operation;
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
