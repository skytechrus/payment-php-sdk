<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use Skytech\Service;
use Skytech\DataProvider\DataProvider;
use Skytech\Operation\Operation;

class Reverse extends DataProvider
{
    /**
     * Reverse constructor.
     *
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
        $xmlRequestData = $this->getRequestReverse();
        return $xmlRequestData;
    }

    /**
     * @return string
     */
    private function getRequestReverse()
    {
        $service = new Service();

        $xml = $service->write("TKKPG", [
            "Request" => [
                "Operation" => "Reverse",
                "Language" => $this->operation->merchant->getLanguage(),
                "Order" => [
                    "Merchant" => $this->operation->merchant->getId(),
                    "OrderID" => $this->operation->order->getOrderId()
                    ],
                "Amount" => $this->operation->order->getAmount(),
                "Description" => $this->operation->order->getDescription(),
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
