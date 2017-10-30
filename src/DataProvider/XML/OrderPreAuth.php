<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

namespace Skytech\DataProvider\XML;

use XMLWriter;

class OrderPreAuth extends DataProvider
{
    use OrderResponse;

    /**
     * OrderPreAuth constructor.
     *
     * @param Operation $operation
     */
    public function __construct(Operation $operation)
    {
        $this->operation=$operation;
    }
    public function getRequestData()
    {
        $xmlRequestdata = $this->makeXMLCreateOrder();
        return $xmlRequestdata;
    }
    public function makeXMLCreateOrder()
    {
        $xmlRequest = new XMLWriter(); //= xmlwriter_open_memory;
        $xmlRequest->openMemory();
        $xmlRequest->startDocument('1.0', 'UTF-8');
        $xmlRequest->startElement('TKKPG'); //<TKKPG>
        $xmlRequest->startElement('Request');//<Request>
        $xmlRequest->writeElement('Operation','CreateOrder');          //<Operation>CreateOrder</Operation>
        $xmlRequest->writeElement('Language', $this->operation->order->getLanguage());        //<Language></Language>
        $xmlRequest->startElement('Order');                                       //<Order>
        $xmlRequest->writeElement('OrderType', $this->operation->order->getOperationType());//<OrderType></OrderType>
        $xmlRequest->writeElement('Merchant',
            $this->operation->order->getMerchantId());           //<Merchant></Merchant>
        $xmlRequest->writeElement('Amount',$this->operation->order->getAmount());                 //<Amount></Amount>
        $xmlRequest->writeElement('Currency',$this->operation->order->getCurrency());              //<Currency></Currency>
        $xmlRequest->writeElement('Description', $this->operation->order->getDescription());  //<Description></Description>
        $xmlRequest->writeElement('ApproveURL', $this->operation->url_settings->getApproveurl());    //<ApproveURL></ApproveURL>
        $xmlRequest->writeElement('CancelURL', $this->operation->url_settings->getCancelurl());      //<CancelURL></CancelURL>
        $xmlRequest->writeElement('DeclineURL', $this->operation->url_settings->getDeclineurl());    //<DeclineURL></DeclineURL>
        $xmlRequest->writeElement('email', $this->operation->customer->getEmailaddr());          //<email></email>
        $xmlRequest->writeElement('phone', $this->operation->customer->phone);              //<phone></phone>');
        $xmlRequest->startElement('AddParams');                        //<AddParams>
        $xmlRequest->writeRaw( $this->GetAddParams());
        //$xmlRequest->writeElement('FA-DATA',$this->makeFada_data($this->order));
        $xmlRequest->endElement();                                           //</AddParams>
        $xmlRequest->writeElement('Fee',$this->operation->order->getFee());                   //<Fee></Fee>
        $xmlRequest->endElement(); //</Order>
        $xmlRequest->endElement(); //</Request>
        $xmlRequest->endElement();//</TKKPG>
        $xmlRequest->endDocument();
        $xml = $xmlRequest->outputMemory(true);
        return $xml;
    }
    public function GetAddParams()
    {
        $xml_add_par =  new XMLWriter();
        $xml_add_par->openMemory();
        $xml_add_par->setIndent(true);
        $xml_add_par->writeElement('FA-DATA',$this->makeFada_data($this->operation));
        $xml_add_par->writeElement('SenderPostalCode',$this->operation->customer->address->getZip());
        //$xml_add_par->writeElement('AcctType');
        //$xml_add_par->writeElement('TranAddendums');
        $xml_add_par->writeElement('OrderExpirationPeriod', $this->operation->order->getOrderExpPeriod());
        $xml_add_par->writeElement('OrigAmount', $this->operation->order->getOrigAmount());
        $xml_add_par->writeElement('OrigCurrency', $this->operation->order->getOrigCurrency());
        $xml = $xml_add_par->outputMemory(true);
        return $xml;
    }
    public function makeFada_line($name,$value)
    {
        $fada_line =null;
        if(!is_null($value)) {
            $fada_line = $name . '=' . $value . ';';
        }
        return $fada_line;
    }
    public function makeFada_data(Operation $operation)
    {
        $fada_data = null;
        $fada_data .= $this->makeFada_line('ShippingCountry', $operation->customer->address->getCountry());
        $fada_data .= $this->makeFada_line('ShippingCity', $operation->customer->address->getCountry());
        $fada_data .= $this->makeFada_line('ShippingState', $operation->customer->address->getRegion());
        $fada_data .= $this->makeFada_line('ShippingZipCode', $operation->customer->address->getZip());
        $fada_data .= $this->makeFada_line('ShippingAddress', $operation->customer->address->addressline );
// $fada_data .= $this->makeFada_line('DeliveryPeriod', null );
        $fada_data .= $this->makeFada_line('Phone', $operation->customer->phone );
        $fada_data .= $this->makeFada_line('Email', $operation->customer->getEmailaddr() );
        $fada_data .= $this->makeFada_line('MerchantOrderID', $operation->order->getXId());
        return $fada_data;
    }
    public function getResponseData($xmlresponse)
    {
        $this->getOrderResponseData($xmlresponse,$this->operation);
        return $this->operation;
    }

}
