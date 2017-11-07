<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use Skytech\Operation\Operation;
use Skytech\Service;
use Skytech\DataProvider\DataProvider;

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
        $xmlRequestData = $this->orderStatusRequest();
        return $xmlRequestData;
    }

    /**
     * @return string
     */
    public function orderStatusRequest()
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
