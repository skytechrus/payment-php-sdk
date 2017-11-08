<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use Skytech\DataProvider\DataProvider;
use Skytech\Operation\Operation;
use Skytech\Service;

/**
 * Class OrderInformation
 *
 * @package Skytech\DataProvider\XML
 */
class OrderInformation extends DataProvider
{
    /**
     * OrderInfo constructor.
     *
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
        $xmlRequestData = $this->getOrderInformation();
        return $xmlRequestData;
    }

    /**
     * @return string
     */
    protected function getOrderInformation()
    {
        $service = new Service();
        $xml = $service->write("TKKPG", [
            "Request" => [
                "Operation" => "GetOrderInformation",
                "Language" => $this->operation->merchant->getLanguage(),
                "Order" => [
                    "Merchant" => $this->operation->merchant->getId(),
                    "OrderID" => $this->operation->order->getOrderId()
                ],
                "SessionID" => $this->operation->order->getSessionId(),
                "ShowParams" => "true",
                "ShowOperations" => "true",
                "ClassicView" => "true"
            ]
        ]);

        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }
}
