<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Author: Sergey Ivanov.
 * Author: Elena Arevkina.
 */

namespace Skytech\DataProvider\XML;

use Skytech\Operation\Operation;
use XMLWriter;

/**
 * Class OrderPurchase
 *
 * @package Skytech\DataProvider\XML
 *
 */
class OrderPurchase extends \Skytech\DataProvider\DataProvider
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
//        return $this->makeXMLCreateOrder();
    }

    /**
     * @return string
     */
    public function makeXMLCreateOrder()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation', 'CreateOrder'); //<Operation>CreateOrder</Operation>
        $xmlRequest->writeElement('Language', $this->operation->merchant->getLanguage()); //<Language></Language>
        $xmlRequest->startElement('Order'); //<Order>
        $xmlRequest->writeElement('OrderType', $this->operation->order->getOperationType());//<OrderType></OrderType>
        $xmlRequest->writeElement('Merchant', $this->operation->merchant->getId()); //<Merchant></Merchant>
        $xmlRequest->writeElement('Amount', $this->operation->order->getAmount()); //<Amount></Amount>
        $xmlRequest->writeElement('Currency', $this->operation->order->getCurrency()); //<Currency></Currency>
        $xmlRequest->writeElement(
            'Description',
            $this->operation->order->getDescription()
        ); //<Description></Description>
        $xmlRequest->writeElement(
            'ApproveURL',
            $this->operation->merchant->getApproveurl()
        ); //<ApproveURL></ApproveURL>
        $xmlRequest->writeElement('CancelURL', $this->operation->merchant->getCancelurl()); //<CancelURL></CancelURL>
        $xmlRequest->writeElement(
            'DeclineURL',
            $this->operation->merchant->getDeclineurl()
        ); //<DeclineURL></DeclineURL>
        $xmlRequest->writeElement('email', $this->operation->customer->getEmailaddr()); //<email></email>
        $xmlRequest->writeElement('phone', $this->operation->customer->getPhone()); //<phone></phone>');
        $xmlRequest->startElement('AddParams'); //<AddParams>
        $xmlRequest->writeRaw($this->getAddParams());
        $xmlRequest->writeElement('FA-DATA', $this->makeFada_data($this->order));
        $xmlRequest->endElement(); //</AddParams>
        $xmlRequest->endElement(); //</Order>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xmlRequest->endDocument();
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }

    /**
     * @return string
     */
    public function getAddParams()
    {
        $additionalParameters = new XMLWriter();
        $additionalParameters->openMemory();
        $additionalParameters->setIndent(true);
        $additionalParameters->writeElement('FA-DATA', $this->makeFada_data($this->operation));
        $xml = $additionalParameters->outputMemory(true);
        return $xml;
    }

    /**
     * @return string
     */
    public function getRequestData()
    {
        $xmlRequestData = $this->getRequestPayload();
        return $xmlRequestData;
    }

    /**
     * @return string Get request xml string for purchase
     */
    public function getRequestPayload()
    {
        $service = new \Sabre\Xml\Service();
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
                    "email" => $this->operation->customer->getEmailaddr(),
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

    /**
     * @param $xmlresponse
     * @return Operation
     */
    public function getResponseData($xmlresponse)
    {
        $this->getOrderResponseData($xmlresponse, $this->operation);
        return $this->operation;
    }
}
