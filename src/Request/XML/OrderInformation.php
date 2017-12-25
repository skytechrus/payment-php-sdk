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
