<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

/**
 * Created by PhpStorm.
 * User: arevkina
 * Date: 06.12.2017
 * Time: 14:34
 */

namespace Skytech\Sdk\Request\XML;

use Skytech\Sdk\Request\DataProvider;
use Skytech\Sdk\Service;

/**
 * Class Completion
 * @package Skytech\DataProvider\XML
 */
class Completion extends DataProvider
{
    /**
     * @return mixed|string
     */
    public function getRequestData()
    {
        $service = new Service();
        $value = array();
        $value["Request"] = array();
        $value["Request"]["Operation"] = "Completion";
        $value["Request"]["Language"] = "";
        $value["Request"]["Order"] = array();
        $value["Request"]["Order"]["Merchant"] = $this->operation->merchant->getId();
        $value["Request"]["Order"]["OrderID"] = $this->operation->order->getOrderId();
        $value["Request"]["SessionID"] = $this->operation->order->getSessionId();

        if (!empty($this->operation->order->getAmount())) {
            $value["Request"]["Amount"] = $this->operation->order->getAmount();
            $value["Request"]["Currency"] = $this->operation->order->getCurrency();
        }

        $value["Request"]["Description"] = $this->operation->order->getDescription();

        $xml = $service->write("TKKPG", $value);
        /*
        $xml = $service->write("TKKPG", [
            "Request" => [
                "Operation" => "Completion",
                "Language" => "",
                    "Order" => [
                        "Merchant" => $this->operation->merchant->getId(),
                        "OrderID" => $this->operation->order->getOrderId()
                        ],
                "SessionID" => $this->operation->order->getSessionId(),
                "Amount" => $this->operation->order->getAmount(),
                "Currency"=> $this->operation->order->getCurrency(),
                "Description" => $this->operation->order->getDescription()
                ]
            ]);
        */
        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }
}
