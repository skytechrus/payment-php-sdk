<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
 */

namespace Skytech\Sdk\Request\XML;

use Skytech\Sdk\Operation\Operation;
use Skytech\Sdk\OrderPayment;
use Skytech\Sdk\Request\DataProvider;
use Skytech\Sdk\Service;
use function str_replace;

/**
 * Class Payment
 * @package Skytech\Request\XML
 */
class Payment extends DataProvider
{

    /**
     * Payment constructor.
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        parent::__construct($operation);
    }

    /**
     * @return mixed|string
     */
    public function getRequestData()
    {
        $service = new Service();
        $requestBody = array();
        $requestBody["Request"] = array();
        $requestBody["Request"]["Operation"] = "CreateOrder";
        $requestBody["Request"]["Language"] = "";
        $requestBody["Request"]["Order"] = array();
        $requestBody["Request"]["Order"]["OrderType"] = "Payment";
        $requestBody["Request"]["Order"]["Merchant"] = $this->operation->merchant->getId();
        $requestBody["Request"]["Order"]["Amount"] = $this->operation->order->getAmount();
        $requestBody["Request"]["Order"]["Currency"] = $this->operation->order->getCurrency();
        $requestBody["Request"]["Order"]["Description"] = $this->operation->order->getDescription();
        $requestBody["Request"]["Order"]["ApproveURL"] = $this->operation->merchant->getApproveUrl();
        $requestBody["Request"]["Order"]["CancelURL"] = $this->operation->merchant->getCancelUrl();
        $requestBody["Request"]["Order"]["DeclineURL"] = $this->operation->merchant->getDeclineUrl();
        if (!empty($this->operation->customer->getEmail())) {
            $requestBody["Request"]["Order"]["email"] = $this->operation->customer->getEmail();
        }
        if (!empty($this->operation->customer->getPhone())) {
            $requestBody["Request"]["Order"]["phone"] = $this->operation->customer->getPhone();
        }
        $requestBody["Request"]["Order"]["AddParams"] = array();
        $requestBody["Request"]["Order"]["AddParams"] = $this->getAddParams($this->operation->order);

        $xml = $service->write("TKKPG", $requestBody);

        if ($xml) {
            return $xml;
        } else {
            throw new \UnexpectedValueException("XML is not generated");
        }
    }

    /**
     * @param OrderPayment $orderExt
     * @return array
     */
    public function getAddParams(OrderPayment $orderExt)
    {
        $addParams = array();
        $addParams["VendorID"] = $orderExt->getVendorId();
        $addPaymentParams = $orderExt->getPaymentParams();
        $addPaymentParams = str_replace("/", "\/", $addPaymentParams);
        $addPaymentParams = str_replace("\\", "\\\\", $addPaymentParams);
        if (!empty($addPaymentParams)) {
            $addParamList = "";
            foreach ($addPaymentParams as $paramData) {
                if (!empty($addParamList)) {
                    $addParamList .= "/";
                }
                $addParamList .= $paramData;
            }
            $addParams["PaymentParams"] = $addParamList;
        }
        return $addParams;
    }
}
