<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request\XML;

use Skytech\Sdk\Operation\Operation;
use Skytech\Sdk\Request\DataProvider;

/**
 * Class OrderPurchase
 *
 */
class Purchase extends DataProvider
{
    /**
     * @var Operation
     */
    protected $operation;

    /**
     * OrderPurchase constructor.
     *
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return string Get request xml string for purchase
     */
    public function getRequestData()
    {
        $service = new \Skytech\Sdk\Service();
        $xml = $service->write("TKKPG", [
            "Request" => [
                "Operation" => "CreateOrder",
                "Language" => "",
                "Order" => [
                    "OrderType" => "Purchase",
                    "Merchant" => $this->operation->merchant->getId(),
                    "Amount" => $this->operation->order->getAmount(),
                    "Currency" => $this->operation->order->getCurrency(),
                    "Description" => $this->operation->order->getDescription(),
                    "ApproveURL" => $this->operation->merchant->getApproveUrl(),
                    "CancelURL" => $this->operation->merchant->getCancelUrl(),
                    "DeclineURL" => $this->operation->merchant->getDeclineUrl(),
                    "email" => $this->operation->customer->getEmail(),
                    "phone" => $this->operation->customer->getPhone()
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
