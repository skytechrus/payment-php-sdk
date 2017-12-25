<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request\XML;

use Skytech\Sdk\Request\DataProvider;
use Skytech\Sdk\Service;

/**
 * Class Refund
 *
 * @package Skytech\DataProvider\XML
 */
class Refund extends DataProvider
{
    /**
     *
     */
    public function getRequestData()
    {
        $service = new Service();
        $xml = $service->write("TKKPG", [
            "Request" => [
                "Operation" => "Refund",
                "Language" => "",
                "Order" => [
                    "Merchant" => $this->operation->merchant->getId(),
                    "OrderID" => $this->operation->order->getOrderId(),
                ],
                "SessionID" => $this->operation->order->getSessionId(),
                "Refund" => [
                    "Amount" => $this->operation->getRefundAmount(),
                    "Currency" => $this->operation->getRefundCurrency()
                ],
                "PAN" => $this->operation->card->getPan(),
                "CardUID" => "",
                "TranId" => ""
            ]
        ]);

        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }
}
