<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use Skytech\DataProvider\DataProvider;
use Skytech\Service;

/**
 * Class OrderPreAuthorization
 * @package Skytech\DataProvider\XML
 */
class OrderPreAuthorization extends DataProvider
{
    /**
     * @return mixed|string
     */
    public function getRequestData()
    {
        $service = new Service();
        $xml = $service->write("TKKPG", [
                "Request" => [
                    "Operation" => "CreateOrder",
                    "Language" => $this->operation->merchant->getLanguage(),
                    "SessionID" => $this->operation->order->getSessionId(),
                    "Order" => [
                        "OrderType" => "PreAuth",
                        "OrderID" => $this->operation->order->getOrderId(),
                        "Merchant" => $this->operation->merchant->getId(),
                        "Amount" => $this->operation->order->getAmount(),
                        "Currency" => $this->operation->order->getCurrency(),
                        "Description" => $this->operation->order->getDescription(),
                        "ApproveURL" => $this->operation->merchant->getApproveUrl(),
                        "CancelURL" => $this->operation->merchant->getCancelUrl(),
                        "DeclineURL" => $this->operation->merchant->getDeclineUrl()
                        ]
                    ]
                ]);
        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }
}
