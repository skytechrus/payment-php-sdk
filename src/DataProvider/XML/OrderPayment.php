<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use XMLWriter;

/**
 * Class OrderPayment
 *
 * @package Skytech\DataProvider\XML
 */
class OrderPayment extends DataProvider
{
    use OrderResponse;
    /**
     * OrderPayment constructor.
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
        $xmlRequestdata = $this->makeXMLCreateOrder();
        return $xmlRequestdata;
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
        $xmlRequest->writeElement('Language', $this->operation->order->getLanguage());        //<Language></Language>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('OrderType', $this->operation->order->getOperationType());//<OrderType></OrderType>
        $xmlRequest->writeElement('Merchant',
            $this->operation->order->getMerchantId());           //<Merchant></Merchant>
        $xmlRequest->writeElement('Amount', $this->operation->order->getAmount());                 //<Amount></Amount>
        $xmlRequest->writeElement('Currency',
            $this->operation->order->getCurrency());              //<Currency></Currency>
        $xmlRequest->writeElement('Description', $this->operation->order->getDescription());  //<Description></Description>
        $xmlRequest->writeElement('ApproveURL', $this->operation->url_settings->getApproveurl());    //<ApproveURL></ApproveURL>
        $xmlRequest->writeElement('CancelURL', $this->operation->url_settings->getCancelurl());      //<CancelURL></CancelURL>
        $xmlRequest->writeElement('DeclineURL', $this->operation->url_settings->getDeclineurl());    //<DeclineURL></DeclineURL>
        $xmlRequest->writeElement('email', $this->operation->customer->getEmailaddr());          //<email></email>
        $xmlRequest->writeElement('phone', $this->operation->customer->phone);              //<phone></phone>');
        $xmlRequest->startElement('AddParams');                        //<AddParams>
        $xmlRequest->writeRaw($this->getAddParams());
        //$xmlRequest->writeElement('FA-DATA',$this->makeFada_data($this->order));
        $xmlRequest->endElement();                                           //</AddParams>
        $xmlRequest->writeElement('Fee', $this->operation->order->getFee());                   //<Fee></Fee>
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
        $xmlAddParameter = new XMLWriter();
        $xmlAddParameter->openMemory();
        $xmlAddParameter->setIndent(true);
        $xmlAddParameter->writeElement('VendorID', $this->operation->order->getVendorId());
        $xmlAddParameter->writeElement('OrigAmount', $this->operation->order->getOrigAmount());
        $xmlAddParameter->writeElement('OrigCurrency', $this->operation->order->getOrigCurrency());
        // PaymentParams
        $xml = $xmlAddParameter->outputMemory(true);
        return $xml;
    }

    /**
     * @param $xmlResponse
     * @return Operation
     */
    public function getResponseData($xmlResponse)
    {
        $this->getOrderResponseData($xmlResponse, $this->operation);
        return $this->operation;
    }

}
